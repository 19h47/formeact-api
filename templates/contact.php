<?php

/**
 * Template Name: Contact
 *
 * @author  Jérémy Levron <jeremylevron@19h47.fr>
 */

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['fields'] = get_fields( $post );
$context['form']['id'] = '972046257270286231';

$templates = array( 'pages/contact.twig' );

Timber::render( $templates, $context );