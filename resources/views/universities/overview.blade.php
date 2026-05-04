<style>
  * {
    box-sizing: border-box;
  }

  .uni-about-text {
    font-size: 14px;
    color: #555;
    line-height: 1.75;
    margin-bottom: 12px;
  }

  .uni-quote-block {
    background: linear-gradient(135deg, #fff8f2, #fff3e8);
    border-left: 4px solid #E87722;
    padding: 16px 20px;
    border-radius: 0 8px 8px 0;
    margin: 20px 0;
    font-style: italic;
    font-size: 14px;
    color: #555;
    line-height: 1.7;
  }

  .uni-stats-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 14px;
    margin: 24px 0;
  }

  .uni-stat-card {
    background: #fff;
    border: 1px solid #e0e0e0;
    border-radius: 10px;
    padding: 18px 14px;
    text-align: center;
    flex: 1 1 120px;
  }

  .uni-stat-card .uni-num {
    font-size: 24px;
    font-weight: 700;
    color: #E87722;
  }

  .uni-stat-card .uni-lbl {
    font-size: 12px;
    color: #666;
    margin-top: 4px;
  }

  .uni-things-section {
    margin: 28px 0;
  }

  .uni-things-section h3 {
    font-size: 16px;
    font-weight: 700;
    color: #1a2a3a;
    margin-bottom: 14px;
  }

  .uni-things-list {
    list-style: none;
    padding: 0;
    display: flex;
    flex-direction: column;
    gap: 10px;
  }

  .uni-things-list li {
    font-size: 14px;
    color: #444;
    line-height: 1.6;
    padding-left: 20px;
    position: relative;
    word-break: break-word;
  }

  .uni-things-list li::before {
    content: '●';
    color: #E87722;
    position: absolute;
    left: 0;
    font-size: 10px;
    top: 4px;
  }

  .uni-things-list li strong {
    color: #1a2a3a;
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

  .uni-employers-section > p {
    font-size: 13px;
    color: #555;
    margin-bottom: 14px;
    line-height: 1.6;
  }

  .uni-employers-table-wrap {
    width: 100%;
    border: 1px solid #eee;
    border-radius: 8px;
    overflow: hidden;
  }

  .uni-employers-table-wrap table {
    width: 100%;
    border-collapse: collapse;
    table-layout: fixed;
  }

  .uni-employers-table-wrap thead th:nth-child(1) { width: 30%; }
  .uni-employers-table-wrap thead th:nth-child(2) { width: 30%; }
  .uni-employers-table-wrap thead th:nth-child(3) { width: 40%; }

  .uni-employers-table-wrap thead tr {
    background: #1a2a3a;
    color: #fff;
  }

  .uni-employers-table-wrap thead th {
    padding: 12px 14px;
    text-align: left;
    font-size: 13px;
    font-weight: 600;
    color: #fff;
    word-break: break-word;
    white-space: normal;
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
    word-break: break-word;
    white-space: normal;
    vertical-align: top;
  }

  /* Mobile employer cards */
  .uni-employer-cards {
    display: none;
    flex-direction: column;
    gap: 10px;
  }

  .uni-employer-card {
    background: #f5f9fa;
    border: 1px solid #e0eef0;
    border-radius: 10px;
    padding: 14px 16px;
  }

  .uni-employer-card-name {
    font-size: 14px;
    font-weight: 700;
    color: #111;
    margin-bottom: 8px;
    padding-bottom: 8px;
    border-bottom: 1px solid #e0eef0;
  }

  .uni-employer-card-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-top: 6px;
  }

  .uni-employer-card-pill {
    background: #fff;
    border: 1px solid #e5e5e5;
    border-radius: 6px;
    padding: 5px 10px;
    font-size: 12px;
    color: #444;
  }

  .uni-employer-card-pill span {
    display: block;
    font-size: 10px;
    color: #999;
    margin-bottom: 1px;
  }

  .uni-campus-section {
    margin: 28px 0;
  }

  .uni-campus-section h3 {
    font-size: 16px;
    font-weight: 700;
    color: #1a2a3a;
    margin-bottom: 16px;
  }

  .uni-campus-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 14px;
  }

  .uni-campus-card {
    background: #fff;
    border: 1px solid #e0e0e0;
    border-radius: 10px;
    padding: 16px;
    display: flex;
    gap: 12px;
    flex: 1 1 260px;
  }

  .uni-campus-icon {
    width: 42px;
    height: 42px;
    border-radius: 10px;
    background: #f0f4ff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    flex-shrink: 0;
  }

  .uni-campus-card h4 {
    font-size: 14px;
    font-weight: 700;
    color: #1a2a3a;
    margin-bottom: 5px;
  }

  .uni-campus-card p {
    font-size: 12px;
    color: #666;
    line-height: 1.55;
    margin: 0;
    word-break: break-word;
  }

  .uni-alumni-section {
    margin: 28px 0;
  }

  .uni-alumni-section h3 {
    font-size: 16px;
    font-weight: 700;
    color: #1a2a3a;
    margin-bottom: 16px;
  }

  .uni-alumni-row {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
  }

  .uni-alumni-card {
    text-align: center;
    flex: 1 1 120px;
  }

  .uni-alumni-avatar {
    width: 62px;
    height: 62px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    font-weight: 800;
    color: #fff;
    margin: 0 auto 10px;
  }

  .uni-alumni-name {
    font-size: 13px;
    font-weight: 700;
    color: #1a2a3a;
    word-break: break-word;
  }

  .uni-alumni-role {
    font-size: 11px;
    color: #666;
    margin-top: 3px;
    line-height: 1.4;
    word-break: break-word;
  }

  @media (max-width: 580px) {
    .uni-about-text {
      font-size: 13px;
    }

    .uni-campus-card {
      flex: 1 1 100%;
    }

    .uni-stat-card {
      flex: 1 1 80px;
    }

    .uni-stat-card .uni-num {
      font-size: 18px;
    }
  }
