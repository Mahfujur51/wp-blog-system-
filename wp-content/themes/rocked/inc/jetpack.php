<?php
/**
 * Jetpack Compatibility File
 * See: https://jetpack.me/
 *
 * @package Rocked
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function rocked_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'rocked_infinite_scroll_render',
		'footer'    => 'page',
	) );
} // end function rocked_jetpack_setup
add_action( 'after_setup_theme', 'rocked_jetpack_setup' );

function rocked_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', get_post_format() );
	}
} // end function rocked_infinite_scroll_render