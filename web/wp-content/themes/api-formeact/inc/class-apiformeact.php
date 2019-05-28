<?php
/**
 * Class API Forméact
 *
 * PHP version 7.3
 *
 * @author  Jérémy Levron <jeremylevron@19h47.fr> (http://19h47.fr)
 * @package ApiFormeact
 */

/**
 * ApiFormeact
 */
class ApiFormeact {

	/**
	 * The name of the theme
	 *
	 * @access private
	 * @var    str
	 */
	private $theme_name;


	/**
	 * The version of this theme
	 *
	 * @access private
	 * @var    str
	 */
	private $theme_version;


	/**
	 * Construct
	 *
	 * Initialize the class and set its properties.
	 *
	 * @access public
	 * @param  str $theme_name    The theme name.
	 * @param  str $theme_version The theme version.
	 */
	public function __construct( $theme_name, $theme_version ) {
		$this->theme_name    = $theme_name;
		$this->theme_version = $theme_version;

		$this->load_dependencies();

		add_action( 'init', array( $this, 'setup' ) );
	}


	/**
	 * Load dependencies description
	 *
	 * @access private
	 * @name   load_dependencies
	 */
	private function load_dependencies() {
		// Custom post types.
		include_once get_template_directory() . '/inc/post-types/class-testimony.php';
		new Testimony( $this->theme_name, $this->get_theme_version() );

		// Custom taxonomies.
		include_once get_template_directory() . '/inc/taxonomies/class-testimonycategory.php';
		new TestimonyCategory( $this->theme_name, $this->get_theme_version() );

		// Custom settings.
		include_once get_template_directory() . '/inc/class-settings.php';
		new Settings( $this->get_theme_name(), $this->get_theme_version() );

		// Blocks.
		include_once get_template_directory() . '/inc/blocks/hero/index.php';

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

		// Register nav menus.
		register_nav_menus(
			array(
				'main'   => __( 'Main' ),
				'footer' => __( 'Footer' )
			)
		);
	}


	/**
	 * Retrieve the version number of the theme.
	 *
	 * @since  1.0.0
	 * @return string    The version number of the plugin.
	 */
	public function get_theme_version() {
		return $this->theme_version;
	}


	/**
	 * The name of the theme used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since  1.0.0
	 * @return string    The name of the plugin.
	 */
	public function get_theme_name() {
		return $this->theme_name;
	}
}

$wp_theme = wp_get_theme();

new ApiFormeact( 'apiformeact', $wp_theme->Version );
