<?php
// Featured post: sticky があれば先頭、なければ最新1件
$featured_post = null;
$sticky = get_option('sticky_posts');
if (!empty($sticky)) {
  rsort($sticky);
  $featured_post = get_post($sticky[0]);
}
if (!$featured_post) {
  $featured_q = new WP_Query([
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'posts_per_page'      => 1,
    'ignore_sticky_posts' => true,
  ]);
  if ($featured_q->have_posts()) {
    $featured_q->the_post();
    $featured_post = get_post();
  }
  wp_reset_postdata();
}

if ($featured_post):
  $fp_id = $featured_post->ID;
  // 下のグリッドから除外するためのIDを渡す
  set_query_var('notos_featured_post_id', $fp_id);

  $thumb = get_the_post_thumbnail_url($fp_id, 'large');
  if (!$thumb) {
    $thumb = get_template_directory_uri().'/assets/img/blog-placeholder-394x262.jpg';
  }
  $cats = get_the_category($fp_id);
  $cat_name = !empty($cats) ? esc_html($cats[0]->name) : '';
  $excerpt = get_the_excerpt($fp_id);
  $author_name = get_the_author_meta('display_name', get_post_field('post_author',$fp_id));
  $mins = max(1, ceil(mb_strlen(wp_strip_all_tags(get_post_field('post_content',$fp_id))) / 400));
?>
<div class="c-blog-page__feature">
  <a class="c-blog-page__feature-media" href="<?php echo esc_url(get_permalink($fp_id)); ?>">
    <img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr(get_the_title($fp_id)); ?>">
  </a>
  <div class="c-blog-page__feature-body">
    <?php if ($cat_name): ?><p class="c-blog-page__category"><?php echo $cat_name; ?></p><?php endif; ?>
    <h2 class="c-blog-page__feature-title"><?php echo esc_html(get_the_title($fp_id)); ?></h2>
    <p class="c-blog-page__feature-excerpt"><?php echo esc_html( wp_trim_words($excerpt, 40, '…') ); ?></p>
    <div class="c-blog-page__author">
      <span class="c-blog-page__avatar">
        <?php
          $author_id = (int) get_post_field('post_author', $fp_id);
          echo get_avatar(
            $author_id,
            48,
            '',
            $author_name,
            [
              'class' => 'c-blog-page__avatar-img',
              'loading' => 'lazy',
              'decoding' => 'async',
            ]
          );
        ?>
      </span>
      <div class="c-blog-page__author-meta">
        <p class="c-blog-page__author-name"><?php echo esc_html($author_name); ?></p>
        <p class="c-blog-page__author-date"><?php echo esc_html(get_the_date('Y年 n月 j日', $fp_id)); ?>・<?php echo esc_html($mins); ?>分で読める</p>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>
