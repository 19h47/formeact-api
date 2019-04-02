<?php
/**
 * Testimony categories tag class
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
	 * @access public
	 */
	public function __construct( $theme_name, $theme_version ) {
		$this->theme_name = $theme_name;
        $this->theme_version = $theme_version;

        add_action( 'init', array( $this, 'register_taxonomy' ), 0 );
	}


	/**
	 * Register Custom Taxonomy
	 */
	function register_taxonomy() {
		$labels = array(
			'name'                       	=> _x( 'Catégories de témoignage', 'Taxonomy General Name', $this->theme_name ),
			'singular_name'              	=> _x( 'Catégorie de témoignage', 'Taxonomy Singular Name', $this->theme_name ),
			'menu_name'                  	=> __( 'Catégories de témoignage', $this->theme_name ),
			'all_items'                  	=> __( 'Toutes les catégories de témoignage', $this->theme_name ),
			'parent_item'                	=> __( 'Catégorie de témoignage parente', $this->theme_name ),
			'parent_item_colon'          	=> __( 'Catégorie de témoignage parente :', $this->theme_name ),
			'new_item_name'              	=> __( 'Nom de la nouvelle catégorie de témoignage', $this->theme_name ),
			'add_new_item'               	=> __( 'Ajouter une nouvelle catégorie de témoignage', $this->theme_name ),
			'edit_item'                  	=> __( 'Éditer la catégorie de témoignage', $this->theme_name ),
			'update_item'                	=> __( 'Mettre à jour la catégorie de témoignage', $this->theme_name ),
			'view_item'                  	=> __( 'Voir la catégorie de témoignage', $this->theme_name ),
			'separate_items_with_commas'	=> __( 'Séparer les catégories de témoignage par des virgules', $this->theme_name ),
			'add_or_remove_items'        	=> __( 'Ajouter ou supprimer une catégorie de témoignage', $this->theme_name ),
			'choose_from_most_used'      	=> __( 'Choisir parmi les catégories de témoignage les plus utilisées', $this->theme_name ),
			'popular_items'              	=> __( 'Catégorie de témoignage populaire', $this->theme_name ),
			'search_items'               	=> __( 'Catégories de témoignage recherchées', $this->theme_name ),
			'not_found'                  	=> __( 'Aucune catégorie de témoignage n\'a été trouvée', $this->theme_name ),
			'no_terms'                   	=> __( 'Pas de catégorie de témoignage', $this->theme_name ),
			'items_list'                 	=> __( 'Liste des catégories de témoignage', $this->theme_name ),
			'items_list_navigation'      	=> __( 'Liste de navigation des catégories de témoignage', $this->theme_name ),
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