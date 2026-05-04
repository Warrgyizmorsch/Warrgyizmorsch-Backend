<style>
        .trust-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
            position: relative;
            background-color: #e5e3d9;
            border-radius: 50px;
        }

        /* Path styling */
        .path-container {
            position: absolute;
            left: 50%;
            top: 100px;
            bottom: 100px;
            transform: translateX(-50%);
            width: 2px;
            z-index: 1;
        }

        .paths {
            position: absolute;
            width: 100px;
            height: 100%;
            left: -49px;
        }

        /* Section styling */
        .section {
            display: flex;
            gap: 10px;
            margin: 0px 50px;
            align-items: center;
            justify-content: space-between;
            position: relative;
            /* margin-top: -34px; */
            margin-top: 30px;
            z-index: 2;
        }

        .section:nth-child(odd) {
            flex-direction: row-reverse;
        }

        .section-content {
            width: 45%;
            /* padding: 20px; */
        }

        .section-image {
            width: 45%;
            height: 140px;
            display: flex;
        }

        .section-image img {
            max-width: 60%;
            height: auto;
            max-height: 200px;
            border-radius: 10px;
            object-fit: cover;
        }

        .section-title {
            font-size: 19px;
            color: #1f2937;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .section-description {
            font-size: 13px;
            color: #4b5563;
            text-align: center;
        }

        /* Node styling */
        .node {
            position: absolute;
            width: 16px;
            height: 16px;
            background-color: #1f2937;
            border-radius: 50%;
            left: 50%;
            transform: translateX(-50%);
            z-index: 3;
        }

        .process-title {
                font-size: 2rem;
                color: black;
                font-weight: 700;
                margin-bottom: 60px;
                opacity: 0;
                animation: fadeInUp 1s ease forwards;
            }

        .flip {
            transform: scaleX(-1); /* Flips the image horizontally */
            transition: transform 0.5s ease-in-out;
        }

        .padding-space{
            padding:26px;
        }

        .road-canvas {
            position: relative;
            width: 255px;
            height: 150px;
            /* width: 146px;
            height: 108px; */
            display: block;
            opacity: 0;
            transform: rotate(-90deg); 
        }

        .flip-road {
            transform: rotate(-270deg);
        }

        /* .numbering{
            position: absolute;
            top: 39%;
            left: 47%;

        } */

        .numbering-block{
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 20px;
            font-weight: 800;

            height:60px;
            width: 60px;
        }
        .violet{
            background-color: #9259ec;
            color: white;
        }

        .indigo{
            background-color: #97cc42;
            color: white;
        }

        .green{
            background-color: #f8bc31;
            color: white;
        }

        .yellow{
            background-color: #67c1ff;
            color: white;
        }

        .orange{
            background-color: #ff529b;
            color: white;
        }
        .red{
            background-color: #31bd78;
            color: white;
        }
        .olive{
            background-color: #626F47;
            color: white;
        }
        .pink{
            background-color: #DD88CF;
            color: white;
        }

        #road-object {
            position: absolute;
            top: 10px;
            z-index: 10;
            transition: transform 0.5s ease;
            pointer-events: none;
        }
        #road-object img{
            height: 100px;
            width: 100px;
        }

        .section-1-curve-img{
            height: 250px; 
            position: absolute; 
            left:49%; 
            top:-25px;
        }
        .section-2-curve-img{
            height: 250px; 
            position: absolute; 
            left:34%; 
            top:-34.5px;
        }
        .section-3-curve-img{
            height: 250px; 
            position: absolute; 
            left:49%; 
            top:-44px;
        }
        .section-4-curve-img{
            height: 250px; 
            position: absolute; 
            left:34%; 
            top:-53.5px;
        }
        .section-5-curve-img{
            height: 250px; 
            position: absolute; 
            left:49%; 
            top:-63px;
        }
        .section-6-curve-img{
            height: 250px; 
            position: absolute; 
            left:34%; 
            top:-72.5px;
        }
        .section-7-curve-img{
            height: 250px; 
            position: absolute; 
            left:49%; 
            top:-82px;
        }
        .section-8-curve-img{
            height: 250px; 
            position: absolute; 
            left:34%; 
            top:-91.5px;
        }

        .apply-btn {
    padding: 12px 36px;
    background: linear-gradient(135deg, #fca503, #ffd700, #007BFF);
    background-size: 300% 300%;
    border: none;
    border-radius: 30px;
    color: white;
    font-weight: bold;
    font-size: 20px;
    cursor: pointer;
    transition: all 0.4s ease;
    box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
    position: relative;
    overflow: hidden;
}

.apply-btn::before {
    content: "";
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.2);
    transform: skewX(-20deg);
    transition: 0.6s;
}

