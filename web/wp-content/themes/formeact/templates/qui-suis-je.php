<?php

/**
 * Template Name: Qui suis-je ?
 *
 * @author  Jérémy Levron <jeremylevron@19h47.fr>
 */

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['fields'] = get_fields( $post );

$templates = array( 'pages/qui-suis-je.twig' );

Timber::render( $templates, $context );