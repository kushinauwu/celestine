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
        <h1>author's name</h1>
        <img src="D18JBSNWwAA5uGk.png" alt="author">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nunc non blandit massa enim nec. Amet porttitor eget dolor morbi non arcu. Cursus turpis massa tincidunt dui. A iaculis at erat pellentesque adipiscing.</p>
    </div>
    <?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
