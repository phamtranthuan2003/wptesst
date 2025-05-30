<?php
/*
Template Name: home
*/
?>
<?php get_header(); ?>
<?php
while (have_posts()) : the_post();
    the_content();
endwhile;
?>
<div class="content">
    <div id="main-content">

        <?php
        $args = [
            'posts_per_page' => 6,
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC',
        ];
        $latest_posts = new WP_Query($args);

        if ($latest_posts->have_posts()) : ?>
            <div class="posts-grid">
                <?php while ($latest_posts->have_posts()) : $latest_posts->the_post(); ?>
                    <div class="post-item" data-aos="fade-up">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('large'); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php wp_reset_postdata();
        else :
            get_template_part('content', 'none');
        endif;
        ?>

    </div><br>
    <a href="#">
        <span class="scroll-top"> Discover More Games</span>
    </a>

    <?php
    $front_page_id = get_option('page_on_front');

    $middle_image = get_field('homepage_middle_image', $front_page_id);

    if ($middle_image) {
        echo '<div class="middle-image" style="text-align:center; margin: 20px 0;">';
        echo wp_get_attachment_image($middle_image['ID'], 'full');
        echo '</div>';
    }
    ?>

</div>
<?php get_footer(); ?>

<style>
    .posts-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
        margin-top: 30px;
    }

    .post-item {
        border: 1px solid #ccc;
        padding: 15px;
        box-sizing: border-box;
        background-color: #fff;
        transition: box-shadow 0.3s ease;
    }

    .post-item:hover {
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .post-thumbnail img {
        width: 100%;
        height: auto;
        display: block;
        margin-bottom: 10px;
        border-radius: 4px;
    }

    .post-item h3 {
        margin: 0;
        font-size: 1.2rem;
        font-weight: 700;
    }

    .post-item h3 a {
        color: #333;
        text-decoration: none;
    }

    .post-item h3 a:hover {
        color: #0073e6;
    }

    .menu ul {
        display: flex;
        list-style: none;
        margin: 40px;
        padding: 0;
        gap: 20px;
    }

    .main-menu li a {
        color: #fff !important;
        text-decoration: none;
        font-weight: bold;
        font-size: 20px;
        transition: color 0.3s ease;
    }
</style>