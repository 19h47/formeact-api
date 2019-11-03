<?php // phpcs:ignore
/**
 * Testimony class
 *
 * @package Formeact
 */

namespace Formeact\PostTypes;

/**
 * Class Testimony
 */
class Testimony {
	/**
	 * The unique identifier of this theme.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this theme.
	 */
	protected $theme_name;

	/**
	 * The version of the theme.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this theme.
	 */
	private $theme_version;


	/**
	 * Construct function
	 *
	 * @param string $theme_name    The theme name.
	 * @param string $theme_version The the version.
	 * @access public
	 */
	public function __construct( string $theme_name, string $theme_version ) {
		$this->theme_name    = $theme_name;
		$this->theme_version = $theme_version;

		add_action( 'init', array( $this, 'register_post_type' ) );
	}


	/**
	 * Register Custom Post Type
	 *
	 * @return void
	 */
	public function register_post_type() : void {
		$labels = array(
			'name'                  => _x( 'Témoignages', 'Témoignage pluriel', 'api-formeact' ),
			'singular_name'         => _x( 'Témoignage', 'Témoignage singulier', 'api-formeact' ),
			'menu_name'             => __( 'Témoignages', 'api-formeact' ),
			'name_admin_bar'        => __( 'Témoignage', 'api-formeact' ),
			'all_items'             => __( 'Tous les témoignages', 'api-formeact' ),
			'add_new_item'          => __( 'Ajouter un témoignage', 'api-formeact' ),
			'add_new'               => __( 'Ajouter', 'api-formeact' ),
			'new_item'              => __( 'Nouveau témoignage', 'api-formeact' ),
			'edit_item'             => __( 'Modifier le témoignage', 'api-formeact' ),
			'update_item'           => __( 'Mettre à jour le témoignage', 'api-formeact' ),
			'view_item'             => __( 'Voir le témoignage', 'api-formeact' ),
			'view_items'            => __( 'Voir les témoignages', 'api-formeact' ),
			'search_items'          => __( 'Chercher parmi les témoignages', 'api-formeact' ),
			'not_found'             => __( 'Aucun témoignage trouvé.', 'api-formeact' ),
			'not_found_in_trash'    => __( 'Aucun témoignage trouvé dans la corbeille.', 'api-formeact' ),
			'featured_image'        => __( 'Image à la une', 'api-formeact' ),
			'set_featured_image'    => __( 'Mettre une image à la une', 'api-formeact' ),
			'remove_featured_image' => __( 'Retirer l\'image mise à la une', 'api-formeact' ),
			'use_featured_image'    => __( 'Mettre une image à la une', 'api-formeact' ),
			'insert_into_item'      => __( 'Insérer dans le témoignage', 'api-formeact' ),
			'uploaded_to_this_item' => __( 'Ajouter à ce témoignage', 'api-formeact' ),
			'items_list'            => __( 'Liste des témoignages', 'api-formeact' ),
			'items_list_navigation' => __( 'Navigation de liste des témoignages', 'api-formeact' ),
			'filter_items_list'     => __( 'Filtrer la liste des témoignages', 'api-formeact' ),
		);

		$rewrite = array(
			'slug'       => 'témoignages',
			'with_front' => true,
			'pages'      => true,
			'feeds'      => true,
		);

		$args = array(
			'label'               => 'témoignage',
			'description'         => __( 'Les témoignages', 'api-formeact' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor' ),
			'taxonomies'          => array( 'testimony_category' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_nav_menus'   => true,
			'show_in_menu'        => true,
			'show_in_admin_bar'   => true,
			'show_in_rest'        => true,
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-format-quote',
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'rewrite'             => $rewrite,
			'capability_type'     => 'post',
			'show_in_graphql'     => true,
			'graphql_single_name' => 'Testimony',
			'graphql_plural_name' => 'testimonies',
		);
		register_post_type( 'testimony', $args );
	}
}
