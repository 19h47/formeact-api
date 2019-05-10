<?php

require_once get_template_directory() . '/inc/post-types/class-testimony.php';
require_once get_template_directory() . '/inc/taxonomies/class-testimonycategory.php';

new Testimony( 'api-formeact', '1.0.0' );
new TestimonyCategory( 'api-formeact', '1.0.0' );
