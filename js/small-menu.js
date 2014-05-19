/**
 * Handles toggling the main navigation menu for small screens.
 */
jQuery( document ).ready( function( $ ) {

	$.fn.slideFadeToggle  = function(speed, easing, callback) {
		return this.animate({opacity: 'toggle', height: 'toggle'}, speed, easing, callback);
	};

	$('.menu-toggle').on( 'click', function() {
		$('.menu-primary-container').slideToggle('fast', function() {
			if ( $(this).is(":hidden") ) {
				$(this).attr('style','');
			}
		});
	});
});