<?php
/**
 * Testimony class
 *
 * @package ApiFormeact
 */

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
	 * @param str $theme_name    The theme name.
	 * @param str $theme_version The the version.
	 * @access public
	 */
	public function __construct( $theme_name, $theme_version ) {
		$this->theme_name    = $theme_name;
		$this->theme_version = $theme_version;

		$this->register_post_type();
		add_action( 'init', array( $this, 'register_post_type' ) );
		add_action( 'admin_head', array( $this, 'css' ) );

		add_filter( 'dashboard_glance_items', array( $this, 'at_a_glance' ) );
	}


	/**
	 * Register Custom Post Type
	 */
	public function register_post_type() {
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
		);
		register_post_type( 'testimony', $args );
	}


	/**
	 * CSS
	 */
	public function css() {

		?>
		<style>
			#dashboard_right_now .testimony-count:before { content: "\f122"; }
		</style>
		<?php
	}


	/**
	 * "At a glance" items (dashboard widget): add the testimony.
	 *
	 * @param arr $items Array of items.
	 */
	public function at_a_glance( $items ) {
		$post_type   = 'testimony';
		$post_status = 'publish';
		$object      = get_post_type_object( $post_type );

		$num_posts = wp_count_posts( $post_type );
		if ( ! $num_posts || ! isset( $num_posts->{$post_status} ) || 0 === (int) $num_posts->{$post_status} ) {

			return $items;
		}

		$text = sprintf(
			_n( '%1$s %4$s%2$s', '%1$s %4$s%3$s', $num_posts->{$post_status} ),
			number_format_i18n( $num_posts->{$post_status} ),
			strtolower( $object->labels->singular_name ),
			strtolower( $object->labels->name ),
			'pending' === $post_status ? 'Pending ' : ''
		);

		if ( current_user_can( $object->cap->edit_posts ) ) {
			$items[] = sprintf( '<a class="%1$s-count" href="edit.php?post_status=%2$s&post_type=%1$s">%3$s</a>', $post_type, $post_status, $text );

		} else {
			$items[] = sprintf( '<span class="%1$s-count">%s</span>', $text );
		}

		return $items;
	}
}
