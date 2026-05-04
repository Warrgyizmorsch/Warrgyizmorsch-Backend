<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Toggle Hamburger Menu
        function toggleMenu() {
            const overlay = document.querySelector('.hamburger-overlay');
            overlay.classList.toggle('active');

            document.body.style.overflow = overlay.classList.contains('active') ? 'hidden' : '';
        }

        // Navbar Scroll Effect
        document.addEventListener('scroll', () => {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('show'); // Slide down
            } else {
                navbar.classList.remove('show'); // Slide up
            }
        });

        // Back to Top Button
        const backToTopButton = document.getElementById('backToTop');
        window.addEventListener('scroll', () => {
            backToTopButton.classList.toggle('show', window.scrollY > 300);
        });

        backToTopButton.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    });
</script>