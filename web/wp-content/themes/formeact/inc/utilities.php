<?php

if ( ! function_exists( 'get_html_class' ) ) :

/**
 * Retrieve the classes for the html element as an array.
 *
 * @param string|array $class One or more classes to add to the class list.
 * @return array Array of classes.
 */
function get_html_class( $class = '' ) {
	$classes = array();

	if ( ! empty( $class ) ) {
		if ( !is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_merge( $classes, $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );

	/**
	 * Filter the list of CSS html classes for the current post or page.
	 *
	 * @param array  $classes An array of html classes.
	 * @param string $class   A comma-separated list of additional classes added to the html.
	 */
	$classes = apply_filters( 'html_class', $classes, $class );

	return array_unique( $classes );
}

endif;


if ( ! function_exists( 'html_class' ) ) :

/**
 * Display the classes for the html element.
 *
 * @param string|array $class One or more classes to add to the class list.
 */
function html_class( $class = '' ) {
	// Separates classes with a single space, collates classes for html element
	echo 'class="' . join( ' ', get_html_class( $class ) ) . '"';
}

endif;


if ( ! function_exists( 'current_url' ) ) :

/**
 * Return the current url
 * Borrowed from http://wordpress.org/extend/plugins/oa-social-login/
 */
function current_url() {
    // Extract parts
    $request_uri = ( isset( $_SERVER['REQUEST_URI'] ) ? $_SERVER['REQUEST_URI'] : $_SERVER['PHP_SELF'] );
    $request_protocol = ( is_ssl() ? 'https' : 'http' );
    $request_host = ( isset( $_SERVER['HTTP_X_FORWARDED_HOST'] ) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : ( isset( $_SERVER['HTTP_HOST'] ) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'] ) );

    // Port of this request
    $request_port = '';

    // We are using a proxy
    if ( isset( $_SERVER['HTTP_X_FORWARDED_PORT'] ) ) {
        // SERVER_PORT is usually wrong on proxies, don't use it!
        $request_port = intval( $_SERVER['HTTP_X_FORWARDED_PORT'] );
    }
    // Does not seem like a proxy
    elseif ( isset( $_SERVER['SERVER_PORT'] ) ) {
        $request_port = intval( $_SERVER ['SERVER_PORT'] );
    }

    // Remove standard ports
    $request_port = ( ! in_array( $request_port, array( 80, 443 ) ) ? $request_port : '' );

    // Remove port if exists in host
    if ( substr_compare( $request_host, $request_port, strlen( $request_host ) - strlen( $request_port ), strlen( $request_port ) ) === 0 ) {
        $request_port = '';
    }

    // Build url
    $current_url = $request_protocol . '://' . $request_host . ( ! empty( $request_port ) ? ( ':' . $request_port ) : '' ) . $request_uri;

    // Done
    return $current_url;
}

endif;