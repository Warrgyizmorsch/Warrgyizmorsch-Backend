{{-- APPLICATION PROCESS, DEADLINES, VISA & SIMILAR UNIVERSITIES SECTION --}}

<style>
/* ── THINGS LIST ── */
.uni-things-list {
    padding-left: 20px;
    margin-bottom: 15px;
    line-height: 1.8;
    word-break: break-word;
}

.uni-things-list li {
    margin-bottom: 6px;
}

.uni-things-list ul {
    padding-left: 18px;
    margin-top: 4px;
}

/* ── EMPLOYERS / DETAILS TABLE ── */
.uni-employers-section {
    margin: 15px 0;
    overflow-x: auto;           /* horizontal scroll on very small screens */
    -webkit-overflow-scrolling: touch;
}

.uni-employers-section table {
    width: 100%;
    border-collapse: collapse;
    table-layout: fixed;        /* equal column widths, no overflow */
    min-width: 320px;           /* keeps table readable before scrolling kicks in */
}

.uni-employers-section th,
.uni-employers-section td {
    padding: 10px 12px;
    border: 1px solid #eee;
    font-size: 14px;
    word-break: break-word;     /* long words wrap instead of stretching column */
    vertical-align: top;
}

.uni-employers-section thead tr {
    background: #f5f5f5;
    font-weight: 600;
}

/* ── SIMILAR UNIVERSITIES GRID ── */
.uni-similar-grid {
    display: flex;
    flex-wrap: wrap;            /* cards wrap instead of overflowing */
    gap: 20px;
    margin-top: 15px;
}

.uni-similar-card {
    flex: 1 1 220px;            /* side-by-side on desktop, wraps on mobile */
    min-width: 0;               /* prevents flex overflow */
    background: #fff;
    border: 1px solid #eee;
    border-radius: 10px;
    overflow: hidden;
}

.uni-similar-card img {
    width: 100%;
    height: 140px;
    object-fit: cover;
    display: block;
}

.uni-similar-body {
    padding: 12px;
}

.uni-similar-body h4 {
    font-size: 14px;
    margin-bottom: 5px;
    word-break: break-word;
}

.uni-similar-body p {
    font-size: 12px;
    color: #666;
}

.uni-similar-body a {
    display: inline-block;
    margin-top: 8px;
    color: #1a7f8c;
    font-weight: 600;
    text-decoration: none;
}

/* ── 580px — cards full width, table switches to card layout ── */
@media (max-width: 580px) {

    /* Similar university cards stack */
    .uni-similar-card {
        flex: 1 1 100%;
    }

    /* Details / Deadlines table → card layout (same pattern as employers/scholarships) */
    .uni-employers-section table,
    .uni-employers-section thead,
    .uni-employers-section tbody,
    .uni-employers-section th,
    .uni-employers-section td,
    .uni-employers-section tr {
        display: block;
        width: 100%;
    }

    .uni-employers-section thead tr {
        display: none;          /* hide column headers; labels come from data-label */
    }

    .uni-employers-section tbody tr {
        background: #f9f9f9;
        border: 1px solid #eee;
        border-radius: 8px;
        margin-bottom: 10px;
        padding: 8px;
    }

    .uni-employers-section td {
        border: none;
        padding: 6px 8px;
        display: flex;
        gap: 8px;
        align-items: flex-start;
    }

    /* Show the column label as a badge before the value */
    .uni-employers-section td::before {
        content: attr(data-label);
        font-weight: 600;
        min-width: 90px;
        color: #444;
        flex-shrink: 0;
    }
}
</style>

