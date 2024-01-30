( function ( $ ) {
	$( document ).ready( function () {

		//Require post title when adding/editing Project Summaries
		$( 'body' ).on( 'submit.edit-post', '#post', function () {

			// If the title isn't set
			if ( $( "#title" ).val().replace( / /g, '' ).length === 0 ) {

				// Show the alert
				window.alert( 'A title is required.' );

				// Hide the spinner
				$( '#major-publishing-actions .spinner' ).hide();

				// The buttons get "disabled" added to them on submit. Remove that class.
				$( '#major-publishing-actions' ).find( ':button, :submit, a.submitdelete, #post-preview' ).removeClass( 'disabled' );

				// Focus on the title field.
				$( "#title" ).focus();

				return false;
			}

			// If the title isn't set
			if ( $( "#dates" ).val().replace( / /g, '' ).length === 0 ) {

				// Show the alert
				window.alert( 'The dates are required.' );

				// Hide the spinner
				$( '#major-publishing-actions .spinner' ).hide();

				// The buttons get "disabled" added to them on submit. Remove that class.
				$( '#major-publishing-actions' ).find( ':button, :submit, a.submitdelete, #post-preview' ).removeClass( 'disabled' );

				// Focus on the title field.
				$( "#dates" ).focus();

				return false;
			}

						// If the title isn't set
			if ( $( "#year" ).val().replace( / /g, '' ).length === 0 ) {

				// Show the alert
				window.alert( 'The year is required.' );

				// Hide the spinner
				$( '#major-publishing-actions .spinner' ).hide();

				// The buttons get "disabled" added to them on submit. Remove that class.
				$( '#major-publishing-actions' ).find( ':button, :submit, a.submitdelete, #post-preview' ).removeClass( 'disabled' );

				// Focus on the title field.
				$( "#year" ).focus();

				return false;
			}

		});
	});
}( jQuery ) );