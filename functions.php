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

// モバイル用：ハンバーガーメニュー末尾に「オンラインショップ」を追加
add_filter('wp_nav_menu_items', 'notos_append_shop_menu_item', 10, 2);
function notos_append_shop_menu_item($items, $args){
  if (!isset($args->theme_location) || $args->theme_location !== 'primary') {
    return $items;
  }

  $items .= '<li class="menu-item c-nav__shop-item">'
          . '<a href="https://store.notos.shop" target="_blank" rel="noopener">オンラインショップ</a>'
          . '</li>';
  return $items;
}

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
  wp_enqueue_script('notos-store', get_template_directory_uri().'/assets/js/store-slider.js', [], '0.1.0', true);
});

// ========== Theme Assets: /assets/img へ固定名でアップロード ==========
add_action('admin_menu', function () {
  add_menu_page('Theme Assets', 'Theme Assets', 'manage_options', 'theme-assets', 'notos_theme_assets_admin');
});

function notos_theme_assets_admin() {
  if (!current_user_can('manage_options')) { wp_die('権限がありません'); }

  $assets_dir = get_stylesheet_directory() . '/assets/img';
  if (!file_exists($assets_dir)) { wp_mkdir_p($assets_dir); }

  $message = '';
  if (!empty($_FILES['asset']['name']) && is_uploaded_file($_FILES['asset']['tmp_name'])) {
    // 1) 元のファイル名を採用（uploadsでの -1 リネームを無視する）
    $orig  = sanitize_file_name($_FILES['asset']['name']);
    // 「-1」「-2」など拡張子直前の連番を除去して正規化
    $canon = preg_replace('/-\\d+(?=\\.[^.]+$)/', '', strtolower($orig));

    $dest = $assets_dir . '/' . $canon;

    // 2) 上書き保存（同名があれば削除してから移動）
    @unlink($dest);
    if (@move_uploaded_file($_FILES['asset']['tmp_name'], $dest)) {
      @chmod($dest, 0644);
      $message = 'Uploaded to: ' . esc_html($dest);
    } else {
      $message = 'アップロードに失敗しました（パーミッションを確認）';
    }
  }

  echo '<div class="wrap"><h1>Theme Assets</h1>';
  if ($message) echo '<div class="updated"><p>'.$message.'</p></div>';

  // 3) アップロードフォーム（下に余白を確保）
  echo '<div class="theme-assets-upload" style="margin-bottom:80px">';
  echo '<form method="post" enctype="multipart/form-data">';
  echo '<input type="file" name="asset" accept="image/*" /> ';
  submit_button('Upload to /assets/img/', 'primary', '', false);
  echo '</form>';
  echo '</div>';

  // 4) /assets/img の一覧を表示
  $files = array_values(array_filter(@scandir($assets_dir) ?: [], function($f) use ($assets_dir){
    return $f !== '.' && $f !== '..' && is_file($assets_dir . '/' . $f);
  }));
  sort($files, SORT_NATURAL | SORT_FLAG_CASE);

  echo '<h3>/assets/img のファイル一覧</h3>';
  if (empty($files)) {
    echo '<p>ファイルはまだありません。</p>';
  } else {
    echo '<table class="widefat fixed striped" style="max-width:1000px">';
    echo '<thead><tr>'
       .'<th>ファイル名</th>'
       .'<th>種類</th>'
       .'<th>オーナー/グループ</th>'
       .'<th>パーミッション</th>'
       .'<th>更新日時</th>'
       .'<th style="text-align:right">サイズ</th>'
       .'</tr></thead><tbody>';

    foreach ($files as $f) {
      $path = $assets_dir . '/' . $f;
      $url  = get_stylesheet_directory_uri() . '/assets/img/' . rawurlencode($f);
      $mime = function_exists('mime_content_type') ? @mime_content_type($path) : '';
      $owner = function_exists('posix_getpwuid') ? @posix_getpwuid(@fileowner($path)) : null;
      $group = function_exists('posix_getgrgid') ? @posix_getgrgid(@filegroup($path)) : null;
      $owner_name = $owner && isset($owner['name']) ? $owner['name'] : @fileowner($path);
      $group_name = $group && isset($group['name']) ? $group['name'] : @filegroup($path);
      $perm_str = notos_perm_string($path);
      $size_str = notos_human_bytes(@filesize($path));
      $mtime  = @filemtime($path);
      $date_str = $mtime ? date_i18n('Y-m-d H:i', $mtime) : '';

      echo '<tr>'
        .'<td><a href="'.esc_url($url).'" target="_blank" rel="noopener">'.esc_html($f).'</a></td>'
        .'<td>'.esc_html($mime).'</td>'
        .'<td>'.esc_html($owner_name).' / '.esc_html($group_name).'</td>'
        .'<td><code>'.$perm_str.'</code></td>'
        .'<td>'.esc_html($date_str).'</td>'
        .'<td style="text-align:right">'.$size_str.'</td>'
        .'</tr>';
    }

    echo '</tbody></table>';
  }

  echo '</div>'; // .wrap end
}

