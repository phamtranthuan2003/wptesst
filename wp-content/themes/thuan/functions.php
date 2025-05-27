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
if ( !isset($content_width) ) {
    $content_width = 620;
}
/**
 @ Khai bao chuc nang cua theme
**/
if ( !function_exists('thuan_theme_setup') ) {
    function thuan_theme_setup() {
      /* thiết lập textdomain cho theme */
        $languages = THEME_URL . '/languages';
      load_theme_textdomain('thuan', $languages);
      /* Tự động thêm link RSS <head> */
        add_theme_support('automatic-feed-links');
      /* Thêm post thumbnail */
        add_theme_support('post-thumbnails');
        /* Post Format */
        add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'));  
        /* Thêm title-tag */
        add_theme_support('title-tag');
        /* Thêm custom background */
        add_theme_support('custom-background', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        ));
        /* Thêm menu */
        register_nav_menus(array(
            'primary' => __('primary-menu', 'thuan'),
            'footer' => __('footer-menu', 'thuan'),
        ));
        /* Thêm sidebar */
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
    add_action('init' , 'thuan_theme_setup');
}   

/*----------------------
Template functions
-----------------------*/

if ( !function_exists('thuan_header') ) { 
    function thuan_header() {
        ?>
        <div class = "site-name">
            <?php 
            if (is_home()) {
                printf('<h1><a href="%1$s" title="%2$s">%3$s</a></h1>',
                    get_bloginfo('url'),
                    get_bloginfo('description'),
                    get_bloginfo('name')
                );
            } else {
                printf('<p><a href="%1$s" title="%2$s">%3$s</a></p>',
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
if ( !function_exists('thuan_menu') ) {
    function thuan_menu($menu) {
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
if ( !function_exists('thuan_pagination') ) {
    function thuan_pagination() {
        if ($GLOBALS['wp_query']->max_num_pages <= 1) {
            return;
        } ?>
        
        <nav class="pagination" role="navigation">
            <?php if (get_next_posts_link()) : ?>
                <div class="nav-previous">
                    <?php next_posts_link(__('« Prev', 'thuan')); ?>
                </div>
            <?php endif; ?>

            <?php if (get_previous_posts_link()) : ?>
                <div class="nav-next">
                    <?php previous_posts_link(__('Next » ;', 'thuan')); ?>
                </div>
            <?php endif; ?>
        </nav>
    <?php }
}
/**
 @ Thiết lập ảnh đại diện
 */
if ( !function_exists('thuan_thumbnail') ) {
    function thuan_thumbnail() {
        if ( has_post_thumbnail() ) {
            the_post_thumbnail('thumbnail', array('class' => 'post-thumbnail'));
        } else {
            echo '<img src="' . get_template_directory_uri() . '/images/default-thumbnail.jpg" alt="' . get_the_title() . '" class="post-thumbnail" />';
        }
    }
}
/**
 @ Thiết lập tiêu đề bài viết
 */ 
if ( !function_exists('thuan_entry_header') ) {
    function thuan_entry_header() {
        if ( is_single() ) {
            the_title('<h1 class="entry-title">', '</h1>');
        } else {
            the_title('<h2 class="entry-title"><a href="' . get_permalink() . '" rel="bookmark">', '</a></h2>');
        }
        echo '<div class="entry-meta">';
        echo '<span class="posted-on">' . get_the_date() . '</span>';
        echo '<span class="byline"> ' . __('by', 'thuan') . ' ' . get_the_author() . '</span>';
        echo '</div>';
    }
}