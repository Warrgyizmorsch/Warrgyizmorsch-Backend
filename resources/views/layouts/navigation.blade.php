<header class="header">
    <div class="container">
             @if(Route::currentRouteName() === 'landing_page' || Route::currentRouteName() === 'landing_page2' || Route::currentRouteName() === 'study_abroad_consultant' )
            <!-- Landing Page Header -->
            <div class="navbar-container">
                <div class="navbar">
                    <div class="logo">
                        <a href="{{ url('/') }}"><img src="/images/logo-wts.png" alt=""></a>
                    </div>
                    <nav class="nav-links">
                        <a href="https://wa.me/919116076837?text=Hi%2C%20I%E2%80%99m%20looking%20for%20visa%20consultation%20services.%20Can%20you%20please%20assist%20me%20with%20the%20next%20steps%3F" target="_blank" class="whatsapp-link flex items-center gap-2 text-green-600 font-semibold">
                            <i class="fa-brands fa-whatsapp"></i> WhatsApp
                        </a>
                        <a href="tel:+919876543210" class="phone-link flex items-center gap-2 text-blue-600 font-semibold">
                            <i class="fa-solid fa-phone"></i> +91 98765 43210
                        </a>
                    </nav>
                </div>
            </div>
        @else
        <!-- Hamburger Menu for Mobile -->
        <div class="hamburger-menu">
            <div class="hamburger-icon" onclick="toggleMenu()">☰</div>
            <div class="sidebar-menu">
                <div class="sidebar-header">
                    <img class="main-logo" style="height: 3rem; width: 8rem" src="{{ asset('images/logo-wts.png') }}" alt="wts-logo" />
                    <div class="hamburger-icon close-icon" onclick="toggleMenu()">✖</div>
                </div>
                <nav class="sidebar-nav">
                    <a href="{{ url('/') }}">Home</a>
                    <div class="sidebar-dropdown">
                        <a class="dropdown-toggle" onclick="toggleDropdown(event)">
                            Services <span class="arrow-icon"><i class="fa-solid fa-angle-down"></i></span>
                        </a>
                        <div class="sidebar-dropdown-menu">
                            
                            <!-- <a href="{{ url('/marketing') }}">Free profile evaluation</a> -->
                            <a href="{{ url('/services/course-selection') }}">Course Selection</a>
                            <a href="{{ url('/services/getting-admission') }}">Admissions</a>
                            <a href="{{ url('/services/sop-assistance') }}">SOP/ Scholarship essays</a>
                            <a href="{{ url('/services/visa-assistance') }}">Visa Assistance</a>
                            <a href="{{ url('/services/mock-interviews') }}">Mock interview</a>
                            <!-- <a href="{{ url('/marketing') }}">Education Loan</a> -->
                            <a href="{{ url('/services/travel-arrangements') }}">Travel arrangements</a>
                            <!-- <a href="{{ url('/marketing') }}">Post - Landing services</a> -->
                            <a href="{{ url('/services/free-profile-evaluation') }}">Free Profile Evaluation</a>
                            <a href="{{ url('/services/education-loan') }}">Education Loan</a>
                            <a href="{{ url('/services/post-landing-services') }}">Post Landing Services</a>
                            <a href="{{ url('/services/counseling-with-an-expert') }}">Counseling with an expert</a>
                            <a href="{{ url('/services/scholarship-assistance') }}">Scholarship Assistance</a>
                            <a href="{{ url('/services/test-preparation') }}">Test Preparation</a>
                        </div>
                    </div>
                    <div class="sidebar-dropdown">
                        <a class="dropdown-toggle" onclick="toggleDropdown(event)">
                            Countries <span class="arrow-icon"><i class="fa-solid fa-angle-down"></i></span>
                        </a>
                        <div class="sidebar-dropdown-menu">
                            <a href="{{ url('/country/europe') }}">Europe</a>
                            <a href="{{ url('/country/usa') }}">USA</a>
                            <a href="{{ url('/country/canada') }}">Canada</a>
                            <a href="{{ url('/country/new-zealand') }}">New Zealand</a>
                            <a href="{{ url('/country/australia') }}">Australia</a>
                            <a href="{{ url('/country/uk') }}">United Kingdom</a>
                            <a href="{{ url('/country/international') }}">International</a>
                        </div>
                    </div>
                    <a href="{{ url('/about') }}">About Us</a>
                    <a href="{{ url('/contact') }}">Contact Us</a>
                    <a href="{{ url('/login') }}">Login</a>
                </nav>
            </div>
        </div>

        <!-- Navbar for Desktop -->
        <div class="navbar-container">
            <div class="navbar">
                <div class="logo">
                    <a href="{{ url('/') }}"><img src="/images/logo-wts.png" alt=""></a>
                </div>
                <nav class="nav-links">
                    <a class="nav-item" href="{{ url('/') }}">Home</a>

                    <div class="dropdown">
                        <a class="nav-item" style = "display: flex; gap: 5px; align-items: center;">Services<span class="arrow-icon"><i class="fa-solid fa-angle-down"></i></span></a>
                        <div class="dropdown-menu">
                            
                            <!-- <a href="{{ url('/') }}">Free profile evaluation</a> -->
                            <a href="{{ url('/services/course-selection') }}">Course Selection</a>
                            <a href="{{ url('/services/getting-admission') }}">Getting Admissions</a>
                            <a href="{{ url('/services/sop-assistance') }}">SOP/ Scholarship essays</a>
                            <a href="{{ url('/services/visa-assistance') }}">Visa Assistance</a>
                            <a href="{{ url('/services/mock-interviews') }}">Mock interview</a>
                            <!-- <a href="{{ url('/') }}">Education Loan</a> -->
                            <a href="{{ url('/services/travel-arrangements') }}">Travel arrangements</a>
                            <!-- <a href="{{ url('/m') }}">Post - Landing services</a> -->
                            <a href="{{ url('/services/free-profile-evaluation') }}">Free Profile Evaluation</a>
                            <a href="{{ url('/services/education-loan') }}">Education Loan</a>
                            <a href="{{ url('/services/post-landing-services') }}">Post Landing Services</a>
                            <a href="{{ url('/services/counseling-with-an-expert') }}">Counseling with an expert</a>
                            <a href="{{ url('/services/scholarship-assistance') }}">Scholarship Assistance</a>
                            <a href="{{ url('/services/test-preparation') }}">Test Preparation</a>
                        </div>
                    </div>

                    <div class="dropdown">
                        <a class="nav-item" style = "display: flex; gap: 5px; align-items: center;">Countries<span class="arrow-icon"><i class="fa-solid fa-angle-down"></i></span></a>
                        <div class="dropdown-menu">
                            <a href="{{ url('/country/europe') }}">Europe</a>
                            <a href="{{ url('/country/usa') }}">USA</a>
                            <a href="{{ url('/country/canada') }}">Canada</a>
                            <a href="{{ url('/country/new-zealand') }}">New Zealand</a>
                            <a href="{{ url('/country/australia') }}">Australia</a>
                            <a href="{{ url('/country/uk') }}">United Kingdom</a>
                            <a href="{{ url('/country/international') }}">International</a>
                        </div>
                    </div>

                    <a class="nav-item" href="{{ url('/about') }}">About Us</a>
                    <a href="{{ url('/contact') }}">Contact Us</a>
                    <a href="{{ url('/login') }}" class="contact-btn">Login</a>
                </nav>
            </div>
        </div>
        @endif
    </div>
