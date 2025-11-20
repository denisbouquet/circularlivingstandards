<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package circularlivingstandards
 */

?>
	
<?php
$logo_footer = get_field('logo_footer', 'option');
$footer = get_field('footer', 'option');

if ( $footer ) :
	$column_1_title      = $footer['column_1_title'];
	$column_1_content    = $footer['column_1_content'];   // repeater (Link)
	$column_2_title      = $footer['column_2_title'];
	$column_2_content    = $footer['column_2_content'];   // repeater (Link)
	$locations           = $footer['locations'];          // repeater (Link)
	$social_media_links  = $footer['social_media_links']; // repeater 
	$copyright           = $footer['copyright'];
	?>
	<footer slot="footer">
		<evg-section padding="lg" class="evg-theme-forest">
			<h2 hidden>Footer</h2>

			<evg-wrapper size="xxl">
				<evg-grid gap="xl" wrap="wrap" class="evg-spacing-bottom-xl">

					<!-- COLUMN 1: two link columns -->
					<evg-grid-item small-mobile="12" tablet="6" large-tablet="8">
						<?php if ( ! empty( $column_1_title ) ) : ?>
							<h3 class="evg-text-size-heading-xs evg-text-transform-uppercase evg-spacing-top-sm evg-spacing-bottom-sm">
								<?php echo esc_html( $column_1_title ); ?>
							</h3>
						<?php endif; ?>

						<evg-divider></evg-divider>

						<evg-grid gap="none" wrap="wrap">

							<!-- Column 1 content repeater -->
							<evg-grid-item
								small-mobile="12"
								large-mobile="6"
								tablet="12"
								large-tablet="6"
								small-desktop="6"
							>
								<?php if ( ! empty( $column_1_content ) ) : ?>
									<?php foreach ( $column_1_content as $row ) :
										$link = $row['link'] ?? null;
										if ( ! $link ) { continue; }
										$url    = $link['url']    ?? '';
										$title  = $link['title']  ?? '';
										$target = $link['target'] ?? '_self';
										if ( ! $url || ! $title ) { continue; }
										?>
										<evg-menu-item>
											<a href="<?php echo esc_url( $url ); ?>" target="<?php echo esc_attr( $target ); ?>">
												<?php echo esc_html( $title ); ?>
											</a>
										</evg-menu-item>
									<?php endforeach; ?>
								<?php endif; ?>
							</evg-grid-item>

							<!-- Column 2 content repeater -->
							<evg-grid-item
								small-mobile="12"
								large-mobile="6"
								tablet="12"
								large-tablet="6"
								small-desktop="6"
							>
								<?php if ( ! empty( $column_2_content ) ) : ?>
									<?php foreach ( $column_2_content as $row ) :
										$link = $row['link'] ?? null;
										if ( ! $link ) { continue; }
										$url    = $link['url']    ?? '';
										$title  = $link['title']  ?? '';
										$target = $link['target'] ?? '_self';
										if ( ! $url || ! $title ) { continue; }
										?>
										<evg-menu-item>
											<a href="<?php echo esc_url( $url ); ?>" target="<?php echo esc_attr( $target ); ?>">
												<?php echo esc_html( $title ); ?>
											</a>
										</evg-menu-item>
									<?php endforeach; ?>
								<?php endif; ?>
							</evg-grid-item>

						</evg-grid>
					</evg-grid-item>

					<!-- COLUMN 2: locations (repeater of Link) -->
					<evg-grid-item small-mobile="12" tablet="6" large-tablet="4" class="ae-locations">
						<?php if ( ! empty( $column_2_title ) ) : ?>
							<h3 class="evg-text-size-heading-xs evg-text-transform-uppercase evg-spacing-top-sm evg-spacing-bottom-sm">
								<?php echo esc_html( $column_2_title ); ?>
							</h3>
						<?php endif; ?>

						<evg-divider></evg-divider>

						<?php if ( ! empty( $locations ) ) : ?>
							<?php foreach ( $locations as $row ) :
								?>
								<evg-menu-item>
									<evg-icon icon="location"></evg-icon>
									<evg-menu-item-content>
										<?php echo esc_html( $row['location'] ); ?>
									</evg-menu-item-content>
								</evg-menu-item>
							<?php endforeach; ?>
						<?php endif; ?>
					</evg-grid-item>

				</evg-grid>

				<!-- LOGO + SOCIAL ICONS -->
				<evg-grid align-items="center" wrap="wrap" class="social-icons">
					<evg-grid-item grow="true" shrink="true" small-mobile="12" large-mobile="auto">
						<evg-img
							block="true"
							aria-hidden="true"
							aspect-ratio="auto"
							object-fit="fill"
							object-position="50% 50%">
							<img
								src="<?php echo $logo_footer; ?>"
								alt="WRAP logo"
								width="152"
								height="44"
								loading="lazy" />
						</evg-img>
					</evg-grid-item>

					<?php if ( ! empty( $social_media_links ) ) : ?>
						<?php foreach ( $social_media_links as $item ) : ?>
							<?php
								$icon_url = $item['social_media_icon'] ?? '';
								$link     = $item['social_media_link'] ?? [];
								$url      = $link['url'] ?? '';
								$label    = $link['title'] ?? '';
								$target   = $link['target'] ?? '_self';
							?>

							<?php if ( $url && $icon_url ) : ?>
								<evg-grid-item>
									<evg-button variant="secondary" width="square">
										<a
											href="<?php echo esc_url( $url ); ?>"
											aria-label="<?php echo esc_attr( $label ); ?>"
											target="<?php echo esc_attr( $target ); ?>"
											class="icon"
										>
											<img
												src="<?php echo esc_url( $icon_url ); ?>"
												alt="<?php echo esc_attr( $label ); ?>"
											>
										</a>
									</evg-button>
								</evg-grid-item>
							<?php endif; ?>
						<?php endforeach; ?>
					<?php endif; ?>
				</evg-grid>

			</evg-wrapper>
		</evg-section>

		<evg-section padding="lg" class="evg-theme-coal">
			<evg-wrapper size="xxl">
				<div class="evg-text-size-body-xs">
					<?php echo wp_kses_post( $copyright ); ?>
				</div>
			</evg-wrapper>
		</evg-section>
	</footer>
<?php endif; ?>
</evg-app>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
