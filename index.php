<?php
/* Fallback index.php for classic theme */
get_header();
?>
<main class="site-main">
  <div class="container section">
    <?php if ( have_posts() ) :
      while ( have_posts() ) : the_post();
        the_content();
      endwhile;
    else: ?>
      <p>コンテンツはまだありません。</p>
    <?php endif; ?>
  </div>
</main>
<?php get_footer(); ?>
