/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) { $( '.site-title a' ).text( to ); } );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) { $( '.site-description' ).text( to );	} );
	} );


	// Header text color.
	// https://material-ui.com/style/color/
	wp.customize( 'mdl-color-primary', function( value ) {
		value.bind( function( to ) {
				$('.mdl-color--primary' ).each(function () {
						this.style.setProperty( 'background-color', to ,'important' );
				});

				let header_textcolor = getcontrast(to);
        let primary_dark = shadeColor(to, -40);
        let primary_light = shadeColor(to, +20);

        $('.mdl-color-text--primary').css( {'color': header_textcolor } );
        $('.mdl-color--primary-dark').css( {'background-color': `${primary_dark}` } );
        $('.mdl-color--primary-contrast' ).css( {'background-color': primary_light } );

			});
		});

    // Header text color.
    // https://material-ui.com/style/color/
    wp.customize( 'mdl-color-secondary', function( value ) {
      value.bind( function( to ) {

          $('.mdl-color--secondary').css( {'background-color': `${ to }` } );
          $('.mdl-color-text--secondary' ).css( {'color': getcontrast(to) } );

        });
      });

} )( jQuery );
