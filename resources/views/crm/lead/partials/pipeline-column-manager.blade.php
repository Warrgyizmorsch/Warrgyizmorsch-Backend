{{-- Pipeline Column Manager (Reorder / Arrange Columns with LocalStorage Persistence) --}}
<style>
.pipeline-column-header[draggable="true"] {
    cursor: grab;
    user-select: none;
}
.pipeline-column-header[draggable="true"]:active {
    cursor: grabbing;
}
.pipeline-column.col-drop-target {
    outline: 2px dashed #006FC9 !important;
    outline-offset: -2px;
    background-color: rgba(0, 111, 201, 0.04) !important;
}
.arrange-col-item {
    transition: background-color 0.15s ease, border-color 0.15s ease, transform 0.15s ease;
}
.arrange-col-item:hover {
    border-color: #cbd5e1 !important;
}
.arrange-col-item.dragging {
    opacity: 0.45;
    background-color: #f1f5f9 !important;
}
</style>

{{-- Arrange Columns Modal --}}
<div class="modal fade" id="arrangeColumnsModal" tabindex="-1" aria-labelledby="arrangeColumnsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" style="max-width: 440px;">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header border-bottom py-3 px-4 bg-light-subtle">
                <div>
                    <h6 class="modal-title fw-bold text-dark mb-0" id="arrangeColumnsModalLabel">
                        <i class="feather-sliders text-primary me-1.5"></i> Arrange Columns
                    </h6>
                    <small class="text-muted" style="font-size: 11.5px;">Reorder columns or use ▲ / ▼ to move.</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3 bg-light-subtle">
                <div class="d-flex align-items-center justify-content-between mb-2 px-1">
                    <span class="fs-11 fw-bold text-muted text-uppercase">Stages / Columns</span>
                    <span class="fs-11 text-muted">Order is saved automatically</span>
                </div>
                <div id="arrangeColumnsList" class="d-flex flex-column gap-2" style="max-height: 380px; overflow-y: auto; padding-right: 2px;">
                    <!-- Dynamically populated from active board columns -->
                </div>
            </div>
            <div class="modal-footer border-top py-2.5 px-4 bg-white d-flex justify-content-between">
                <button type="button" class="btn btn-outline-danger btn-sm rounded-2 d-flex align-items-center gap-1 fs-12 py-1.5" onclick="resetPipelineColumnOrder()">
                    <i class="feather-rotate-ccw"></i> Reset Default
                </button>
                <button type="button" class="btn btn-primary btn-sm rounded-2 px-3 fs-12 py-1.5" data-bs-dismiss="modal">
                    Done
                </button>
            </div>
        </div>
    </div>
</div>

