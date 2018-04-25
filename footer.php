<footer>
  <div>
    <div class="wrap flex stretch">
      <div>
        <a href="index.php" title="SherpaBase" rel="home"><!-- --></a>
        <p><?php echo get_bloginfo("description"); ?></p>
      </div>
      <div>
        <nav>
          <ul>
            <li>
              <p><strong><?php echo get_bloginfo("name"); ?></strong></p>
            </li>
            <?php wp_nav_menu( array( 'container' => false, 'menu' => 'header','walker' => new description_walker(),'items_wrap' => '%3$s' ) ); ?>
          </ul>
        </nav>
      </div>
      <div>
        <nav>
          <ul>
            <li>
              <p><strong>Contact us</strong></p>
            </li>
            <li>
              <p><i class="material-icons">&#xE0B0;</i><span>1-800-222-222</span></p>
            </li>
            <li>
              <p><i class="material-icons">&#xE0E1;</i><a mailto="contact@sherpabase.com" title="contact@sherpabase.com">contact@sherpabase.com</a></p>
            </li>
            <li>
              <p><i class="material-icons">&#xE8AE;</i><span>Everyday 9:00 - 17:00</span></p>
            </li>
            <li>
              <p><strong>Follow us</strong></p>
              <ul class="social">
                <li><a href="#" class="zocial-facebook"> <!-- --></a></li>
                <li><a href="#" class="zocial-twitter"> <!-- --></a></li>
                <li><a href="#" class="zocial-linkedin"> <!-- --></a></li>
                <li><a href="#" class="zocial-googleplus"> <!-- --></a></li>
                <li><a href="#" class="zocial-instagram"> <!-- --></a></li>
              </ul>
            </li>
          </ul>
        </nav>
      </div>
      <div>
        <p><strong>Sign up our newsletter</strong></p>
        <form>
          <input type="text"/>
          <button><i class="material-icons">&#xE315;</i></button>
        </form>
      </div>
    </div>
  </div>
  <div>
    <div class="wrap flex">
      <div class="flex50">
        <nav>
          <ul>
            <?php wp_nav_menu( array( 'container' => false, 'menu' => 'header','walker' => new description_walker(),'items_wrap' => '%3$s' ) ); ?>
          </ul>
        </nav>
      </div>
      <div class="flex50">
        <p><?php echo get_bloginfo("name"); ?> . Powered By WordPress, Copyright <?php echo date('Y'); ?> All Right Reserved</p>
      </div>
    </div>
  </div>
  <?php wp_footer(); ?> 
</footer>
</div>
</body>
</html>