<?php /* Front Page */ get_header(); ?>

<section class="c-hero" style="--hero-bg: url('<?php echo esc_url(get_template_directory_uri().'/assets/img/hero-sec.webp'); ?>');">
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
      <h1 class="c-hero__title">3月1日、広島に「Notos」がOPEN！</h1>
      <p class="c-hero__lead">
        Notosはハイキング・トレイルランニング・ロードランニング・渓流釣り・スノーアクティビティなど、都市生活の延長線上にある“日常的アウトドア”のスタイルを提案するショップです。
      </p>
    </div>
  </div>
</section>

<section class="c-store">
  <div class="c-store__inner">
    <div class="c-store__top">
      <div class="c-store__content">
        <h2 class="c-store__title">
          3月1日、広島市牛田エリアにアウトドアセレクトショップ "Notos/ノトス" がOPEN！
        </h2>
        <p class="c-store__lead">
          「City Life, Mountain Soul.」<br><br>
          Notosはハイキング・トレイルランニング・ロードランニング・渓流釣り・スノーアクティビティなど、都市生活の延長線上にある“日常的アウトドア”のスタイルを提案するショップです。<br>
          広島の特徴でもある市街地からの「自然へのアクセスの良さ」を活かし、日帰りでも楽しめる気軽なアウトドアの魅力を発信してまいります。<br>
          また、現職で培ってきた時代性のある商品セレクトを通じて、アウトドア未経験者にも開かれた入り口となることを目指します。<br>
        </p>
        <div class="c-store__info">
          <div class="c-store__info-row">
            <span class="c-store__info-label">住所</span>
            <p class="c-store__info-text">〒732-0066<br>広島市東区牛田本町 1-10-17</p>
          </div>
          <div class="c-store__info-row">
            <span class="c-store__info-label">TEL</span>
            <p class="c-store__info-text">082-555-4580</p>
          </div>
          <div class="c-store__info-row">
            <span class="c-store__info-label">時間</span>
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
        </div>
        <div class="c-store__social">
          <a class="c-store__card" href="#">
            <div class="c-store__card-text">
              <p class="c-store__card-title">NOTOS Online Store</p>
              <p class="c-store__card-sub">ノトス オンラインストア</p>
            </div>
            <span class="c-store__card-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24" role="img" focusable="false" aria-hidden="true">
                <path fill="currentColor" d="M7 18a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm10 0a2 2 0 1 0 .001 4A2 2 0 0 0 17 18ZM6.2 6h13.3l-1.4 7.2a2 2 0 0 1-2 1.6H9a2 2 0 0 1-2-1.6L5.3 4H3V2h3.1a2 2 0 0 1 2 1.6L8.4 6Z"/>
              </svg>
            </span>
          </a>
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
          <a class="c-store__card" href="#">
            <div class="c-store__card-text">
              <p class="c-store__card-title">INSTAGRAM</p>
              <p class="c-store__card-sub">インスタグラム</p>
            </div>
            <span class="c-store__card-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24" role="img" focusable="false" aria-hidden="true">
                <path fill="currentColor" d="M7 3h10a4 4 0 0 1 4 4v10a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4V7a4 4 0 0 1 4-4Zm5 5.5A3.5 3.5 0 1 0 12 15.5 3.5 3.5 0 0 0 12 8.5Zm6-1.75a1 1 0 1 0-1-1 1 1 0 0 0 1 1Z"/>
              </svg>
            </span>
          </a>
          <a class="c-store__card" href="#">
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
      </div>
      <div class="c-store__media">
        <div class="c-store__photo c-store__photo--instagram">
          <?php echo do_shortcode('[instagram-feed feed=1]'); ?>

          <?php /*
          // 旧スライダー（店舗写真）
          <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/store-photo-600x703.jpg'); ?>" alt="">
          <div class="c-store__pagination" aria-hidden="true">
            <span></span><span></span><span></span>
          </div>
          <button class="c-store__arrow c-store__arrow--left" type="button" aria-label="前へ"></button>
          <button class="c-store__arrow c-store__arrow--right" type="button" aria-label="次へ"></button>
          */ ?>
        </div>
      </div>
    </div>
    <div class="c-store__map">
      <div id="notos-map" class="c-store__map-canvas"
           data-lat="34.40829191003846" data-lng="132.47143820238895" data-map-id="ff7fd07d411a9bb4806cea65"></div>
      <noscript>
        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/store-map-1400x329.jpg'); ?>" alt="">
      </noscript>
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
        center: {lat: lat, lng: lng},
        zoom: 16,
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

