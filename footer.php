</main>

<footer class="site-footer">
  <div class="container site-footer__inner">
    <div class="footer__brand">
      <?php
      $footer_logo_id = get_theme_mod('notos_footer_logo');
      if ($footer_logo_id) {
        echo wp_get_attachment_image($footer_logo_id, 'footer-logo', false,
          ['alt'=>'NOTOS','class'=>'footer-logo','width'=>370,'height'=>100]);
      } else { ?>
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/footer-logo-370x100.png'); ?>"
             alt="NOTOS" width="370" height="100" class="footer-logo">
      <?php } ?>
      <p class="footer__addr">
        ノトス株式会社 / 〒732-0066 広島市東区牛田本町1-10-17-101
      </p>
    </div>

    <nav class="footer__nav">
      <a href="<?php echo esc_url( home_url('/') ); ?>">トップ</a>
      <a href="<?php echo esc_url( home_url('/#about') ); ?>">Notosについて</a>
      <a href="<?php echo esc_url( home_url('/#brands') ); ?>">取り扱いブランド</a>
      <a href="<?php echo esc_url( home_url('/blog/') ); ?>">ブログ</a>
      <a href="<?php echo esc_url( home_url('/#contact') ); ?>">お問い合わせ</a>
    </nav>
  </div>
  <div class="container footer__copy">
    <small>© <?php echo date('Y'); ?> Notos</small>
  </div>
</footer>

<?php wp_footer(); ?>
</body></html>
