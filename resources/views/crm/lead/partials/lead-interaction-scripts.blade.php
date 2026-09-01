<script>
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

    document.addEventListener('DOMContentLoaded', function () {
        const tableBody = document.getElementById('lead-table-body');
        const loader = document.getElementById('lead-infinite-loader');
        if (!tableBody || !loader) return;

        const spinner = loader.querySelector('.spinner-border');
        const message = loader.querySelector('.loader-message');
        let nextPageUrl = loader.dataset.nextPage || '';
        let isLoading = false;

        const setLoaderState = (state) => {
            if (spinner) spinner.classList.toggle('d-none', state !== 'loading');
            if (!message) return;
            if (state === 'loading') message.textContent = 'Loading next 20 leads...';
            if (state === 'ready') message.textContent = 'Scroll down to load more leads';
            if (state === 'complete') message.textContent = 'All leads loaded';
            if (state === 'error') message.textContent = 'Could not load more leads. Scroll to try again.';
        };

        const loadMoreLeads = async () => {
            if (isLoading || !nextPageUrl) return;
            isLoading = true;
            setLoaderState('loading');

            try {
                const response = await fetch(nextPageUrl, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });
                if (!response.ok) throw new Error('Unable to load leads');

                const html = await response.text();
                const parsedDocument = new DOMParser().parseFromString(html, 'text/html');
                const newRows = parsedDocument.querySelectorAll('#lead-table-body > tr');
                const nextLoader = parsedDocument.getElementById('lead-infinite-loader');

                newRows.forEach(row => tableBody.appendChild(row));
                nextPageUrl = nextLoader ? (nextLoader.dataset.nextPage || '') : '';
                loader.dataset.nextPage = nextPageUrl;
                setLoaderState(nextPageUrl ? 'ready' : 'complete');
            } catch (error) {
                setLoaderState('error');
            } finally {
                isLoading = false;
            }
        };

        const observer = new IntersectionObserver((entries) => {
            if (entries[0].isIntersecting) loadMoreLeads();
        }, { rootMargin: '180px 0px', threshold: 0.01 });

        if (nextPageUrl) observer.observe(loader);
    });

    const leadStatusMap = @json(
        (isset($childBuckets) ? $childBuckets : collect())->mapWithKeys(function($b) {
            return [$b->name => [
                'id' => $b->id,
                'children' => $b->children ? $b->children->map(function($c) {
                    return ['id' => $c->id, 'name' => $c->name];
                })->values()->toArray() : []
            ]];
        })
    );
    const sharedLeadTagsMap = @json(
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
            defaultOpt.textContent = 'Select Sub Status (Optional)';
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
        } else {
            if (subStatusWrap) subStatusWrap.classList.add('d-none');
            subSelect.value = '';
            subSelect.disabled = true;
        }
    }

    function openEditStatusOffcanvas(leadId, leadStatus, engagementStatus, bucketId) {
        let offcanvasEl = document.getElementById('editStatusOffcanvas');
        let form = document.getElementById('sharedQuickUpdateForm');
        form.action = "{{ url('/modern-leads/quick-update') }}/" + leadId;
        
        let engSelect = form.querySelector('[name="lead_engagement_status"]');
        if (engSelect) engSelect.value = (engagementStatus || '').toLowerCase();
        
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

        if (!matchedMainStatus && mainSelect && mainSelect.options.length > 1) {
            matchedMainStatus = mainSelect.options[1].value;
        }

        if (mainSelect) mainSelect.value = matchedMainStatus;
        onOffcanvasMainStatusChange(matchedMainStatus, matchedSubStatus);
        
        let bucketInput = form.querySelector('[name="lead_bucket_id"]');
        if (bucketInput) bucketInput.value = bucketId || 46;

        form.onsubmit = function() {
            let subVal = subSelect ? subSelect.value : '';
            let mainVal = mainSelect ? mainSelect.value : '';
            let finalStatus = subVal ? subVal : mainVal;
            
            let hiddenStatusInput = form.querySelector('input[name="lead_status"]');
            if (!hiddenStatusInput) {
                hiddenStatusInput = document.createElement('input');
                hiddenStatusInput.type = 'hidden';
                hiddenStatusInput.name = 'lead_status';
                form.appendChild(hiddenStatusInput);
            }
            hiddenStatusInput.value = finalStatus;

            if (subSelect && subSelect.selectedIndex >= 0) {
                let selectedOpt = subSelect.options[subSelect.selectedIndex];
                if (selectedOpt && selectedOpt.dataset.bucketId) {
                    if (bucketInput) bucketInput.value = selectedOpt.dataset.bucketId;
                }
            }
        };

        let bsOffcanvas = bootstrap.Offcanvas.getOrCreateInstance(offcanvasEl);
        bsOffcanvas.show();
    }

    async function convertLeadToDeal(leadId, button) {
        const result = await Swal.fire({
            title: 'Convert lead to deal?',
            text: 'Lead New Leads se remove hokar Created Deals mein chali jayegi.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Convert',
            confirmButtonColor: '#d97706'
        });
        if (!result.isConfirmed) return;

        button.disabled = true;
        try {
            const response = await fetch("{{ url('/new-leads-table') }}/" + leadId + "/convert-deal", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            const data = await response.json();
            if (!response.ok || !data.status) throw new Error(data.message || 'Lead conversion failed');

            document.getElementById('lead-row-' + leadId)?.remove();
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: data.message,
                showConfirmButton: false,
                timer: 2300,
                timerProgressBar: true
            });
        } catch (error) {
            button.disabled = false;
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: error.message || 'Lead conversion failed',
                showConfirmButton: false,
                timer: 2800
            });
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

                    // Badges
                    let badgesHtml = '';
                    let bucket = lead.bucket ? lead.bucket.name : 'N/A';
                    badgesHtml += `<span class="badge bg-primary-subtle text-primary border px-2.5 py-1 fs-11 fw-semibold"><i class="feather-layers me-1"></i> Bucket: ${bucket}</span>`;
                    if (lead.lead_status) {
                        badgesHtml += `<span class="badge bg-success-subtle text-success border px-2.5 py-1 fs-11 fw-semibold"><i class="feather-flag me-1"></i> Status: ${lead.lead_status}</span>`;
                    }
                    let eng = (lead.lead_engagement_status || 'New').toUpperCase();
                    badgesHtml += `<span class="badge bg-warning-subtle text-warning border px-2.5 py-1 fs-11 fw-semibold"><i class="feather-zap me-1"></i> Engagement: ${eng}</span>`;
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

                    // Lead Info & Campaign
                    let lInfo = '';
                    lInfo += fItem('feather-layers', 'Bucket', bucket);
                    lInfo += fItem('feather-flag', 'Status', lead.lead_status);
                    lInfo += fItem('feather-zap', 'Engagement', lead.lead_engagement_status);
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
            alert('Lead owner update nahi ho paya. Please try again.');
        }
    }

    function openCreateModal() {
        const modalElement = document.getElementById('leadModal');
        const form = document.getElementById('leadForm');
        if (!modalElement || !form) {
            alert('Lead form load nahi ho paya. Please refresh and try again.');
            return;
        }

        form.reset();
        form.action = "{{ route('lead.store') }}";

        const methodInput = document.getElementById('formMethod');
        if (methodInput) methodInput.value = 'POST';

        const title = modalElement.querySelector('#leadModalTitle span');
        if (title) title.textContent = 'Create New Lead';

        const submitButton = modalElement.querySelector('#btnSubmit');
        if (submitButton) submitButton.textContent = 'Create Lead';

        const clonedContacts = modalElement.querySelector('#clonedContactsContainer');
        if (clonedContacts) clonedContacts.innerHTML = '';

        const contactCount = modalElement.querySelector('#contactCountBadge');
        if (contactCount) contactCount.textContent = '0';

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

        bootstrap.Modal.getOrCreateInstance(modalElement).show();
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
            setValue('#inp_budget', lead.budget);
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
            alert('Modern Leads edit modal load nahi ho paya. Please try again.');
        }
    }

    function openCommentsModal(leadId, leadName) {
        let offcanvasEl = document.getElementById('commentsOffcanvas');
        let commentsOffcanvas = bootstrap.Offcanvas.getOrCreateInstance(offcanvasEl);
        
        document.getElementById('cm_leadName').textContent = leadName + ' - Comments';
        document.getElementById('cm_body').innerHTML = '<div class="text-center py-4 text-muted fs-13"><div class="spinner-border spinner-border-sm me-2 text-primary"></div> Loading comments...</div>';
        
        commentsOffcanvas.show();

        fetch("{{ url('/modern-leads') }}/" + leadId + "/details-data")
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    let messages = data.messages || [];
                    if (messages.length === 0) {
                        document.getElementById('cm_body').innerHTML = `
                            <div class="text-center py-5 bg-white rounded-3 border">
                                <i class="feather-message-square text-muted fs-1 mb-2 opacity-50 d-block"></i>
                                <p class="text-muted fs-13 mb-0">No comments or activity logs found for this lead.</p>
                            </div>`;
                        return;
                    }

                    const escapeHistoryHtml = (value) => {
                        const element = document.createElement('div');
                        element.textContent = value == null ? '' : String(value);
                        return element.innerHTML;
                    };

                    let html = `
                        <div class="comment-history-summary">
                            <div class="d-flex align-items-center gap-2 text-primary fw-bold fs-12">
                                <i class="feather-activity"></i>
                                <span>Activity Tracking</span>
                            </div>
                            <span class="badge bg-primary rounded-pill">${messages.length} ${messages.length === 1 ? 'Entry' : 'Entries'}</span>
                        </div>
                        <div class="comment-timeline">`;

                    messages.forEach((msg, index) => {
                        const userName = escapeHistoryHtml(msg.user_name || 'System User');
                        const activityDate = escapeHistoryHtml(msg.created_at_formatted || 'Date unavailable');
                        const bucket = escapeHistoryHtml(msg.bucket || '');
                        const status = escapeHistoryHtml(msg.status || '');
                        const message = escapeHistoryHtml(msg.message || '');
                        const followupType = escapeHistoryHtml(msg.followup_type || '');
                        const followupStatus = escapeHistoryHtml(msg.followup_status || '');
                        const nextFollowup = escapeHistoryHtml(msg.next_followup_date_formatted || msg.next_followup_date || '');

                        html += `
                            <div class="comment-timeline-item">
                                <span class="comment-timeline-dot"></span>
                                <div class="comment-history-card">
                                    <div class="comment-history-meta">
                                        <div class="d-flex align-items-center gap-2 overflow-hidden">
                                            <span class="badge bg-primary-subtle text-primary border fs-10">#${index + 1}</span>
                                            <span class="fw-bold text-dark fs-12 text-truncate"><i class="feather-user me-1 text-primary"></i>${userName}</span>
                                        </div>
                                        <span class="text-muted fs-10 text-nowrap"><i class="feather-clock me-1"></i>${activityDate}</span>
                                    </div>
                                    <div class="comment-history-content">
                                        ${(bucket || status) ? `
                                            <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                                ${bucket ? `<span class="badge bg-primary-subtle text-primary border fw-semibold"><i class="feather-layers me-1"></i>${bucket}</span>` : ''}
                                                ${status ? `<span class="badge bg-success-subtle text-success border fw-semibold"><i class="feather-flag me-1"></i>${status}</span>` : ''}
                                            </div>` : ''}
                                        ${message ? `<div class="comment-message-box mb-2">${message}</div>` : '<div class="text-muted fst-italic fs-11 mb-2">No comment added</div>'}
                                        ${(followupType || followupStatus || nextFollowup) ? `
                                            <div class="d-flex align-items-center gap-2 flex-wrap pt-2 border-top fs-11">
                                                ${followupType ? `<span class="text-secondary"><i class="feather-phone me-1 text-primary"></i>${followupType}</span>` : ''}
                                                ${followupStatus ? `<span class="badge bg-info-subtle text-info border">${followupStatus}</span>` : ''}
                                                ${nextFollowup ? `<span class="text-warning-emphasis ms-auto"><i class="feather-calendar me-1"></i>${nextFollowup}</span>` : ''}
                                            </div>` : ''}
                                        </div>
                                </div>
                            </div>`;
                    });
                    html += `</div>`;
                    document.getElementById('cm_body').innerHTML = html;
                }
            })
            .catch(err => {
                document.getElementById('cm_body').innerHTML = '<div class="text-center text-danger py-3 fs-13">Failed to load comments.</div>';
            });
    }

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
            if (!response.ok || !result.success) throw new Error(result.message || 'Tag update nahi hua.');
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
            if (!response.ok || !result.success) throw new Error(result.message || 'Tag remove nahi hua.');
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
    const isDealViewMode = {{ ($isDealView ?? false) ? 'true' : 'false' }};
    const isArchiveViewMode = {{ ($isArchiveView ?? false) ? 'true' : 'false' }};
    const CSRF_TOKEN_VAL = '{{ csrf_token() }}';

    const ARCHIVE_ROUTES = {
        archiveSingleLead: "{{ route('archive.leads.archive', ':id', false) }}",
        archiveSingleDeal: "{{ route('archive.deals.archive', ':id', false) }}",
        bulkArchiveLeads: "{{ route('archive.leads.bulkArchive', [], false) }}",
        bulkArchiveDeals: "{{ route('archive.deals.bulkArchive', [], false) }}",
        restoreSingleLead: "{{ route('archive.leads.restore', ':id', false) }}",
        restoreSingleDeal: "{{ route('archive.deals.restore', ':id', false) }}",
        bulkRestoreLeads: "{{ route('archive.leads.bulkRestore', [], false) }}",
        bulkRestoreDeals: "{{ route('archive.deals.bulkRestore', [], false) }}",
        bulkDeleteArchiveLeads: "{{ route('archive.leads.bulkDelete', [], false) }}",
        bulkDeleteArchiveDeals: "{{ route('archive.deals.bulkDelete', [], false) }}",
        bulkDeleteActiveLeads: "{{ route('leads.bulkDelete', [], false) }}",
    };

    async function showConfirmDialog(title, text, confirmText, icon = 'warning', confirmBtnColor = '#f59e0b') {
        if (window.Swal) {
            const res = await Swal.fire({
                title: title,
                text: text,
                icon: icon,
                showCancelButton: true,
                confirmButtonColor: confirmBtnColor,
                cancelButtonColor: '#64748b',
                confirmButtonText: confirmText
            });
            return res.isConfirmed;
        }
        return window.confirm(`${title}\n${text}`);
    }

    function showNoticeDialog(icon, title, message) {
        if (window.Swal) {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: icon,
                title: message || title,
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        } else {
            alert(`${title}: ${message}`);
        }
    }

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

        // Delegate listener on table body for dynamic rows
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
    async function archiveSingleLead(leadId, btn) {
        const confirmed = await showConfirmDialog(
            'Move to Archive?',
            'This item will be moved to Archive and removed from active tables & pipeline.',
            'Yes, Archive it!',
            'warning',
            '#f59e0b'
        );
        if (!confirmed) return;

        if (btn) btn.disabled = true;

        const endpoint = isDealViewMode 
            ? ARCHIVE_ROUTES.archiveSingleDeal.replace(':id', leadId) 
            : ARCHIVE_ROUTES.archiveSingleLead.replace(':id', leadId);

        try {
            const resp = await fetch(endpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN_VAL,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ _token: CSRF_TOKEN_VAL })
            });
            const data = await resp.json();
            if (data.status) {
                showNoticeDialog('success', 'Archived!', data.message || 'Item moved to archive');
                const row = document.getElementById(`lead-row-${leadId}`) || (btn ? btn.closest('tr') : null);
                if (row) {
                    row.style.transition = 'all 0.35s ease';
                    row.style.opacity = '0';
                    row.style.transform = 'translateX(-30px)';
                    setTimeout(() => { row.remove(); updateBulkActionsState(); }, 350);
                }
            } else {
                if (btn) btn.disabled = false;
                showNoticeDialog('error', 'Error', data.message || 'Could not archive lead');
            }
        } catch (e) {
            if (btn) btn.disabled = false;
            showNoticeDialog('error', 'Error', 'Something went wrong: ' + e.message);
        }
    }

    // BULK ARCHIVE
    async function executeBulkArchive() {
        const ids = getSelectedLeadIds();
        if (!ids.length) return;

        const confirmed = await showConfirmDialog(
            `Archive ${ids.length} selected items?`,
            'They will be moved to Archive and hidden from active Pipeline & Tables.',
            `Yes, Archive (${ids.length})`,
            'warning',
            '#f59e0b'
        );
        if (!confirmed) return;

        const endpoint = isDealViewMode ? ARCHIVE_ROUTES.bulkArchiveDeals : ARCHIVE_ROUTES.bulkArchiveLeads;
        try {
            const resp = await fetch(endpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN_VAL,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ ids: ids, _token: CSRF_TOKEN_VAL })
            });
            const data = await resp.json();
            if (data.status) {
                showNoticeDialog('success', 'Archived!', data.message || `${ids.length} items moved to archive`);
                ids.forEach(id => {
                    const row = document.getElementById(`lead-row-${id}`);
                    if (row) {
                        row.style.transition = 'all 0.3s ease';
                        row.style.opacity = '0';
                        row.style.transform = 'scale(0.95)';
                        setTimeout(() => row.remove(), 300);
                    }
                });
                setTimeout(() => deselectAllRows(), 350);
            } else {
                showNoticeDialog('error', 'Error', data.message || 'Could not archive selected items');
            }
        } catch (e) {
            showNoticeDialog('error', 'Error', 'Something went wrong: ' + e.message);
        }
    }

    // SINGLE RESTORE
    async function restoreSingleLead(leadId, btn) {
        const confirmed = await showConfirmDialog(
            'Restore this item?',
            'This will be restored back to the active Lead/Deal Table and Pipeline.',
            'Yes, Restore!',
            'question',
            '#10b981'
        );
        if (!confirmed) return;

        if (btn) btn.disabled = true;

        const endpoint = isDealViewMode 
            ? ARCHIVE_ROUTES.restoreSingleDeal.replace(':id', leadId) 
            : ARCHIVE_ROUTES.restoreSingleLead.replace(':id', leadId);

        try {
            const resp = await fetch(endpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN_VAL,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ _token: CSRF_TOKEN_VAL })
            });
            const data = await resp.json();
            if (data.status) {
                showNoticeDialog('success', 'Restored!', data.message || 'Item restored to active list');
                const row = document.getElementById(`lead-row-${leadId}`) || (btn ? btn.closest('tr') : null);
                if (row) {
                    row.style.transition = 'all 0.35s ease';
                    row.style.opacity = '0';
                    row.style.transform = 'translateX(30px)';
                    setTimeout(() => { row.remove(); updateBulkActionsState(); }, 350);
                }
            } else {
                if (btn) btn.disabled = false;
                showNoticeDialog('error', 'Error', data.message || 'Could not restore lead');
            }
        } catch (e) {
            if (btn) btn.disabled = false;
            showNoticeDialog('error', 'Error', 'Something went wrong: ' + e.message);
        }
    }

    // BULK RESTORE
    async function executeBulkRestore() {
        const ids = getSelectedLeadIds();
        if (!ids.length) return;

        const confirmed = await showConfirmDialog(
            `Restore ${ids.length} selected items?`,
            'They will be moved back to the active Table & Pipeline.',
            `Yes, Restore (${ids.length})`,
            'question',
            '#10b981'
        );
        if (!confirmed) return;

        const endpoint = isDealViewMode ? ARCHIVE_ROUTES.bulkRestoreDeals : ARCHIVE_ROUTES.bulkRestoreLeads;
        try {
            const resp = await fetch(endpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN_VAL,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ ids: ids, _token: CSRF_TOKEN_VAL })
            });
            const data = await resp.json();
            if (data.status) {
                showNoticeDialog('success', 'Restored!', data.message || `${ids.length} items restored`);
                ids.forEach(id => {
                    const row = document.getElementById(`lead-row-${id}`);
                    if (row) {
                        row.style.transition = 'all 0.3s ease';
                        row.style.opacity = '0';
                        setTimeout(() => row.remove(), 300);
                    }
                });
                setTimeout(() => deselectAllRows(), 350);
            } else {
                showNoticeDialog('error', 'Error', data.message || 'Could not restore selected items');
            }
        } catch (e) {
            showNoticeDialog('error', 'Error', 'Something went wrong: ' + e.message);
        }
    }

    // BULK DELETE
    async function executeBulkDelete() {
        const ids = getSelectedLeadIds();
        if (!ids.length) return;

        const confirmed = await showConfirmDialog(
            `Delete ${ids.length} selected items permanently?`,
            'This action cannot be undone!',
            'Yes, Delete Permanently',
            'error',
            '#ef4444'
        );
        if (!confirmed) return;

        const endpoint = isArchiveViewMode 
            ? (isDealViewMode ? ARCHIVE_ROUTES.bulkDeleteArchiveDeals : ARCHIVE_ROUTES.bulkDeleteArchiveLeads)
            : ARCHIVE_ROUTES.bulkDeleteActiveLeads;

        try {
            const resp = await fetch(endpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN_VAL,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ ids: ids, _token: CSRF_TOKEN_VAL })
            });
            const data = await resp.json();
            if (data.status) {
                showNoticeDialog('success', 'Deleted!', data.message || 'Selected items deleted');
                ids.forEach(id => {
                    const row = document.getElementById(`lead-row-${id}`);
                    if (row) row.remove();
                });
                deselectAllRows();
            } else {
                showNoticeDialog('error', 'Error', data.message || 'Could not delete selected items');
            }
        } catch (e) {
            showNoticeDialog('error', 'Error', 'Something went wrong: ' + e.message);
        }
    }

    // SINGLE PERMANENT DELETE (Archive View)
    async function deleteSingleLeadPermanently(leadId, btn) {
        const confirmed = await showConfirmDialog(
            'Delete Permanently?',
            'This item will be permanently removed.',
            'Yes, Delete',
            'error',
            '#ef4444'
        );
        if (!confirmed) return;

        const endpoint = isDealViewMode ? ARCHIVE_ROUTES.bulkDeleteArchiveDeals : ARCHIVE_ROUTES.bulkDeleteArchiveLeads;
        try {
            const resp = await fetch(endpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN_VAL,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ ids: [leadId], _token: CSRF_TOKEN_VAL })
            });
            const data = await resp.json();
            if (data.status) {
                showNoticeDialog('success', 'Deleted!', data.message || 'Item deleted permanently');
                const row = document.getElementById(`lead-row-${leadId}`) || (btn ? btn.closest('tr') : null);
                if (row) {
                    row.style.transition = 'all 0.3s ease';
                    row.style.opacity = '0';
                    setTimeout(() => { row.remove(); updateBulkActionsState(); }, 300);
                }
            } else {
                showNoticeDialog('error', 'Error', data.message || 'Could not delete lead');
            }
        } catch (e) {
            showNoticeDialog('error', 'Error', 'Something went wrong: ' + e.message);
        }
    }
</script>
