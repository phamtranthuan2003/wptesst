<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
  <?php wp_head(); ?>
  <style>
    * {
      box-sizing: border-box;
    }

    html,
    body {
      margin: 0;
      padding: 0;
      overflow-x: hidden;
    }

    .site-header {
      width: 100%;
      min-height: 100vh;
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center center;
      position: relative;
    }

    .site-header.no-bg {
      min-height: auto;
      background: none;
    }

    .slider-wrapper {
      width: 85%;
      max-width: 1440px;
      margin: 0 auto;
      height: 100%;
      display: flex;
      flex-direction: column;
      padding-top: 20px;
    }

    .header-container {
      width: 100%;
      min-height: 65px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .logo {
      max-width: 214px;
      height: auto;
    }

    .logo img,
    .custom-page-logo {
      width: 100%;
      height: auto;
      max-height: 110px;
      object-fit: contain;
    }

    .main-menu ul {
      display: flex;
      gap: 40px;
      list-style: none;
      margin: 0;
      padding: 0;
    }

    .main-menu ul li a {
      font-family: 'Poppins', sans-serif;
      font-weight: 600;
      font-size: 18px;
      color: #ffffff;
      text-decoration: none;
    }

    .main-menu ul li a:hover,
    .main-menu ul li.current-menu-item a,
    .main-menu ul li.current_page_item a,
    .main-menu ul li.current-menu-ancestor a,
    .main-menu ul li.current_page_parent a {
      color: #57D575;
    }

    .mobile-page-dropdown,
    .mobile-page-taskbar {
      display: none;
    }

    @media only screen and (max-width: 768px) {
      .site-header {
        min-height: auto;
        background-size: cover;
        background-position: center;
      }

      .slider-wrapper {
        width: 90%;
        padding: 16px 0;
        display: flex;
        flex-direction: column;
        gap: 16px;
      }

      .header-container {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
        width: 100%;
      }

      .logo {
        width: 160px;
        height: auto;
      }

      .main-menu {
        display: none;
      }

      .mobile-page-dropdown {
        display: block;
        position: absolute;
        top: 20px;
        right: 20px;
        z-index: 1000;
      }

      .dropdown-toggle {
        background: #57D575;
        border: none;
        padding: 8px 12px;
        border-radius: 4px;
        cursor: pointer;
      }

      .dropdown-toggle svg rect {
        fill: #fff;
        stroke: #fff;
      }

      .dropdown-menu {
        display: none;
        position: absolute;
        right: 0;
        top: 38px;
        background: #fff;
        border: 1px solid #ccc;
        border-radius: 4px;
        min-width: 140px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        list-style: none;
        padding: 8px 0;
        margin: 0;
      }

      .dropdown-menu li a {
        display: block;
        padding: 8px 16px;
        text-decoration: none;
        font-size: 14px;
        color: #333;
      }

      .dropdown-menu li a:hover,
      .dropdown-menu li a.active {
        background: #57D575;
        color: #fff;
      }

      .mobile-page-taskbar {
        display: flex;
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background: #57D575;
        z-index: 9999;
        justify-content: space-around;
        padding: 8px 0;
      }

      .mobile-page-taskbar a {
        color: #fff;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        padding: 6px 10px;
      }

      .mobile-page-taskbar a.active {
        background: #fff;
        color: #57D575;
        border-radius: 6px;
      }
    }
  </style>
</head>

<body <?php body_class(); ?>>
  <?php
  $is_front_page = is_front_page();
  $header_bg_id = function_exists('get_field') ? get_field('back_ground', get_queried_object_id()) : null;
  $header_style = '';
  if ($header_bg_id) {
    $image_url = wp_get_attachment_image_url($header_bg_id, 'full');
    if ($image_url) {
      $header_style = 'style="background-image: url(' . esc_url($image_url) . '); background-size: cover; background-position: center center;"';
    }
  }
  ?>

  <header class="site-header <?php echo $is_front_page ? '' : (empty($header_style) ? 'no-bg' : ''); ?>" <?php echo !$is_front_page ? $header_style : ''; ?>>
    <?php if ($is_front_page) : get_template_part('slider'); endif; ?>
    <div class="slider-wrapper">
      <div class="header-container">
        <div class="logo">
          <a href="<?php echo esc_url(home_url('/')); ?>">
            <?php
            $page_logo_id = function_exists('get_field') ? (is_single() ? get_field('page_logo', 68) : get_field('page_logo', get_queried_object_id())) : false;
            if ($page_logo_id) {
              echo wp_get_attachment_image($page_logo_id, 'full', false, ['class' => 'custom-page-logo']);
            } else {
              echo '<h1>' . esc_html(get_bloginfo('name')) . '</h1>';
            }
            ?>
          </a>
        </div>

        <nav class="main-menu" aria-label="Primary Menu">
          <?php
          if (function_exists('thuan_menu')) {
            thuan_menu('primary-menu');
          } else {
            wp_nav_menu([
              'theme_location' => 'primary-menu',
              'container' => false,
              'menu_class' => '',
              'fallback_cb' => false
            ]);
          }
          ?>
        </nav>

        <div class="mobile-page-dropdown">
          <button class="dropdown-toggle" onclick="toggleMobilePages()">
            <svg width="26" height="18" viewBox="0 0 26 18" fill="none" xmlns="http://www.w3.org/2000/svg">
              <rect x="1" y="0.75" width="24" height="1.5" rx="0.75" />
              <rect x="1" y="8.25" width="24" height="1.5" rx="0.75" />
              <rect x="1" y="15.75" width="24" height="1.5" rx="0.75" />
            </svg>
          </button>
          <ul class="dropdown-menu" id="mobilePagesMenu">
            <?php
            $pages = get_pages(['sort_column' => 'menu_order']);
            foreach ($pages as $page) {
              $is_active = (is_page($page->ID)) ? 'active' : '';
              echo '<li><a class="' . $is_active . '" href="' . get_permalink($page->ID) . '">' . esc_html($page->post_title) . '</a></li>';
            }
            ?>
          </ul>
        </div>
      </div>
    </div>
  </header>

  <?php wp_footer(); ?>
  <script>
    function toggleMobilePages() {
      const menu = document.getElementById('mobilePagesMenu');
      menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
    }
  </script>