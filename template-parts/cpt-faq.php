<?php
// Inside your flexible content loop where get_row_layout() == 'faq'
$title      = get_sub_field( 'title' );
$right_link = get_sub_field( 'right_link' ); // ACF link (array)
?>
<evg-section padding="fluid">
	<evg-wrapper size="xxl">
		<evg-grid justify-content="space-between" wrap="wrap" align-items="center" class="evg-spacing-bottom-lg">
			<evg-grid-item>
				<h2 class="evg-text-size-heading-md evg-text-transform-uppercase">
					<?php echo esc_html( $title ); ?>
				</h2>
			</evg-grid-item>

			<?php if ( $right_link ) : 
				$rl_url    = esc_url( $right_link['url'] );
				$rl_title  = ! empty( $right_link['title'] ) ? esc_html( $right_link['title'] ) : __( 'See all FAQs', 'textdomain' );
				$rl_target = ! empty( $right_link['target'] ) ? ' target="' . esc_attr( $right_link['target'] ) . '"' : '';
			?>
				<evg-grid-item>
					<evg-button variant="ghost">
						<a href="<?php echo $rl_url; ?>"<?php echo $rl_target; ?>>
							<?php echo $rl_title; ?> <evg-icon icon="arrow-right"></evg-icon>
						</a>
					</evg-button>
				</evg-grid-item>
			<?php endif; ?>
		</evg-grid>
		
		<div class="ae-faq-item">
			<?php if ( have_rows( 'faq_item' ) ) : ?>
				<?php while ( have_rows( 'faq_item' ) ) : the_row(); 
					$question = get_sub_field( 'question' ); // text
					$answer   = get_sub_field( 'answer' );   // WYSIWYG (HTML)
				?>
					<div class="ae-accordion ae-accordion--closeothers">
						<div class="ae-accordion__toggle">
							<p class="" aria-expanded="false">
								<strong><?php echo esc_html( $question ); ?></strong>
							</p>
							<div class="icon">
								<i></i>
							</div>
						</div>
						<div class="ae-accordion__content">
							<div>
								<?php echo $answer; // already formatted HTML from WYSIWYG ?>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
			<?php endif; ?>
		</div>

	</evg-wrapper>
</evg-section>