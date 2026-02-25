<?php /* Front Page */ get_header(); ?>

<section class="c-hero" style="--hero-bg: url('<?php echo esc_url(get_template_directory_uri().'/assets/img/hero-sec.webp'); ?>');">
  <div class="c-hero__stars" aria-hidden="true"></div>
  <div class="c-hero__dawn" aria-hidden="true"></div>
  <div class="c-hero__inner">
    <div class="c-hero__logo">
      <?php
        $hero_logo_1x = get_template_directory_uri() . '/assets/img/hero-logo-560x154.png';
        $hero_logo_2x_rel = '/assets/img/hero-logo-1120x307.png';
        $hero_logo_2x_path = get_template_directory() . $hero_logo_2x_rel;

        $hero_srcset = esc_url($hero_logo_1x) . ' 560w';
        if (file_exists($hero_logo_2x_path)) {
          $hero_srcset .= ', ' . esc_url(get_template_directory_uri() . $hero_logo_2x_rel) . ' 1120w';
        }
      ?>
      <img
        class="c-hero__logo-img"
        src="<?php echo esc_url($hero_logo_1x); ?>"
        srcset="<?php echo esc_attr($hero_srcset); ?>"
        sizes="(max-width: 768px) 60vw, 560px"
        width="560"
        height="153"
        alt="<?php bloginfo('name'); ?>"
        loading="eager"
        decoding="async">
    </div>
    <div class="c-hero__content">
      <h1 class="c-hero__title">3月5日、広島市牛田エリアにOPEN</h1>
      <p class="c-hero__lead">ハイキング・トレイルランニング・渓流釣り・スノーアクティビティ、etc..</p>
    </div>

  </div>

  <div class="c-hero__scroll-indicator" aria-hidden="true">
    <div class="c-hero__scroll-mouse">
      <span class="c-hero__scroll-wheel"></span>
    </div>
  </div>
</section>

