<?php
/* Template Name: News */
get_header();
?>

<main id="site-content" role="main">
<div class="news-container">
    <div class="section-inner">
        <!-- ACF Content -->
        <div class="acf-content">
            <div class="acf-text" style="flex: 1;">
                <?php if (get_field('content_event')): ?>
                    <?php echo wp_kses_post(get_field('content_event')); ?>
                <?php endif; ?>
            </div>

            <?php
            $image = get_field('image_event');
            if ($image): ?>
                <div class="acf-image">
                    <?php echo wp_get_attachment_image($image, 'full', false, [
                        'class' => 'acf-image-img'
                    ]); ?>
                </div>


            <?php endif; ?>
        </div>

        <!-- Category Filter -->
        <?php
        $categories = get_categories(['hide_empty' => true]);
        $current_cat_id = isset($_GET['category']) ? intval($_GET['category']) : 0;

        if (!empty($categories)): ?>
            <div class="category-filter">
                <a href="<?php echo esc_url(get_permalink(get_the_ID())); ?>" class="<?php echo (!$current_cat_id) ? 'active' : ''; ?>">All</a>
                <?php foreach ($categories as $category): ?>
                    <a href="<?php echo esc_url(add_query_arg('category', $category->term_id, get_permalink(get_the_ID()))); ?>"
                       class="<?php echo ($current_cat_id === $category->term_id) ? 'active' : ''; ?>">
                        <?php echo esc_html($category->name); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Sticky Posts Section -->
        <div class="post-list" style="display: flex; flex-wrap: wrap; gap: 20px;">
            <?php
            $sticky_ids = array_slice(get_option('sticky_posts'), 0, 2);

            if (!empty($sticky_ids)) :
                $sticky_args = [
                    'post__in' => $sticky_ids,
                    'ignore_sticky_posts' => 1,
                    'posts_per_page' => 2,
                    'orderby' => 'post__in'
                ];

                $sticky_query = new WP_Query($sticky_args);

                if ($sticky_query->have_posts()):
                    while ($sticky_query->have_posts()): $sticky_query->the_post(); ?>
                        <article class="post-item" style="flex: 0 0 48%; margin-bottom: 30px;">
                            <?php if (has_post_thumbnail()): ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('full', ['style' => 'width: 574px; height: 403.88px; border-radius: 0;']); ?>
                                </a>
                            <?php endif; ?>

                            <div class="post-categories" style="margin-top: 5px; font-size: 14px; color: #666;">
                                <?php
                                $primary_category = null;
                                if (class_exists('WPSEO_Primary_Term')) {
                                    $primary_term = new WPSEO_Primary_Term('category', get_the_ID());
                                    $primary_term_id = $primary_term->get_primary_term();
                                    if (is_numeric($primary_term_id)) {
                                        $primary_category = get_term($primary_term_id);
                                    }
                                }
                                if (!$primary_category) {
                                    $categories_post = get_the_category();
                                    if (!empty($categories_post)) {
                                        $primary_category = $categories_post[0];
                                    }
                                }
                                if ($primary_category) {
                                    echo '<a class="post-category-badge" href="' . esc_url(get_category_link($primary_category->term_id)) . '">';

                                    echo esc_html($primary_category->name);
                                    echo '</a>';
                                }
                                ?>
                               <span class="post-date"><?php echo esc_html(get_the_date('F j, Y')); ?></span>
                            </div>

                            <h2 class="post-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <?php
                            $excerpt = get_the_excerpt();
                            if (!empty($excerpt)) : ?>
                                <div class="post-excerpt">
                                    <?php echo wp_trim_words($excerpt, 25, '...'); ?>
                                </div>
                            <?php endif; ?>

                        </article>
                    <?php endwhile;
                    wp_reset_postdata();
                endif;
            endif;
            ?>
        </div>

        <!-- Normal Posts Section -->
        <div class="post-list" style="display: flex; flex-wrap: wrap; gap: 20px;">
            <?php
            $paged = max(1, get_query_var('paged'));
            $args = [
                'post_type' => 'post',
                'posts_per_page' => 6,
                'paged' => $paged,
                'ignore_sticky_posts' => 1,
                'post__not_in' => $sticky_ids,
            ];

            if ($current_cat_id) {
                $args['cat'] = $current_cat_id;
            }

            $query = new WP_Query($args);

            if ($query->have_posts()):
                $post_count = 0;

                while ($query->have_posts()): $query->the_post();
                    $post_count++;
                    $style = 'flex: 0 0 31%;';
            ?>
                    <article class="post-item" style="margin-bottom: 30px; <?php echo esc_attr($style); ?>">
                        <?php if (has_post_thumbnail()): ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium', ['style' => 'width: 394px; height: 277.23px; border-radius: 12px;']); ?>
                            </a>
                        <?php endif; ?>

                        <div class="post-categories" style="margin-top: 5px; font-size: 14px; color: #666;">
                            <?php
                            $primary_category = null;
                            if (class_exists('WPSEO_Primary_Term')) {
                                $primary_term = new WPSEO_Primary_Term('category', get_the_ID());
                                $primary_term_id = $primary_term->get_primary_term();
                                if (is_numeric($primary_term_id)) {
                                    $primary_category = get_term($primary_term_id);
                                }
                            }

                            if (!$primary_category) {
                                $categories_post = get_the_category();
                                if (!empty($categories_post)) {
                                    $primary_category = $categories_post[0];
                                }
                            }

                            if ($primary_category) {
                                echo '<a class="post-category-badge" href="' . esc_url(get_category_link($primary_category->term_id)) . '">';
                                echo esc_html($primary_category->name);
                                echo '</a>';
                            }
                            ?>
                            <span class="post-date"><?php echo esc_html(get_the_date('F j, Y')); ?></span>
                        </div>

                        <h2 class="post-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                        <?php
                        $excerpt = get_the_excerpt();
                        if (!empty($excerpt)) : ?>
                            <div class="post-excerpt">
                                <?php echo wp_trim_words($excerpt, 25, '...'); ?>
                            </div>
                        <?php endif; ?>

                    </article>
            <?php endwhile; ?>
        </div>

        <div class="pagination-wrapper">
            <?php thuan_pagination($query); ?>
        </div>

        <?php
                wp_reset_postdata();
            else: ?>
                <p><?php esc_html_e('No posts found', 'textdomain'); ?></p>
        <?php endif; ?>

    </div>
