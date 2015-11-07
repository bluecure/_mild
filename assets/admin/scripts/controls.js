/**
 * Theme Controls js.
 *
 * Contains Theme Customizer control functions.
 */

(function( $ ) {

	if ( typeof $.wp !== 'undefined' && typeof $.wp.wpColorPicker !== 'undefined' ) {
		// Set default colors
		$.wp.wpColorPicker.prototype.options = {
			palettes : [ '#1882f4', '#00b429', '#d65015', '#ebdc2f', '#d31f16', '#DDDDDD', '#434343', '#222222', '#FFFFFF' ]
		}
	}

})( jQuery );