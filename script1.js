document.addEventListener("DOMContentLoaded", function() {
    const slides = ['slide4','slide1', 'slide2', 'slide3'];
    let currentSlide = 0;

    function changeSlide() {
        document.body.className = slides[currentSlide];
        currentSlide = (currentSlide + 1) % slides.length;
    }

    document.body.classList.add('initial-slide'); // Ajoute la classe initiale

    setInterval(changeSlide, 5000);
});
