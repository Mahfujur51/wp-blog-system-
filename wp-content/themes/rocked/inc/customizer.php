<?php
/**
 * Rocked Theme Customizer
 *
 * @package Rocked
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function rocked_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
    $wp_customize->get_section( 'header_image' )->panel         = 'rocked_header_panel';
    $wp_customize->get_section( 'title_tagline' )->priority     = '9';
    $wp_customize->get_section( 'title_tagline' )->title        = __('Site branding', 'rocked');
    $wp_customize->get_section( 'title_tagline' )->panel        = 'rocked_header_panel';    
    $wp_customize->remove_control( 'header_textcolor' );
    $wp_customize->remove_control( 'display_header_text' );

    //Titles
    class Rocked_Info extends WP_Customize_Control {
        public $type = 'info';
        public $label = '';
        public function render_content() {
        ?>
            <h3 style="margin-top:30px;border-bottom:1px solid;padding:5px;color:#111;text-transform:uppercase;"><?php echo esc_html( $this->label ); ?></h3>
        <?php
        }
    }

    //Titles
    class Rocked_Theme_Info extends WP_Customize_Control {
        public $type = 'info';
        public $label = '';
        public function render_content() {
        ?>
            <h3><?php echo esc_html( $this->label ); ?></h3>
        <?php
        }
    }    

    //___General___//
    $wp_customize->add_section(
        'rocked_general',
        array(
            'title' => __('General', 'rocked'),
            'priority' => 9,
        )
    );

    //___Preloader___//
    $wp_customize->add_setting(
        'preloader_text',
        array(
            'sanitize_callback' => 'rocked_sanitize_text',
            'default' => __('Loading&hellip;','rocked'),
        )
    );
    $wp_customize->add_control(
        'preloader_text',
        array(
            'label' => __( 'Preloader text', 'rocked' ),
            'section' => 'rocked_general',
            'type' => 'text',
            'priority' => 11
        )
    );

    //___Header area___//
    $wp_customize->add_panel( 'rocked_header_panel', array(
        'priority'       => 10,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => __('Header area', 'rocked'),
    ) );
    //___Header type___//
    $wp_customize->add_section(
        'rocked_header_type',
        array(
            'title'         => __('Header type', 'rocked'),
            'priority'      => 10,
            'panel'         => 'rocked_header_panel', 
            'description'   => __('Select your header type', 'rocked'),
        )
    );
    //Front page
    $wp_customize->add_setting(
        'front_header_type',
        array(
            'default'           => 'image',
            'sanitize_callback' => 'rocked_sanitize_header',
        )
    );
    $wp_customize->add_control(
        'front_header_type',
        array(
            'type'        => 'radio',
            'label'       => __('Front page header type', 'rocked'),
            'section'     => 'rocked_header_type',
            'description' => __('Select the header type for your front page', 'rocked'),
            'choices' => array(
                'image'     => __('Image', 'rocked'),
                'nothing'   => __('Only menu', 'rocked')
            ),
        )
    );
    //Site
    $wp_customize->add_setting(
        'site_header_type',
        array(
            'default'           => 'image',
            'sanitize_callback' => 'rocked_sanitize_header',
        )
    );
    $wp_customize->add_control(
        'site_header_type',
        array(
            'type'        => 'radio',
            'label'       => __('Site header type', 'rocked'),
            'section'     => 'rocked_header_type',
            'description' => __('Select the header type for all pages except the front page', 'rocked'),
            'choices' => array(
                'image'     => __('Image', 'rocked'),
                'nothing'   => __('Only menu', 'rocked')
            ),
        )
    );

    //___Header text___//
    $wp_customize->add_section(
        'rocked_header_text',
        array(
            'title'         => __('Header text', 'rocked'),
            'priority'      => 14,
            'panel'         => 'rocked_header_panel', 
        )
    );    
    $wp_customize->add_setting(
        'header_title',
        array(
            'default' => __('READY TO ROCK?','rocked'),
            'sanitize_callback' => 'rocked_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'header_title',
        array(
            'label' => __( 'Header title', 'rocked' ),
            'section' => 'rocked_header_text',
            'type' => 'text',
            'priority' => 10
        )
    );
    $wp_customize->add_setting(
        'header_text',
        array(
            'default' => __('Click the button below to start exploring our website and learn more about our awesome company','rocked'),
            'sanitize_callback' => 'rocked_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'header_text',
        array(
            'label' => __( 'Header text', 'rocked' ),
            'section' => 'rocked_header_text',
            'type' => 'text',
            'priority' => 11
        )
    );    
    $wp_customize->add_setting(
        'header_button',
        array(
            'default' => __('Start exploring','rocked'),
            'sanitize_callback' => 'rocked_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'header_button',
        array(
            'label' => __( 'Button text', 'rocked' ),
            'section' => 'rocked_header_text',
            'type' => 'text',
            'priority' => 12
        )
    );
    $wp_customize->add_setting(
        'header_button_url',
        array(
            'default' => '#primary',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        'header_button_url',
        array(
            'label' => __( 'Button URL', 'rocked' ),
            'section' => 'rocked_header_text',
            'type' => 'text',
            'priority' => 13
        )
    );
    //___Menu style___//
    $wp_customize->add_section(
        'rocked_menu_style',
        array(
            'title'         => __('Menu style', 'rocked'),
            'priority'      => 15,
            'panel'         => 'rocked_header_panel', 
        )
    );
    //Sticky menu
    $wp_customize->add_setting(
        'sticky_menu',
        array(
            'default'           => 'header-fixed',
            'sanitize_callback' => 'rocked_sanitize_sticky',
        )
    );
    $wp_customize->add_control(
        'sticky_menu',
        array(
            'type' => 'radio',
            'priority'    => 10,
            'label' => __('Sticky menu', 'rocked'),
            'section' => 'rocked_menu_style',
            'choices' => array(
                'header-fixed'   => __('Sticky', 'rocked'),
                'header-static'   => __('Static', 'rocked'),
            ),
        )
    );
    //Menu style
    $wp_customize->add_setting(
        'menu_style',
        array(
            'default'           => 'menu-inline',
            'sanitize_callback' => 'rocked_sanitize_menu_style',
        )
    );
    $wp_customize->add_control(
        'menu_style',
        array(
            'type'      => 'radio',
            'priority'  => 11,
            'label'     => __('Menu style', 'rocked'),
            'section'   => 'rocked_menu_style',
            'choices'   => array(
                'menu-inline'     => __('Inline', 'rocked'),
                'menu-centered'   => __('Centered', 'rocked'),
            ),
        )
    );

    //Logo Upload
    $wp_customize->add_setting(
        'site_logo',
        array(
            'default-image' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'site_logo',
            array(
               'label'          => __( 'Upload your logo', 'rocked' ),
               'type'           => 'image',
               'section'        => 'title_tagline',
               'priority'       => 12,
            )
        )
    );
    //Header image size
    $wp_customize->add_setting(
        'header_height',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '600',
        )       
    );
    $wp_customize->add_control( 'header_height', array(
        'type'        => 'number',
        'priority'    => 9,
        'section'     => 'header_image',
        'label'       => __('Header image height', 'rocked'),
        'input_attrs' => array(
            'min'   => 100,
            'max'   => 900,
            'step'  => 10,
        ),
    ) );
    //___Blog options___//
    $wp_customize->add_section(
        'blog_options',
        array(
            'title' => __('Blog options', 'rocked'),
            'priority' => 13,
        )
    );  
    // Blog layout
    $wp_customize->add_setting('rocked_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new Rocked_Info( $wp_customize, 'layout', array(
        'label' => __('Layout', 'rocked'),
        'section' => 'blog_options',
        'settings' => 'rocked_options[info]',
        'priority' => 10
        ) )
    );    
    $wp_customize->add_setting(
        'blog_layout',
        array(
            'default'           => 'classic',
            'sanitize_callback' => 'rocked_sanitize_blog',
        )
    );
    $wp_customize->add_control(
        'blog_layout',
        array(
            'type'      => 'radio',
            'label'     => __('Blog layout', 'rocked'),
            'section'   => 'blog_options',
            'priority'  => 11,
            'choices'   => array(
                'classic'           => __( 'Classic', 'rocked' ),
                'fullwidth'         => __( 'Full width (no sidebar)', 'rocked' ),
                'masonry-layout'    => __( 'Masonry (grid style)', 'rocked' )
            ),
        )
    ); 
    //Full width singles
    $wp_customize->add_setting(
        'fullwidth_single',
        array(
            'sanitize_callback' => 'rocked_sanitize_checkbox',
        )       
    );
    $wp_customize->add_control(
        'fullwidth_single',
        array(
            'type'      => 'checkbox',
            'label'     => __('Full width single posts?', 'rocked'),
            'section'   => 'blog_options',
            'priority'  => 12,
        )
    );
    //Content/excerpt
    $wp_customize->add_setting('rocked_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new Rocked_Info( $wp_customize, 'content', array(
        'label' => __('Content/excerpt', 'rocked'),
        'section' => 'blog_options',
        'settings' => 'rocked_options[info]',
        'priority' => 13
        ) )
    );          
    //Full content posts
    $wp_customize->add_setting(
      'full_content_home',
      array(
        'sanitize_callback' => 'rocked_sanitize_checkbox',
        'default' => 0,     
      )   
    );
    $wp_customize->add_control(
        'full_content_home',
        array(
            'type' => 'checkbox',
            'label' => __('Full posts content on the home page?', 'rocked'),
            'section' => 'blog_options',
            'priority' => 14,
        )
    );
    $wp_customize->add_setting(
      'full_content_archives',
      array(
        'sanitize_callback' => 'rocked_sanitize_checkbox',
        'default' => 0,     
      )   
    );
    $wp_customize->add_control(
        'full_content_archives',
        array(
            'type' => 'checkbox',
            'label' => __('Full posts content on all archives?', 'rocked'),
            'section' => 'blog_options',
            'priority' => 15,
        )
    );    
    //Excerpt
    $wp_customize->add_setting(
        'exc_lenght',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '55',
        )       
    );
    $wp_customize->add_control( 'exc_lenght', array(
        'type'        => 'number',
        'priority'    => 16,
        'section'     => 'blog_options',
        'label'       => __('Excerpt lenght', 'rocked'),
        'description' => __('Excerpt length [default: 55 words]', 'rocked'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 200,
            'step'  => 5,
        ),
    ) );
    //Meta
    $wp_customize->add_setting('rocked_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new Rocked_Info( $wp_customize, 'meta', array(
        'label' => __('Meta', 'rocked'),
        'section' => 'blog_options',
        'settings' => 'rocked_options[info]',
        'priority' => 17
        ) )
    ); 
    //Hide meta index
    $wp_customize->add_setting(
      'hide_meta_index',
      array(
        'sanitize_callback' => 'rocked_sanitize_checkbox',
        'default' => 0,     
      )   
    );
    $wp_customize->add_control(
      'hide_meta_index',
      array(
        'type' => 'checkbox',
        'label' => __('Hide post meta on index, archives?', 'rocked'),
        'section' => 'blog_options',
        'priority' => 18,
      )
    );
    //Hide meta single
    $wp_customize->add_setting(
      'hide_meta_single',
      array(
        'sanitize_callback' => 'rocked_sanitize_checkbox',
        'default' => 0,     
      )   
    );
    $wp_customize->add_control(
      'hide_meta_single',
      array(
        'type' => 'checkbox',
        'label' => __('Hide post meta on single posts?', 'rocked'),
        'section' => 'blog_options',
        'priority' => 19,
      )
    );
    //Featured images
    $wp_customize->add_setting('rocked_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new Rocked_Info( $wp_customize, 'images', array(
        'label' => __('Featured images', 'rocked'),
        'section' => 'blog_options',
        'settings' => 'rocked_options[info]',
        'priority' => 21
        ) )
    );     
    //Index images
    $wp_customize->add_setting(
        'index_feat_image',
        array(
            'sanitize_callback' => 'rocked_sanitize_checkbox',
        )       
    );
    $wp_customize->add_control(
        'index_feat_image',
        array(
            'type' => 'checkbox',
            'label' => __('Hide featured images on index, archives?', 'rocked'),
            'section' => 'blog_options',
            'priority' => 22,
        )
    );
    //Post images
    $wp_customize->add_setting(
        'post_feat_image',
        array(
            'sanitize_callback' => 'rocked_sanitize_checkbox',
        )       
    );
    $wp_customize->add_control(
        'post_feat_image',
        array(
            'type' => 'checkbox',
            'label' => __('Hide featured images on single posts?', 'rocked'),
            'section' => 'blog_options',
            'priority' => 23,
        )
    );
    //___Fonts___//
    $wp_customize->add_section(
        'rocked_fonts',
        array(
            'title' => __('Fonts', 'rocked'),
            'priority' => 15,
            'description' => __('You can use any Google Fonts you want for the heading and/or body. See the fonts here: google.com/fonts. See the documentation if you need help with this: athemes.com/documentation/rocked', 'rocked'),
        )
    );
    //Body fonts title
    $wp_customize->add_setting('rocked_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new Rocked_Info( $wp_customize, 'body_fonts', array(
        'label' => __('Body fonts', 'rocked'),
        'section' => 'rocked_fonts',
        'settings' => 'rocked_options[info]',
        'priority' => 6
        ) )
    );       
    //Body fonts
    $wp_customize->add_setting(
        'body_font_name',
        array(
            'default' => 'Open+Sans:300,300italic,400,400italic,600,600italic,700',
            'sanitize_callback' => 'rocked_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'body_font_name',
        array(
            'label' => __( 'Body font name/style/sets', 'rocked' ),
            'section' => 'rocked_fonts',
            'type' => 'text',
            'priority' => 7
        )
    );
    //Body fonts family
    $wp_customize->add_setting(
        'body_font_family',
        array(
            'default' => '\'Open Sans\', sans-serif',
            'sanitize_callback' => 'rocked_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'body_font_family',
        array(
            'label' => __( 'Body font family', 'rocked' ),
            'section' => 'rocked_fonts',
            'type' => 'text',
            'priority' => 8
        )
    );   
    //Headings fonts title
    $wp_customize->add_setting('rocked_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new Rocked_Info( $wp_customize, 'headings_fonts', array(
        'label' => __('Headings fonts', 'rocked'),
        'section' => 'rocked_fonts',
        'settings' => 'rocked_options[info]',
        'priority' => 9
        ) )
    );       
    //Headings fonts
    $wp_customize->add_setting(
        'headings_font_name',
        array(
            'default' => 'Montserrat:400,700',
            'sanitize_callback' => 'rocked_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'headings_font_name',
        array(
            'label' => __( 'Headings font name/style/sets', 'rocked' ),
            'section' => 'rocked_fonts',
            'type' => 'text',
            'priority' => 10
        )
    );
    //Headings fonts family
    $wp_customize->add_setting(
        'headings_font_family',
        array(
            'default' => '\'Montserrat\', sans-serif',
            'sanitize_callback' => 'rocked_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'headings_font_family',
        array(
            'label' => __( 'Headings font family', 'rocked' ),
            'section' => 'rocked_fonts',
            'type' => 'text',
            'priority' => 11
        )
    );
    //Font sizes title
    $wp_customize->add_setting('rocked_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new Rocked_Info( $wp_customize, 'font_sizes', array(
        'label' => __('Font sizes', 'rocked'),
        'section' => 'rocked_fonts',
        'settings' => 'rocked_options[info]',
        'priority' => 12
        ) )
    );    
    // Site title
    $wp_customize->add_setting(
        'site_title_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '38',
        )       
    );
    $wp_customize->add_control( 'site_title_size', array(
        'type'        => 'number',
        'priority'    => 17,
        'section'     => 'rocked_fonts',
        'label'       => __('Site title', 'rocked'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 90,
            'step'  => 1,
        ),
    ) ); 
    // Site description
    $wp_customize->add_setting(
        'site_desc_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '14',
        )       
    );
    $wp_customize->add_control( 'site_desc_size', array(
        'type'        => 'number',
        'priority'    => 17,
        'section'     => 'rocked_fonts',
        'label'       => __('Site description', 'rocked'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 50,
            'step'  => 1,
        ),
    ) );         
    //H1 size
    $wp_customize->add_setting(
        'h1_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '52',
        )       
    );
    $wp_customize->add_control( 'h1_size', array(
        'type'        => 'number',
        'priority'    => 17,
        'section'     => 'rocked_fonts',
        'label'       => __('H1 font size', 'rocked'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
        ),
    ) );   
    //H2 size
    $wp_customize->add_setting(
        'h2_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '40',
        )       
    );
    $wp_customize->add_control( 'h2_size', array(
        'type'        => 'number',
        'priority'    => 18,
        'section'     => 'rocked_fonts',
        'label'       => __('H2 font size', 'rocked'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
        ),
    ) );
    //H3 size
    $wp_customize->add_setting(
        'h3_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '30',
        )       
    );
    $wp_customize->add_control( 'h3_size', array(
        'type'        => 'number',
        'priority'    => 19,
        'section'     => 'rocked_fonts',
        'label'       => __('H3 font size', 'rocked'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
        ),
    ) );
    //H4 size
    $wp_customize->add_setting(
        'h4_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '26',
        )       
    );
    $wp_customize->add_control( 'h4_size', array(
        'type'        => 'number',
        'priority'    => 20,
        'section'     => 'rocked_fonts',
        'label'       => __('H4 font size', 'rocked'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
        ),
    ) );
    //H5 size
    $wp_customize->add_setting(
        'h5_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '22',
        )       
    );
    $wp_customize->add_control( 'h5_size', array(
        'type'        => 'number',
        'priority'    => 21,
        'section'     => 'rocked_fonts',
        'label'       => __('H5 font size', 'rocked'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
        ),
    ) );
    //H6 size
    $wp_customize->add_setting(
        'h6_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '18',
        )       
    );
    $wp_customize->add_control( 'h6_size', array(
        'type'        => 'number',
        'priority'    => 22,
        'section'     => 'rocked_fonts',
        'label'       => __('H6 font size', 'rocked'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
        ),
    ) );
    //Body
    $wp_customize->add_setting(
        'body_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '14',
        )       
    );
    $wp_customize->add_control( 'body_size', array(
        'type'        => 'number',
        'priority'    => 23,
        'section'     => 'rocked_fonts',
        'label'       => __('Body font size', 'rocked'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 24,
            'step'  => 1,
        ),
    ) );

    //___Colors___//
    //Primary color
    $wp_customize->add_setting(
        'primary_color',
        array(
            'default'           => '#ffa800',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'primary_color',
            array(
                'label'         => __('Primary color', 'rocked'),
                'section'       => 'colors',
                'settings'      => 'primary_color',
                'priority'      => 12
            )
        )
    );
    //Menu bg
    $wp_customize->add_setting(
        'menu_bg_color',
        array(
            'default'           => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'menu_bg_color',
            array(
                'label' => __('Menu background', 'rocked'),
                'section' => 'colors',
                'priority' => 12
            )
        )
    );     
    //Site title
    $wp_customize->add_setting(
        'site_title_color',
        array(
            'default'           => '#222',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'site_title_color',
            array(
                'label' => __('Site title', 'rocked'),
                'section' => 'colors',
                'settings' => 'site_title_color',
                'priority' => 13
            )
        )
    );
    //Site desc
    $wp_customize->add_setting(
        'site_desc_color',
        array(
            'default'           => '#222',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'site_desc_color',
            array(
                'label' => __('Site description', 'rocked'),
                'section' => 'colors',
                'priority' => 14
            )
        )
    );
    //Top level menu items
    $wp_customize->add_setting(
        'top_items_color',
        array(
            'default'           => '#222',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'top_items_color',
            array(
                'label' => __('Top level menu items', 'rocked'),
                'section' => 'colors',
                'priority' => 15
            )
        )
    );
    //Sub menu items color
    $wp_customize->add_setting(
        'submenu_items_color',
        array(
            'default'           => '#222',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'submenu_items_color',
            array(
                'label' => __('Sub-menu items', 'rocked'),
                'section' => 'colors',
                'priority' => 16
            )
        )
    );
    //Header text
    $wp_customize->add_setting(
        'header_text_color',
        array(
            'default'           => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'header_text_color',
            array(
                'label' => __('Header text', 'rocked'),
                'section' => 'colors',
                'priority' => 18
            )
        )
    );
    //Body
    $wp_customize->add_setting(
        'body_text_color',
        array(
            'default'           => '#777',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'body_text_color',
            array(
                'label' => __('Body text', 'rocked'),
                'section' => 'colors',
                'priority' => 19
            )
        )
    );    
    //Footer widget area
    $wp_customize->add_setting(
        'footer_widgets_background',
        array(
            'default'           => '#2d2d2d',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'footer_widgets_background',
            array(
                'label' => __('Footer widget area background', 'rocked'),
                'section' => 'colors',
                'priority' => 22
            )
        )
    );
    //Rows overlay
    $wp_customize->add_setting(
        'rows_overlay',
        array(
            'default'           => '#1c1c1c',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'            
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'rows_overlay',
            array(
                'label' => __('Rows overlay', 'rocked'),
                'section' => 'colors',
                'priority' => 23
            )
        )
    );
    //Header overlay
    $wp_customize->add_setting(
        'header_overlay',
        array(
            'default'           => '#000',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'header_overlay',
            array(
                'label' => __('Header overlay', 'rocked'),
                'section' => 'colors',
                'priority' => 24
            )
        )
    );    

    //___Footer___//
    $wp_customize->add_section(
        'rocked_footer',
        array(
            'title'         => __('Footer widgets', 'rocked'),
            'priority'      => 18,
        )
    );
    $wp_customize->add_setting(
        'footer_widget_areas',
        array(
            'default'           => '3',
            'sanitize_callback' => 'rocked_sanitize_fwidgets',
        )
    );
    $wp_customize->add_control(
        'footer_widget_areas',
        array(
            'type'        => 'radio',
            'label'       => __('Footer widget area', 'rocked'),
            'section'     => 'rocked_footer',
            'description' => __('Choose the number of widget areas in the footer, then go to Appearance > Widgets and add your widgets.', 'rocked'),
            'choices' => array(
                '1'     => __('One', 'rocked'),
                '2'     => __('Two', 'rocked'),
                '3'     => __('Three', 'rocked'),
            ),
        )
    );

    //___Theme info___//
    $wp_customize->add_section(
        'rocked_themeinfo',
        array(
            'title' => __('Theme info', 'rocked'),
            'priority' => 99,
            'description' => '<p style="padding-bottom: 10px;border-bottom: 1px solid #d3d2d2">' . __('1. Documentation for Rocked can be found ', 'rocked') . '<a target="_blank" href="http://athemes.com/documentation/rocked/">here</a></p><p style="padding-bottom: 10px;border-bottom: 1px solid #d3d2d2">' . __('2. A full theme demo can be found ', 'rocked') . '<a target="_blank" href="http://demo.athemes.com/rocked/">here</a></p>' . __('3. If you enjoy Rocked and want to see what Rocked Pro offers, please go ', 'rocked') . '<a target="_blank" href="http://athemes.com/theme/rocked-pro/">here</a></p>',         
        )
    );
    $wp_customize->add_setting('rocked_theme_docs', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new Rocked_Theme_Info( $wp_customize, 'documentation', array(
        'section' => 'rocked_themeinfo',
        'settings' => 'rocked_theme_docs',
        'priority' => 10
        ) )
    );      

}
add_action( 'customize_register', 'rocked_customize_register' );

/**
* Sanitize
*/
//Text
function rocked_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}
//Checkboxes
function rocked_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}
//Header type
function rocked_sanitize_header( $input ) {
    if ( in_array( $input, array( 'image', 'nothing' ), true ) ) {
        return $input;
    }
}
//Menu style
function rocked_sanitize_menu_style( $input ) {
    if ( in_array( $input, array( 'menu-inline', 'menu-centered' ), true ) ) {
        return $input;
    }
}
//Menu style
function rocked_sanitize_sticky( $input ) {
    if ( in_array( $input, array( 'header-fixed', 'header-static' ), true ) ) {
        return $input;
    }
}
//Footer widget areas
function rocked_sanitize_fwidgets( $input ) {
    if ( in_array( $input, array( '1', '2', '3' ), true ) ) {
        return $input;
    }
}
//Blog layout
function rocked_sanitize_blog( $input ) {
    if ( in_array( $input, array( 'classic', 'fullwidth', 'masonry-layout' ), true ) ) {
        return $input;
    }
}
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function rocked_customize_preview_js() {
	wp_enqueue_script( 'rocked_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'rocked_customize_preview_js' );
