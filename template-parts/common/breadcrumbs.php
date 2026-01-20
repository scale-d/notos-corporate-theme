<?php
/**
 * Common Breadcrumbs
 *
 * Usage:
 *   <?php get_template_part('template-parts/common/breadcrumbs'); ?>
 *
 * This template part renders breadcrumbs via the shared helper `notos_render_breadcrumbs()`.
 * (The helper should be defined in functions.php)
 */

if (function_exists('notos_render_breadcrumbs')) {
  notos_render_breadcrumbs();
}