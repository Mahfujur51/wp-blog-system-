<?php
/**
 * Rocked functions and definitions
 *
 * @package Rocked
 */

if ( ! function_exists( 'rocked_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function rocked_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Rocked, use a find and replace
	 * to change 'rocked' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'rocked', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	// Content width
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 1170;
	}

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size('rocked-large-thumb', 700);
	add_image_size('rocked-medium-thumb', 410);
	add_image_size('rocked-small-thumb', 100);
	add_image_size('rocked-client-thumb', 275);	

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'rocked' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'rocked_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // rocked_setup
add_action( 'after_setup_theme', 'rocked_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function rocked_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'rocked' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	//Footer widget areas
	$widget_areas = get_theme_mod('footer_widget_areas', '3');
	for ($i=1; $i<=$widget_areas; $i++) {
		register_sidebar( array(
			'name'          => __( 'Footer ', 'rocked' ) . $i,
			'id'            => 'footer-' . $i,
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}

	//Register the front page widgets
	if ( function_exists('siteorigin_panels_activate') ) {
		register_widget( 'Rocked_Services_Type_A' );
		register_widget( 'Rocked_Services_Type_B' );
		register_widget( 'Rocked_Facts' );
		register_widget( 'Rocked_Clients' );
		register_widget( 'Rocked_Testimonials' );
		register_widget( 'Rocked_Skills' );
		register_widget( 'Rocked_Projects' );
		register_widget( 'Rocked_Action' );
		register_widget( 'Rocked_Video_Widget' );
		register_widget( 'Rocked_Social_Profile' );
		register_widget( 'Rocked_Employees' );
		register_widget( 'Rocked_Latest_News' );
		register_widget( 'Rocked_Contact_Info' );
	}

}
add_action( 'widgets_init', 'rocked_widgets_init' );

/**
 * Load the front page widgets.
 */
if ( function_exists('siteorigin_panels_activate') ) {
	require get_template_directory() . "/widgets/fp-services-type-a.php";
	require get_template_directory() . "/widgets/fp-services-type-b.php";
	require get_template_directory() . "/widgets/fp-facts.php";
	require get_template_directory() . "/widgets/fp-projects.php";
	require get_template_directory() . "/widgets/fp-clients.php";
	require get_template_directory() . "/widgets/fp-testimonials.php";
	require get_template_directory() . "/widgets/fp-skills.php";
	require get_template_directory() . "/widgets/fp-call-to-action.php";
	require get_template_directory() . "/widgets/video-widget.php";
	require get_template_directory() . "/widgets/fp-social.php";
	require get_template_directory() . "/widgets/fp-employees.php";
	require get_template_directory() . "/widgets/fp-latest-news.php";
	require get_template_directory() . "/widgets/contact-info.php";
}

/**
 * Enqueue scripts and styles.
 */
function rocked_scripts() {

	wp_enqueue_style( 'rocked-style', get_stylesheet_uri() );

	if ( get_theme_mod('body_font_name') !='' ) {
	    wp_enqueue_style( 'rocked-body-fonts', '//fonts.googleapis.com/css?family=' . esc_attr(get_theme_mod('body_font_name')) ); 
	} else {
	    wp_enqueue_style( 'rocked-body-fonts', '//fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700');
	}

	if ( get_theme_mod('headings_font_name') !='' ) {
	    wp_enqueue_style( 'rocked-headings-fonts', '//fonts.googleapis.com/css?family=' . esc_attr(get_theme_mod('headings_font_name')) ); 
	} else {
	    wp_enqueue_style( 'rocked-headings-fonts', '//fonts.googleapis.com/css?family=Montserrat:400,700'); 
	}

	wp_enqueue_style( 'rocked-fontawesome', get_template_directory_uri() . '/fonts/font-awesome.min.css' );	

	wp_enqueue_script( 'rocked-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( get_theme_mod('blog_layout') == 'masonry-layout' && (is_home() || is_archive()) ) {
		wp_enqueue_script( 'rocked-masonry-init', get_template_directory_uri() . '/js/masonry-init.js', array('masonry'),'', true );		
	}	

	wp_enqueue_script( 'rocked-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'),'', true );

	wp_enqueue_script( 'rocked-main', get_template_directory_uri() . '/js/main.min.js', array('jquery'),'', true );

}
add_action( 'wp_enqueue_scripts', 'rocked_scripts' );

/**
 * Enqueue Bootstrap
 */
function rocked_enqueue_bootstrap() {
	wp_enqueue_style( 'rocked-bootstrap', get_template_directory_uri() . '/css/bootstrap/bootstrap.min.css', array(), true );
}
add_action( 'wp_enqueue_scripts', 'rocked_enqueue_bootstrap', 9 );

/**
 * Load html5shiv
 */
function rocked_html5shiv() {
    echo '<!--[if lt IE 9]>' . "\n";
    echo '<script src="' . esc_url( get_template_directory_uri() . '/js/html5shiv.js' ) . '"></script>' . "\n";
    echo '<![endif]-->' . "\n";
}
add_action( 'wp_head', 'rocked_html5shiv' );

/**
 * Site branding
 */
if ( ! function_exists( 'rocked_branding' ) ) :
function rocked_branding() {
	if ( get_theme_mod('site_logo') ) :
		echo '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr(get_bloginfo('name')) . '"><img class="site-logo" src="' . esc_url(get_theme_mod('site_logo')) . '" alt="' . esc_attr(get_bloginfo('name')) . '" /></a>';
	else :
		echo '<h1 class="site-title"><a href="' . esc_url(home_url( '/' )) . '" rel="home">' . esc_html(get_bloginfo('name')) . '</a></h1>';
		if ( get_bloginfo( 'description' ) ) {
		echo '<h2 class="site-description">' . esc_html(get_bloginfo( 'description' )) . '</h2>'; 
		}     
	endif;
}
endif;

/**
 * Blog layout
 */
function rocked_blog_layout() {
	$layout = get_theme_mod('blog_layout','classic');
	return $layout;
}

/**
 * Full width single posts
 */
function rocked_fullwidth_singles($classes) {
	if ( get_theme_mod('fullwidth_single', 0) ) {
		$classes[] = 'fullwidth-single';
	}
	return $classes;
}
add_filter('body_class', 'rocked_fullwidth_singles');

/**
 * Sticky header
 */
function rocked_sticky_menu($classes) {
	$classes[] = esc_attr(get_theme_mod('sticky_menu', 'header-fixed'));
	return $classes;
}
add_filter('body_class', 'rocked_sticky_menu');

/**
 * Menu style
 */
function rocked_menu_style($classes) {
	$classes[] = esc_attr(get_theme_mod('menu_style', 'menu-inline'));
	return $classes;
}
add_filter('body_class', 'rocked_menu_style');

/**
 * Header text
 */
if ( !function_exists('rocked_header_text') ) :
function rocked_header_text() {
	if ( !function_exists('pll_register_string') ) {
		$header_title	= get_theme_mod('header_title', __('READY TO ROCK?','rocked'));
		$header_text 	= get_theme_mod('header_text', __('Click the button below to start exploring our website and learn more about our awesome company','rocked'));
		$button_text	= get_theme_mod('header_button', __('Start exploring','rocked'));
		$button_url		= get_theme_mod('header_button_url', '#primary');
	} else  { //Add Polylang compatibility
		$header_title	= pll__(get_theme_mod('header_title', 'READY TO ROCK?'));
		$header_text 	= pll__(get_theme_mod('header_text', 'Click the button below to start exploring our website and learn more about our awesome company'));
		$button_text	= pll__(get_theme_mod('header_button', 'Start exploring'));
		$button_url		= pll__(get_theme_mod('header_button_url', '#primary'));
	}

	echo '<div class="header-info">';
		echo '<h2 class="header-title">' . esc_html($header_title) . '</h2>';
		if ($header_text) {
		echo '<div class="header-text">' . wp_kses_post($header_text) . '</div>';
		}
		if ($button_text) {
		echo '<a href="' . esc_url($button_url) . '" class="roll-button">' . esc_html($button_text) . '</a>';
		}
	echo '</div>';	
}
endif;

/**
 * Change the excerpt length
 */
function rocked_excerpt_length( $length ) {
	$excerpt = get_theme_mod('exc_lenght', '55');
	return $excerpt;
}
add_filter( 'excerpt_length', 'rocked_excerpt_length', 999 );

/**
 * Post format icons
 */
function rocked_post_formats() {
	
	if( true == get_post_format() && !is_sticky() ) {
		if ( has_post_format('gallery') ) {
			echo '<i class="fa fa-camera"></i>';
		} elseif ( has_post_format('image') ) {
			echo '<i class="fa fa-camera"></i>';
		} elseif ( has_post_format('status') ) {
			echo '<i class="fa fa-asterisk"></i>';				
		} elseif ( has_post_format('quote') ) {
			echo '<i class="fa fa-quote-left"></i>';
		} elseif ( has_post_format('chat') ) {
			echo '<i class="fa fa-comments"></i>';				
		} elseif ( has_post_format('link') ) {
			echo '<i class="fa fa-link"></i>';
		} elseif ( has_post_format('video') ) {
			echo '<i class="fa fa-video-camera"></i>';
		} elseif ( has_post_format('audio') ) {
			echo '<i class="fa fa-headphones"></i>';				
		}
	} elseif ( is_sticky() ) {
		echo '<span class="corner"><i class="fa fa-bullhorn"></i></span>';
	} else {
		echo '<i class="fa fa-pencil"></i>';	
	}
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Styles
 */
require get_template_directory() . '/inc/styles.php';

/**
 * Page builder integration
 */
require get_template_directory() . '/inc/builder.php';

/**
 * Theme info
 */
require get_template_directory() . '/inc/theme-info.php';