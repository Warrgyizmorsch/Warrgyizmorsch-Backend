<style>
  * {
    box-sizing: border-box;
  }

  .scholarship-wrap {
    width: 100%;
    max-width: 100%;
    font-family: sans-serif;
    color: #333;
  }

  .scholarship-wrap p {
    font-size: 14px;
    color: #555;
    line-height: 1.75;
    margin-bottom: 16px;
  }

  .scholarship-section {
    margin: 24px 0;
  }

  .scholarship-section-title {
    font-size: 15px;
    font-weight: 700;
    color: #1a2a3a;
    margin-bottom: 10px;
    line-height: 1.4;
  }

  /* TABLE STYLES */
  .scholarship-table-wrap {
    width: 100%;
    border: 1px solid #ddd;
    border-radius: 6px;
    overflow: hidden;
  }

  .scholarship-table-wrap table {
    width: 100%;
    border-collapse: collapse;
    table-layout: fixed;
  }

  .scholarship-table-wrap thead tr {
    background: #f0f0f0;
  }

  .scholarship-table-wrap thead th {
    padding: 10px 12px;
    text-align: left;
    font-size: 12px;
    font-weight: 700;
    color: #333;
    border-bottom: 1px solid #ddd;
  }

  .scholarship-table-wrap thead th:nth-child(1) { width: 35%; }
  .scholarship-table-wrap thead th:nth-child(2) { width: 25%; }
  .scholarship-table-wrap thead th:nth-child(3) { width: 40%; }

  .scholarship-table-wrap tbody tr {
    border-bottom: 1px solid #eee;
  }

  .scholarship-table-wrap tbody tr:last-child {
    border-bottom: none;
  }

  .scholarship-table-wrap tbody td {
    padding: 10px 12px;
    font-size: 13px;
    color: #444;
    vertical-align: top;
    line-height: 1.55;
    word-wrap: break-word;
    overflow-wrap: break-word;
    white-space: normal;
  }

  .scholarship-table-wrap tbody td:first-child {
    font-weight: 600;
    color: #222;
  }

  /* MOBILE: Stack rows as labeled blocks */
  @media (max-width: 600px) {
    .scholarship-table-wrap {
      border: none;
      border-radius: 0;
    }

    .scholarship-table-wrap table,
    .scholarship-table-wrap thead,
    .scholarship-table-wrap tbody,
    .scholarship-table-wrap th,
    .scholarship-table-wrap td,
    .scholarship-table-wrap tr {
      display: block;
      width: 100%;
    }

    .scholarship-table-wrap thead {
      display: none;
    }

    .scholarship-table-wrap tbody tr {
      border: 1px solid #ddd;
      border-radius: 6px;
      margin-bottom: 10px;
      padding: 10px;
      background: #fff;
    }

    .scholarship-table-wrap tbody td {
      padding: 4px 0;
      font-size: 13px;
      border: none;
      position: relative;
      padding-left: 0;
    }

    .scholarship-table-wrap tbody td::before {
      content: attr(data-label);
      display: block;
      font-size: 10px;
      font-weight: 700;
      color: #999;
      text-transform: uppercase;
      margin-bottom: 2px;
    }

    .scholarship-table-wrap tbody td:first-child {
      font-size: 14px;
      font-weight: 700;
      color: #1a2a3a;
      margin-bottom: 6px;
      padding-bottom: 6px;
      border-bottom: 1px solid #eee !important;
    }

    .scholarship-table-wrap tbody td:first-child::before {
      display: none;
    }
  }

  /* LIST STYLES */
  .scholarship-list {
    list-style: disc;
    padding-left: 18px;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 6px;
  }

  .scholarship-list li {
    font-size: 13px;
    color: #444;
    line-height: 1.65;
    word-break: break-word;
  }

  .scholarship-list li strong {
    color: #222;
  }

  .scholarship-read-more {
    display: inline-block;
    margin-top: 16px;
    font-size: 13px;
    color: #1a56db;
    text-decoration: none;
    cursor: pointer;
  }

  .scholarship-view-all {
    display: block;
    width: 100%;
    margin-top: 20px;
    padding: 11px;
    background: #fff;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 600;
    color: #333;
    text-align: center;
    cursor: pointer;
  }
</style>

