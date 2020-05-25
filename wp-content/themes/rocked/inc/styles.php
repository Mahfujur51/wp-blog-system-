<?php
/**
 * @package Rocked
 */


//Dynamic styles
function rocked_custom_styles($custom) {

	$custom = '';

    //Header height
    $header_height = get_theme_mod( 'header_height', '600' );
    if ($header_height) {
        $custom .= "@media only screen and (min-width: 992px) {.header-image { height:" . intval($header_height) . "px; }}"."\n";
    }	

	//Primary color
	$primary_color = get_theme_mod( 'primary_color', '#ffa800' );
	if ( $primary_color != '#618EBA' ) {
		$custom .= ".roll-testimonials:before,.roll-testimonials .name,.roll-news .entry .title a:hover,.roll-news .entry .meta span a:hover,.roll-progress .perc,.roll-iconbox.style2 .icon,.roll-iconbox.border .icon,.widget.widget-info li:before,.widget-area .widget li a:hover,.post .post-meta a:hover,#mainnav ul li a.active,#mainnav ul li a:hover,a, .social-area a, .post .entry-footer .fa, .post .post-meta .fa, .preloader .preloader-inner { color:" . esc_attr($primary_color) . ";}"."\n";
		$custom .= ".header-text::before,.roll-team .overlay .socials li a,.rocked-toggle .toggle-title.active,.rocked-toggle .toggle-title.active,.roll-progress .animate,.roll-iconbox.border:hover .icon,.roll-iconbox .icon,.roll-button,.owl-theme .owl-controls .owl-page.active span,.work-faetures .box .icon,.widget.widget-tags .tags a:hover,.page-pagination ul li.active,.page-pagination ul li:hover a,.post .post-format,#mainnav ul ul li:hover > a,#mainnav ul li ul:after,button,input[type=\"button\"],input[type=\"reset\"],input[type=\"submit\"],.social-area a:hover { background-color:" . esc_attr($primary_color) . ";}"."\n";
		$custom .= ".roll-iconbox.border .icon,.owl-theme .owl-controls .owl-page.active span,.widget.widget-tags .tags a:hover,.social-area a { border-color:" . esc_attr($primary_color) . ";}"."\n";
		$custom .= "#mainnav ul li ul:before { border-color:transparent transparent " . esc_attr($primary_color) . " transparent;}"."\n";

	}
	//Menu background
	$menu_bg_color = get_theme_mod( 'menu_bg_color', '#ffffff' );
	$custom .= ".header { background-color:" . esc_attr($menu_bg_color) . ";}" . "\n";
	//Site title
	$site_title = get_theme_mod( 'site_title_color', '#222' );
	$custom .= ".site-title a, .site-title a:hover { color:" . esc_attr($site_title) . "}"."\n";
	//Site desc
	$site_desc = get_theme_mod( 'site_desc_color', '#222' );
	$custom .= ".site-description { color:" . esc_attr($site_desc) . "}"."\n";
	//Top level menu items color
	$top_items_color = get_theme_mod( 'top_items_color', '#222' );
	$custom .= "#mainnav ul li a { color:" . esc_attr($top_items_color) . "}"."\n";
	//Sub menu items color
	$submenu_items_color = get_theme_mod( 'submenu_items_color', '#222' );
	$custom .= "#mainnav ul ul li a { color:" . esc_attr($submenu_items_color) . "}"."\n";	
	//Header text
	$header_text_color = get_theme_mod( 'header_text_color', '#ffffff' );
	$custom .= ".header-text, .header-title { color:" . esc_attr($header_text_color) . "}"."\n";
	//Body
	$body_text = get_theme_mod( 'body_text_color', '#777' );
	$custom .= "body { color:" . esc_attr($body_text) . "}"."\n";
	//Footer widget area background
	$footer_widgets_background = get_theme_mod( 'footer_widgets_background', '#2d2d2d' );
	$custom .= ".footer-widgets.footer { background-color:" . esc_attr($footer_widgets_background) . "}"."\n";	
	//Rows overlay
	$rows_overlay = get_theme_mod( 'rows_overlay', '#1c1c1c' );
	$custom .= ".row-overlay { background-color:" . esc_attr($rows_overlay) . "}"."\n";		
	//Header overlay
	$rows_overlay = get_theme_mod( 'header_overlay', '#000' );
	$custom .= ".header-image::after { background-color:" . esc_attr($rows_overlay) . "}"."\n";

	//Fonts
	$body_fonts = get_theme_mod('body_font_family');	
	$headings_fonts = get_theme_mod('headings_font_family');
	if ( $body_fonts !='' ) {
		$custom .= "body, .footer .widget-title { font-family:" . wp_kses_post($body_fonts) . ";}"."\n";
	}
	if ( $headings_fonts !='' ) {
		$custom .= "h1, h2, h3, h4, h5, h6, .roll-button, .rocked-toggle .toggle-title, .roll-works .all-work, .roll-counter .name-count, .roll-counter .numb-count, .roll-testimonials .name, .roll-news .entry .meta { font-family:" . wp_kses_post($headings_fonts) . ";}"."\n";
	}
    //Site title
    $site_title_size = get_theme_mod( 'site_title_size', '38' );
    if ( $site_title_size ) {
        $custom .= ".site-title { font-size:" . intval($site_title_size) . "px; }"."\n";
    }
    //Site description
    $site_desc_size = get_theme_mod( 'site_desc_size', '14' );
    if ( $site_desc_size ) {
        $custom .= ".site-description { font-size:" . intval($site_desc_size) . "px; }"."\n";
    }	    	
	//H1 size
	$h1_size = get_theme_mod( 'h1_size' );
	if ( $h1_size ) {
		$custom .= "h1 { font-size:" . intval($h1_size) . "px; }"."\n";
	}
    //H2 size
    $h2_size = get_theme_mod( 'h2_size' );
    if ( $h2_size ) {
        $custom .= "h2 { font-size:" . intval($h2_size) . "px; }"."\n";
    }
    //H3 size
    $h3_size = get_theme_mod( 'h3_size' );
    if ( $h3_size ) {
        $custom .= "h3, .panel-grid-cell .widget-title { font-size:" . intval($h3_size) . "px; }"."\n";
    }
    //H4 size
    $h4_size = get_theme_mod( 'h4_size' );
    if ( $h4_size ) {
        $custom .= "h4 { font-size:" . intval($h4_size) . "px; }"."\n";
    }
    //H5 size
    $h5_size = get_theme_mod( 'h5_size' );
    if ( $h5_size ) {
        $custom .= "h5 { font-size:" . intval($h5_size) . "px; }"."\n";
    }
    //H6 size
    $h6_size = get_theme_mod( 'h6_size' );
    if ( $h6_size ) {
        $custom .= "h6 { font-size:" . intval($h6_size) . "px; }"."\n";
    }
    //Body size
    $body_size = get_theme_mod( 'body_size' );
    if ( $body_size ) {
        $custom .= "body { font-size:" . intval($body_size) . "px; }"."\n";
    }
	//Output all the styles
	wp_add_inline_style( 'rocked-style', $custom );	
}
add_action( 'wp_enqueue_scripts', 'rocked_custom_styles' );