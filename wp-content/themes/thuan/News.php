<?php
/* Template Name: News */
get_header();
?>

<main id="site-content" role="main">
    <div class="section-inner">

        <!-- ACF Content Section -->
        <div class="acf-content" style="display: flex; align-items: flex-start; gap: 20px; margin-bottom: 40px;">
            <div class="acf-text" style="flex: 1;">
                <?php
                // Lấy và hiển thị trường ACF content_event
                if (get_field('content_event')):
                    echo wp_kses_post(get_field('content_event'));
                endif;
                ?>
            </div>

            <?php
            $image = get_field('image_event');
            if ($image): ?>
                <div class="acf-image" style="flex: 1; text-align: right;">
                    <?php echo wp_get_attachment_image($image, 'full'); ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Category Filter -->
        <?php
        // Lấy danh sách category (ẩn category rỗng)
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


        <br><br>

        <!-- Post List -->
        <div class="post-list" style="display: flex; flex-wrap: wrap; gap: 20px;">
            <?php
            // Xử lý phân trang chuẩn WordPress
            $paged = max(1, get_query_var('paged'));

            $args = [
                'post_type' => 'post',
                'posts_per_page' => 11,
                'paged' => $paged,
            ];

            if ($current_cat_id) {
                $args['cat'] = $current_cat_id;  // Dùng 'cat' để lọc theo category ID
            }

            $query = new WP_Query($args);

            if ($query->have_posts()):
                $post_count = 0;

                while ($query->have_posts()): $query->the_post();
                    $post_count++;

                    $style = ($post_count <= 2) ? 'flex: 0 0 48%;' : 'flex: 0 0 31%;';
                    $img_style = 'width: 100%; height: auto; border-radius: 10px;';
            ?>
                    <article class="post-item" style="margin-bottom: 30px; <?php echo esc_attr($style); ?>">
                        <?php if (has_post_thumbnail()): ?>
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                <?php the_post_thumbnail('medium', ['style' => $img_style, 'alt' => get_the_title()]); ?>
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
                                echo '<a href="' . esc_url(get_category_link($primary_category->term_id)) . '">';
                                echo esc_html($primary_category->name);
                                echo '</a>';
                            }
                            ?>
                            <span class="post-date"><?php echo esc_html(get_the_date('d/m/Y')); ?></span>
                        </div>

                        <h2 class="post-title">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                        </h2>
                    </article>
                <?php
                endwhile;
                ?>
        </div>

        <!-- Pagination -->
        <div class="pagination" style="margin-top: 40px; text-align: center;">
            <?php
                echo paginate_links([
                    'total' => $query->max_num_pages,
                    'current' => $paged,
                    'prev_text' => __('« Prev'),
                    'next_text' => __('Next »'),
                ]);
            ?>
        </div>
    <?php
            else: ?>
        <p><?php esc_html_e('No posts found', 'textdomain'); ?></p>
    <?php endif;

    wp_reset_postdata(); // Reset sau query custom
    ?>
    </div>
</main>

<?php get_footer(); ?>

<style>
    

</style>
