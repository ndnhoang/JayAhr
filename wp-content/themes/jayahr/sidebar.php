<?php
/**
 * Template Name: Home
 * @link https://arrowicode.com
 * @author Vietsmiler
 * @package Arrowicode
 */
get_header();

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}?>

<aside id="secondary" class="sidebar-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
