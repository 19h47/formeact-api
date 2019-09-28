<?php

add_action( 'graphql_register_types', 'graphql_register_tweet_url' );

function graphql_register_tweet_url() {
	register_graphql_field(
		'Tweet',
		'tweetUrl',
		array(
			'type'        => 'String',
			'description' => __( 'The original url of the tweet', 'api-formeact' ),
			'resolve'     => function( $post ) {
				$tweet_url = get_post_meta( $post->ID, '_tweet_url', true );

				return $tweet_url;
			},
		)
	);
}
