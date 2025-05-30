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

                        <!-- TEXT CONTENT -->
                        <div class="post-text-content">
                            <?php the_content(); ?>
                        </div>

                        <!-- IMAGE CONTENT -->
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
                        $appstore_link = get_field('ios');
                        $googleplay_link = get_field('android');
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

                        <!-- SHARE -->
                        <div class="share-heading">
                            <div class="double-arrow-down"></div> <br>
                            <h2>Want to share this article?</h2>
                            <!-- AddToAny BEGIN -->
                            <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                                <a class="a2a_button_facebook"></a>
                                <a class="a2a_button_copy_link"></a>
                            </div>
                            <script defer src="https://static.addtoany.com/menu/page.js"></script>
                            <!-- AddToAny END -->
                        </div> <br><br><br><br><br>

                        <!-- POST NAVIGATION -->
                        <div class="post-navigation">
                            <div class="nav-previous">
                                <?php previous_post_link('%link', '<span class="nav-icon">‹</span><span>Back</span>'); ?>
                            </div>
                            <div class="nav-next">
                                <?php next_post_link('%link', '<span>Next</span><span class="nav-icon">›</span>'); ?>
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="inner-box">
                    <div class="related">
                        <h3> You may also interested in...</h3> <br><br><br><br>
                        <?php
                        $related_posts = get_field('related_posts');

                        if ($related_posts): ?>
                            <div class="related-posts">
                                <ul class="related-posts-list">
                                    <?php foreach ($related_posts as $post): setup_postdata($post); ?>
                                        <li class="related-post-item">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php if (has_post_thumbnail()): ?>
                                                    <div class="related-thumb">
                                                        <?php the_post_thumbnail('medium'); ?>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="related-title"><?php the_title(); ?></div>
                                                <div class="related-date"><?php echo get_the_date('d/m/Y'); ?></div>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                    <?php wp_reset_postdata(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
        <?php endwhile;
        endif; ?>
    </div>
</main><br><br><br><br><br><br>

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
        margin: 40px;
    }

    .post-date {
        font-family: 'Poppins', sans-serif;
        font-size: 20px;
        color: #2A2A2A;
    }

    .fullwidth-content {
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
        height: 652px;
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

    .post-text-content {
        margin-bottom: 60px;
    }

    .post-text-content p,
    .post-text-content h2,
    .post-text-content ul,
    .post-text-content ol {
        margin-bottom: 20px;
        font-size: 18px;
        line-height: 1.6;
        color: #333;
    }
    .post-image-content {
        text-align: center;
        margin-top: 40px;
    }

    .post-image-content img.featured-image {
        width: 1160px;
        height: 600px;
        object-fit: cover;
        border-radius: 12px;
        display: block;
        margin: 0 auto;
    }

    .share-heading {
        text-align: center;
        margin-top: 60px;
    }

    .a2a_kit {
        display: flex;
        justify-content: center;
        gap: 24px;
        margin-top: 20px;
    }

    /* Nút Facebook */
    .a2a_button_facebook {
        width: 64px;
        height: 64px;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #57D575;
        border-radius: 50%;
        color: white;
        font-size: 28px;
        transition: background-color 0.3s ease;
    }

    /* Nút Copy Link dạng pill lớn */
    .a2a_button_copy_link {
        width: 64px;
        height: 64px;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #57D575;
        border-radius: 50%;
        color: white;
        font-size: 28px;
        transition: background-color 0.3s ease;
    }

    .double-arrow-down {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin-bottom: 10px;
    }

    .double-arrow-down::before,
    .double-arrow-down::after {
        content: '⌄';
        color: #2ecc71;
        font-size: 80px;
        line-height: 1;
    }

    .post-navigation {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 40px;
        margin-top: 60px;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        color: #333;
    }

    .post-navigation a {
        display: flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        color: inherit;
        transition: opacity 0.3s ease;
    }

    .post-navigation a:hover {
        opacity: 0.7;
    }

    .nav-icon {
        width: 54px;
        height: 54px;
        border: 1px solid #333;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        flex-shrink: 0;
    }
    .related-posts-list {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    list-style: none;
    padding: 0;
    margin: 0 auto;
    max-width: 1220px;
    gap: 40px 20px; /* khoảng cách giữa các item */
}

.related-post-item {
    width: calc(33.333% - 13.33px); /* để đủ 3 cột có khoảng cách */
    box-sizing: border-box;
}

.related-post-item a {
    text-decoration: none; /* Gỡ gạch chân tiêu đề */
    color: inherit;
    display: block;
}

.related-thumb img {
    width: 394px;
    height: 277.2281494140625px;
    object-fit: cover;
    border-radius: 12px;
    display: block;
    margin-bottom: 10px;
}

.related-title {
    font-weight: 600;
    font-size: 18px;
    margin-top: 10px;
    color: #2A2A2A;
}

.related-date {
    font-size: 14px;
    color: #999;
    margin-top: 4px;
}
.wp-block-columns{
    gap: 8px;
}
.wp-block-gallery.has-nested-images.is-cropped figure.wp-block-image:not(#individual-image) img{
    width: 1160px;
    height: 600px;
    border-radius: 12px;
}
</style>