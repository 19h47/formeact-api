<?php

/**
 * /front-page
 */

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['fields'] = get_fields( $post );

$templates = array( 'pages/front-page.twig' );

Timber::render( $templates, $context );