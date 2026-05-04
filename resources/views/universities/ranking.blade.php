<style>
/* ── YOUR ORIGINAL DESKTOP CSS ── */
.uni-about-text {
  font-size: 14px;
  color: #555;
  line-height: 1.75;
  margin-bottom: 12px;
}

.uni-employers-section {
  margin: 28px 0;
}

.uni-employers-section h3 {
  font-size: 16px;
  font-weight: 700;
  color: #1a2a3a;
  margin-bottom: 6px;
}

.uni-employers-table-wrap {
  width: 100%;
  display: block;
  overflow-x: auto;
  -webkit-overflow-scrolling: touch;
  border: 1px solid #eee;
  border-radius: 8px;
  margin-bottom: 12px;
}

.uni-employers-table-wrap table {
  width: 100%;
  border-collapse: collapse;
  min-width: 320px;
  table-layout: auto;
}

.uni-employers-table-wrap thead tr {
  background: #1a2a3a;
  color: #fff;
}

.uni-employers-table-wrap thead th {
  padding: 12px 14px;
  text-align: left;
  font-size: 13px;
  font-weight: 600;
  white-space: nowrap;
  color: #fff;
}

.uni-employers-table-wrap tbody tr {
  border-bottom: 1px solid #eee;
  background: #fff;
}

.uni-employers-table-wrap tbody tr:nth-child(even) {
  background: #f9fafb;
}

.uni-employers-table-wrap tbody tr:last-child {
  border-bottom: none;
}

.uni-employers-table-wrap tbody td {
  padding: 11px 14px;
  font-size: 13px;
  color: #444;
  white-space: nowrap;
}

/* ── NEW MOBILE-ONLY CSS (Transforms tables into cards) ── */
@media (max-width: 600px) {
  .uni-employers-table-wrap {
    border: none;
    background: transparent;
    overflow: visible; /* Prevent clipping */
  }
  
  .uni-employers-table-wrap table {
    min-width: 100%;
  }

  /* Hide the top table header row on mobile */
  .uni-employers-table-wrap thead {
    display: none; 
  }

  /* Turn each row into a standalone card */
  .uni-employers-table-wrap tbody tr {
    display: block;
    margin-bottom: 16px;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    background: #fff !important; /* Removes alternating striping for cards */
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
  }

  /* Flex layout to put label on left, data on right */
  .uni-employers-table-wrap tbody td {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 14px;
    border-bottom: 1px solid #f0f0f0;
    text-align: right;
    white-space: normal; /* Allow text to wrap if needed */
  }

  .uni-employers-table-wrap tbody td:last-child {
    border-bottom: none;
  }

  /* Pulls the 'data-label' attribute from HTML to act as the column header */
  .uni-employers-table-wrap tbody td::before {
    content: attr(data-label);
    font-weight: 600;
    color: #1a2a3a;
    text-align: left;
    margin-right: 15px;
  }
}
</style>

