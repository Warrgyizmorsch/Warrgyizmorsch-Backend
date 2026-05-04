<section class="bottom-menu">
    <div class="menu-item">
        <a href="/contact">
            <!-- <i class="fa-solid fa-envelope"></i> -->
            <!-- <img src="{{ asset('icons/mail.png') }}" alt="Mail" /> -->
            <img src="{{ asset('icons/mail-yellow.png') }}" alt="Mail" />
        </a>
    </div>
    <div class="menu-item">
      @if(Route::currentRouteName() === 'landing_page' || Route::currentRouteName() === 'landing_page2' || Route::currentRouteName() === 'study_abroad_consultant' )
            <a href="tel:+918000915743">
                <img src="{{ asset('icons/phone-call-yellow.png') }}" alt="phone" />
            </a>
        @else
            <a href="tel:+919116076837">
                <!-- <i class="fa-solid fa-phone"></i> -->
                <!-- <img src="{{ asset('icons/phone-call.png') }}" alt="phone" /> -->
                <img src="{{ asset('icons/phone-call-yellow.png') }}" alt="phone" />
            </a>
        @endif
    </div>
    <div class="menu-item">
         @if(Route::currentRouteName() === 'landing_page' || Route::currentRouteName() === 'landing_page2' || Route::currentRouteName() === 'study_abroad_consultant' )
            <a href="https://wa.me/918000915743?text=Hi%2C%20I%E2%80%99m%20looking%20for%20visa%20consultation%20services.%20Can%20you%20please%20assist%20me%20with%20the%20next%20steps%3F" target="_blank">
                <i class="fa-brands fa-whatsapp"></i>
            </a>
        @else
            <a href="https://wa.me/919116076837?text=Hi%2C%20I%E2%80%99m%20looking%20for%20visa%20consultation%20services.%20Can%20you%20please%20assist%20me%20with%20the%20next%20steps%3F" target="_blank">
                <i class="fa-brands fa-whatsapp"></i>
            </a>
        @endif
    </div>
</section>

<style>
    .bottom-menu {
    position: fixed;
    bottom: 0;
    padding: 15px;
    width: 100%;
    background-color: #003366;
    display: flex;
    justify-content: space-around;
    align-items: center;
    border-top-left-radius: 20px;
    border-top-right-radius: 20px;
    z-index: 2000;

    transform: translateY(100%);
    opacity: 0;
    transition: transform 0.5s ease-out, opacity 0.5s ease-out;
    display: none;
}

/* Menu items styling */
.menu-item {
    width: 25px;
    height: 25px;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Styling for icons */
.menu-item i, .menu-item img {
    font-size: 22px; 
    width: 100%;
    height: 100%;
    object-fit: cover;
    /* color: white; */
    color: #FFD80E;
}

/* Show only on mobile screens */
@media screen and (max-width: 768px) {
    .bottom-menu {
        display: flex;
    }
}

@media screen and (min-width: 769px) {
    .bottom-menu {
        display: none !important;
    }
}


</style>

<script>
     document.addEventListener("DOMContentLoaded", function() {
        setTimeout(() => {
            let menu = document.querySelector(".bottom-menu");
            menu.style.transform = "translateY(0)";
            menu.style.opacity = "1";
        }, 200); 
    });
</script>