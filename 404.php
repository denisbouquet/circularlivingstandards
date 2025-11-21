<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package circularlivingstandards
 */

get_header();
?>

	<main id="primary" class="site-main">
		<evg-section padding="fluid" class="remove-padding-bottom">
			<evg-wrapper size="xl" class="evg-longform">
				<div class="evg-spacing-bottom-xl">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'circularlivingstandards' ); ?></h1>
					<div class="evg-text-size-body-lg">
						<p><?php esc_html_e( 'It looks like nothing was found at this location.', 'circularlivingstandards' ); ?></p>
					</div>
				</div>
			</evg-wrapper>
		</evg-section>
	</main><!-- #main -->

<?php
get_footer();
