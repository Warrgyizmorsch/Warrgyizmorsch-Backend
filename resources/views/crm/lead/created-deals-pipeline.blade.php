@extends('layouts.app')

@section('content')
<style>
    /* Pipeline / Kanban Styles */
    .pipeline-wrapper {
        min-height: calc(100vh - 170px);
    }
    .pipeline-board {
        display: flex;
        flex-direction: row;
        overflow-x: auto;
        align-items: flex-start;
        gap: 1.25rem;
        padding-bottom: 1.5rem;
        min-height: calc(100vh - 250px);
    }
    .pipeline-column {
        flex: 0 0 320px;
        max-width: 320px;
        min-width: 300px;
        background: #f4f6f9;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        display: flex;
        flex-direction: column;
        max-height: calc(100vh - 220px);
    }
    .pipeline-column-header {
        padding: 0.85rem 1rem;
        background: #ffffff;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
        border-bottom: 1px solid #e2e8f0;
        position: sticky;
        top: 0;
        z-index: 10;
    }
    .pipeline-cards-container {
        padding: 0.85rem;
        overflow-y: auto;
        flex: 1 1 auto;
        min-height: 150px;
        scroll-behavior: smooth;
    }
    .pipeline-column.drag-over {
        background: #e9ecef !important;
        border: 2px dashed #006FC9 !important;
    }
    .pipeline-lead-card {
        cursor: grab;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .pipeline-lead-card:active {
        cursor: grabbing;
    }
    .pipeline-lead-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.08) !important;
    }
    .pipeline-lead-card.dragging {
        opacity: 0.4;
    }
    .view-switcher-btn.active {
        background-color: #006FC9 !important;
        color: #ffffff !important;
        border-color: #006FC9 !important;
    }
    @include('crm.lead.partials.lead-interaction-styles')
</style>

