<footer class="modern-footer">
  <div class="footer-wrapper">
    <div class="footer-left">
      <h2>Let's Get In Touch</h2>
      <a href="<?php echo site_url('/contact'); ?>" class="contact-button">
        Contact us <span class="arrow">➤</span>
      </a>

      <div class="social-icons">
        <a href="https://www.linkedin.com/company/century-game" class="linkedin-icon" target="_blank" rel="noopener noreferrer">
          <svg xmlns="http://www.w3.org/2000/svg" width="55" height="55" viewBox="0 0 55 55" fill="none">
            <circle cx="27.3077" cy="27.3077" r="26.625" stroke="#CECECE" stroke-width="1.36538" />
            <path d="M27.4215 9.99976H27.3441C17.9767 9.99976 10.3828 17.5958 10.3828 26.966V27.0435C10.3828 36.4137 17.9767 44.0098 27.3441 44.0098H27.4215C36.789 44.0098 44.3828 36.4137 44.3828 27.0435V26.966C44.3828 17.5958 36.789 9.99976 27.4215 9.99976Z" fill="#57D575" />
            <path d="M18.4909 21.3052C18.0431 20.8893 17.8203 20.3746 17.8203 19.7622C17.8203 19.1497 18.0442 18.6123 18.4909 18.1953C18.9388 17.7794 19.5154 17.5709 20.2217 17.5709C20.9281 17.5709 21.482 17.7794 21.9287 18.1953C22.3766 18.6111 22.5993 19.1342 22.5993 19.7622C22.5993 20.3901 22.3754 20.8893 21.9287 21.3052C21.4808 21.721 20.9126 21.9296 20.2217 21.9296C19.5308 21.9296 18.9388 21.721 18.4909 21.3052ZM22.2229 23.6906V36.4401H18.1955V23.6906H22.2229Z" fill="#FEFFFC" />
            <path d="M35.6279 24.9502C36.5058 25.9035 36.9442 27.2118 36.9442 28.8775V36.215H33.1193V29.3947C33.1193 28.5546 32.9013 27.9017 32.4666 27.437C32.0318 26.9723 31.4457 26.7387 30.7119 26.7387C29.9782 26.7387 29.3921 26.9711 28.9573 27.437C28.5225 27.9017 28.3045 28.5546 28.3045 29.3947V36.215H24.457V23.655H28.3045V25.3208C28.6941 24.7655 29.2194 24.3271 29.8793 24.0041C30.5392 23.6812 31.2813 23.5204 32.1068 23.5204C33.5767 23.5204 34.7512 23.997 35.6279 24.9502Z" fill="#FEFFFC" />
          </svg>
        </a>
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
        <div class="arrow-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="12" height="16" viewBox="0 0 12 16" fill="none">
            <path d="M1.05173 12.72C0.79359 12.971 0.645757 13.3144 0.640756 13.6744C0.635755 14.0345 0.773997 14.3818 1.02507 14.64C1.27614 14.8981 1.61948 15.0459 1.97955 15.0509C2.33961 15.056 2.68692 14.9177 2.94507 14.6666L5.9984 11.5466L9.05173 14.6666C9.17568 14.7916 9.32315 14.8908 9.48563 14.9585C9.64811 15.0262 9.82239 15.061 9.9984 15.061C10.1744 15.061 10.3487 15.0262 10.5112 14.9585C10.6736 14.8908 10.8211 14.7916 10.9451 14.6666C11.07 14.5427 11.1692 14.3952 11.2369 14.2327C11.3046 14.0703 11.3395 13.896 11.3395 13.72C11.3395 13.544 11.3046 13.3697 11.2369 13.2072C11.1692 13.0447 11.07 12.8973 10.9451 12.7733L6.94507 8.7733C6.82112 8.64833 6.67365 8.54914 6.51117 8.48145C6.34869 8.41376 6.17442 8.37891 5.9984 8.37891C5.82239 8.37891 5.64811 8.41376 5.48563 8.48145C5.32315 8.54914 5.17568 8.64833 5.05173 8.7733L1.05173 12.72ZM5.05173 1.38664L1.05173 5.38664C0.800663 5.63771 0.659612 5.97824 0.659612 6.3333C0.659612 6.68837 0.800663 7.0289 1.05173 7.27997C1.30281 7.53104 1.64333 7.67209 1.9984 7.67209C2.35347 7.67209 2.694 7.53104 2.94507 7.27997L5.9984 4.2133L9.05173 7.27997C9.17568 7.40494 9.32315 7.50413 9.48563 7.57183C9.64811 7.63952 9.82239 7.67437 9.9984 7.67437C10.1744 7.67437 10.3487 7.63952 10.5112 7.57183C10.6736 7.50413 10.8211 7.40494 10.9451 7.27997C11.07 7.15602 11.1692 7.00855 11.2369 6.84607C11.3046 6.68359 11.3395 6.50932 11.3395 6.3333C11.3395 6.15729 11.3046 5.98301 11.2369 5.82054C11.1692 5.65806 11.07 5.51059 10.9451 5.38664L6.94507 1.38664C6.82468 1.25811 6.68001 1.15471 6.51944 1.0824C6.35886 1.01009 6.18555 0.970311 6.00952 0.965352C5.83348 0.960393 5.65821 0.990355 5.49382 1.05351C5.32942 1.11666 5.17917 1.21176 5.05173 1.33331V1.38664Z" fill="#2A2A2A" />
          </svg>
        </div>
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