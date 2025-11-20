<?php
// Flexible content: heading block

// Get the clone group (now named 'title_group')
$title_field = get_sub_field( 'title_group' );

// Default values
$title           = '';
$uppercase       = false;
$title_tag       = 'h2';
$title_font_size = '';
$title_spacing   = '';
$title_align     = '';

// Handle clone-as-group (returns an array)
if ( is_array( $title_field ) ) {
	$title           = $title_field['title']           ?? '';
	$uppercase       = ! empty( $title_field['uppercase'] );
	$title_tag       = $title_field['title_tag']       ?? $title_tag;
	$title_font_size = $title_field['title_font_size'] ?? '';
	$title_spacing   = $title_field['title_spacing']   ?? '';
	$title_align     = $title_field['title_align']     ?? '';

} else {
	// Legacy fallback
	$title           = get_sub_field( 'title' );
	$uppercase       = get_sub_field( 'uppercase' );
	$title_tag       = get_sub_field( 'title_tag' ) ?: $title_tag;
	$title_font_size = get_sub_field( 'title_font_size' );
	$title_spacing   = get_sub_field( 'title_spacing' );
	$title_align     = get_sub_field( 'title_align' );
}

// Normalise tag (only allow h1 / h2 / h3)
$allowed_tags = [ 'h1', 'h2', 'h3' ];
if ( ! in_array( $title_tag, $allowed_tags, true ) ) {
	$title_tag = 'h2';
}

// Fallback values
$title_font_size = $title_font_size ?: 'evg-text-size-heading-md';
$title_spacing   = $title_spacing   ?: 'evg-spacing-bottom-md';
$title_align     = $title_align     ?: '';

// Build classes
$classes   = [];
$classes[] = $title_font_size;
$classes[] = $title_align;
$classes[] = $title_spacing;

if ( $uppercase ) {
	$classes[] = 'evg-text-transform-uppercase';
}
?>

<?php if ( $title ) : ?>
	<<?php echo esc_attr( $title_tag ); ?> class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
		<?php echo esc_html( $title ); ?>
	</<?php echo esc_attr( $title_tag ); ?>>
<?php endif; ?>

<?php unset( $title_field, $title ); ?>