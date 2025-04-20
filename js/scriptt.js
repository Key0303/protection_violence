document.addEventListener('DOMContentLoaded', () => {
    const visitorLink = document.getElementById('visitorLink');
    const loginOverlay = document.getElementById('loginOverlay');
    const loginLink = document.getElementById('loginLink');

    visitorLink.addEventListener('click', () => {
        loginOverlay.style.display = 'none';
    });

    loginLink.addEventListener('click', () => {
        loginOverlay.style.display = 'flex';
    });

    // Slideshow functionality
    let slideIndex = 0;
    showSlides();

    function showSlides() {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        let dots = document.getElementsByClassName("dot");
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > slides.length) {slideIndex = 1}
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex-1].style.display = "block";
        dots[slideIndex-1].className += " active";
        setTimeout(showSlides, 2000); // Change image every 2 seconds
    }

    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    document.querySelector('.prev').addEventListener('click', () => {
        plusSlides(-1);
    });

    document.querySelector('.next').add