<section class="c-logo" id="brands">
  <div class="c-logo__inner">
    <h2 class="c-logo__title">取り扱いブランド</h2>
    <ul class="c-logo__grid">
      <li class="c-logo__item">
        <img
          src="<?php echo esc_url(get_template_directory_uri().'/assets/img/logo-blackdiamond-270x45.gif'); ?>"
          alt="BlackDiamond" width="208" height="35" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img
          src="<?php echo esc_url(get_template_directory_uri().'/assets/img/logo-coros-320x80.png'); ?>"
          alt="COROS" width="200" height="50" loading="lazy" decoding="async">
      </li>
      <li class="c-logo__item">
        <img
          src="<?php echo esc_url(get_template_directory_uri().'/assets/img/logo-altra-145x42.webp'); ?>"
          alt="ALTRA" width="145" height="42" loading="lazy" decoding="async">
      </li>
      <li class="c-logo__item">
        <img
          src="<?php echo esc_url(get_template_directory_uri().'/assets/img/logo-static-120x120.png'); ?>"
          srcset="<?php echo esc_url(get_template_directory_uri().'/assets/img/logo-static-240x240.png'); ?> 2x"
          alt="Static Logo" width="120" height="120" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img
          src="<?php echo esc_url(get_template_directory_uri().'/assets/img/logo-zpacks-168x46.png'); ?>"
          srcset="<?php echo esc_url(get_template_directory_uri().'/assets/img/logo-zpacks-336x92.png'); ?> 2x"
          alt="Zpacks" width="168" height="46" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img
          src="<?php echo esc_url(get_template_directory_uri().'/assets/img/logo-enlightened.svg'); ?>"
          alt="Enlightened Equipment" width="168" height="29" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img
          src="<?php echo esc_url(get_template_directory_uri().'/assets/img/logo-tilak-120x44.png'); ?>"
          srcset="<?php echo esc_url(get_template_directory_uri().'/assets/img/logo-tilak-240x88.png'); ?> 2x"
          alt="tilak" width="120" height="45" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img
          src="<?php echo esc_url(get_template_directory_uri().'/assets/img/logo-nnormal.svg'); ?>"
          alt="NNormal" width="168" height="29" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img
          src="<?php echo esc_url(get_template_directory_uri().'/assets/img/logo-4t2-100x100.png'); ?>"
          srcset="<?php echo esc_url(get_template_directory_uri().'/assets/img/logo-4t2-200x200.png'); ?> 2x"
          alt="4T2" width="100" height="100" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img
          src="<?php echo esc_url(get_template_directory_uri().'/assets/img/logo-norda-168x69.png'); ?>"
          srcset="<?php echo esc_url(get_template_directory_uri().'/assets/img/logo-norda-336x138.png'); ?> 2x"
          alt="norda" width="168" height="69" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img
          src="<?php echo esc_url(get_template_directory_uri().'/assets/img/logo-liteway-168x47.png'); ?>"
          srcset="<?php echo esc_url(get_template_directory_uri().'/assets/img/logo-liteway-336x94.png'); ?> 2x"
          alt="LITEWAY" width="168" height="47" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img
          src="<?php echo esc_url(get_template_directory_uri().'/assets/img/logo-ridge-168x30.png'); ?>"
          srcset="<?php echo esc_url(get_template_directory_uri().'/assets/img/logo-ridge-336x61.png'); ?> 2x"
          alt="Ridge Mountain Gear" width="168" height="30" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img
          src="<?php echo esc_url(get_template_directory_uri().'/assets/img/logo-or.svg'); ?>"
          alt="Outdoor Research" width="168" height="36" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img
          src="<?php echo esc_url(get_template_directory_uri().'/assets/img/logo-afterglow-150x44.png'); ?>"
          srcset="<?php echo esc_url(get_template_directory_uri().'/assets/img/logo-afterglow-300x87.png'); ?> 2x"
          alt="Afterglow" width="150" height="44" loading="lazy" decoding="async">
      </li>

      <li class="c-logo__item">
        <img
          src="<?php echo esc_url(get_template_directory_uri().'/assets/img/logo-field-record-140x50.png'); ?>"
          srcset="<?php echo esc_url(get_template_directory_uri().'/assets/img/logo-field-record-280x100.png'); ?> 2x"
          alt="Field Record" width="140" height="50" loading="lazy" decoding="async">
      </li>
    </ul>
    <a class="c-blog__more c-logo__more" href="<?php echo esc_url( home_url('/brand-list/') ); ?>">
      その他のブランドはこちらから
      <span class="c-blog__more-icon" aria-hidden="true">
        <svg viewBox="0 0 24 24" role="img" focusable="false" aria-hidden="true">
          <path fill="currentColor" d="M9 5.5 15.5 12 9 18.5l1.4 1.4 7.9-7.9-7.9-7.9L9 5.5Z"/>
        </svg>
      </span>
    </a>
  </div>
</section>

<section class="c-blog" id="blog">
  <div class="c-blog__inner">
    <div class="c-blog__header">
      <div class="c-blog__title">
        <p class="c-blog__tagline">ブログ</p>
        <h2 class="c-blog__headline">NOTOS OUT THERE.</h2>
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

<?php get_footer(); ?>
