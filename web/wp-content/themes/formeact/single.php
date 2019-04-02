<?php

/**
 * single
 */

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['shares'] = Timber::get_sidebar( 'component-shares.php' );
$context['recent_posts'] = Timber::get_sidebar( 'component-recent-posts.php' );

$templates = array( 'pages/single.twig' );

Timber::render( $templates, $context );