// パーミッションを rwxr-xr-x (755) の形式で返す
function notos_perm_string($path){
  $p = @fileperms($path);
  if ($p === false) return '';
  $t = ($p & 0x4000) ? 'd' : '-';
  $map = function($r,$w,$x,$s){ return ($r?'r':'-').($w?'w':'-').($x?($s?'s':'x'):'-');};
  $out = $t
    .$map($p & 0x0100, $p & 0x0080, $p & 0x0040, $p & 0x0800)
    .$map($p & 0x0020, $p & 0x0010, $p & 0x0008, $p & 0x0400)
    .$map($p & 0x0004, $p & 0x0002, $p & 0x0001, $p & 0x0200);
  $oct = substr(sprintf('%o', $p), -4);
  return $out.' ('.$oct.')';
}

// サイズを人間可読に
function notos_human_bytes($bytes){
  $bytes = (int)$bytes;
  if ($bytes < 1024) return $bytes.' B';
  $kb = $bytes/1024; if ($kb < 1024) return number_format($kb,1).' KB';
  $mb = $kb/1024;   if ($mb < 1024) return number_format($mb,1).' MB';
  $gb = $mb/1024;   return number_format($gb,1).' GB';
}

// =========================================================
// Notos Newsletter (no plugin)
// =========================================================

add_action('admin_post_nopriv_notos_newsletter_subscribe', 'notos_newsletter_handle_subscribe');
add_action('admin_post_notos_newsletter_subscribe', 'notos_newsletter_handle_subscribe');

function notos_newsletter_table_name() {
  global $wpdb;
  return $wpdb->prefix . 'notos_newsletter_subscribers';
}

function notos_newsletter_maybe_create_table() {
  global $wpdb;
  $table = notos_newsletter_table_name();
  $charset_collate = $wpdb->get_charset_collate();

  $sql = "CREATE TABLE IF NOT EXISTS {$table} (
    id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    email VARCHAR(190) NOT NULL,
    status VARCHAR(20) NOT NULL DEFAULT 'pending',
    token VARCHAR(64) DEFAULT NULL,
    unsubscribe_token VARCHAR(64) DEFAULT NULL,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY email (email),
    KEY status (status),
    KEY token (token),
    KEY unsubscribe_token (unsubscribe_token)
  ) {$charset_collate};";

  require_once ABSPATH . 'wp-admin/includes/upgrade.php';
  dbDelta($sql);
}

function notos_newsletter_redirect_back($result) {
  $ref = wp_get_referer();
  if (!$ref) {
    $ref = home_url('/');
  }

  // 既存のフラグメント（#...）を除去してから、必ずフッター(#newsletter)へ戻す
  $ref = preg_replace('/#.*$/', '', $ref);
  $url = add_query_arg('newsletter', $result, $ref) . '#newsletter';

  wp_safe_redirect($url);
  exit;
}

