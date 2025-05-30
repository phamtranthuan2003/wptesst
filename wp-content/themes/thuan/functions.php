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
    // wp_register_style( 'reset-style', get_template_directory_uri() . '/reset.css', array(), '1.0', 'all' );
    // wp_enqueue_style( 'reset-style' );
    wp_register_style('main-style', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
    wp_enqueue_style('main-style');
}
add_action('wp_enqueue_scripts', 'thuan_styles');
add_theme_support('custom-logo');

add_theme_support('custom-header', array(
    'width'         => 1920,
    'height'        => 500,
    'flex-height'   => true,
    'flex-width'    => true,
    'header-text'   => false,
));

// Tạo Meta Box nhập link App Store & Google Play
function add_game_store_links_meta_box()
{
    add_meta_box(
        'game_store_links',
        'Game Store Links',
        'render_game_store_links_meta_box',
        'post',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'add_game_store_links_meta_box');

function render_game_store_links_meta_box($post) {
    wp_nonce_field('save_game_store_links', 'game_store_links_nonce');

    $appstore_link = get_post_meta($post->ID, 'appstore_link', true);
    $googleplay_link = get_post_meta($post->ID, 'googleplay_link', true);
    ?>
    <p>
        <label for="appstore_link"><strong>App Store URL:</strong></label><br>
        <input type="url" name="appstore_link" id="appstore_link" value="<?php echo esc_attr($appstore_link); ?>" style="width:100%;">
    </p>
    <p>
        <label for="googleplay_link"><strong>Google Play URL:</strong></label><br>
        <input type="url" name="googleplay_link" id="googleplay_link" value="<?php echo esc_attr($googleplay_link); ?>" style="width:100%;">
    </p>
    <?php
}

function save_game_store_links_meta_box($post_id) {
    if (!isset($_POST['game_store_links_nonce']) || !wp_verify_nonce($_POST['game_store_links_nonce'], 'save_game_store_links')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['appstore_link'])) {
        update_post_meta($post_id, 'appstore_link', esc_url_raw($_POST['appstore_link']));
    }

    if (isset($_POST['googleplay_link'])) {
        update_post_meta($post_id, 'googleplay_link', esc_url_raw($_POST['googleplay_link']));
    }
}

add_action('save_post', 'save_game_store_links_meta_box');
