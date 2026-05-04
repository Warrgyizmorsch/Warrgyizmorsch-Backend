<style>
/* RESET ONLY INSIDE COMPONENT */
.uni-crs-page,
.uni-crs-page * {
    box-sizing: border-box;
}

/* MAIN CONTAINER */
.uni-crs-page {
    font-family: 'Segoe UI', sans-serif;
    background: #f7f8fa;
    padding: 16px;
    color: #1a1a2e;
    width: 100%;
    max-width: 100%;
    min-width: 280px;
    overflow-x: hidden;
}

/* SEARCH */
.uni-crs-search-wrap {
    position: relative;
    margin-bottom: 15px;
}

.uni-crs-search-wrap input {
    width: 100%;
    padding: 14px 40px 14px 16px;
    border: 1px solid #cdd4e0;
    border-radius: 12px;
    font-size: 14px;
    outline: none;
    transition: all 0.2s;
}

.uni-crs-search-wrap input:focus {
    border-color: #5c6aff;
    box-shadow: 0 0 0 3px rgba(92, 106, 255, 0.1);
}

/* FILTERS LAYOUT */
.uni-crs-filters {
    display: flex;
    flex-wrap: wrap; /* Allows them to sit side-by-side */
    gap: 12px;
    margin-bottom: 20px;
}

.uni-crs-input-fee {
    flex: 1 1 140px; /* Takes up available space but no less than 140px */
    padding: 12px 16px;
    border: 1px solid #cdd4e0;
    border-radius: 12px;
    font-size: 14px;
    outline: none;
    transition: all 0.2s;
}
.uni-crs-input-fee:focus {
    border-color: #5c6aff;
    box-shadow: 0 0 0 3px rgba(92, 106, 255, 0.1);
}

/* --- CUSTOM DROPDOWN STYLES (Matching your Image) --- */
.uni-custom-select {
    position: relative;
    flex: 1 1 160px; /* Sits side by side */
    user-select: none;
}

.uni-select-trigger {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #fff;
    border: 1px solid #cdd4e0;
    border-radius: 12px;
    padding: 12px 16px;
    font-size: 14px;
    color: #4a5568;
    cursor: pointer;
    transition: all 0.2s;
}

/* Open State Border */
.uni-custom-select.open .uni-select-trigger {
    border-color: #5c6aff;
    box-shadow: 0 0 0 3px rgba(92, 106, 255, 0.1);
}

.uni-select-trigger svg {
    width: 16px;
    height: 16px;
    stroke: #8898aa;
    transition: transform 0.3s;
}

.uni-custom-select.open .uni-select-trigger svg {
    transform: rotate(180deg);
}

.uni-select-dropdown {
    position: absolute;
    top: calc(100% + 8px);
    left: 0;
    width: 100%;
    background: #fff;
    border: 1px solid #cdd4e0;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
    z-index: 10;
    display: none; /* Hidden by default */
    max-height: 250px;
    overflow-y: auto;
    padding: 8px;
}

.uni-custom-select.open .uni-select-dropdown {
    display: block;
}

.uni-select-option {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 12px;
    border-radius: 8px;
    font-size: 14px;
    color: #4a5568;
    cursor: pointer;
    transition: background 0.2s;
}

.uni-select-option:hover {
    background: #f0f3ff;
}

/* Selected State */
.uni-select-option.selected {
    background: #f0f3ff;
    color: #5c6aff;
    font-weight: 500;
}

.uni-check-icon {
    display: none;
    width: 16px;
    height: 16px;
    stroke: #5c6aff;
}

.uni-select-option.selected .uni-check-icon {
    display: block;
}


/* RESULTS */
.uni-crs-results-bar {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-bottom: 14px;
}

.uni-crs-results-text {
    font-size: 14px;
    color: #4a5568;
    margin: 0;
}

.uni-crs-sort-wrap {
    width: 200px; /* Keep sort dropdown small */
}

/* CARD (Your original CSS) */
.uni-crs-card {
    background: #fff;
    border: 1px solid #e4e8f0;
    border-radius: 12px;
    margin-bottom: 12px;
    overflow: hidden;
}

.uni-crs-card-top {
    display: flex;
    justify-content: space-between;
    gap: 10px;
    padding: 14px;
}

.uni-crs-card-title {
    font-size: 15px;
    font-weight: 700;
    flex: 1;
    min-width: 0;
}

.uni-crs-view-link {
    font-size: 13px;
    text-decoration: none;
    color: #5c6aff;
    font-weight: 600;
    flex-shrink: 0;
}

/* STATS */
.uni-crs-stats {
    display: flex;
    overflow-x: auto;
    border-top: 1px solid #f0f2f5;
}

.uni-crs-stat {
    flex: 1;
    text-align: center;
    padding: 12px 10px;
    border-right: 1px solid #f0f2f5;
}
.uni-crs-stat:last-child { border-right: none; }

.uni-crs-stat-label {
    font-size: 11px;
    color: #718096;
    margin-bottom: 4px;
}

.uni-crs-stat-value {
    font-size: 13px;
    font-weight: 700;
}

