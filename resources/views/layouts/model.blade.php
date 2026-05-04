<style>
    /* MAIN MODAL */

    .new-study-modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 99999;
        padding: 15px;
    }

    .new-study-modal.active {
        display: flex;
    }

    /* DARK OVERLAY */

    .new-study-modal-overlay {
        position: absolute;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.75);
        backdrop-filter: blur(4px);
    }

    /* MODAL BOX */

    .new-study-modal-box {
        position: relative;
        background: #fff;
        max-width: 850px;
        width: 100%;
        border-radius: 12px;
        overflow: hidden;
        display: flex;
        align-items: stretch;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
    }

    /* CLOSE BUTTON */

    .new-study-modal-close {
        position: absolute;
        right: 12px;
        top: 10px;
        border: none;
        background: rgba(0, 0, 0, 0.4);
        width: 32px;
        height: 32px;
        border-radius: 50%;
        font-size: 20px;
        color: #fff;
        cursor: pointer;
        z-index: 10;
    }

    /* IMAGE LEFT SIDE */

    .study-right {
        width: 45%;

        /* 👉 IMAGE CHANGE YAHI KARNA */
        background-image: url('/new-home-images/Flight.webp');

        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;

        background-color: #f5f7fb;

        display: flex;
        align-items: center;
        justify-content: center;

        padding: 20px;
    }

    /* CONTENT RIGHT SIDE */

    /* CONTENT RIGHT */
    .study-left {
        width: 60%;
        background: #ffffff;
        color: #333;
        padding: 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .study-left h2 {
        font-size: 26px;
        margin-bottom: 12px;
        text-align: center;
    }

    .study-left p {
        font-size: 15px;
        margin-bottom: 25px;
        line-height: 1.5;
        text-align: center;
    }

    .study-left a.study-guide-button {
        display: inline-block;
        text-decoration: none;
        text-align: center;
        margin-top: 10px;
        padding: 12px 25px;
        background: var(--primary-color);
        color: #fff;
        border-radius: 8px;
        transition: 0.3s;
    }

    .study-left a.study-guide-button:hover {
        background: var(--primary-color);
    }

    @media(max-width:768px) {

        /* Stack image above content */
        .new-study-modal-box {
            flex-direction: column;
        }

        .study-right {
            width: 100%;
            height: 220px;
            margin-bottom: 20px;
            background-size: cover;
        }

        .study-left {
            width: 100%;
            text-align: center;
            align-items: center;
            padding: 20px;
        }

        .study-left a.study-guide-button {
            width: 80%;
        }
    }
</style>


<div id="newstudyModal" class="new-study-modal">

    <div class="new-study-modal-overlay"></div>

    <div class="new-study-modal-box">

        <button class="new-study-modal-close" onclick="closeStudyModal()">&times;</button>

        <!-- IMAGE LEFT -->
        <div class="study-right"></div>

        <!-- CONTENT RIGHT -->
        <div class="study-left">

            <h2>Find Your Perfect University & Course Abroad</h2>

            <p>
                Search international universities, check eligibility criteria, compare programs, and plan your study
                abroad journey - all in one place.
            </p>

            <a href="/course-finder" class="study-guide-button" style="text-decoration: none;">
                Explore Courses Now
                <span>➜</span>
            </a>

        </div>

    </div>

</div>

@include('components.course-registration-form-modal')

<script>
    window.addEventListener('load', function () {

        const modal = document.getElementById('studyModal');
        if (!modal) return;

        const path = window.location.pathname;
        const hasQuery = window.location.search !== "";

        // =========================
        // 🏠 HOMEPAGE → 5 sec delay
        // =========================
        if (path === "/" || path === "/index.html") {

            setTimeout(function () {
                modal.classList.add('active');
                document.body.style.overflow = 'hidden';
            }, 5000);

        }

        // ==========================================
        // 📚 COURSE FINDER → instant (ONLY FIRST TIME)
        // ==========================================
        if (path === "/course-finder" && !hasQuery) {

            if (!sessionStorage.getItem('courseModalShown')) {

                modal.classList.add('active');
                document.body.style.overflow = 'hidden';

                sessionStorage.setItem('courseModalShown', 'true');
            }

        }

    });


    // =========================
    // ❌ CLOSE MODAL FIX
    // =========================
    document.addEventListener('click', function (e) {

        if (
            e.target.classList.contains('custom-study-modal-close') ||
            e.target.classList.contains('custom-study-modal-overlay')
        ) {
            const modal = document.getElementById('studyModal');
            if (modal) modal.classList.remove('active');

            document.body.style.overflow = '';
        }

    });


    // =========================
    // ⌨️ ESC KEY CLOSE
    // =========================
    document.addEventListener('keydown', function (e) {
        if (e.key === "Escape") {
            const modal = document.getElementById('studyModal');
            if (modal) modal.classList.remove('active');

            document.body.style.overflow = '';
        }
    });
</script>


<!-- <script>

const modal = document.getElementById('newstudyModal');

/* ONLY HOMEPAGE + 5 SEC DELAY */

window.onload = function(){

// check homepage
if (window.location.pathname === "/" || window.location.pathname === "/index.html") {

    setTimeout(function(){

        modal.classList.add('active');
        document.body.style.overflow='hidden';

    },5000); // ✅ 5 seconds

}

};

/* CLOSE MODAL */

function closeStudyModal(){
    modal.classList.remove('active');
    document.body.style.overflow='';
}

/* CLICK OUTSIDE CLOSE */

document.querySelector('.new-study-modal-overlay')
.addEventListener('click',closeStudyModal);

/* ESC CLOSE */

document.addEventListener('keydown',function(e){
    if(e.key==="Escape") closeStudyModal();
});

</script> -->