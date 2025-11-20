<?php
/**
 * CTA component
 *
 * Supports:
 * - Clone (Group) field named "cta" containing: link, variant, size, width/size_copy
 * - Legacy: direct sub fields link / variant / size / width
 */

// Try to read from a clone-as-group first.
$cta_group = get_sub_field( 'cta' );

if ( is_array( $cta_group ) ) {
	// New structure: fields are inside the "cta" group.
	$link    = $cta_group['link']    ?? null; // ACF link array
	$variant = $cta_group['variant'] ?? '';
	$size    = $cta_group['size']    ?? '';
	// Handle either "width" or the older "size_copy" name.
	$width   = $cta_group['width']   ?? ( $cta_group['size_copy'] ?? '' );
	$cta_align    = $cta_group['cta_align']    ?? '';

} else {
	// Fallback: old structure where fields live directly on the layout.
	$link    = get_sub_field( 'link' );       // Link field (array)
	$variant = get_sub_field( 'variant' );    // primary, secondary, ghost...
	$size    = get_sub_field( 'size' );       // sm, md, lg
	$width   = get_sub_field( 'width' );      // auto, full-width-mobile, etc.
	$cta_align   = get_sub_field( 'cta_align' );      // align
}

// If we still don't have a link, nothing to render.
if ( ! $link || ! is_array( $link ) ) {
	return;
}

// Link properties.
$url    = $link['url']    ?? '';
$label  = $link['title']  ?? '';
$target = $link['target'] ?? '';

if ( ! $url ) {
	return;
}

if ( ! $label ) {
	$label = 'Read more';
}

if ( ! $target ) {
	$target = '_self';
}

// Build button attributes.
$attributes = [];

if ( $variant ) {
	$attributes[] = 'variant="' . esc_attr( $variant ) . '"';
}

if ( $size ) {
	$attributes[] = 'size="' . esc_attr( $size ) . '"';
}

if ( $width ) {
	$attributes[] = 'width="' . esc_attr( $width ) . '"';
}

$attr_string = $attributes ? ' ' . implode( ' ', $attributes ) : '';
?>


<div class="<?php echo $cta_align; ?>">
	<evg-button <?php echo $attr_string; ?>>
		<a href="<?php echo esc_url( $url ); ?>" target="<?php echo esc_attr( $target ); ?>">
			<?php echo esc_html( $label ); ?>
		</a>
	</evg-button>
</div>

<?php unset($cta_group); ?>