.apply-btn:hover {
    background-position: right center;
    transform: translateY(-4px) scale(1.03);
    box-shadow: 0 8px 25px rgba(0, 123, 255, 0.5);
}

.apply-btn:hover::before {
    left: 200%;
}



        @media (min-width: 768px) and (max-width: 1024px) {
            .section-description{
                display: none;
            }
            .section-image img{
                max-width: 100%;
            }
            .section-1-curve-img{
            height: 250px; 
            position: absolute; 
            left:49%; 
            top:-25px;
        }
        .section-2-curve-img{
            height: 250px; 
            position: absolute; 
            left:31%; 
            top:-35px;
        }
        .section-3-curve-img{
            height: 250px; 
            position: absolute; 
            left:49%; 
            top:-45px;
        }
        .section-4-curve-img{
            height: 250px; 
            position: absolute; 
            left:31%; 
            top:-55px;
        }
        .section-5-curve-img{
            height: 250px; 
            position: absolute; 
            left:49%; 
            top:-65px;
        }
        .section-6-curve-img{
            height: 250px; 
            position: absolute; 
            left:31%; 
            top:-75px;
        }
        .section-7-curve-img{
            height: 250px; 
            position: absolute; 
            left:49%; 
            top:-85px;
        }
        .section-8-curve-img{
            height: 250px; 
            position: absolute; 
            left:31%; 
            top:-95px;
        }
        }
        /* Responsive styles */
        @media (max-width: 768px) {
            /* .section {
                flex-direction: column;
                text-align: center;
                margin-bottom: 0px;
            }

            .section:nth-child(even) {
                flex-direction: column;
            } */

            .section-content, .section-image {
                width: 100%;
            }
            .section {
                display: flex;
                gap: 0px;
                margin: 0px 0px;
                align-items: center;
                justify-content: space-between;
                position: relative;
                /* margin-top: -64px; */
                /* margin-top: -40px; */
                margin-top: -28px;
                z-index: 2;
            }

            .section-image {
                display: flex;
                align-items: center;
                margin-bottom: 20px;
            }
            
            .section-image img {
                max-width: 100%;
                max-height: 100px;
            }
            .path-container {
                display: none;
            }

            .node {
                position: static;
                margin: 0 auto 20px;
                transform: none;
            }
            .padding-space{
                padding: 3px;
            }
            .process-title{
                font-size: 1.75rem;
                margin-bottom: 20px;
            }
            .section-description{
                display: none;
            }
            .section-title {
                font-size: 15px;
                color: #1f2937;
                font-weight: bold;
            }
            .extra-space{
                padding: 20px;
            }
            
            .hide{
                display: none;
            }
            #road-object img{
                height: 60px;
                width: 60px;
            }
            .road-canvas{
                opacity: 1;
            }
            
        }

    @media (max-width: 499px){
        .numbering{
            position: absolute;
            top: 29%;
            left: 41%;
            }
    }

    @media (min-width: 500px) and (max-width: 768px){
        .numbering{
            position: absolute;
            top: 29%;
            left: 46%;
            }
    }
</style>

