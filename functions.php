<?php
/**
 * circularlivingstandards functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package circularlivingstandards
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}
// p in contact form 7
add_filter('wpcf7_autop_or_not', '__return_false');

// REMOVE WP EMOJI
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
// remove wp version
remove_action('wp_head', 'wp_generator');


@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '300' );

/**
 * Allow SVG and JSON uploads.
 * (JSON uses text/plain due to WP core bug)
 */
function custom_upload_mimes( $mimes ) {

    // Allow SVG
    $mimes['svg'] = 'image/svg+xml';

    // Allow JSON (WordPress bug workaround)
    $mimes['json'] = 'text/plain';

    return $mimes;
}
add_filter( 'upload_mimes', 'custom_upload_mimes' );

/**
 * Prevent update notification for plugin
 * http://www.thecreativedev.com/disable-updates-for-specific-plugin-in-wordpress/
 * Place in theme functions.php or at bottom of wp-config.php
 */
function disable_plugin_updates( $value ) {
  if ( isset($value) && is_object($value) ) {
  	if ( isset( $value->response['advanced-custom-fields-pro/acf.php'] ) ) {
      unset( $value->response['advanced-custom-fields-pro/acf.php'] );
    }
    if ( isset( $value->response['all-in-one-wp-migration/all-in-one-wp-migration.php'] ) ) {
      unset( $value->response['all-in-one-wp-migration/all-in-one-wp-migration.php'] );
    }
  }
  return $value;
}
add_filter( 'site_transient_update_plugins', 'disable_plugin_updates' );


/*
* my_acf_json_save_point
*/
add_filter('acf/settings/save_json', 'my_acf_json_save_point');
function my_acf_json_save_point( $path ) {
    
    // update path
    $path = get_stylesheet_directory() . '/afc-json';
    
    // return
    return $path;  
}
 
add_filter('acf/settings/load_json', 'my_acf_json_load_point');
function my_acf_json_load_point( $paths ) {
    
    // remove original path (optional)
    unset($paths[0]); 
    
    // append path
    $paths[] = get_stylesheet_directory() . '/afc-json'; 
    
    // return
    return $paths;
}


if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Website General Settings',
		'menu_title'	=> 'Website Settings',
		'menu_slug' 	=> 'Website-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> true
	));
}




