<div class="slider">
    <img src="<?php echo get_template_directory_uri(); ?>/images/1.jpg" class="slide active" alt="Slide 1">
    <img src="<?php echo get_template_directory_uri(); ?>/images/2.png" class="slide" alt="Slide 2">
    <img src="<?php echo get_template_directory_uri(); ?>/images/3.jpg" class="slide" alt="Slide 3">
    <img src="<?php echo get_template_directory_uri(); ?>/images/4.jpg" class="slide" alt="Slide 4">
</div>

<style>
    .slider {
        position: absolute;
        width: 100%;
        height: 100%;
    }

    .slider img.slide {
        position: absolute;
        left: 0;
        width: 100%;
        object-fit: cover;
        opacity: 0;
        transition: opacity 1s ease-in-out;
        filter: brightness(0.9);
    }

    .slider img.slide.active {
        opacity: 1;
        z-index: 1;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const slides = document.querySelectorAll('.slider img.slide');
        let currentIndex = 0;
        const totalSlides = slides.length;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.toggle('active', i === index);
            });
        }

        function nextSlide() {
            currentIndex = (currentIndex + 1) % totalSlides;
            showSlide(currentIndex);
        }

        showSlide(currentIndex);
        setInterval(nextSlide, 4000);
    });
</script>
