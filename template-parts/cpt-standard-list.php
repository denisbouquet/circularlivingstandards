<?php
// Flexible content layout: standards_list
$title = get_sub_field( 'title' );
$items = get_sub_field( 'item' ); // repeater
?>

<?php if ( $items ) : ?>
<evg-section class="evg-theme-earth-light" padding="fluid">
	<evg-wrapper size="xxl">

		<?php if ( $title ) : ?>
			<h2 class="evg-text-size-heading-md evg-spacing-bottom-lg evg-text-transform-uppercase">
				<?php echo esc_html( $title ); ?>
			</h2>
		<?php endif; ?>

		<evg-enter delay="0.5" type="fade-in-up">
			<evg-grid wrap="wrap">

				<?php foreach ( $items as $item ) :

					$standard_name  = isset( $item['standard_name'] ) ? $item['standard_name'] : '';
					$standard_image = isset( $item['standard_image'] ) ? $item['standard_image'] : '';
					$page_link      = isset( $item['page_link'] ) ? $item['page_link'] : '';

					// Image can be an array (default ACF) or URL string.
					$img_url = '';
					$img_alt = $standard_name;

					if ( is_array( $standard_image ) ) {
						$img_url = ! empty( $standard_image['url'] ) ? $standard_image['url'] : '';
						if ( ! empty( $standard_image['alt'] ) ) {
							$img_alt = $standard_image['alt'];
						}
					} else {
						$img_url = $standard_image;
					}

					// Page link can be a URL, post ID, or array depending on ACF settings.
					$link_url = '';
					if ( is_array( $page_link ) && ! empty( $page_link['url'] ) ) {
						$link_url = $page_link['url'];
					} elseif ( is_numeric( $page_link ) ) {
						$link_url = get_permalink( $page_link );
					} else {
						$link_url = $page_link;
					}
				?>
					<evg-grid-item
						fill
						large-tablet="3"
						small-mobile="12"
						small-tablet="6"
					>
						<a href="<?php echo esc_url( $link_url ); ?>" class="ae-standards-list">
							<evg-card
								class="evg-theme-default"
								radius="md"
								layout="image-bottom"
							>
								<evg-card-content>
									<evg-grid justify-content="space-between">
										<evg-grid-item grow shrink>
											<h3 class="evg-text-size-body-md evg-text-family-body evg-text-transform-uppercase">
												<?php echo esc_html( $standard_name ); ?>
											</h3>
										</evg-grid-item>
										<evg-grid-item>
											<svg xmlns="http://www.w3.org/2000/svg" width="22" height="23" viewBox="0 0 22 23" fill="none">
												<path d="M19.9999 1.77832L2.52954 20.3228" stroke="#0B301A" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
												<path d="M19.9993 20.8837V1.77832H2" stroke="#0B301A" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
											</svg>
										</evg-grid-item>
									</evg-grid>
								</evg-card-content>

								<?php if ( $img_url ) : ?>
									<evg-card-img>
										<evg-img
											aspect-ratio="auto"
											block
											object-fit="contain"
											object-position="50% 50%"
											responsive
										>
											<img
												src="<?php echo esc_url( $img_url ); ?>"
												alt="<?php echo esc_attr( $img_alt ); ?>"
												width="400"
												height="300"
												loading="lazy"
											/>
										</evg-img>
									</evg-card-img>
								<?php endif; ?>

							</evg-card>
						</a>
					</evg-grid-item>
				<?php endforeach; ?>

			</evg-grid>
		</evg-enter>

	</evg-wrapper>
</evg-section>
<?php endif; ?>