<?php
/**
 * Theme info page
 *
 * @package Rocked
 */

//Add the theme page
add_action('admin_menu', 'rocked_add_theme_info');
function rocked_add_theme_info(){
	$theme_info = add_theme_page( __('Rocked Info','rocked'), __('Rocked Info','rocked'), 'manage_options', 'rocked-info.php', 'rocked_info_page' );
    add_action( 'load-' . $theme_info, 'rocked_info_hook_styles' );
}

//Callback
function rocked_info_page() {
?>
	<div class="info-container">
		<h2 class="info-title"><?php _e('rocked Info','rocked'); ?></h2>
		<div class="info-block"><div class="dashicons dashicons-desktop info-icon"></div><p class="info-text"><a href="http://demo.athemes.com/themes/?theme=Rocked" target="_blank"><?php _e('Theme demo','rocked'); ?></a></p></div>
		<div class="info-block"><div class="dashicons dashicons-book-alt info-icon"></div><p class="info-text"><a href="http://athemes.com/documentation/rocked" target="_blank"><?php _e('Documentation','rocked'); ?></a></p></div>
		<div class="info-block"><div class="dashicons dashicons-sos info-icon"></div><p class="info-text"><a href="http://athemes.com/forums" target="_blank"><?php _e('Support','rocked'); ?></a></p></div>
		<div class="info-block"><div class="dashicons dashicons-smiley info-icon"></div><p class="info-text"><a href="http://athemes.com/theme/rocked-pro" target="_blank"><?php _e('Pro version','rocked'); ?></a></p></div>	
	</div>
<?php
}

//Styles
function rocked_info_hook_styles(){
   	add_action( 'admin_enqueue_scripts', 'rocked_info_page_styles' );
}
function rocked_info_page_styles() {
	wp_enqueue_style( 'rocked-info-style', get_template_directory_uri() . '/css/info-page.css', array(), true );
}