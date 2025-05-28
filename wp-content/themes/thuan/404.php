<?php get_header(); ?>
<div class = "content">
    <div id = "main-content">
        <?php 
            echo '<h1>' . __('404 Not Found', 'thuan') . '</h1>';
            get_search_form();
            _e('<h3> Categories: </h3>', 'thuan');
            echo '<div class="404-categories">';
                wp_list_categories(array('title_li' => ''));
            echo '</div>';

            _e('Tag Cloud:', 'thuan');
            wp_tag_cloud();
        ?>
        <div id = "sidebar">
            <?php get_sidebar(); ?>
        </div>
    </div>
<?php get_footer(); ?>