@extends('layouts.app')

@section('content')
  <section class="university-banner">
    <h1 style="color: #FFF;">Start Your Search</h1>

    <div class="container">
      <form id="filterForm" class="mmt-style-search">
        <div class="search-fields">
          <!-- Country (From equivalent) -->
          <div class="search-field">
            <label>Country</label>
            <div class="field-input">
              <select id="country" name="country" class="large-select">
                @foreach ($availableCountries as $country)
                  <option value="{{ $country }}" {{ $country == $selectedCountry ? 'selected' : '' }}>
                    {{ ucfirst($country) }}
                  </option>
                @endforeach
              </select>
              <div class="field-display">
                <div class="sub-text">Any Country</div>
              </div>
            </div>
          </div>

          <!-- Course Level -->
          <div class="search-field">
            <label>Course Level</label>
            <div class="field-input">
              <select id="courseLevel" name="courseLevel" class="large-select">
                <option value="all">All Levels</option>
                @foreach ($availableCourseLevels as $level)
                  <option value="{{ strtolower($level) }}" {{ strtolower($level) == strtolower($selectedCourseLevel) ? 'selected' : '' }}>
                    {{ ucfirst($level) }}
                  </option>
                @endforeach
              </select>
              <div class="field-display">
                <div class="sub-text">Undergraduate, Postgraduate, etc.</div>
              </div>
            </div>
          </div>

          <!-- Tuition Range -->
          <div class="search-field">
            <label>Tuition Range</label>
            <div class="field-input">
              <select id="tuitionRange" name="tuitionRange" class="large-select">
                <option value="all">All Ranges</option>
                @foreach ($availableTuitionRanges as $range)
                  <option value="{{ $range }}" {{ $range == $selectedTuitionRange ? 'selected' : '' }}>
                    {{ $currencySymbol }}{{ str_replace('-', ' - ' . $currencySymbol, $range) }}
                  </option>
                @endforeach
              </select>
              <div class="field-display">
                <div class="sub-text">Per year</div>
              </div>
            </div>
          </div>

          <!-- Department (Travellers equivalent) -->
          <div class="search-field">
            <label>Department</label>
            <div class="field-input">
              <select name="department" id="department" class="large-select">
                <option value="all">All Departments</option>
                @foreach ($availableDepartments as $dept)
                  <option value="{{ $dept }}" {{ request('department') == $dept ? 'selected' : '' }}>
                    {{ $dept }}
                  </option>
                @endforeach
              </select>
              <div class="field-display">
                <div class="sub-text">Field of study</div>
              </div>
            </div>
          </div>
        </div>

        <div class="search-button-container">
          <button type="submit" id="applyBtn" class="search-btn">Search</button>
        </div>
      </form>
    </div>
  </section>

  <style>
    .mmt-style-search {
      background: rgba(255, 255, 255, 0.95);
      border-radius: 16px;
      padding: 24px;
      max-width: 1000px;
      margin: 40px auto;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
      backdrop-filter: blur(10px);
    }

    /* Responsive Flexbox Layout */
    .search-fields {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      margin-bottom: 28px;
      justify-content: center;
    }

    .search-field {
      flex: 1;
      width: 200px;
      max-width: 240px;
    }

    .search-field label {
      font-size: 12px;
      color: #666;
      margin-bottom: 6px;
      display: block;
      font-weight: 500;
    }

    .field-input {
      position: relative;
      min-width: 180px;
    }

    .large-select {
      width: 100%;
      height: 50px;
      padding: 10px 16px;
      border: 1px solid #ddd;
      border-radius: 8px;
      font-size: 16px;
      background: transparent;
      appearance: none;
      cursor: pointer;
    }

    .field-display {
      position: absolute;
      top: 90%;
      left: 16px;
      transform: translateY(-90%);
      pointer-events: none;
    }

    .field-display .sub-text {
      font-size: 10px;
      color: #888;
    }

    /* Hanging Button - Main Magic Here */
    .search-button-container {
      position: absolute;
      left: 50%;
      bottom: 0;
      transform: translate(-50%, 50%);
      width: 100%;
      text-align: center;
      pointer-events: none;
    }

    .search-btn {
      text-align: center;
      pointer-events: all;
      background-color: var(--primary-dark, #ff6d00);
      color: white;
      font-weight: 700;
      font-size: 1rem;
      padding: 8px;
      border: none;
      border-radius: 12px;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 8px 20px rgba(255, 109, 0, 0.3);
      width: 150px;
    }

    .search-btn:hover {
      transform: translateY(-3px);
    }

    @media (max-width: 768px) {
      .mmt-style-search {
        margin: 20px;
        padding: 20px;
      }

      .search-btn {
        width: 50%;
        padding: 10px;
      }

      .search-field {
        flex: 1 1 100%;
        min-width: unset;
      }
    }

    /* Responsive Breakpoints */
    @media (max-width: 1024px) {
      .search-field {
        flex: 1 1 45%;
      }
    }
  </style>

  <section class="university-section">

    <div class="container">


      <!-- Registration Modal -->
      <div id="registrationModal" class="modal">
        <div class="modal-content">
          @include('components.university-form')
        </div>
      </div>

      <style>
        .modal {
          display: none;
          position: fixed;
          z-index: 1000;
          left: 0;
          top: 0;
          width: 100%;
          height: 100%;
          background-color: rgba(0, 0, 0, 0.7);
          backdrop-filter: blur(5px);
          overflow: auto;
        }

        .modal-content {
          margin: 5% auto;
          padding: 20px;
          width: 90%;
          max-width: 500px;
          position: relative;
        }

        .close-modal {
          color: #ffcc00;
          float: right;
          font-size: 28px;
          font-weight: bold;
          cursor: pointer;
          position: absolute;
          right: 15px;
          top: 10px;
        }

        .close-modal:hover {
          color: #ffa500;
        }

        @media (max-width: 768px) {
          .modal-content {
            margin: 25% auto;
            width: 95%;
          }
        }
      </style>

      {{-- University Grid --}}
      <div id="universityGridContainer" class="{{ session('universitiesUnlocked') ? '' : 'uni-locked' }}">
        <div class="unlock-overlay">
          <div class="unlock-box">
            <h3>🔒 View Universities</h3>
            <p>Please complete the counselling form above to unlock university details.</p>
          </div>
        </div>
        <div class="grid">
          @forelse ($universities as $index => $uni)
            <div class="card-uni gated-uni" data-index="{{ $index }}" style="animation-delay: {{ min($index * 0.1, 1) }}s;">
              @php
                $s3Base = 'https://crizac-assets.s3.ap-south-1.amazonaws.com/system';
              @endphp
              <img class="uni-img" loading="lazy" decoding="async"
                src="{{ !empty($uni['university']['bannerImage']) ? $s3Base . '/' . ltrim($uni['university']['bannerImage'], '/') : asset('images/university-images/harvard-university.webp') }}"
                alt="{{ $uni['title'] ?? 'University Course' }} Image"
                onerror="this.onerror=null;this.src='{{ asset('images/university-images/harvard-university.webp') }}';">


              <div class="card-content">
                <div class="university-header">
                  <img class="university-logo" loading="lazy" decoding="async"
                    src="{{ !empty($uni['university']['image']) ? $s3Base . '/' . ltrim($uni['university']['image'], '/') : asset('images/universities/glasgow.png') }}"
                    alt="{{ $uni['university']['name'] ?? 'University' }} Logo"
                    onerror="this.onerror=null;this.src='{{ asset('images/universities/glasgow.png') }}';">
                  <h4 title="{{ $uni['university']['name'] ?? 'Unnamed University' }}">
                    {{ trim($uni['university']['name'] ?? 'Unnamed University') }}
                  </h4>
                </div>

                <div class="info"><i class="fas fa-book-open"></i> {{ trim($uni['title'] ?? 'N/A') }}</div>
                <div class="info"><i class="fas fa-user-graduate"></i> {{ $uni['coursesWebsite']['courseLevel'] ?? 'N/A' }}
                </div>
                <div class="info"><i class="fas fa-clock"></i> {{ $uni['coursesWebsite']['duration'] ?? 'N/A' }}</div>
                <div class="info"><i class="fas fa-map-marker-alt"></i>
                  {{ $uni['coursesWebsite']['location'] ?? 'Unknown' }}</div>
                <div class="info"><i class="fas fa-file-invoice-dollar"></i> Application Fees:
                  {{ $uni['university']['currencySymbol'] ?? '$' }}{{ $uni['coursesWebsite']['applicationFees'] ?? 'N/A' }}
                </div>
                <div class="info"><i class="fas fa-money-bill-wave"></i> Tuition Fees:
                  <span class="fee">
                    {{ $uni['university']['currencySymbol'] ?? '$' }}{{ number_format($uni['coursesWebsite']['tuitionFees'] ?? 0) }}
                    {{ $uni['university']['currencyCode'] ?? 'USD' }}
                  </span>
                </div>

                <button class="apply-btn" data-course-id="{{ $uni['id'] }}" data-course-title="{{ trim($uni['title']) }}"
                  data-course-level="{{ $uni['coursesWebsite']['courseLevel'] ?? '' }}"
                  data-duration="{{ $uni['coursesWebsite']['duration'] ?? '' }}"
                  data-location="{{ $uni['coursesWebsite']['location'] ?? '' }}"
                  data-tuition="{{ $uni['coursesWebsite']['tuitionFees'] ?? 0 }}"
                  data-application="{{ $uni['coursesWebsite']['applicationFees'] ?? 0 }}"
                  data-university-id="{{ $uni['linksDetails']['universityId'] }}"
                  data-university-name="{{ trim($uni['university']['name']) }}"
                  data-currency-symbol="{{ $uni['university']['currencySymbol'] ?? '$' }}"
                  data-currency-code="{{ $uni['university']['currencyCode'] ?? 'USD' }}"
                  style="margin-top: 10px; padding: 6px 12px; max-width: 120px;">
                  Apply
                </button>

              </div>
            </div>
          @empty
            <div class="no-data">No university courses found.</div>
          @endforelse
        </div>

        <div class="pagination">
          {{ $universities->links() }}
        </div>
      </div>
    </div>
  </section>


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    function isUniversitiesUnlocked() {
      return localStorage.getItem('universitiesUnlocked') === '1';
    }

    function setUniversitiesUnlocked() {
      localStorage.setItem('universitiesUnlocked', '1');
    }
  </script>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      if (isUniversitiesUnlocked()) {
        unlockUniversities();
      }
    });
  </script>
  <script>
    function openRegistrationModal() {
      document.getElementById('registrationModal').style.display = 'block';
      document.body.style.overflow = 'hidden'; // Prevent background scrolling
    }

    function closeRegistrationModal() {
      document.getElementById('registrationModal').style.display = 'none';
      document.body.style.overflow = 'auto'; // Restore scrolling
    }
  </script>
  <script>
    document.addEventListener('contextmenu', function (e) {
      e.preventDefault();
    });

    ['copy', 'cut', 'paste', 'selectstart'].forEach(event => {
      document.addEventListener(event, function (e) {
        e.preventDefault();
      });
    });

    document.addEventListener('keydown', function (e) {
      const key = e.key.toLowerCase();

      if (e.keyCode === 123) {
        e.preventDefault();
        return false;
      }

      if (e.ctrlKey && e.shiftKey && ['i', 'j', 'c'].includes(key)) {
        e.preventDefault();
        return false;
      }

      if (e.ctrlKey && key === 'u') {
        e.preventDefault();
        return false;
      }

      if (e.ctrlKey && ['s', 'p'].includes(key)) {
        e.preventDefault();
        return false;
      }

      if (e.ctrlKey && ['c', 'v', 'x'].includes(key)) {
        e.preventDefault();
        return false;
      }

      if (e.key === 'PrintScreen') {
        e.preventDefault();
        alert('Screenshots are disabled on this page.');
        return false;
      }
    });

    (function () {
      let devtoolsOpen = false;
      const threshold = 160;

      setInterval(() => {
        const widthDiff = window.outerWidth - window.innerWidth > threshold;
        const heightDiff = window.outerHeight - window.innerHeight > threshold;

        if (widthDiff || heightDiff) {
          if (!devtoolsOpen) {
            devtoolsOpen = true;
            document.body.innerHTML =
              '<h2 style="text-align:center;margin-top:20%;color:red;">Access Restricted</h2>';
          }
        }
      }, 300);
    })();
  </script>
  <script>
    function unlockUniversities() {
      const container = document.getElementById('universityGridContainer');
      if (!container) return;

      container.classList.remove('uni-locked');

      // Remove blur
      const grid = container.querySelector('.grid');
      const pagination = container.querySelector('.pagination');
      if (grid) {
        grid.style.filter = 'none';
        grid.style.pointerEvents = 'auto';
        grid.style.userSelect = 'auto';
        grid.style.opacity = '1';
      }
      if (pagination) {
        pagination.style.filter = 'none';
        pagination.style.pointerEvents = 'auto';
      }

      // Remove overlay
      const overlay = container.querySelector('.unlock-overlay');
      if (overlay) overlay.remove();
    }

    function applyUniversityFilters() {
      const country = $('#country').val();
      const courseLevel = $('#courseLevel').val();
      const tuitionRange = $('#tuitionRange').val();
      const department = $('#department').val();

      // ❌ If nothing selected, do nothing
      if (
        !country &&
        (!courseLevel || courseLevel === 'all') &&
        (!tuitionRange || tuitionRange === 'all') &&
        (!department || department === 'all')
      ) {
        return;
      }

      const query = $.param({
        country,
        courseLevel,
        tuitionRange,
        department
      });

      // Reload page with filters applied
      window.location.href = `/universities?${query}`;
    }
  </script>

  <script>
    function fetchUpdatedFilters() {
      const country = $('#country').val();
      const courseLevel = $('#courseLevel').val();
      const tuitionRange = $('#tuitionRange').val();
      const department = $('#department').val();

      $.ajax({
        url: `/universities?country=${country}&courseLevel=${courseLevel}&tuitionRange=${tuitionRange}&department=${department}&filterUpdateOnly=1`,
        method: 'GET',
        dataType: 'json',
        headers: { 'X-Requested-With': 'XMLHttpRequest' },
        success: function (data) {
          // Update Course Levels
          const $courseSelect = $('#courseLevel');
          $courseSelect.html('<option value="all">All Levels</option>');
          data.courseLevels.forEach(level => {
            $courseSelect.append(`<option value="${level.toLowerCase()}">${level}</option>`);
          });

          // Update Tuition Ranges
          const $tuitionSelect = $('#tuitionRange');
          $tuitionSelect.html('<option value="all">All Ranges</option>');
          data.tuitionRanges.forEach(range => {
            const label = range.replace(/-/g, ' - ' + data.currencySymbol);
            $tuitionSelect.append(`<option value="${range}">${data.currencySymbol}${label}</option>`);
          });

          // Update Departments
          const $deptSelect = $('#department');
          $deptSelect.html('<option value="all">All Departments</option>');
          data.departments.forEach(dept => {
            $deptSelect.append(`<option value="${dept}">${dept}</option>`);
          });

          // Keep selected values
          $courseSelect.val(courseLevel);
          $tuitionSelect.val(tuitionRange);
          $deptSelect.val(department);
        },
        error: function () {
          alert('Failed to update filters.');
        }
      });
    }

    // Update filters on change (but don't fetch grid)
    $('#country, #courseLevel, #tuitionRange').on('change', fetchUpdatedFilters);

    // Only fetch university grid on "Apply"
    $('#filterForm').on('submit', function (e) {
      e.preventDefault();

      // If not unlocked → open form
      if (!isUniversitiesUnlocked()) {
        openRegistrationModal();
        return;
      }

      const country = $('#country').val();
      const courseLevel = $('#courseLevel').val();
      const tuitionRange = $('#tuitionRange').val();
      const department = $('#department').val();

      const query = $.param({ country, courseLevel, tuitionRange, department });

      $.ajax({
        url: `/universities?${query}`,
        method: 'GET',
        headers: { 'X-Requested-With': 'XMLHttpRequest' },
        success: function (responseHtml) {
          window.location.href = `/universities?${query}`;
        },
        error: function () {
          alert('Failed to load universities.');
        }
      });
    });
  </script>
  <script>
    $(document).on('click', '.apply-btn', function () {

      const userId = localStorage.getItem('user_id');

      if (!userId) {
        Swal.fire('Login required', 'Please submit counselling form first', 'warning');
        openRegistrationModal();
        return;
      }

      const btn = $(this);

      $.ajax({
        url: "{{ route('university.apply') }}",
        method: "POST",
        data: {
          _token: "{{ csrf_token() }}",
          user_id: userId,

          course_id: btn.data('course-id'),
          course_title: btn.data('course-title'),
          course_level: btn.data('course-level'),
          duration: btn.data('duration'),
          location: btn.data('location'),
          tuition_fees: btn.data('tuition'),
          application_fees: btn.data('application'),

          university_id: btn.data('university-id'),
          university_name: btn.data('university-name'),
          currency_symbol: btn.data('currency-symbol'),
          currency_code: btn.data('currency-code'),
        },
        success: function (res) {
          btn.prop('disabled', true).text('Applied');
          Swal.fire('Success', res.message, 'success');
        },
        error: function (xhr) {
          if (xhr.status === 409) {
            Swal.fire('Already Applied', xhr.responseJSON.message, 'info');
          } else {
            Swal.fire('Error', 'Something went wrong', 'error');
          }
        }
      });
    });
  </script>


