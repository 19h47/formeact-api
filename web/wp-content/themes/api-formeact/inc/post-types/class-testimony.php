<?php
/**
 * Testimony class
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
	 * @access public
	 */
	public function __construct( $theme_name, $theme_version ) {
		$this->theme_name = $theme_name;
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
			'name'                  => _x( 'Témoignages', 'Témoignage pluriel', $this->theme_name ),
	        	'singular_name'         => _x( 'Témoignage', 'Témoignage singulier', $this->theme_name ),
	        	'menu_name'             => __( 'Témoignages', $this->theme_name ),
	        	'name_admin_bar'        => __( 'Témoignage', $this->theme_name ),
	        	'parent_item_colon'     => __( '', $this->theme_name ),
	        	'all_items'             => __( 'Tous les témoignages', $this->theme_name ),
	        	'add_new_item'          => __( 'Ajouter un témoignage', $this->theme_name ),
	        	'add_new'               => __( 'Ajouter', $this->theme_name ),
	        	'new_item'              => __( 'Nouveau témoignage', $this->theme_name ),
	        	'edit_item'             => __( 'Modifier le témoignage', $this->theme_name ),
	        	'update_item'           => __( 'Mettre à jour le témoignage', $this->theme_name ),
	        	'view_item'             => __( 'Voir le témoignage', $this->theme_name ),
	        	'view_items'            => __( 'Voir les témoignages', $this->theme_name ),
	        	'search_items'          => __( 'Chercher parmi les témoignages', $this->theme_name ),
	        	'not_found'             => __( 'Aucun témoignage trouvé.', $this->theme_name ),
	        	'not_found_in_trash'    => __( 'Aucun témoignage trouvé dans la corbeille.', $this->theme_name ),
	        	'featured_image'        => __( 'Image à la une', $this->theme_name ),
	        	'set_featured_image'    => __( 'Mettre une image à la une', $this->theme_name ),
	        	'remove_featured_image' => __( 'Retirer l\'image mise à la une', $this->theme_name ),
	        	'use_featured_image'    => __( 'Mettre une image à la une', $this->theme_name ),
	        	'insert_into_item'      => __( 'Insérer dans le témoignage', $this->theme_name ),
	        	'uploaded_to_this_item' => __( 'Ajouter à ce témoignage', $this->theme_name ),
	        	'items_list'            => __( 'Liste des témoignages', $this->theme_name ),
	        	'items_list_navigation' => __( 'Navigation de liste des témoignages', $this->theme_name ),
	        	'filter_items_list'     => __( 'Filtrer la liste des témoignages', $this->theme_name ),
		);

		$rewrite = array(
        	'slug'                	=> 'témoignages',
        	'with_front'          	=> true,
        	'pages'               	=> true,
        	'feeds'               	=> true,
    	);

		$args = array(
			'label'               	=> 'témoignage',
        	'description'         	=> __( 'Les témoignages', $this->theme_name ),
        	'labels'              	=> $labels,
        	'supports'            	=> array( 'title', 'editor' ),
        	'taxonomies'          	=> array( 'testimony_category' ),
        	'hierarchical'        	=> false,
        	'public'              	=> true,
        	'show_ui'             	=> true,
        	'show_in_nav_menus'   	=> true,
        	'show_in_menu'        	=> true,
        	'show_in_admin_bar'   	=> true,
        	'show_in_rest'   		=> true,
        	'menu_position'       	=> 5,
        	'menu_icon'           	=> 'dashicons-format-quote',
        	'can_export'          	=> true,
        	'has_archive'         	=> true,
        	'exclude_from_search' 	=> false,
        	'publicly_queryable'  	=> true,
        	'rewrite'             	=> $rewrite,
        	'capability_type'     	=> 'post',
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


	// public function admin_css() {
	// 	global $typenow;

	// 	if ( 'adult_training' !== $typenow ) {
	// 		return;
	// 	}
	// }


	/**
	 * Add custom columns
	 *
	 * @param $columns
	 */
	// public function add_custom_columns( $columns ) {
	// 	global $typenow;

	// 	if ( 'adult_training' !== $typenow ) {
	// 		return;
	// 	}
	// 	unset( $columns['date'] );
	//     $new_columns = array();

	//   	foreach( $columns as $key => $value ) {
 //      	  	if ( $key === 'title' ) {
 //      	  		// Title
 //      	  		$new_columns[$key] = $value;
	//       	  	$new_columns['type'] = 'Type de formation';
 //      	  	}
 //      		$new_columns[$key] = $value;
	//   	}
	//   	return $new_columns;
	// }


    /**
     * Render custom columns
     *
     * @param $column_name
     * @param $post_id
     */
    // public function render_custom_columns( $column_name, $post_id ) {
    // 	global $typenow;

    // 	if ( 'adult_training' !== $typenow ) {
    // 		return;
    // 	}
    //     switch ( $column_name ) {
    // 		case 'type' :

				// $type = get_field( 'type', $post_id );
    // 			if ( $type ) {
    // 				echo $type['label'];
    // 			} else {
    // 				echo '—';
    // 			}
    // 			break;
    //     }
    // }


	/**
	 * "At a glance" items (dashboard widget): add the testimony.
	 */
	public function at_a_glance( $items ) {
	    $post_type = 'testimony';
	    $post_status = 'publish';
	    $object = get_post_type_object( $post_type );

	    $num_posts = wp_count_posts( $post_type );
	    if ( ! $num_posts || ! isset ( $num_posts->{$post_status} ) || 0 === (int) $num_posts->{$post_status} ) {

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