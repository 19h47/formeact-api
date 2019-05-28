<?php
/**
 * This is the template that displays the hero block.
 */

$fields = get_fields();

// Create id attribute allowing for custom "anchor" value.
$id = 'hero-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'Hero';
if ( ! empty( $block['className'] ) ) {
     $className .= ' ' . $block['className'];
 }

 if( ! empty( $block['align'] ) ) {
     $className .= ' align' . $block['align'];
 }

 // Load values and assing defaults.
 $title   = $fields['title'] ?: 'Your title goes here';
 $content = $fields['content'] ?: 'Your content goes here';
 $label   = $fields['link_label'];
 $slug    = $fields['link_slug'];

 ?>
 <style>
 	body {
 		color: red;
 	}
 </style>
 <div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $className ); ?>">
     <h1><?php echo $title ?></h1>
	 <p><?php echo $content ?></p>
	 <a href="<?php echo $fields['link_slug'] ?>" target="_blank"><?php echo $fields['link_label'] ?></a>
 </div>
