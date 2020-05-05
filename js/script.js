// Global object for shared functions and data.
window.cleancoded = window.cleancoded || {};

( function( $, document, cleancoded ) {
	'use strict';

	// Selectors for all plugin inputs.
	cleancoded.inputSelectors = 'input[class*="cleancoded"], textarea[class*="cleancoded"], select[class*="cleancoded"], button[class*="cleancoded"]';

	// Generate unique ID.
	cleancoded.uniqid = function uniqid() {
		return Math.random().toString( 36 ).substr( 2 );
	}

	// Trigger a custom ready event for all scripts to hook to.
	// Used for static DOM and dynamic DOM (loaded in MB Blocks extension for Gutenberg).
	cleancoded.$document = $( document );
	$( function() {
		cleancoded.$document.trigger( 'mb_ready' );
	} );
} )( jQuery, document, cleancoded );