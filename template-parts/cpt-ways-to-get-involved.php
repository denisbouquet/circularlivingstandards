<?php
// Flexible content layout: ways_to_get_involved

// Repeater
$items = get_sub_field( 'item' );

// Settings (seamless clone)
$animation        = get_sub_field( 'animation' );        // e.g. 'fade-in-up' or 'none'
$theme            = get_sub_field( 'theme' ) ?: 'default';
$padding          = get_sub_field( 'padding' ) ?: 'fluid';
$padding_override = get_sub_field( 'padding_override' ); // optional extra class

// Right link (top-right button)
$right_link = get_sub_field( 'right_link' );

// Build section class
$section_classes = 'evg-theme-' . $theme;
if ( $padding_override ) {
	$section_classes .= ' ' . esc_attr( $padding_override );
}

// Simple animation flag
$has_animation = $animation && 'none' !== $animation;
?>

<?php if ( $items ) : ?>
<evg-section padding="<?php echo esc_attr( $padding ); ?>" class="<?php echo esc_attr( $section_classes ); ?>">
	<?php if ( $has_animation ) : ?>
		<evg-enter delay="0.5" type="<?php echo esc_attr( $animation ); ?>">
	<?php endif; ?>

	<evg-wrapper size="xl">

		<evg-grid justify-content="space-between" align-items="center" class="evg-spacing-bottom-lg">
			<evg-grid-item>
				<?php
				// TITLE – clone (group) handled by partial (expects h2 etc.)
				// e.g. template-parts/cpt-title.php should use get_sub_field( 'title' ) internally.
				include locate_template( 'template-parts/cpt-title.php' );
				?>
			</evg-grid-item>

			<?php if ( ! empty( $right_link['url'] ) ) : ?>
				<evg-grid-item>
					<evg-button variant="ghost">
						<a href="<?php echo esc_url( $right_link['url'] ); ?>"
						   <?php if ( ! empty( $right_link['target'] ) ) : ?>
							   target="<?php echo esc_attr( $right_link['target'] ); ?>"
						   <?php endif; ?>>
							<?php echo esc_html( $right_link['title'] ?: __( 'Find out more', 'textdomain' ) ); ?>
							<evg-icon icon="external-link"></evg-icon>
						</a>
					</evg-button>
				</evg-grid-item>
			<?php endif; ?>
		</evg-grid>

		<?php
		// SHORT TEXT – seamless clone of `copy`
		include locate_template( 'template-parts/cpt-wysiwyg.php' );
		?>

		<evg-grid wrap="wrap" gap="lg" class="evg-spacing-bottom-lg">
			<?php foreach ( $items as $row ) :

				$item_title = isset( $row['item_title'] ) ? $row['item_title'] : '';
				$image      = isset( $row['image'] ) ? $row['image'] : null;
				$link       = isset( $row['link'] ) ? $row['link'] : null;

				// Image data
				$img_url = '';
				$img_alt = $item_title;

				if ( is_array( $image ) ) {
					$img_url = ! empty( $image['url'] ) ? $image['url'] : '';
					if ( ! empty( $image['alt'] ) ) {
						$img_alt = $image['alt'];
					}
				} elseif ( $image ) {
					$img_url = $image;
				}

				// Link data
				$link_url    = is_array( $link ) && ! empty( $link['url'] ) ? $link['url'] : '';
				$link_title  = is_array( $link ) && ! empty( $link['title'] ) ? $link['title'] : '';
				$link_target = is_array( $link ) && ! empty( $link['target'] ) ? $link['target'] : '_self';
				?>
				<evg-grid-item small-mobile="12" small-tablet="6" tablet="4">
					<?php if ( $link_url ) : ?>
						<a href="<?php echo esc_url( $link_url ); ?>"
						   target="<?php echo esc_attr( $link_target ); ?>"
						   class="ae-ways-item"
						   <?php if ( $link_title ) : ?>
							   aria-label="<?php echo esc_attr( $link_title ); ?>"
						   <?php endif; ?>>
					<?php endif; ?>

					<?php if ( $img_url ) : ?>
						<evg-img radius="md" aria-hidden="true" aspect-ratio="auto" object-fit="fill" object-position="50% 50%">
							<img
								src="<?php echo esc_url( $img_url ); ?>"
								alt="<?php echo esc_attr( $img_alt ); ?>"
								width="400"
								height="300"
								loading="lazy"
							/>
						</evg-img>
					<?php endif; ?>

					<?php if ( $item_title ) : ?>
						<h3 class="evg-text-size-heading-sm">
							<?php echo esc_html( $item_title ); ?>
						</h3>
					<?php endif; ?>

					<?php if ( $link_url ) : ?>
						</a>
					<?php endif; ?>
				</evg-grid-item>
			<?php endforeach; ?>
		</evg-grid>

		<?php
		// CTA – clone (group) handled by partial
		include locate_template( 'template-parts/cpt-cta.php' );
		?>

	</evg-wrapper>

	<?php if ( $has_animation ) : ?>
		</evg-enter>
	<?php endif; ?>
</evg-section>
<?php endif; ?>