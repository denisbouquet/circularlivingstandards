<?php
// Flexible content layout: text_block (example name)
$copy           = get_sub_field( 'copy' );        // WYSIWYG
$align          = get_sub_field( 'align' );       // Button group
$font_size      = get_sub_field( 'font-size' );   // Button group
$spacing_bottom = get_sub_field( 'spacing_bottom' ); // Button group

if ( $copy ) {

	// Build class attribute
	$classes = array_filter( [
		$align,
		$font_size,
		$spacing_bottom,
	] );
	$class_attr = implode( ' ', $classes );
	?>
	
	<div class="evg-longform evg-longform-ae <?php echo esc_attr( $class_attr ); ?>">
		<?php echo wp_kses_post( $copy ); ?>
	</div>

<?php } ?>