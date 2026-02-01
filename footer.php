</main>

<footer class="c-footer">
  <div class="c-footer__inner">
    <div class="c-footer__top">
      <div class="c-footer__newsletter" id="newsletter">
        <div class="c-footer__logo">
          <?php
          $footer_logo_id = get_theme_mod('notos_footer_logo');
          if ($footer_logo_id) {
            echo wp_get_attachment_image($footer_logo_id, 'footer-logo', false,
              [
                'alt'     => 'NOTOS',
                'class'   => 'c-footer__logo-img',
                'width'   => 370,
                'height'  => 100,
                'sizes'   => '(max-width: 768px) 185px, 370px',
                'loading' => 'lazy',
                'decoding'=> 'async',
              ]);
          } else { ?>
            <?php
              $footer_logo_1x = get_template_directory_uri() . '/assets/img/footer-logo-370x102.png';
              $footer_logo_2x_rel = '/assets/img/footer-logo-740x203.png';
              $footer_logo_2x_path = get_template_directory() . $footer_logo_2x_rel;

              $footer_srcset = esc_url($footer_logo_1x) . ' 370w';
              if (file_exists($footer_logo_2x_path)) {
                $footer_srcset .= ', ' . esc_url(get_template_directory_uri() . $footer_logo_2x_rel) . ' 740w';
              }
            ?>
            <img
              class="c-footer__logo-img"
              src="<?php echo esc_url($footer_logo_1x); ?>"
              srcset="<?php echo esc_attr($footer_srcset); ?>"
              sizes="(max-width: 768px) 185px, 370px"
              alt="NOTOS"
              width="370"
              height="100"
              loading="lazy"
              decoding="async">
          <?php } ?>
        </div>
        <p class="c-footer__lead">
          ニュースレターに登録して最新情報を受け取ろう。
        </p>
        <form class="c-footer__form" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">
          <input type="hidden" name="action" value="notos_newsletter_subscribe">
          <?php wp_nonce_field('notos_newsletter_subscribe', 'notos_newsletter_nonce'); ?>
          <label class="c-footer__field">
            <span class="screen-reader-text">メールアドレス</span>
            <input class="c-footer__input" type="email" name="email" placeholder="メールアドレスを入力" autocomplete="email" required>
          </label>
          <button class="c-footer__button" type="submit">登録</button>
        </form>
        <?php
          $nl = isset($_GET['newsletter']) ? sanitize_text_field(wp_unslash($_GET['newsletter'])) : '';
          if ($nl) {
            $msg = '';
            if ($nl === 'pending') {
              $msg = '確認メールを送りました。メール内のリンクをクリックして登録を完了してください。';
            } elseif ($nl === 'subscribed') {
              $msg = '登録が完了しました。ありがとうございます。';
            } elseif ($nl === 'unsubscribed') {
              $msg = '配信停止を受け付けました。ありがとうございました。';
            } elseif ($nl === 'invalid_email') {
              $msg = 'メールアドレスが正しくありません。';
            } elseif ($nl === 'invalid' || $nl === 'invalid_token') {
              $msg = '処理に失敗しました。もう一度お試しください。';
            }

            if ($msg) {
              echo '<div class="c-footer__message" role="status" aria-live="polite">'
                . '<span class="c-footer__message-text">' . esc_html($msg) . '</span>'
                . '<button class="c-footer__message-close" type="button" aria-label="メッセージを閉じる">×</button>'
                . '</div>';
            }
          }
        ?>
        <p class="c-footer__note">
          登録することでプライバシーポリシーに同意し、更新を受け取ります。
        </p>
      </div>

      <div class="c-footer__links">
        <div class="c-footer__col">
          <p class="c-footer__heading">コンテンツ</p>
          <ul class="c-footer__list">
            <li><a href="<?php echo esc_url( home_url('/#about') ); ?>">Notosについて</a></li>
            <li><a href="<?php echo esc_url( home_url('/#brands') ); ?>">取扱ブランド</a></li>
            <li><a href="<?php echo esc_url( home_url('/blog/') ); ?>">ブログ</a></li>
            <li><a href="<?php echo esc_url( home_url('/#contact') ); ?>">お問い合わせ</a></li>
          </ul>
        </div>
        <div class="c-footer__col">
          <p class="c-footer__heading">フォローする</p>
          <ul class="c-footer__list c-footer__list--social">
            <!--
            <li>
              <a href="#" class="c-footer__social">
                <span class="c-footer__icon" aria-hidden="true">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M22 12.3038C22 6.74719 17.5229 2.24268 12 2.24268C6.47715 2.24268 2 6.74719 2 12.3038C2 17.3255 5.65684 21.4879 10.4375 22.2427V15.2121H7.89844V12.3038H10.4375V10.0872C10.4375 7.56564 11.9305 6.1728 14.2146 6.1728C15.3088 6.1728 16.4531 6.36931 16.4531 6.36931V8.84529H15.1922C13.95 8.84529 13.5625 9.6209 13.5625 10.4166V12.3038H16.3359L15.8926 15.2121H13.5625V22.2427C18.3432 21.4879 22 17.3257 22 12.3038Z" fill="white"/>
                  </svg>
                </span>
                Facebook
              </a>
            </li>
            -->

            <li>
              <a href="#" class="c-footer__social" aria-label="LINE">
                <span class="c-footer__icon" aria-hidden="true">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" focusable="false">
                    <path fill="white" d="M19.9 10.7c0-3.3-3.6-6-8-6s-8 2.7-8 6c0 2.9 2.6 5.3 6.1 5.9.2.1.6.2.7.5.1.2 0 .6 0 .8l-.1.8c0 .2-.1.8.7.4s4.3-2.5 5.8-4.3c1-.3 1.8-.7 2.5-1.2 1.4-1 2.3-2.4 2.3-3.9zm-10.1.7H7.5V10h2.3v1.4zm3.2 0h-2.3V10h2.3v1.4zm3.2 0h-2.3V10h2.3v1.4z"/>
                  </svg>
                </span>
                LINE
              </a>
            </li>
            <li>
              <a href="#" class="c-footer__social">
                <span class="c-footer__icon" aria-hidden="true">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16 3.24268H8C5.23858 3.24268 3 5.48126 3 8.24268V16.2427C3 19.0041 5.23858 21.2427 8 21.2427H16C18.7614 21.2427 21 19.0041 21 16.2427V8.24268C21 5.48126 18.7614 3.24268 16 3.24268ZM19.25 16.2427C19.2445 18.0353 17.7926 19.4872 16 19.4927H8C6.20735 19.4872 4.75549 18.0353 4.75 16.2427V8.24268C4.75549 6.45003 6.20735 4.99817 8 4.99268H16C17.7926 4.99817 19.2445 6.45003 19.25 8.24268V16.2427ZM16.75 8.49268C17.3023 8.49268 17.75 8.04496 17.75 7.49268C17.75 6.9404 17.3023 6.49268 16.75 6.49268C16.1977 6.49268 15.75 6.9404 15.75 7.49268C15.75 8.04496 16.1977 8.49268 16.75 8.49268ZM12 7.74268C9.51472 7.74268 7.5 9.7574 7.5 12.2427C7.5 14.728 9.51472 16.7427 12 16.7427C14.4853 16.7427 16.5 14.728 16.5 12.2427C16.5027 11.0484 16.0294 9.90225 15.1849 9.05776C14.3404 8.21327 13.1943 7.74002 12 7.74268ZM9.25 12.2427C9.25 13.7615 10.4812 14.9927 12 14.9927C13.5188 14.9927 14.75 13.7615 14.75 12.2427C14.75 10.7239 13.5188 9.49268 12 9.49268C10.4812 9.49268 9.25 10.7239 9.25 12.2427Z" fill="white"/>
                  </svg>
                </span>
                Instagram
              </a>
            </li>
            <li>
              <a href="#" class="c-footer__social">
                <span class="c-footer__icon" aria-hidden="true">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M21.5931 7.20301C21.4792 6.78041 21.2566 6.39501 20.9475 6.08518C20.6383 5.77534 20.2534 5.55187 19.8311 5.43701C18.2651 5.00701 12.0001 5.00001 12.0001 5.00001C12.0001 5.00001 5.73609 4.99301 4.16909 5.40401C3.74701 5.52415 3.36291 5.75078 3.05365 6.06214C2.7444 6.3735 2.52037 6.75913 2.40309 7.18201C1.99009 8.74801 1.98609 11.996 1.98609 11.996C1.98609 11.996 1.98209 15.26 2.39209 16.81C2.62209 17.667 3.29709 18.344 4.15509 18.575C5.73709 19.005 11.9851 19.012 11.9851 19.012C11.9851 19.012 18.2501 19.019 19.8161 18.609C20.2386 18.4943 20.6238 18.2714 20.9337 17.9622C21.2436 17.653 21.4675 17.2682 21.5831 16.846C21.9971 15.281 22.0001 12.034 22.0001 12.034C22.0001 12.034 22.0201 8.76901 21.5931 7.20301ZM9.99609 15.005L10.0011 9.00501L15.2081 12.01L9.99609 15.005Z" fill="white"/>
                  </svg>
                </span>
                Youtube
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <div class="c-footer__bottom">
      <div class="c-footer__divider" aria-hidden="true"></div>
      <div class="c-footer__credits">
        <p>© <?php echo date('Y'); ?> Notos. All rights reserved.</p>
        <div class="c-footer__policies">
          <a href="<?php echo esc_url( home_url('/privacy-policy/') ); ?>">プライバシーポリシー</a>
          <a href="<?php echo esc_url(home_url('/terms/')); ?>">サービス利用規約</a>
          <a href="<?php echo esc_url(home_url('/cookie-policy/')); ?>">クッキー設定</a>
        </div>
      </div>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body></html>
