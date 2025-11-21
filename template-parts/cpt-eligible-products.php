<?php
/**
 * Flexible content layout: eligible_products
 *
 * Fields
 * - title       (Clone – Header title group, displayed as Group)
 * - icon        (Image)
 * - tags        (Repeater)
 *      - tag    (Text)
 * - short_copy  (Clone – Text block (short), displayed as Group)
 */

// ----- Title (clone-as-group) -----
$title_group = get_sub_field( 'title_eligible' );

$title_text        = '';
$title_uppercase   = false;
$title_tag         = 'h2';
$title_font_size   = '';
$title_spacing     = '';
$title_align       = '';

// Clone displayed as Group returns an array of sub-fields
if ( is_array( $title_group ) ) {
	$title_text      = $title_group['title']        ?? '';
	$title_uppercase = ! empty( $title_group['uppercase'] );
	$title_tag       = $title_group['title_tag']    ?? 'h2';
	$title_font_size = $title_group['title_font_size'] ?? '';
	$title_spacing   = $title_group['title_spacing']    ?? '';
	$title_align     = $title_group['title_align']      ?? '';
} else {
	// Very safe fallback (if ever used without clone group)
	$title_text      = get_sub_field( 'title' );
	$title_uppercase = get_sub_field( 'uppercase' );
	$title_tag       = get_sub_field( 'title_tag' ) ?: 'h2';
	$title_font_size = get_sub_field( 'title_font_size' );
	$title_spacing   = get_sub_field( 'title_spacing' );
	$title_align     = get_sub_field( 'title_align' );
}

// Fallback classes for title
$title_font_size = $title_font_size ?: 'evg-text-size-heading-md';
$title_spacing   = $title_spacing   ?: 'evg-spacing-bottom-md';
$title_align     = $title_align     ?: '';

$title_classes   = [];
$title_classes[] = $title_font_size;
$title_classes[] = $title_align;
$title_classes[] = $title_spacing;

if ( $title_uppercase ) {
	$title_classes[] = 'evg-text-transform-uppercase';
}

// ----- Icon image -----
$icon     = get_sub_field( 'icon' );
$icon_url = '';
$icon_alt = '';

if ( $icon ) {
	if ( is_array( $icon ) ) {
		$icon_url = $icon['url'] ?? '';
		$icon_alt = $icon['alt'] ?? '';
	} else {
		$icon_url = $icon;
	}
}

// ----- Tags repeater -----
$tags = get_sub_field( 'tags' );

// ----- Short copy (clone-as-group) -----
$short_group = get_sub_field( 'short_copy' );
$short_copy  = '';
$short_align = '';
$short_size  = '';
$short_space = '';

if ( is_array( $short_group ) ) {
	$short_copy  = $short_group['copy']            ?? '';
	$short_align = $short_group['align']           ?? '';
	$short_size  = $short_group['font-size']       ?? '';
	$short_space = $short_group['spacing_bottom']  ?? '';
} else {
	// Fallback if ever used without clone
	$short_copy  = get_sub_field( 'copy' );
	$short_align = get_sub_field( 'align' );
	$short_size  = get_sub_field( 'font-size' );
	$short_space = get_sub_field( 'spacing_bottom' );
}

$short_classes = array_filter( [
	$short_align,
	$short_size,
	$short_space,
] );
?>

<evg-section padding="none">
	<evg-wrapper size="xl" class="evg-longform">
		<div class="evg-text-size-body-lg">

			<?php if ( $title_text ) : ?>
				<<?php echo esc_attr( $title_tag ); ?> class="<?php echo esc_attr( implode( ' ', $title_classes ) ); ?>">
					<?php echo esc_html( $title_text ); ?>
				</<?php echo esc_attr( $title_tag ); ?>>
			<?php endif; ?>

			<evg-divider></evg-divider>

			<div class="ae-eligible-product-list">
				<evg-grid wrap="wrap" align-items="center" class="evg-spacing-bottom-lg">

					<evg-grid-item small-mobile="12" small-tablet="3" large-tablet="1">
						<?php if ( $icon_url ) : ?>
							<img src="<?php echo esc_url( $icon_url ); ?>"
							     alt="<?php echo esc_attr( $icon_alt ); ?>">
						<?php endif; ?>
					</evg-grid-item>

					<evg-grid-item small-mobile="12" small-tablet="9" large-tablet="10">
						<?php if ( $tags ) : ?>
							<ul>
								<?php foreach ( $tags as $tag_row ) :
									$tag_text = $tag_row['tag'] ?? '';
									if ( ! $tag_text ) {
										continue;
									}
									?>
									<li>
										<span class="ae-tag evg-text-size-body-md">
											<?php echo esc_html( $tag_text ); ?>
										</span>
									</li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
					</evg-grid-item>

				</evg-grid>
			</div>

			<evg-divider class="evg-spacing-bottom-md"></evg-divider>

			<?php if ( $short_copy ) : ?>
				<p class="evg-text-size-body-lg <?php echo esc_attr( implode( ' ', $short_classes ) ); ?>">
					<?php echo wp_kses_post( $short_copy ); ?>
				</p>
			<?php endif; ?>

		</div>
	</evg-wrapper>
</evg-section>

<?php
// Clean up
unset(
	$title_group,
	$title_text,
	$short_group,
	$short_copy,
	$tags,
	$icon,
	$icon_url,
	$icon_alt
);
?>