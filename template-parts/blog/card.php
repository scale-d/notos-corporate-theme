<article class="c-blog-page__card">
  <a class="c-blog-page__card-media" href="<?php the_permalink(); ?>">
    <?php if ( has_post_thumbnail() ) { the_post_thumbnail('medium_large'); }
    else { ?>
      <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/blog-placeholder-394x262.jpg'); ?>" alt="">
    <?php } ?>
  </a>
  <div class="c-blog-page__card-body">
    <?php $cats = get_the_category(); $cat_name = !empty($cats) ? esc_html($cats[0]->name) : ''; ?>
    <?php if ($cat_name): ?><p class="c-blog-page__card-category"><?php echo $cat_name; ?></p><?php endif; ?>
    <h3 class="c-blog-page__card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    <p class="c-blog-page__card-lead"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 26, '…' ) ); ?></p>
  </div>
  <div class="c-blog-page__card-footer">
    <span class="c-blog-page__avatar">
      <?php
        echo get_avatar(
          get_the_author_meta('ID'),
          48,
          '',
          get_the_author_meta('display_name'),
          [
            'class' => 'c-blog-page__avatar-img',
            'loading' => 'lazy',
            'decoding' => 'async',
          ]
        );
      ?>
    </span>
    <div class="c-blog-page__card-meta">
      <p class="c-blog-page__author-name"><?php the_author(); ?></p>
      <p class="c-blog-page__card-time">
        <span class="c-blog-page__date"><?php echo esc_html( get_the_date('Y-m-d') ); ?></span>
        <span class="c-blog-page__dot">•</span>
        <span class="c-blog-page__read"><?php echo esc_html( max(1, ceil(mb_strlen(wp_strip_all_tags(get_the_content()))/400)) ); ?>分で読める</span>
      </p>
    </div>
  </div>
</article>
