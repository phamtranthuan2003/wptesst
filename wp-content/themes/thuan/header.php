<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php if (is_front_page()) : ?>
    <div class="slider-wrapper">
        <?php get_template_part('slider'); ?>
        <header class="overlay-header">
            <div class="header-container">
                <div class="logo">
                    <a href="<?php echo esc_url(home_url('/')); ?>">
                        <?php
                        if (has_custom_logo()) {
                            the_custom_logo();
                        } else {
                            echo '<h1>' . esc_html(get_bloginfo('name')) . '</h1>';
                        }
                        ?>
                    </a>
                </div>
                <nav class="main-menu" aria-label="Primary Menu">
                    <?php
                    if (function_exists('thuan_menu')) {
                        thuan_menu('primary-menu');
                    } else {
                        wp_nav_menu([
                            'theme_location' => 'primary-menu',
                            'container' => false
                        ]);
                    }
                    ?>
                </nav>
            </div>
        </header>
</div>
<?php else : ?>
    <div class="slider-wrapper">               
        <header class="site-header">
        <div class="header-container">
            <div class="logo">
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <?php
                    if (has_custom_logo()) {
                        the_custom_logo();
                    } else {
                        echo '<h1>' . esc_html(get_bloginfo('name')) . '</h1>';
                    }
                    ?>
                </a>
            </div>
            <nav class="main-menu" aria-label="Primary Menu">
                <?php
                if (function_exists('thuan_menu')) {
                    thuan_menu('primary-menu');
                } else {
                    wp_nav_menu([
                        'theme_location' => 'primary-menu',
                        'container' => false
                    ]);
                }
                ?>
            </nav>
        </div>
        </header>
    </div>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
<style>
.slider-wrapper {
    width: 85%;
    max-width: 1440px;
    margin: 0 auto;
}
.header-container {
    Width: 1224px;
    height: 116px;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: relative;
}
.logo {
    width: 214px;
    height: 65px;
}

.main-menu ul {
    display: flex;
    gap: 40px;
    list-style: none;
    margin: 0;
    padding: 0;
}

.main-menu ul li a {
    display: inline-block;
    width: 66px;
    height: 36px;
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
    font-size: 18px;
    line-height: 198%;
    letter-spacing: 0;
    color: #000000;
    text-decoration: none;
}


.main-menu ul li a:hover,
main-menu ul li.current-menu-item a,
.main-menu ul li.current_page_item a,
.main-menu ul li.current-menu-ancestor a,
.main-menu ul li.current_page_parent a {
    color: #57D575;
    text-decoration: none;
}
.logo img.custom-logo {
    width: 214px;
    height: 65px;
}
</style>