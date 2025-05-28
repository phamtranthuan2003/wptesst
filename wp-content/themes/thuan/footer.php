<footer class="modern-footer">
  <div class="footer-wrapper">
    <div class="footer-left">
      <h2>Let's Get In Touch</h2>
      <a href="#" class="contact-button">Contact us <span class="arrow">➤</span></a>
      <div class="social-icons">
        <a href="#" class="linkedin-icon">in</a>
      </div>
    </div>

    <div class="footer-right">
      <div class="footer-column">
        <h4>COMPANY</h4>
        <ul>
          <?php
            $pages = get_pages([
                'sort_column' => 'menu_order',
                'sort_order' => 'asc'
            ]);
            foreach ($pages as $page) {
                $page_link = get_permalink($page->ID);
                echo '<li><a href="' . esc_url($page_link) . '">' . esc_html($page->post_title) . '</a></li>';
            }
          ?>
        </ul>
      </div>

      <div class="footer-column">
        <h4>TERMS AND POLICIES</h4>
        <ul>
          <li><a href="#">Privacy Policy</a></li>
          <li><a href="#">Terms of Service</a></li>
          <li><a href="#">Legal Terms</a></li>
        </ul>
      </div>
      <a href="#" id="scrollToTopBtn" class="scroll-to-top" title="Go to top">
        <span>&#9650;</span>
        <div class="scroll-label">Top</div>
    </a>  
    </div>
  </div>

  <div class="footer-bottom">
    <p>&copy; 2025 Century Games</p>
  </div>

  <!-- Scroll To Top Button -->
  
</footer>
