<?php
/* Page: About Notos (slug: about-notos) */
get_header();
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<main id="main" class="c-brandlist c-about">
  <div class="c-brandlist__inner">

    <header class="c-brandlist__header">
      <?php get_template_part('template-parts/common/breadcrumbs'); ?>
      <h1 class="c-brandlist__title"><?php the_title(); ?></h1>
      <p class="c-brandlist__note">Notosについて</p>
    </header>

    <div class="c-brandlist__content">
      <?php the_content(); ?>
    </div>

  </div>
</main>
<?php endwhile; endif; ?>

<?php get_footer(); ?>