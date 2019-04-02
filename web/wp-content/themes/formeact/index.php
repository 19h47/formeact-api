<?php

/**
 * The main template file
 */

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['fields'] = get_fields( $post );

$templates = array( 'index.twig' );

Timber::render( $templates, $context );