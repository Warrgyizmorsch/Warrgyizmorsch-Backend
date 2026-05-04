function toggleMenu() {
    const overlay = document.querySelector('.hamburger-overlay');
    overlay.classList.toggle('active');

    // Prevent scrolling when menu is open
    if (overlay.classList.contains('active')) {
        document.body.style.overflow = 'hidden';
    } else {
        document.body.style.overflow = '';
    }
}

document.addEventListener('scroll', () => {
    if (window.scrollY > 50) {
        (document.querySelector('.navbar')).classList.add('show'); // Slide down
    } else {
        (document.querySelector('.navbar')).classList.remove('show'); // Slide up
    }
});

const backToTopButton = document.getElementById('backToTop');

    // Show the button when scrolled down 300px
     window.addEventListener('scroll', () => {
        if (window.scrollY > 300) {
            backToTopButton.classList.add('show');
        } else {
            backToTopButton.classList.remove('show');
        }
    });

    // Scroll to top when clicked
    backToTopButton.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });


    