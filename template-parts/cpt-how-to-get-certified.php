<?php
/**
 * Layout: Get certified
 */

// Clone: components settings (group)
$settings = get_sub_field( 'settings' );

// Seamless clone: short text (just the `copy` sub-field)
$short_copy = get_sub_field( 'short_text' );

// Repeater: steps
$steps = get_sub_field( 'step' );

// --- Settings --------------------------------------------------------------

$theme   = ! empty( $settings['theme'] ) ? $settings['theme'] : 'evg-theme-sand';
$padding = ! empty( $settings['padding'] ) ? $settings['padding'] : 'fluid';
$id = get_sub_field( 'id' ); 
$padding_override = ! empty( $settings['padding_override'] ) ? $settings['padding_override'] : '';
$animation        = ! empty( $settings['animation'] ) ? $settings['animation'] : '';

$section_classes = trim( $theme . ' ae-get-certified' );
if ( $padding_override ) {
	$section_classes .= ' padding_override';
}

$has_animation = $animation && 'none' !== $animation;
?>

<evg-section
	<?php if(!empty($id)) { echo 'id="'.esc_attr( $id ).'"'; } ?>
	class="<?php echo esc_attr( $section_classes ); ?>"
	padding="<?php echo esc_attr( $padding ); ?>"
>
	<?php if ( $has_animation ) : ?>
		<evg-enter delay="0.5" type="<?php echo esc_attr( $animation ); ?>">
	<?php endif; ?>

	<evg-wrapper size="xxl" class="evg-spacing-bottom-lg">
		<?php
		// Title = clone (Group) of your header title.
		// `cpt-title.php` should already be written to work with clone groups,
		// so we just include it here.
		include locate_template( 'template-parts/cpt-title.php' );
		?>

		<?php include locate_template( 'template-parts/cpt-short-text.php' ); ?>
	</evg-wrapper>

	<?php if ( $steps ) : ?>
		<evg-wrapper size="xxl" class="evg-spacing-bottom-lg">
			<evg-grid wrap="wrap">
				<?php foreach ( $steps as $step ) :

					$step_title = ! empty( $step['step_title'] ) ? $step['step_title'] : '';
					$sentence   = ! empty( $step['sentence'] ) ? $step['sentence'] : '';

					?>
					<evg-grid-item
						fill
						large-tablet="2"
						small-mobile="12"
						small-tablet="6"
					>
						<evg-card class="evg-theme-default" radius="md">
							<evg-card-content>
								<?php if ( $step_title ) : ?>
									<h3>
										<?php echo esc_html( $step_title ); ?>
									</h3>
								<?php endif; ?>

								<?php if ( $sentence ) : ?>
									<p>
										<?php echo esc_html( $sentence ); ?>
									</p>
								<?php endif; ?>
							</evg-card-content>
						</evg-card>
					</evg-grid-item>
				<?php endforeach; ?>
			</evg-grid>
		</evg-wrapper>
	<?php endif; ?>

	
	<?php
	// CTA = clone (Group) of your CTA controls.
	// Use the updated cpt-cta.php that supports clone groups.
	include locate_template( 'template-parts/cpt-cta.php' );
	?>

	<?php if ( $has_animation ) : ?>
		</evg-enter>
	<?php endif; ?>

</evg-section>