<section class="c-store">
  <div class="c-store__inner">
    <div class="c-store__top">
      <div class="c-store__content">
        <h2 class="c-store__title">
          3月5日(木)、広島市牛田エリアにアウトドア用品のセレクトショップ "Notos/ノトス" がOPEN！
        </h2>
        <p class="c-store__lead">
          ハイキング・トレイルランニング・渓流釣り・スノーアクティビティなど、都市生活の延長線上にある“日常的アウトドア”のスタイルを提案するショップ「Notos/ノトス」です。<br><br>
          広島の特徴である市街地からの「自然へのアクセスの良さ」を活かし、日帰りでも楽しめる気軽なアウトドアの魅力を発信してまいります。<br>
        </p>
        <div class="c-store__info">
          <div class="c-store__slider js-store-slider" aria-label="店舗写真スライダー">
            <div class="c-store__slider-viewport">
              <?php
                // assets/img/store-photo-01.jpg のように「store-photo-」で始まる画像を置くと自動でスライド化されます
                $store_photo_paths = glob(get_template_directory() . '/assets/img/store/photos/store-photo-*.*') ?: [];
                natsort($store_photo_paths);
                $store_photo_paths = array_values($store_photo_paths);

                $store_photo_count = 0;

                foreach ($store_photo_paths as $abs_path) {
                  $rel = str_replace(get_template_directory(), '', $abs_path); // "/assets/img/..."
                  $url = get_template_directory_uri() . $rel;

                  $is_active = ($store_photo_count === 0) ? ' is-active' : '';
                  $store_photo_count++;
                  ?>
                  <div class="c-store__slide<?php echo $is_active; ?>">
                    <img
                      src="<?php echo esc_url($url); ?>"
                      alt="<?php echo esc_attr('Notos 店舗写真 ' . $store_photo_count); ?>"
                      loading="lazy"
                      decoding="async">
                  </div>
                  <?php
                }

                if ($store_photo_count === 0) :
              ?>
                <div class="c-store__slider-empty">店舗写真（準備中）</div>
              <?php endif; ?>
            </div>

            <button class="c-store__slider-arrow is-prev" type="button" aria-label="前の写真">
              <svg viewBox="0 0 24 24" role="img" focusable="false" aria-hidden="true">
                <path fill="currentColor" d="m15 5.5-7.9 7.9 7.9 7.9L16.4 20 9.5 13.4 16.4 6.5 15 5.5Z"/>
              </svg>
            </button>

            <button class="c-store__slider-arrow is-next" type="button" aria-label="次の写真">
              <svg viewBox="0 0 24 24" role="img" focusable="false" aria-hidden="true">
                <path fill="currentColor" d="M9 5.5 15.5 12 9 18.5l1.4 1.4 7.9-7.9-7.9-7.9L9 5.5Z"/>
              </svg>
            </button>

            <div class="c-store__slider-dots" aria-label="店舗写真のページャー"></div>
          </div>

          <div class="c-store__info-list">
            <div class="c-store__info-row">
              <span class="c-store__info-label">住所</span>
              <p class="c-store__info-text">〒732-0066<br>広島市東区牛田本町 1-10-17 1F</p>
            </div>
            <div class="c-store__info-row">
              <span class="c-store__info-label">TEL</span>
              <p class="c-store__info-text">082-555-4580</p>
            </div>
            <div class="c-store__info-row">
              <span class="c-store__info-label">営業時間</span>
              <p class="c-store__info-text">12:00 - 20:00</p>
            </div>
            <div class="c-store__info-row">
              <span class="c-store__info-label">定休日</span>
              <p class="c-store__info-text">水曜日</p>
            </div>
            <div class="c-store__info-row">
              <span class="c-store__info-label">駐車場</span>
              <p class="c-store__info-text">３台</p>
            </div>

            <?php
            // ===== Store calendar (current month + next month) =====
            // ✅ 月替わりは自動（毎月コード変更不要）
            // Customize:
            // - Weekly closed day: $weekly_closed_wday (0=Sun ... 6=Sat)
            // - Temporary closures: $closed_dates に 'YYYY-MM-DD'
            // - Events: $events に 'YYYY-MM-DD' => 'イベント名'
            $weekly_closed_wday = 3; // 水曜日（0=日, 1=月, 2=火, 3=水...）

            // 臨時休業（例）
            $closed_dates = [
              // '2026-03-20',
            ];

            // イベント（例）
            $events = [
              // '2026-03-05' => 'OPEN',
            ];

            $tz = wp_timezone();
            $now = new DateTimeImmutable('now', $tz);
            $this_month = $now->modify('first day of this month')->setTime(0, 0);
            $next_month = $this_month->modify('+1 month');

            $render_month = function (DateTimeImmutable $month_start) use ($weekly_closed_wday, $closed_dates, $events) {
              $y = (int) $month_start->format('Y');
              $m = (int) $month_start->format('n');
              $label = sprintf('%d年 %02d月', $y, $m);

              $first_wday = (int) $month_start->format('w'); // 0=Sun
              $days_in_month = (int) $month_start->format('t');

              $html = '';
              $html .= '<div class="c-store__month">';
              $html .= '<div class="c-store__month-title">' . esc_html($label) . '</div>';
              $html .= '<table class="c-store__calendar-table" role="grid">';
              $html .= '<thead><tr>';
              foreach (['日', '月', '火', '水', '木', '金', '土'] as $i => $wd) {
                $th_class = ($i === 0) ? ' is-sun' : (($i === 6) ? ' is-sat' : '');
                $html .= '<th scope="col" class="c-store__calendar-th' . $th_class . '">' . esc_html($wd) . '</th>';
              }
              $html .= '</tr></thead><tbody>';

              $day = 1;
              $weeks = (int) ceil(($first_wday + $days_in_month) / 7);

              for ($w = 0; $w < $weeks; $w++) {
                $html .= '<tr>';
                for ($d = 0; $d < 7; $d++) {
                  $cell_index = $w * 7 + $d;

                  if ($cell_index < $first_wday || $day > $days_in_month) {
                    $html .= '<td class="c-store__calendar-td is-empty" aria-hidden="true"></td>';
                    continue;
                  }

                  $date = sprintf('%04d-%02d-%02d', $y, $m, $day);
                  $is_closed = ($d === (int) $weekly_closed_wday) || in_array($date, $closed_dates, true);
                  $is_event = array_key_exists($date, $events);

                  $classes = 'c-store__calendar-td';
                  if ($d === 0) $classes .= ' is-sun';
                  if ($d === 6) $classes .= ' is-sat';

                  // 店休日を優先（イベント色で上書きしない）
                  if ($is_closed) {
                    $classes .= ' is-closed';
                  } elseif ($is_event) {
                    $classes .= ' is-event';
                  }

                  $aria = $date;
                  if ($is_closed) $aria .= ' 店休日';
                  if ($is_event) $aria .= ' ' . $events[$date];

                  $html .= '<td class="' . esc_attr($classes) . '">';
                  $html .= '<span class="c-store__calendar-day" aria-label="' . esc_attr($aria) . '">' . esc_html((string) $day) . '</span>';
                  $html .= '</td>';

                  $day++;
                }
                $html .= '</tr>';
              }

              $html .= '</tbody></table>';
              $html .= '<div class="c-store__calendar-legend">'
                . '<span class="c-store__legend-item"><span class="c-store__legend-swatch is-closed" aria-hidden="true"></span><span class="c-store__legend-text">店休日</span></span>'
                . '<span class="c-store__legend-item"><span class="c-store__legend-swatch is-event" aria-hidden="true"></span><span class="c-store__legend-text">イベント</span></span>'
                . '</div>';
              $html .= '</div>';

              return $html;
            };
          ?>

          <div class="c-store__calendar" aria-label="営業カレンダー">
            <div class="c-store__calendar-grid">
              <?php echo $render_month($this_month); ?>
              <?php echo $render_month($next_month); ?>
            </div>
          </div>

          </div>
        </div>
        <div class="c-store__social">
          <a class="c-store__card" href="#">
            <div class="c-store__card-text">
              <p class="c-store__card-title">Online Store（準備中）</p>
              <p class="c-store__card-sub">オンラインストア</p>
            </div>
            <span class="c-store__card-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24" role="img" focusable="false" aria-hidden="true">
                <path fill="currentColor" d="M7 18a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm10 0a2 2 0 1 0 .001 4A2 2 0 0 0 17 18ZM6.2 6h13.3l-1.4 7.2a2 2 0 0 1-2 1.6H9a2 2 0 0 1-2-1.6L5.3 4H3V2h3.1a2 2 0 0 1 2 1.6L8.4 6Z"/>
              </svg>
            </span>
          </a>
          <?php /*
          
          Facebook（将来用）
          
          <a class="c-store__card" href="#">
            <div class="c-store__card-text">
              <p class="c-store__card-title">FACEBOOK Page</p>
              <p class="c-store__card-sub">フェイスブック　ページ</p>
            </div>
            <span class="c-store__card-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24" role="img" focusable="false" aria-hidden="true">
                <path fill="currentColor" d="M13 9V7c0-.6.4-1 1-1h2V3h-3c-2.2 0-4 1.8-4 4v2H7v3h2v9h3v-9h2.6l.4-3H12Z"/>
              </svg>
            </span>
          </a>

          */ ?>
          <a class="c-store__card" href="YOUR_LINE_URL_HERE" target="_blank" rel="noopener noreferrer">
            <div class="c-store__card-text">
              <p class="c-store__card-title">LINE</p>
              <p class="c-store__card-sub">ライン</p>
            </div>
            <span class="c-store__card-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24" role="img" focusable="false" aria-hidden="true">
                <!-- chat bubble icon (generic) -->
                <path fill="currentColor" d="M12 3C6.98 3 3 6.58 3 11c0 2.26 1.04 4.3 2.73 5.73L5 21l4.58-2.05c.78.17 1.59.26 2.42.26 5.02 0 9-3.58 9-8s-3.98-8-9-8Zm0 14.2c-.78 0-1.54-.08-2.26-.24l-.55-.12-2.16.97.35-2.05-.41-.33C5.55 14.36 4.8 12.74 4.8 11c0-3.43 3.19-6.2 7.2-6.2s7.2 2.77 7.2 6.2-3.19 6.2-7.2 6.2Z"/>
                <path fill="currentColor" d="M8 11.8h8v1.4H8z"/>
                <path fill="currentColor" d="M8 8.9h8v1.4H8z"/>
              </svg>
            </span>
          </a>
          <a class="c-store__card" href="https://www.instagram.com/notos.hiroshima/" target="_blank" rel="noopener noreferrer" aria-label="InstagramでNotosをフォローする">
            <div class="c-store__card-text">
              <p class="c-store__card-title">INSTAGRAM</p>
              <p class="c-store__card-sub">インスタグラム</p>
            </div>
            <span class="c-store__card-icon" aria-hidden="true">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" focusable="false" aria-hidden="true">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M16 3.24268H8C5.23858 3.24268 3 5.48126 3 8.24268V16.2427C3 19.0041 5.23858 21.2427 8 21.2427H16C18.7614 21.2427 21 19.0041 21 16.2427V8.24268C21 5.48126 18.7614 3.24268 16 3.24268ZM19.25 16.2427C19.2445 18.0353 17.7926 19.4872 16 19.4927H8C6.20735 19.4872 4.75549 18.0353 4.75 16.2427V8.24268C4.75549 6.45003 6.20735 4.99817 8 4.99268H16C17.7926 4.99817 19.2445 6.45003 19.25 8.24268V16.2427ZM16.75 8.49268C17.3023 8.49268 17.75 8.04496 17.75 7.49268C17.75 6.9404 17.3023 6.49268 16.75 6.49268C16.1977 6.49268 15.75 6.9404 15.75 7.49268C15.75 8.04496 16.1977 8.49268 16.75 8.49268ZM12 7.74268C9.51472 7.74268 7.5 9.7574 7.5 12.2427C7.5 14.728 9.51472 16.7427 12 16.7427C14.4853 16.7427 16.5 14.728 16.5 12.2427C16.5027 11.0484 16.0294 9.90225 15.1849 9.05776C14.3404 8.21327 13.1943 7.74002 12 7.74268ZM9.25 12.2427C9.25 13.7615 10.4812 14.9927 12 14.9927C13.5188 14.9927 14.75 13.7615 14.75 12.2427C14.75 10.7239 13.5188 9.49268 12 9.49268C10.4812 9.49268 9.25 10.7239 9.25 12.2427Z" fill="#00568d"/>
              </svg>
            </span>
          </a>
          <a class="c-store__card" href="https://www.youtube.com/@notos_hiroshima" target="_blank" rel="noopener noreferrer" aria-label="YoutubeでNotosをフォローする">
            <div class="c-store__card-text">
              <p class="c-store__card-title">YOUTUBE</p>
              <p class="c-store__card-sub">ユーチューブ</p>
            </div>
            <span class="c-store__card-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24" role="img" focusable="false" aria-hidden="true">
                <path fill="currentColor" d="M22 7.6a3 3 0 0 0-2.1-2.1C18.1 5 12 5 12 5s-6.1 0-7.9.5A3 3 0 0 0 2 7.6 31 31 0 0 0 2 12a31 31 0 0 0 .1 4.4 3 3 0 0 0 2.1 2.1C5.9 19 12 19 12 19s6.1 0 7.9-.5a3 3 0 0 0 2.1-2.1A31 31 0 0 0 22 12a31 31 0 0 0-.1-4.4ZM10 15.5v-7l6 3.5Z"/>
              </svg>
            </span>
          </a>
        </div>
        <script>
          document.addEventListener('DOMContentLoaded', function(){
            document.querySelectorAll('.js-store-slider').forEach(function(root){
              const slides = Array.from(root.querySelectorAll('.c-store__slide'));
              if (slides.length === 0) {
                root.querySelectorAll('.c-store__slider-arrow, .c-store__slider-dots')
                  .forEach(el => el.style.display = 'none');
                return;
              }

              const prev = root.querySelector('.c-store__slider-arrow.is-prev');
              const next = root.querySelector('.c-store__slider-arrow.is-next');
              const dotsWrap = root.querySelector('.c-store__slider-dots');

              let index = 0;

              function buildDots(){
                if (!dotsWrap) return;
                dotsWrap.innerHTML = '';
                slides.forEach(function(_, i){
                  const b = document.createElement('button');
                  b.type = 'button';
                  b.className = 'c-store__slider-dot';
                  b.setAttribute('aria-label', (i + 1) + '枚目');
                  b.addEventListener('click', function(){ show(i); });
                  dotsWrap.appendChild(b);
                });
              }

              function show(i){
                index = (i + slides.length) % slides.length;
                slides.forEach(function(s, idx){ s.classList.toggle('is-active', idx === index); });

                if (dotsWrap){
                  Array.from(dotsWrap.querySelectorAll('.c-store__slider-dot')).forEach(function(d, idx){
                    d.classList.toggle('is-active', idx === index);
                  });
                }
              }

              function toggleControls(){
                const multi = slides.length > 1;
                if (prev) prev.style.display = multi ? '' : 'none';
                if (next) next.style.display = multi ? '' : 'none';
                if (dotsWrap) dotsWrap.style.display = multi ? '' : 'none';
              }

              prev && prev.addEventListener('click', function(){ show(index - 1); });
              next && next.addEventListener('click', function(){ show(index + 1); });

              buildDots();
              toggleControls();
              show(0);
            });
          });
        </script>
      </div>
      <!-- Instagram media block moved below the map -->
    </div>
    <div class="c-store__map">
      <div id="notos-map" class="c-store__map-canvas"
           data-lat="34.40829191003846" data-lng="132.47143820238895" data-map-id="ff7fd07d411a9bb4806cea65"></div>
      <noscript>
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/store-map-1400x329.jpg'); ?>" alt="">
      </noscript>
    </div>

    <div class="c-store__media c-store__media--after-map">
      <div class="c-store__photo c-store__photo--instagram">
        <div class="c-store__ig-wrap">
          <div class="c-store__ig-feed">
            <?php echo do_shortcode('[instagram-feed feed=1]'); ?>
          </div>
          <div class="c-store__ig-feed">
            <?php echo do_shortcode('[instagram-feed feed=3]'); ?>
          </div>
        </div>
      </div>
    </div>

