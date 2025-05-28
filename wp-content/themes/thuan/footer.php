<footer class="modern-footer">
  <div class="footer-wrapper">
    
    <!-- Left column: Get In Touch -->
    <div class="footer-left">
      <h2>Let's Get In Touch</h2>
      <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>" class="contact-button">
        Contact us <span class="arrow">➤</span>
    </a>

    </div>

    <!-- Right column: Links -->
    <div class="footer-right">
      <div class="footer-column">
        <h4>Company</h4>
        <ul>
  <?php
    $pages = get_pages([
        'sort_column' => 'menu_order',
        'sort_order' => 'asc'
    ]);

    foreach ($pages as $page) {
        echo '<li><a href="' . esc_url(get_permalink($page->ID)) . '">' . esc_html($page->post_title) . '</a></li>';
    }
  ?>
</ul>
      </div>
      <div class="footer-column">
        <h4>Terms and Policies</h4>
        <ul>
          <li><a href="#">Privacy Policy</a></li>
          <li><a href="#">Terms of Service</a></li>
          <li><a href="#">Legal Terms</a></li>
        </ul>
      </div>
      <div class="scroll-top">
        <a href="#" class="scroll-btn">⬆</a>
        <span>Top</span>
      </div>
    </div>
  </div>

  <div class="footer-bottom">
    <p>&copy; <?php echo date('Y'); ?> Century Games.</p>
  </div>

  <?php wp_footer(); ?>
</footer>