function notos_newsletter_handle_subscribe() {
  if (!isset($_POST['notos_newsletter_nonce']) || !wp_verify_nonce($_POST['notos_newsletter_nonce'], 'notos_newsletter_subscribe')) {
    notos_newsletter_redirect_back('invalid');
  }

  $email = isset($_POST['email']) ? sanitize_email(wp_unslash($_POST['email'])) : '';
  if (!$email || !is_email($email)) {
    notos_newsletter_redirect_back('invalid_email');
  }

  notos_newsletter_maybe_create_table();

  global $wpdb;
  $table = notos_newsletter_table_name();
  $now = current_time('mysql');
  $token = wp_hash($email . '|' . wp_generate_password(20, false) . '|' . time());
  $unsub_token = wp_hash('unsub|' . $email . '|' . wp_generate_password(20, false) . '|' . time());

  $existing = $wpdb->get_var($wpdb->prepare("SELECT id FROM {$table} WHERE email = %s LIMIT 1", $email));
  if ($existing) {
    $wpdb->update(
      $table,
      array(
        'status' => 'pending',
        'token' => $token,
        'unsubscribe_token' => $unsub_token,
        'updated_at' => $now,
      ),
      array('id' => (int)$existing),
      array('%s','%s','%s','%s'),
      array('%d')
    );
  } else {
    $wpdb->insert(
      $table,
      array(
        'email' => $email,
        'status' => 'pending',
        'token' => $token,
        'unsubscribe_token' => $unsub_token,
        'created_at' => $now,
        'updated_at' => $now,
      ),
      array('%s','%s','%s','%s','%s','%s')
    );
  }

  // Double opt-in mail (この2つを編集すれば文面を変更できます)
  $confirm_url = add_query_arg('notos_nl_confirm', rawurlencode($token), home_url('/'));
  $unsubscribe_url = add_query_arg('notos_nl_unsub', rawurlencode($unsub_token), home_url('/'));

  $subject = '【Notos】ニュースレター登録の確認';
  $message = "ニュースレターのご登録ありがとうございます。\n\n下記URLをクリックして登録を完了してください。\n" . $confirm_url
    . "\n\n※心当たりがない場合は破棄してください。\n"
    . "\n配信停止はこちら：\n" . $unsubscribe_url;

  wp_mail($email, $subject, $message);

  notos_newsletter_redirect_back('pending');
}

// Confirm endpoint: https://example.com/?notos_nl_confirm=TOKEN
add_action('init', function() {
  if (!isset($_GET['notos_nl_confirm'])) {
    return;
  }

  $token = sanitize_text_field(wp_unslash($_GET['notos_nl_confirm']));
  if (!$token) {
    wp_safe_redirect(add_query_arg('newsletter', 'invalid_token', home_url('/')) . '#newsletter');
    exit;
  }

  notos_newsletter_maybe_create_table();
  global $wpdb;
  $table = notos_newsletter_table_name();

  $row = $wpdb->get_row($wpdb->prepare("SELECT id FROM {$table} WHERE token = %s LIMIT 1", $token));
  if ($row) {
    $wpdb->update(
      $table,
      array('status' => 'subscribed', 'token' => null, 'updated_at' => current_time('mysql')),
      array('id' => (int)$row->id),
      array('%s','%s','%s'),
      array('%d')
    );
    wp_safe_redirect(add_query_arg('newsletter', 'subscribed', home_url('/')) . '#newsletter');
    exit;
  }

  wp_safe_redirect(add_query_arg('newsletter', 'invalid_token', home_url('/')) . '#newsletter');
  exit;
});