<section style="padding: 30px 0px;">
    <div class="trust-container">

        <!-- Title  -->
         <h2 class="process-title">Process Flow</h2>

         <div id="road-object">
            <img src="/images/vecteezy_walking-man-in-orange-hoodie-and-backpack_56099201.png" loading="lazy"  alt="image">
         </div>

        <div class="extra-space"></div>
        <!-- Section 1 -->
        <div class="section"> 
            
            <div class="padding-space"></div>
            <div style="justify-content: right;" class="section-image">
                <img src="/images/trusted-comp-img/profileEval.png" loading="lazy"  alt="image">
            </div>
            <!-- <img src="/images/path.svg" alt="path"> -->
             <img class="hide section-1-curve-img" src="/images/trusted-comp-img/orangecurve.png" loading="lazy" alt="image">
             

            <!-- <canvas class="road-canvas"></canvas> -->
             <canvas class="road-canvas flip-road"></canvas>
             <div class="numbering">
                <div class="numbering-block orange">1</div>
            </div>

            <div class="section-content">
                <p class="section-title">Profile Evaluation </p>
                <p class="section-description">Send us your academic documents & resume</p>
            </div>
        </div>

        <!-- Section 2 -->
        <div  class="section">
            
            <div class="padding-space"></div>
            <div style="justify-content: left;" class="section-image">
                <img src="/images/trusted-comp-img/University_shortlisting.png" loading="lazy" alt="image">
            </div>
            <!-- <img class="flip" src="/images/path.svg" alt="path"> -->
            <!-- <img class="flip hide" style = "height: 250px; position: absolute; left:37%; top:-29.5px;" src="/images/trusted-comp-img/orangecurve.png" alt="image"> -->
            <img class="flip hide section-2-curve-img" src="/images/trusted-comp-img/orangecurve.png" loading="lazy" alt="image">

            <!-- <canvas class="road-canvas flip-road"></canvas> -->
             <canvas class="road-canvas"></canvas>

             <div class="numbering">
                <div class="numbering-block indigo">2</div>
            </div>
            <div class="section-content">
                <p class="section-title">University Shortlisting</p>
                <p class="section-description">Get tailored options based on your profile</p>
            </div>
        </div>

        <!-- Section 3 -->
        <div style=" " class="section">
           
            <div class="padding-space"></div>
            <div style="justify-content: right;" class="section-image">
                <img src="/images/trusted-comp-img/application_process.png" loading="lazy" alt="image">
                 <!-- <img src="/icons/image.png" alt="image"> -->
            </div>
            <!-- <img class="hide" style = "height: 250px; position: absolute; left:49%; top:-34px;" src="/images/trusted-comp-img/orangecurve.png" alt="image"> -->
            <img class="hide section-3-curve-img" src="/images/trusted-comp-img/orangecurve.png" loading="lazy" alt="image">
            <!-- <img src="/images/path.svg" alt="path"> -->

            <!-- <canvas class="road-canvas"></canvas> -->
             <canvas class="road-canvas flip-road"></canvas>
             <div class="numbering">
                <div class="numbering-block green">3</div>
            </div>

            <div class="section-content">
                <p class="section-title">Application Process</p>
                <p class="section-description">We help gather your personal documents & apply</p>
            </div>
        </div>

        <!-- Section 4 -->
        <div style=" " class="section">
            
            <div class="padding-space"></div>
            <div style="justify-content: left;" class="section-image">
                 <img src="/images/trusted-comp-img/offer_letter.png" loading="lazy" alt="image">
            </div>
            <!-- <img class="flip hide" style = "height: 250px; position: absolute; left:37%; top:-38.5px;" src="/images/trusted-comp-img/orangecurve.png" alt="image"> -->
            <img class="flip hide section-4-curve-img" src="/images/trusted-comp-img/orangecurve.png" loading="lazy" alt="image">
            <!-- <img class="flip" src="/images/path.svg" alt="path"> -->

             <!-- <canvas class="road-canvas flip-road"></canvas> -->
              <canvas class="road-canvas"></canvas>
              <div class="numbering">
                <div class="numbering-block yellow">4</div>
            </div>

            <div class="section-content">
                <p class="section-title">Offer Letters</p>
                <p class="section-description">Track conditional & unconditional offers</p>
            </div>
        </div>

        <!-- Section 5 -->
        <div  class="section">
            
            <div class="padding-space"></div>
            <div style="justify-content: right;" class="section-image">
                <img src="/images/trusted-comp-img/financial_deposit.png" loading="lazy" alt="image">
            </div>
            <!-- <img class="hide" style = "height: 250px; position: absolute; left:49%; top:-43px;" src="/images/trusted-comp-img/orangecurve.png" alt="image"> -->
            <img class="hide section-5-curve-img" src="/images/trusted-comp-img/orangecurve.png" loading="lazy" alt="image">
            <!-- <img src="/images/path.svg" alt="path"> -->

            <!-- <canvas class="road-canvas"></canvas> -->
             <canvas class="road-canvas flip-road"></canvas>
             <div class="numbering">
                <div class="numbering-block violet">5</div>
            </div>

            <div class="section-content">
                <p class="section-title">Initial Deposit & Financial Docs</p>
                <p class="section-description">Guided fund prep for CAS</p>
            </div>
        </div>

        <!-- Section 6 -->
        <div style=" " class="section">
            
            <div class="padding-space"></div>
            <div style="justify-content: left;" class="section-image">
                <img src="/images/trusted-comp-img/cas_issue.png" loading="lazy" alt="image">
            </div>
            <!-- <img class="flip hide" style = "height: 250px; position: absolute; left:37%; top:-47.5px;" src="/images/trusted-comp-img/orangecurve.png" alt="image"> -->
            <img class="flip hide section-6-curve-img" src="/images/trusted-comp-img/orangecurve.png" loading="lazy" alt="image">
            <!-- <img class="flip" src="/images/path.svg" alt="path"> -->

             <!-- <canvas class="road-canvas flip-road"></canvas> -->
              <canvas class="road-canvas "></canvas>
              <div class="numbering">
                <div class="numbering-block red">6</div>
            </div>

            <div class="section-content">
                <p class="section-title">CAS Issuance</p>
                <p class="section-description">UWe ensure you meet every requirement</p>
            </div>
        </div>

        <!-- Section 7 -->
        <div  class="section">
            
            <div class="padding-space"></div>
            <div style="justify-content: right;" class="section-image">
                <img src="/images/trusted-comp-img/medical-test.png" loading="lazy" alt="image">
            </div>
            <!-- <img class="hide" style = "height: 250px; position: absolute; left:49%; top:-43px;" src="/images/trusted-comp-img/orangecurve.png" alt="image"> -->
            <img class="hide section-7-curve-img" src="/images/trusted-comp-img/orangecurve.png" loading="lazy" alt="image">
            <!-- <img src="/images/path.svg" alt="path"> -->

            <!-- <canvas class="road-canvas"></canvas> -->
             <canvas class="road-canvas flip-road"></canvas>
             <div class="numbering">
                <div class="numbering-block pink">7</div>
            </div>

            <div class="section-content">
                <p class="section-title">Medical Test & VISA Filing</p>
                <p class="section-description">Done with expert support</p>
            </div>
        </div>

        <!-- Section 8 -->
        <div style=" " class="section">
            
            <div class="padding-space"></div>
            <div style="justify-content: left;" class="section-image">
                <img src="/images/trusted-comp-img/flight_booking.png" loading="lazy" alt="image">
            </div>
            <!-- <img class="flip hide" style = "height: 250px; position: absolute; left:37%; top:-47.5px;" src="/images/trusted-comp-img/orangecurve.png" alt="image"> -->
            <img class="flip hide section-8-curve-img" src="/images/trusted-comp-img/orangecurve.png" loading="lazy" alt="image">
            <!-- <img class="flip" src="/images/path.svg" alt="path"> -->

             <!-- <canvas class="road-canvas flip-road"></canvas> -->
              <canvas class="road-canvas "></canvas>
              <div class="numbering">
                <div class="numbering-block olive">8</div>
            </div>

            <div class="section-content">
                <p class="section-title">Flight Bookings & Beyond</p>
                <p class="section-description">You're all set to fly!</p>
            </div>
        </div>

        <!-- Contact Us Button  -->
        <div style="display: flex; justify-content: center; margin-top: 40px;">
            <button class="apply-btn" onclick="openRegistrationForm()">Apply Now</button>
        </div>
    </div>