<script>
(function() {
    const board = document.getElementById('pipelineBoard');
    if (!board) return;

    const storageKey = '{{ $storageKey ?? "pipeline_col_order_leads" }}';

    // 1. Apply saved order from LocalStorage
    function applySavedOrder() {
        try {
            const saved = localStorage.getItem(storageKey);
            if (!saved) return;
            const order = JSON.parse(saved);
            if (!Array.isArray(order) || !order.length) return;

            const currentCols = Array.from(board.querySelectorAll('.pipeline-column'));
            const colMap = {};
            currentCols.forEach(col => {
                const bId = col.getAttribute('data-bucket-id');
                if (bId) colMap[bId] = col;
            });

            // Reorder existing columns in DOM
            order.forEach(bId => {
                if (colMap[bId]) {
                    board.appendChild(colMap[bId]);
                    delete colMap[bId];
                }
            });

            // Append any columns not in the saved list
            Object.values(colMap).forEach(col => board.appendChild(col));
        } catch (e) {
            console.error('Error applying column order:', e);
        }
    }

    // Apply on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', applySavedOrder);
    } else {
        applySavedOrder();
    }

    // 2. Open Modal and Populate Columns
    window.openArrangeColumnsModal = function() {
        const listEl = document.getElementById('arrangeColumnsList');
        if (!listEl) return;

        listEl.innerHTML = '';
        const currentCols = Array.from(board.querySelectorAll('.pipeline-column'));

        currentCols.forEach((col) => {
            const bId = col.getAttribute('data-bucket-id');
            const header = col.querySelector('.pipeline-column-header');
            const titleEl = header ? header.querySelector('h6') : null;
            const title = titleEl ? titleEl.textContent.trim() : `Column ${bId}`;
            const dotEl = header ? header.querySelector('span.rounded-circle') : null;
            const dotColor = dotEl ? dotEl.style.backgroundColor : '#006FC9';
            const countEl = header ? header.querySelector('.col-count-badge') : null;
            const count = countEl ? countEl.textContent.trim() : '0';

            const item = document.createElement('div');
            item.className = 'arrange-col-item d-flex align-items-center justify-content-between p-2.5 bg-white border rounded-3 shadow-2xs';
            item.setAttribute('data-bucket-id', bId);
            item.setAttribute('draggable', 'true');
            item.style.cursor = 'grab';

            item.innerHTML = `
                <div class="d-flex align-items-center gap-2 text-truncate me-2">
                    <span class="text-muted arrange-handle" style="cursor: grab;" title="Drag to reorder">
                        <i class="feather-move fs-13"></i>
                    </span>
                    <span class="rounded-circle d-inline-block flex-shrink-0" style="width: 10px; height: 10px; background-color: ${dotColor};"></span>
                    <span class="fw-semibold text-dark fs-13 text-truncate" title="${title}">${title}</span>
                </div>
                <div class="d-flex align-items-center gap-1.5 flex-shrink-0">
                    <span class="badge rounded-pill bg-light text-dark border fs-11 px-2 py-0.5 me-1">${count}</span>
                    <button type="button" class="btn btn-outline-secondary btn-xs py-0.5 px-1.5 rounded" onclick="moveArrangeItem(${bId}, -1)" title="Move Up">
                        <i class="feather-chevron-up fs-12"></i>
                    </button>
                    <button type="button" class="btn btn-outline-secondary btn-xs py-0.5 px-1.5 rounded" onclick="moveArrangeItem(${bId}, 1)" title="Move Down">
                        <i class="feather-chevron-down fs-12"></i>
                    </button>
                </div>
            `;

            item.addEventListener('dragstart', handleItemDragStart);
            item.addEventListener('dragover', handleItemDragOver);
            item.addEventListener('drop', handleItemDrop);
            item.addEventListener('dragend', handleItemDragEnd);

            listEl.appendChild(item);
        });

        const modalEl = document.getElementById('arrangeColumnsModal');
        if (modalEl) {
            bootstrap.Modal.getOrCreateInstance(modalEl).show();
        }
    };

    // 3. Move items Up / Down in Modal
    window.moveArrangeItem = function(bId, direction) {
        const listEl = document.getElementById('arrangeColumnsList');
        if (!listEl) return;
        const items = Array.from(listEl.querySelectorAll('.arrange-col-item'));
        const index = items.findIndex(item => item.getAttribute('data-bucket-id') == bId);
        if (index === -1) return;

        const targetIndex = index + direction;
        if (targetIndex < 0 || targetIndex >= items.length) return;

        if (direction === -1) {
            listEl.insertBefore(items[index], items[targetIndex]);
        } else {
            listEl.insertBefore(items[index], items[targetIndex].nextSibling);
        }

        syncBoardFromModalList();
    };

    // Drag & Drop handlers inside Arrange Modal
    let draggedModalItem = null;
    function handleItemDragStart(e) {
        draggedModalItem = this;
        this.classList.add('dragging');
        e.dataTransfer.effectAllowed = 'move';
    }
    function handleItemDragOver(e) {
        e.preventDefault();
        e.dataTransfer.dropEffect = 'move';
        const targetItem = e.target.closest('.arrange-col-item');
        if (targetItem && targetItem !== draggedModalItem) {
            targetItem.style.borderColor = '#006FC9';
            targetItem.style.backgroundColor = '#eff6ff';
        }
    }
    function handleItemDrop(e) {
        e.preventDefault();
        const targetItem = e.target.closest('.arrange-col-item');
        if (targetItem) {
            targetItem.style.borderColor = '';
            targetItem.style.backgroundColor = '';
        }
        if (targetItem && draggedModalItem && targetItem !== draggedModalItem) {
            const listEl = document.getElementById('arrangeColumnsList');
            const items = Array.from(listEl.children);
            const srcIdx = items.indexOf(draggedModalItem);
            const tgtIdx = items.indexOf(targetItem);
            if (srcIdx < tgtIdx) {
                listEl.insertBefore(draggedModalItem, targetItem.nextSibling);
            } else {
                listEl.insertBefore(draggedModalItem, targetItem);
            }
            syncBoardFromModalList();
        }
    }
    function handleItemDragEnd() {
        this.classList.remove('dragging');
        document.querySelectorAll('.arrange-col-item').forEach(el => {
            el.style.borderColor = '';
            el.style.backgroundColor = '';
        });
        draggedModalItem = null;
    }

    // 4. Sync board DOM to modal list order and save to LocalStorage
    function syncBoardFromModalList() {
        const listEl = document.getElementById('arrangeColumnsList');
        if (!listEl) return;
        const items = Array.from(listEl.querySelectorAll('.arrange-col-item'));
        const newOrder = items.map(item => item.getAttribute('data-bucket-id'));

        newOrder.forEach(bId => {
            const col = board.querySelector(`.pipeline-column[data-bucket-id="${bId}"]`);
            if (col) board.appendChild(col);
        });

        localStorage.setItem(storageKey, JSON.stringify(newOrder));
    }

    // 5. Reset to default order
    window.resetPipelineColumnOrder = function() {
        localStorage.removeItem(storageKey);
        window.location.reload();
    };

    // 6. Direct Column Drag & Drop on the Board
    enableDirectColumnDragOnBoard();

    function enableDirectColumnDragOnBoard() {
        let draggedCol = null;

        board.querySelectorAll('.pipeline-column').forEach(col => {
            const header = col.querySelector('.pipeline-column-header');
            if (!header) return;

            header.setAttribute('draggable', 'true');
            header.setAttribute('title', 'Drag column to rearrange');

            header.addEventListener('dragstart', function(e) {
                // If dragging a lead card inside the column, don't drag the column
                if (e.target.closest('.pipeline-lead-card') || e.target.closest('.pipeline-cards-container')) {
                    return;
                }
                draggedCol = col;
                col.style.opacity = '0.5';
                e.dataTransfer.effectAllowed = 'move';
                e.dataTransfer.setData('text/column-id', col.getAttribute('data-bucket-id'));
            });

            header.addEventListener('dragend', function() {
                col.style.opacity = '1';
                board.querySelectorAll('.pipeline-column').forEach(c => c.classList.remove('col-drop-target'));
                draggedCol = null;
            });

            col.addEventListener('dragover', function(e) {
                if (!draggedCol || draggedCol === col) return;
                // Only act if this is a column drag, not a lead card drag
                if (e.dataTransfer.types.includes('text/column-id')) {
                    e.preventDefault();
                    e.dataTransfer.dropEffect = 'move';
                    col.classList.add('col-drop-target');
                }
            });

            col.addEventListener('dragleave', function(e) {
                // Only remove if leaving the column element itself
                if (!col.contains(e.relatedTarget)) {
                    col.classList.remove('col-drop-target');
                }
            });

            col.addEventListener('drop', function(e) {
                if (!draggedCol || draggedCol === col) return;
                if (e.dataTransfer.types.includes('text/column-id')) {
                    e.preventDefault();
                    e.stopPropagation();
                    col.classList.remove('col-drop-target');

                    const cols = Array.from(board.querySelectorAll('.pipeline-column'));
                    const srcIdx = cols.indexOf(draggedCol);
                    const tgtIdx = cols.indexOf(col);

                    if (srcIdx < tgtIdx) {
                        board.insertBefore(draggedCol, col.nextSibling);
                    } else {
                        board.insertBefore(draggedCol, col);
                    }

                    const updatedCols = Array.from(board.querySelectorAll('.pipeline-column'));
                    const order = updatedCols.map(c => c.getAttribute('data-bucket-id'));
                    localStorage.setItem(storageKey, JSON.stringify(order));
                }
            });
        });
    }
})();
</script>
