<?php

/**
@ Khai báo hằng giá trị
@THEME_URL = Lấy đường dẫn đến thư mục theme
@ CORE = Lấy đường dẫn đến thư mục core
 **/
define('THEME_URL', get_stylesheet_directory());
define('CORE', THEME_URL . '/core');
/**
 @ Nhung file /core/init.php
 **/
require_once(CORE . '/init.php');
/**
 @ Thiet lap chieu rong noi dung
 **/
if (!isset($content_width)) {
    $content_width = 620;
}
/**
 @ Khai bao chuc nang cua theme
 **/
if (!function_exists('thuan_theme_setup')) {
    function thuan_theme_setup()
    {
        $languages = THEME_URL . '/languages';
        load_theme_textdomain('thuan', $languages);
        add_theme_support('automatic-feed-links');
        add_theme_support('post-thumbnails');
        add_theme_support('post-formats', array('gallery', 'link', 'image', 'quote', 'video'));
        add_theme_support('title-tag');
        add_theme_support('custom-background', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        ));
        /* Thêm menu */
        register_nav_menus(array(
            'primary' => __('primary-menu', 'thuan'),
            'footer' => __('footer-menu', 'thuan'),
        ));
        $sidebar = register_sidebar(array(
            'name' => __('Primary Sidebar', 'thuan'),
            'id' => 'primary-sidebar',
            'description' => __('Default sidebar', 'thuan'),
            'class' => 'primary-sidebar',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        ));
        register_sidebar($sidebar);
    }
    add_action('init', 'thuan_theme_setup');
}

/*----------------------
Template functions
-----------------------*/

if (!function_exists('thuan_header')) {
    function thuan_header()
    {
?>
        <div class="site-name">
            <?php
            if (is_home()) {
                printf(
                    '<h1><a href="%1$s" title="%2$s">%3$s</a></h1>',
                    get_bloginfo('url'),
                    get_bloginfo('description'),
                    get_bloginfo('name')
                );
            } else {
                printf(
                    '<p><a href="%1$s" title="%2$s">%3$s</a></p>',
                    get_bloginfo('url'),
                    get_bloginfo('description'),
                    get_bloginfo('name')
                );
            }
            ?>
        </div>
    <?php
    }
}
/**
 @ Thiet lập menu
 */
if (!function_exists('thuan_menu')) {
    function thuan_menu($menu)
    {
        $menu = array(
            'theme_location' => $menu,
            'container' => 'nav',
            'container_class' => $menu
        );
        wp_nav_menu($menu);
    }
}
/**
 @ Thiết lập phân trang
 */
if (! function_exists('thuan_pagination')) {
    function thuan_pagination($query = null)
    {
        if (!$query) {
            global $wp_query;
            $query = $wp_query;
        }

        $total_pages = $query->max_num_pages;
        $current_page = max(1, get_query_var('paged'));

        if ($total_pages <= 1) return;

        echo '<nav class="pagination" role="navigation">';
        echo paginate_links([
            'total' => $total_pages,
            'current' => $current_page,
            'prev_text' => __('<'),
            'next_text' => __('>'),
        ]);
        echo '</nav>';
    }
}

/**
 @ Thiết lập ảnh đại diện
 */
if (!function_exists('thuan_thumbnail')) {
    function thuan_thumbnail()
    {
        if (has_post_thumbnail()) {
            the_post_thumbnail('thumbnail', array('class' => 'post-thumbnail'));
        } else {
            echo '<img src="' . get_template_directory_uri() . '/images/default-thumbnail.jpg" alt="' . get_the_title() . '" class="post-thumbnail" />';
        }
    }
}
/**
 @ Thiết lập tiêu đề bài viết
 */
if (!function_exists('thuan_entry_header')) {
    function thuan_entry_header()
    {
        echo '<div class="entry-meta">';
        if (get_post_type() === 'post') {
            echo '<span class="posted-in"> | ';
            the_category(', ');
            echo '</span>';
        }
        echo '<span class="posted-on">' . get_the_date() . '</span>';
        echo '</div>';
        if (is_single()) {
            the_title('<h1 class="entry-title">', '</h1>');
        } else {
            the_title('<h2 class="entry-title"><a href="' . get_permalink() . '" rel="bookmark">', '</a></h2>');
        }
    }
}
/**
 @ Thiết lập nội dung bài viết
 */
if (!function_exists('thuan_entry_content')) {
    function thuan_entry_content()
    {
        if (is_single()) {
            the_content();
        } else {
            the_excerpt();
        }
        echo '<div class="entry-footer">';
        echo '</div>';
    }
}
/**
 @ Nhúng css
 */
function thuan_styles()
{
    wp_register_style('main-style', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
    wp_enqueue_style('main-style');
}
add_action('wp_enqueue_scripts', 'thuan_styles');
add_theme_support('custom-header', array(
    'width'         => 1920,
    'height'        => 500,
    'flex-height'   => true,
    'flex-width'    => true,
    'header-text'   => false,
));
function my_theme_scripts() {
    wp_enqueue_style('aos-css', 'https://unpkg.com/aos@2.3.4/dist/aos.css');
    wp_enqueue_script('aos-js', 'https://unpkg.com/aos@2.3.4/dist/aos.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'my_theme_scripts');