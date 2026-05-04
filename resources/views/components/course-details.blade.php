<section class="section-form">
  <h1>Your Global Education Journey Begins Here!</h1>
  <p style="text-align: center;">Fast-track your student visa process with WTSVISA. Begin in just one step!</p>
  <!-- <button class="hero-button">▶️ See How It Works</button> -->

  <div class="form-box">
    <h2>Instant Apply</h2>
    <p style="text-align: center;">Apply to your dream university</p>

    <div class="tabs">
      <div class="tab active" onclick="showStep(1)">
      <i class="fa fa-globe" aria-hidden="true"></i> Country</div>
      <div class="tab" onclick="showStep(2)">
      <i class="fa-solid fa-book"></i> Course</div>
      <div class="tab" onclick="showStep(3)">
      <i class="fa-solid fa-money-bill"></i> Fees</div>
    </div>

    <form id="filterForm" onsubmit="return validateFinalStep()">
      <!-- Step 1: Country -->
      <div class="form-step active" id="step-1">
        <label for="country">Select Countries</label>
        <select id="country" name="country">
            @foreach ($availableCountries as $country)
                <option value="{{ $country }}" {{ $country == $selectedCountry ? 'selected' : '' }}>
                    {{ ucfirst($country) }}
                </option>
            @endforeach
        </select>
        <div class="error-message" id="error-country"></div>
        <button type="button" class="form-btn" onclick="nextStep(1)">Next Step</button>
      </div>

      <!-- Step 2: Course -->
      <div class="form-step" id="step-2">
        <label for="courseLevel">Select Course Types</label>
        <select id="courseLevel" name="courseLevel">
            <option value="all">All Levels</option>
            @foreach ($availableCourseLevels as $level)
                <option value="{{ strtolower($level) }}" {{ strtolower($level) == strtolower($selectedCourseLevel) ? 'selected' : '' }}>
                    {{ ucfirst($level) }}
                </option>
            @endforeach
        </select>
        <div class="error-message" id="error-courseLevel"></div>
        <button type="button" class="form-btn" onclick="nextStep(2)">Next Step</button>
      </div>

      <!-- Step 3: Fee -->
      <div class="form-step" id="step-3">
        <label for="tuitionRange">Select Fee Budget</label>
        <select id="tuitionRange" name="tuitionRange">
            <option value="all">All Ranges</option>
            @foreach ($availableTuitionRanges as $range)
                <option value="{{ $range }}" {{ $range == $selectedTuitionRange ? 'selected' : '' }}>
                  {{ $currencySymbol }}{{ str_replace('-', ' - ' . $currencySymbol, $range) }}
                </option>
            @endforeach
        </select>
        <div class="error-message" id="error-tuitionRange"></div>
        <button type="button" class="form-btn" onclick="nextStep(3)">Next Step</button>
      </div>

      <!-- Step 4: Extended Info -->
      <div class="form-step" id="step-4">
        <label for="department">Select Department</label>
        <select name="department" id="department">
            <option value="all">All Departments</option>
            @foreach ($availableDepartments as $dept)
                <option value="{{ $dept }}" {{ request('department') == $dept ? 'selected' : '' }}>{{ $dept }}</option>
            @endforeach
        </select>
        <div class="error-message" id="error-department"></div>

        <label for="preference">Select Course Preferences (comma separated)</label>
        <input type="text" id="preference" name="preferences" placeholder="e.g., Computer Science, Finance">
        <div class="error-message" id="error-preference"></div>

        <button type="submit" class="form-btn" id="applyBtn">Apply Now</button>
      </div>
    </form>
  </div>
</section>

<script>
let currentStep = 1;

function showStep(step) {
  const countryInput = document.getElementById("country");
  const courseLevelInput = document.getElementById("courseLevel");
  const tuitionRangeInput = document.getElementById("tuitionRange");

  const country = countryInput.value;
  const courseLevel = courseLevelInput.value;
  const tuitionRange = tuitionRangeInput.value;

  // Clear previous error messages and borders
  document.getElementById("error-country").textContent = "";
  document.getElementById("error-courseLevel").textContent = "";
  document.getElementById("error-tuitionRange").textContent = "";

  countryInput.classList.remove("input-error");
  courseLevelInput.classList.remove("input-error");
  tuitionRangeInput.classList.remove("input-error");

  // Step 1 is always allowed
  if (step === 1) {
    activateStep(1);
    return;
  }

  // Step 2: Require country selection
  if (!country || country === "all") {
    document.getElementById("error-country").textContent = "Please select a country.";
    countryInput.classList.add("input-error");
    activateStep(1);
    return;
  }

  // Step 3: Require course level selection
  if (step >= 3 && (!courseLevel || courseLevel === "all")) {
    document.getElementById("error-courseLevel").textContent = "Please select a course type.";
    courseLevelInput.classList.add("input-error");
    activateStep(2);
    return;
  }

  // Step 4: Require tuition range selection
  if (step >= 4 && (!tuitionRange || tuitionRange === "all")) {
    document.getElementById("error-tuitionRange").textContent = "Please select a tuition range.";
    tuitionRangeInput.classList.add("input-error");
    activateStep(3);
    return;
  }

  // All validations passed
  activateStep(step);
}



// Centralizes step display logic
function activateStep(step) {
  currentStep = step;
  document.querySelectorAll(".form-step").forEach((el, i) => {
    el.classList.toggle("active", i === step - 1);
  });
  document.querySelectorAll(".tab").forEach((tab, i) => {
    tab.classList.toggle("active", i === step - 1);
  });
}