<div>

    {{-- APPLICATION PROCESS --}}
    <div class="uni-section-title"><h4>University of Hertfordshire Application Process 2025 </h4></div>

    <ul class="uni-things-list">
        <li><strong>Choose Your Course:</strong> Explore UH's programmes and select your preferred course and intake.</li>
        <li><strong>Check Eligibility:</strong> Review academic and English language requirements.</li>
        <li><strong>Prepare Documents:</strong> Transcripts, certificates, SOP, references, test scores, passport.</li>
        <li><strong>Submit Application:</strong>
            <ul>
                <li><strong>Undergraduate:</strong> Apply via UCAS.</li>
                <li><strong>Postgraduate:</strong> Apply via UH website.</li>
            </ul>
        </li>
        <li><strong>Await Decision:</strong> Receive offer within a few weeks.</li>
        <li><strong>Accept Offer & Visa:</strong> Use CAS to apply for visa.</li>
        <li><strong>Arrange Payment & Stay:</strong> Pay deposit and secure accommodation.</li>
    </ul>

    <p class="uni-about-text">
        The University of Hertfordshire welcomes students from over 110 countries and offers flexible entry routes,
        rolling admissions, and strong international support.
    </p>

    {{-- DETAILS TABLE --}}
    <div class="uni-employers-section">
        <table>
            <thead>
                <tr>
                    <th>Details</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td data-label="Details">Wide Range of Programmes</td>
                    <td data-label="Description">300+ undergraduate and postgraduate courses</td>
                </tr>
                <tr>
                    <td data-label="Details">Flexible Deadlines</td>
                    <td data-label="Description">Multiple intakes and rolling deadlines</td>
                </tr>
                <tr>
                    <td data-label="Details">English Requirements</td>
                    <td data-label="Description">IELTS, TOEFL, PTE accepted</td>
                </tr>
                <tr>
                    <td data-label="Details">International Support</td>
                    <td data-label="Description">Guidance for visa, accommodation, and applications</td>
                </tr>
                <tr>
                    <td data-label="Details">Scholarships</td>
                    <td data-label="Description">Merit-based and early bird discounts available</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- APPLICATION DEADLINES --}}
    <div class="uni-section-title">Application Deadlines 2025</div>

    <div class="uni-employers-section">
        <table>
            <thead>
                <tr>
                    <th>Intake</th>
                    <th>UG Deadline</th>
                    <th>PG Deadline</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td data-label="Intake">September</td>
                    <td data-label="UG Deadline">30 June 2025</td>
                    <td data-label="PG Deadline">Rolling admissions</td>
                </tr>
                <tr>
                    <td data-label="Intake">January</td>
                    <td data-label="UG Deadline">Varies</td>
                    <td data-label="PG Deadline">Rolling admissions</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- VISA REQUIREMENTS --}}
    <div class="uni-section-title">Visa Requirements</div>

    <ul class="uni-things-list">
        <li>CAS (Confirmation of Acceptance)</li>
        <li>Valid Passport</li>
        <li>English test scores (IELTS/TOEFL/PTE)</li>
        <li>Proof of funds</li>
        <li>TB test (if required)</li>
        <li>Accommodation confirmation</li>
    </ul>

    {{-- SIMILAR UNIVERSITIES --}}
    <div class="uni-section-title">Similar Universities</div>

    <div class="uni-similar-grid">

        {{-- You can loop over $similarUniversities from your controller here --}}
        {{-- @foreach($similarUniversities as $uni) --}}

        <div class="uni-similar-card">
            <img src="https://images.unsplash.com/photo-1581093458791-9d8c9f1a6f5e" alt="Ulster University">
            <div class="uni-similar-body">
                <h4>Ulster University</h4>
                <p>United Kingdom</p>
                <a href="#">View University ›</a>
            </div>
        </div>

        <div class="uni-similar-card">
            <img src="https://images.unsplash.com/photo-1562774053-701939374585" alt="University of Bolton">
            <div class="uni-similar-body">
                <h4>University of Bolton</h4>
                <p>United Kingdom</p>
                <a href="#">View University ›</a>
            </div>
        </div>

        <div class="uni-similar-card">
            <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1" alt="BPP University">
            <div class="uni-similar-body">
                <h4>BPP University</h4>
                <p>United Kingdom</p>
                <a href="#">View University ›</a>
            </div>
        </div>

        {{-- @endforeach --}}

    </div>

</div>