<div class="container-fluid px-4 py-3 pipeline-wrapper">
    {{-- Page Header & Toolbar --}}
    <div class="card border-0 shadow-sm rounded-3 mb-3">
        <div class="card-body p-3">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                {{-- Title & View Switcher --}}
                <div class="d-flex align-items-center gap-3">
                    <h5 class="mb-0 fw-bold text-dark d-flex align-items-center">
                        <i class="ti ti-layout-kanban me-2 text-primary"></i>Created Deals Pipeline
                    </h5>
                    
                    {{-- Dedicated View Switcher (Created Deals Table View <-> Created Deals Pipeline View) --}}
                    <div class="btn-group btn-group-sm" role="group" aria-label="View Switcher">
                        <a href="{{ route('created.deals.index') }}" class="btn btn-outline-primary view-switcher-btn d-flex align-items-center gap-1">
                            <i class="ti ti-list"></i> Table View
                        </a>
                        <button type="button" class="btn btn-primary view-switcher-btn active d-flex align-items-center gap-1">
                            <i class="ti ti-layout-kanban"></i> Pipeline View
                        </button>
                    </div>
                </div>

                {{-- Action / Add Lead Button --}}
                <div>
                    <a href="{{ route('lead.create') }}" class="btn btn-primary btn-sm rounded-2 d-flex align-items-center gap-1">
                        <i class="ti ti-plus"></i> Add New Lead
                    </a>
                </div>
            </div>

            {{-- Filters Bar --}}
            <form id="pipelineFilterForm" class="mt-3 pt-3 border-top border-light">
                <div class="row g-2 align-items-center">
                    {{-- Search Input --}}
                    <div class="col-md-3 col-sm-6">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-light border-end-0"><i class="ti ti-search text-muted"></i></span>
                            <input type="text" name="search" id="pipelineSearchInput" class="form-control bg-light border-start-0 fs-13" placeholder="Search name, phone, email, company..." value="{{ request('search') }}">
                        </div>
                    </div>

                    {{-- Lead Owner Filter --}}
                    <div class="col-md-2 col-sm-6">
                        <select name="owner_id" class="form-select form-select-sm fs-13 pipeline-filter-control">
                            <option value="">All Owners</option>
                            <option value="null" {{ request('owner_id') === 'null' ? 'selected' : '' }}>Unassigned</option>
                            @foreach($owners as $owner)
                                <option value="{{ $owner->id }}" {{ request('owner_id') == $owner->id ? 'selected' : '' }}>
                                    {{ $owner->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Category Filter --}}
                    <div class="col-md-2 col-sm-6">
                        <select name="category_id" class="form-select form-select-sm fs-13 pipeline-filter-control">
                            <option value="">All Categories</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->category_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Source Filter --}}
                    <div class="col-md-2 col-sm-6">
                        <select name="source" class="form-select form-select-sm fs-13 pipeline-filter-control">
                            <option value="">All Sources</option>
                            @foreach($sources as $src)
                                <option value="{{ $src }}" {{ request('source') == $src ? 'selected' : '' }}>
                                    {{ $src }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Date From --}}
                    <div class="col-md-1.5 col-sm-6">
                        <input type="date" name="from" class="form-control form-control-sm fs-13 pipeline-filter-control" placeholder="From Date" value="{{ request('from') }}">
                    </div>

                    {{-- Date To --}}
                    <div class="col-md-1.5 col-sm-6">
                        <input type="date" name="to" class="form-control form-control-sm fs-13 pipeline-filter-control" placeholder="To Date" value="{{ request('to') }}">
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Pipeline Kanban Board --}}
    <div class="pipeline-board" id="pipelineBoard">
        @foreach($buckets as $bucket)
            @php
                $bId = $bucket->id;
                $colData = $columnCards[$bId] ?? ['total' => 0, 'leads' => [], 'has_more' => false, 'next_page' => null];
                $bColor = $bucket->bucket_color ?? '#006FC9';
            @endphp

            <div class="pipeline-column" data-bucket-id="{{ $bId }}">
                {{-- Column Header --}}
                <div class="pipeline-column-header d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2 text-truncate me-2">
                        <span class="rounded-circle d-inline-block" style="width: 10px; height: 10px; background-color: {{ $bColor }};"></span>
                        <h6 class="mb-0 fw-bold text-dark fs-14 text-truncate" title="{{ $bucket->name }}">
                            {{ $bucket->name }}
                        </h6>
                    </div>
                    <span class="badge rounded-pill bg-white text-dark border fs-12 px-2 py-1 col-count-badge" id="col-count-{{ $bId }}">
                        {{ number_format($colData['total']) }}
                    </span>
                </div>

                {{-- Column Scrollable Cards Area --}}
                <div class="pipeline-cards-container" id="col-cards-container-{{ $bId }}" data-bucket-id="{{ $bId }}">
                    <div class="pipeline-cards-list" id="col-cards-list-{{ $bId }}">
                        @forelse($colData['leads'] as $leadItem)
                            @include('crm.lead.pipeline-card', ['lead' => $leadItem])
                        @empty
                            <div class="text-center py-4 text-muted empty-col-msg fs-13">
                                <i class="ti ti-inbox fs-24 d-block mb-1"></i> No deals found
                            </div>
                        @endforelse
                    </div>

                    {{-- Column Loader & Sentinel for Infinite Scroll --}}
                    <div class="pipeline-scroll-sentinel text-center py-2 fs-12 text-muted" 
                         id="col-sentinel-{{ $bId }}"
                         data-bucket-id="{{ $bId }}"
                         data-has-more="{{ $colData['has_more'] ? '1' : '0' }}"
                         data-next-page="{{ $colData['next_page'] ?? '2' }}"
                         style="{{ $colData['has_more'] ? 'display: block;' : 'display: none;' }}">
                        <div class="spinner-border spinner-border-sm text-primary me-1 col-spinner" role="status" style="display: none;">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <span class="sentinel-text fs-12">Loading more...</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@php
    $childBuckets = $buckets;
    $categorys = $categories;
@endphp
@include('crm.lead.partials.lead-interaction-modals')

@endsection

