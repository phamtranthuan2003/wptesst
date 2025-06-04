<?php
/*
Template Name: Contact
*/
get_header();
?>
<div class="header-background" style="background-image: url('<?php the_field('background_image'); ?>');"></div>
<!-- Content below header -->
<div class="contact-wrapper">
    <div class="content">
        <div class="content-inner">
            <h1 class="acf-page-title"><?php the_field('title'); ?></h1>

            <div id="main-content">
                <div class="form-container">
                    <?php echo do_shortcode('[contact-form-7 id="8edf1dc" title="Contact form 1"]'); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>

<style>
    .contact-wrapper {
        width: 100%;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        padding-top: 60px;
        position: relative;
        z-index: 3;
        background-color: #fff;
        opacity: 0;
        transform: translateY(100px);
        transition: all 0.6s ease-out;
    }

    .contact-wrapper.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .content {
        width: 100%;
    }

    .content-inner {
        width: 85%;
        margin: 0 auto;
        gap: 30px;
        flex-wrap: wrap;
    }

    #main-content {
        flex: 1 1 65%;
    }

    #sidebar {
        flex: 1 1 30%;
    }

    h1.acf-page-title {
        text-align: center;
        font-size: 48px;
        font-weight: 900;
        font-family: "Raleway", sans-serif;
        margin-bottom: 40px;
    }

    .p {
        color: #2A2A2A !important;
        font-family: "Poppins", sans-serif;
        font-size: 18px !important;
        font-style: normal;
        font-weight: 400;
        line-height: 170%;
        overflow-x: hidden;
        outline-style: none;
        -webkit-touch-callout: none;
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        padding: 78px 0px 56px;
    }

    /* Form styles */
    .form-container {
        max-width: 100%;
    }

    .wpcf7-form label {
        color: #3D3D3D;
        font-size: 16px;
        font-style: normal;
        font-weight: 600;
        line-height: 140%;
        letter-spacing: 0.48px;
        margin-bottom: 9px;
        display: inline-block;
        vertical-align: top;
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
        width: 625px;
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
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: 0.3s;
        min-height: 52px;
        min-width: 126px;
        display: inline-flex;
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

    /* Responsive */
    @media (max-width: 768px) {
        .content-inner {
            flex-direction: column;
            width: 95%;
        }

        #main-content,
        #sidebar {
            flex: 1 1 100%;
        }

        h1.acf-page-title {
            font-size: 32px;
        }
    }

    h4 {
        font-weight: 900;
        font-size: 48px;
        line-height: 120%;
        text-transform: capitalize;
        margin-bottom: 13px;
    }

    p {
        color: #2A2A2A;
        font-family: "Poppins", sans-serif;
        font-size: 19px;
        font-style: normal;
        font-weight: 400;
        overflow-x: hidden;
        outline-style: none;
        -webkit-touch-callout: none;
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
    }

    a {
        color: inherit;
        text-decoration: none;
        font-size: inherit;
        line-height: inherit;
        transition-duration: .3s;
    }

    a:hover {
        color: #57D575;
    }

    .site-header {
        position: relative;
        width: 100%;
        height: 100vh;
        overflow: hidden;
    }

    .header-background {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
        z-index: -1;
        transition: opacity 0.3s ease-in-out;
    }

    .contact-wrapper {
        position: relative;
        background: #fff;
        padding-top: 80px;
        border-top-left-radius: 40px;
        border-top-right-radius: 40px;
        margin-top: -40px;
        z-index: 1;
        opacity: 0;
        transform: translateY(100px);
        transition: all 0.6s ease-out;
    }

    .contact-wrapper.visible {
        opacity: 1;
        transform: translateY(0);
    }

    @media only screen and (max-width: 768px) {
        .news-container {
            width: 95%;
            padding-bottom: 40px;
            margin-top: 40px;
        }

        .acf-content {
            flex-direction: column;
            align-items: flex-start;
            gap: 20px;
        }

        .acf-text {
            width: 100% !important;
            height: auto !important;
        }

        .acf-image-img {
            width: 100% !important;
            height: auto !important;
            margin-left: 0;
            margin-top: 0;
        }

        .category-filter {
            flex-wrap: wrap;
            justify-content: flex-start;
            gap: 12px;
            margin-bottom: 24px;
        }

        .category-filter a {
            font-size: 14px;
            padding: 8px 16px;
            height: auto;
            width: auto;
            border-radius: 30px;
        }

        .post-list {
            flex-direction: column;
            gap: 20px;
        }

        .post-item {
            flex: 1 1 100% !important;
            margin-bottom: 20px;
        }

        .post-item img {
            width: 100% !important;
            height: auto !important;
            border-radius: 12px;
        }

        .post-categories {
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
            font-size: 14px;
        }

        .post-category-badge {
            font-size: 12px;
            padding: 6px 12px;
            width: auto;
            height: auto;
        }

        .post-date {
            font-size: 14px;
            width: auto;
        }

        h1 {
            font-size: 32px;
            width: 100%;
            line-height: 1.2;
        }

        h2.post-title {
            font-size: 20px;
            padding-left: 0;
        }

        h5 {
            font-size: 16px;
            width: 100%;
        }

        .pagination-wrapper {
            margin-top: 20px;
        }

        .pagination {
            gap: 16px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .pagination a,
        .pagination span {
            font-size: 16px;
            height: auto;
        }

        .pagination .page-numbers.prev,
        .pagination .page-numbers.next {
            width: 40px;
            height: 40px;
            font-size: 14px;
        }

        .main-menu ul li a {
            font-size: 16px;
            width: auto;
            height: auto;
        }
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
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