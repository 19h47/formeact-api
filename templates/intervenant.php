<?php

/**
 * Template Name: Intervenant
 *
 * @author  Jérémy Levron <jeremylevron@19h47.fr>
 */

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['fields'] = get_fields( $post );

$templates = array( 'pages/intervenant.twig' );

Timber::render( $templates, $context );