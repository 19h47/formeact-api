<?php // phpcs:ignore
/**
 * Class App
 *
 * PHP version 7.3.8
 *
 * @author  Jérémy Levron <jeremylevron@19h47.fr> (https://19h47.fr)
 * @package Formeact
 */

namespace Formeact;

use Formeact\PostTypes\{ Testimony };
use Formeact\Taxonomies\{ TestimonyCategory };
use Formeact\{ Settings };

use Set_Glance_Items;

/**
 * Formeact
 */
class App {

	/**
	 * The name of the theme
	 *
	 * @access private
	 * @var    string
	 */
	private $theme_name;


	/**
	 * The version of this theme
	 *
	 * @access private
	 * @var    string
	 */
	private $theme_version;


	/**
	 * Construct
	 *
	 * Initialize the class and set its properties.
	 *
	 * @access public
	 * @param  string $theme_name    The theme name.
	 * @param  string $theme_version The theme version.
	 */
	public function __construct( string $theme_name, string $theme_version ) {
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
	private function load_dependencies() : void {
		include_once get_template_directory() . '/inc/acf.php';

		// Custom post types.
		new Testimony( $this->theme_name, $this->get_theme_version() );

		// Custom taxonomies.
		new TestimonyCategory( $this->theme_name, $this->get_theme_version() );

		// Custom settings.
		new Settings( $this->get_theme_name(), $this->get_theme_version() );

		// WPGraphQL.
		include_once get_template_directory() . '/inc/wpgraphql.php';

		// Set glance items plugin.
		if ( class_exists( 'Set_Glance_Items' ) ) {
			new Set_Glance_Items(
				array(
					array(
						'name' => 'testimony_category',
						'code' => '\f11d',
					),
				),
				array(
					array(
						'name' => 'testimony',
						'code' => '\f122',
					),
					array(
						'name' => 'tweet',
						'code' => '\f301',
					),
				)
			);
		}
	}


	/**
	 * Setup
	 *
	 * @return void
	 * @access public
	 */
	public function setup() : void {
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
				'primary' => __( 'Primary' ),
				'footer'  => __( 'Footer' ),
			)
		);
	}


	/**
	 * Retrieve the version number of the theme.
	 *
	 * @since  1.0.0
	 * @return string    The version number of the plugin.
	 */
	public function get_theme_version() : string {
		return $this->theme_version;
	}


	/**
	 * The name of the theme used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since  1.0.0
	 * @return string    The name of the plugin.
	 */
	public function get_theme_name() : string {
		return $this->theme_name;
	}
}