</div>
</main>

<?php get_footer(); ?>
<style>
    .news-container {
    width: 85%;
    max-width: 1440px;
    margin: 0 auto;
    padding-bottom: 80px;
}
.acf-image-img {
    width: 418px;
    height: 406px;
    margin-top: 14px;
    margin-left: 58px;
}
.acf-content {
    display: flex;
    align-items: flex-start;
    gap: 20px;
    margin-bottom: 40px;
    flex-wrap: wrap;
}
.acf-text {
    width: 581px;
    height: 203px;
}

.category-filter {
    display: flex;
    gap: 20px;
    margin-bottom: 40px;
}

.category-filter a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 10px 24px;
    border: 1px solid #D9D9D9;
    border-radius: 30px;
    background-color: #FFFFFF;
    color: #000000;
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
    font-size: 16px;
    text-decoration: none;
    transition: all 0.3s ease;
    Width: 120px;
    height: 52px;
    Radius: 53px;
    Top: 8px;
    Right:60px;
    Bottom: 8px;
    Left: 60px;
    gap: 16px
}

.category-filter a:hover {
    background-color: #57D575;
    border-color: #57D575;
    color: #000;
    Width: 120px;
    height: 52px;
    Radius: 53px;
    Top: 8px;
    Right:60px;
    Bottom: 8px;
    Left: 60px;
    gap: 16px
}

.category-filter a.active {
    background-color: #57D575;
    border-color: #57D575;
    color: #FFFFFF;
    Width: 120px;
    height: 52px;
    Radius: 53px;
    Top: 8px;
    Right:60px;
    Bottom: 8px;
    Left: 60px;
    gap: 16px
}
.pagination-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 40px;
    font-family: 'Poppins', sans-serif;
}

.pagination {
    display: flex;
    align-items: center;
    gap: 60px;
}

.pagination a,
.pagination span {
    width: 7px;
    height: 26px;
    font-family: 'Poppins', sans-serif;
    line-height: 130%;
    letter-spacing: normal;
    font-size: 20px;
    font-weight: 400;
    color: #ADADAD;
    text-decoration: none;
    transition: all 0.3s ease;
}


.pagination a:hover {
    color: #000;
}

.pagination .current {
    font-weight: 700;
    color: #000;
}

.pagination .page-numbers.prev,
.pagination .page-numbers.next {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 54px;
    height: 54px;
    border: 1px solid #000;
    border-radius: 30px;
    color: #ADADAD;
    font-size: 18px;
    transition: all 0.3s ease;
}

.pagination .page-numbers.prev:hover,
.pagination .page-numbers.next:hover {
    background-color: #f2f2f2;
}
.post-excerpt {
    margin-top: 8px;
    font-size: 14px;
    color: #666;
    line-height: 1.5;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
}
.post-title a {
    text-decoration: none;
    color: inherit;
}
.post-category-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 0px;
    height: 25px;
    gap: 16px;
    border-radius: 53px;
    padding: 8px 60px;
    border: 1px solid #4D4D4D;
    background-color: transparent;
    color: #000;
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
    font-size: 14px;
    text-decoration: none;
    transition: all 0.3s ease;
}

.post-category-badge:hover {
    background-color: #57D575;
    border-color: #57D575;
    color: #FFF;
    gap: 16px;
}
.post-date {
    display: inline-block;
    width: 150px;
    height: 21px;
    font-family: 'Poppins', sans-serif;
    font-weight: 400;
    font-size: 16px;
    line-height: 130%;
    letter-spacing: 0;
    text-transform: capitalize;
    color: #666;
}
.post-categories {
    display: flex;
    align-items: center;
    margin-top: 5px;
    font-size: 14px;
    color: #666;
    gap: 16px;
}

</style>