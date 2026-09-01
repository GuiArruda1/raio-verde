<?php
/**
 * Theme functions and definitions
 */

if ( ! function_exists( 'raio_verde_setup' ) ) :
	function raio_verde_setup() {
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// Add support for core custom logo.
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 50,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		// Switch default core markup for search form, comment form, and comments to output valid HTML5.
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

		// Register menus
		register_nav_menus(
			array(
				'menu-1'      => esc_html__( 'Primary', 'raio-verde' ),
				'menu-2'      => esc_html__( 'Secondary', 'raio-verde' ),
				'menu-mobile' => esc_html__( 'Mobile Menu', 'raio-verde' ),
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'raio_verde_setup' );

/**
 * Enqueue scripts and styles.
 */
function raio_verde_scripts() {
	wp_enqueue_style( 'raio-verde-style', get_stylesheet_uri(), array(), filemtime( get_stylesheet_directory() . '/style.css' ) );
	wp_enqueue_script( 'raio-verde-script', get_template_directory_uri() . '/js/main.js', array(), filemtime( get_stylesheet_directory() . '/js/main.js' ), true );
}
add_action( 'wp_enqueue_scripts', 'raio_verde_scripts' );

/**
 * Register Custom Post Type for Portfolio
 */
function raio_verde_register_portfolio_cpt() {
	$labels = array(
		'name'                  => _x( 'Portfolios', 'Post Type General Name', 'raio-verde' ),
		'singular_name'         => _x( 'Portfolio', 'Post Type Singular Name', 'raio-verde' ),
		'menu_name'             => __( 'Portfolios', 'raio-verde' ),
		'name_admin_bar'        => __( 'Portfolio', 'raio-verde' ),
		'archives'              => __( 'Portfolio Archives', 'raio-verde' ),
		'attributes'            => __( 'Portfolio Attributes', 'raio-verde' ),
		'parent_item_colon'     => __( 'Parent Portfolio:', 'raio-verde' ),
		'all_items'             => __( 'All Portfolios', 'raio-verde' ),
		'add_new_item'          => __( 'Add New Portfolio', 'raio-verde' ),
		'add_new'               => __( 'Add New', 'raio-verde' ),
		'new_item'              => __( 'New Portfolio', 'raio-verde' ),
		'edit_item'             => __( 'Edit Portfolio', 'raio-verde' ),
		'update_item'           => __( 'Update Portfolio', 'raio-verde' ),
		'view_item'             => __( 'View Portfolio', 'raio-verde' ),
		'view_items'            => __( 'View Portfolios', 'raio-verde' ),
		'search_items'          => __( 'Search Portfolio', 'raio-verde' ),
		'not_found'             => __( 'Not found', 'raio-verde' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'raio-verde' ),
		'featured_image'        => __( 'Featured Image', 'raio-verde' ),
		'set_featured_image'    => __( 'Set featured image', 'raio-verde' ),
		'remove_featured_image' => __( 'Remove featured image', 'raio-verde' ),
		'use_featured_image'    => __( 'Use as featured image', 'raio-verde' ),
		'insert_into_item'      => __( 'Insert into portfolio', 'raio-verde' ),
		'uploaded_to_this_item' => __( 'Uploaded to this portfolio', 'raio-verde' ),
		'items_list'            => __( 'Portfolios list', 'raio-verde' ),
		'items_list_navigation' => __( 'Portfolios list navigation', 'raio-verde' ),
		'filter_items_list'     => __( 'Filter portfolios list', 'raio-verde' ),
	);
	$args = array(
		'label'                 => __( 'Portfolio', 'raio-verde' ),
		'description'           => __( 'Portfolio and projects', 'raio-verde' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-camera',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest'          => true, // Enable Gutenberg editor if desired, or API access
	);
	register_post_type( 'portfolio', $args );
}
add_action( 'init', 'raio_verde_register_portfolio_cpt', 0 );

/**
 * Register Custom Taxonomy for Portfolio
 */
function raio_verde_register_portfolio_taxonomies() {
	$labels = array(
		'name'                       => _x( 'Portfolio Categories', 'Taxonomy General Name', 'raio-verde' ),
		'singular_name'              => _x( 'Portfolio Category', 'Taxonomy Singular Name', 'raio-verde' ),
		'menu_name'                  => __( 'Categories', 'raio-verde' ),
		'all_items'                  => __( 'All Categories', 'raio-verde' ),
		'parent_item'                => __( 'Parent Category', 'raio-verde' ),
		'parent_item_colon'          => __( 'Parent Category:', 'raio-verde' ),
		'new_item_name'              => __( 'New Category Name', 'raio-verde' ),
		'add_new_item'               => __( 'Add New Category', 'raio-verde' ),
		'edit_item'                  => __( 'Edit Category', 'raio-verde' ),
		'update_item'                => __( 'Update Category', 'raio-verde' ),
		'view_item'                  => __( 'View Category', 'raio-verde' ),
		'separate_items_with_commas' => __( 'Separate categories with commas', 'raio-verde' ),
		'add_or_remove_items'        => __( 'Add or remove categories', 'raio-verde' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'raio-verde' ),
		'popular_items'              => __( 'Popular Categories', 'raio-verde' ),
		'search_items'               => __( 'Search Categories', 'raio-verde' ),
		'not_found'                  => __( 'Not Found', 'raio-verde' ),
		'no_terms'                   => __( 'No categories', 'raio-verde' ),
		'items_list'                 => __( 'Categories list', 'raio-verde' ),
		'items_list_navigation'      => __( 'Categories list navigation', 'raio-verde' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'show_in_rest'               => true,
	);
	register_taxonomy( 'portfolio_category', array( 'portfolio' ), $args );
}
add_action( 'init', 'raio_verde_register_portfolio_taxonomies', 0 );

/**
 * Flush rewrite rules once to prevent 404 errors on custom taxonomy URLs
 */
function raio_verde_flush_rewrite_rules_once() {
	if ( get_option( 'raio_verde_flush_rewrite_v2' ) !== '1' ) {
		flush_rewrite_rules();
		update_option( 'raio_verde_flush_rewrite_v2', '1' );
	}
}
add_action( 'init', 'raio_verde_flush_rewrite_rules_once', 99 );

/**
 * Safe wrapper for ACF get_field
 */
function rv_get_field($selector, $post_id = false, $format_value = true) {
    if (function_exists('get_field')) {
        return get_field($selector, $post_id, $format_value);
    }
    return false;
}

/**
 * Load ACF Field Groups
 */
require get_template_directory() . '/inc/acf-setup.php';

/**
 * Fix URLs for local tunnels (ngrok/localtunnel)
 * This dynamically overrides the site URL when accessed via a tunnel
 * so CSS and images load correctly on mobile.
 */
$tunnel_host = '';
$tunnel_domains = array( 'loca.lt', 'ngrok-free.dev', 'ngrok.io' );
$check_host = isset( $_SERVER['HTTP_X_FORWARDED_HOST'] ) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : ( isset( $_SERVER['HTTP_HOST'] ) ? $_SERVER['HTTP_HOST'] : '' );

foreach ( $tunnel_domains as $domain ) {
    if ( strpos( $check_host, $domain ) !== false ) {
        $tunnel_host = $check_host;
        break;
    }
}

if ( ! empty( $tunnel_host ) ) {
    $forwarded_url = 'https://' . $tunnel_host;
    $local_url = 'https://localhost:8888';
    add_filter( 'option_siteurl', function() use ( $forwarded_url ) { return $forwarded_url; } );
    add_filter( 'option_home', function() use ( $forwarded_url ) { return $forwarded_url; } );
    // Rewrite all content URLs (CSS, JS, images, uploads)
    add_filter( 'stylesheet_directory_uri', function( $uri ) use ( $local_url, $forwarded_url ) { return str_replace( $local_url, $forwarded_url, $uri ); } );
    add_filter( 'template_directory_uri', function( $uri ) use ( $local_url, $forwarded_url ) { return str_replace( $local_url, $forwarded_url, $uri ); } );
    add_filter( 'plugins_url', function( $uri ) use ( $local_url, $forwarded_url ) { return str_replace( $local_url, $forwarded_url, $uri ); } );
    add_filter( 'wp_get_attachment_url', function( $uri ) use ( $local_url, $forwarded_url ) { return str_replace( $local_url, $forwarded_url, $uri ); } );
    add_filter( 'content_url', function( $uri ) use ( $local_url, $forwarded_url ) { return str_replace( $local_url, $forwarded_url, $uri ); } );
    add_filter( 'script_loader_src', function( $uri ) use ( $local_url, $forwarded_url ) { return str_replace( $local_url, $forwarded_url, $uri ); } );
    add_filter( 'style_loader_src', function( $uri ) use ( $local_url, $forwarded_url ) { return str_replace( $local_url, $forwarded_url, $uri ); } );
}

/**
 * Register Customizer settings
 */
function raio_verde_customize_register( $wp_customize ) {
	$wp_customize->add_setting( 'raio_verde_dark_logo', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'raio_verde_dark_logo', array(
		'label'       => __( 'Dark Logo (for internal pages)', 'raio-verde' ),
		'section'     => 'title_tagline',
		'mime_type'   => 'image',
	) ) );
}
add_action( 'customize_register', 'raio_verde_customize_register' );

/**
 * Customize query for portfolio archive page.
 * Sets posts_per_page to 9.
 */
function raio_verde_portfolio_archive_query( $query ) {
    if ( ! is_admin() && $query->is_main_query() && $query->is_post_type_archive( 'portfolio' ) ) {
        $query->set( 'posts_per_page', 9 );
    }
}
add_action( 'pre_get_posts', 'raio_verde_portfolio_archive_query' );

/**
 * Allow SVG file uploads
 */
function raio_verde_mime_types( $mimes ) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'raio_verde_mime_types' );

/**
 * Fix SVG upload checking
 */
function raio_verde_fix_svg( $data, $file, $filename, $mimes ) {
    $ext = isset( $data['ext'] ) ? $data['ext'] : '';
    if ( strlen( $ext ) < 1 ) {
        $exploded = explode( '.', $filename );
        $ext      = strtolower( end( $exploded ) );
    }
    if ( $ext === 'svg' ) {
        $data['type'] = 'image/svg+xml';
        $data['ext']  = 'svg';
    }
    return $data;
}
add_filter( 'wp_check_filetype_and_ext', 'raio_verde_fix_svg', 10, 4 );
