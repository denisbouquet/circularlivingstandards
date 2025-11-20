<?php
$image           = get_sub_field( 'image' );
$image_ratio     = get_sub_field( 'image_aspect_ratio' );
$image_position     = get_sub_field( 'image_position' );
$card_theme     = get_sub_field( 'card_theme' );
$content         = get_sub_field( 'content' );

// cloned (seamless) settings fields:
$animation        = get_sub_field( 'animation' );        
$theme            = get_sub_field( 'theme' );            
$wrappersize      = get_sub_field( 'wrapper-size' );     
$padding          = get_sub_field( 'padding' );          
$padding_override = get_sub_field( 'padding_override' ); 


// defaults
$section_theme   = 'evg-theme-'.$theme ?: 'evg-theme-default';
$section_padding = $padding ?: 'fluid';
$section_classes = trim( $section_theme . ' ' . ( $padding_override ?: '' ) );

$has_animation = $animation && $animation !== 'none';
?>

<evg-section padding="<?php echo esc_attr( $section_padding ); ?>"
             class="<?php echo esc_attr( $section_classes ); ?>">
	<?php if ( $has_animation ) : ?>
		<evg-enter delay="0.5" type="<?php echo esc_attr( $animation ); ?>">
	<?php endif; ?>

	<evg-wrapper size="<?php echo esc_attr( $wrappersize ); ?>" >
		<evg-card layout="<?php echo esc_attr( $image_position ); ?>" class="<?php echo 'evg-theme-'.$card_theme; ?>" radius="md" padding="fluid">

			<?php if ( $image ) : ?>
				<evg-card-img class="<?php echo $image_ratio; ?>">
					<img src="<?php echo esc_url( is_array( $image ) ? $image['url'] : $image ); ?>"
					     alt="<?php echo esc_attr( is_array( $image ) ? $image['alt'] ?? '' : '' ); ?>"
					     loading="lazy">
				</evg-card-img>
			<?php endif; ?>

			<evg-card-content>
				<?php include locate_template( 'template-parts/modules-in-section.php' ); ?>
			</evg-card-content>

		</evg-card>
	</evg-wrapper>

	<?php if ( $has_animation ) : ?>
		</evg-enter>
	<?php endif; ?>
</evg-section>