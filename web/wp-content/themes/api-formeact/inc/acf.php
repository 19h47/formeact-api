<?php
/**
 * ACF
 *
 * @package ApiForméact
 */

/**
 * ACF disable field
 *
 * Useful for region and department fields.
 *
 * @param array $field The field settings array. This can be modified and then returned.
 *
 * @link https://www.advancedcustomfields.com/resources/acf-load_field/
 * @return $field
 */
function acf_disable_field( array $field ) {
	$field['disabled'] = true;
	$field['readonly'] = true;

	return $field;
}

add_filter( 'acf/load_field/key=field_5d8f20deef0d7', 'acf_disable_field' );
add_filter( 'acf/load_field/key=field_5d8e03948aa20', 'acf_disable_field' );
add_filter( 'acf/load_field/key=field_5d57dbdad0fb3', 'acf_disable_field' );
add_filter( 'acf/load_field/key=field_5d57109717a06', 'acf_disable_field' );
add_filter( 'acf/load_field/key=field_5d56bd6de65eb', 'acf_disable_field' );
add_filter( 'acf/load_field/key=field_5d56b12257489', 'acf_disable_field' );
