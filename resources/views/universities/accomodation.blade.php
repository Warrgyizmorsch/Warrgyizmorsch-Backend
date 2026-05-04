{{-- ACCOMMODATION & COST OF LIVING SECTION --}}

<style>
.uni-read-more {
    color: #1a7f8c;
    font-weight: 500;
    display: inline-block;
    margin-bottom: 15px;
    word-break: break-word;
}

/* ACCOMMODATION GRID */
.uni-accommodation-grid {
    display: flex;
    flex-wrap: wrap;        /* wraps cards instead of overflowing */
    gap: 20px;
    margin-bottom: 20px;
}

.uni-accommodation-card {
    background: #fff;
    border-radius: 10px;
    overflow: hidden;
    border: 1px solid #eee;
    flex: 1 1 240px;        /* grows/shrinks; stacks when < 240px */
    min-width: 0;           /* prevents flex overflow */
}

.uni-accommodation-img {
    position: relative;
}

.uni-accommodation-img img {
    width: 100%;
    height: 160px;
    object-fit: cover;
    display: block;
}

.uni-badge {
    position: absolute;
    top: 10px;
    left: 10px;
    background: #f4a62a;
    color: #fff;
    padding: 4px 10px;
    font-size: 12px;
    border-radius: 6px;
    word-break: break-word;
}

.uni-accommodation-body {
    padding: 12px;
}

.uni-accommodation-body h4 {
    margin-bottom: 4px;
    word-break: break-word;
}

.uni-location {
    font-size: 12px;
    color: #666;
    margin-bottom: 6px;
    word-break: break-word;
}

.uni-accommodation-footer {
    display: flex;
    flex-wrap: wrap;        /* price + link wrap if card is narrow */
    justify-content: space-between;
    gap: 6px;
    margin-top: 10px;
    font-size: 13px;
}

/* VIEW ALL BUTTON */
.uni-view-all {
    margin: 20px 0;
}

.uni-view-all button {
    padding: 10px 20px;
    border: 1px solid #000;
    background: transparent;
    cursor: pointer;
    width: 100%;
    max-width: 200px;
}

/* COST TABLE */
.uni-cost-table {
    margin-top: 15px;
}

.uni-cost-row {
    display: flex;
    flex-wrap: wrap;        /* label + value wrap if screen is tight */
    justify-content: space-between;
    align-items: center;
    gap: 6px;
    padding: 12px;
    background: #f5f5f5;
    margin-bottom: 6px;
    border-radius: 6px;
    word-break: break-word;
}

.uni-cost-row.uni-head {
    background: transparent;
    font-weight: 600;
}

/* ── 580px — cards go full width, cost rows stack ── */
@media (max-width: 580px) {
    .uni-accommodation-card {
        flex: 1 1 100%;     /* full-width stacked cards */
    }

    .uni-view-all button {
        max-width: 100%;
    }

    .uni-cost-row {
        flex-direction: column;     /* label above value */
        align-items: flex-start;
    }

    .uni-cost-row.uni-head {
        flex-direction: row;        /* keep header labels side by side */
    }
}
</style>

<div>

    {{-- ACCOMMODATION --}}
    <div class="uni-section-title"><h4>Accommodation</h4></div>

    <p class="uni-about-text">
        There are several student accommodations in Hatfield University of Hertfordshire that are fully equipped
        for your needs. Student accommodation near University of Hertfordshire offers a wide choice of affordable
        yet elegant student flats, halls of residence, studios, ensuites, and more!
    </p>

    <a href="#" class="uni-read-more">Read More</a>

    {{-- CARDS --}}
    <div class="uni-accommodation-grid">

        {{-- You can loop over $accommodations from your controller here --}}
        {{-- @foreach($accommodations as $item) --}}

        {{-- CARD 1 --}}
        <div class="uni-accommodation-card">
            <div class="uni-accommodation-img">
                <span class="uni-badge">3 Offers + Bills Included</span>
                <img src="https://images.unsplash.com/photo-1505693416388-ac5ce068fe85" alt="Luna Hatfield">
            </div>
            <div class="uni-accommodation-body">
                <h4>Luna, Hatfield</h4>
                <p class="uni-location">301 St Albans Rd Hatfield</p>
                <div class="uni-accommodation-footer">
                    <span>£230 / per week</span>
                    <a href="#">View Details ›</a>
                </div>
            </div>
        </div>

        {{-- CARD 2 --}}
        <div class="uni-accommodation-card">
            <div class="uni-accommodation-img">
                <span class="uni-badge">5 Offers + Bills Included</span>
                <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267" alt="Curzon Point Hatfield">
            </div>
            <div class="uni-accommodation-body">
                <h4>Curzon Point, Hatfield</h4>
                <p class="uni-location">46 The Common, Hatfield</p>
                <div class="uni-accommodation-footer">
                    <span>£195 / per week</span>
                    <a href="#">View Details ›</a>
                </div>
            </div>
        </div>

        {{-- @endforeach --}}

    </div>

    {{-- VIEW ALL --}}
    <div class="uni-view-all">
        <button>View All ›</button>
    </div>

    {{-- COST OF LIVING --}}
    <div class="uni-section-title">Cost of Living</div>

    <p class="uni-about-text">
        Cost of living in Hertfordshire is affordable compared to other UK cities. Below is an estimate
        of monthly expenses to help you plan your budget effectively.
    </p>

    <div class="uni-cost-table">

        <div class="uni-cost-row uni-head">
            <span>Particulars</span>
            <span>Cost (Monthly)</span>
        </div>

        <div class="uni-cost-row">
            <span>Off-Campus Accommodation</span>
            <span>£584</span>
        </div>

        <div class="uni-cost-row">
            <span>On-Campus Accommodation</span>
            <span>£760</span>
        </div>

        <div class="uni-cost-row">
            <span>Transportation</span>
            <span>£60</span>
        </div>

        <div class="uni-cost-row">
            <span>Food Cost</span>
            <span>£225</span>
        </div>

        <div class="uni-cost-row">
            <span>Entertainment</span>
            <span>£39</span>
        </div>

        <div class="uni-cost-row">
            <span>Groceries</span>
            <span>£100</span>
        </div>

        <div class="uni-cost-row">
            <span>Clothes</span>
            <span>£78</span>
        </div>

    </div>

</div>