<?php

/**
 * Forméact functions and definitions
 *
 * @see https://developer.wordpress.org/themes/basics/theme-functions/
 */


// Autoload
require_once( __DIR__ . '/vendor/autoload.php' );


/**
 * Timber
 *
 * Instanciate Timber
 *
 * @see         https://github.com/timber/timber
 * @version     1.7.0
 */
$timber = new \Timber\Timber();


// Tell Timber where are views
Timber::$dirname = array( 'views' );

class FRMCT extends TimberSite {

	/**
	 * The name of the theme
	 *
	 * @access private
	 */
	private $theme_name;


	/**
	 * The version of this theme
	 *
	 * @access private
	 */
	private $theme_version;


	/**
	 * Manifest
	 *
	 * @access private
	 */
	private $theme_manifest;


	/**
	 * Initialize the class and set its properties.
	 *
	 * @param  $theme_name
	 * @param  $theme_version
	 * @access public
	 */
	public function __construct( $theme_name, $theme_version ) {

		$this->theme_name = $theme_name;
		$this->theme_version = $theme_version;

		$this->theme_manifest = json_decode(
		    file_get_contents( __DIR__ . '/dist/manifest.json' ),
		    true
		);

		$this->setup();
		$this->load_dependencies();

		add_filter( 'timber_context', array( $this, 'add_to_context' ) );
		add_filter( 'timber/twig', array( $this, 'add_to_twig' ) );

		parent::__construct();
	}


	/**
	 * Setup
	 *
	 * @access public
	 */
	public function setup() {

		/*
		 * Let WordPress manage the document title.
		 */
		add_theme_support( 'title-tag' );


		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @see https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );


		/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);


		/**
		 * Register nav menus
		 */
		register_nav_menus(
			array(
				'main'          => __( 'Main' ),
			)
		);


		/**
		 * Add excerpt on page
		 *
		 * @see  https://codex.wordpress.org/Function_Reference/add_post_type_support
		 */
		add_post_type_support( 'page', 'excerpt' );
		add_action( 'wp_head', array( $this, 'javascript_detection' ), 2 );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_style' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );


		/**
		 * Add favicons
		 */
		// add_action( 'wp_head', array( $this, 'favicons' ) );
	}


	/**
	 * Load dependencies description
	 *
	 * @access private
	 */
	private function load_dependencies() {
		require_once get_template_directory() . '/inc/utilities.php';
		require_once get_template_directory() . '/inc/reset.php';
		require_once get_template_directory() . '/inc/body-class.php';
		require_once get_template_directory() . '/inc/post-types/Testimony.php';
		require_once get_template_directory() . '/inc/taxonomies/TestimonyCategory.php';

		new Testimony( $this->get_theme_name(), $this->get_theme_version() );
		new TestimonyCategory( $this->get_theme_name(), $this->get_theme_version() );
	}


	/**
	 * Enqueue styles.
	 *
	 * @access public
	 */
	public function enqueue_style() {

		/**
		 * Theme stylesheet
		 */
		wp_register_style(
			$this->theme_name . '-global',
			get_template_directory_uri() . '/dist/' . $this->theme_manifest['main.css'],
			array(),
			null
		);
		wp_enqueue_style( $this->theme_name . '-global' );
	}


	/**
	 * Enqueue scripts
	 *
	 * @access public
	 */
	public function enqueue_scripts() {

		/**
		 * Remove wp-embed script from WordPress
		 */
		wp_deregister_script( 'wp-embed' );


		/**
		 * Remove native version of jQuery and use custom CDN version instead
		 */
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', '//code.jquery.com/jquery-3.1.1.min.js', false, null, true );


		wp_register_script(
			$this->theme_name . '-main',
			get_template_directory_uri() . '/dist/' . $this->theme_manifest['main.js'],
			array(
				'jquery'
			),
			null,
			true
		);

		wp_localize_script(
			$this->theme_name . '-main',
			'wp',
			array(
				'template_directory_uri'    => get_template_directory_uri(),
				'base_url'                  => site_url(),
				'home_url'                  => home_url( '/' ),
				'ajax_url'                  => admin_url( 'admin-ajax.php' ),
				'current_url'               => get_permalink()
			)
		);

		wp_enqueue_script( $this->theme_name . '-main' );
	}


	/**
	 * Add to context
	 *
	 * @return  $context
	 * @access  public
	 */
	public function add_to_context( $context ) {

		// Menus
		$menus = get_registered_nav_menus();
		foreach ( $menus as $menu => $value ) {
			$context['menu'][$menu] = new TimberMenu( $value );
		}

		return $context;
	}


	/**
	 * Add to Twig
	 */
	public function add_to_twig( $twig ) {

		if ( function_exists( 'post_class' ) ) {
			$twig->addFunction( new \Twig_SimpleFunction(
				'post_class', function( $args = '' ) {
					return post_class( $args );
				}
			) );
		}

		if ( function_exists( 'body_class' ) ) {
			$twig->addFunction( new \Twig_SimpleFunction(
				'body_class', function( $args = '' ) {
					return body_class( $args );
				}
			) );
		}

		if ( function_exists( 'html_class' ) ) {
			$twig->addFunction( new \Twig_SimpleFunction(
				'html_class', function( $args = '' ) {
					return html_class( $args );
				}
			) );
		}

		if ( function_exists( 'get_permalink' ) ) {
			$twig->addFunction( new \Twig_SimpleFunction(
				'get_permalink', function( $args = '' ) {
					return get_permalink( $args );
				}
			) );
		}
		if ( function_exists( 'get_the_title' ) ) {
			$twig->addFunction( new \Twig_SimpleFunction(
				'get_the_title', function( $args = '' ) {
					return get_the_title( $args );
				}
			) );
		}

		return $twig;
	}


	/**
	 * Handles JavaScript detection.
	 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
	 *
	 * @access public
	 */
	public function javascript_detection() {
	?>
		<script src="<?php echo get_template_directory_uri() ?>/dist/feature.min.js"></script>
		<script>
			document.documentElement.className = document.documentElement.className.replace('no-js', 'js');

			if (feature.touch && !navigator.userAgent.match(/Trident\/(6|7)\./)) {
				document.documentElement.className = document.documentElement.className.replace('no-touch', 'touch');
			}
		</script>
	<?php
	}


	/**
	 * Retrieve the version number of the theme.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_theme_version() {
		return $this->theme_version;
	}


	/**
	 * The name of the theme used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_theme_name() {
		return $this->theme_name;
	}
}


// Begins execution of the theme.
$theme = new FRMCT( 'frmct', '1.0.0' );