document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.getElementById('astronomy-materials-carousel');
    const slides = carousel.getElementsByClassName('slide');
    let currentSlide = 0;

    // Show first slide by default and mark it as active
    slides[0].classList.add('active');

    function showSlide(n) {
        // Reset all slides
        for (let i = 0; i < slides.length; i++) {
            slides[i].classList.remove('active');
        }

        // Wrap around if index is out of bounds
        if (n >= slides.length) {
            currentSlide = 0;
        }
        if (n < 0) {
            currentSlide = slides.length - 1;
        }

        // Show current slide
        slides[currentSlide].classList.add('active');
    }

    // Navigation functions
    window.plusSlides = function(n) {
        currentSlide += n;
        showSlide(currentSlide);
    }
});
