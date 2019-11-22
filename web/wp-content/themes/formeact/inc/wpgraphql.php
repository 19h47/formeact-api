<?php
/**
 * WPGraphQL
 *
 * @package Formeact
 */

add_action( 'graphql_register_types', 'graphql_register_tweet_url' );

/**
 * Graphql register tweet url
 *
 * @return void
 */
function graphql_register_tweet_url() : void {
	register_graphql_field(
		'Tweet',
		'tweetUrl',
		array(
			'type'        => 'String',
			'description' => __( 'The original url of the tweet', 'api-formeact' ),
			'resolve'     => function( $post ) : string {
				$tweet_url = get_post_meta( $post->ID, '_tweet_url', true );

				return $tweet_url;
			},
		)
	);
}


add_action( 'graphql_register_types', 'graphql_register_page_on_front' );

/**
 * Register page on front option
 *
 * @return void
 */
function graphql_register_page_on_front() {
	register_graphql_field(
		'Page',
		'pageOnFront',
		array(
			'type'        => 'Boolean',
			'description' => 'WordPress page on front option',
			'resolve'     => function( object $page ) : bool {
				$page_on_front_id = (int) get_option( 'page_on_front' );

				return $page->pageId === $page_on_front_id; // phpcs:ignore
			},
		)
	);
}


add_action( 'graphql_register_types', 'graphql_register_page_for_posts' );

/**
 * Register page for posts option
 *
 * @return void
 */
function graphql_register_page_for_posts() : void {
	register_graphql_field(
		'Page',
		'pageForPosts',
		array(
			'type'        => 'Boolean',
			'description' => 'WordPress page for posts option',
			'resolve'     => function( object $page ) : bool {
				$page_for_posts_id = (int) get_option( 'page_for_posts' );

				return $page->pageId === $page_for_posts_id; // phpcs:ignore
			},
		)
	);
}


add_action( 'graphql_register_types', 'graphql_register_page_template_slug' );


/**
 * Register page template slug
 *
 * @return void
 */
function graphql_register_page_template_slug() : void {
	register_graphql_field(
		'Page',
		'pageTemplateSlug',
		array(
			'type'        => 'String',
			'description' => 'WordPress page template slug',
			'resolve'     => function( object $page ) : string {
				$page_template_slug = get_page_template_slug( $page );

				return $page_template_slug || '';
			},
		)
	);
}