</section>

<!-- Registration Form Script  -->
 <script>
function openRegistrationForm() {
    document.getElementById('registrationModal').style.display = 'block';
}

function closeRegistrationForm() {
    document.getElementById('registrationModal').style.display = 'none';
}

window.onclick = function(event) {
    var modal = document.getElementById('registrationModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}
</script>

<script>
        document.addEventListener('DOMContentLoaded', function () {
            function checkIfInView() {
                const sections = document.querySelectorAll('.section');
                const windowHeight = window.innerHeight;

                sections.forEach(section => {
                    const sectionTop = section.getBoundingClientRect().top;
                    const sectionBottom = section.getBoundingClientRect().bottom;

                    if (sectionTop < windowHeight * 0.88 && sectionBottom > 0) {
                        section.style.opacity = '1';
                    } else {
                        section.style.opacity = '0';
                    }
                });
            }

            // Set initial opacity and transition
            const sections = document.querySelectorAll('.section');
            sections.forEach(section => {
                section.style.opacity = '0';
                section.style.transition = 'opacity 0.5s ease-in-out';
            });

            // Check positions on load and scroll
            checkIfInView();
            window.addEventListener('scroll', checkIfInView);
        });

        // Drawing road 

    document.addEventListener('DOMContentLoaded', function () {
    function drawSemicircleRoad(canvas, flip = false) {
        if (!canvas) return;
        const ctx = canvas.getContext('2d');
        const isMobile = window.innerWidth <= 768;

        canvas.width = isMobile ? 192 : 220;
        canvas.height = isMobile ? 180 : 120;

        ctx.clearRect(0, 0, canvas.width, canvas.height);

        if (flip) {
            ctx.translate(canvas.width, 0);
            ctx.scale(-1, 1);
        }

        ctx.beginPath();
        ctx.lineWidth = 25;
        ctx.strokeStyle = "#fca503";
        ctx.arc(100, 100, 80, Math.PI, 2 * Math.PI);
        ctx.stroke();

        ctx.beginPath();
        ctx.setLineDash([10, 10]);
        ctx.strokeStyle = "#fff";
        ctx.lineWidth = 3;
        ctx.arc(100, 100, 80, Math.PI, 2 * Math.PI);
        ctx.stroke();
        ctx.setLineDash([]);
    }

    function updateCanvasSize() {
        document.querySelectorAll('.road-canvas').forEach((canvas) => {
            const isFlipped = canvas.classList.contains('flip-road');
            drawSemicircleRoad(canvas, isFlipped);
        });
    }

    updateCanvasSize();
    window.addEventListener('resize', updateCanvasSize);

    const roadObject = document.getElementById('road-object');
    const sections = document.querySelectorAll('.section');

//     function moveObjectAlongArc(canvas, flip = false) {
//     if (!canvas) return;

//     const isMobile = window.innerWidth <= 768;
//     const trustContainer = document.querySelector('.trust-container');
//     const containerTop = trustContainer.getBoundingClientRect().top + window.scrollY;

//     const canvasRect = canvas.getBoundingClientRect();
//     const scrollY = window.scrollY || window.pageYOffset;
//     const canvasTop = canvasRect.top + scrollY - containerTop;

//     const radius = 80;
//     const centerX = canvas.offsetLeft + 100;
//     const centerY = canvasTop ;

//     let progress = 0;
//     const duration = 1;
//     const start = performance.now();

//     function animate(time) {
//         const elapsed = time - start;
//         progress = Math.min(elapsed / duration, 1);

//         const angle = (Math.PI - 1) + progress * Math.PI;
//         const x = centerX + radius * Math.cos(angle) * (flip ? 1 : -1);
//         const y = centerY + radius * Math.sin(angle);

//         if(isMobile){
//             roadObject.style.transform = `translate(${x - 50}px, ${y + 40}px)`; 
//         } else{
//             roadObject.style.transform = `translate(${x + 20}px, ${y + 50}px)`; 
//         }

//         if (progress < 1) {
//             requestAnimationFrame(animate);
//         }
//     }

//     requestAnimationFrame(animate);
// }

let isFlippedX = false; // global flip state

function moveObjectAlongArc(canvas, flip = false) {
    if (!canvas) return;

    const isMobile = window.innerWidth <= 768;
    const trustContainer = document.querySelector('.trust-container');
    const containerTop = trustContainer.getBoundingClientRect().top + window.scrollY;

    const canvasRect = canvas.getBoundingClientRect();
    const scrollY = window.scrollY || window.pageYOffset;
    const canvasTop = canvasRect.top + scrollY - containerTop;

    const radius = 80;
    const centerX = canvas.offsetLeft + 100;
    const centerY = canvasTop;

    let progress = 0;
    const duration = 1; 
    const start = performance.now();

    function animate(time) {
        const elapsed = time - start;
        progress = Math.min(elapsed / duration, 1);

        const angle = (Math.PI - 1) + progress * Math.PI;
        const x = centerX + radius * Math.cos(angle) * (flip ? 1 : -1);
        const y = centerY + radius * Math.sin(angle);

        const translateX = isMobile ? x - 50 : x + 20;
        const translateY = isMobile ? y + 40 : y + 50;
        const scaleX = isFlippedX ? -1 : 1;

        roadObject.style.transform = `translate(${translateX}px, ${translateY}px) scaleX(${scaleX})`;

        if (progress < 1) {
            requestAnimationFrame(animate);
        } else {
            isFlippedX = !isFlippedX;
        }
    }

    requestAnimationFrame(animate);
}



    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const canvas = entry.target.querySelector('canvas.road-canvas');
                const isFlipped = canvas.classList.contains('flip-road');
                moveObjectAlongArc(canvas, isFlipped);
            }
        });
    }, {
        threshold: 0.6
    });

    sections.forEach(section => observer.observe(section));
});


</script>