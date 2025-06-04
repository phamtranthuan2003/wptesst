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
                            <div class="double-arrow-down">
                                <svg xmlns="http://www.w3.org/2000/svg" width="44" height="29" viewBox="0 0 44 29" fill="none">
                                    <path d="M32.778 4.6675C33.2927 4.16692 33.5874 3.4824 33.5974 2.76451C33.6074 2.04662 33.3317 1.35417 32.8312 0.839497C32.3306 0.324822 31.6461 0.0300798 30.9282 0.0201091C30.2103 0.0101384 29.5178 0.285756 29.0032 0.78633L22.9156 7.00683L16.828 0.78633C16.5809 0.537169 16.2869 0.339404 15.9629 0.204444C15.639 0.0694835 15.2915 0 14.9406 0C14.5897 0 14.2422 0.0694835 13.9183 0.204444C13.5943 0.339404 13.3003 0.537169 13.0532 0.78633C12.804 1.03346 12.6062 1.32747 12.4713 1.65141C12.3363 1.97536 12.2668 2.32282 12.2668 2.67375C12.2668 3.02468 12.3363 3.37214 12.4713 3.69608C12.6062 4.02002 12.804 4.31404 13.0532 4.56116L21.0282 12.5362C21.2753 12.7853 21.5693 12.9831 21.8933 13.118C22.2172 13.253 22.5647 13.3225 22.9156 13.3225C23.2665 13.3225 23.614 13.253 23.9379 13.118C24.2619 12.9831 24.5559 12.7853 24.803 12.5362L32.778 4.6675ZM24.803 27.2633L32.778 19.2883C33.2786 18.7878 33.5598 18.1088 33.5598 17.4009C33.5598 16.693 33.2786 16.0141 32.778 15.5135C32.2774 15.0129 31.5985 14.7317 30.8906 14.7317C30.1827 14.7317 29.5037 15.0129 29.0032 15.5135L22.9156 21.6277L16.828 15.5135C16.5809 15.2643 16.2869 15.0666 15.9629 14.9316C15.639 14.7967 15.2915 14.7272 14.9406 14.7272C14.5897 14.7272 14.2422 14.7967 13.9183 14.9316C13.5943 15.0666 13.3003 15.2643 13.0532 15.5135C12.804 15.7606 12.6062 16.0546 12.4713 16.3786C12.3363 16.7025 12.2668 17.05 12.2668 17.4009C12.2668 17.7518 12.3363 18.0993 12.4713 18.4232C12.6062 18.7472 12.804 19.0412 13.0532 19.2883L21.0282 27.2633C21.2682 27.5196 21.5566 27.7257 21.8768 27.8699C22.1969 28.0141 22.5425 28.0934 22.8934 28.1033C23.2444 28.1132 23.5939 28.0534 23.9216 27.9275C24.2494 27.8016 24.5489 27.612 24.803 27.3697V27.2633Z" fill="#57D575" />
                                </svg>
                            </div> <br>
                            <h2>Want to share this article?</h2>
                            <!-- AddToAny BEGIN -->
                            <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                                <a class="a2a_button_facebook">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none">
                                        <path d="M16.2371 27.8087C22.8064 26.8205 27.8428 21.1521 27.8428 14.3074C27.8428 6.7666 21.7297 0.653564 14.189 0.653564C6.64819 0.653564 0.535156 6.7666 0.535156 14.3074C0.535156 21.1521 5.5717 26.8205 12.1409 27.8087V18.4036H10.0928C8.96172 18.4036 8.04477 17.4866 8.04477 16.3555C8.04477 15.2244 8.96172 14.3074 10.0928 14.3074H12.1409V11.5766C12.1409 8.93735 14.2805 6.7978 16.9198 6.7978H17.6025C18.7335 6.7978 19.6505 7.71475 19.6505 8.84587C19.6505 9.977 18.7335 10.8939 17.6025 10.8939H16.9198C16.5428 10.8939 16.2371 11.1996 16.2371 11.5766V14.3074L18.2852 14.3074C19.4162 14.3074 20.3332 15.2244 20.3332 16.3555C20.3332 17.4866 19.4162 18.4036 18.2852 18.4036H16.2371V27.8087Z" fill="#57D575" />
                                    </svg>
                                </a>
                                <a class="a2a_button_copy_link">Copy Link
                                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none">
                                        <path d="M10.2231 13.39L6.34312 17.27C5.87336 17.7233 5.24598 17.9767 4.59312 17.9767C3.94026 17.9767 3.31288 17.7233 2.84312 17.27C2.61272 17.0405 2.42991 16.7678 2.30517 16.4675C2.18043 16.1671 2.11622 15.8452 2.11622 15.52C2.11622 15.1948 2.18043 14.8728 2.30517 14.5725C2.42991 14.2722 2.61272 13.9995 2.84312 13.77L6.72312 9.88997C6.91142 9.70167 7.01721 9.44627 7.01721 9.17997C7.01721 8.91367 6.91142 8.65828 6.72312 8.46997C6.53481 8.28167 6.27942 8.17588 6.01312 8.17588C5.74682 8.17588 5.49142 8.28167 5.30312 8.46997L1.42312 12.36C0.641474 13.2108 0.218738 14.3306 0.243192 15.4857C0.267646 16.6408 0.737399 17.7418 1.55435 18.5587C2.3713 19.3757 3.47228 19.8454 4.62737 19.8699C5.78245 19.8944 6.90232 19.4716 7.75312 18.69L11.6431 14.81C11.8314 14.6217 11.9372 14.3663 11.9372 14.1C11.9372 13.8337 11.8314 13.5783 11.6431 13.39C11.4548 13.2017 11.1994 13.0959 10.9331 13.0959C10.6668 13.0959 10.4114 13.2017 10.2231 13.39ZM18.8031 1.30997C17.9619 0.47398 16.8241 0.00476074 15.6381 0.00476074C14.4521 0.00476074 13.3143 0.47398 12.4731 1.30997L8.58312 5.18997C8.48988 5.28321 8.41592 5.3939 8.36546 5.51572C8.315 5.63755 8.28903 5.76811 8.28903 5.89997C8.28903 6.03183 8.315 6.1624 8.36546 6.28422C8.41592 6.40604 8.48988 6.51673 8.58312 6.60997C8.67636 6.70321 8.78705 6.77717 8.90887 6.82763C9.03069 6.87809 9.16126 6.90406 9.29312 6.90406C9.42498 6.90406 9.55554 6.87809 9.67737 6.82763C9.79919 6.77717 9.90988 6.70321 10.0031 6.60997L13.8831 2.72997C14.3529 2.2766 14.9803 2.02323 15.6331 2.02323C16.286 2.02323 16.9134 2.2766 17.3831 2.72997C17.6135 2.95946 17.7963 3.23218 17.9211 3.53249C18.0458 3.8328 18.11 4.15479 18.11 4.47997C18.11 4.80516 18.0458 5.12714 17.9211 5.42745C17.7963 5.72776 17.6135 6.00049 17.3831 6.22997L13.5031 10.11C13.4094 10.2029 13.335 10.3135 13.2842 10.4354C13.2335 10.5573 13.2073 10.688 13.2073 10.82C13.2073 10.952 13.2335 11.0827 13.2842 11.2045C13.335 11.3264 13.4094 11.437 13.5031 11.53C13.5961 11.6237 13.7067 11.6981 13.8285 11.7489C13.9504 11.7996 14.0811 11.8258 14.2131 11.8258C14.3451 11.8258 14.4758 11.7996 14.5977 11.7489C14.7196 11.6981 14.8302 11.6237 14.9231 11.53L18.8031 7.63997C19.6391 6.79875 20.1083 5.66095 20.1083 4.47497C20.1083 3.289 19.6391 2.15119 18.8031 1.30997ZM6.94312 13.17C7.03656 13.2627 7.14737 13.336 7.26921 13.3857C7.39105 13.4355 7.52151 13.4607 7.65312 13.46C7.78472 13.4607 7.91519 13.4355 8.03702 13.3857C8.15886 13.336 8.26968 13.2627 8.36312 13.17L13.2831 8.24997C13.4714 8.06167 13.5772 7.80627 13.5772 7.53997C13.5772 7.27367 13.4714 7.01828 13.2831 6.82997C13.0948 6.64167 12.8394 6.53588 12.5731 6.53588C12.3068 6.53588 12.0514 6.64167 11.8631 6.82997L6.94312 11.75C6.84939 11.8429 6.775 11.9535 6.72423 12.0754C6.67346 12.1973 6.64732 12.328 6.64732 12.46C6.64732 12.592 6.67346 12.7227 6.72423 12.8445C6.775 12.9664 6.84939 13.077 6.94312 13.17Z" fill="#57D575" />
                                    </svg>
                                </a>
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
                        $related_posts = get_field('related_posts', 198);

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
        padding: 15px 55px;
        border: 1px solid #000;
        border-radius: 53px;
        text-decoration: none;
        color: #000;
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
        width: 100%;
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

    .a2a_button_facebook {
        width: 54px;
        height: 54px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        border: 1px solid #57D575;
        color: white;
        font-size: 28px;
        transition: background-color 0.3s ease;
    }

    .a2a_button_copy_link {
        width: 181px;
        height: 54px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        border-radius: 53px;
        border: 1.37px solid #57D575;
        padding: 8px 30px;
        color: #57D575;
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        font-size: 18px;
        line-height: 198%;
        letter-spacing: 0;
        background-color: transparent;
        text-decoration: none;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .a2a_button_copy_link svg {
        width: 20px;
        height: 20px;
        fill: #57D575;
    }




    .double-arrow-down {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin-bottom: 10px;
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
        gap: 40px 20px;
        /* khoảng cách giữa các item */
    }

    .related-post-item {
        width: calc(33.333% - 13.33px);
        /* để đủ 3 cột có khoảng cách */
        box-sizing: border-box;
    }

    .related-post-item a {
        text-decoration: none;
        /* Gỡ gạch chân tiêu đề */
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

    .wp-block-columns {
        gap: 8px;
    }

    .wp-block-gallery.has-nested-images.is-cropped figure.wp-block-image:not(#individual-image) img {
        width: 1160px;
        height: 600px;
        border-radius: 12px;
    }

    p {
        line-height: 113px;
        max-width: 803px;
        margin-left: auto;
        margin-right: auto;
        display: block;
        width: 100%;
        gap: 10px;
    }

    .main-menu ul li a {
        display: inline-block;
        width: 66px;
        height: 36px;
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        font-size: 18px;
        line-height: 198%;
        letter-spacing: 0;
        color: #000 !important;
        text-decoration: none;
    }

    .main-menu ul li a:hover,
    .main-menu ul li.current-menu-item a,
    .main-menu ul li.current_page_item a,
    .main-menu ul li.current-menu-ancestor a,
    .main-menu ul li.current_page_parent a {
        color: #57D575 !important;
        text-decoration: none;
    }

    body,
    html {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .single-container {
        padding: 16px;
    }

    .post-title {
        font-size: 24px;
        line-height: 1.3;
    }

    @media (max-width: 768px) {
        .inner-box {
            padding: 12px;
        }

        .post-title {
            font-size: 20px;
        }

        .download-buttons {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .store-badge img {
            width: 160px;
            height: auto;
        }

        .share-heading {
            text-align: center;
            padding: 20px 0;
        }

        .a2a_kit {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .post-text-content {
            font-size: 16px;
            line-height: 1.6;
        }
    }
</style>