<script>
  document.addEventListener('DOMContentLoaded', function(){
    const el = document.getElementById('notos-map');
    if(!el) return;

    const lat = parseFloat(el.dataset.lat) || 34.40829191003846;
    const lng = parseFloat(el.dataset.lng) || 132.47143820238895;
    const mapId = el.dataset.mapId || 'ff7fd07d411a9bb4806cea65';    // Cloud ConsoleのMap IDに置換

    function init(){
      const gmapsUrl = <?php echo wp_json_encode('https://www.google.com/maps/place/Notos+(%E3%83%8E%E3%83%88%E3%82%B9)/@34.4082814,132.4688398,17z/data=!4m15!1m8!3m7!1s0x355a99f5c8bc3abf:0x6c77d91f2891dad6!2zTm90b3MgKOODjuODiOOCuSk!8m2!3d34.408277!4d132.4714201!10e1!16s%2Fg%2F11ymzl41tn!3m5!1s0x355a99f5c8bc3abf:0x6c77d91f2891dad6!8m2!3d34.408277!4d132.4714201!16s%2Fg%2F11ymzl41tn?authuser=0&entry=ttu&g_ep=EgoyMDI2MDEyOC4wIKXMDSoASAFQAw%3D%3D'); ?>;
      const map = new google.maps.Map(el, {
        // マップの中心を少し南にずらして、吹き出し（目的地）を上寄せにする
        center: {lat: lat - 0.0045, lng: lng},
        zoom: 15,
        mapId: mapId,
        disableDefaultUI: false
      });

      // カスタム吹き出し（CSSバブル＋ロゴ配置OverlayView）
      class NotosTooltip extends google.maps.OverlayView {
        constructor(position, imageUrl){
          super(); this.position = position; this.imageUrl = imageUrl; this.div = null;
        }
        onAdd(){
          this.div = document.createElement('div');
          this.div.style.position = 'absolute';
          this.div.style.transform = 'translate(-50%, calc(-100% - 10px))';
          this.div.style.pointerEvents = 'auto';
          this.div.style.zIndex = '100';
          // CSSで吹き出しを描画し、その中にロゴを配置（クリックでGoogleマップへ）
          const link = document.createElement('a');
          link.className = 'map-bubble';
          link.href = gmapsUrl;
          link.target = '_blank';
          link.rel = 'noopener noreferrer';
          link.title = 'GoogleマップでNotosを開く';
          link.setAttribute('aria-label', 'GoogleマップでNotosを開く');

          const logo = new Image();
          logo.src = '<?php echo esc_url(get_template_directory_uri().'/assets/img/map-logo-84x36.png'); ?>';
          logo.alt = '<?php bloginfo('name'); ?>';
          logo.className = 'map-bubble__logo';

          link.appendChild(logo);
          this.div.appendChild(link);
          this.getPanes().overlayImage.appendChild(this.div);
        }
        draw(){
          const proj = this.getProjection();
          const p = proj.fromLatLngToDivPixel(this.position);
          if (this.div){ this.div.style.left = p.x + 'px'; this.div.style.top = p.y + 'px'; }
        }
        onRemove(){
          if (this.div && this.div.parentNode){ this.div.parentNode.removeChild(this.div); }
          this.div = null;
        }
      }

      const pos = new google.maps.LatLng(lat, lng);
      const overlay = new NotosTooltip(pos);
      overlay.setMap(map);
    }

    // API を動的読込（既に読み込み済みならそのまま初期化）
    if (window.google && window.google.maps) { init(); }
    else {
      // 遅延ロード：地図がビューポートに入ったら API を読み込む
      const loadApi = () => {
        const s = document.createElement('script');
        s.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDrKI5MRjPplR4v4bfJ1dYlUUZvRVwOgaA&v=weekly';
        s.async = true;
        s.defer = true;
        s.onload = init;
        document.head.appendChild(s);
      };

      if ('IntersectionObserver' in window && el) {
        const io = new IntersectionObserver(entries => {
          if (entries[0].isIntersecting) {
            io.disconnect();
            loadApi();
          }
        }, { rootMargin: '200px' }); // 手前でプリロード
        io.observe(el);
      } else {
        // フォールバック：IO未対応ブラウザは即読み込み
        loadApi();
      }
    }
  });
