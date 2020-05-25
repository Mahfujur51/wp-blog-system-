/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );


    //Menu background
    wp.customize('menu_bg_color',function( value ) {
        value.bind( function( newval ) {
            $('.header').css('background-color', newval );
        } );
    });
    //Site title
    wp.customize('site_title_color',function( value ) {
        value.bind( function( newval ) {
            $('.site-title a').css('color', newval );
        } );
    });
    //Site desc
    wp.customize('site_desc_color',function( value ) {
        value.bind( function( newval ) {
            $('.site-description').css('color', newval );
        } );
    });
    //Header text
    wp.customize('header_text_color',function( value ) {
        value.bind( function( newval ) {
            $('.header-text, .header-title').css('color', newval );
        } );
    }); 
    // Body text color
    wp.customize('body_text_color',function( value ) {
        value.bind( function( newval ) {
            $('body').css('color', newval );
        } );
    });
    //Footer widgets background
    wp.customize('footer_widgets_background',function( value ) {
        value.bind( function( newval ) {
            $('.footer-widgets.footer').css('background-color', newval );
        } );
    })
    //Rows overlay
    wp.customize('rows_overlay',function( value ) {
        value.bind( function( newval ) {
            $('.row-overlay').css('background-color', newval );
        } );
    })
} )( jQuery );
