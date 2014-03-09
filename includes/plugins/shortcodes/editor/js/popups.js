/**
 * Handles the shortcode popup functions.
 */

( function( $ ) {

	// In form functions
	$( document ).on( 'click', '.add-column', function() {

		// Add new columns
		var selectCol = $( '#column-1' ).clone(),
			colNo = $( '.input' ).length + 1;
		//set up cloned input
		selectCol.attr( 'id', 'column-' + colNo );
		selectCol.find( 'label' ).attr( 'for', 'col-' + colNo ).html( 'Column ' + colNo + ':' );
		selectCol.find( '.input' ).attr( 'id', 'col-' + colNo );
		// insert new element
		if ( colNo < 5  ) {
			selectCol.appendTo( '#row-2' );
		} else if ( colNo < 6  ) {
			selectCol.appendTo( '#row-3' );
		}

	});

	// Submit the form and create the shortcode
	$(document).on( 'submit', 'form.shortcode', function(e) {

		e.preventDefault();
		$this = $(this);

		// Set vars
		var ed = window.parent.tinyMCE,
			edActive = ed.activeEditor,
			code = $this.data( 'code' ),
			wrap = $this.data( 'wrap' ),
			shortcode = '', items = '',
			row = '', col = '', val = '';

		if ( code === 'row' ) {
			// Create rows and cols
			$this.find( '.input' ).each( function( index, elm ) {
				val = $(elm).val();
				if ( val )
					col += '[col width="' + val + '"] [/col]<br>';
			});
			// Create shortcode
			shortcode += '[row]<br>' + col + '[/row]<br>';
		} else {
			// Get attributes
			$this.find( '.input, .radio:checked' ).each( function( index, elm ) {
				val = $(elm).val();
				if ( val )
					items += ' ' + elm.name + '="' + val + '"';
			});
			// Create shortcode
			shortcode = '[' + code + items + ']';
		}

		// Wrap content
		if ( wrap === 'yes' )
			shortcode += ' ' + edActive.selection.getContent() + ' [/'+code+']';

		// Insert shortcode
		if ( ed ) {
			ed.execInstanceCommand( ed.activeEditor.id, 'mceInsertContent', false, shortcode );
			edActive.windowManager.close( window );
		}

	});

} )( jQuery );