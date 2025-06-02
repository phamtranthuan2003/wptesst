<?php
/*
Template Name: Contact
*/
get_header();
$background = get_field('back_ground');
?>

<?php if ($background): ?>
    <div class="hero-banner fade-on-scroll" style="background-image: url('<?php echo esc_url($background['url']); ?>');">
        <div class="overlay"></div>
    </div>
<?php endif; ?>

<div class="contact-wrapper">
    <div class="content">
        <!-- Hiển thị tiêu đề tại đây -->
        <h1 class="acf-page-title"><?php the_field('title'); ?></h1>

        <div id="main-content">
            <div class="form-container">
                <?php echo do_shortcode('[contact-form-7 id="8edf1dc" title="Contact form 1"]'); ?>
            </div>
        </div>
        <div id="sidebar">
            <?php get_sidebar(); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>



<style>
   .hero-banner {
    height: 100vh;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    position: relative; /* không phải fixed */
}

    .contact-wrapper {
        width: 85%;
        margin: 0 auto;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        padding-top: 60px;
        position: relative;
        z-index: 3;
        background-color: #fff;
    }

    .contact-wrapper .company-info {
        font-size: 13px;
        margin-bottom: 20px;
        color: #333;
        line-height: 1.6;
    }

    .form-container {
        max-width: 600px;
    }

    .wpcf7-form label {
        display: block;
        font-weight: 600;
        margin: 16px 0 6px;
        font-size: 14px;
    }

    .wpcf7-form .required {
        color: red;
        margin-left: 3px;
    }

    .wpcf7-form input[type="text"],
    .wpcf7-form input[type="email"],
    .wpcf7-form textarea,
    .wpcf7-form select {
        border-radius: 8px;
        border: 1px solid #D5D4DC;
        background: #FFF;
        padding: 11px 12px;
        resize: none;
        color: #2A2A2A;
        font-family: "Lato", sans-serif;
        font-size: 16px;
        font-style: normal;
        font-weight: 400;
        line-height: 140%;
        letter-spacing: 0.48px;
        width: 100%;
        max-width: 639px;
        appearance: none;
        -webkit-appearance: none;
        outline: none;
    }

    .wpcf7-form textarea {
        min-height: 120px;
        resize: vertical;
    }

    .wpcf7-form input:focus,
    .wpcf7-form textarea:focus,
    .wpcf7-form select:focus {
        border-color: #000;
        outline: none;
    }

    .wpcf7-form input[type="submit"] {
        padding: 8.5px 30px;
        border-radius: 70px;
        background: #57D575;
        color: #2A2A2A;
        font-size: 18px;
        font-style: normal;
        font-weight: 600;
        line-height: 198.477%;
        text-decoration: none;
        border: 0;
        cursor: pointer;
        width: auto;
        display: inline-flex;
        position: relative;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.12, 0.77, 0.16, 0.93);
        min-height: 52px;
        min-width: 126px;
        justify-content: center;
    }

    .wpcf7-form input[type="submit"]:hover {
        color: #57D575;
        background-color: #F6F6F6;
    }

    .wpcf7-not-valid-tip {
        color: red;
        font-size: 13px;
        margin-top: 4px;
    }

    .required-star {
        color: red;
        margin-left: 4px;
    }
    .contact-wrapper {
    opacity: 0;
    transform: translateY(100px);
    transition: all 0.6s ease-out;
}

.contact-wrapper.visible {
    opacity: 1;
    transform: translateY(0);
}

</style>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const contactWrapper = document.querySelector('.contact-wrapper');

    function checkPosition() {
        const rect = contactWrapper.getBoundingClientRect();
        const windowHeight = window.innerHeight;

        if (rect.top <= windowHeight - 100) {
            contactWrapper.classList.add('visible');
        }
    }

    window.addEventListener('scroll', checkPosition);
    checkPosition();
});
</script>


