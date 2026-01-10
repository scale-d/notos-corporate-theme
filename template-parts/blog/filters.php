<?php
$posts_page_id = get_option('page_for_posts');
$all_url = $posts_page_id ? get_permalink($posts_page_id) : home_url('/');
$cats = get_categories([ 'hide_empty' => true ]);
?>
<div class="c-blog-page__filters" aria-label="フィルター">
  <a class="c-blog-page__filter <?php echo ( is_home() && !is_category() ) ? 'is-active' : ''; ?>" href="<?php echo esc_url($all_url); ?>">すべて</a>
  <?php foreach ($cats as $cat): ?>
    <a class="c-blog-page__filter <?php echo is_category($cat->term_id) ? 'is-active' : ''; ?>" href="<?php echo esc_url(get_category_link($cat->term_id)); ?>">
      <?php echo esc_html($cat->name); ?>
    </a>
  <?php endforeach; ?>
</div>