// Unsubscribe endpoint: https://example.com/?notos_nl_unsub=TOKEN
add_action('init', function() {
  if (!isset($_GET['notos_nl_unsub'])) {
    return;
  }

  $token = sanitize_text_field(wp_unslash($_GET['notos_nl_unsub']));
  if (!$token) {
    wp_safe_redirect(add_query_arg('newsletter', 'invalid_token', home_url('/')) . '#newsletter');
    exit;
  }

  notos_newsletter_maybe_create_table();
  global $wpdb;
  $table = notos_newsletter_table_name();

  $row = $wpdb->get_row($wpdb->prepare("SELECT id FROM {$table} WHERE unsubscribe_token = %s LIMIT 1", $token));
  if ($row) {
    $wpdb->update(
      $table,
      array('status' => 'unsubscribed', 'updated_at' => current_time('mysql')),
      array('id' => (int)$row->id),
      array('%s','%s'),
      array('%d')
    );
    wp_safe_redirect(add_query_arg('newsletter', 'unsubscribed', home_url('/')) . '#newsletter');
    exit;
  }

  wp_safe_redirect(add_query_arg('newsletter', 'invalid_token', home_url('/')) . '#newsletter');
  exit;
});

// Optional SMTP without plugin (set constants in wp-config.php)
add_action('phpmailer_init', function($phpmailer) {
  if (!defined('NOTOS_SMTP_HOST') || !NOTOS_SMTP_HOST) {
    return;
  }

  $phpmailer->isSMTP();
  $phpmailer->Host = NOTOS_SMTP_HOST;
  $phpmailer->Port = defined('NOTOS_SMTP_PORT') ? (int)NOTOS_SMTP_PORT : 587;
  $phpmailer->SMTPAuth = true;
  $phpmailer->Username = defined('NOTOS_SMTP_USER') ? NOTOS_SMTP_USER : '';
  $phpmailer->Password = defined('NOTOS_SMTP_PASS') ? NOTOS_SMTP_PASS : '';
  $phpmailer->SMTPSecure = 'tls';

  if (defined('NOTOS_SMTP_FROM') && NOTOS_SMTP_FROM) {
    $from_name = defined('NOTOS_SMTP_FROM_NAME') ? NOTOS_SMTP_FROM_NAME : 'Notos';
    $phpmailer->setFrom(NOTOS_SMTP_FROM, $from_name, false);
  }
});

// Admin: Tools -> Notos Newsletter (use management page for reliability)
add_action('admin_menu', 'notos_newsletter_register_admin_menu', 99);

function notos_newsletter_register_admin_menu() {
  add_management_page(
    'Notos Newsletter',
    'Notos Newsletter',
    'manage_options',
    'notos-newsletter',
    'notos_newsletter_admin_page'
  );
}