/* TABLET */
@media (min-width: 600px) {
    .uni-crs-results-bar {
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
    }
}
</style>
<div class="uni-section-title"><h4>University Courses</h4></div>
<div class="uni-crs-page">

    <div class="uni-crs-search-wrap">
        <input type="text" placeholder="Search Courses...">
    </div>

    <div class="uni-crs-filters">
        
        <div class="uni-custom-select" data-name="degree">
            <div class="uni-select-trigger">
                <span class="uni-trigger-text">Select Degree</span>
                <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
            </div>
            <div class="uni-select-dropdown">
                <div class="uni-select-option" data-value="bachelors">Bachelors 🎓<svg class="uni-check-icon" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg></div>
                <div class="uni-select-option" data-value="masters">Masters 🎓<svg class="uni-check-icon" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg></div>
                <div class="uni-select-option" data-value="phd">Ph.D 🔬<svg class="uni-check-icon" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg></div>
            </div>
            <input type="hidden" name="degree" value=""> </div>

        <div class="uni-custom-select" data-name="intake">
            <div class="uni-select-trigger">
                <span class="uni-trigger-text">Select Intake</span>
                <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
            </div>
            <div class="uni-select-dropdown">
                <div class="uni-select-option" data-value="fall">Fall (Sep) 🍂<svg class="uni-check-icon" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg></div>
                <div class="uni-select-option" data-value="spring">Spring (Jan) 🌸<svg class="uni-check-icon" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg></div>
            </div>
            <input type="hidden" name="intake" value="">
        </div>

        <div class="uni-custom-select" data-name="field">
            <div class="uni-select-trigger">
                <span class="uni-trigger-text">Select Field</span>
                <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
            </div>
            <div class="uni-select-dropdown">
                <div class="uni-select-option" data-value="science">Science 🥼<svg class="uni-check-icon" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg></div>
                <div class="uni-select-option" data-value="business">Business 💼<svg class="uni-check-icon" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg></div>
                <div class="uni-select-option" data-value="arts">Arts 🎨<svg class="uni-check-icon" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg></div>
            </div>
            <input type="hidden" name="field" value="">
        </div>

        <input class="uni-crs-input-fee" type="number" name="max_fees" placeholder="Max Fees (£)">
    </div>

    <div class="uni-crs-results-bar">
        <p class="uni-crs-results-text">
            Showing <strong>{{ count($university->courses) }}</strong> Courses
        </p>
    
        <div class="uni-crs-sort-wrap">
            <div class="uni-custom-select" data-name="sort_by">
                <div class="uni-select-trigger">
                    <span class="uni-trigger-text">Sort By</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
                <div class="uni-select-dropdown">
                    <div class="uni-select-option" data-value="low_to_high">Fees: Low to High</div>
                    <div class="uni-select-option" data-value="high_to_low">Fees: High to Low</div>
                </div>
                <input type="hidden" name="sort_by" value="">
            </div>
        </div>
    </div>
    
    
    @forelse($university->courses as $course)

        <div class="uni-crs-card">
            <div class="uni-crs-card-top">
                <div class="uni-crs-card-title">
                    {{ $course->course_name }}
                </div>
            </div>

            <div class="uni-crs-stats">
                <div class="uni-crs-stat">
                    <div class="uni-crs-stat-label">Fee</div>
                    <div class="uni-crs-stat-value">
                        {{ $course->currency_symbol ?? '£' }}
                        {{ number_format($course->tuition_fee) }}
                    </div>
                </div>

                <div class="uni-crs-stat">
                    <div class="uni-crs-stat-label">Duration</div>
                    <div class="uni-crs-stat-value">
                        {{ $course->duration ?? 'N/A' }}
                    </div>
                </div>

                <div class="uni-crs-stat">
                    <div class="uni-crs-stat-label">Degree</div>
                    <div class="uni-crs-stat-value">
                        {{ $course->course_type ?? 'N/A' }}
                    </div>
                </div>
            </div>
        </div>

    @empty
        <p>No courses available for this university.</p>
    @endforelse

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const customSelects = document.querySelectorAll('.uni-custom-select');

    customSelects.forEach(select => {
        const trigger = select.querySelector('.uni-select-trigger');
        const triggerText = select.querySelector('.uni-trigger-text');
        const options = select.querySelectorAll('.uni-select-option');
        const hiddenInput = select.querySelector('input[type="hidden"]');

        // Toggle dropdown open/close
        trigger.addEventListener('click', function(e) {
            e.stopPropagation();
            
            // Close any other open dropdowns first
            customSelects.forEach(otherSelect => {
                if (otherSelect !== select) {
                    otherSelect.classList.remove('open');
                }
            });

            select.classList.toggle('open');
        });

        // Handle option click
        options.forEach(option => {
            option.addEventListener('click', function(e) {
                e.stopPropagation();
                
                // Remove selected class from all options
                options.forEach(opt => opt.classList.remove('selected'));
                
                // Add selected class to clicked option
                this.classList.add('selected');

                // Update text and hidden input value
                const value = this.getAttribute('data-value');
                // Extract just the text part (ignoring icons if you want, but here we'll keep the emoji)
                triggerText.innerHTML = this.innerHTML.replace(/<svg.*<\/svg>/, ''); 
                triggerText.style.color = '#1a1a2e'; // Darken text once selected
                hiddenInput.value = value;

                // Close dropdown
                select.classList.remove('open');
            });
        });
    });

    // Close dropdowns when clicking outside
    document.addEventListener('click', function() {
        customSelects.forEach(select => {
            select.classList.remove('open');
        });
    });
});
</script>