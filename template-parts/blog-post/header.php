<div class="c-blog-post-header">
  <div class="c-blog-post-header__inner">
    <div class="c-blog-post-header__container">
    <nav class="c-breadcrumbs" aria-label="Breadcrumb">
      <a class="c-breadcrumbs__link" href="/">Home</a>
      <span class="c-breadcrumbs__sep" aria-hidden="true">
        <svg viewBox="0 0 24 24" width="16" height="16" role="img" focusable="false" aria-hidden="true">
          <path fill="currentColor" d="M9 5.5 15.5 12 9 18.5l1.4 1.4 7.9-7.9-7.9-7.9L9 5.5Z"/>
        </svg>
      </span>
      <a class="c-breadcrumbs__link" href="/blog/">Blog</a>
      <span class="c-breadcrumbs__sep" aria-hidden="true">
        <svg viewBox="0 0 24 24" width="16" height="16" role="img" focusable="false" aria-hidden="true">
          <path fill="currentColor" d="M9 5.5 15.5 12 9 18.5l1.4 1.4 7.9-7.9-7.9-7.9L9 5.5Z"/>
        </svg>
      </span>
      <span class="c-breadcrumbs__current"><?php the_title(); ?></span>
    </nav>
    <h1 class="c-blog-post__title"><?php the_title(); ?></h1>
    <?php
      $permalink = get_permalink();
      $share_url = rawurlencode($permalink);
      $icon_base = get_template_directory_uri() . '/assets/img';

      // Rough reading time (JP-friendly): 500 chars / minute
      $content_plain = wp_strip_all_tags(get_the_content());
      $chars = function_exists('mb_strlen') ? mb_strlen($content_plain) : strlen($content_plain);
      $minutes = max(1, (int) ceil($chars / 500));
    ?>

    <div class="c-blog-post-meta">
      <div class="c-blog-post-meta__author">
        <span class="c-blog-post-meta__avatar">
          <?php
            echo get_avatar(
              get_the_author_meta('ID'),
              48,
              '',
              get_the_author_meta('display_name'),
              [
                'class' => 'c-blog-post-meta__avatar-img',
                'loading' => 'lazy',
                'decoding' => 'async',
              ]
            );
          ?>
        </span>
        <div class="c-blog-post-meta__text">
          <p class="c-blog-post-meta__name"><?php echo esc_html(get_the_author_meta('display_name')); ?></p>
          <p class="c-blog-post-meta__time">
            <span><?php echo esc_html(get_the_date('Y-m-d')); ?></span>
            <span class="c-blog-post-meta__dot" aria-hidden="true">•</span>
            <span><?php echo esc_html($minutes); ?> min read</span>
          </p>
        </div>
      </div>

      <div class="c-blog-post-meta__share" aria-label="Share">
        <a class="c-blog-post-meta__share-btn" href="<?php echo esc_url($permalink); ?>" aria-label="リンクをコピー">
          <span class="c-blog-post-meta__icon" aria-hidden="true">
            <img src="<?php echo esc_url($icon_base . '/link.svg'); ?>" alt="" width="24" height="24" loading="lazy">
          </span>
        </a>
        <a class="c-blog-post-meta__share-btn" href="<?php echo esc_url('https://www.linkedin.com/sharing/share-offsite/?url=' . $share_url); ?>" target="_blank" rel="noopener noreferrer" aria-label="Instagramでシェア">
          <span class="c-blog-post-meta__icon" aria-hidden="true">
            <img src="<?php echo esc_url($icon_base . '/Instagram.svg'); ?>" alt="" width="24" height="24" loading="lazy">
          </span>
        </a>
        <a class="c-blog-post-meta__share-btn" href="<?php echo esc_url('https://www.facebook.com/sharer/sharer.php?u=' . $share_url); ?>" target="_blank" rel="noopener noreferrer" aria-label="Facebookでシェア">
          <span class="c-blog-post-meta__icon" aria-hidden="true">
            <img src="<?php echo esc_url($icon_base . '/Facebook.svg'); ?>" alt="" width="24" height="24" loading="lazy">
          </span>
        </a>
      </div>
    </div>
    </div>
  </div>
</div>