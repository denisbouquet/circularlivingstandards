<?php
/**
 * Text block
 * - supports:
 *   1) Direct fields: copy, align, font-size, spacing_bottom
 *   2) Group clone:   short_text[ copy, align, font-size, spacing_bottom ]
 */

// First, try to get it as a group clone.
$short_text_group = get_sub_field( 'short_text' );

if ( is_array( $short_text_group ) ) {
	// Group (clone) – fields live inside the array.
	$copy           = isset( $short_text_group['copy'] ) ? $short_text_group['copy'] : '';
	$align          = isset( $short_text_group['align'] ) ? $short_text_group['align'] : '';
	$font_size      = isset( $short_text_group['font-size'] ) ? $short_text_group['font-size'] : '';
	$spacing_bottom = isset( $short_text_group['spacing_bottom'] ) ? $short_text_group['spacing_bottom'] : '';
} else {
	// Legacy / direct layout – fields are top-level sub fields.
	$copy           = get_sub_field( 'copy' );            // WYSIWYG
	$align          = get_sub_field( 'align' );           // Button group
	$font_size      = get_sub_field( 'font-size' );       // Button group
	$spacing_bottom = get_sub_field( 'spacing_bottom' );  // Button group
}

if ( $copy ) {

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
	<?php
}