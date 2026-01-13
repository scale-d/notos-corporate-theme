<?php
/* Single Post */
get_header();
?>

<main id="main" class="c-blog-post">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

  <?php get_template_part('template-parts/blog-post/header'); ?>

  <div class="c-blog-post-body">
    <div class="c-blog-post-body__inner">
      <?php the_content(); ?>

      <?php
        $permalink = get_permalink();
        $share_url = rawurlencode($permalink);
        $icon_base = get_template_directory_uri() . '/assets/img';
        $tags      = get_the_tags();
        $next_post = get_next_post(); // もし「前の記事」表示にしたいなら get_previous_post() に変更
      ?>

      <div class="c-post-share">
        <div class="c-post-share__block">
          <p class="c-post-share__label">Share this post</p>
          <div class="c-post-share__buttons">
            <a class="c-post-share__btn js-copy-link"
              href="<?php echo esc_url($permalink); ?>"
              data-copy-url="<?php echo esc_attr($permalink); ?>"
              aria-label="リンクをコピー">
              <span class="c-post-share__icon" aria-hidden="true">
                <img src="<?php echo esc_url($icon_base . '/link.svg'); ?>" alt="" width="24" height="24" loading="lazy">
              </span>
            </a>

            <a class="c-post-share__btn"
              href="<?php echo esc_url('https://www.linkedin.com/sharing/share-offsite/?url=' . $share_url); ?>"
              target="_blank" rel="noopener noreferrer"
              aria-label="LinkedInでシェア">
              <span class="c-post-share__icon" aria-hidden="true">
                <img src="<?php echo esc_url($icon_base . '/instagram.svg'); ?>" alt="" width="24" height="24" loading="lazy">
              </span>
            </a>

            <a class="c-post-share__btn"
              href="<?php echo esc_url('https://www.facebook.com/sharer/sharer.php?u=' . $share_url); ?>"
              target="_blank" rel="noopener noreferrer"
              aria-label="Facebookでシェア">
              <span class="c-post-share__icon" aria-hidden="true">
                <img src="<?php echo esc_url($icon_base . '/facebook.svg'); ?>" alt="" width="24" height="24" loading="lazy">
              </span>
            </a>
          </div>
        </div>

        <?php if ($tags && !is_wp_error($tags)) : ?>
          <div class="c-post-share__tags" aria-label="Tags">
            <?php foreach ($tags as $tag) : ?>
              <a class="c-post-share__tag"
                href="<?php echo esc_url(get_tag_link($tag)); ?>">
                <?php echo esc_html('#' . $tag->name); ?>
              </a>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>

      <div class="c-post-divider" aria-hidden="true"></div>

      <?php if ($next_post) : ?>
        <div class="c-post-next-row">
          <a class="c-post-next" href="<?php echo esc_url(get_permalink($next_post)); ?>">
            <span class="c-post-next__label">Next</span>
            <span class="c-post-next__icon" aria-hidden="true">
              <svg viewBox="0 0 24 24" role="img" focusable="false" aria-hidden="true">
                <path fill="currentColor" d="M9 5.5 15.5 12 9 18.5l1.4 1.4 7.9-7.9-7.9-7.9L9 5.5Z"/>
              </svg>
            </span>
          </a>
        </div>
      <?php endif; ?>

    </div>
  </div>
  <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>