function nextStep(step) {
  let valid = false;

  // Clear all step error messages
  document.getElementById("error-country").textContent = "";
  document.getElementById("error-courseLevel").textContent = "";
  document.getElementById("error-tuitionRange").textContent = "";

  if (step === 1) {
  const countryEl = document.getElementById("country");
  if (countryEl.value === "") {
    document.getElementById("error-country").textContent = "Please select a country.";
    countryEl.classList.add("input-error");
  } else {
    countryEl.classList.remove("input-error");
    valid = true;
  }
} else if (step === 2) {
  const courseEl = document.getElementById("courseLevel");
  if (courseEl.value === "" || courseEl.value === "all") {
    document.getElementById("error-courseLevel").textContent = "Please select a course type.";
    courseEl.classList.add("input-error");
  } else {
    courseEl.classList.remove("input-error");
    valid = true;
  }
} else if (step === 3) {
  const feeEl = document.getElementById("tuitionRange");
  if (feeEl.value === "" || feeEl.value === "all") {
    document.getElementById("error-tuitionRange").textContent = "Please select a tuition range.";
    feeEl.classList.add("input-error");
  } else {
    feeEl.classList.remove("input-error");
    valid = true;
  }
}

  if (valid) {
    showStep(step + 1);
  }
}

function validateFinalStep() {
  const dept = document.getElementById("department");
  const pref = document.getElementById("preference");

  document.getElementById("error-department").textContent = "";
  document.getElementById("error-preference").textContent = "";

  let valid = true;

  if (dept.value === "all") {
    document.getElementById("error-department").textContent = "Please select any one department.";
    dept.classList.add("input-error");
    valid = false;
  } else {
    dept.classList.remove("input-error");
  }

  if (!pref.value.trim()) {
    document.getElementById("error-preference").textContent = "Please enter your course preferences.";
    pref.classList.add("input-error");
    valid = false;
  } else {
    pref.classList.remove("input-error");
  }

  return valid;
}

</script>


<script>
  document.addEventListener('DOMContentLoaded', function () {
    const multipleSelects = document.querySelectorAll('.choices-multiple');
    multipleSelects.forEach(select => {
      new Choices(select, {
        removeItemButton: true,
        placeholderValue: 'Select option(s)',
        searchPlaceholderValue: 'Search...',
        maxItemCount: 3, 
      });
    });
  });
</script>
<script>
  const courseSelect = document.getElementById('course');
  const departmentSelect = document.getElementById('department');

    // Loop through the data and create option elements for each course
    data.forEach(course => {
      const option = document.createElement('option');
      option.value = course.id; // Set the course ID as the value
      option.textContent = course.name.trim(); // Set the course name as the display text
      departmentSelect.appendChild(option); // Add the option to the select
    });
  

  // Initialize Choices.js
  const choices = new Choices(departmentSelect, {
    removeItemButton: true,
    maxItemCount: 3,
    placeholderValue: 'Select up to 3 departments',
    searchPlaceholderValue: 'Search...',
  });
  
  .catch(error => {
    console.error('Error fetching data:', error);
  });
  
  function updateDepartments(courseType) {
    const departments = courseType === 'Undergraduate' ? ugDepartments : pgDepartments;

    // Clear existing choices
    choices.clearStore();

    // Add new choices
    const newChoices = departments.map(dept => ({
      value: dept.value,
      label: dept.text,
      selected: false,
      disabled: false
    }));
    choices.setChoices(newChoices, 'value', 'label', true);
  }

  courseSelect.addEventListener('change', function () {
    const selected = this.value;
    if (selected === 'Undergraduate' || selected === 'Postgraduate') {
      updateDepartments(selected);
    }
  });
</script>


<!-- AJAX Request  -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

        // Run the validation function
        if (!validateFinalStep()) {
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


<style>
    .section-form {
      padding: 60px 20px;
      background: #f7f7f7;
      text-align: center;
    }


    .form-box {
      max-width: 600px;
      margin: 0 auto;
      background: #ffffff;
      padding: 20px;
      border-radius: 16px;
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }

    h1, h2 {
      text-align: center;
      color: #333;
    }

    .hero-button {
      display: block;
      margin: 10px auto 20px;
      padding: 10px 20px;
      border: none;
      background: #ffa500;
      color: #fff;
      border-radius: 25px;
      cursor: pointer;
    }

    .tabs {
      display: flex;
      justify-content: space-around;
      margin-bottom: 20px;
    }

    .tab {
      padding: 10px 15px;
      border-bottom: 2px solid transparent;
      cursor: pointer;
      text-align: center;
    }

    .tab.active {
      border-bottom: 3px solid #ffcc00;
      font-weight: bold;
      color: #ffa500;
    }

    .form-step {
      display: none;
    }

    .form-step.active {
      display: block;
    }

    #filterForm label {
      display: block;
      margin: 15px 0 5px;
      font-weight: bold;
      color: #333;
    }

    #filterForm select,
    #filterForm input[type="text"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 5px;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 16px;
    }

    .form-btn {
      display: block;
      width: 100%;
      padding: 12px;
      font-size: 16px;
      background: #ffcc00;
      color: #222;
      border: none;
      border-radius: 30px;
      margin-top: 10px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .form-btn:hover {
      background: #ffa500;
    }
    .error-message {
      color: red;
      font-size: 0.9rem;
      margin: 0;
    }
    .input-error {
      border: 2px solid red !important;
    }

</style>