@endsection

<!-- Card Styling  -->
<style>
  .university-banner {
    position: relative;
    width: 100%;
    min-height: 500px;

    /* Aspect ratio instead of height */
    aspect-ratio: 16 / 5;
    background: url('/images/WTS_banner.webp') center center / cover no-repeat;
    background-color: #0d2942;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 40px 20px;
    margin-top: 120px;
  }

  /* Ensure it never becomes too small */
  @media (max-width: 1200px) {
    .university-banner {
      aspect-ratio: 16 / 6;
    }
  }

  /* Mobile optimization */
  @media (max-width: 768px) {
    .university-banner {
      margin-top: 100px;
      padding-top: 40px;
    }
  }

  #universityGridContainer {
    position: relative;
  }

  /* Blur + disable */
  .uni-locked .grid,
  .uni-locked .pagination {
    filter: blur(6px);
    pointer-events: none;
    user-select: none;
    opacity: 0.85;
    transition: filter 0.4s ease, opacity 0.4s ease;
  }

  /* Overlay */
  .unlock-overlay {
    position: absolute;
    inset: 0;
    background: rgba(255, 255, 255, 0.6);
    backdrop-filter: blur(2px);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 10;
  }

  /* Message box */
  .unlock-box {
    background: #2b2b2b;
    color: #fff;
    padding: 25px 30px;
    border-radius: 14px;
    text-align: center;
    max-width: 380px;
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.25);
  }

  .unlock-box h3 {
    color: orange;
    margin-bottom: 8px;
  }

  .unlock-box p {
    color: #fff;
    font-size: 14px;
    opacity: 0.9;
  }



  .university-section {
    max-width: 1440px;
    margin: auto;
    padding: 40px 20px 60px 20px;
    /* background: #f7f7f7; */
    text-align: center;
  }

  .university-section h1 {
    color: orange;
    margin-bottom: 20px;
  }

  .grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem;
    padding: 2rem;
    /* background: #f9f9f9; */
  }

  .card-uni {
    display: flex;
    flex-direction: row;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.05);
    overflow: hidden;
    animation: fadeInUp 0.5s ease forwards;
    transform: translateY(20px);
    opacity: 0;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .card-uni:hover {
    transform: translateY(-10px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
  }

  .card-uni .uni-img {
    width: 40%;
    height: auto;
    object-fit: cover;
  }

  .university-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
  }

  /* Hide image under 1000px */
  @media (max-width: 1000px) {
    .card-uni .uni-img {
      display: none;
    }

    /* Let content take full width */
    .card-content {
      width: 100% !important;
    }
  }

  .university-logo {
    width: 55px;
    height: 55px;
    object-fit: contain;
    border-radius: 6px;
    background: #fff;
  }

  .card-content {
    width: 60%;
    padding: 1.2rem 1.5rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }

  .card-content h4 {
    margin-bottom: 0.5rem;
    font-size: 1.25rem;
    color: #333;
    font-weight: bold;
    overflow: hidden;
    text-align: left;
    /* text-overflow: ellipsis; */
    /* white-space: nowrap; */
  }

  .info {
    font-size: 0.95rem;
    color: #555;
    margin: 0.4rem 0;
    display: flex;
    align-items: center;
    text-align: left;
  }

  .info i {
    margin-right: 0.5rem;
    color: #f39c12;
    min-width: 20px;
    text-align: center;
  }

  .fee {
    color: #27ae60;
    font-weight: 600;
  }

  .no-data {
    font-size: 1.1rem;
    color: #777;
    padding: 2rem;
    grid-column: 1 / -1;
  }

  @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translateY(40px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  @media (max-width: 600px) {
    .grid {
      grid-template-columns: 1fr;
      padding: 1rem;
    }

    .university-section {
      padding: 40px 10px 40px 10px;
    }

    .card-content h4 {
      font-size: 1.1rem;
    }

    .info {
      font-size: 0.85rem;
    }
  }
</style>

<!-- Pagination styling  -->
<style>
  .pagination {
    display: flex;
    justify-content: center;
    margin-top: 2rem;
  }

  .pagination svg {
    width: 20px;
    height: 20px;
    color: orange;
  }

  .pagination nav>div:first-child {
    display: none;
  }

  .pagination nav {
    display: flex;
    justify-content: center;
  }

  .pagination nav a,
  .pagination nav span {
    margin: 0 5px;
    padding: 6px;
    color: orange;
    text-decoration: none;
  }

  .pagination nav a {
    transition: transform 0.3s ease-in-out, text-decoration 0.3s;
    transform: scale(1);
  }

  .pagination nav a:hover {
    text-decoration: underline;
    transform: scale(1.25);
  }

  .pagination nav span {
    /* background-color: #18336c; */
    color: black;
    font-weight: bold;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
  }

  .pagination nav p {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
    padding: 0;
    color: black;
  }

  .pagination nav span[aria-current='page'] {
    background-color: orange;
    padding: 1px;
    border-radius: 50%;
    color: white;
    font-weight: bold;
  }
</style>