/*
 * Masonry settings to set layout of footer widgets.
 */

jQuery(document).ready(function($) {
	var $container = $('#footer-widgets').masonry();
	enquire.register("screen and (min-width:880px)", {
		// Triggered when a media query matches.
		match: function() {
			$container.masonry({
				columnWidth: 400,  // Width of every masonry column
				itemSelector: '.widget',  // Class of every widget
				isFitWidth: true,
				isAnimated: true
			});
		},
		// Triggered when the media query transitions
		// *from a matched state to an unmatched state*.
		unmatch: function() {
			// Disable Masonry at narrower widths
			$container.masonry('destroy');
		}
	});
});

