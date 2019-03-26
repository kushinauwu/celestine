<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package celestine
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area">
    <div class="author-info">
        <h1>author name</h1>
        <img src="" alt="author">
        <p>authoer blah blak</p>
    </div>
    <?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