<div class="scholarship-wrap">
  
    <div class="uni-section-title"><h4>Scholarship</h4></div>
  <p>
    The University of Hertfordshire offers a variety of scholarships to support international students joining in 2025.
    These awards help reduce tuition fees and reward academic excellence, leadership, and sporting talent. Many
    scholarships are automatically assessed during admissions, while others require a separate application.
  </p>

  <!-- UG Scholarships -->
  <div class="scholarship-section">
    <div class="scholarship-section-title">The University of Hertfordshire Scholarships for Undergraduate International Students</div>
    <div class="scholarship-table-wrap">
      <table>
        <thead>
          <tr>
            <th>Scholarship Name</th>
            <th>Award Amount</th>
            <th>Eligibility &amp; Notes</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td data-label="">Chancellor's International Scholarship</td>
            <td data-label="Award Amount">£500 to £4,000</td>
            <td data-label="Eligibility & Notes">Automatically awarded to new full-time UG students (except Health &amp; Social Work), based on academic merit and English proficiency. No separate application needed.</td>
          </tr>
          <tr>
            <td data-label="">UG Tri Annual Scholarship</td>
            <td data-label="Award Amount">£1,500 per year (renewable)</td>
            <td data-label="Eligibility & Notes">For new international undergraduates joining in January 2025, awarded on academic merit.</td>
          </tr>
          <tr>
            <td data-label="">International Partner Discount</td>
            <td data-label="Award Amount">£2,000 off first-year tuition</td>
            <td data-label="Eligibility & Notes">For students applying through partner institutions, excluding Health &amp; Social Work courses.</td>
          </tr>
          <tr>
            <td data-label="">Sports Scholarship</td>
            <td data-label="Award Amount">Varies</td>
            <td data-label="Eligibility & Notes">For talented athletes competing at regional or national levels.</td>
          </tr>
          <tr>
            <td data-label="">Full Payment Discount</td>
            <td data-label="Award Amount">£1,000</td>
            <td data-label="Eligibility & Notes">For students paying full tuition fees at registration.</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- PG Scholarships -->
  <div class="scholarship-section">
    <div class="scholarship-section-title">The University of Hertfordshire Scholarships for Graduate International Students</div>
    <div class="scholarship-table-wrap">
      <table>
        <thead>
          <tr>
            <th>Scholarship Name</th>
            <th>Award Amount</th>
            <th>Eligibility &amp; Notes</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td data-label="">Chancellor's International Scholarship</td>
            <td data-label="Award Amount">£500 to £4,000</td>
            <td data-label="Eligibility & Notes">Automatically awarded to new full-time postgraduate taught students (except Health &amp; Social Work), based on academic merit and English proficiency.</td>
          </tr>
          <tr>
            <td data-label="">Early Bird and Super Early Bird Discounts</td>
            <td data-label="Award Amount">£1,000 to £2,000</td>
            <td data-label="Eligibility & Notes">For postgraduate students paying tuition fees early.</td>
          </tr>
          <tr>
            <td data-label="">Graduate Scholarship – Herts Alumni Discount</td>
            <td data-label="Award Amount">20% tuition fee reduction</td>
            <td data-label="Eligibility & Notes">For UH alumni returning for a postgraduate degree.</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Deadlines -->
  <div class="scholarship-section">
    <div class="scholarship-section-title">The University of Hertfordshire Scholarships Deadline</div>
    <ul class="scholarship-list">
      <li><strong>Chancellor's International Scholarship:</strong> Assessed automatically for September 2025 intake; applicants must have accepted an offer by January 4, 2025.</li>
      <li><strong>UG Tri Annual Scholarship:</strong> Application deadline varies, generally early January for January intake.</li>
      <li><strong>Other scholarships and discounts:</strong> Deadlines vary; early application is recommended to maximise eligibility.</li>
    </ul>
  </div>

  <!-- Application Process -->
  <div class="scholarship-section">
    <div class="scholarship-section-title">The University of Hertfordshire Scholarships Application Process</div>
    <ul class="scholarship-list">
      <li>Most scholarships, including the Chancellor's International Scholarship, are automatically assessed during the admissions process — no separate application is required.</li>
      <li>Students must submit relevant documents or portfolios as specified for scholarships requiring applications (e.g., Sports Scholarships).</li>
      <li>Applicants must have an offer of admission and meet academic and English language criteria.</li>
      <li>Scholarship awards are deducted from tuition fees upon registration.</li>
    </ul>
  </div>

  <!-- External Scholarships -->
  <div class="scholarship-section">
    <div class="scholarship-section-title">The University of Hertfordshire External Scholarships for International Students</div>
    <p>International students can also apply for external funding sources such as:</p>
    <ul class="scholarship-list">
      <li><strong>Chevening Scholarship:</strong> UK government-funded award for outstanding students.</li>
      <li><strong>Aga Khan Foundation:</strong> For students from South Asia and East Africa.</li>
      <li><strong>Narotam Sekhsaria Foundation Loan Scholarship:</strong> Interest-free loan for Indian students.</li>
      <li><strong>Goa Education Trust Scholarship:</strong> For students from Goa, India.</li>
    </ul>
  </div>

  <a class="scholarship-read-more">Read Less</a>
  <button class="scholarship-view-all">View All +</button>

</div>