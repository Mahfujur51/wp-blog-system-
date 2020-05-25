<?php
/**
 * Page builder support
 *
 * @package Rocked
 */


/* Defaults */
add_theme_support( 'siteorigin-panels', array( 
	'margin-bottom' => 0,
) );

/* Theme widgets */
function rocked_theme_widgets($widgets) {
	$theme_widgets = array(
		'Rocked_Services_Type_A',
		'Rocked_Services_Type_B',
		'Rocked_Facts',
		'Rocked_Clients',
		'Rocked_Testimonials',
		'Rocked_Skills',
		'Rocked_Action',
		'Rocked_Video_Widget',
		'Rocked_Social_Profile',
		'Rocked_Employees',
		'Rocked_Latest_News',
		'Rocked_Projects'
	);
	foreach($theme_widgets as $theme_widget) {
		if( isset( $widgets[$theme_widget] ) ) {
			$widgets[$theme_widget]['groups'] = array('rocked-theme');
			$widgets[$theme_widget]['icon'] = 'dashicons dashicons-schedule';
		}
	}
	return $widgets;
}
add_filter('siteorigin_panels_widgets', 'rocked_theme_widgets');

/* Add a tab for the theme widgets in the page builder */
function rocked_theme_widgets_tab($tabs){
	$tabs[] = array(
		'title' => __('Rocked Theme Widgets', 'rocked'),
		'filter' => array(
			'groups' => array('rocked-theme')
		)
	);
	return $tabs;
}
add_filter('siteorigin_panels_widget_dialog_tabs', 'rocked_theme_widgets_tab', 20);

/* Replace default row options */
function rocked_row_styles($fields) {

	$fields['bottom_border'] = array(
		'name' => __('Bottom Border Color', 'rocked'),
		'type' => 'color',
		'priority' => 3,		
	);
	$fields['padding'] = array(
		'name' => __('Top/bottom padding', 'rocked'),
		'type' => 'measurement',
		'description' => __('Top and bottom padding for this row [default: 100px]', 'rocked'),
		'priority' => 4,
	);
	$fields['align'] = array(
		'name' => __('Center align the content?', 'rocked'),
		'type' => 'checkbox',
		'description' => __('This may or may not work. It depends on the widget styles.', 'rocked'),
		'priority' => 5,
	);		
	$fields['background'] = array(
		'name' => __('Background Color', 'rocked'),
		'type' => 'color',
		'description' => __('Background color of the row.', 'rocked'),
		'priority' => 6,
	);
	$fields['color'] = array(
		'name' => __('Color', 'rocked'),
		'type' => 'color',
		'description' => __('Color of the row.', 'rocked'),
		'priority' => 7,
	);	
	$fields['background_image'] = array(
		'name' => __('Background Image', 'rocked'),
		'type' => 'image',
		'description' => __('Background image of the row.', 'rocked'),
		'priority' => 8,
	);		
	$fields['row_stretch'] = array(
		'name' 		=> __('Row Layout', 'rocked'),
		'type' 		=> 'select',
		'options' 	=> array(
			'' 				 => __('Standard', 'rocked'),
			'full' 			 => __('Full Width', 'rocked'),
			'full-stretched' => __('Full Width Stretched', 'rocked'),
		),
		'priority' => 9,
	);
	$fields['mobile_padding'] = array(
		'name' 		  => __('Mobile padding', 'rocked'),
		'type' 		  => 'select',
		'description' => __('Here you can select a top/bottom row padding for screen sizes < 1024px', 'rocked'),		
		'options' 	  => array(
			'' 				=> __('Default', 'rocked'),
			'mob-pad-0' 	=> __('0', 'rocked'),
			'mob-pad-15'    => __('15px', 'rocked'),
			'mob-pad-30'    => __('30px', 'rocked'),
			'mob-pad-45'    => __('45px', 'rocked'),
		),
		'priority'    => 10,
	);
	$fields['class'] = array(
		'name' => __('Row Class', 'rocked'),
		'type' => 'text',
		'description' => __('Add your own class for this row', 'rocked'),
		'priority' => 11,
	);
	$fields['column_padding'] = array(
		'name'        => __('Columns padding', 'rocked'),
		'type'        => 'checkbox',
		'description' => __('Remove padding between columns for this row?', 'rocked'),
		'priority'    => 12,
	);	

	return $fields;
}
remove_filter('siteorigin_panels_row_style_fields', array('SiteOrigin_Panels_Default_Styling', 'row_style_fields' ) );
add_filter('siteorigin_panels_row_style_fields', 'rocked_row_styles');

/* Filter for the styles */
function rocked_row_styles_output($attr, $style) {
	$attr['style'] = '';

	if(!empty($style['bottom_border'])) $attr['style'] .= 'border-bottom: 1px solid '. esc_attr($style['bottom_border']) . ';';
	if(!empty($style['background'])) $attr['style'] .= 'background-color: ' . esc_attr($style['background']) . ';';
	if(!empty($style['color'])) {
		$attr['style'] .= 'color: ' . esc_attr($style['color']) . ';';
		$attr['data-hascolor'] = 'hascolor';
	}
	if(!empty($style['align'])) $attr['style'] .= 'text-align: center;';
	if(!empty( $style['background_image'] )) {
		$url = wp_get_attachment_image_src( $style['background_image'], 'full' );
		if( !empty($url) ) {
			$attr['style'] .= 'background-image: url(' . esc_url($url[0]) . ');';
			$attr['class'][] = 'parallax';
			$attr['data-hasbg'] = 'hasbg';
		}
	}
	if(!empty($style['padding'])) {
		$attr['style'] .= 'padding: ' . esc_attr($style['padding']) . ' 0; ';
	} else {
		$attr['style'] .= 'padding: 100px 0; ';
	}
	if( !empty( $style['row_stretch'] ) ) {
		$attr['class'][] = 'rocked-stretch';
		$attr['data-stretch-type'] = esc_attr($style['row_stretch']);
	}
	if( !empty( $style['mobile_padding'] ) ) {
		$attr['class'][] = esc_attr($style['mobile_padding']);
	}
    if( !empty( $style['column_padding'] ) ) {
       $attr['class'][] = 'no-col-padding';
    }
    
	if(empty($attr['style'])) unset($attr['style']);
	return $attr;
}
add_filter('siteorigin_panels_row_style_attributes', 'rocked_row_styles_output', 10, 2);