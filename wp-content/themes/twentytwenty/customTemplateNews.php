<?php
/* Template Name: Custom ACF Page */
get_header();
?>

<main id="site-content" role="main">
  <div class="section-inner">

    <!-- ACF Content Section -->
    <div class="acf-content" style="display: flex; align-items: flex-start; gap: 20px; margin-bottom: 40px;">
      <div class="acf-text" style="flex: 1;">
        <p><?php the_field('content_event'); ?></p>
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
    $categories = get_categories(['hide_empty' => true]);
    $current_cat_id = isset($_GET['cat']) ? intval($_GET['cat']) : 0;

    if (!empty($categories)): ?>
      <div class="category-filter">
        <a href="<?php echo get_permalink(get_the_ID()); ?>" class="<?php if (!$current_cat_id) echo 'active'; ?>">All</a>
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
      $paged = get_query_var('paged') ? get_query_var('paged') : 1;

      $args = [
        'post_type'      => 'post',
        'posts_per_page' => 10,
        'paged'          => $paged,
      ];
      if ($current_cat_id) {
        $args['cat'] = $current_cat_id;
      }

      $query = new WP_Query($args);

      if ($query->have_posts()):
        $post_count = 0;

        while ($query->have_posts()): $query->the_post();
          $post_count++;

          $style = ($post_count <= 2) ? 'flex: 0 0 48%;' : 'flex: 0 0 31%;';
          $img_style = 'width: 100%; height: auto; border-radius: 10px;';
      ?>
          <article class="post-item" style="margin-bottom: 30px; <?php echo $style; ?>">
            <?php if (has_post_thumbnail()): ?>
              <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('medium', ['style' => $img_style]); ?>
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
                $categories = get_the_category();
                if (!empty($categories)) {
                  $primary_category = $categories[0];
                }
              }

              if ($primary_category) {
                echo '<a href="' . esc_url(get_category_link($primary_category->term_id)) . '">';
                echo esc_html($primary_category->name);
                echo '</a>';
              }
              ?>
              <span class="post-date"><?php echo get_the_date('d/m/Y'); ?></span>
            </div>

            <h2 class="post-title">
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h2>
          </article>
        <?php
        endwhile;

        // Pagination
        echo paginate_links([
          'total' => $query->max_num_pages
        ]);

        wp_reset_postdata();
      else: ?>
        <p><?php esc_html_e('No posts found.', 'textdomain'); ?></p>
      <?php endif; ?>
    </div>
  </div>
</main>

<?php get_footer(); ?>

<style>
  .category-filter {
    display: flex;
    gap: 12px;
    margin-bottom: 30px;
    flex-wrap: wrap;
  }

  .category-filter a {
    padding: 10px 20px;
    background-color: #f5f5f5;
    color: #000;
    border-radius: 999px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    font-size: 14px;
  }

  .category-filter a:hover,
  .category-filter a.active {
    background-color: #00c16a;
    color: #fff;
  }

  .post-categories {
    margin-top: 5px;
    font-size: 14px;
    color: #666;
  }

  .post-categories a {
    display: inline-block;
    background-color: #00c16a;
    color: #fff;
    text-decoration: none;
    padding: 3px 8px;
    border-radius: 12px;
    margin-right: 8px;
    font-size: 14px;
    transition: background-color 0.3s ease;
  }

  .post-categories a:hover {
    background-color: #00a85c;
  }

  .post-categories .post-date {
    margin-left: 12px;
    color: #666;
    font-weight: 500;
  }

  .post-title a {
    text-decoration: none;
    color: #000;
  }

  .post-title {
    font-size: 19px;
    margin-top: 10px;
  }
</style>