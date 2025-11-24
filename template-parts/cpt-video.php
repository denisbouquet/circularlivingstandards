<?php
// FORM LAYOUT

$embed = get_sub_field( 'embed' ); 
$spacing_bottom = get_sub_field( 'spacing_bottom' ); // Button group
?>
<div class="<?php echo esc_attr( $spacing_bottom ); ?>">
	<evg-video>
		<iframe width="560" height="315" src="<?php echo esc_url( $embed ); ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen=""></iframe>
	</evg-video>
</div>