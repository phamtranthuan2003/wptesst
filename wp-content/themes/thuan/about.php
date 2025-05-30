<?php
/*
Template Name: about
*/
?>
<?php get_header(); ?>

<?php
$image_fields = ['img1', 'img2', 'img3', 'img4'];

$images = [];
foreach ($image_fields as $field_name) {
    $image = get_field($field_name);
    if ($image) {
        if (is_array($image) && isset($image['ID'])) {
            $images[] = $image;
        } elseif (is_numeric($image)) {
            $images[] = ['ID' => $image];
        }
    }
}
?>

<?php if ($images): ?>
<div class="slider-container">
    <?php foreach ($images as $image): ?>
        <div class="slide">
            <?php echo wp_get_attachment_image($image['ID'], 'full'); ?>
        </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<?php get_footer(); ?>

<style>
.slider-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    overflow: hidden;
    z-index: 1;
}

.slider-container .slide {
    position: absolute;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    opacity: 0;
    transition: opacity 1s ease-in-out;
    z-index: 1;
}

.slider-container .slide.active {
    opacity: 1;
    z-index: 2;
}

.slider-container .slide img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.slider-container .slide');
    let currentIndex = 0;

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.toggle('active', i === index);
        });
    }

    showSlide(currentIndex);

    setInterval(() => {
        currentIndex = (currentIndex + 1) % slides.length;
        showSlide(currentIndex);
    }, 4000);
});
</script>
