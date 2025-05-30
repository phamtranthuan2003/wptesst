<?php get_header(); ?>

<main id="site-content" role="main">
    <div class="single-container">

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                <div class="outer-box">
                    <div class="inner-box">
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

                        <h1 class="post-title"><?php the_title(); ?></h1>

                        <div class="post-date"><?php echo get_the_date('d/m/Y'); ?></div>
                    </div>
                </div>

                <div class="fullwidth-content">
                    <div class="inner-content">
                        <?php the_content(); ?>

                        <?php
                        wp_link_pages([
                            'before' => '<nav class="page-links">',
                            'after' => '</nav>',
                            'link_before' => '<span>',
                            'link_after' => '</span>',
                            'pagelink' => __('Page %'),
                        ]);
                        ?>

                        <?php
                        $appstore_link = get_post_meta(get_the_ID(), 'appstore_link', true);
                        $googleplay_link = get_post_meta(get_the_ID(), 'googleplay_link', true);
                        ?>
                        <?php if ($appstore_link || $googleplay_link): ?>
                            <div class="download-buttons">
                                <?php if ($appstore_link): ?>
                                    <a href="<?php echo esc_url($appstore_link); ?>" class="store-badge" target="_blank" rel="nofollow noopener">
                                        <img src="<?php echo get_template_directory_uri(); ?>/images/btn_apple_dl.png" alt="Download on the App Store">
                                    </a>
                                <?php endif; ?>

                                <?php if ($googleplay_link): ?>
                                    <a href="<?php echo esc_url($googleplay_link); ?>" class="store-badge" target="_blank" rel="nofollow noopener">
                                        <img src="<?php echo get_template_directory_uri(); ?>/images/btn_google_d.png" alt="Get it on Google Play">
                                    </a>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

        <?php endwhile;
        endif; ?>

    </div>
</main>

<?php get_footer(); ?>
<style>
    .outer-box {
        max-width: 1440px;
        margin: 100px auto 0;
        display: flex;
        justify-content: center;
        padding: 50px 0;
        border-radius: 36px;
    }

    .inner-box {
        width: 90%;
        max-width: 1220px;
        text-align: left;
        margin: 0 auto;
        margin-bottom: 40px;
    }

    .post-meta,
    .post-title,
    .post-date {
        text-align: center;

    }


    .category-link {
        display: inline-block;
        padding: 10px 40px;
        border: 1px solid #000;
        border-radius: 53px;
        text-decoration: none;
        color: #000;
        font-weight: 600;
        font-size: 18px;
    }

    .post-title {
        font-family: 'Raleway', sans-serif;
        font-weight: 900;
        font-size: 48px;
        line-height: 1.2;
        color: #2A2A2A;
        margin: 20px 0;
    }

    .post-date {
        font-family: 'Poppins', sans-serif;
        font-size: 20px;
        color: #2A2A2A;
    }

    .fullwidth-content {
        max-width: 1440px;
        margin: 80px auto;
        background-color: #f5f5f5;
        border-radius: 36px;
        padding: 60px 20px;
    }

    .inner-content {
        max-width: 1220px;
        margin: 0 auto;

    }


    .download-buttons {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-top: 40px;
    }

    .store-badge img {
        width: 180px;
        height: auto;
        display: block;
    }

    .inner-content h2,
    .inner-content ul,
    .inner-content ol {
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .inner-content img {
        display: block;
        margin: 40px auto;
        width: 1160px;
        height: 600px;
        object-fit: cover;
        border-radius: 12px;
    }

    .download-buttons img {
        width: 180px;
        height: auto;
        margin: 0;
        object-fit: contain;
        border-radius: 0;
    }
</style>