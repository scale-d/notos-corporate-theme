
<?php
$total   = get_query_var('notos_pagination_total');
$current = get_query_var('notos_pagination_current');

if (!$total) {
  global $wp_query;
  $total   = $wp_query->max_num_pages;
  $current = max(1, get_query_var('paged'));
}

// Prev/Next URLs (show disabled state when not available)
$prev_url = ($current > 1) ? get_pagenum_link($current - 1) : null;
$next_url = ($current < $total) ? get_pagenum_link($current + 1) : null;

// Page number links only (no prev/next)
$page_links = paginate_links([
  'base'      => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
  'format'    => '?paged=%#%',
  'current'   => $current,
  'total'     => $total,
  'type'      => 'array',
  'prev_next' => false,
]);

if ($total > 1 && $page_links): ?>
<nav class="c-pagination" role="navigation" aria-label="ページナビゲーション">
  <div class="c-pagination__inner">
    <?php if ($prev_url): ?>
      <a class="c-pagination__control c-pagination__control--prev" href="<?php echo esc_url($prev_url); ?>">
        <span class="c-pagination__arrow" aria-hidden="true">←</span>
        <span class="c-pagination__label">Previous</span>
      </a>
    <?php else: ?>
      <span class="c-pagination__control c-pagination__control--prev is-disabled" aria-disabled="true">
        <span class="c-pagination__arrow" aria-hidden="true">←</span>
        <span class="c-pagination__label">Previous</span>
      </span>
    <?php endif; ?>

    <ul class="c-pagination__pages" aria-label="ページ">
      <?php foreach ($page_links as $link): ?>
        <?php if (strpos($link, 'dots') !== false): ?>
          <li><span class="c-pagination__gap" aria-hidden="true">…</span></li>
        <?php elseif (strpos($link, 'current') !== false): ?>
          <?php $label = trim(wp_strip_all_tags($link)); ?>
          <li><span class="c-pagination__page is-current" aria-current="page"><?php echo esc_html($label); ?></span></li>
        <?php else: ?>
          <?php
            preg_match('/href="([^"]+)"/', $link, $m);
            $href  = $m[1] ?? '';
            $label = trim(wp_strip_all_tags($link));
          ?>
          <li><a class="c-pagination__page" href="<?php echo esc_url($href); ?>"><?php echo esc_html($label); ?></a></li>
        <?php endif; ?>
      <?php endforeach; ?>
    </ul>

    <?php if ($next_url): ?>
      <a class="c-pagination__control c-pagination__control--next" href="<?php echo esc_url($next_url); ?>">
        <span class="c-pagination__label">Next</span>
        <span class="c-pagination__arrow" aria-hidden="true">→</span>
      </a>
    <?php else: ?>
      <span class="c-pagination__control c-pagination__control--next is-disabled" aria-disabled="true">
        <span class="c-pagination__label">Next</span>
        <span class="c-pagination__arrow" aria-hidden="true">→</span>
      </span>
    <?php endif; ?>
  </div>
</nav>
<?php endif; ?>