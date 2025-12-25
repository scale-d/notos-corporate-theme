<?php
add_action('after_setup_theme', function () {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('html5', ['search-form','comment-form','comment-list','gallery','caption']);
  register_nav_menus(['primary' => __('Primary Menu','notos-corporate')]);
  // ヘッダーロゴ（サイトロゴ）
  add_theme_support('custom-logo', [
    'height'      => 60,          // 推奨の高さ（ピクセル）…“表示サイズ”ではなく、アップ時の目安
    'flex-width'  => true,        // 幅は固定しない（自由にOK）
    'flex-height' => true,        // 高さも固定しない（自由にOK）
  ]);
  // フッターロゴ（カスタマイザー）
  add_image_size('footer-logo', 370, 100, false);
});

add_action('customize_register', function($wp_customize){
  $wp_customize->add_section('notos_branding', [
    'title' => 'ブランド（フッターロゴ）', 'priority' => 30,
  ]);
  $wp_customize->add_setting('notos_footer_logo', ['default'=>0, 'sanitize_callback'=>'absint']);
  $wp_customize->add_control(new WP_Customize_Media_Control(
    $wp_customize, 'notos_footer_logo', [
      'label' => 'フッターロゴ（PNG推奨・白版）', 'section'=>'notos_branding', 'mime_type'=>'image'
    ]
  ));
});

// CSS/JS 読み込み（tokens.cssを最優先で読み込み）
add_action('wp_enqueue_scripts', function () {
  wp_enqueue_style('notos-tokens', get_template_directory_uri().'/assets/css/tokens.css', [], '0.1.0');
  wp_enqueue_style('notos-base', get_stylesheet_uri(), ['notos-tokens'], '0.1.0');
  wp_enqueue_style('notos-main', get_template_directory_uri().'/assets/css/main.css', ['notos-base'], '0.1.0');
  wp_enqueue_script('notos-nav', get_template_directory_uri().'/assets/js/nav.js', [], '0.1.0', true);
  // 必要になったらJSも：wp_enqueue_script('notos-js', get_template_directory_uri().'/assets/js/main.js', [], '0.1.0', true);
});
// 管理画面メニューに「Theme Assets」追加
add_action('admin_menu', function(){
  add_menu_page('Theme Assets', 'Theme Assets', 'manage_options', 'theme-assets', function(){
    if (!current_user_can('manage_options')) return;

    if (!empty($_FILES['asset']['name'])) {
      require_once ABSPATH.'wp-admin/includes/file.php';
      $file = wp_handle_upload($_FILES['asset'], ['test_form'=>false]);
      if (empty($file['error'])) {
        $dest = get_stylesheet_directory().'/assets/img/'.basename($file['file']);
        if (@copy($file['file'], $dest)) {
          @unlink($file['file']);
          echo '<div class="updated"><p>Uploaded to: '.esc_html($dest).'</p></div>';
        } else {
          echo '<div class="error"><p>コピーに失敗しました（権限を確認）</p></div>';
        }
      } else {
        echo '<div class="error"><p>'.esc_html($file['error']).'</p></div>';
      }
    }
    echo '<div class="wrap"><h1>Theme Assets</h1>
      <form method="post" enctype="multipart/form-data">
        <input type="file" name="asset" accept="image/*" />
        <button class="button button-primary">Upload to /assets/img/</button>
      </form></div>';
  });
});
