
<?php
/* ---------------------------------------------------------
 * FULL WITH BACKGROUND IMAGE
 * --------------------------------------------------------- */
$style = get_sub_field( 'style');

if (  $style == 'full-with-background-image' ) :

	$bg_image    = get_sub_field( 'background_image' ); // URL or array
	$bg_src      = is_array( $bg_image ) ? $bg_image['url'] : $bg_image;
	$title       = get_sub_field( 'title' );
	$copy        = get_sub_field( 'copy' );
	$logo        = get_sub_field( 'logo' ); // optional
	$logo_src    = $logo ? ( is_array( $logo ) ? $logo['url'] : $logo ) : '';
	$button_link = get_sub_field( 'cta' ); // ACF link
?>
	<evg-section padding="fluid" class="evg-theme-forest ae-page-header-full">
		<evg-section-img text="light">
			<?php if ( $bg_src ) : ?>
				<img class="ae-page-header__bg"
					src="<?php echo esc_url( $bg_src ); ?>"
					alt=""
					slot="image"
					width="1280"
					height="640">
			<?php endif; ?>

			<evg-wrapper size="lg" class="evg-text-align-center">

				<?php include locate_template( 'template-parts/modules-in-section.php' ); ?>

				<a class="skip-to-content-link" href="#skip-to-content" aria-label="Skip to content">
					<img class="evg-spacing-bottom-lg"
						src="<?php echo esc_url( get_template_directory_uri() . '/dist/media/images/vibrant-green-arrow-down.svg' ); ?>"
						alt=""
						slot="image"
						width="56"
						height="56">
				</a>
			</evg-wrapper>
		</evg-section-img>
	</evg-section>
	<div id="skip-to-content"></div>

<?php
/* ---------------------------------------------------------
 * SPLIT IMAGE / TEXT
 * --------------------------------------------------------- */
elseif (  $style == 'split-image-text' ) :

	$title        = get_sub_field( 'title' );
	$copy         = get_sub_field( 'copy' );
	$hero_image   = get_sub_field( 'background_image' ); // URL or array
	$hero_src     = is_array( $hero_image ) ? $hero_image['url'] : $hero_image;
	$hero_alt     = get_sub_field( 'hero_image_alt' );
?>
	<evg-grid wrap="wrap" gap="none" direction="row-reverse">
		<evg-grid-item small-mobile="12" large-tablet="6" fill="true">
			<evg-section padding="fluid-lg" class="evg-theme-forest">
				<evg-wrapper size="xxl" gutter="fluid-lg">
					<?php
					// Optional: output breadcrumb via WP if you want;
					// leaving static here as per your example.
					?>
					<evg-breadcrumb class="evg-spacing-bottom-lg">
						<nav aria-label="Breadcrumb">
							<ol>
								<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
								<li><a href="#" aria-current="page">The Standards</a></li>
							</ol>
						</nav>
					</evg-breadcrumb>

					<?php include locate_template( 'template-parts/modules-in-section.php' ); ?>
				</evg-wrapper>
			</evg-section>
		</evg-grid-item>

		<evg-grid-item small-mobile="12" large-tablet="6" fill="true">
			<evg-img responsive="true" object-fit="cover" object-position="center" aria-hidden="true" aspect-ratio="auto">
				<?php if ( $hero_src ) : ?>
					<img src="<?php echo esc_url( $hero_src ); ?>"
						alt="<?php echo esc_attr( $hero_alt ); ?>"
						width="400"
						height="400">
				<?php endif; ?>
			</evg-img>
		</evg-grid-item>
	</evg-grid>
	<div id="skip-to-content"></div>

<?php
/* ---------------------------------------------------------
 * COMPACT
 * --------------------------------------------------------- */
elseif (  $style == 'compact' ) :

	$title = get_sub_field( 'title' );
	$copy  = get_sub_field( 'copy' );
?>
	<div class="ae-supergraphic-lime">
		<evg-supergraphic class="evg-theme-forest" position="bottom-right">
			<evg-section padding="lg" class="evg-theme-forest ae-page-header-full">
				<evg-wrapper size="xxl">
					<evg-grid wrap="wrap" gap="none">
						<evg-grid-item small-mobile="12" large-tablet="6">
							<?php include locate_template( 'template-parts/modules-in-section.php' ); ?>
						</evg-grid-item>
						<evg-grid-item small-mobile="12" large-tablet="6">
							<!-- Empty column as per design -->
						</evg-grid-item>
					</evg-grid>
				</evg-wrapper>
			</evg-section>
		</evg-supergraphic>
	</div>
	<div id="skip-to-content"></div>

<?php endif; ?>
