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
		const mobileMenuLabel = document.getElementById( 'mobile-menu-label' );

		if ( ! mobileMenuButton || ! mobileMenu ) {
			return;
		}

		const openLabel = mobileMenuButton.getAttribute( 'data-open-label' ) || 'Open menu';
		const closeLabel = mobileMenuButton.getAttribute( 'data-close-label' ) || 'Close menu';

		const setMenuState = function( isOpen ) {
			mobileMenu.classList.toggle( 'is-hidden', ! isOpen );
			mobileMenuButton.classList.toggle( 'is-open', isOpen );
			mobileMenuButton.setAttribute( 'aria-expanded', isOpen ? 'true' : 'false' );
			mobileMenuButton.setAttribute( 'aria-label', isOpen ? closeLabel : openLabel );

			if ( mobileMenuLabel ) {
				mobileMenuLabel.textContent = isOpen ? closeLabel : openLabel;
			}

			document.body.classList.toggle( 'mobile-menu-open', isOpen );
		};

		mobileMenuButton.addEventListener( 'click', function() {
			const isOpen = ! mobileMenu.classList.contains( 'is-hidden' );
			setMenuState( ! isOpen );
		} );

		// Close menu when a link is clicked
		const menuLinks = mobileMenu.querySelectorAll( 'a' );
		menuLinks.forEach( function( link ) {
			link.addEventListener( 'click', function() {
				setMenuState( false );
			} );
		} );

		document.addEventListener( 'keydown', function( event ) {
			if ( 'Escape' !== event.key ) {
				return;
			}

			if ( mobileMenu.classList.contains( 'is-hidden' ) ) {
				return;
			}

			setMenuState( false );
			mobileMenuButton.focus();
		} );

		document.addEventListener( 'click', function( event ) {
			if ( mobileMenu.classList.contains( 'is-hidden' ) ) {
				return;
			}

			if ( mobileMenuButton.contains( event.target ) || mobileMenu.contains( event.target ) ) {
				return;
			}

			setMenuState( false );
		} );

		window.addEventListener( 'resize', function() {
			if ( window.innerWidth >= 768 ) {
				setMenuState( false );
			}
		} );

		setMenuState( false );
	} );
} )();
