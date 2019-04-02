<?php

// Apply filter
add_filter( 'body_class', 'custom_body_class' );

function custom_body_class( $classes ) {

	// Front page
	if ( is_front_page() ) {
		$classes[] = 'Front-page';
	}

	// Not front page
	if ( ! is_front_page() ) {
		$classes[] = 'Page';
	}

	// Home
	if ( is_home() ) {
		$classes[] = 'Blog';
	}

	// Single
	if ( is_single() ) {
		$classes[] = 'Single';
	}

	return $classes;
}