<?php

/**
 * Template Name: Programme
 *
 * @author  Jérémy Levron <jeremylevron@19h47.fr>
 */

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['fields'] = get_fields( $post );
$context['tweets'] = Timber::get_posts(
	array(
		'post_type' 		=> 'tweet',
		'post_status'		=> 'publish',
		'posts_per_page'	=> -1
	)
);

$templates = array( 'pages/programme.twig' );

Timber::render( $templates, $context );