</style>

<div>
 
  <div class="uni-section-title" style="padding-top:10px" ><h4>About University of Hertfordshire</h4></div>

  <p class="uni-about-text">
    The University of Hertfordshire (UH) is a modern public university located in Hatfield, Hertfordshire, just north
    of London. With a strong focus on practical learning and employability, UH welcomes over 32,000 students, including
    more than 13,000 international students from around 100 countries, making it one of the most diverse campuses in
    the UK outside London.
  </p>
  <p class="uni-about-text">
    UH operates across two main campuses — College Lane and de Havilland — each offering state-of-the-art facilities,
    vibrant student communities, and easy access to London. The university's nine schools cover disciplines from
    business and engineering to creative arts, health, and law.
  </p>

  <div class="uni-quote-block">
    "96% of UH graduates are in employment or further study within 15 months of finishing their degree — one of the
    UK's strongest employability records."
  </div>

  <div class="uni-stats-grid">
    <div class="uni-stat-card"><div class="uni-num">96%</div><div class="uni-lbl">Graduate Employability</div></div>
    <div class="uni-stat-card"><div class="uni-num">110+</div><div class="uni-lbl">Countries Represented</div></div>
    <div class="uni-stat-card"><div class="uni-num">35,000+</div><div class="uni-lbl">Total Students</div></div>
    <div class="uni-stat-card"><div class="uni-num">800+</div><div class="uni-lbl">Courses Offered</div></div>
    <div class="uni-stat-card"><div class="uni-num">5,000+</div><div class="uni-lbl">Industry Partners</div></div>
    <div class="uni-stat-card"><div class="uni-num">£100Cr+</div><div class="uni-lbl">Scholarships Awarded</div></div>
  </div>

  <div class="uni-things-section">
    <h3>Things to Know About UH</h3>
    <ul class="uni-things-list">
      <li>Founded in <strong>1952 as Hatfield Technical College</strong>, initially training aerospace engineers for Britain's aviation industry.</li>
      <li>Became <strong>Hatfield Polytechnic in 1969</strong>, expanding in applied sciences and technology education.</li>
      <li>Gained <strong>full university status in 1992</strong> and was renamed the University of Hertfordshire.</li>
      <li>Among the first to offer <strong>honours degrees in engineering and technology</strong>, setting up its own observatory.</li>
      <li>Today serves <strong>35,000+ students from 110+ countries</strong>, recognised for employability and research excellence.</li>
    </ul>
  </div>

  <div class="uni-employers-section">
    <h3>Placements &amp; Top Employers</h3>
    <p>UH works with 5,000+ businesses including KPMG, Tesla, Microsoft, GSK, NHS, Deloitte, Amazon and Accenture.
       78% of employed graduates secure professional or managerial roles.</p>

    <div class="uni-employers-table-wrap">
      <table>
        <thead>
          <tr>
            <th>Employer</th>
            <th>Industry</th>
            <th>Known For</th>
          </tr>
        </thead>
        <tbody>
          <tr><td>Airbus</td><td>Aerospace &amp; Engineering</td><td>Aircraft design, manufacturing and innovation</td></tr>
          <tr><td>NHS</td><td>Healthcare &amp; Public Sector</td><td>UK's largest employer in health sciences</td></tr>
          <tr><td>Warner Bros.</td><td>Media &amp; Creative Industries</td><td>Film production, media and entertainment</td></tr>
          <tr><td>Deloitte</td><td>Professional Services</td><td>Audit, finance, consulting and strategy</td></tr>
          <tr><td>GlaxoSmithKline (GSK)</td><td>Pharmaceuticals &amp; Science</td><td>Global pharmaceutical research</td></tr>
          <tr><td>BT Group</td><td>Technology &amp; Telecoms</td><td>Telecommunications and digital solutions</td></tr>
          <tr><td>Jaguar Land Rover</td><td>Automotive</td><td>Advanced vehicle design and engineering</td></tr>
        </tbody>
      </table>
    </div>

    <div class="uni-employer-cards"></div>
  </div>

  <div class="uni-campus-section">
    <h3>Campus Life</h3>
    <div class="uni-campus-grid">
      <div class="uni-campus-card">
        <div class="uni-campus-icon"><i class="fa-solid fa-house"></i></div>
        <div>
          <h4>Modern Accommodation</h4>
          <p>3,300+ bedrooms across College Lane and de Havilland campuses — en-suite rooms, townhouses, and studio flats with Wi-Fi included.</p>
        </div>
      </div>
      <div class="uni-campus-card">
        <div class="uni-campus-icon"><i class="fa-solid fa-futbol"></i></div>
        <div>
          <h4>Sports Village</h4>
          <p>State-of-the-art fitness equipment, sports halls, swimming pools, and outdoor pitches — one of the UK's best campus sports facilities.</p>
        </div>
      </div>
      <div class="uni-campus-card">
        <div class="uni-campus-icon"><i class="fa-solid fa-book"></i></div>
        <div>
          <h4>Learning Resources</h4>
          <p>24/7 Learning Resource Centres with computer suites, printing, and access to thousands of ebooks and journals online.</p>
        </div>
      </div>
      <div class="uni-campus-card">
        <div class="uni-campus-icon"><i class="fa-solid fa-microscope"></i></div>
        <div>
          <h4>Specialist Labs &amp; Studios</h4>
          <p>Medical simulation centres, pharmaceutical labs, film &amp; TV studios, and digital media suites for hands-on learning.</p>
        </div>
      </div>
      <div class="uni-campus-card">
        <div class="uni-campus-icon"><i class="fa-solid fa-heart"></i></div>
        <div>
          <h4>Health &amp; Wellbeing</h4>
          <p>On-campus medical centres, mental health support, and Women's Safety and Resources Centre available to all students.</p>
        </div>
      </div>
      <div class="uni-campus-card">
        <div class="uni-campus-icon"><i class="fa-solid fa-champagne-glasses"></i></div>
        <div>
          <h4>100+ Societies</h4>
          <p>Student Union organises cultural festivals, live music, and social nights. Over 100 clubs and societies to join.</p>
        </div>
      </div>
    </div>
  </div>

  <div class="uni-alumni-section">
    <h3>Notable Alumni</h3>
    <div class="uni-alumni-row">
      <div class="uni-alumni-card">
        <div class="uni-alumni-avatar" style="background: linear-gradient(135deg,#e87722,#c96210);">SB</div>
        <div class="uni-alumni-name">Sarjeev Bhaskar OBE</div>
        <div class="uni-alumni-role">Actor &amp; Comedian · Star of "Goodness Gracious Me"</div>
      </div>
      <div class="uni-alumni-card">
        <div class="uni-alumni-avatar" style="background: linear-gradient(135deg,#e87722,#c96210);">HL</div>
        <div class="uni-alumni-name">Helen Lederer</div>
        <div class="uni-alumni-role">Comedian &amp; Actress · Known for "Absolutely Fabulous"</div>
      </div>
      <div class="uni-alumni-card">
        <div class="uni-alumni-avatar" style="background: linear-gradient(135deg,#e87722,#c96210);">GF</div>
        <div class="uni-alumni-name">Gavin Fisher</div>
        <div class="uni-alumni-role">F1 Engineer · Former Chief Designer at Williams F1</div>
      </div>
    </div>
  </div>

