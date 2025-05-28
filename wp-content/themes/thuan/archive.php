<?php get_header(); ?>
<div class = "content">
    <div id = "main-content">
        <div class = "archive-title">
            <?php 
                if(is_tag()) :
                    printf(__('Post tagged: %1$s', 'thuan'), single_tag_title('', false));
                elseif(is_category()) :
                    printf(__('Category: %1$s', 'thuan'), single_cat_title('', false));
                elseif(is_day()) :
                    printf(__('Daily Archives: %1$s', 'thuan'), get_the_time('l, F j, Y' )  );
                elseif(is_month()) :
                    printf(__('Monthly Archives: %1$s', 'thuan'), get_the_time('F Y ')  );
                elseif(is_year()) :
                    printf(__('Yearly Archives: %1$s', 'thuan'), get_the_time('Y' )  );
                endif;
            ?>
        </div>
        <?php if(is_tag() || is_category()): ?>
            <div class = "archive-description">
                <?php 
                    if (is_tag()) {
                        echo tag_description();
                    } elseif (is_category()) {
                        echo category_description();
                    }
                ?>
            </div>
        <?php endif; ?>
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

            <?php get_template_part('content', get_post_format()); ?>
            
        <?php endwhile; ?> 
            <?php thuan_pagination(); ?>
        <?php else : ?>
            <?php get_template_part('content', 'none'); ?>
        <?php endif; ?>
    </div>
    <div id = "sidebar">
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>