@push('scripts')
<script>
(function() {
    'use strict';

    const cardsUrl = "{{ route('created.deals.pipeline.cards') }}";
    const pipelineUrl = "{{ route('created.deals.pipeline') }}";
    const dragUpdateUrlBase = "{{ url('/created-deals/pipeline/drag-update') }}";

    let debounceTimer = null;
    let loadingColumns = {};

    function initDragAndDrop() {
        const cards = document.querySelectorAll('.pipeline-lead-card');
        const columns = document.querySelectorAll('.pipeline-column');

        cards.forEach(card => {
            card.removeEventListener('dragstart', handleDragStart);
            card.removeEventListener('dragend', handleDragEnd);
            card.addEventListener('dragstart', handleDragStart);
            card.addEventListener('dragend', handleDragEnd);
        });

        columns.forEach(col => {
            col.removeEventListener('dragover', handleDragOver);
            col.removeEventListener('dragleave', handleDragLeave);
            col.removeEventListener('drop', handleDrop);
            col.addEventListener('dragover', handleDragOver);
            col.addEventListener('dragleave', handleDragLeave);
            col.addEventListener('drop', handleDrop);
        });
    }

    let draggedCard = null;

    function handleDragStart(e) {
        draggedCard = this;
        this.classList.add('dragging');
        e.dataTransfer.setData('text/plain', this.getAttribute('data-lead-id'));
        e.dataTransfer.effectAllowed = 'move';
    }

    function handleDragEnd(e) {
        if (draggedCard) {
            draggedCard.classList.remove('dragging');
        }
        document.querySelectorAll('.pipeline-column').forEach(c => c.classList.remove('drag-over'));
    }

    function handleDragOver(e) {
        e.preventDefault();
        e.dataTransfer.dropEffect = 'move';
        const col = e.target.closest('.pipeline-column');
        if (col) {
            col.classList.add('drag-over');
        }
    }

    function handleDragLeave(e) {
        const col = e.target.closest('.pipeline-column');
        if (col) {
            col.classList.remove('drag-over');
        }
    }

    function handleDrop(e) {
        e.preventDefault();
        const targetCol = e.target.closest('.pipeline-column');
        if (!targetCol) return;
        targetCol.classList.remove('drag-over');

        const leadId = e.dataTransfer.getData('text/plain');
        const targetBucketId = targetCol.getAttribute('data-bucket-id');
        const sourceCol = draggedCard ? draggedCard.closest('.pipeline-column') : null;
        const sourceBucketId = sourceCol ? sourceCol.getAttribute('data-bucket-id') : null;

        if (!leadId || !targetBucketId || targetBucketId === sourceBucketId || !draggedCard || !sourceCol) {
            return;
        }

        const targetCardsList = targetCol.querySelector('.pipeline-cards-list');
        const sourceCardsList = sourceCol.querySelector('.pipeline-cards-list');

        if (!targetCardsList || !sourceCardsList) return;

        const emptyMsg = targetCardsList.querySelector('.empty-col-msg');
        if (emptyMsg) {
            emptyMsg.remove();
        }

        draggedCard.setAttribute('data-bucket-id', targetBucketId);
        targetCardsList.prepend(draggedCard);

        if (sourceBucketId) updateColumnCount(sourceBucketId, -1);
        if (targetBucketId) updateColumnCount(targetBucketId, 1);

        fetch(`${dragUpdateUrlBase}/${leadId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                target_bucket_id: targetBucketId
            })
        })
        .then(res => res.json())
        .then(data => {
            if (!data.success) {
                if (sourceBucketId) {
                    draggedCard.setAttribute('data-bucket-id', sourceBucketId);
                }
                sourceCardsList.prepend(draggedCard);
                if (sourceBucketId) updateColumnCount(sourceBucketId, 1);
                if (targetBucketId) updateColumnCount(targetBucketId, -1);
                alert(data.message || 'Failed to update deal status');
            }
        })
        .catch(err => {
            console.error('Drag update error:', err);
            if (sourceBucketId) {
                draggedCard.setAttribute('data-bucket-id', sourceBucketId);
            }
            sourceCardsList.prepend(draggedCard);
            if (sourceBucketId) updateColumnCount(sourceBucketId, 1);
            if (targetBucketId) updateColumnCount(targetBucketId, -1);
        });
    }

    function updateColumnCount(bucketId, delta) {
        const badge = document.getElementById(`col-count-${bucketId}`);
        if (badge) {
            let current = parseInt(badge.textContent.replace(/,/g, '')) || 0;
            current = Math.max(0, current + delta);
            badge.textContent = current.toLocaleString();
        }
    }

    function setupInfiniteScroll() {
        const sentinels = document.querySelectorAll('.pipeline-scroll-sentinel');

        sentinels.forEach(sentinel => {
            const bucketId = sentinel.getAttribute('data-bucket-id');
            const container = document.getElementById(`col-cards-container-${bucketId}`);

            if (!container) return;

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        loadMoreCards(bucketId);
                    }
                });
            }, {
                root: container,
                threshold: 0.1
            });

            observer.observe(sentinel);
        });
    }

    function loadMoreCards(bucketId) {
        const sentinel = document.getElementById(`col-sentinel-${bucketId}`);
        if (!sentinel) return;

        const hasMore = sentinel.getAttribute('data-has-more') === '1';
        const nextPage = parseInt(sentinel.getAttribute('data-next-page')) || 2;

        if (!hasMore || loadingColumns[bucketId]) return;

        loadingColumns[bucketId] = true;
        const spinner = sentinel.querySelector('.col-spinner');
        if (spinner) spinner.style.display = 'inline-block';

        const filterForm = document.getElementById('pipelineFilterForm');
        const formData = new FormData(filterForm);
        const params = new URLSearchParams(formData);
        params.set('bucket_id', bucketId);
        params.set('page', nextPage);

        fetch(`${cardsUrl}?${params.toString()}`, {
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success && data.cards_html) {
                const cardsList = document.getElementById(`col-cards-list-${bucketId}`);
                if (cardsList) {
                    cardsList.insertAdjacentHTML('beforeend', data.cards_html);
                    initDragAndDrop();
                }

                sentinel.setAttribute('data-has-more', data.has_more ? '1' : '0');
                sentinel.setAttribute('data-next-page', data.next_page || (nextPage + 1));
                sentinel.style.display = data.has_more ? 'block' : 'none';
            } else {
                sentinel.setAttribute('data-has-more', '0');
                sentinel.style.display = 'none';
            }
        })
        .catch(err => {
            console.error('Error loading column cards:', err);
        })
        .finally(() => {
            loadingColumns[bucketId] = false;
            if (spinner) spinner.style.display = 'none';
        });
    }

    function initFilters() {
        const form = document.getElementById('pipelineFilterForm');
        const searchInput = document.getElementById('pipelineSearchInput');
        const filterControls = document.querySelectorAll('.pipeline-filter-control');

        filterControls.forEach(ctrl => {
            ctrl.addEventListener('change', () => {
                reloadPipelineBoard();
            });
        });

        if (searchInput) {
            searchInput.addEventListener('input', () => {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => {
                    reloadPipelineBoard();
                }, 400);
            });
        }
    }

    function reloadPipelineBoard() {
        const form = document.getElementById('pipelineFilterForm');
        const formData = new FormData(form);
        const params = new URLSearchParams(formData);

        fetch(`${pipelineUrl}?${params.toString()}`, {
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success && data.columns) {
                Object.keys(data.columns).forEach(bId => {
                    const colInfo = data.columns[bId];
                    const cardsList = document.getElementById(`col-cards-list-${bId}`);
                    const countBadge = document.getElementById(`col-count-${bId}`);
                    const sentinel = document.getElementById(`col-sentinel-${bId}`);

                    if (countBadge) {
                        countBadge.textContent = colInfo.total.toLocaleString();
                    }

                    if (cardsList) {
                        if (colInfo.cards_html) {
                            cardsList.innerHTML = colInfo.cards_html;
                        } else {
                            cardsList.innerHTML = `<div class="text-center py-4 text-muted empty-col-msg fs-13"><i class="ti ti-inbox fs-24 d-block mb-1"></i> No deals found</div>`;
                        }
                    }

                    if (sentinel) {
                        sentinel.setAttribute('data-has-more', colInfo.has_more ? '1' : '0');
                        sentinel.setAttribute('data-next-page', colInfo.next_page || '2');
                        sentinel.style.display = colInfo.has_more ? 'block' : 'none';
                    }
                });

                initDragAndDrop();
            }
        })
        .catch(err => {
            console.error('Pipeline reload error:', err);
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        initDragAndDrop();
        setupInfiniteScroll();
        initFilters();
    });
})();
</script>
@include('crm.lead.partials.lead-interaction-scripts')
@endpush
