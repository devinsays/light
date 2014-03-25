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

/**
 * Slow down background image scroll speed
 */
jQuery( document ).ready( function( $ ) {
	var body = document.body,
        doc = document.documentElement;
    $(window).scroll(function () {
        body.style.backgroundPosition = "0px " + ( 830 -(Math.max(doc.scrollTop, body.scrollTop) / 4) ) + "px";
    });
});