</script>
  </div>
</section>

<section class="c-blog" id="blog">
  <div class="c-blog__inner">
    <div class="c-blog__header">
      <div class="c-blog__title">
        <p class="c-blog__tagline">ブログ</p>
        <h2 class="c-blog__headline">City Life, Mountain Soul. </h2>
        <p class="c-blog__sub">お店のこと、山行のこと、日々のこと。</p>
      </div>
      <a class="c-blog__all" href="<?php echo esc_url( home_url('/blog/') ); ?>">View all</a>
    </div>
    <div class="c-blog__list" id="blogList">
      <?php
      $q = new WP_Query([
        'post_type'      => 'post',
        'posts_per_page' => 10,
        'post_status'    => 'publish'
      ]);
      if ( $q->have_posts() ) :
        while ( $q->have_posts() ) : $q->the_post();
          $thumb = get_the_post_thumbnail_url( get_the_ID(), 'medium_large' );
          if ( ! $thumb ) {
            $thumb = get_template_directory_uri().'/assets/img/blog-placeholder-394x262.jpg';
          }
          $cat = '';
          $cats = get_the_category();
          if ( ! empty($cats) ) { $cat = esc_html($cats[0]->name); }
          $content = wp_strip_all_tags( get_post_field('post_content', get_the_ID()) );
          $mins    = max(1, ceil(mb_strlen($content) / 400));
          ?>
          <article class="c-blog__card">
            <div class="c-blog__media">
              <img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
            </div>
            <div class="c-blog__body">
              <div class="c-blog__meta">
                <?php if ($cat) : ?><span class="c-blog__tag"><?php echo $cat; ?></span><?php endif; ?>
                <span class="c-blog__time"><?php echo esc_html($mins); ?>分で読める</span>
              </div>
              <div class="c-blog__text">
                <h3 class="c-blog__title-text"><?php the_title(); ?></h3>
                <p class="c-blog__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 30, '…' ) ); ?></p>
              </div>
              <a class="c-blog__more" href="<?php the_permalink(); ?>">
                Read more
                <span class="c-blog__more-icon" aria-hidden="true">
                  <svg viewBox="0 0 24 24" role="img" focusable="false" aria-hidden="true">
                    <path fill="currentColor" d="M9 5.5 15.5 12 9 18.5l1.4 1.4 7.9-7.9-7.9-7.9L9 5.5Z"/>
                  </svg>
                </span>
              </a>
            </div>
          </article>
          <?php
        endwhile; wp_reset_postdata();
      endif;
      ?>
    </div>
    <script>
      document.addEventListener('DOMContentLoaded', function(){
        const list = document.getElementById('blogList');
        if(!list) return;

        const prev = document.querySelector('.c-blog__page-btn[aria-label="前へ"]');
        const next = document.querySelector('.c-blog__page-btn[aria-label="次へ"]');

        const toPx = (v) => {
          const n = parseFloat(v);
          return Number.isFinite(n) ? n : 0;
        };

        // Measure actual card width + actual gap so 1 click == 1 card
        const card = list.querySelector('.c-blog__card');
        const cardW = card
          ? card.getBoundingClientRect().width
          : (parseFloat(getComputedStyle(document.documentElement).getPropertyValue('--blog-card-width')) || 394);

        const gap = toPx(getComputedStyle(list).gap || getComputedStyle(list).columnGap || '0');
        const delta = cardW + gap;

        function go(dir){
          list.scrollBy({ left: dir * delta, behavior: 'smooth' });
        }

        prev && prev.addEventListener('click', () => go(-1));
        next && next.addEventListener('click', () => go(1));
      });
    </script>
    <div class="c-blog__pagination">
      <button class="c-blog__page-btn" type="button" aria-label="前へ">
        <svg viewBox="0 0 24 24" role="img" focusable="false" aria-hidden="true">
          <path fill="currentColor" d="m15 5.5-7.9 7.9 7.9 7.9L16.4 20 9.5 13.4 16.4 6.5 15 5.5Z"/>
        </svg>
      </button>
      <button class="c-blog__page-btn" type="button" aria-label="次へ">
        <svg viewBox="0 0 24 24" role="img" focusable="false" aria-hidden="true">
          <path fill="currentColor" d="M9 5.5 15.5 12 9 18.5l1.4 1.4 7.9-7.9-7.9-7.9L9 5.5Z"/>
        </svg>
      </button>
    </div>
  </div>
