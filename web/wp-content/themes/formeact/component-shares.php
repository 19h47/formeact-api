<?php
/**
 * /component-shares
 *
 * Display shares buttons
 *
 * @package     WordPress
 * @subpackage  formeact
 * @author      Jérémy Levron <jeremylevron@19h47.fr>
 */

global $post;

$context = Timber::get_context();
$current_url = urlencode( current_url() );
$post_title = rawurlencode( wp_strip_all_tags( $post->title ) );

// Shares
$context['shares'] = array(
	array(
		'slug'	=> 'facebook',
		'name' 	=> 'Facebook',
		'url'  	=> "https://www.facebook.com/sharer.php?u={$current_url}",
		'title'	=> 'Partager sur Facebook'
	),
	array(
		'slug'  => 'twitter',
		'name' 	=> 'Twitter',
		'url'  	=> "https://twitter.com/intent/tweet?url={$current_url}&amp;text={$post_title}",
		'title'	=> 'Partager sur Twitter'
	),
	array(
		'slug'  => 'envelope',
		'name' 	=> 'Mail',
		'url'  	=> "mailto:?body={$post_title}%0A{$current_url}",
		'title'	=> 'Partager par mail'
	)
);

Timber::render( 'components/shares.twig', $context );