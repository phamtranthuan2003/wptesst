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
                    <h5>
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="12" viewBox="0 0 15 12" fill="none" style="margin-left: 6px; vertical-align: middle;">
                            <path d="M2.41422 0.423957C2.15531 0.157746 1.80124 0.00529246 1.42992 0.000135207C1.0586 -0.00502204 0.700434 0.13754 0.434223 0.396457C0.168012 0.655375 0.0155585 1.00944 0.0104012 1.38076C0.005244 1.75208 0.147805 2.11025 0.406723 2.37646L3.62422 5.52521L0.406723 8.67396C0.277846 8.80178 0.175554 8.95386 0.105747 9.12141C0.0359398 9.28897 0 9.46869 0 9.65021C0 9.83172 0.0359398 10.0114 0.105747 10.179C0.175554 10.3466 0.277846 10.4986 0.406723 10.6265C0.534547 10.7553 0.686623 10.8576 0.85418 10.9274C1.02174 10.9972 1.20146 11.0332 1.38297 11.0332C1.56449 11.0332 1.74421 10.9972 1.91177 10.9274C2.07932 10.8576 2.2314 10.7553 2.35922 10.6265L6.48422 6.50146C6.6131 6.37363 6.71539 6.22156 6.7852 6.054C6.855 5.88644 6.89095 5.70672 6.89095 5.52521C6.89095 5.34369 6.855 5.16397 6.7852 4.99641C6.71539 4.82886 6.6131 4.67678 6.48422 4.54896L2.41422 0.423957ZM14.1017 4.54896L9.97672 0.423957C9.7178 0.165039 9.36664 0.0195805 9.00047 0.0195805C8.63431 0.0195805 8.28314 0.165039 8.02422 0.423957C7.76531 0.682874 7.61985 1.03404 7.61985 1.40021C7.61985 1.76637 7.76531 2.11754 8.02422 2.37646L11.1867 5.52521L8.02422 8.67396C7.89535 8.80178 7.79305 8.95386 7.72325 9.12141C7.65344 9.28897 7.6175 9.46869 7.6175 9.65021C7.6175 9.83172 7.65344 10.0114 7.72325 10.179C7.79305 10.3466 7.89535 10.4986 8.02422 10.6265C8.15205 10.7553 8.30412 10.8576 8.47168 10.9274C8.63924 10.9972 8.81896 11.0332 9.00047 11.0332C9.18199 11.0332 9.36171 10.9972 9.52927 10.9274C9.69682 10.8576 9.8489 10.7553 9.97672 10.6265L14.1017 6.50146C14.2343 6.3773 14.3409 6.22812 14.4155 6.06253C14.49 5.89693 14.5311 5.71821 14.5362 5.53667C14.5413 5.35513 14.5104 5.17438 14.4453 5.00485C14.3801 4.83532 14.2821 4.68038 14.1567 4.54896H14.1017Z" fill="#57D575" />
                        </svg>
                        Stay tune with our news updates
                    </h5>

                    <?php if (get_field('page_content')): ?>
                        <?php echo wp_kses_post(get_field('page_content')); ?>
                    <?php endif; ?>
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
                </div>

                <?php
                $image = get_field('image_on_the_right');
                if ($image): ?>
                    <div class="acf-image">
                        <?php echo wp_get_attachment_image($image, 'full', false, [
                            'class' => 'acf-image-img'
                        ]); ?>
                    </div>


                <?php endif; ?>
            </div>

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
        border-radius: 53px;
        Top: 8px;
        Right: 60px;
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
        border-radius: 53px;
        Top: 8px;
        Right: 60px;
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
        border-radius: 53px;
        Top: 8px;
        Right: 60px;
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
        width: 86px;
        height: 32px;
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

    h2 {
        font-size: 24px;
        padding-left: 10px;
    }

    h1 {
        Width: 666px;
        Height: 96px;
        font-weight: 900;
        font-size: 80px;
        line-height: 120%;
        letter-spacing: 0%;
        text-transform: capitalize;
    }

    h5 {
        width: 581px;
        font-family: Poppins;
        font-weight: 400;
        font-size: 20px;
        line-height: 140%;
        text-transform: capitalize;
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

    .news-container {
        margin-top: 80px;
    }

    @media only screen and (max-width: 768px) {
        .news-container {
            width: 90%;
            padding-bottom: 40px;
            margin-top: 40px;
        }

        .acf-content {
            flex-direction: column;
            align-items: center;
        }

        .acf-text,
        .acf-image-img {
            width: 100% !important;
            height: auto !important;
            margin-left: 0;
            margin-top: 0;
        }

        .category-filter {
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
        }

        .category-filter a {
            width: auto;
            padding: 8px 16px;
            font-size: 14px;
            height: auto;
        }

        .post-list {
            flex-direction: column;
            gap: 20px;
        }

        .post-item {
            flex: 1 1 100% !important;
            margin-bottom: 20px !important;
        }

        .post-item img {
            width: 100% !important;
            height: auto !important;
            border-radius: 12px !important;
        }

        h1 {
            font-size: 36px;
            line-height: 1.2;
            width: 100%;
            height: auto;
        }

        h2 {
            font-size: 20px;
            padding-left: 0;
        }

        h5 {
            font-size: 16px;
            width: 100%;
        }

        .post-category-badge {
            font-size: 12px;
            padding: 6px 16px;
            width: auto;
            height: auto;
        }

        .post-date {
            font-size: 14px;
            width: auto;
        }

        .pagination {
            gap: 20px;
        }

        .pagination .page-numbers.prev,
        .pagination .page-numbers.next {
            width: 40px;
            height: 40px;
            font-size: 16px;
        }
    }
    .acf-text h5 {
    margin-top: 40px;
}

</style>