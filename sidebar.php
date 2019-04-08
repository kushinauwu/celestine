<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package celestine
 */

if ( ! is_active_sidebar( 'author-info' ) ) {
	return;
}

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area">
    <!--<div class="author-info">-->
    <?php dynamic_sidebar('author-info'); ?>
    <!--</div>-->
    <?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
