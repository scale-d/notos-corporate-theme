<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<a class="skip-link screen-reader-text" href="#main">本文へ移動</a>

<header class="site-header">
  <div class="container site-header__grid">
    <!-- 左：ハンバーガー（モバイル）／ナビ -->
    <button class="site-nav__toggle" aria-controls="primaryMenu" aria-expanded="false" aria-label="メニュー">
      <span></span><span></span><span></span>
    </button>

    <nav class="site-nav" id="primaryMenu" aria-label="<?php esc_attr_e('Primary Menu','notos-corporate'); ?>">
      <?php
        wp_nav_menu([
          'theme_location' => 'primary',
          'container'      => false,
          'menu_class'     => 'site-nav__list',
          'fallback_cb'    => false
        ]);
      ?>
    </nav>

    <!-- 中央：ロゴ -->
    <a class="site-logo" href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php bloginfo('name'); ?>">
      <?php if ( function_exists('the_custom_logo') && has_custom_logo() ) {
        the_custom_logo();
      } else { ?>
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/logo-168x120.png'); ?>"
             alt="<?php bloginfo('name'); ?>" width="84" height="60">
      <?php } ?>
    </a>

    <!-- 右：オンラインショップ -->
    <a class="site-shop btn btn--shop"
       href="https://store.notos.shop" target="_blank" rel="noopener">
      <span class="shop-ico" aria-hidden="true">🛒</span>
      オンラインショップ
    </a>
  </div>
</header>

<main id="main" class="site-main">
