<?php
/**
 * Logo list grid (used inside an <evg-wrapper>)
 */

// Repeater rows
$rows = get_sub_field( 'images' );

// Settings
$logo_size      = get_sub_field( 'spacing_bottom_copy' ); // ae-logo-list--sm / ae-logo-list--md
$logo_align          = get_sub_field( 'logo_align' );               // left / center
$spacing_bottom = get_sub_field( 'spacing_bottom' );      // evg-spacing-bottom-*

if ( $rows ) :

	// Build grid classes
	$grid_classes = array_filter( [
		$logo_size,
		$spacing_bottom,
	] );
	$grid_class_attr = implode( ' ', $grid_classes );

	?>
	
	<evg-enter delay="0.5" type="fade-in-up">
		<evg-grid
			wrap="wrap"
			justify-content="<?php echo esc_attr( $logo_align ); ?>"
			class="<?php echo esc_attr( $grid_class_attr ); ?>"
		>
			<?php foreach ( $rows as $row ) :

				$image = $row['image'] ?? null;
				if ( ! $image ) {
					continue;
				}

				// ACF image handling
				if ( is_array( $image ) ) {
					$img_url    = $image['url'] ?? '';
					$img_alt    = $image['alt'] ?? '';
					$img_width  = $image['width'] ?? 400;
					$img_height = $image['height'] ?? 300;
				} else {
					$img_url    = $image;
					$img_alt    = '';
					$img_width  = 400;
					$img_height = 300;
				}

				if ( ! $img_url ) {
					continue;
				}
				?>
				
				<evg-grid-item>
					<evg-card-img>
						<img
							src="<?php echo esc_url( $img_url ); ?>"
							alt="<?php echo esc_attr( $img_alt ); ?>"
							width="<?php echo esc_attr( $img_width ); ?>"
							height="<?php echo esc_attr( $img_height ); ?>"
							loading="lazy"
						/>
					</evg-card-img>
				</evg-grid-item>

			<?php endforeach; ?>
		</evg-grid>
	</evg-enter>

<?php endif; ?>