<?php
/**
 * /component-recent-post
 *
 * Display last recent post
 *
 * @package     WordPress
 * @subpackage  formeact
 * @author      Jérémy Levron <jeremylevron@19h47.fr>
 */

global $post;

$context = Timber::get_context();

// get last post
$context['posts'] = Timber::get_posts(
    array(
        'order'         	=> 'DESC',
        'orderby'       	=> 'date',
        'post_type'     	=> 'post',
        'posts_per_page'	=> 3,
        'post__not_in'		=> array( $post->ID )
    )
);
Timber::render( 'components/recent-posts.twig', $context );