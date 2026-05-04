// For Section title

document.addEventListener("DOMContentLoaded", function () {
    const titles = document.querySelectorAll(".new-section-title");
    const items = document.querySelectorAll(".support-item");
    const journeycards = document.querySelectorAll(".new-journey-card");

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("visible");
                } else {
                    entry.target.classList.remove("visible"); // animate every time
                }
            });
        },
        { threshold: 0.1 }
    );

    titles.forEach((title) => observer.observe(title));
    items.forEach((item) => observer.observe(item));
    journeycards.forEach((card, index) => {
        card.style.transitionDelay = `${index * 0.2}s`;
        observer.observe(card);
    });
});

// Top Countries Section JS Started
document.addEventListener("DOMContentLoaded", () => {
    const list = document.getElementById("countryList");
    const cards = list.querySelectorAll(".new-country-card");
    const dotsWrap = document.getElementById("scrollDots");
    const countryData = window.countryData; // data from Blade
    const mainImg = document.getElementById("countryImage");
    const listEl = document.getElementById("countryFeatures");
    const exploreBtn = document.getElementById("exploreBtn");

    // build dots
    const pageSize = 5;
    const pages = Math.ceil(cards.length / pageSize);
    for (let i = 0; i < pages; i++) {
        const dot = document.createElement("span");
        if (i === 0) dot.classList.add("active");
        dotsWrap.appendChild(dot);
    }
    const dots = dotsWrap.querySelectorAll("span");

    // highlight dot based on scroll
    list.addEventListener("scroll", () => {
        const cardHeight = cards[0].offsetHeight + 15;
        const page = Math.round(list.scrollTop / (cardHeight * pageSize));
        dots.forEach((d, i) => d.classList.toggle("active", i === page));
    });

    // Smooth fade function
    function fadeElement(el, newContent) {
        el.style.transition = "opacity 0.5s";
        el.style.opacity = 0; // fade out

        setTimeout(() => {
            if (el.tagName === "IMG") {
                el.src = newContent.src;
                el.alt = newContent.alt;
            } else {
                el.innerHTML = newContent;
            }
            el.style.opacity = 1; // fade in
        }, 500); // match transition
    }

    // country-switch logic
    cards.forEach((card) => {
        card.addEventListener("click", () => {
            document
                .querySelector(".new-country-card.active")
                ?.classList.remove("active");
            card.classList.add("active");

            const key = card.dataset.country;
            const data = countryData[key];

            // fade main image
            fadeElement(mainImg, { src: data.image, alt: data.name });

            // fade features list
            const newFeaturesHTML = data.features
                .map(
                    (f) =>
                        `<li style="display:flex;align-items:center;gap:8px;">
                            <img src="/new-home-images/svg-icons/check-circle.svg" style="height:20px;"> ${f}
                         </li>`
                )
                .join("");
            fadeElement(listEl, newFeaturesHTML);

            if (exploreBtn) {
                exploreBtn.href = data.route;
            }
        });
    });
});

document.addEventListener("DOMContentLoaded", () => {
    const list = document.querySelector("#countryList");
    const section = document.querySelector(".new-countries-section");
    if (!list || !section) return; // stop if elements not found

    let autoScrollTimer = null;
    let directionDown = true;

    function autoScroll() {
        const step = list.clientHeight * 0.9; // about one viewport of the list

        if (directionDown) {
            list.scrollBy({ top: step, behavior: "smooth" });
            // reached bottom? reverse next time
            if (list.scrollTop + list.clientHeight >= list.scrollHeight - 2) {
                directionDown = false;
            }
        } else {
            list.scrollBy({ top: -step, behavior: "smooth" });
            if (list.scrollTop <= 0) {
                directionDown = true;
            }
        }
    }

    function startLoop() {
        if (!autoScrollTimer) {
            // run first step immediately, then every 3 s
            autoScroll();
            autoScrollTimer = setInterval(autoScroll, 6000);
        }
    }

    function stopLoop() {
        if (autoScrollTimer) {
            clearInterval(autoScrollTimer);
            autoScrollTimer = null;
        }
    }

    // Observe when the whole section enters/leaves viewport
    const observer = new IntersectionObserver(
        (entries) => {
            const entry = entries[0];

            if (window.innerWidth < 768) {
                stopLoop();
                return;
            }

            if (entry.isIntersecting) {
                startLoop();
            } else {
                stopLoop();
            }
        },
        { threshold: 0.3 }
    );

    observer.observe(section);
});
// Top Countries Section JS Ended
// Testimonial Section JS Started
let currentVideo = null;
let currentPlayer = null;