</header>

<!-- Overlay for closing sidebar when clicking outside -->
<div class="sidebar-overlay" onclick="toggleMenu()"></div>

<!-- JavaScript for Menu & Dropdown -->
<script>
    document.addEventListener("DOMContentLoaded", function () {

    // function fo toggle sidebar 
    function toggleMenu() {
    const sidebarMenu = document.querySelector(".sidebar-menu");
    const sidebarOverlay = document.querySelector(".sidebar-overlay");
    const bottomMenu = document.querySelector(".bottom-menu");

    if (sidebarMenu && sidebarOverlay && bottomMenu) {
        const isSidebarOpen = sidebarMenu.classList.toggle("show");
        sidebarOverlay.classList.toggle("show");
        document.body.classList.toggle("sidebar-open");

        // Hide bottom menu when sidebar is open
        if (isSidebarOpen) {
            bottomMenu.style.display = "none";
        } else {
            bottomMenu.style.display = "flex"; // Show it again when sidebar closes
        }
    } else {
        console.error("Sidebar menu, overlay, or bottom menu not found in the DOM.");
    }
}

    document.querySelector(".hamburger-icon").addEventListener("click", toggleMenu);
    document.querySelector(".close-icon").addEventListener("click", toggleMenu);
    document.querySelector(".sidebar-overlay").addEventListener("click", toggleMenu);
});