</div>

<script>
  function handleEmployerTable() {
    var BREAKPOINT = 580;
    var isMobile = window.innerWidth <= BREAKPOINT;

    document.querySelectorAll('.uni-employers-section').forEach(function(section) {
      var tableWrap = section.querySelector('.uni-employers-table-wrap');
      var cardContainer = section.querySelector('.uni-employer-cards');
      if (!tableWrap || !cardContainer) return;

      var table = tableWrap.querySelector('table');
      var headers = Array.from(table.querySelectorAll('thead th')).map(function(th) {
        return th.innerText.trim();
      });

      if (isMobile) {
        tableWrap.style.display = 'none';
        cardContainer.style.display = 'flex';

        if (cardContainer.children.length === 0) {
          table.querySelectorAll('tbody tr').forEach(function(row) {
            var cells = row.querySelectorAll('td');
            var card = document.createElement('div');
            card.className = 'uni-employer-card';

            var nameDiv = document.createElement('div');
            nameDiv.className = 'uni-employer-card-name';
            nameDiv.innerHTML = cells[0] ? cells[0].innerHTML : '';
            card.appendChild(nameDiv);

            var meta = document.createElement('div');
            meta.className = 'uni-employer-card-meta';

            for (var i = 1; i < cells.length; i++) {
              var pill = document.createElement('div');
              pill.className = 'uni-employer-card-pill';
              pill.innerHTML = '<span>' + (headers[i] || '') + '</span>' + (cells[i] ? cells[i].innerHTML : '');
              meta.appendChild(pill);
            }

            card.appendChild(meta);
            cardContainer.appendChild(card);
          });
        }
      } else {
        tableWrap.style.display = '';
        cardContainer.style.display = 'none';
      }
    });
  }

  document.addEventListener('DOMContentLoaded', function() {
    handleEmployerTable();
  });

  var resizeTimer;
  window.addEventListener('resize', function() {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(handleEmployerTable, 150);
  });
</script>