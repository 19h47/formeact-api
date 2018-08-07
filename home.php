<?php

/**
 * /home
 */

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['posts'] = new Timber\PostQuery();

$templates = array( 'pages/blog.twig' );

Timber::render( $templates, $context );