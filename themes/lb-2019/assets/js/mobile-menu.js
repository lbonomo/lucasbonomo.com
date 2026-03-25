/**
 * File mobile-menu.js.
 *
 * Handles mobile menu toggle for the header.
 *
 * @package lb19
 */

( function() {
	document.addEventListener( 'DOMContentLoaded', function() {
		const mobileMenuButton = document.getElementById( 'mobile-menu-button' );
		const mobileMenu = document.getElementById( 'mobile-menu' );

		if ( ! mobileMenuButton || ! mobileMenu ) {
			return;
		}

		mobileMenuButton.addEventListener( 'click', function() {
			const isHidden = mobileMenu.classList.contains( 'hidden' );
			
			if ( isHidden ) {
				// Show menu
				mobileMenu.classList.remove( 'hidden' );
				mobileMenuButton.setAttribute( 'aria-expanded', 'true' );
				// Toggle icons
				mobileMenuButton.querySelector( '.hamburger-icon' ).classList.add( 'hidden' );
				mobileMenuButton.querySelector( '.close-icon' ).classList.remove( 'hidden' );
			} else {
				// Hide menu
				mobileMenu.classList.add( 'hidden' );
				mobileMenuButton.setAttribute( 'aria-expanded', 'false' );
				// Toggle icons
				mobileMenuButton.querySelector( '.hamburger-icon' ).classList.remove( 'hidden' );
				mobileMenuButton.querySelector( '.close-icon' ).classList.add( 'hidden' );
			}
		} );

		// Close menu when a link is clicked
		const menuLinks = mobileMenu.querySelectorAll( 'a' );
		menuLinks.forEach( function( link ) {
			link.addEventListener( 'click', function() {
				mobileMenu.classList.add( 'hidden' );
				mobileMenuButton.setAttribute( 'aria-expanded', 'false' );
				// Toggle icons
				mobileMenuButton.querySelector( '.hamburger-icon' ).classList.remove( 'hidden' );
				mobileMenuButton.querySelector( '.close-icon' ).classList.add( 'hidden' );
			} );
		} );
	} );
} )();
