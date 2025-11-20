<?php
// FORM LAYOUT

	$title          = get_sub_field( 'title' );            // text
	$copy           = get_sub_field( 'copy' );            // WYSIWYG
	$form_shortcode = get_sub_field( 'form_shortcode' );  // Text (e.g. [contact-form-7 ...])

	?>
	<div class="ae-get-involved-form" id="form">
		<evg-supergraphic class="evg-theme-forest-light" position="bottom-left">
			<evg-section padding="fluid" class="evg-theme-forest-light">
				<evg-wrapper size="xxl">
					<evg-grid gap="xl" wrap="wrap">

						<evg-grid-item small-mobile="12" small-tablet="6">
							<?php if ( $title ) : ?>
							<h2 class="evg-text-size-heading-lg evg-spacing-bottom-lg evg-text-transform-uppercase evg-spacing-bottom-md"><?php echo wp_kses_post( $title ); ?></h2>
							<?php endif; ?>

							<?php if ( $copy ) : ?>
								<?php echo wp_kses_post( $copy ); ?>
							<?php endif; ?>
						</evg-grid-item>

						<evg-grid-item small-mobile="12" small-tablet="6">
							<?php
							if ( $form_shortcode ) {
								echo do_shortcode( $form_shortcode );
							}
							?>
						</evg-grid-item>

					</evg-grid>
				</evg-wrapper>
			</evg-section>
		</evg-supergraphic>
	</div>
	