function restoreThumbnail(wrapper) {
    if (!wrapper) return;

    const imgSrc = wrapper.dataset.image;

    wrapper.innerHTML = `
        <img src="${imgSrc}" 
             alt="" 
             style="width:100%; height:100%; object-fit:cover;">
        <button class="video-play-btn" aria-label="Play testimonial video"></button>
    `;
}

// Called when user clicks on any facade
function loadYoutube(el) {
    const videoId = el.getAttribute("data-video-id");

    // If API not ready yet, do nothing
    if (!window.YT || !ytReady) {
        console.warn("YouTube API not ready yet");
        return;
    }

    // If another video is already playing, reset it
    if (currentPlayer && currentVideo && currentVideo !== el) {
        try {
            currentPlayer.stopVideo();
            currentPlayer.destroy();
        } catch (e) {}
        restoreThumbnail(currentVideo);
        currentPlayer = null;
        currentVideo = null;
    }

    // If clicking again on the same video while player exists,
    // just let the API handle pause → we restore in onStateChange.
    currentVideo = el;

    // Create container for YT player
    const playerId = "yt-player-" + videoId + "-" + Date.now();
    el.innerHTML = `<div id="${playerId}" style="width:100%; height:100%;"></div>`;

    currentPlayer = new YT.Player(playerId, {
        videoId: videoId,
        playerVars: {
            autoplay: 1,
            rel: 0,
            modestbranding: 1,
        },
        events: {
            onStateChange: function (event) {
                // 2 = PAUSED, 0 = ENDED
                if (
                    event.data === YT.PlayerState.PAUSED ||
                    event.data === YT.PlayerState.ENDED
                ) {
                    // Restore thumbnail + button
                    restoreThumbnail(el);

                    try {
                        currentPlayer.destroy();
                    } catch (e) {}

                    currentPlayer = null;
                    currentVideo = null;

                    // Resume swiper autoplay
                    if (window.videoSwiper) {
                        window.videoSwiper.autoplay.start();
                    }
                }
            },
        },
    });

    // Stop swiper autoplay when video starts
    if (window.videoSwiper) {
        window.videoSwiper.autoplay.stop();
    }
}

document.addEventListener("DOMContentLoaded", () => {
    window.videoSwiper = new Swiper(".video-swiper", {
        slidesPerView: 3,
        spaceBetween: 15,
        loop: true,
        navigation: {
            nextEl: ".custom-swiper-next",
            prevEl: ".custom-swiper-prev",
        },
        autoplay: {
            delay: 2000,
            disableOnInteraction: false,
        },
        speed: 800,
        breakpoints: {
            0: { slidesPerView: 1 },
            576: { slidesPerView: 2 },
            768: { slidesPerView: 2.5 },
            992: { slidesPerView: 3.5 },
        },
    });
});

// Testimonial Section JS Ended

// 8 Step Section JS Started
document.addEventListener("DOMContentLoaded", () => {
    const items = document.querySelectorAll(".new-accordion .new-item");
    const imgBox = document.getElementById("new-stepImage");

    // helper for smooth image change
    function animateImage(el, newSrc, effect = "zoom") {
        let className = "";

        if (effect === "zoom") className = "img-zoom";
        if (effect === "slide") className = "img-slide";
        if (effect === "flip") className = "img-flip";

        el.classList.add(className);

        setTimeout(() => {
            el.src = newSrc;
            el.classList.remove(className);
        }, 400); // time should match transition
    }

    items.forEach((item) => {
        const header = item.querySelector(".new-header");
        const content = item.querySelector(".new-content");

        header.addEventListener("click", () => {
            const isOpen = header.classList.contains("active");

            // Close all
            items.forEach((i) => {
                i.querySelector(".new-header").classList.remove("active");
                i.querySelector(".new-content").style.maxHeight = null;
            });

            // Toggle current
            if (!isOpen) {
                header.classList.add("active");
                content.style.maxHeight = content.scrollHeight + "px";
                animateImage(imgBox, item.dataset.img, "zoom"); // smooth image change
            }
        });
    });
});

