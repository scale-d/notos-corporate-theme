<?php
/* Page: Cookie Policy (slug: cookie-policy) */
get_header();
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<main id="main" class="c-brandlist c-cookie">
  <div class="c-brandlist__inner">

    <header class="c-brandlist__header">
      <h1 class="c-brandlist__title"><?php the_title(); ?></h1>
      <p class="c-brandlist__note">クッキーポリシー</p>
    </header>

    <div class="c-post-divider" aria-hidden="true"></div>

    <div class="c-brandlist__content">
      <?php the_content(); ?>
    </div>

  </div>
</main>
<?php endwhile; endif; ?>

<?php get_footer(); ?>