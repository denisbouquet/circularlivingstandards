<?php
// FORM LAYOUT

	$image = get_sub_field( 'image' );
	?>
	<?php if ( $image ) : ?>
		<evg-card-img class="<?php echo $image_ratio; ?>">
			<img src="<?php echo esc_url( is_array( $image ) ? $image['url'] : $image ); ?>"
			     alt="<?php echo esc_attr( is_array( $image ) ? $image['alt'] ?? '' : '' ); ?>"
			     loading="lazy">
		</evg-card-img>
	<?php endif; ?>
