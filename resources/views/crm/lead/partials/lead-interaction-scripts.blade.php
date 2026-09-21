<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    async function appConfirm(title, text, confirmButtonText = 'Yes', confirmButtonColor = '#10b981', icon = 'warning') {
        if (window.Swal && typeof Swal.fire === 'function') {
            try {
                const result = await Swal.fire({
                    title: title,
                    text: text,
                    icon: icon,
                    showCancelButton: true,
                    confirmButtonText: confirmButtonText,
                    confirmButtonColor: confirmButtonColor,
                    cancelButtonColor: '#64748b'
                });
                return Boolean(result && (result.isConfirmed || result === true));
            } catch (e) {
                console.warn('Swal error, falling back to confirm:', e);
            }
        }
        return window.confirm(title + (text ? '\n' + text : ''));
    }

    function appToast(type, title) {
        if (window.Swal && typeof Swal.fire === 'function') {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: type === 'error' ? 'error' : (type === 'warning' ? 'warning' : 'success'),
                title: title,
                showConfirmButton: false,
                timer: 2400,
                timerProgressBar: true
            });
        } else {
            console.log('[Notification]', type, title);
        }
    }
    document.addEventListener('DOMContentLoaded', function () {
        const statusScroller = document.getElementById('lead-status-scroll');
        const previousButton = document.querySelector('[data-status-scroll="prev"]');
        const nextButton = document.querySelector('[data-status-scroll="next"]');

        if (!statusScroller || !previousButton || !nextButton) return;

        const updateScrollButtons = () => {
            const maxScrollLeft = Math.max(0, statusScroller.scrollWidth - statusScroller.clientWidth);
            previousButton.disabled = statusScroller.scrollLeft <= 1;
            nextButton.disabled = statusScroller.scrollLeft >= maxScrollLeft - 1;
        };

        previousButton.addEventListener('click', function () {
            statusScroller.scrollBy({ left: -320, behavior: 'smooth' });
        });

        nextButton.addEventListener('click', function () {
            statusScroller.scrollBy({ left: 320, behavior: 'smooth' });
        });

        statusScroller.addEventListener('scroll', updateScrollButtons, { passive: true });
        window.addEventListener('resize', updateScrollButtons);
        updateScrollButtons();
    });

    (function () {
        const initInfiniteScroll = () => {
            const tableBody = document.getElementById('lead-table-body');
            const loader = document.getElementById('lead-infinite-loader');
            if (!tableBody || !loader) return;
            if (loader.dataset.initialized === 'true') return;
            loader.dataset.initialized = 'true';

            const spinner = loader.querySelector('.spinner-border');
            const message = loader.querySelector('.loader-message');
            let nextPageUrl = loader.dataset.nextPage || '';
            let isLoading = false;
            let observer = null;

            const getItemType = () => {
                const path = window.location.pathname.toLowerCase();
                const title = (document.title || '').toLowerCase();
                if (path.includes('deal') || title.includes('deal')) return 'deals';
                if (path.includes('follow') || title.includes('follow')) return 'follow-ups';
                return 'leads';
            };

            const normalizeUrl = (url) => {
                if (!url) return '';
                try {
                    const parsed = new URL(url, window.location.href);
                    return window.location.origin + parsed.pathname + parsed.search;
                } catch (e) {
                    return url;
                }
            };

            const setLoaderState = (state) => {
                if (spinner) spinner.classList.toggle('d-none', state !== 'loading');
                if (!message) return;
                const itemType = getItemType();
                if (state === 'loading') {
                    message.textContent = `Loading more ${itemType}...`;
                } else if (state === 'ready') {
                    message.textContent = `Scroll down or click to load more ${itemType}`;
                } else if (state === 'complete') {
                    message.textContent = `All ${itemType} loaded`;
                } else if (state === 'error') {
                    message.textContent = `Could not load more ${itemType}. Click to retry.`;
                }
            };

            const loadMoreLeads = async () => {
                if (isLoading || !nextPageUrl) return;
                isLoading = true;
                setLoaderState('loading');

                const targetUrl = normalizeUrl(nextPageUrl);

                try {
                    const response = await fetch(targetUrl, {
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    });
                    if (!response.ok) throw new Error('Unable to load entries');

                    const html = await response.text();
                    const parsedDocument = new DOMParser().parseFromString(html, 'text/html');
                    const newRows = parsedDocument.querySelectorAll('#lead-table-body > tr');
                    const nextLoader = parsedDocument.getElementById('lead-infinite-loader');

                    if (newRows.length > 0) {
                        newRows.forEach(row => {
                            if (row.querySelector('td[colspan]')) return;
                            if (row.id && document.getElementById(row.id)) return;
                            tableBody.appendChild(document.adoptNode ? document.adoptNode(row) : row);
                        });
                        if (typeof updateBulkActionsState === 'function') {
                            updateBulkActionsState();
                        }
                    }

                    nextPageUrl = nextLoader ? (nextLoader.dataset.nextPage || nextLoader.getAttribute('data-next-page') || '') : '';
                    loader.dataset.nextPage = nextPageUrl;
                    loader.setAttribute('data-next-page', nextPageUrl);
                    setLoaderState(nextPageUrl ? 'ready' : 'complete');

                    if (observer && nextPageUrl) {
                        observer.unobserve(loader);
                        observer.observe(loader);
                    }

                    if (nextPageUrl) {
                        setTimeout(checkAndLoad, 250);
                    }
                } catch (error) {
                    console.error('Infinite scroll error:', error);
                    setLoaderState('error');
                } finally {
                    isLoading = false;
                }
            };

            const checkAndLoad = () => {
                if (isLoading || !nextPageUrl) return;
                const rect = loader.getBoundingClientRect();
                const vHeight = window.innerHeight || document.documentElement.clientHeight || 800;
                if (rect.top <= vHeight + 600) {
                    loadMoreLeads();
                }
            };

            // 1. Click to load fallback
            loader.style.cursor = 'pointer';
            loader.addEventListener('click', function () {
                if (nextPageUrl && !isLoading) {
                    loadMoreLeads();
                } else if (message && message.textContent.includes('retry')) {
                    loadMoreLeads();
                }
            });

            // 2. IntersectionObserver
            try {
                observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            loadMoreLeads();
                        }
                    });
                }, { rootMargin: '450px 0px', threshold: 0 });

                if (nextPageUrl) observer.observe(loader);
            } catch (e) {
                console.warn('IntersectionObserver not supported, using scroll fallback:', e);
            }

            // 3. Scroll events on window, document, and containers
            window.addEventListener('scroll', checkAndLoad, { passive: true });
            document.addEventListener('scroll', checkAndLoad, { passive: true, capture: true });
            window.addEventListener('resize', checkAndLoad, { passive: true });
            document.querySelectorAll('.nxl-container, .nxl-content, .table-responsive, .main-content').forEach(el => {
                el.addEventListener('scroll', checkAndLoad, { passive: true });
            });

            // 4. Initial check
            if (nextPageUrl) {
                setLoaderState('ready');
                setTimeout(checkAndLoad, 250);
            } else {
                setLoaderState('complete');
            }
        };

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initInfiniteScroll);
        } else {
            initInfiniteScroll();
        }
    })();

    var leadStatusMap = window.leadStatusMap = window.leadStatusMap || @json(
        (isset($childBuckets) ? $childBuckets : collect())->mapWithKeys(function($b) {
            return [$b->name => [
                'id' => $b->id,
                'children' => $b->children ? $b->children->map(function($c) {
                    return ['id' => $c->id, 'name' => $c->name];
                })->values()->toArray() : []
            ]];
        })
    );
    var sharedLeadTagsMap = window.sharedLeadTagsMap = window.sharedLeadTagsMap || @json(
        (isset($leads) ? collect(method_exists($leads, 'items') ? $leads->items() : $leads) : collect())->mapWithKeys(function ($lead) {
            return [$lead->id => $lead->tags->pluck('id')->values()->toArray()];
        })
    );

    // Helper functions for Custom Tag Multi-Select Dropdowns
    function syncTagSelection(context) {
        let wrap = context === 'leadModal' ? document.getElementById('leadTagMultiSelectWrap') : document.getElementById('offcanvasTagMultiSelectWrap');
        if (!wrap) return;
        
        let select = wrap.querySelector(context === 'leadModal' ? '#inp_tags' : '#sharedLeadTagsSelect');
        let chipsContainer = wrap.querySelector(context === 'leadModal' ? '#leadModalSelectedTagsChips' : '#offcanvasSelectedTagsChips');
        let checkboxes = wrap.querySelectorAll('.tag-checkbox');
        
        let selectedTagIds = [];
        let selectedTagsData = [];
        
        checkboxes.forEach(cb => {
            if (cb.checked) {
                selectedTagIds.push(cb.value);
                selectedTagsData.push({
                    id: cb.value,
                    name: cb.dataset.tagName || ('Tag #' + cb.value),
                    color: cb.dataset.tagColor || '#006FC9'
                });
            }
        });
        
        // Sync hidden select options for seamless form submit
        if (select) {
            Array.from(select.options).forEach(opt => {
                opt.selected = selectedTagIds.includes(String(opt.value));
            });
        }
        
        // Render chips
        if (chipsContainer) {
            if (selectedTagsData.length === 0) {
                chipsContainer.innerHTML = `<span class="placeholder-text text-muted fs-12"><i class="fas fa-tag me-1 text-secondary opacity-50"></i>Select tags...</span>`;
            } else {
                chipsContainer.innerHTML = selectedTagsData.map(t => `
                    <span class="badge rounded-pill text-white fs-11 d-inline-flex align-items-center gap-1 py-1 px-2 shadow-2xs" style="background-color: ${t.color}">
                        ${t.name}
                        <i class="fas fa-times-circle ms-1 cursor-pointer" style="cursor:pointer; font-size:11px;" onclick="event.stopPropagation(); uncheckTag('${context}', '${t.id}')"></i>
                    </span>
                `).join('');
            }
        }
    }

    function uncheckTag(context, tagId) {
        let wrap = context === 'leadModal' ? document.getElementById('leadTagMultiSelectWrap') : document.getElementById('offcanvasTagMultiSelectWrap');
        if (!wrap) return;
        let cb = wrap.querySelector(`.tag-checkbox[value="${tagId}"]`);
        if (cb) {
            cb.checked = false;
            syncTagSelection(context);
        }
    }

    function setTagSelection(context, selectedTagIds) {
        let wrap = context === 'leadModal' ? document.getElementById('leadTagMultiSelectWrap') : document.getElementById('offcanvasTagMultiSelectWrap');
        if (!wrap) return;
        let selectedStrList = (selectedTagIds || []).map(String);
        let checkboxes = wrap.querySelectorAll('.tag-checkbox');
        checkboxes.forEach(cb => {
            cb.checked = selectedStrList.includes(String(cb.value));
        });
        syncTagSelection(context);
    }

    function filterTagOptions(input, listId) {
        let q = (input.value || '').toLowerCase().trim();
        let list = document.getElementById(listId);
        if (!list) return;
        let items = list.querySelectorAll('.tag-option-item');
        items.forEach(item => {
            let text = item.textContent.toLowerCase();
            item.style.display = text.includes(q) ? 'flex' : 'none';
        });
    }

    function onOffcanvasMainStatusChange(selectedMainStatus, preselectedSubStatus = '') {
        const subSelect = document.getElementById('editStatusSubSelect');
        const subStatusWrap = document.getElementById('editStatusSubStatusWrap');
        if (!subSelect) return;
        
        subSelect.innerHTML = '';
        
        const parentData = leadStatusMap[selectedMainStatus];
        if (parentData && parentData.children && parentData.children.length > 0) {
            if (subStatusWrap) subStatusWrap.classList.remove('d-none');
            let defaultOpt = document.createElement('option');
            defaultOpt.value = '';
            defaultOpt.textContent = 'Select Sub Status (Required)';
            subSelect.appendChild(defaultOpt);
            
            parentData.children.forEach(child => {
                let opt = document.createElement('option');
                opt.value = child.name;
                opt.textContent = child.name;
                opt.dataset.bucketId = child.id;
                if (preselectedSubStatus && preselectedSubStatus.toLowerCase() === child.name.toLowerCase()) {
                    opt.selected = true;
                }
                subSelect.appendChild(opt);
            });
            subSelect.disabled = false;
            subSelect.required = true;
        } else {
            if (subStatusWrap) subStatusWrap.classList.add('d-none');
            subSelect.value = '';
            subSelect.disabled = true;
            subSelect.required = false;
        }
    }

    function openEditStatusOffcanvas(leadId, leadStatus, engagementStatus, bucketId, bucketName) {
        let offcanvasEl = document.getElementById('editStatusOffcanvas');
        let form = document.getElementById('sharedQuickUpdateForm');
        form.action = "{{ url('/modern-leads/quick-update') }}/" + leadId;
        
        let engSelect = form.querySelector('[name="lead_engagement_status"]');
        if (engSelect) engSelect.value = (engagementStatus || '').toLowerCase();

        // 1. Display Current Stored Status & Bucket Name
        const statusBadge = document.getElementById('currentLeadStatusBadge');
        const bucketBadge = document.getElementById('currentLeadBucketBadge');
        if (statusBadge) statusBadge.textContent = leadStatus || 'None';
        if (bucketBadge) {
            bucketBadge.textContent = bucketName ? 'Bucket: ' + bucketName : '';
            bucketBadge.style.display = bucketName ? 'inline-block' : 'none';
        }
        
        let mainSelect = document.getElementById('editStatusMainSelect');
        let subSelect = document.getElementById('editStatusSubSelect');
        
        const selectedTags = (sharedLeadTagsMap[leadId] || []).map(String);
        setTagSelection('offcanvas', selectedTags);

        let matchedMainStatus = '';
        let matchedSubStatus = '';

        for (let mainName in leadStatusMap) {
            if (mainName.toLowerCase() === (leadStatus || '').toLowerCase()) {
                matchedMainStatus = mainName;
                break;
            }
            let children = leadStatusMap[mainName].children || [];
            let foundChild = children.find(c => c.name.toLowerCase() === (leadStatus || '').toLowerCase());
            if (foundChild) {
                matchedMainStatus = mainName;
                matchedSubStatus = foundChild.name;
                break;
            }
        }

        // If not matched (i.e. status is deleted from master), do not permanently add it to active dropdown
        if (mainSelect) mainSelect.value = matchedMainStatus;
        onOffcanvasMainStatusChange(matchedMainStatus, matchedSubStatus);
        
        let bucketInput = form.querySelector('[name="lead_bucket_id"]') || document.getElementById('editStatusBucketIdInput');
        if (bucketInput) bucketInput.value = bucketId || '';

        form.onsubmit = function(e) {
            let subVal = subSelect ? subSelect.value : '';
            let mainVal = mainSelect ? mainSelect.value : '';
            const pData = leadStatusMap[mainVal];
            if (pData && pData.children && pData.children.length > 0 && !subVal) {
                if (e) e.preventDefault();
                alert('Please select a Sub Status. Main status cannot be selected directly.');
                return false;
            }
            let finalStatus = subVal || mainVal || leadStatus;
            let finalBucketName = mainVal || bucketName || '';
            let finalBucketId = bucketId;

            if (subSelect && subSelect.selectedIndex >= 0) {
                let selectedOpt = subSelect.options[subSelect.selectedIndex];
                if (selectedOpt && selectedOpt.dataset.bucketId) {
                    finalBucketId = selectedOpt.dataset.bucketId;
                }
            } else if (mainVal && leadStatusMap[mainVal]) {
                finalBucketId = leadStatusMap[mainVal].id;
            }

            if (bucketInput && finalBucketId) bucketInput.value = finalBucketId;

            let bucketNameInput = form.querySelector('[name="lead_bucket_name"]') || document.getElementById('editStatusBucketNameInput');
            if (!bucketNameInput) {
                bucketNameInput = document.createElement('input');
                bucketNameInput.type = 'hidden';
                bucketNameInput.name = 'lead_bucket_name';
                form.appendChild(bucketNameInput);
            }
            bucketNameInput.value = finalBucketName;
            
            let hiddenStatusInput = form.querySelector('input[name="lead_status"]') || document.getElementById('editStatusFinalStatusInput');
            if (!hiddenStatusInput) {
                hiddenStatusInput = document.createElement('input');
                hiddenStatusInput.type = 'hidden';
                hiddenStatusInput.name = 'lead_status';
                form.appendChild(hiddenStatusInput);
            }
            hiddenStatusInput.value = finalStatus;
        };

        let bsOffcanvas = bootstrap.Offcanvas.getOrCreateInstance(offcanvasEl);
        bsOffcanvas.show();
    }

    async function convertLeadToDeal(leadId, button) {
        const confirmed = await appConfirm(
            'Convert lead to deal?',
            'The lead will be moved from New Leads to Created Deals & Deal Pipeline with "Deal Created" status.',
            'Yes, Convert',
            '#10b981',
            'question'
        );
        if (!confirmed) return;

        if (button) button.disabled = true;
        try {
            const response = await fetch("{{ url('/new-leads-table') }}/" + leadId + "/convert-deal", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: new URLSearchParams({ _token: '{{ csrf_token() }}' })
            });
            const data = await response.json();
            if (!response.ok || !data.status) throw new Error(data.message || 'Lead conversion failed');

            const row = document.getElementById('lead-row-' + leadId) || (button ? button.closest('tr') : null);
            if (row) {
                row.style.transition = 'all 0.35s ease';
                row.style.opacity = '0';
                row.style.transform = 'translateX(30px)';
                setTimeout(() => { row.remove(); updateBulkActionsState(); }, 350);
            }

            appToast('success', data.message || 'Lead converted to deal successfully');
        } catch (error) {
            if (button) button.disabled = false;
            appToast('error', error.message || 'Lead conversion failed');
        }
    }

    async function executeBulkConvertToDeal() {
        const ids = getSelectedLeadIds();
        if (!ids.length) return;

        const confirmed = await appConfirm(
            `Convert ${ids.length} selected lead(s) to deals?`,
            'Selected leads will be moved from New Leads to Created Deals & Pipeline with "Deal Created" status.',
            `Yes, Convert (${ids.length})`,
            '#10b981',
            'question'
        );
        if (!confirmed) return;

        try {
            const params = new URLSearchParams();
            params.append('_token', '{{ csrf_token() }}');
            ids.forEach(id => params.append('ids[]', id));

            const response = await fetch("{{ url('/new-leads-table/bulk-convert-deal') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: params
            });

            const data = await response.json();
            if (!response.ok || !data.status) throw new Error(data.message || 'Could not convert selected leads');

            ids.forEach(id => {
                const row = document.getElementById('lead-row-' + id);
                if (row) {
                    row.style.transition = 'all 0.3s ease';
                    row.style.opacity = '0';
                    setTimeout(() => row.remove(), 300);
                }
            });
            setTimeout(() => deselectAllRows(), 350);

            appToast('success', data.message || `${ids.length} lead(s) converted to deals`);
        } catch (error) {
            appToast('error', error.message || 'Could not convert selected leads');
        }
    }

    async function updateLeadEngagement(leadId, newEngagement, element) {
        const dropdown = element.closest('.dropdown');
        const toggle = dropdown ? dropdown.querySelector('.dropdown-toggle') : null;
        element.classList.add('disabled');

        try {
            const response = await fetch("{{ url('/lead') }}/" + leadId + "/engagement-status", {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            body: new URLSearchParams({ lead_engagement_status: newEngagement })
            });
            const data = await response.json();
            if (!response.ok || !data.status) throw new Error(data.message || 'Update failed');

            if (toggle) {
                const pillClasses = ['pipeline-pill-new', 'pipeline-pill-hot', 'pipeline-pill-warm', 'pipeline-pill-cold', 'pipeline-pill-dead'];
                const selectedClass = 'pipeline-pill-' + (data.lead_engagement_status || 'new').toLowerCase();
                toggle.classList.remove(...pillClasses);
                toggle.classList.add(selectedClass);
                const label = toggle.querySelector('span');
                if (label) label.textContent = (data.lead_engagement_status || 'new').replace(/^./, char => char.toUpperCase());
                bootstrap.Dropdown.getOrCreateInstance(toggle).hide();
            }

            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: data.message || 'Engagement status updated successfully',
                showConfirmButton: false,
                timer: 2200,
                timerProgressBar: true
            });
        } catch (error) {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: error.message || 'Engagement status update failed',
                showConfirmButton: false,
                timer: 2800
            });
        } finally {
            element.classList.remove('disabled');
        }
    }

    function openTodoOffcanvas(leadId, leadName) {
        let form = document.getElementById('sharedTodoForm');
        form.action = "{{ url('/modern-leads/todo') }}/" + leadId;
        let offcanvasEl = document.getElementById('todoOffcanvas');
        let bsOffcanvas = bootstrap.Offcanvas.getOrCreateInstance(offcanvasEl);
        bsOffcanvas.show();
    }

    function openViewDetailsModalLazy(leadId) {
        let modalEl = document.getElementById('viewLeadDetailsModal');
        let bsModal = bootstrap.Modal.getOrCreateInstance(modalEl);
        
        document.getElementById('vd_leadName').textContent = 'Loading Details...';
        document.getElementById('vd_leadSubtitle').textContent = 'Lead #' + leadId;
        document.getElementById('vd_badges').innerHTML = '';
        document.getElementById('vd_personalInfo').innerHTML = '<div class="col-12 text-center text-muted py-3"><div class="spinner-border spinner-border-sm me-2 text-primary"></div> Loading details...</div>';
        document.getElementById('vd_leadInfo').innerHTML = '<div class="col-12 text-center text-muted py-3"><div class="spinner-border spinner-border-sm me-2 text-primary"></div> Loading details...</div>';
        document.getElementById('vd_addressInfo').innerHTML = '<div class="col-12 text-center text-muted py-3"><div class="spinner-border spinner-border-sm me-2 text-primary"></div> Loading details...</div>';
        
        bsModal.show();

        fetch("{{ url('/modern-leads') }}/" + leadId + "/details-data")
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    let lead = data.lead || {};
                    let user = data.user || {};
                    let owner = data.owner || {};

                    document.getElementById('vd_leadName').textContent = user.name || 'N/A';
                    document.getElementById('vd_leadSubtitle').textContent = (lead.business_name || 'No Business') + ' • Lead ID: #' + lead.id;

                    // Badges - Only Lead's Actual Status (No duplicate/mismatched Bucket)
                    let currentStatus = (lead.lead_status && String(lead.lead_status).trim() !== '') 
                        ? String(lead.lead_status).trim() 
                        : ((lead.bucket && lead.bucket.name) ? lead.bucket.name : 'New');

                    let badgesHtml = `<span class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1 fs-11 fw-semibold"><i class="feather-flag me-1"></i> Status: ${currentStatus}</span>`;
                    document.getElementById('vd_badges').innerHTML = badgesHtml;

                    // Helper field renderer
                    function fItem(icon, label, value) {
                        let val = (value && value !== 'null' && value !== 'undefined') ? value : 'N/A';
                        return `
                            <div class="col-md-4 col-sm-6">
                                <div class="p-2 border rounded bg-light">
                                    <div class="text-muted fs-10 text-uppercase fw-bold mb-0.5"><i class="${icon} me-1 text-primary"></i> ${label}</div>
                                    <div class="fw-semibold text-dark fs-12 text-truncate" title="${val}">${val}</div>
                                </div>
                            </div>`;
                    }

                    // Personal & Contact Info
                    let pInfo = '';
                    pInfo += fItem('feather-user', 'Full Name', user.name);
                    pInfo += fItem('feather-phone', 'Contact No.', user.contact_no);
                    pInfo += fItem('feather-mail', 'Email', user.email);
                    pInfo += fItem('feather-briefcase', 'Business Name', lead.business_name);
                    pInfo += fItem('feather-hash', 'GST Number', lead.gst_number);
                    pInfo += fItem('feather-globe', 'Website', lead.website);
                    document.getElementById('vd_personalInfo').innerHTML = pInfo;

                    // Lead Info & Campaign - Bucket removed, only actual Status shown
                    let lInfo = '';
                    lInfo += fItem('feather-flag', 'Status', currentStatus);
                    lInfo += fItem('feather-user-check', 'Owner', owner.name || 'Unassigned');
                    lInfo += fItem('feather-target', 'Campaign Name', lead.campaign_name);
                    lInfo += fItem('feather-grid', 'Adset Name', lead.adset_name);
                    lInfo += fItem('feather-tv', 'Ad Name', lead.ad_name);
                    lInfo += fItem('feather-file-text', 'Form Name', lead.form_name);
                    lInfo += fItem('feather-layout', 'Platform', lead.platform);
                    lInfo += fItem('feather-book', 'Course Study', lead.what_course_are_you_planning_to_study);
                    lInfo += fItem('feather-dollar-sign', 'Budget', lead.budget);
                    lInfo += fItem('feather-globe', 'Country Visa', lead.applying_country_for_a_visa);
                    document.getElementById('vd_leadInfo').innerHTML = lInfo;

                    // Address Info
                    let aInfo = '';
                    aInfo += fItem('feather-map-pin', 'City', lead.city);
                    aInfo += fItem('feather-map', 'State', lead.state);
                    aInfo += fItem('feather-hash', 'Pincode', lead.pincode);
                    aInfo += fItem('feather-home', 'Address', lead.address);
                    document.getElementById('vd_addressInfo').innerHTML = aInfo;
                }
            })
            .catch(err => {
                document.getElementById('vd_personalInfo').innerHTML = '<div class="col-12 text-danger py-2 fs-12">Failed to load lead details.</div>';
            });
    }

    async function assignLeadOwner(leadId, selectElement) {
        const ownerId = selectElement.value;
        if (!ownerId) return;

        const ownerName = selectElement.options[selectElement.selectedIndex]?.text || 'N/A';
        selectElement.disabled = true;

        try {
            const response = await fetch("{{ route('lead.bulkOwnerUpdate') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: new URLSearchParams({ lead_ids: leadId, lead_owner: ownerId })
            });
            if (!response.ok) throw new Error('Owner update failed');

            const ownerCell = document.querySelector(`[data-owner-cell="${leadId}"]`);
            if (ownerCell) {
                ownerCell.innerHTML = `
                    <div class="d-flex align-items-center gap-1.5">
                        <div class="rounded-circle bg-secondary-subtle text-secondary d-flex align-items-center justify-content-center fw-bold fs-11" style="width:24px;height:24px;">${ownerName.charAt(0).toUpperCase()}</div>
                        <span class="fs-12 text-dark"></span>
                    </div>`;
                ownerCell.querySelector('span').textContent = ownerName;
            }
        } catch (error) {
            selectElement.disabled = false;
            selectElement.value = '';
            alert('Failed to update lead owner. Please try again.');
        }
    }

    var LEAD_FORM_DRAFT_KEY = window.LEAD_FORM_DRAFT_KEY = window.LEAD_FORM_DRAFT_KEY || 'crm_create_lead_draft_v1';
    let draftSaveTimeout = null;

    function saveLeadFormDraft() {
        const form = document.getElementById('leadForm');
        if (!form) return;
        const methodInput = document.getElementById('formMethod');
        if (methodInput && methodInput.value !== 'POST') return;

        const data = {
            name: form.querySelector('#inp_name')?.value || '',
            mobile: form.querySelector('#inp_mobile')?.value || '',
            country_code: form.querySelector('#inp_country_code')?.value || '',
            email: form.querySelector('#inp_email')?.value || '',
            business_name: form.querySelector('#inp_business')?.value || '',
            city: form.querySelector('#inp_city')?.value || '',
            state: form.querySelector('#inp_state')?.value || '',
            pincode: form.querySelector('#inp_pincode')?.value || '',
            address: form.querySelector('#inp_address')?.value || '',
            employee_strength: form.querySelector('#inp_employee_strength')?.value || '',
            industry: form.querySelector('#inp_industry')?.value || '',
            website: form.querySelector('#inp_website')?.value || '',
            gst_number: form.querySelector('#inp_gst')?.value || '',
            lead_source: form.querySelector('#inp_lead_source')?.value || '',
            lead_owner: form.querySelector('#inp_lead_owner')?.value || '',
            budget: form.querySelector('#inp_budget')?.value || '',
            product: form.querySelector('#inp_product')?.value || '',
            services: Array.from(form.querySelector('#inp_services')?.selectedOptions || []).map(o => o.value),
            pain_points: window.painPointsQuill ? window.painPointsQuill.root.innerHTML : (form.querySelector('#inp_pain_points')?.value || ''),
            tags: (function() {
                const wrap = document.getElementById('leadTagMultiSelectWrap');
                if (!wrap) return [];
                return Array.from(wrap.querySelectorAll('.tag-checkbox:checked')).map(cb => cb.value);
            })(),
            modalOpen: true,
            savedAt: Date.now()
        };

        const hasAnyContent = Boolean(data.name || data.mobile || data.email || data.business_name || data.city || data.address || data.website || data.budget);
        if (hasAnyContent) {
            localStorage.setItem(LEAD_FORM_DRAFT_KEY, JSON.stringify(data));
            const draftBadge = document.getElementById('leadDraftBadge');
            const clearBtn = document.getElementById('btnClearDraft');
            if (draftBadge) draftBadge.classList.remove('d-none');
            if (clearBtn) clearBtn.classList.remove('d-none');
        }
    }

    function restoreLeadFormDraft() {
        try {
            const raw = localStorage.getItem(LEAD_FORM_DRAFT_KEY);
            if (!raw) return false;
            const data = JSON.parse(raw);
            if (!data || typeof data !== 'object') return false;

            const form = document.getElementById('leadForm');
            if (!form) return false;

            const setVal = (id, val) => {
                const el = form.querySelector(id);
                if (el && val !== undefined && val !== null) el.value = val;
            };

            setVal('#inp_name', data.name);
            setVal('#inp_mobile', data.mobile);
            setVal('#inp_country_code', data.country_code);
            setVal('#inp_email', data.email);
            setVal('#inp_business', data.business_name);
            setVal('#inp_city', data.city);
            setVal('#inp_state', data.state);
            setVal('#inp_pincode', data.pincode);
            setVal('#inp_address', data.address);
            setVal('#inp_employee_strength', data.employee_strength);
            setVal('#inp_industry', data.industry);
            setVal('#inp_website', data.website);
            setVal('#inp_gst', data.gst_number);
            setVal('#inp_lead_source', data.lead_source);
            setVal('#inp_lead_owner', data.lead_owner);
            setVal('#inp_budget', data.budget);
            setVal('#inp_product', data.product);

            if (Array.isArray(data.services) && data.services.length) {
                const servicesSelect = form.querySelector('#inp_services');
                if (servicesSelect) {
                    Array.from(servicesSelect.options).forEach(opt => {
                        opt.selected = data.services.includes(opt.value);
                    });
                    if (window.jQuery) window.jQuery(servicesSelect).trigger('change');
                }
            }

            if (Array.isArray(data.tags)) {
                setTagSelection('leadModal', data.tags);
            }

            if (data.pain_points) {
                const painPointsInput = form.querySelector('#inp_pain_points');
                if (painPointsInput) painPointsInput.value = data.pain_points;
                if (window.painPointsQuill) window.painPointsQuill.root.innerHTML = data.pain_points;
            }

            const draftBadge = document.getElementById('leadDraftBadge');
            const clearBtn = document.getElementById('btnClearDraft');
            if (draftBadge) draftBadge.classList.remove('d-none');
            if (clearBtn) clearBtn.classList.remove('d-none');

            return true;
        } catch (e) {
            console.warn('Could not restore lead draft:', e);
            return false;
        }
    }

    function clearLeadFormDraft(andResetForm = false) {
        localStorage.removeItem(LEAD_FORM_DRAFT_KEY);
        const draftBadge = document.getElementById('leadDraftBadge');
        const clearBtn = document.getElementById('btnClearDraft');
        if (draftBadge) draftBadge.classList.add('d-none');
        if (clearBtn) clearBtn.classList.add('d-none');

        if (andResetForm) {
            const form = document.getElementById('leadForm');
            if (form) {
                form.reset();
                const servicesSelect = form.querySelector('#inp_services');
                if (servicesSelect) {
                    Array.from(servicesSelect.options).forEach(opt => opt.selected = false);
                    if (window.jQuery) window.jQuery(servicesSelect).trigger('change');
                }
                setTagSelection('leadModal', []);
                const painPointsInput = form.querySelector('#inp_pain_points');
                if (painPointsInput) painPointsInput.value = '';
                if (window.painPointsQuill) window.painPointsQuill.root.innerHTML = '';
            }
        }
    }

    function openCreateModal(forceReset = false) {
        const modalElement = document.getElementById('leadModal');
        const form = document.getElementById('leadForm');
        if (!modalElement || !form) {
            alert('Failed to load lead form. Please refresh and try again.');
            return;
        }

        form.action = "{{ route('lead.store') }}";

        const methodInput = document.getElementById('formMethod');
        if (methodInput) methodInput.value = 'POST';

        const title = modalElement.querySelector('#leadModalTitle span');
        if (title) title.textContent = 'Create New Lead';

        const submitButton = modalElement.querySelector('#btnSubmit');
        if (submitButton) {
            submitButton.textContent = 'Create Lead';
            submitButton.disabled = false;
        }

        const clonedContacts = modalElement.querySelector('#clonedContactsContainer');
        if (clonedContacts) clonedContacts.innerHTML = '';

        const contactCount = modalElement.querySelector('#contactCountBadge');
        if (contactCount) contactCount.textContent = '0';

        if (forceReset) {
            clearLeadFormDraft(true);
        } else {
            const hasRestored = restoreLeadFormDraft();
            if (!hasRestored) {
                form.reset();
                const servicesSelect = modalElement.querySelector('#inp_services');
                if (servicesSelect) {
                    Array.from(servicesSelect.options).forEach(option => option.selected = false);
                    if (window.jQuery) window.jQuery(servicesSelect).trigger('change');
                }
                setTagSelection('leadModal', []);

                const documentsInput = modalElement.querySelector('#inp_documents');
                if (documentsInput) documentsInput.value = '';

                const existingDocuments = modalElement.querySelector('#existing_documents_container');
                if (existingDocuments) existingDocuments.innerHTML = '';

                const painPointsInput = modalElement.querySelector('#inp_pain_points');
                if (painPointsInput) painPointsInput.value = '';
                if (window.painPointsQuill) window.painPointsQuill.root.innerHTML = '';
            }
        }

        bootstrap.Modal.getOrCreateInstance(modalElement).show();
    }

    async function handleLeadFormSubmit(e) {
        const form = e.target;
        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }
        e.preventDefault();
        const submitButton = form.querySelector('#btnSubmit');
        const originalText = submitButton ? submitButton.textContent : 'Save';

        if (window.painPointsQuill) {
            const html = window.painPointsQuill.root.innerHTML;
            const painPointsInput = form.querySelector('#inp_pain_points');
            if (painPointsInput) {
                painPointsInput.value = (html === '<p><br></p>' || !html.trim()) ? '' : html;
            }
        }

        if (submitButton) {
            submitButton.disabled = true;
            submitButton.innerHTML = '<span class="spinner-border spinner-border-sm me-1.5" role="status"></span> Saving...';
        }

        try {
            const formData = new FormData(form);
            const response = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: formData
            });

            const data = await response.json();

            if (!response.ok || data.status !== 'success') {
                let errorMsg = data.message || 'Failed to save lead.';
                if (data.errors) {
                    const firstKey = Object.keys(data.errors)[0];
                    if (firstKey && data.errors[firstKey].length) {
                        errorMsg = data.errors[firstKey][0];
                    }
                }
                throw new Error(errorMsg);
            }

            // SUCCESS!
            clearLeadFormDraft(false);

            const modalElement = document.getElementById('leadModal');
            const modalInstance = bootstrap.Modal.getInstance(modalElement);
            if (modalInstance) modalInstance.hide();

            form.reset();
            appToast('success', data.message || 'Lead saved successfully');

            // Real-time background refresh without full page reload
            await refreshActiveLeadView();

        } catch (error) {
            // Keep modal open and all fields intact!
            appToast('error', error.message || 'An error occurred while saving.');
        } finally {
            if (submitButton) {
                submitButton.disabled = false;
                submitButton.textContent = originalText;
            }
        }
    }

    async function refreshActiveLeadView() {
        try {
            const currentUrl = window.location.href;
            const response = await fetch(currentUrl, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });
            if (!response.ok) return;
            const html = await response.text();
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');

            const currentTableBody = document.getElementById('lead-table-body');
            const currentBoard = document.getElementById('pipelineBoard');

            // Fallback for any other page: reload page cleanly
            if (!currentTableBody && !currentBoard) {
                window.location.reload();
                return;
            }

            // 1. Table view: update #lead-table-body
            const newTableBody = doc.getElementById('lead-table-body');
            if (newTableBody && currentTableBody) {
                currentTableBody.innerHTML = newTableBody.innerHTML;
            }

            // Status bar (scroll tabs)
            const newStatusScroll = doc.getElementById('lead-status-scroll');
            const currentStatusScroll = document.getElementById('lead-status-scroll');
            if (newStatusScroll && currentStatusScroll) {
                currentStatusScroll.innerHTML = newStatusScroll.innerHTML;
            }

            // Total counter if present
            const newTotalBadge = doc.querySelector('.system-total-badge');
            const currentTotalBadge = document.querySelector('.system-total-badge');
            if (newTotalBadge && currentTotalBadge) {
                currentTotalBadge.textContent = newTotalBadge.textContent;
            }

            // 2. Pipeline view: update columns
            const newBoard = doc.getElementById('pipelineBoard');
            if (newBoard && currentBoard) {
                newBoard.querySelectorAll('.pipeline-column').forEach(newCol => {
                    const bId = newCol.getAttribute('data-bucket-id');
                    const curCol = currentBoard.querySelector(`.pipeline-column[data-bucket-id="${bId}"]`);
                    if (curCol) {
                        const newCount = newCol.querySelector('.col-count-badge');
                        const curCount = curCol.querySelector('.col-count-badge');
                        if (newCount && curCount) curCount.textContent = newCount.textContent;

                        const newCards = newCol.querySelector('.pipeline-cards-list');
                        const curCards = curCol.querySelector('.pipeline-cards-list');
                        if (newCards && curCards) {
                            curCards.innerHTML = newCards.innerHTML;
                        }
                    }
                });
            }

            if (typeof updateBulkActionsState === 'function') {
                updateBulkActionsState();
            }
        } catch (e) {
            console.warn('Real-time background refresh error:', e);
        }
    }

    async function openLeadEditModal(leadId) {
        try {
            const modalElement = document.getElementById('leadModal');
            if (!modalElement) throw new Error('Shared lead modal not found');

            const detailsResponse = await fetch("{{ url('/modern-leads') }}/" + leadId + "/details-data");
            const data = await detailsResponse.json();
            if (data.status !== 'success') throw new Error('Lead details unavailable');

            const lead = data.lead || {};
            const user = data.user || {};
            const form = modalElement.querySelector('#leadForm');
            const setValue = (selector, value) => {
                const field = modalElement.querySelector(selector);
                if (field) field.value = value == null ? '' : value;
            };

            form.action = "{{ url('/lead/update') }}/" + leadId;
            setValue('#formMethod', 'PUT');
            const draftBadge = document.getElementById('leadDraftBadge');
            const clearBtn = document.getElementById('btnClearDraft');
            if (draftBadge) draftBadge.classList.add('d-none');
            if (clearBtn) clearBtn.classList.add('d-none');
            const title = modalElement.querySelector('#leadModalTitle span');
            if (title) title.textContent = 'Edit Lead: ' + (user.name || 'N/A');
            const submitButton = modalElement.querySelector('#btnSubmit');
            if (submitButton) submitButton.textContent = 'Update Lead';

            setValue('#inp_mobile', user.contact_no);
            setValue('#inp_country_code', user.country_code);
            setValue('#inp_name', user.name);
            setValue('#inp_email', user.email);
            setValue('#inp_city', lead.city || user.city);
            setValue('#inp_state', lead.state || user.state);
            setValue('#inp_pincode', lead.pincode || user.pincode);
            setValue('#inp_address', lead.address || user.address);
            setValue('#inp_platform', lead.platform);
            setValue('#inp_owner', lead.lead_owner);
            if (lead.budget) {
                let rawBudget = String(lead.budget).trim();
                let detectedCurrency = '₹';
                if (rawBudget.startsWith('$')) detectedCurrency = '$';
                else if (rawBudget.startsWith('€')) detectedCurrency = '€';
                else if (rawBudget.startsWith('£')) detectedCurrency = '£';
                else if (rawBudget.startsWith('₹')) detectedCurrency = '₹';
                if (typeof changeBudgetCurrency === 'function') changeBudgetCurrency(detectedCurrency);
                let cleanVal = rawBudget.replace(/^[₹$€£]\s*/, '');
                setValue('#inp_budget', cleanVal);
            } else {
                if (typeof changeBudgetCurrency === 'function') changeBudgetCurrency('₹');
                setValue('#inp_budget', '');
            }
            setValue('#inp_employee_strength', lead.employee_strength);
            setValue('#inp_industry', lead.industry);
            setValue('#inp_website', lead.website);
            setValue('#inp_business', lead.business_name);
            setValue('#inp_gst', lead.gst_number);
            setValue('#inp_product', lead.product || lead.applying_country_for_a_visa);
            setValue('#inp_pain_points', lead.pain_points || lead.description);

            const bucketSelect = modalElement.querySelector('.bucket-select');
            if (bucketSelect) bucketSelect.value = lead.lead_bucket_id || '';
            const statusSelect = modalElement.querySelector('.status-select');
            if (statusSelect && lead.lead_status) {
                const matchingStatus = Array.from(statusSelect.options).find(option => option.value === lead.lead_status);
                if (matchingStatus) statusSelect.value = lead.lead_status;
            }

            const servicesSelect = modalElement.querySelector('#inp_services');
            if (servicesSelect && lead.category_id) {
                Array.from(servicesSelect.options).forEach(option => {
                    option.selected = String(option.value) === String(lead.category_id);
                });
            }
            
            const selectedTagIds = (lead.tags || []).map(tag => String(tag.id));
            setTagSelection('leadModal', selectedTagIds);

            bootstrap.Modal.getOrCreateInstance(modalElement).show();
        } catch (error) {
            alert('Failed to load lead edit modal. Please try again.');
        }
    }

    function switchCommentsTab(tabName) {
        const commentsTabBtn = document.getElementById('cm_tab_comments_btn');
        const statusTabBtn = document.getElementById('cm_tab_status_btn');
        if (!commentsTabBtn || !statusTabBtn) return;

        if (tabName === 'status' || tabName === 'status_history') {
            const tab = bootstrap.Tab.getOrCreateInstance(statusTabBtn);
            tab.show();
        } else {
            const tab = bootstrap.Tab.getOrCreateInstance(commentsTabBtn);
            tab.show();
        }
    }
    window.switchCommentsTab = switchCommentsTab;

    function openCommentsModal(leadId, leadName, initialTab = 'comments') {
        let offcanvasEl = document.getElementById('commentsOffcanvas');
        let commentsOffcanvas = bootstrap.Offcanvas.getOrCreateInstance(offcanvasEl);
        
        const cleanLeadName = (leadName || '').trim();
        const titleEl = document.getElementById('cm_leadName');
        if (titleEl) titleEl.textContent = (cleanLeadName || 'Lead') + ' - Activity & History';

        const initialEl = document.getElementById('cm_leadInitial');
        if (initialEl) {
            initialEl.textContent = cleanLeadName ? cleanLeadName.charAt(0).toUpperCase() : 'L';
        }
        
        const commentsTabPane = document.getElementById('cm_tab_comments');
        const statusTabPane = document.getElementById('cm_tab_status');
        const badgeCommentsCount = document.getElementById('cm_badge_comments_count');
        const badgeStatusCount = document.getElementById('cm_badge_status_count');

        if (commentsTabPane) {
            commentsTabPane.innerHTML = '<div class="text-center py-5 text-muted fs-13"><div class="spinner-border spinner-border-sm me-2 text-primary"></div> Loading communication & remarks...</div>';
        }
        if (statusTabPane) {
            statusTabPane.innerHTML = '<div class="text-center py-5 text-muted fs-13"><div class="spinner-border spinner-border-sm me-2 text-primary"></div> Loading status change history...</div>';
        }
        
        switchCommentsTab(initialTab);
        commentsOffcanvas.show();

        const getAvatarPalette = (name) => {
            const palettes = [
                { bg: '#eff6ff', color: '#1d4ed8', border: '#bfdbfe' },
                { bg: '#f5f3ff', color: '#6d28d9', border: '#ddd6fe' },
                { bg: '#ecfdf5', color: '#047857', border: '#a7f3d0' },
                { bg: '#fff7ed', color: '#c2410c', border: '#ffedd5' },
                { bg: '#fdf2f8', color: '#be185d', border: '#fbcfe8' },
                { bg: '#f0fdfa', color: '#0f766e', border: '#99f6e4' }
            ];
            let code = 0;
            const str = String(name || '');
            for (let i = 0; i < str.length; i++) code += str.charCodeAt(i);
            return palettes[code % palettes.length];
        };

        fetch("{{ url('/modern-leads') }}/" + leadId + "/details-data")
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    const escapeHistoryHtml = (value) => {
                        const element = document.createElement('div');
                        element.textContent = value == null ? '' : String(value);
                        return element.innerHTML;
                    };

                    let rawMessages = data.messages || [];

                    // =========================================================
                    // TAB 1: Communication & Remarks (Excluded pure status changes)
                    // =========================================================
                    let messages = rawMessages.filter(msg => {
                        const rawMsgText = (msg.message || '').trim().toLowerCase();
                        const isPureStatusLog = (
                            rawMsgText.startsWith('status changed') || 
                            rawMsgText.startsWith('status set to') ||
                            rawMsgText.includes('converted to deal')
                        ) && !msg.followup_type && !msg.call_recording && (!Array.isArray(msg.followup_documents) || msg.followup_documents.length === 0);

                        if (isPureStatusLog) return false;

                        const hasMessage = msg.message && msg.message.trim() !== '';
                        const hasFollowup = msg.followup_type && msg.followup_type.trim() !== '';
                        const hasNextDate = msg.next_followup_date || msg.next_followup_date_formatted;
                        const hasDocs = Array.isArray(msg.followup_documents) && msg.followup_documents.length > 0;
                        const hasAudio = msg.call_recording && msg.call_recording.trim() !== '';
                        return hasMessage || hasFollowup || hasNextDate || hasDocs || hasAudio;
                    });

                    if (badgeCommentsCount) badgeCommentsCount.textContent = messages.length;

                    if (!commentsTabPane) return;

                    if (messages.length === 0) {
                        commentsTabPane.innerHTML = `
                            <div class="text-center py-5 px-3 bg-white rounded-3 border">
                                <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-light mb-3" style="width: 52px; height: 52px;">
                                    <i class="feather-message-square text-muted fs-3 opacity-50"></i>
                                </div>
                                <h6 class="fw-bold text-dark fs-13 mb-1">No Activity Records Yet</h6>
                                <p class="text-muted fs-12 mb-0">No communication, comments, or follow-ups found for this lead.</p>
                            </div>`;
                    } else {
                        let html = `
                            <div class="cm-history-summary">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="d-flex align-items-center justify-content-center rounded-2 bg-primary-subtle text-primary" style="width: 28px; height: 28px;">
                                        <i class="feather-message-circle fs-13"></i>
                                    </span>
                                    <div>
                                        <span class="fw-bold text-dark fs-12 d-block leading-tight">Communication & Remarks</span>
                                        <small class="text-muted fs-11">Interaction logs & notes</small>
                                    </div>
                                </div>
                                <span class="badge bg-primary rounded-pill px-2.5 py-1 fs-11 fw-semibold">${messages.length} ${messages.length === 1 ? 'Entry' : 'Entries'}</span>
                            </div>
                            <div class="cm-timeline">`;

                        messages.forEach((msg, index) => {
                            const rawUserName = (msg.user_name || 'System User').trim();
                            const userName = escapeHistoryHtml(rawUserName);
                            const userInitial = escapeHistoryHtml(rawUserName.charAt(0).toUpperCase() || 'U');
                            const palette = getAvatarPalette(rawUserName);

                            const activityDate = escapeHistoryHtml(msg.created_at_formatted || 'Date unavailable');
                            const message = escapeHistoryHtml(msg.message || '');
                            const followupType = escapeHistoryHtml(msg.followup_type || '');
                            const followupStatus = escapeHistoryHtml(msg.followup_status || '');
                            const nextFollowup = escapeHistoryHtml(msg.next_followup_date_formatted || msg.next_followup_date || '');
                            const docs = Array.isArray(msg.followup_documents) ? msg.followup_documents : [];
                            const callAudio = msg.call_recording || null;

                            const fTypeLower = followupType.toLowerCase();
                            let nodeIcon = 'feather-message-square';
                            let nodeClass = 'node-note';
                            if (fTypeLower.includes('call')) {
                                nodeIcon = 'feather-phone';
                                nodeClass = 'node-call';
                            } else if (fTypeLower.includes('mail')) {
                                nodeIcon = 'feather-mail';
                                nodeClass = 'node-call';
                            } else if (fTypeLower.includes('whats') || fTypeLower.includes('chat')) {
                                nodeIcon = 'feather-message-circle';
                                nodeClass = 'node-call';
                            }

                            const fStatusLower = followupStatus.toLowerCase();
                            let statusChipClass = 'chip-info';
                            if (fStatusLower.includes('unanswer') || fStatusLower.includes('busy') || fStatusLower.includes('reject') || fStatusLower.includes('no response') || fStatusLower.includes('not answer') || fStatusLower.includes('missed')) {
                                statusChipClass = 'chip-danger';
                            } else if (fStatusLower.includes('answer') || fStatusLower.includes('connect') || fStatusLower.includes('interest') || fStatusLower.includes('won') || fStatusLower.includes('done')) {
                                statusChipClass = 'chip-success';
                            }

                            html += `
                                <div class="cm-timeline-item">
                                    <span class="cm-timeline-node ${nodeClass}">
                                        <i class="${nodeIcon}"></i>
                                    </span>
                                    <div class="cm-card">
                                        <div class="cm-card-header">
                                            <div class="d-flex align-items-center gap-2 overflow-hidden">
                                                <div class="cm-user-avatar" style="background: ${palette.bg}; color: ${palette.color}; border: 1px solid ${palette.border};">
                                                    ${userInitial}
                                                </div>
                                                <div class="d-flex align-items-center gap-1.5 overflow-hidden">
                                                    <span class="fw-bold text-dark fs-12 text-truncate">${userName}</span>
                                                    <span class="badge bg-light text-secondary border fs-10 px-1.5 py-0.5 rounded">#${index + 1}</span>
                                                </div>
                                            </div>
                                            <div class="text-muted fs-11 text-nowrap d-flex align-items-center gap-1 flex-shrink-0">
                                                <i class="feather-clock fs-11 opacity-75"></i>
                                                <span>${activityDate}</span>
                                            </div>
                                        </div>
                                        <div class="cm-card-body">
                                            ${message ? `<div class="cm-message-box mb-2">${message}</div>` : ''}

                                            ${(followupType || followupStatus || nextFollowup) ? `
                                                <div class="d-flex align-items-center gap-1.5 flex-wrap ${message ? 'pt-2 mt-1 border-top' : ''}">
                                                    ${followupType ? `
                                                        <span class="cm-chip chip-type">
                                                            <i class="${nodeIcon} text-primary" style="font-size: 11px;"></i>
                                                            <span>${followupType}</span>
                                                        </span>` : ''}
                                                    ${followupStatus ? `
                                                        <span class="cm-chip ${statusChipClass}">
                                                            <span class="cm-chip-dot"></span>
                                                            <span>${followupStatus}</span>
                                                        </span>` : ''}
                                                    ${nextFollowup ? `
                                                        <span class="cm-chip chip-next ms-auto">
                                                            <i class="feather-calendar text-warning" style="font-size: 11px;"></i>
                                                            <span>Next: ${nextFollowup}</span>
                                                        </span>` : ''}
                                                </div>` : ''}

                                            ${callAudio ? `
                                                <div class="mt-2.5 pt-2 border-top">
                                                    <div class="d-flex align-items-center gap-1 text-secondary fs-11 fw-semibold mb-1.5">
                                                        <i class="feather-mic text-primary"></i>
                                                        <span>Call Recording</span>
                                                    </div>
                                                    <div class="p-1.5 bg-light rounded-2 border">
                                                        <audio controls class="w-100" style="height: 32px;" src="${callAudio}"></audio>
                                                    </div>
                                                </div>` : ''}

                                            ${docs.length > 0 ? `
                                                <div class="mt-2.5 pt-2 border-top">
                                                    <div class="d-flex align-items-center gap-1 text-secondary fs-11 fw-semibold mb-1.5">
                                                        <i class="feather-paperclip text-primary"></i>
                                                        <span>Attachments (${docs.length})</span>
                                                    </div>
                                                    <div class="d-flex flex-wrap gap-1.5">
                                                        ${docs.map(doc => {
                                                            let docPath = typeof doc === 'object' ? doc.path : doc;
                                                            let docName = typeof doc === 'object' ? (doc.name || doc.file_name) : (docPath ? docPath.split('/').pop() : 'Attachment');
                                                            let viewUrl = "{{ route('document.view') }}?path=" + encodeURIComponent(docPath);
                                                            return `<a href="${viewUrl}" target="_blank" class="cm-doc-chip">
                                                                <i class="feather-file text-primary fs-11"></i>
                                                                <span class="text-truncate" style="max-width: 160px;">${escapeHistoryHtml(docName)}</span>
                                                                <i class="feather-download text-muted fs-10 ms-0.5"></i>
                                                            </a>`;
                                                        }).join('')}
                                                    </div>
                                                </div>` : ''}
                                        </div>
                                    </div>
                                </div>`;
                        });
                        html += `</div>`;
                        commentsTabPane.innerHTML = html;
                    }

                    // =========================================================
                    // TAB 2: Status Change History
                    // =========================================================
                    let statusHistoryList = [];

                    // 1. Collect from rawMessages
                    rawMessages.forEach(msg => {
                        const rawMsgText = (msg.message || '').trim().toLowerCase();
                        const isStatusMsg = rawMsgText.includes('status changed') || 
                                           rawMsgText.includes('status set to') || 
                                           rawMsgText.includes('converted to deal');
                        const hasStatusField = (msg.status && msg.status.trim() !== '') || (msg.bucket && msg.bucket.trim() !== '');

                        if (isStatusMsg || hasStatusField) {
                            statusHistoryList.push({
                                source: 'callback',
                                user_name: msg.user_name || 'System User',
                                created_at_formatted: msg.created_at_formatted || 'Date unavailable',
                                status: msg.status || '',
                                bucket: msg.bucket || '',
                                message: msg.message || '',
                                raw_date: msg.created_at_raw || ''
                            });
                        }
                    });

                    // 2. Collect from audit logs (LeadHistory)
                    if (Array.isArray(data.statusHistories)) {
                        data.statusHistories.forEach(h => {
                            const ch = h.changes || {};
                            statusHistoryList.push({
                                source: 'audit',
                                user_name: h.user_name || 'System User',
                                created_at_formatted: h.created_at_formatted || 'Date unavailable',
                                from_status: ch.from_status || '',
                                to_status: ch.to_status || '',
                                from_bucket: ch.from_bucket || '',
                                to_bucket: ch.to_bucket || '',
                                message: h.action === 'pipeline_drag_update' ? 'Updated via Kanban Drag & Drop' : '',
                                raw_date: ''
                            });
                        });
                    }

                    if (badgeStatusCount) badgeStatusCount.textContent = statusHistoryList.length;

                    if (!statusTabPane) return;

                    if (statusHistoryList.length === 0) {
                        statusTabPane.innerHTML = `
                            <div class="text-center py-5 px-3 bg-white rounded-3 border">
                                <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-light mb-3" style="width: 52px; height: 52px;">
                                    <i class="feather-git-commit text-muted fs-3 opacity-50"></i>
                                </div>
                                <h6 class="fw-bold text-dark fs-13 mb-1">No Status Changes Yet</h6>
                                <p class="text-muted fs-12 mb-0">No status change history recorded yet for this lead.</p>
                            </div>`;
                    } else {
                        let sHtml = `
                            <div class="cm-history-summary">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="d-flex align-items-center justify-content-center rounded-2 bg-primary-subtle text-primary" style="width: 28px; height: 28px;">
                                        <i class="feather-git-commit fs-13"></i>
                                    </span>
                                    <div>
                                        <span class="fw-bold text-dark fs-12 d-block leading-tight">Status Change Timeline</span>
                                        <small class="text-muted fs-11">State transitions & updates</small>
                                    </div>
                                </div>
                                <span class="badge bg-primary rounded-pill px-2.5 py-1 fs-11 fw-semibold">${statusHistoryList.length} ${statusHistoryList.length === 1 ? 'Record' : 'Records'}</span>
                            </div>
                            <div class="cm-timeline">`;

                        statusHistoryList.forEach((st, idx) => {
                            const rawUserName = (st.user_name || 'System User').trim();
                            const userName = escapeHistoryHtml(rawUserName);
                            const userInitial = escapeHistoryHtml(rawUserName.charAt(0).toUpperCase() || 'U');
                            const palette = getAvatarPalette(rawUserName);

                            const dateStr = escapeHistoryHtml(st.created_at_formatted || 'Date unavailable');
                            const message = escapeHistoryHtml(st.message || '');
                            const fromStatus = escapeHistoryHtml(st.from_status || '');
                            const toStatus = escapeHistoryHtml(st.to_status || '');
                            const currentStatus = escapeHistoryHtml(st.status || '');
                            const bucketName = escapeHistoryHtml(st.bucket || '');

                            let transitionContent = '';
                            if (fromStatus && toStatus && fromStatus !== toStatus) {
                                transitionContent = `
                                    <div class="d-flex align-items-center gap-2 flex-wrap mb-1">
                                        <span class="badge bg-secondary-subtle text-secondary border fs-11 px-2 py-1 rounded">${fromStatus}</span>
                                        <i class="feather-arrow-right text-primary fs-12"></i>
                                        <span class="badge bg-primary text-white fs-11 fw-bold px-2 py-1 rounded">${toStatus}</span>
                                    </div>`;
                            } else if (currentStatus) {
                                transitionContent = `
                                    <div class="d-flex align-items-center gap-2 flex-wrap mb-1">
                                        <span class="badge bg-primary text-white fs-11 fw-bold px-2 py-1 rounded">
                                            <i class="feather-check-circle me-1 fs-10"></i>${currentStatus}
                                        </span>
                                        ${bucketName && bucketName.toLowerCase() !== currentStatus.toLowerCase() ? `<span class="badge bg-light text-secondary border fs-10 px-2 py-1 rounded">Bucket: ${bucketName}</span>` : ''}
                                    </div>`;
                            } else if (toStatus) {
                                transitionContent = `
                                    <div class="d-flex align-items-center gap-2 flex-wrap mb-1">
                                        <span class="badge bg-primary text-white fs-11 fw-bold px-2 py-1 rounded">
                                            <i class="feather-check-circle me-1 fs-10"></i>${toStatus}
                                        </span>
                                    </div>`;
                            }

                            sHtml += `
                                <div class="cm-timeline-item">
                                    <span class="cm-timeline-node node-status">
                                        <i class="feather-git-commit"></i>
                                    </span>
                                    <div class="cm-card">
                                        <div class="cm-card-header">
                                            <div class="d-flex align-items-center gap-2 overflow-hidden">
                                                <div class="cm-user-avatar" style="background: ${palette.bg}; color: ${palette.color}; border: 1px solid ${palette.border};">
                                                    ${userInitial}
                                                </div>
                                                <div class="d-flex align-items-center gap-1.5 overflow-hidden">
                                                    <span class="fw-bold text-dark fs-12 text-truncate">${userName}</span>
                                                    <span class="badge bg-light text-secondary border fs-10 px-1.5 py-0.5 rounded">#${idx + 1}</span>
                                                </div>
                                            </div>
                                            <div class="text-muted fs-11 text-nowrap d-flex align-items-center gap-1 flex-shrink-0">
                                                <i class="feather-clock fs-11 opacity-75"></i>
                                                <span>${dateStr}</span>
                                            </div>
                                        </div>
                                        <div class="cm-card-body">
                                            ${transitionContent}
                                            ${message ? `<div class="cm-message-box mt-2" style="border-left-color: #8b5cf6;"><i class="feather-file-text me-1 text-muted"></i>${message}</div>` : ''}
                                        </div>
                                    </div>
                                </div>`;
                        });
                        sHtml += `</div>`;
                        statusTabPane.innerHTML = sHtml;
                    }
                }
            })
            .catch(err => {
                if (commentsTabPane) commentsTabPane.innerHTML = '<div class="text-center text-danger py-4 fs-13">Failed to load comments.</div>';
                if (statusTabPane) statusTabPane.innerHTML = '<div class="text-center text-danger py-4 fs-13">Failed to load status history.</div>';
            });
    }
    window.openCommentsModal = openCommentsModal;

    async function toggleLeadTag(event, leadId, tagId, optionButton) {
        event.preventDefault();
        event.stopPropagation();
        const checkbox = optionButton.querySelector('input[type="checkbox"]');
        optionButton.disabled = true;
        try {
            const response = await fetch(`{{ url('/leads') }}/${leadId}/tags/${tagId}/toggle`, {
                method: 'POST',
                headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept':'application/json'}
            });
            const result = await response.json();
            if (!response.ok || !result.success) throw new Error(result.message || 'Failed to update tag.');
            checkbox.checked = result.attached;
            
            // Update sharedLeadTagsMap in memory
            if (!sharedLeadTagsMap[leadId]) sharedLeadTagsMap[leadId] = [];
            if (result.attached) {
                if (!sharedLeadTagsMap[leadId].includes(Number(tagId)) && !sharedLeadTagsMap[leadId].includes(String(tagId))) {
                    sharedLeadTagsMap[leadId].push(Number(tagId));
                }
            } else {
                sharedLeadTagsMap[leadId] = sharedLeadTagsMap[leadId].filter(id => id != tagId);
            }

            const container = document.querySelector(`[data-lead-tags-container="${leadId}"]`);
            const existing = document.querySelector(`[data-lead-tag="${leadId}-${tagId}"]`);
            if (result.attached && container && !existing) {
                const badge = document.createElement('span');
                badge.className = 'badge rounded-pill text-white fs-10 d-inline-flex align-items-center gap-1 shadow-2xs';
                badge.style.backgroundColor = result.tag.color;
                badge.dataset.leadTag = `${leadId}-${tagId}`;
                badge.innerHTML = `${result.tag.name} <button type="button" class="border-0 bg-transparent text-white p-0 d-inline-flex align-items-center" style="font-size:11px;line-height:1;opacity:0.85;" title="Remove tag" onclick="removeLeadTag(event, ${leadId}, ${tagId}, this)"><i class="fas fa-times-circle"></i></button>`;
                container.appendChild(badge);
            } else if (!result.attached && existing) {
                existing.remove();
            }

            // Update count indicator on tag button if present
            const tagBtnBadge = document.querySelector(`[data-lead-tag-btn-badge="${leadId}"]`);
            if (tagBtnBadge) {
                const currentCount = container ? container.querySelectorAll('[data-lead-tag]').length : 0;
                if (currentCount > 0) {
                    tagBtnBadge.textContent = currentCount;
                    tagBtnBadge.classList.remove('d-none');
                } else {
                    tagBtnBadge.textContent = '0';
                    tagBtnBadge.classList.add('d-none');
                }
            }
        } catch (error) {
            if (window.Swal) Swal.fire({icon:'error', title:'Error', text:error.message}); else alert(error.message);
        } finally {
            optionButton.disabled = false;
        }
    }

    async function removeLeadTag(event, leadId, tagId, button) {
        event.preventDefault();
        event.stopPropagation();

        const badge = button.closest('[data-lead-tag]');
        button.disabled = true;
        try {
            const response = await fetch(`{{ url('/leads') }}/${leadId}/tags/${tagId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            });
            const result = await response.json();
            if (!response.ok || !result.success) throw new Error(result.message || 'Failed to remove tag.');
            if (badge) badge.remove();
            
            // Update in-memory map
            if (sharedLeadTagsMap[leadId]) {
                sharedLeadTagsMap[leadId] = sharedLeadTagsMap[leadId].filter(id => id != tagId);
            }

            const dropdownOption = document.querySelector(`[onclick*="toggleLeadTag(event, ${leadId}, ${tagId},"]`);
            const checkbox = dropdownOption ? dropdownOption.querySelector('input[type="checkbox"]') : null;
            if (checkbox) checkbox.checked = false;

            // Update count indicator on tag button if present
            const container = document.querySelector(`[data-lead-tags-container="${leadId}"]`);
            const tagBtnBadge = document.querySelector(`[data-lead-tag-btn-badge="${leadId}"]`);
            if (tagBtnBadge) {
                const currentCount = container ? container.querySelectorAll('[data-lead-tag]').length : 0;
                if (currentCount > 0) {
                    tagBtnBadge.textContent = currentCount;
                    tagBtnBadge.classList.remove('d-none');
                } else {
                    tagBtnBadge.textContent = '0';
                    tagBtnBadge.classList.add('d-none');
                }
            }

            if (window.Swal) Swal.fire({icon:'success', title:'Tag Removed', text:result.message, timer:1200, showConfirmButton:false});
        } catch (error) {
            button.disabled = false;
            if (window.Swal) Swal.fire({icon:'error', title:'Error', text:error.message});
            else alert(error.message);
        }
    }

    /* =========================================================================
       CHECKBOX SELECTION & FLOATING BULK ACTIONS CONTROLLER
       ========================================================================= */
    var isDealViewMode = window.isDealViewMode = {{ ($isDealView ?? false) ? 'true' : 'false' }};
    var isArchiveViewMode = window.isArchiveViewMode = {{ ($isArchiveView ?? false) ? 'true' : 'false' }};

    function getSelectedLeadIds() {
        const checkboxes = document.querySelectorAll('.lead-checkbox:checked');
        return Array.from(checkboxes).map(cb => cb.value);
    }

    function updateBulkActionsState() {
        const checkedBoxes = document.querySelectorAll('.lead-checkbox:checked');
        const allBoxes = document.querySelectorAll('.lead-checkbox');
        const checkAll = document.getElementById('checkAll');
        const floatingBar = document.getElementById('floatingBulkBar');
        const countSpan = document.getElementById('bulkSelectedCount');

        const count = checkedBoxes.length;
        if (countSpan) countSpan.textContent = count;

        if (checkAll && allBoxes.length > 0) {
            checkAll.checked = (checkedBoxes.length === allBoxes.length);
            checkAll.indeterminate = (checkedBoxes.length > 0 && checkedBoxes.length < allBoxes.length);
        }

        if (floatingBar) {
            if (count > 0) {
                floatingBar.classList.add('is-visible');
            } else {
                floatingBar.classList.remove('is-visible');
            }
        }
    }

    function deselectAllRows() {
        document.querySelectorAll('.lead-checkbox').forEach(cb => cb.checked = false);
        const checkAll = document.getElementById('checkAll');
        if (checkAll) {
            checkAll.checked = false;
            checkAll.indeterminate = false;
        }
        updateBulkActionsState();
    }

    document.addEventListener('DOMContentLoaded', function () {
        const checkAll = document.getElementById('checkAll');
        if (checkAll) {
            checkAll.addEventListener('change', function () {
                const isChecked = this.checked;
                document.querySelectorAll('.lead-checkbox').forEach(cb => {
                    cb.checked = isChecked;
                });
                updateBulkActionsState();
            });
        }

        const tableBody = document.getElementById('lead-table-body');
        if (tableBody) {
            tableBody.addEventListener('change', function (e) {
                if (e.target && e.target.classList.contains('lead-checkbox')) {
                    updateBulkActionsState();
                }
            });
        }
    });

    // SINGLE ARCHIVE
    async function archiveSingleLead(leadId, button) {
        const isDeal = typeof isDealViewMode !== 'undefined' && isDealViewMode;
        const confirmed = await appConfirm(
            isDeal ? 'Move Deal to Archive?' : 'Move Lead to Archive?',
            isDeal 
                ? 'This deal will be moved to Archive and hidden from active Deals table & pipeline.'
                : 'This lead will be moved to Archive and hidden from active Leads table & pipeline.',
            'Yes, Archive it!',
            '#f59e0b',
            'warning'
        );
        if (!confirmed) return;

        if (button) button.disabled = true;

        try {
            const endpoint = isDeal 
                ? ("{{ url('/archive-deals') }}/" + leadId + "/archive") 
                : ("{{ url('/archive-leads') }}/" + leadId + "/archive");

            const response = await fetch(endpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: new URLSearchParams({ _token: '{{ csrf_token() }}' })
            });

            const data = await response.json();
            if (!response.ok || !data.status) throw new Error(data.message || 'Could not archive item');

            const row = document.getElementById('lead-row-' + leadId) || (button ? button.closest('tr') : null);
            if (row) {
                row.style.transition = 'all 0.35s ease';
                row.style.opacity = '0';
                row.style.transform = 'translateX(-30px)';
                setTimeout(() => { row.remove(); updateBulkActionsState(); }, 350);
            }

            appToast('success', data.message || 'Moved to archive successfully');
        } catch (error) {
            if (button) button.disabled = false;
            appToast('error', error.message || 'Could not archive item');
        }
    }

    // BULK ARCHIVE
    async function executeBulkArchive() {
        const ids = getSelectedLeadIds();
        if (!ids.length) return;

        const isDeal = typeof isDealViewMode !== 'undefined' && isDealViewMode;
        const confirmed = await appConfirm(
            `Archive ${ids.length} selected items?`,
            isDeal 
                ? 'They will be moved to Archive and hidden from active Deals Pipeline & Tables.'
                : 'They will be moved to Archive and hidden from active Leads Pipeline & Tables.',
            `Yes, Archive (${ids.length})`,
            '#f59e0b',
            'warning'
        );
        if (!confirmed) return;

        try {
            const endpoint = isDeal 
                ? "{{ url('/archive-deals/bulk-archive') }}"
                : "{{ url('/archive-leads/bulk-archive') }}";

            const params = new URLSearchParams();
            params.append('_token', '{{ csrf_token() }}');
            ids.forEach(id => params.append('ids[]', id));

            const response = await fetch(endpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: params
            });

            const data = await response.json();
            if (!response.ok || !data.status) throw new Error(data.message || 'Could not archive selected items');

            ids.forEach(id => {
                const row = document.getElementById('lead-row-' + id);
                if (row) {
                    row.style.transition = 'all 0.3s ease';
                    row.style.opacity = '0';
                    setTimeout(() => row.remove(), 300);
                }
            });
            setTimeout(() => deselectAllRows(), 350);

            appToast('success', data.message || `${ids.length} items moved to archive`);
        } catch (error) {
            appToast('error', error.message || 'Could not archive selected items');
        }
    }

    // SINGLE RESTORE
    async function restoreSingleLead(leadId, button) {
        const isDeal = typeof isDealViewMode !== 'undefined' && isDealViewMode;
        const confirmed = await appConfirm(
            isDeal ? 'Restore Deal?' : 'Restore Lead?',
            'This will be restored back to active Table & Pipeline.',
            'Yes, Restore!',
            '#10b981',
            'question'
        );
        if (!confirmed) return;

        if (button) button.disabled = true;

        try {
            const endpoint = isDeal 
                ? ("{{ url('/archive-deals') }}/" + leadId + "/restore")
                : ("{{ url('/archive-leads') }}/" + leadId + "/restore");

            const response = await fetch(endpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: new URLSearchParams({ _token: '{{ csrf_token() }}' })
            });

            const data = await response.json();
            if (!response.ok || !data.status) throw new Error(data.message || 'Could not restore item');

            const row = document.getElementById('lead-row-' + leadId) || (button ? button.closest('tr') : null);
            if (row) {
                row.style.transition = 'all 0.35s ease';
                row.style.opacity = '0';
                row.style.transform = 'translateX(30px)';
                setTimeout(() => { row.remove(); updateBulkActionsState(); }, 350);
            }

            appToast('success', data.message || 'Item restored successfully');
        } catch (error) {
            if (button) button.disabled = false;
            appToast('error', error.message || 'Could not restore item');
        }
    }

    // BULK RESTORE
    async function executeBulkRestore() {
        const ids = getSelectedLeadIds();
        if (!ids.length) return;

        const confirmed = await appConfirm(
            `Restore ${ids.length} selected items?`,
            'They will be moved back to the active Table & Pipeline.',
            `Yes, Restore (${ids.length})`,
            '#10b981',
            'question'
        );
        if (!confirmed) return;

        try {
            const endpoint = isDealViewMode 
                ? "{{ url('/archive-deals/bulk-restore') }}"
                : "{{ url('/archive-leads/bulk-restore') }}";

            const params = new URLSearchParams();
            params.append('_token', '{{ csrf_token() }}');
            ids.forEach(id => params.append('ids[]', id));

            const response = await fetch(endpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: params
            });

            const data = await response.json();
            if (!response.ok || !data.status) throw new Error(data.message || 'Could not restore items');

            ids.forEach(id => {
                const row = document.getElementById('lead-row-' + id);
                if (row) {
                    row.style.transition = 'all 0.3s ease';
                    row.style.opacity = '0';
                    setTimeout(() => row.remove(), 300);
                }
            });
            setTimeout(() => deselectAllRows(), 350);

            appToast('success', data.message || `${ids.length} items restored`);
        } catch (error) {
            appToast('error', error.message || 'Could not restore items');
        }
    }

    // BULK DELETE
    async function executeBulkDelete() {
        const ids = getSelectedLeadIds();
        if (!ids.length) return;

        const confirmed = await appConfirm(
            `Delete ${ids.length} selected items permanently?`,
            'This action cannot be undone!',
            'Yes, Delete Permanently',
            '#ef4444',
            'error'
        );
        if (!confirmed) return;

        try {
            const endpoint = isArchiveViewMode 
                ? (isDealViewMode ? "{{ url('/archive-deals/bulk-delete') }}" : "{{ url('/archive-leads/bulk-delete') }}")
                : "{{ url('/leads/bulk-delete') }}";

            const params = new URLSearchParams();
            params.append('_token', '{{ csrf_token() }}');
            ids.forEach(id => params.append('ids[]', id));

            const response = await fetch(endpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: params
            });

            const data = await response.json();
            if (!response.ok || !data.status) throw new Error(data.message || 'Could not delete items');

            ids.forEach(id => {
                const row = document.getElementById('lead-row-' + id);
                if (row) row.remove();
            });
            deselectAllRows();

            appToast('success', data.message || 'Selected items deleted');
        } catch (error) {
            appToast('error', error.message || 'Could not delete items');
        }
    }

    // SINGLE PERMANENT DELETE (Archive View)
    async function deleteSingleLeadPermanently(leadId, button) {
        const result = await Swal.fire({
            title: 'Delete Permanently?',
            text: 'This item will be permanently removed.',
            icon: 'error',
            showCancelButton: true,
            confirmButtonText: 'Yes, Delete',
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#64748b'
        });
        if (!result.isConfirmed) return;

        if (button) button.disabled = true;

        try {
            const endpoint = isDealViewMode 
                ? "{{ url('/archive-deals/bulk-delete') }}"
                : "{{ url('/archive-leads/bulk-delete') }}";

            const params = new URLSearchParams();
            params.append('_token', '{{ csrf_token() }}');
            params.append('ids[]', leadId);

            const response = await fetch(endpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: params
            });

            const data = await response.json();
            if (!response.ok || !data.status) throw new Error(data.message || 'Could not delete lead');

            const row = document.getElementById('lead-row-' + leadId) || (button ? button.closest('tr') : null);
            if (row) {
                row.style.transition = 'all 0.3s ease';
                row.style.opacity = '0';
                setTimeout(() => { row.remove(); updateBulkActionsState(); }, 300);
            }

            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: data.message || 'Item deleted permanently',
                showConfirmButton: false,
                timer: 2300,
                timerProgressBar: true
            });
        } catch (error) {
            if (button) button.disabled = false;
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: error.message || 'Could not delete lead',
                showConfirmButton: false,
                timer: 2800
            });
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const leadFormEl = document.getElementById('leadForm');
        if (leadFormEl) {
            leadFormEl.addEventListener('input', function() {
                clearTimeout(draftSaveTimeout);
                draftSaveTimeout = setTimeout(saveLeadFormDraft, 250);
            });
            leadFormEl.addEventListener('change', function() {
                clearTimeout(draftSaveTimeout);
                draftSaveTimeout = setTimeout(saveLeadFormDraft, 100);
            });
            leadFormEl.addEventListener('submit', handleLeadFormSubmit);
        }

        // When lead modal is closed, if it was submitted or reset, update draft
        const modalEl = document.getElementById('leadModal');
        if (modalEl) {
            modalEl.addEventListener('hidden.bs.modal', function () {
                const methodInput = document.getElementById('formMethod');
                if (methodInput && methodInput.value === 'POST') {
                    // Update draft modalOpen state to false
                    const raw = localStorage.getItem(LEAD_FORM_DRAFT_KEY);
                    if (raw) {
                        try {
                            const d = JSON.parse(raw);
                            d.modalOpen = false;
                            localStorage.setItem(LEAD_FORM_DRAFT_KEY, JSON.stringify(d));
                        } catch(e) {}
                    }
                }
            });
        }

        // Check if a draft was in progress when the page was refreshed
        const existingDraft = localStorage.getItem(LEAD_FORM_DRAFT_KEY);
        if (existingDraft) {
            try {
                const parsedDraft = JSON.parse(existingDraft);
                if (parsedDraft && parsedDraft.modalOpen && (parsedDraft.name || parsedDraft.mobile || parsedDraft.email || parsedDraft.business_name || parsedDraft.city)) {
                    // Automatically re-open the modal with all user's fields restored!
                    openCreateModal(false);
                }
            } catch (e) {}
        }
    });
</script>
