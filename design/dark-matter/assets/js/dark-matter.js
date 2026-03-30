/**
 * Dark Matter Theme Scripts
 *
 * @package dark-matter
 */

( function() {
	'use strict';

	/* Mobile menu toggle */
	var toggle = document.getElementById( 'dm-mobile-toggle' );
	var mobileMenu = document.getElementById( 'dm-mobile-menu' );

	if ( toggle && mobileMenu ) {
		toggle.addEventListener( 'click', function() {
			var isHidden = mobileMenu.classList.contains( 'hidden' );
			if ( isHidden ) {
				mobileMenu.classList.remove( 'hidden' );
			} else {
				mobileMenu.classList.add( 'hidden' );
			}
		} );
	}

	/* Scroll-triggered fade-in animations */
	function initScrollAnimations() {
		var elements = document.querySelectorAll( '.fade-in-up' );

		if ( ! elements.length ) {
			return;
		}

		if ( 'IntersectionObserver' in window ) {
			var observer = new IntersectionObserver( function( entries ) {
				entries.forEach( function( entry ) {
					if ( entry.isIntersecting ) {
						entry.target.style.animationPlayState = 'running';
						observer.unobserve( entry.target );
					}
				} );
			}, {
				threshold: 0.1,
				rootMargin: '0px 0px -40px 0px',
			} );

			elements.forEach( function( el ) {
				el.style.animationPlayState = 'paused';
				observer.observe( el );
			} );
		}
	}

	/* Smooth scroll for anchor links */
	function initSmoothScroll() {
		var links = document.querySelectorAll( 'a[href^="#"]' );

		links.forEach( function( link ) {
			link.addEventListener( 'click', function( e ) {
				var targetId = this.getAttribute( 'href' );

				if ( targetId === '#' ) {
					return;
				}

				var target = document.querySelector( targetId );

				if ( target ) {
					e.preventDefault();
					var headerHeight = 64;
					var targetPosition = target.getBoundingClientRect().top + window.pageYOffset - headerHeight;

					window.scrollTo( {
						top: targetPosition,
						behavior: 'smooth',
					} );

					/* Close mobile menu if open */
					if ( mobileMenu && ! mobileMenu.classList.contains( 'hidden' ) ) {
						mobileMenu.classList.add( 'hidden' );
					}
				}
			} );
		} );
	}

	/* Header background opacity on scroll */
	function initHeaderScroll() {
		var header = document.querySelector( '.site-header' );

		if ( ! header ) {
			return;
		}

		window.addEventListener( 'scroll', function() {
			if ( window.scrollY > 100 ) {
				header.style.background = 'rgba(10, 10, 10, 0.95)';
			} else {
				header.style.background = 'rgba(10, 10, 10, 0.85)';
			}
		}, { passive: true } );
	}

	/* Initialize */
	document.addEventListener( 'DOMContentLoaded', function() {
		initScrollAnimations();
		initSmoothScroll();
		initHeaderScroll();
	} );
} )();