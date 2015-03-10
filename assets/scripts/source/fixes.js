/* =JS fixes
 ----------------------------------------------- */
(function () {
	// Avoid console errors in browsers that lack a console.
	var method;
	var noop = function () {};
	var methods = [
		'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
		'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
		'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
		'timeline', 'timelineEnd', 'timeStamp', 'trace', 'warn'
	];
	var length = methods.length;
	var console = (window.console = window.console || {});

	while ( length-- ) {
		method = methods[length];

		// Only stub undefined methods.
		if ( ! console[method] ) {
			console[method] = noop;
		}
	}

	// Skip link focus fix.
	var is_webkit = navigator.userAgent.toLowerCase().indexOf( 'webkit' ) > - 1,
		is_opera = navigator.userAgent.toLowerCase().indexOf( 'opera' ) > - 1,
		is_ie = navigator.userAgent.toLowerCase().indexOf( 'msie' ) > - 1;

	if ( ( is_webkit || is_opera || is_ie ) && document.getElementById && window.addEventListener ) {
		window.addEventListener( 'hashchange', function () {
			var id = location.hash.substring( 1 ),
				element;

			if ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) {
				return;
			}

			element = document.getElementById( id );

			if ( element ) {
				if ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
					element.tabIndex = - 1;
				}

				element.focus();
			}
		}, false );
	}
})();