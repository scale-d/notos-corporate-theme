<?php get_header(); ?>

<main class="c-blog-page">
  <div class="c-blog-page__inner">

    <?php get_template_part('template-parts/common/breadcrumbs'); ?>

    <?php
      // 現在のカテゴリ
      $cat = get_queried_object();
      $cat_id = ($cat && isset($cat->term_id)) ? (int) $cat->term_id : 0;

      // カテゴリ内の「先頭1件」を特集として使う
      $featured_id = 0;
      if ($cat_id) {
        $fp = new WP_Query([
          'post_type'           => 'post',
          'post_status'         => 'publish',
          'posts_per_page'      => 1,
          'cat'                 => $cat_id,
          'ignore_sticky_posts' => true,
        ]);
        if ($fp->have_posts()) {
          $featured_id = (int) $fp->posts[0]->ID;
        }
        wp_reset_postdata();
      }

      // feature.php / filters.php 側で参照できるように渡す
      set_query_var('notos_featured_post_id', $featured_id);
      set_query_var('notos_current_category_id', $cat_id);
    ?>

    <?php get_template_part('template-parts/blog/intro'); ?>
    <?php get_template_part('template-parts/blog/feature'); ?>
    <?php get_template_part('template-parts/blog/filters'); ?>

    <section class="c-blog-page__grid">
      <?php
      $paged = max(1, get_query_var('paged'));
      $exclude = $featured_id ? [$featured_id] : [];

      $q = new WP_Query([
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => 9,
        'paged'          => $paged,
        'cat'            => $cat_id,
        'post__not_in'   => $exclude,
      ]);

      if ($q->have_posts()) :
        while ($q->have_posts()) : $q->the_post();
          get_template_part('template-parts/blog/card');
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