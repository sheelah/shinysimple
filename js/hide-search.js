/*
 * Toggles header search on and off.
 */

jQuery(document).ready(function($) {
	var searchToggle = $(".search-toggle");
	searchToggle.on('click', function() {
		$("#search-container").slideToggle('slow', function() {
			searchToggle.toggleClass('active');
		});
	});
});

