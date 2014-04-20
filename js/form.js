jQuery( function( $ ) {

	$( '.mw_wp_form input[data-conv-half-alphanumeric="true"]' ).change( function() {
		var txt  = $( this ).val();
		var half = txt.replace( /[Ａ-Ｚａ-ｚ０-９]/g, function( s ) {
			return String.fromCharCode( s.charCodeAt( 0 ) - 0xFEE0 )
		} );
		$( this ).val( half );
	} );

	var file_delete = $( '.mw_wp_form .mwform-file-delete' );
	file_delete.each( function( i, e ) {
		var target = $( e ).data( 'mwform-file-delete' );
		var hidden_field = $( 'input[type="hidden"][name="' + target + '"]' );
		if ( hidden_field.val() ) {
			$( e ).css( 'visibility', 'visible' );
		}
		$( e ).click( function() {
			var file_field = $( 'input[type="file"][name="' + target + '"]' );
			var new_field = $( file_field[0].outerHTML );
			$( this ).css( 'visibility', 'hidden' );
			file_field.replaceWith( new_field );

			var img = $( 'img[src="' + hidden_field.val() + '"]' );
			hidden_field.remove();
			img.remove();
		} );
	} );
	$( document ).on( 'change', '.mw_wp_form input[type="file"]', function() {
		var name = $( this ).attr( 'name' );
		file_delete.closest( '[data-mwform-file-delete="' + name + '"]' ).css( 'visibility', 'visible' );
	} );

} );

