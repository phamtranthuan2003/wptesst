<footer class="modern-footer">
  <div class="footer-wrapper">
    <div class="footer-left">
      <h2>Let's Get In Touch</h2>
      <a href="<?php echo site_url('/contact'); ?>" class="contact-button">
        Contact us <span class="arrow">➤</span>
      </a>

      <div class="social-icons">
        <a href="https://www.linkedin.com/company/century-game" class="linkedin-icon">in</a>
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
        <div class="arrow-icon">⯅</div>
        <div class="scroll-label">Top</div>
      </a>
    </div>
  </div>

  <div class="footer-bottom">
    <p>&copy; 2025 Century Games</p>
  </div>

</footer>
<script>
  const scrollBtn = document.getElementById('scrollToTopBtn');
  const footer = document.querySelector('.modern-footer');
  const footerRight = document.querySelector('.footer-right');

  function updateScrollButton() {
    const footerRect = footer.getBoundingClientRect();
    const windowHeight = window.innerHeight;

    // Kiểm tra xem footer có trong vùng hiển thị không
    const isVisible = footerRect.top < windowHeight && footerRect.bottom > 0;

    if (isVisible) {
      // Gắn vào footer-right nếu footer hiện ra
      scrollBtn.classList.add('in-footer');
      scrollBtn.style.position = 'absolute';

      if (!footerRight.contains(scrollBtn)) {
        footerRight.appendChild(scrollBtn);
      }
    } else {
      // Gắn lại vào body nếu không thấy footer
      scrollBtn.classList.remove('in-footer');
      scrollBtn.style.position = 'fixed';

      if (scrollBtn.parentElement !== document.body) {
        document.body.appendChild(scrollBtn);
      }
    }
  }

  // Smooth scroll khi click
  scrollBtn.addEventListener('click', function(e) {
    e.preventDefault();
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  });

  // Theo dõi scroll và resize
  window.addEventListener('scroll', updateScrollButton);
  window.addEventListener('resize', updateScrollButton);

  // Khởi tạo
  updateScrollButton();
</script>




<style>
  .modern-footer {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #000;
  }

  .footer-wrapper {
    display: flex;
    width: 100%;
    overflow: hidden;
    border-radius: 0;
    background-color: #57D575;
  }

  .footer-left {
  flex: 1;
  background-color: #fff;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  min-width: 260px;
  position: relative;
  border-bottom-right-radius: 120px 100px;
  z-index: 1;
  overflow: hidden;
  width: 85%;
}


  .footer-right {
    flex: 2;
    background-color: #57D575;
    padding: 50px 40px;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    position: relative;
    min-width: 300px;
    z-index: 0;
    border-bottom-left-radius: 0;
  }


  .footer-left h2 {
    font-size: 26px;
    margin-bottom: 20px;
    color: #000;
  }

  .contact-button {
    display: inline-block;
    margin-top: 10px;
    padding: 10px 20px;
    background-color: #f6f6f6;
    color: #000;
    font-weight: bold;
    border-radius: 30px;
    text-decoration: none;
    transition: background-color 0.3s ease;
  }

  .contact-button:hover {
    background-color: #00e6b0;
  }

  .arrow {
    margin-left: 8px;
  }

  .social-icons {
    margin-top: 20px;
  }

  .linkedin-icon {
    display: inline-block;
    width: 36px;
    height: 36px;
    background-color: #00ff88;
    color: #000;
    font-weight: bold;
    text-align: center;
    line-height: 36px;
    border-radius: 50%;
    text-decoration: none;
    border: 2px solid #ddd;
    transition: background-color 0.3s ease;
  }

  .linkedin-icon:hover {
    background-color: #00cc77;
  }



  .footer-column h4 {
    font-size: 16px;
    margin-bottom: 15px;
    color: #000;
  }

  .footer-column ul {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .footer-column ul li {
    margin-bottom: 10px;
  }

  .footer-column ul li a {
    color: #fff;
    text-decoration: none;
    font-size: 15px;
    transition: color 0.3s ease;
  }

  .footer-column ul li a:hover {
    color: #000;
  }

  .footer-column {
    text-align: center;
    margin: 0 auto;
  }

  .scroll-to-top {
    position: fixed;
    bottom: 40px;
    right: 40px;
    background-color: #57D575;
    color: #000;
    width: 48px;
    height: 48px;
    border-radius: 50%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    font-weight: bold;
    font-size: 18px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    transition: all 0.3s ease;
    z-index: 1000;
  }

  .scroll-to-top.in-footer {
    position: absolute;
    top: 20px;
    right: 30px;
    background-color: #fff;
  }

  .arrow-icon {
    font-size: 18px;
    line-height: 1;
  }

  .scroll-label {
    font-size: 12px;
    margin-top: 4px;
  }


  .arrow-icon {
    font-size: 18px;
  }


  .footer-bottom {
    padding: 1px 0;
    font-size: 14px;
    color: #fff;
    background-color: #57D575;
  }

  .modern-footer p {
    color: #fff !important;
  }
</style>