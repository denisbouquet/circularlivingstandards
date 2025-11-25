<?php
/**
 * Related Standards section
 * Data source: Options page -> group field "standards"
 */

// Get group from options
$standards = get_field( 'standards', 'option' );

if ( $standards ) {

	$section_title = ! empty( $standards['title'] )
		? $standards['title']
		: __( 'Related standards', 'textdomain' );

	$current_id = get_queried_object_id();

	// Keys that match your field naming pattern: {key}_image, {key}_title, {key}_link
	$keys  = [ 'preloved', 'refillable', 'reusable', 'durable' ];
	$cards = [];

	foreach ( $keys as $key ) {

		$image = $standards[ "{$key}_image" ] ?? null;
		$title = $standards[ "{$key}_title" ] ?? '';
		$link  = $standards[ "{$key}_link" ] ?? '';

		if ( ! $image || ! $title || ! $link ) {
			continue;
		}

		// Normalise link (ACF Page Link can be URL, ID or array depending on return type)
		$url     = '';
		$page_id = 0;

		if ( is_array( $link ) ) {
			// e.g. array( 'url' => '...', 'title' => '...', 'target' => '...' )
			$url = $link['url'] ?? '';
			if ( ! empty( $link['ID'] ) ) {
				$page_id = (int) $link['ID'];
			}
		} elseif ( is_numeric( $link ) ) {
			$page_id = (int) $link;
			$url     = get_permalink( $page_id );
		} else {
			// Assume plain URL string
			$url     = $link;
			$page_id = url_to_postid( $url );
		}

		// Exclude current page
		if ( $page_id && $page_id === $current_id ) {
			continue;
		}

		// Normalise image
		$img_url = '';
		$img_alt = $title;

		if ( is_array( $image ) ) {
			$img_url = $image['url'] ?? '';
			if ( ! empty( $image['alt'] ) ) {
				$img_alt = $image['alt'];
			}
		} else {
			$img_url = $image;
		}

		if ( ! $img_url || ! $url ) {
			continue;
		}

		$cards[] = [
			'title'   => $title,
			'url'     => $url,
			'img_url' => $img_url,
			'img_alt' => $img_alt,
		];
	}

	// Keep only 3 cards max
	$cards = array_slice( $cards, 0, 3 );

	if ( $cards ) : ?>
		<evg-section  <?php if(!empty($id)) { echo 'id="'.esc_attr( $id ).'"'; } ?> padding="fluid" class="evg-theme-earth-light ae-related-standards">
			<evg-wrapper size="xxl">
				<h2 class="evg-text-size-heading-md evg-spacing-bottom-lg evg-text-transform-uppercase">
					<?php echo esc_html( $section_title ); ?>
				</h2>

				<evg-grid wrap="wrap">
					<?php foreach ( $cards as $card ) : ?>
						<evg-grid-item small-mobile="12" small-tablet="6" large-tablet="4" fill="true">
							<evg-card class="evg-theme-forest" radius="md">
								<evg-card-img>
									<a href="<?php echo esc_url( $card['url'] ); ?>">
										<img
											src="<?php echo esc_url( $card['img_url'] ); ?>"
											alt="<?php echo esc_attr( $card['img_alt'] ); ?>"
											loading="lazy"
										/>
									</a>
								</evg-card-img>

								<evg-card-content>
									<h3 class="evg-text-size-heading-md evg-text-transform-uppercase">
										<?php echo esc_html( $card['title'] ); ?>
									</h3>

									<evg-button variant="primary" width="auto">
										<a href="<?php echo esc_url( $card['url'] ); ?>">
											<?php esc_html_e( 'Read more', 'textdomain' ); ?>
										</a>
									</evg-button>
								</evg-card-content>
							</evg-card>
						</evg-grid-item>
					<?php endforeach; ?>
				</evg-grid>
			</evg-wrapper>
		</evg-section>
	<?php
	endif;
}
?>