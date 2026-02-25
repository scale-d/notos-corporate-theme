<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<a class="skip-link screen-reader-text" href="#main">本文へ移動</a>

<header class="c-header">
  <div class="c-header__inner">
    <div class="c-header__left">
      <button class="c-header__toggle" aria-controls="primaryMenu" aria-expanded="false" aria-label="メニュー">
        <span class="c-header__bar"></span>
        <span class="c-header__bar"></span>
        <span class="c-header__bar"></span>
      </button>

      <nav class="c-header__nav" id="primaryMenu" aria-label="<?php esc_attr_e('Primary Menu','notos-corporate'); ?>">
        <?php
          wp_nav_menu([
            'theme_location' => 'primary',
            'container'      => false,
            'menu_class'     => 'c-nav__list',
            'fallback_cb'    => false
          ]);
        ?>
      </nav>
    </div>

    <a class="c-header__logo" href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php bloginfo('name'); ?>">
      <img class="c-header__logo-img"
           src="<?php echo esc_url(get_template_directory_uri().'/assets/img/logo-168x120.png'); ?>"
           alt="<?php bloginfo('name'); ?>">
    </a>

    <button class="c-header__shop c-button c-button--shop is-disabled"
            type="button"
            disabled
            aria-disabled="true">
      <span class="c-button__icon" aria-hidden="true">
        <svg class="c-icon c-icon--cart" viewBox="0 0 24 24" role="img" focusable="false" aria-hidden="true">
          <path fill="white" d="M7 18a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm10 0a2 2 0 1 0 .001 4A2 2 0 0 0 17 18ZM6.2 6h13.3l-1.4 7.2a2 2 0 0 1-2 1.6H9a2 2 0 0 1-2-1.6L5.3 4H3V2h3.1a2 2 0 0 1 2 1.6L8.4 6Z"/>
        </svg>
      </span>
      <span class="c-button__label">オンラインストア（準備中）</span>
    </button>
  </div>
</header>

<main id="main" class="site-main">
</file>
</file>