</section>

<section class="c-logo" id="brands">
  <div class="c-logo__inner">
    <h2 class="c-logo__title">取り扱いブランド</h2>
    <ul class="c-logo__grid">
      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/4T2.jpg'); ?>"
          alt="4T2" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/ACLIMA.jpg'); ?>"
          alt="ACLIMA" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/Afterglow.jpg'); ?>"
          alt="Afterglow" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/ALTRA.jpg'); ?>"
          alt="ALTRA" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/ANDO_.jpg'); ?>"
          alt="ANDO_" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/ANGLE.jpg'); ?>"
          alt="ANGLE" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/arata.jpg'); ?>"
          alt="arata" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/Black-Diamond.jpg'); ?>"
          alt="Black-Diamond" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/BUSHMEN.jpg'); ?>"
          alt="BUSHMEN" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/cascade-wild.jpg'); ?>"
          alt="Cascade-Wild" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/chant.jpg'); ?>"
          alt="chant" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/ciele.jpg'); ?>"
          alt="ciele" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/coros.jpg'); ?>"
          alt="coros" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/EE.jpg'); ?>"
          alt="EE" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/EuroSCHIRM.jpg'); ?>"
          alt="EuroSCHIRM" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/EVERNEW.jpg'); ?>"
          alt="EVERNEW" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/fck500.jpg'); ?>"
          alt="FCK500" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/F-and-M.jpg'); ?>"
          alt="F&amp;M" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/factory-b.jpg'); ?>"
          alt="factory-b" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/feetures.jpg'); ?>"
          alt="feetures" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/FIELD-RECORD.jpg'); ?>"
          alt="FIELD-RECORD" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/galibier.jpg'); ?>"
          alt="galibier" loading="lazy" decoding="async">
      </li>

      <!-- <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/GARUD.jpg'); ?>"
          alt="GARUD" loading="lazy" decoding="async">
      </li> -->

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/goodr.jpg'); ?>"
          alt="goodr" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/gossamer-gear.jpg'); ?>"
          alt="GOSSAMER-GEAR" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/GRIPDROP.jpg'); ?>"
          alt="GRIPDROP" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/HOUDINI.jpg'); ?>"
          alt="HOUDINI" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/hydrapak.jpg'); ?>"
          alt="Hydrapak" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/INNER-FACT.jpg'); ?>"
          alt="INNER-FACT" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/KIVA.jpg'); ?>"
          alt="KIVA" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/klymit.jpg'); ?>"
          alt="KLYMIT" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/LEISMOR.jpg'); ?>"
          alt="LEISMOR" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/LELEKA.jpg'); ?>"
          alt="LELEKA" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/LFD.jpg'); ?>"
          alt="LFD" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/LITEWAY.jpg'); ?>"
          alt="LITEWAY" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/LSM.jpg'); ?>"
          alt="LSM" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/luna.jpg'); ?>"
          alt="luna" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/luna-sandals.jpg'); ?>"
          alt="LUNA-SANDALS" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/MANABAR.jpg'); ?>"
          alt="MANABAR" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/Matador.jpg'); ?>"
          alt="Matador" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/MEADOWPHYSICS.jpg'); ?>"
          alt="MEADOWPHYSICS" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/MGL.jpg'); ?>"
          alt="MGL" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/milestone.jpg'); ?>"
          alt="milestone" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/Mountain-King.jpg'); ?>"
          alt="Mountain-King" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/msr.jpg'); ?>"
          alt="MSR" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/NITECORE.jpg'); ?>"
          alt="NITECORE" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/NNormal.jpg'); ?>"
          alt="NNormal" loading="lazy" decoding="async">
      </li>

      <!-- <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/NOCS.jpg'); ?>"
          alt="NOCS" loading="lazy" decoding="async">
      </li> -->

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/NODAL.jpg'); ?>"
          alt="NODAL" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/nomadix.jpg'); ?>"
          alt="nomadix" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/norda.jpg'); ?>"
          alt="norda" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/norrona.jpg'); ?>"
          alt="norrona" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/oiena.jpg'); ?>"
          alt="oiena" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/oleno.jpg'); ?>"
          alt="OLENO" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/OR.jpg'); ?>"
          alt="OR" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/Otta.jpg'); ?>"
          alt="Otta" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/permandbaton.jpg'); ?>"
          alt="permandbaton" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/pingora.jpg'); ?>"
          alt="PINGORA" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/primus.jpg'); ?>"
          alt="PRIMUS" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/RIDGE.jpg'); ?>"
          alt="RIDGE" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/rig.jpg'); ?>"
          alt="rig" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/river-peak.jpg'); ?>"
          alt="river-peak" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/rivers.jpg'); ?>"
          alt="rivers" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/roark.jpg'); ?>"
          alt="roark" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/ROOTCO.jpg'); ?>"
          alt="ROOTCO" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/RovyVon.jpg'); ?>"
          alt="RovyVon" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/SAKURA.jpg'); ?>"
          alt="SAKURA" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/Sawyer.jpg'); ?>"
          alt="Sawyer" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/SEATOSUMMIT.jpg'); ?>"
          alt="SEATOSUMMIT" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/SN.jpg'); ?>"
          alt="SN" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/sol.jpg'); ?>"
          alt="SOL" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/soto.jpg'); ?>"
          alt="soto" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/STATIC.jpg'); ?>"
          alt="STATIC" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/strap-gear.jpg'); ?>"
          alt="Strap Gear" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/tannuki.jpg'); ?>"
          alt="tannuki" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/tilak.jpg'); ?>"
          alt="tilak" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/TiNY.jpg'); ?>"
          alt="TiNY" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/TMR.jpg'); ?>"
          alt="TMR" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/topo.jpg'); ?>"
          alt="topo" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/TYMER.jpg'); ?>"
          alt="TYMER" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/ULTRA-GOOD-LUCK.jpg'); ?>"
          alt="ULTRA-GOOD-LUCK" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/VAGA.jpg'); ?>"
          alt="VAGA" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/VARGO.jpg'); ?>"
          alt="VARGO" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/Zpacks.jpg'); ?>"
          alt="Zpacks" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/andmore.jpg'); ?>"
          alt="andmore" loading="lazy" decoding="async">
      </li>
    </ul>
    <!-- <a class="c-blog__more c-logo__more" href="<?php echo esc_url( home_url('/brand-list/') ); ?>">
      その他のブランドはこちらから
      <span class="c-blog__more-icon" aria-hidden="true">
        <svg viewBox="0 0 24 24" role="img" focusable="false" aria-hidden="true">
          <path fill="currentColor" d="M9 5.5 15.5 12 9 18.5l1.4 1.4 7.9-7.9-7.9-7.9L9 5.5Z"/>
        </svg>
      </span>
    </a> -->
  </div>
</section>


<?php if (false) : // フッターへお問い合わせを移設（必要になったら true に戻して復活） ?>
<section class="c-contact" id="contact">
  <div class="c-contact__inner">
    <div class="c-contact__header">
      <p class="c-contact__tagline">Contacts</p>
      <div class="c-contact__title-group">
        <h2 class="c-contact__title">お問い合わせ</h2>
        <p class="c-contact__lead">ご質問やご意見をお待ちしております。</p>
      </div>
    </div>
    <?php echo do_shortcode('[contact-form-7 id="9e808e6" title="Front Contact"]'); ?>
  </div>
</section>
<?php endif; ?>

<?php get_footer(); ?>
