<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cinerglass
 */

get_header();
?>

	<?php
	// Check if the current post is password-protected
    if (post_password_required()) {
        ?>
        <div class="container">
            <div class="wrapper-cols">
                <div class="wrapper-twothirds mod-content">
                    <h1><?php the_title(); ?></h1>

                    <p><?php _e( 'This content is password protected. To view it please enter your password below:', 'cinerglass' ); ?></p>

                    <div class="mod-compliance-form">
                    <?php
                    // Display the password form
                    echo get_the_password_form();
                    ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    } else {
		if (have_rows('modules')) {
			include(locate_template('template-parts/modules.php'));
		}
		else {
			?>
			<div class="container">
				<div class="wrapper-cols">
					<div class="wrapper-twothirds mod-content">
						<h1><?php the_title(); ?></h1>

						<?php if (have_posts()): while (have_posts()) : the_post(); ?>

							<!-- article -->
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

								<?php the_content(); ?>


								<?php edit_post_link(); ?>

							</article>
						<!-- /article -->
						<?php endwhile;
						endif; ?>
					</div>
				</div>
			</div>
		<?php
		}
	}
	?>

<?php
get_footer();
