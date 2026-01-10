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

    <a class="c-header__shop c-button c-button--shop"
       href="https://store.notos.shop" target="_blank" rel="noopener">
      <span class="c-button__icon" aria-hidden="true">
        <svg class="c-icon c-icon--cart" viewBox="0 0 20 21" aria-hidden="true" focusable="false">
          <path d="M5.9605 20.1065C5.464 20.1065 5.04075 19.9298 4.69075 19.5763C4.34075 19.2227 4.16575 18.7978 4.16575 18.3013C4.16575 17.8048 4.3425 17.3815 4.696 17.0315C5.0495 16.6815 5.4745 16.5065 5.971 16.5065C6.4675 16.5065 6.89075 16.6833 7.24075 17.0367C7.59075 17.3904 7.76575 17.8154 7.76575 18.3118C7.76575 18.8083 7.589 19.2315 7.2355 19.5815C6.882 19.9315 6.457 20.1065 5.9605 20.1065ZM15.9605 20.1065C15.464 20.1065 15.0408 19.9298 14.6908 19.5763C14.3408 19.2227 14.1658 18.7978 14.1658 18.3013C14.1658 17.8048 14.3425 17.3815 14.696 17.0315C15.0495 16.6815 15.4745 16.5065 15.971 16.5065C16.4675 16.5065 16.8908 16.6833 17.2408 17.0367C17.5908 17.3904 17.7658 17.8154 17.7658 18.3118C17.7658 18.8083 17.589 19.2315 17.2355 19.5815C16.882 19.9315 16.457 20.1065 15.9605 20.1065ZM4.77925 3.6065L7.42775 9.10325H14.6098L17.6153 3.6065H4.77925ZM3.9575 1.975H18.511C18.9465 1.975 19.2778 2.17192 19.505 2.56575C19.7322 2.95958 19.7338 3.35542 19.5098 3.75325L16.2365 9.655C16.0452 9.9795 15.7993 10.2416 15.4988 10.4412C15.1984 10.6409 14.8658 10.7408 14.5008 10.7408H6.9685L5.61025 13.275H17.0158C17.2469 13.275 17.4407 13.3535 17.597 13.5105C17.7533 13.6673 17.8315 13.8618 17.8315 14.094C17.8315 14.326 17.7533 14.5194 17.597 14.6742C17.4407 14.8291 17.2469 14.9065 17.0158 14.9065H5.71575C4.98392 14.9065 4.45783 14.6613 4.1375 14.1708C3.81717 13.6801 3.82333 13.1332 4.156 12.53L5.738 9.61575L1.974 1.6315H0.81575C0.584583 1.6315 0.390833 1.553 0.2345 1.396C0.0781667 1.23917 0 1.04467 0 0.8125C0 0.5805 0.0781667 0.387083 0.2345 0.232249C0.390833 0.0774161 0.584583 0 0.81575 0H2.49175C2.66175 0 2.81592 0.0417502 2.95425 0.12525C3.09258 0.208584 3.19333 0.326417 3.2565 0.478751L3.9575 1.975Z" fill="white"/>
        </svg>
      </span>
      <span class="c-button__label">オンラインショップ</span>
    </a>
  </div>
</header>

<main id="main" class="site-main">