<div>
  

  <div class="uni-section-title"><h4>University Rankings</h4></div>

  <p class="uni-about-text">
    The University of Hertfordshire performs well across multiple disciplines, with strong rankings in Economics, Journalism, Engineering, and Physics across leading global ranking bodies.
  </p>

  <div class="uni-employers-section">
    <h3>Top Subject Rankings (Guardian 2025)</h3>
    <div class="uni-employers-table-wrap">
      <table>
        <thead>
          <tr>
            <th>Subject</th>
            <th>Ranking</th>
          </tr>
        </thead>
        <tbody>
          <tr><td data-label="Subject">Economics</td><td data-label="Ranking">#36</td></tr>
          <tr><td data-label="Subject">Journalism</td><td data-label="Ranking">#37</td></tr>
          <tr><td data-label="Subject">Physics</td><td data-label="Ranking">#44</td></tr>
          <tr><td data-label="Subject">Mechanical Engineering</td><td data-label="Ranking">#47</td></tr>
          <tr><td data-label="Subject">Architecture</td><td data-label="Ranking">#54</td></tr>
        </tbody>
      </table>
    </div>
  </div>

  <div class="uni-employers-section">
    <h3>US News &amp; World Report 2025</h3>
    <div class="uni-employers-table-wrap">
      <table>
        <thead>
          <tr>
            <th>Metric</th>
            <th>Ranking</th>
          </tr>
        </thead>
        <tbody>
          <tr><td data-label="Metric">Global Ranking</td><td data-label="Ranking">#1101</td></tr>
        </tbody>
      </table>
    </div>
  </div>

  <div class="uni-employers-section">
    <h3>The Guardian Rankings 2025</h3>
    <div class="uni-employers-table-wrap">
      <table>
        <thead>
          <tr>
            <th>Metric</th>
            <th>Ranking</th>
          </tr>
        </thead>
        <tbody>
          <tr><td data-label="Metric">UK National Rank</td><td data-label="Ranking">#75</td></tr>
          <tr><td data-label="Metric">Teaching Quality</td><td data-label="Ranking">Top 50 (approx.)</td></tr>
          <tr><td data-label="Metric">Student-Staff Ratio</td><td data-label="Ranking">Top 70 (approx.)</td></tr>
          <tr><td data-label="Metric">Career Prospects</td><td data-label="Ranking">Top 60 (approx.)</td></tr>
          <tr><td data-label="Metric">Entry Standards</td><td data-label="Ranking">Top 80 (approx.)</td></tr>
        </tbody>
      </table>
    </div>
  </div>

  <div class="uni-employers-section">
    <h3>Complete University Guide 2025</h3>
    <div class="uni-employers-table-wrap">
      <table>
        <thead>
          <tr>
            <th>Metric</th>
            <th>Ranking</th>
          </tr>
        </thead>
        <tbody>
          <tr><td data-label="Metric">UK National Rank</td><td data-label="Ranking">#82</td></tr>
        </tbody>
      </table>
    </div>
  </div>

  <div class="uni-employers-section">
    <h3>QS Rankings 2026</h3>
    <div class="uni-employers-table-wrap">
      <table>
        <thead>
          <tr>
            <th>Category</th>
            <th>Ranking</th>
          </tr>
        </thead>
        <tbody>
          <tr><td data-label="Category">World University</td><td data-label="Ranking">901-950</td></tr>
          <tr><td data-label="Category">Medicine</td><td data-label="Ranking">701</td></tr>
          <tr><td data-label="Category">Physics &amp; Astronomy</td><td data-label="Ranking">601</td></tr>
        </tbody>
      </table>
    </div>
  </div>

  <div class="uni-employers-section">
    <h3>Times Higher Education (THE) 2025</h3>
    <div class="uni-employers-table-wrap">
      <table>
        <thead>
          <tr>
            <th>Category</th>
            <th>Ranking</th>
          </tr>
        </thead>
        <tbody>
          <tr><td data-label="Category">Overall</td><td data-label="Ranking">601-800</td></tr>
          <tr><td data-label="Category">Arts &amp; Humanities</td><td data-label="Ranking">401-500</td></tr>
          <tr><td data-label="Category">Clinical &amp; Health</td><td data-label="Ranking">501-600</td></tr>
          <tr><td data-label="Category">Engineering</td><td data-label="Ranking">601-800</td></tr>
          <tr><td data-label="Category">Psychology</td><td data-label="Ranking">301-400</td></tr>
        </tbody>
      </table>
    </div>
  </div>

  <div class="uni-employers-section">
    <h3>Ranking Trends (QS &amp; US News)</h3>
    <div class="uni-employers-table-wrap">
      <table>
        <thead>
          <tr>
            <th>Year</th>
            <th>QS Rank</th>
            <th>US News Rank</th>
          </tr>
        </thead>
        <tbody>
          <tr><td data-label="Year">2025</td><td data-label="QS Rank">#851 - 900</td><td data-label="US News Rank">-</td></tr>
          <tr><td data-label="Year">2024</td><td data-label="QS Rank">#851 - 900</td><td data-label="US News Rank">#1101</td></tr>
          <tr><td data-label="Year">2023</td><td data-label="QS Rank">#801 - 1000</td><td data-label="US News Rank">#1172</td></tr>
          <tr><td data-label="Year">2022</td><td data-label="QS Rank">#801 - 1000</td><td data-label="US News Rank">#1172</td></tr>
          <tr><td data-label="Year">2021</td><td data-label="QS Rank">#801 - 1000</td><td data-label="US News Rank">#1160</td></tr>
        </tbody>
      </table>
    </div>
  </div>

</div>