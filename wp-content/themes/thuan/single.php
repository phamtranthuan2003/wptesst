<?php get_header(); ?>

<main id="site-content" role="main">
    <div class="single-container">

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <!-- Primary Category -->
            <div class="post-meta">
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
                    $categories = get_the_category();
                    if (!empty($categories)) {
                        $primary_category = $categories[0];
                    }
                }

                if ($primary_category) {
                    echo '<a href="' . esc_url(get_category_link($primary_category->term_id)) . '" class="category-link">';
                    echo esc_html($primary_category->name);
                    echo '</a>';
                }
                ?>
            </div>

            <!-- Tiêu đề -->
            <h1 class="post-title"><?php the_title(); ?></h1>

            <!-- Ngày đăng -->
            <div class="post-date">
                <?php echo get_the_date('d/m/Y'); ?>
            </div>

            <!-- Nội dung bài viết -->
            <div class="post-content">
                <?php the_content(); ?>
            </div>

        <?php endwhile; endif; ?>

    </div>
</main>

<?php get_footer(); ?>
