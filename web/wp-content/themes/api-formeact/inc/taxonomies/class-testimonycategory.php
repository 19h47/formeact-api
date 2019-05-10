<?php
/**
 * Testimony categories tag class
 *
 * @package ApiFormeact
 */

/**
 * Class Testimony category
 */
class TestimonyCategory {

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
	 * @param str $theme_name    The theme name.
	 * @param str $theme_version The theme version.
	 * @access public
	 */
	public function __construct( $theme_name, $theme_version ) {
		$this->theme_name    = $theme_name;
		$this->theme_version = $theme_version;

		add_action( 'init', array( $this, 'register_taxonomy' ), 0 );
	}


	/**
	 * Register Custom Taxonomy
	 */
	public function register_taxonomy() {
		$labels = array(
			'name'                       => _x( 'Catégories de témoignage', 'Taxonomy General Name', 'api-formeact' ),
			'singular_name'              => _x( 'Catégorie de témoignage', 'Taxonomy Singular Name', 'api-formeact' ),
			'menu_name'                  => __( 'Catégories de témoignage', 'api-formeact' ),
			'all_items'                  => __( 'Toutes les catégories de témoignage', 'api-formeact' ),
			'parent_item'                => __( 'Catégorie de témoignage parente', 'api-formeact' ),
			'parent_item_colon'          => __( 'Catégorie de témoignage parente :', 'api-formeact' ),
			'new_item_name'              => __( 'Nom de la nouvelle catégorie de témoignage', 'api-formeact' ),
			'add_new_item'               => __( 'Ajouter une nouvelle catégorie de témoignage', 'api-formeact' ),
			'edit_item'                  => __( 'Éditer la catégorie de témoignage', 'api-formeact' ),
			'update_item'                => __( 'Mettre à jour la catégorie de témoignage', 'api-formeact' ),
			'view_item'                  => __( 'Voir la catégorie de témoignage', 'api-formeact' ),
			'separate_items_with_commas' => __( 'Séparer les catégories de témoignage par des virgules', 'api-formeact' ),
			'add_or_remove_items'        => __( 'Ajouter ou supprimer une catégorie de témoignage', 'api-formeact' ),
			'choose_from_most_used'      => __( 'Choisir parmi les catégories de témoignage les plus utilisées', 'api-formeact' ),
			'popular_items'              => __( 'Catégorie de témoignage populaire', 'api-formeact' ),
			'search_items'               => __( 'Catégories de témoignage recherchées', 'api-formeact' ),
			'not_found'                  => __( 'Aucune catégorie de témoignage n\'a été trouvée', 'api-formeact' ),
			'no_terms'                   => __( 'Pas de catégorie de témoignage', 'api-formeact' ),
			'items_list'                 => __( 'Liste des catégories de témoignage', 'api-formeact' ),
			'items_list_navigation'      => __( 'Liste de navigation des catégories de témoignage', 'api-formeact' ),
		);

		$args = array(
			'labels'            => $labels,
			'hierarchical'      => false,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud'     => true,
		);

		register_taxonomy( 'testimony_category', array( 'testimony' ), $args );
	}
}
