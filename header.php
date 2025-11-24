<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package circularlivingstandards
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id=' + i + dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-MNKNMNRC');</script>
	<!-- End Google Tag Manager -->
</head>

<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MNKNMNRC"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<?php wp_body_open(); ?>
<div id="page" class="site">
	
<evg-skip-link>
	<a href="#skip-to-content"><?php esc_html_e( 'Skip to main content', 'circularlivingstandards' ); ?></a>
</evg-skip-link>
<evg-app>

<evg-header class="evg-theme-default">
	<evg-header-logo>
		<?php $logo_nav = get_field('logo_main_navigation', 'option');; ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<img
				alt="WRAP logo"
				height="32"
				loading="eager"
				src="<?php echo $logo_nav; ?>"
				width="110"
			/>
		</a>
	</evg-header-logo>
	<evg-header-primary-nav>
			<nav aria-label="Main navigation">
					<?php
					wp_nav_menu( array(
							'menu_id' => 'main',
							'container'      => false,
							'items_wrap'     => '%3$s',            // no <ul>
							'walker'         => new Evergreen_Primary_Walker(),
					) );
					?>
			</nav>
	</evg-header-primary-nav>
	<evg-header-secondary-nav>
		<nav aria-label="Secondary navigation">
			<evg-button variant="default">
				<a href="https://wrap.ngo" target="_blank">Main WRAP site<evg-icon icon="external-link"></evg-icon></a>
			</evg-button>
		</nav>
	</evg-header-secondary-nav>
	<evg-header-mobile-nav>
		<evg-button variant="default" width="square">
			<button
				aria-label="Open mobile navigation"
				class="js-toggleMobileMenu"
				type="button"
			>
				<evg-icon icon="menu" class="icon-open-close"></evg-icon>
			</button>
		</evg-button>
	</evg-header-mobile-nav>
</evg-header>

<evg-header-mega-menu id="standards" role="menu" aria-label="standards" tabindex="-1">
		<evg-grid gap="none">
				<evg-grid-item small-mobile="3" desktop="2" fill="true">
						<evg-section padding="lg" class="evg-theme-sand">
								<evg-wrapper gutter="lg">
										<span class="evg-text-size-heading-md evg-text-family-heading evg-text-transform-uppercase evg-text-weight-bold">
												The Standards
										</span>
								</evg-wrapper>
						</evg-section>
				</evg-grid-item>

				<evg-grid-item grow="true" fill="true">
						<evg-section padding="lg">
								<evg-wrapper gutter="lg">
										<?php
										wp_nav_menu( array(
												'menu_id' => 'main',
												'container'      => false,
												'items_wrap'     => '%3$s',
												'walker'         => new Evergreen_Mega_Walker(),
										) );
										?>
								</evg-wrapper>
						</evg-section>
				</evg-grid-item>
		</evg-grid>
</evg-header-mega-menu>


<evg-drawer>
	<dialog class="mobile-menu">
		<evg-section padding="md">
			<evg-wrapper>

				<!-- Close button row -->
				<evg-grid class="evg-spacing-bottom-lg" justify-content="flex-end">
					<evg-grid-item>
						<evg-button width="square">
							<button
								aria-label="Close"
								class="js-mobilemenu-close"
								class="icon-open-close"
								type="button"
							>
								<evg-icon icon="close"></evg-icon>
							</button>
						</evg-button>
					</evg-grid-item>
				</evg-grid>

				<?php
				wp_nav_menu( array(
						'menu_id' => 'main',   // use your location slug
						'container'      => false,
						'items_wrap'     => '%3$s',     // no <ul>, just items
						'walker'         => new Evergreen_Mobile_Walker(),
				) );
				?>

			</evg-wrapper>
		</evg-section>
		<evg-section class="evg-theme-sand" padding="md">
			<evg-wrapper>
				<evg-menu-item>
					<a href="https://wrap.ngo" target="_blank">
						<evg-icon icon="external-link"></evg-icon>
						<evg-menu-item-content>Main WRAP site</evg-menu-item-content>
					</a>
				</evg-menu-item>
			</evg-wrapper>
			</evg-wrapper>
		</evg-section>
	</dialog>
</evg-drawer>
