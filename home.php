<?php /* Blog index */ get_header(); ?>

<main class="c-blog-page">
  <div class="c-blog-page__inner">

    <?php get_template_part('template-parts/blog/intro'); ?>
    <?php get_template_part('template-parts/blog/feature'); ?>
    <?php get_template_part('template-parts/blog/filters'); ?>

    <section class="c-blog-page__grid">
      <?php
      $paged = max(1, get_query_var('paged'));
      $featured_id = get_query_var('notos_featured_post_id');
      $exclude = $featured_id ? [$featured_id] : [];
      $q = new WP_Query([
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => 9,
        'paged'          => $paged,
        'post__not_in'   => $exclude,
      ]);
      if ($q->have_posts()) :
        while ($q->have_posts()) : $q->the_post();
          get_template_part('template-parts/blog/card'); // 1枚分のカード
        endwhile;
        set_query_var('notos_pagination_total', $q->max_num_pages);
        set_query_var('notos_pagination_current', $paged);
        wp_reset_postdata();
      else :
        echo '<p>まだ記事がありません。</p>';
      endif;
      ?>
    </section>

    <?php get_template_part('template-parts/blog/pagination'); ?>

  </div>
</main>

<?php get_footer(); ?>