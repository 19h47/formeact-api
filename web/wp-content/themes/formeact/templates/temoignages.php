<?php

/**
 * Template Name: Témoignages
 *
 * @author  Jérémy Levron <jeremylevron@19h47.fr>
 */

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['fields'] = get_fields( $post );

$context['testimonies'] = Timber::get_posts(
	array(
		'post_type' 	=> 'testimony',
		'post_status'	=> 'publish',
		'order'			=> 'ASC',
		'post_per_page'	=> -1,
	)
);

$templates = array( 'pages/temoignages.twig' );

Timber::render( $templates, $context );