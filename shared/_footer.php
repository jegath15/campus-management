<footer>
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <!-- Insert website logo -->
          <img src="images/1.jpeg" alt="Website Logo">
          <!-- Display visitor count -->
          <p>CAMPUS MANAGEMENT SYSTEM</p>
          <!-- Display time zone -->
          <p>BIT Sathy, Erode, Tamil Nadu 622214 </p>
        </div>
        <div class="col-md-4">
          <p>Time Zone: <?php
                        date_default_timezone_set('Asia/Kolkata');
                        $current_time = date('D M d Y H:i:s \G\M\TO (T)');
                        echo "<p>$current_time</p>";
                        ?></p>
        </div>
        <div class="col-md-4">
          <div class="footer-links">
           
          <p>follow us on</p>
          </div>
          <div class="social-icons">
            <a href="#"><i class="fab fa-facebook-f facebook"></i></a>
            <a href="#"><i class="fa-brands fa-x-twitter twitter"></i></a>
            <a href="#"><i class="fab fa-instagram instagram"></i></a>
            <a href="#"><i class="fab fa-linkedin-in linked-in"></i></a>
          </div>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-md-12">
          
        </div>
      </div>
    </div>
  </footer>



  <script src="https://kit.fontawesome.com/a81368914c.js"></script>
  <script src="js/bootstrap.bundle.js"></script>
  <script src="./shared/app.js"></script>
  <!-- AI Chatbot -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>ai-chat.css">
  <script src="<?php echo BASE_URL; ?>ai-chat.js"></script>
</body>
</html>