function toggleDropdown(event) {
    const allDropdowns = document.querySelectorAll(".sidebar-dropdown-menu");
    const allArrows = document.querySelectorAll(".arrow-icon");

    allDropdowns.forEach(menu => {
        if (menu !== event.target.closest(".sidebar-dropdown").querySelector(".sidebar-dropdown-menu")) {
            menu.classList.remove("active");
            menu.style.maxHeight = "0px";
            menu.style.opacity = "0";
            menu.style.visibility = "hidden";
        }
    });

    allArrows.forEach(arrow => {
        if (arrow !== event.target.closest(".sidebar-dropdown").querySelector(".arrow-icon")) {
            arrow.style.transform = "rotate(0deg)";
        }
    });

    // Now toggle the clicked one
    const dropdownContainer = event.target.closest(".sidebar-dropdown");
    const dropdownMenu = dropdownContainer.querySelector(".sidebar-dropdown-menu");
    const arrowIcon = dropdownContainer.querySelector(".arrow-icon");

    dropdownMenu.classList.toggle("active");

    if (dropdownMenu.classList.contains("active")) {
        arrowIcon.style.transform = "rotate(180deg)";
        dropdownMenu.style.maxHeight = dropdownMenu.scrollHeight + "px"; 
        dropdownMenu.style.opacity = "1";
        dropdownMenu.style.visibility = "visible";
    } else {
        arrowIcon.style.transform = "rotate(0deg)";
        dropdownMenu.style.maxHeight = "0px"; 
        dropdownMenu.style.opacity = "0";
        dropdownMenu.style.visibility = "hidden";
    }
}
</script>

<style>
    /* Hamburger Menu */
    .hamburger-menu {
        display: none;
    }

    @media (max-width: 768px) {
        .hamburger-menu {
            display: block;
        }
    }

    .hamburger-icon {
        position: fixed;
        top: 23px;
        right: 30px;
        z-index: 1100;
        font-size: 40px;
        color: var(--primary-color);
        cursor: pointer;
        transition: transform 0.3s ease;
    }

    .hamburger-icon:hover {
        transform: scale(1.1);
    }

    /* Sidebar Menu */
    .sidebar-menu {
        position: fixed;
        top: 0;
        right: -300px; /* Initially hidden */
        width: 280px;
        height: 100vh;
        background: #003366;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        transition: right 0.3s ease;
        z-index: 3000;
        overflow-y: auto;
    }

    /* Sidebar Header */
    .sidebar-header {
        display: flex;
        justify-content: center;
        padding: 20px;
        border-bottom: 1px solid #eee;
    }

    .close-icon {
        position: relative;
        top: 0;
        right: 0;
        font-size: 24px;
        display: none !important;
    }

    /* Active State */
    .sidebar-menu.show {
        right: 0;
    }

    /* Overlay for closing sidebar */
    .sidebar-overlay {
        position: fixed;
        top: 0; 
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1500;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease;
    }

    .sidebar-overlay.show {
        opacity: 1;
        visibility: visible;
    }

    /* Prevent body scrolling when sidebar is open */
    body.sidebar-open {
        overflow: hidden;
    }

    /* Navigation Links */
    .sidebar-nav {
        display: flex;
        flex-direction: column;
        padding: 20px;
        gap: 15px;
    }

    .sidebar-nav a {
        font-size: 18px;
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
        padding: 8px 0;
    }

    .sidebar-nav a:hover {
        color: var(--primary-dark);
    }

    /* Dropdown styles */
    .sidebar-dropdown {
        display: flex;
        flex-direction: column;
    }

    /* Dropdown Toggle */
    .dropdown-toggle {
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    /* Arrow animation */
    .arrow-icon {
        transition: transform 0.3s ease-in-out;
    }

    .sidebar-dropdown-menu {
        display: flex;
        flex-direction: column;
        gap: 10px;
        background-color: #003366;
        border-radius: 8px;
        padding: 0 10px;
        margin-left: 10px;
        
        max-height: 0px; 
        overflow: hidden;
        opacity: 0;
        visibility: hidden;
        transition: max-height 0.5s ease-in-out, opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
    }    

    .sidebar-dropdown-menu a {
        font-size: 16px;
        padding: 5px 0;
    }

    .sidebar-dropdown-menu.active {
        max-height: 500px;
        opacity: 1;
        visibility: visible;
        padding: 10px;
    }
</style>