// 8 Step Section JS Ended
// FAQ Section JS Started
document.querySelectorAll(".new-faq-btn").forEach((btn) => {
    btn.addEventListener("click", () => {
        const content = btn.nextElementSibling;
        const open = content.classList.contains("open");
        document.querySelectorAll(".new-faq-content").forEach((c) => {
            c.style.maxHeight = null;
            c.classList.remove("open");
        });
        document
            .querySelectorAll(".new-faq-btn")
            .forEach((b) => b.classList.remove("active"));
        if (!open) {
            content.classList.add("open");
            content.style.maxHeight = content.scrollHeight + "px";
            btn.classList.add("active");
        }
    });
});
// FAQ Section JS Ended|

// Services Section JS Started
document.addEventListener("DOMContentLoaded", () => {
    const cards = document.querySelectorAll(".new-home-service-card");
    const modal = document.querySelector(".new-service-modal");
    const overlay = document.querySelector(".new-service-modal-overlay");
    const closeBtn = document.querySelector(".new-service-close");
    const titleBox = document.querySelector(".new-service-title");
    const textBox = document.querySelector(".new-service-text");

    const details = {
        3: `
        <div class="service-details-container">
        <p>Choosing a course is a highly significant aspect of designing your future career and academic life. Choosing the right course equips you with the skills and knowledge to excel in your desired profession. WTS Visa Consultancy understands the intimidating nature of this choice, especially in choosing to study abroad. Hence, we offer expert advice to guide you through a long list of courses to choose the right one.</p>
        <p>Our counselors take your career aspiration, study interest, and interest to guide you to the most appropriate courses that meet your aspirations. We assist you in selecting courses from top-ranked universities and institutions across the globe, thereby giving you a career edge.</p>
        <p><strong>What are the key factors we take into account while selecting courses:</strong></p>
        <ul>
            <li><strong>Career Aspirations: </strong>Choosing a course that matches your long-term career goal.</li>
            <li><strong>Interest and Passion: </strong>Aligning the course with your mental ability and passion.</li>
            <li><strong>University Reputation: </strong>Helping you select courses offered by popular universities for best prospects.</li>
            <li><strong>Location and Opportunities: </strong>Including study destinations that offer good employment opportunities after graduation.</li>
        </ul>
        <p>Expert consultation and personalized assistance make your course choice the best stepping stone for academic and career success.</p>
        </div>
    `,
        4: `
        <div class="service-details-container">
        <p>Joining a reputable academic institution is a landmark in your academic career. If you are entering into undergraduate, postgraduate, or PhD study, it is wise to have information about the admission process so that you can secure your seat. We at WTS Visa Consultancy provide professional consultancy at each step of your admission so that you can take rational decisions and complete all the requirements.</p>
        <p><strong>Major Steps of the Admission Procedure</strong></p>
        <ul>
            <li><strong>Choosing the Best Program: </strong>Our counselors will help you pick a program most appropriate based on your career and educational objectives.</li>
            <li><strong>Guidance on Applications: </strong>We help you fill application forms, write personal statements, and prepare the documents to be submitted in such a manner that they are submitted correctly and within time.</li>
            <li><strong>Document Assembly: </strong>From letters of recommendation to transcripts, we assist you in obtaining and securing all necessary documents.</li>
            <li><strong>College Selection: </strong>We support you in limiting colleges that fit you best as per your scholarly background, finance, and passions.</li>
            <li><strong>Interview Prep: </strong>In the event that your desired college imposes an interview, we coach and conduct mock interviews to prepare in confidence.</li>
            <li><strong>Offer Letter Counseling: </strong>Once we get your offer letter, we counsel you to review the letter and what should be adhered to next.</li>
        </ul>
        <p>Our professional guidance makes the process of admission less tense, with a higher chance of securing an admission to your preferred university.</p>
        </div>
       
    `,
        5: `
        <div class="service-details-container">
        <p>A Statement of Purpose (SOP) is a critical document in international university admission for applicants. It gives the chance to represent yourself apart from your test scores and grades by declaring your professional goals, areas of academic interest, and desire to study for a particular course. An efficient SOP can help strengthen your application to a core level, informing the admissions committee about your motive clearly.</p>
        <p>Begin your SOP with an introduction of your education and what steered you towards the course study. It would be succeeded by your most important academic accomplishments, projects, or internships which steered you towards the program.</p>
        <p>Explain why you've chosen this specific program and school. Be exact about what it is that you're drawn to the course of study and what it is about the instructors and research work. This paragraph must demonstrate that you've done much research on the program.</p>
        <p>Discuss your long-term goals for your career and how the program will be included among these goals. Demonstrate how learning and experience that you will acquire will contribute to career growth.</p>
        <p>End your SOP by indicating your interest in the program and desire to pursue studies at the university. Keep your SOP brief, interesting, and error-free to get maximum output.</p>
        </div>
        
    `,
        6: `
        <div class="service-details-container">
        <p>Mock visa interview for visa application is a mock interview session that is done to simulate the real visa interview process so that applicants are well prepared to deal with the questions and situations that might occur. It is particularly helpful for students who apply for study visas or other types of visas where an interview is mandatory. Below are the ways in which mock visa interviews can be helpful to you:</p>
        <ul>
            <li><strong>Understand Visa-Specific Questions:</strong> Mock interviews allow you to rehearse questions commonly asked by visa officers such as your intention to visit, your connections in your home country, and your financials.</li>
            <li><strong>Improve Communication Skills: </strong>These sessions provide you with knowledge of how you should explain eloquently your plans, past, and aims so that you deliver your responses concisely and effectively.</li>
            <li><strong>Gain Confidence: </strong>By simulating the real interview scenario, mock interviews can drain tension and leave you better prepared and confident on your actual interview day.</li>
            <li><strong>Gain Constructive Criticism: </strong>Get constructive feedback on your response, body language, and presence, and address these in time for your actual interview.</li>
            <li><strong>Prepare for Unexpected Questions: </strong>Practice interviews familiarize you with answering unexpected questions so that you're never in the dark whenever any challenge comes your way in your actual visa interview.</li>
        </ul>
        <p>Practice visa interviews offer you an opportunity to rehearse responses and delivery, which opens your doors towards the possibility of succeeding in your real visa interview.</p>
        </div>
       
    `,
        7: `
        <div class="service-details-container">
        <p>We, at WTS Visa Consultancy, understand that your travel booking is part of your foreign study or foreign experience. Our doorstep-to-doorstep travel booking makes it easier for you in such a way that whatever is important in connection with your travel, which is precious, gets taken care of to a large extent, and you are free to enjoy your study or new experience with a clear mind. This is how we treat your travel bookings:</p>
        <ul>
            <li><strong>Flight Booking: </strong>We help you choose the best flight in terms of budget and timing so that you may fly on favorable dates and experience hassle-free layover.</li>
            <li><strong>Hotel Booking: </strong>Airport Pick-up and Drop:</li>
            <li><strong>Airport Pick-up and Drop: </strong>Airport pick-up to transfer, we provide you with hassle-free and smooth airport-to-destination travel.</li>
            <li><strong>Travel Insurance: </strong></li>
            <li><strong>Visa and Documentation Service: </strong></li>
        </ul>
        <p>Now that your case has been handed over to WTS Visa Consultancy, you should not worry whatsoever but rather go forward with furthering your career or study progress with confidence that it is in capable hands.</p>
        </div>
       
    `,
        8: `
        <div class="service-details-container">
        <p>Visa consultancy is a crucial facility for any aspirant who is going to pursue studies or move abroad. Applying for a visa can be stressful, but if you consult us, visa application becomes simpler and quicker. We provide full-fledged visa consultancy at WTS Visa Consultancy so that you get all documentation and deadlines to fulfill, along with your international journey as seamless as possible.</p>
        <p>Our expert counselors give you customized counseling based on your requirement, either for an immigration visa or a student visa. We take you through step by step, from choosing the right type of visa, getting documents ready, and submitting them in the right way.</p>
        <p><strong>Our Visa Services include:</strong></p>
        <ul>
            <li><strong>Professional Visa Guidance: </strong>Customized advice on the proper visa for your purpose.</li>
            <li><strong>Document Assistance: </strong>Assistance in compilation and preparation of required documents.</li>
            <li><strong>Application Submission: </strong>Filling and submission of your application in time.</li>
            <li><strong>Interview Preparation: </strong>Preparation for your visa interview so that you receive approval.</li>
            <li><strong>Follow-up Support: </strong>Follow-ups and counseling at regular intervals.</li>
        </ul>
        <p>Follow your dreams with our visa assistance as we take care of the paperwork and logistics. Let us be answerable for making your visa application procedure easy and convenient so that you have the optimum chance for success.</p>
        </div>
        
    `,
        9: `
        <div class="service-details-container">
        <p>Foreign students need post-landing services as they bring convenience in settling down in a foreign country. We at WTS Visa Consultancy know that it can be difficult to settle in a new place and hence we provide full-cycle post-landing services so your foreign country settlement is hassle-free and successful.</p>
        <p><strong>Our post-landing services include:</strong></p>
        <ul>
            <li><strong>Airport Pick-up: </strong>We offer you secure and comfortable airport transfers to your residence so that you can unwind from the beginning.</li>
            <li><strong>Accommodation Support: </strong>If you desire assistance in arranging short-term stays or reserving a long-term accommodation, we assist you in the process so that you get the best within your budget.</li>
            <li><strong>Bank and Financial Services: </strong>We assist you in opening your local bank account and putting your finances in the host country, ready to settle your expenses.</li>
            <li><strong>Orientation Assistance: </strong>We provide you with orientation orientation to familiarize you with your new environment, from transport to shopping and local norms.</li>
            <li><strong>Emergency Support: </strong>We have our experts available to assist you with any concern you may have, rendering you safe and secure.</li>
        </ul>
        <p>With the professional post-arrival support of WTS Visa Consultancy, you can concentrate on learning and development, while we take care of the paperwork, and your foreign country transfer is smooth and trouble-free.</p>
        </div>
       
    `,
        2: `
        <div class="service-details-container">
        <p>Visa consultancy is a crucial facility for any aspirant who is going to pursue studies or move abroad. Applying for a visa can be stressful, but if you consult us, visa application becomes simpler and quicker. We provide full-fledged visa consultancy at WTS Visa Consultancy so that you get all documentation and deadlines to fulfill, along with your international journey as seamless as possible.</p>
        <p>Our expert counselors give you customized counseling based on your requirement, either for an immigration visa or a student visa. We take you through step by step, from choosing the right type of visa, getting documents ready, and submitting them in the right way.</p>
        <p><strong>Our Visa Services include:</strong></p>
        <ul>
            <li><strong>Professional Visa Guidance: </strong>Customized advice on the proper visa for your purpose.</li>
            <li><strong>Document Assistance: </strong>Assistance in compilation and preparation of required documents.</li>
            <li><strong>Application Submission: </strong>Filling and submission of your application in time.</li>
            <li><strong>Interview Preparation: </strong>Preparation for your visa interview so that you receive approval.</li>
            <li><strong>Follow-up Support: </strong>Follow-ups and counseling at regular intervals.</li>
        </ul>
        <p>Follow your dreams with our visa assistance as we take care of the paperwork and logistics. Let us be answerable for making your visa application procedure easy and convenient so that you have the optimum chance for success.</p>
        </div>
       
    `,
        1: `
        <div class="service-details-container">
        <p>Looking for a professional counselor is a whole different world when you are lost, confused, or stranded. Here at WTS Visa Consultancy, we make our counselors listen to you, hear you out, and accompany you through your problems—education, career, migration, or personal challenges. We try to establish a safe, comfortable space where you can spread out your options and discover viable, empowering solutions.</p>
        <p><strong>Here’s what you can expect from a session with our expert counselors:</strong></p>
        <ul>
            <li><strong>Personalized Care: </strong>Each student or person has different worries and goals. We provide individualized counseling up to the extent your case is concerned.</li>
            <li><strong>Objective-Oriented Dialogue: </strong>Choosing a career or making plans for higher education, we assist you in framing specific, achievable objectives.</li>
            <li><strong>Recent News: </strong>Receive current, accurate news regarding visas, schools, employment trends, etc.</li>
            <li><strong>Emotional Support: </strong>Overseas travel or having those life-changing decisions made may be daunting—here to be here for your mind each step of the way.</li>
            <li><strong>Confidential & Professional: </strong>Your confidentiality is top priority, and all communication is done on the highest level of professionalism.</li>
        </ul>
        <p>Wherever you are in your journey, an appointment with a licensed counselor can enlighten, banish fear, and assist you in making educated choices with confidence. Make your appointment today and proceed with direction. Proper direction is everything—let us begin taking that initial step today.</p>
        </div>
       
    `,
    };

    let activeCard = null;
    let closeTimeout = null; // store timeout ID

    cards.forEach((card, i) => {
        card.addEventListener("click", () => {
            // If modal is closing, cancel that closing action
            if (closeTimeout) {
                clearTimeout(closeTimeout);
                closeTimeout = null;
            }

            activeCard = card;

            // Fill content
            titleBox.textContent = card.innerText;
            textBox.innerHTML =
                details[i + 1] || "More details about this service.";

            // Get card position & size
            const rect = card.getBoundingClientRect();
            const modalStyle = modal.style;

            // Reset instantly
            modalStyle.transition = "none";
            modalStyle.transform = "translate(-50%, -50%) scale(1)";
            modalStyle.opacity = "1";
            modalStyle.visibility = "visible";

            // Start position = card
            modalStyle.top = `${rect.top + rect.height / 2}px`;
            modalStyle.left = `${rect.left + rect.width / 2}px`;
            modalStyle.width = `${rect.width}px`;
            modalStyle.height = `${rect.height}px`;
            modalStyle.borderRadius = "20px";

            overlay.classList.add("active");
            modal.classList.add("active");
            document.body.style.overflow = "hidden";

            // Animate to center
            requestAnimationFrame(() => {
                modalStyle.transition =
                    "all 0.7s cubic-bezier(0.68, -0.55, 0.265, 1.55)";
                modalStyle.top = `50%`;
                modalStyle.left = `50%`;
                modalStyle.width = `80%`;
                modalStyle.height = `80%`;
                modalStyle.borderRadius = "20px";
            });
        });
    });

    function closeModal() {
        if (!activeCard) return;

        const rect = activeCard.getBoundingClientRect();
        const modalStyle = modal.style;

        // Animate back to card
        modalStyle.transition = "all 0.7s ease-in-out";
        modalStyle.top = `${rect.top + rect.height / 2}px`;
        modalStyle.left = `${rect.left + rect.width / 2}px`;
        modalStyle.width = `${rect.width}px`;
        modalStyle.height = `${rect.height}px`;
        modalStyle.borderRadius = "20px";

        overlay.classList.remove("active");

        // Use timeout to finish animation — store it to cancel if reopening quickly
        closeTimeout = setTimeout(() => {
            modal.classList.remove("active");
            modalStyle.opacity = "0";
            modalStyle.visibility = "hidden";
            modalStyle.transition = "none";
            document.body.style.overflow = "";
            activeCard = null;
            closeTimeout = null; // clear reference
        }, 700);
    }

    closeBtn.addEventListener("click", closeModal);
    overlay.addEventListener("click", closeModal);
});

// Servcies SEction JS Ended

// CTA Section JS Started
document.addEventListener("DOMContentLoaded", function () {
    const ctaSections = document.querySelectorAll(".new-cta-section");

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const content =
                        entry.target.querySelector(".new-cta-content");
                    const image = entry.target.querySelector(
                        ".new-cta-image-wrapper"
                    );

                    if (content) content.classList.add("visible");
                    if (image) image.classList.add("visible");

                    // Optional: animate children with delay
                    if (content) {
                        const children = content.children;
                        for (let i = 0; i < children.length; i++) {
                            children[i].style.transitionDelay = `${i * 0.2}s`;
                        }
                    }
                } else {
                    const content =
                        entry.target.querySelector(".new-cta-content");
                    const image = entry.target.querySelector(
                        ".new-cta-image-wrapper"
                    );
                    if (content) content.classList.remove("visible");
                    if (image) image.classList.remove("visible");
                }
            });
        },
        { threshold: 0.2 }
    );

    ctaSections.forEach((section) => observer.observe(section));
});
// CTA Section JS Ended