/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function circularlivingstandards_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on circularlivingstandards, use a find and replace
		* to change 'circularlivingstandards' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'circularlivingstandards', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'circularlivingstandards' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'circularlivingstandards_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'circularlivingstandards_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function circularlivingstandards_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'circularlivingstandards_content_width', 640 );
}
add_action( 'after_setup_theme', 'circularlivingstandards_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function circularlivingstandards_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'circularlivingstandards' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'circularlivingstandards' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'circularlivingstandards_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function circularlivingstandards_scripts() {
	wp_enqueue_style( 'circularlivingstandards-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'circularlivingstandards-style', 'rtl', 'replace' );

	wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-3.7.1.min.js', array(), '20232509', true );
	// wp_enqueue_script( 'circularlivingstandards-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	// if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	// 	wp_enqueue_script( 'comment-reply' );
	// }
	wp_enqueue_script( 'custom-main-js', get_template_directory_uri() . '/dist/js/circularlivingstandards.js', array(), '20250320', true );
}
add_action( 'wp_enqueue_scripts', 'circularlivingstandards_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}



class Evergreen_Primary_Walker extends Walker_Nav_Menu {

    // no <ul> levels – nav already exists in the template
    public function start_lvl( &$output, $depth = 0, $args = array() ) {}
    public function end_lvl( &$output, $depth = 0, $args = array() ) {}

    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

        // Only top level items
        if ( $depth > 0 ) {
            return;
        }

        $title = esc_html( $item->title );
        $url   = esc_url( $item->url );

        // Is this the “The standards” item? (check by title or a custom CSS class)
        $is_standards = ( strtolower( trim( $item->title ) ) === 'the standards' );

        if ( $is_standards ) {
            $output .= '
            <evg-menu-item class="js-megamenu" active="false">
                <button type="button" aria-controls="standards" aria-expanded="false">
                    <evg-menu-item-content>' . $title . '</evg-menu-item-content>
                    <evg-icon icon="chevron-down"></evg-icon>
                </button>
            </evg-menu-item>';
        } else {
            $output .= '
            <evg-menu-item>
                <a href="' . $url . '">
                    <evg-menu-item-content>' . $title . '</evg-menu-item-content>
                </a>
            </evg-menu-item>';
        }
    }

    public function end_el( &$output, $item, $depth = 0, $args = array() ) {
        // nothing needed
    }
}

class Evergreen_Mega_Walker extends Walker_Nav_Menu {

    public function start_lvl( &$output, $depth = 0, $args = array() ) {}
    public function end_lvl( &$output, $depth = 0, $args = array() ) {}

    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

        // Only print submenu items (children)
        if ( $depth === 0 ) {
            return; // skip top-level items like Home, Process, The standards, Contact
        }

        $title = esc_html( $item->title );
        $url   = esc_url( $item->url );

        $output .= '
        <evg-menu-item>
            <a href="' . $url . '" role="menuitem">' . $title . '</a>
        </evg-menu-item>';
    }

    public function end_el( &$output, $item, $depth = 0, $args = array() ) {}
}


class Evergreen_Mobile_Walker extends Walker_Nav_Menu {

    /**
     * Mark items that have children so we can treat them as "The Standards" style.
     */
    public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( isset( $children_elements[ $element->ID ] ) && ! empty( $children_elements[ $element->ID ] ) ) {
            $element->has_children = true;
        } else {
            $element->has_children = false;
        }

        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }

    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        // Only open the collapse wrapper for the first level of children (depth 1)
        if ( $depth === 0 ) {
            // ID used by button aria-controls and collapse id
            $collapse_id = ':r1:'; // or 'submenu-standards' if you prefer

            $output .= '
                <evg-collapse open="false" id="' . esc_attr( $collapse_id ) . '">
                    <div class="evg-spacing-left-sm">
            ';
        }
    }

    public function end_lvl( &$output, $depth = 0, $args = array() ) {
        if ( $depth === 0 ) {
            $output .= '
                    </div>
                </evg-collapse>
            ';
        }
    }

    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

        $title = esc_html( $item->title );
        $url   = esc_url( $item->url );
        $has_children = ! empty( $item->has_children );

        // ─────────────────────────────────────────────────────
        // TOP-LEVEL ITEMS
        // ─────────────────────────────────────────────────────
        if ( $depth === 0 ) {

            // "The Standards" (or any item with children)
            if ( $has_children ) {

                $collapse_id = ':r1:'; // must match start_lvl / button aria-controls

                $output .= '
                    <evg-menu-item>
                        <button class="js-submenu"
                                type="button"
                                aria-controls="' . esc_attr( $collapse_id ) . '"
                                aria-expanded="false">
                            <evg-menu-item-content>' . $title . '</evg-menu-item-content>
                            <evg-icon icon="chevron-down"></evg-icon>
                        </button>
                ';
                // Note: we DO NOT close <evg-menu-item> here.
                // Children + collapse wrapper are injected by start_lvl/end_lvl.
            }

            // Normal items (Home, Process, Contact)
            else {
                $output .= '
                    <evg-menu-item>
                        <a href="' . $url . '">
                            <evg-menu-item-content>' . $title . '</evg-menu-item-content>
                        </a>
                    </evg-menu-item>
                ';
                // Divider between items if you want it here (optional)
                $output .= '<evg-divider></evg-divider>';
            }
        }

        // ─────────────────────────────────────────────────────
        // CHILD ITEMS (inside "The Standards" collapse)
        // ─────────────────────────────────────────────────────
        else {
            $output .= '
                <evg-menu-item>
                    <a href="' . $url . '" role="menuitem">' . $title . '</a>
                </evg-menu-item>
            ';
        }
    }

    public function end_el( &$output, $item, $depth = 0, $args = array() ) {

        // Close the wrapping <evg-menu-item> and add divider
        if ( $depth === 0 && ! empty( $item->has_children ) ) {
            $output .= '
                    </evg-menu-item>
                    <evg-divider></evg-divider>
            ';
        }
        // For simple items we already closed <evg-menu-item> and added divider in start_el.
    }
}