function notos_newsletter_admin_page() {
  if (!current_user_can('manage_options')) {
    return;
  }

  notos_newsletter_maybe_create_table();
  global $wpdb;
  $table = notos_newsletter_table_name();

  // CSV export
  if (isset($_GET['export']) && $_GET['export'] === 'csv') {
    $rows = $wpdb->get_results("SELECT email, status, created_at, updated_at FROM {$table} ORDER BY id DESC", ARRAY_A);
    header('Content-Type: text/csv; charset=UTF-8');
    header('Content-Disposition: attachment; filename="notos-newsletter-subscribers.csv"');
    echo "email,status,created_at,updated_at\n";
    foreach ($rows as $r) {
      echo sprintf("%s,%s,%s,%s\n",
        str_replace(',', ' ', $r['email']),
        $r['status'],
        $r['created_at'],
        $r['updated_at']
      );
    }
    exit;
  }

  $count = (int) $wpdb->get_var("SELECT COUNT(*) FROM {$table} WHERE status='subscribed'");
  $pending = (int) $wpdb->get_var("SELECT COUNT(*) FROM {$table} WHERE status='pending'");

  echo '<div class="wrap">';
  echo '<h1>Notos Newsletter</h1>';
  echo '<p>購読中: ' . esc_html($count) . ' / 確認待ち: ' . esc_html($pending) . '</p>';
  echo '<p><a class="button button-primary" href="' . esc_url(add_query_arg('export','csv')) . '">CSVエクスポート</a></p>';

  // Simple bulk send (for small lists)
  $notice = '';
  if (isset($_POST['notos_nl_send_nonce']) && wp_verify_nonce($_POST['notos_nl_send_nonce'], 'notos_nl_send')) {
    $subject = isset($_POST['subject']) ? sanitize_text_field(wp_unslash($_POST['subject'])) : '';
    $body    = isset($_POST['body']) ? sanitize_textarea_field(wp_unslash($_POST['body'])) : '';
    $mode    = isset($_POST['mode']) ? sanitize_text_field(wp_unslash($_POST['mode'])) : 'test';

    if (!$subject || !$body) {
      $notice = '件名と本文を入力してください。';
    } else {
      // collect recipients
      if ($mode === 'all') {
        $recipients = $wpdb->get_col("SELECT email FROM {$table} WHERE status='subscribed' ORDER BY id DESC LIMIT 200");
      } else {
        $recipients = array(wp_get_current_user()->user_email);
      }

      $sent = 0;
      foreach ($recipients as $email) {
        $email = sanitize_email($email);
        if (!$email || !is_email($email)) continue;

        // Unsubscribe URL for this recipient
        $unsub_token = $wpdb->get_var($wpdb->prepare("SELECT unsubscribe_token FROM {$table} WHERE email=%s LIMIT 1", $email));
        $unsubscribe_url = $unsub_token ? add_query_arg('notos_nl_unsub', rawurlencode($unsub_token), home_url('/')) : home_url('/');

        $mail_body = $body . "\n\n---\n配信停止はこちら：\n" . $unsubscribe_url;

        $headers = array('Content-Type: text/plain; charset=UTF-8');
        $headers[] = 'List-Unsubscribe: <' . $unsubscribe_url . '>';

        if (wp_mail($email, $subject, $mail_body, $headers)) {
          $sent++;
        }
      }

      $notice = ($mode === 'all')
        ? '送信完了（最大200件まで）：' . $sent . ' 件'
        : 'テスト送信しました：' . $sent . ' 件';
    }
  }

  if ($notice) {
    echo '<div class="notice notice-info"><p>' . esc_html($notice) . '</p></div>';
  }

  echo '<h2>一斉配信（簡易）</h2>';
  echo '<p>※まずは小規模運用向け（最大200件）。大量配信は外部サービス推奨。</p>';
  echo '<form method="post" style="max-width:900px">';
  wp_nonce_field('notos_nl_send', 'notos_nl_send_nonce');
  echo '<table class="form-table"><tbody>';
  echo '<tr><th scope="row"><label for="nl-subject">件名</label></th><td><input id="nl-subject" name="subject" type="text" class="regular-text" value="" /></td></tr>';
  echo '<tr><th scope="row"><label for="nl-body">本文</label></th><td><textarea id="nl-body" name="body" rows="10" class="large-text" placeholder="本文を入力"></textarea></td></tr>';
  echo '<tr><th scope="row">送信モード</th><td>'
      . '<label><input type="radio" name="mode" value="test" checked> 自分にテスト送信</label><br>'
      . '<label><input type="radio" name="mode" value="all"> 購読者全員に送信（最大200件）</label>'
      . '</td></tr>';
  echo '</tbody></table>';
  submit_button('送信');
  echo '</form>';

  $rows = $wpdb->get_results("SELECT email, status, created_at, updated_at FROM {$table} ORDER BY id DESC LIMIT 200", ARRAY_A);
  echo '<table class="widefat striped"><thead><tr><th>Email</th><th>Status</th><th>Created</th><th>Updated</th></tr></thead><tbody>';
  foreach ($rows as $r) {
    echo '<tr>';
    echo '<td>' . esc_html($r['email']) . '</td>';
    echo '<td>' . esc_html($r['status']) . '</td>';
    echo '<td>' . esc_html($r['created_at']) . '</td>';
    echo '<td>' . esc_html($r['updated_at']) . '</td>';
    echo '</tr>';
  }
  echo '</tbody></table>';
  echo '</div>';
}

/**
 * Google Analytics (GA4) gtag.js
 * - Put as early as possible in <head> via wp_head with priority 0.
 */
add_action('wp_head', function () {
  $ga_id = 'G-67W81R5QJ9';
  ?>
  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr($ga_id); ?>"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', '<?php echo esc_js($ga_id); ?>');
  </script>
  <?php
}, 0);