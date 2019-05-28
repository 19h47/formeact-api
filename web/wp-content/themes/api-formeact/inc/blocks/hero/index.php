<?php
/**
 * Plugin Name: Gutenberg Hero ACF
 */

 function register_acf_block_types() {
    // register a testimonial block.
    acf_register_block_type(
		array(
	        'name'            => 'hero',
	        'title'           => __( 'Hero' ),
	        'description'     => __('A custom testimonial block.'),
	        'render_template' => get_template_directory() . '/inc/blocks/hero/template.php',
	        'category'        => 'formatting',
	        'icon'            => 'admin-comments',
	        'keywords'        => array( 'hero' ),
    	)
	);

 }

 // Check if function exists and hook into setup.
 if( function_exists( 'acf_register_block_type' ) ) {
     add_action('acf/init', 'register_acf_block_types');
 }
