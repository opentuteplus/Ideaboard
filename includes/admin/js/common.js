jQuery( document ).ready( function() {

	var ideaboard_author_id = jQuery( '#ideaboard_author_id' );

	ideaboard_author_id.suggest(
		ideaboard_author_id.data( 'ajax-url' ),
		{
			onSelect: function() {
				var value = this.value;
				ideaboard_author_id.val( value.substr( 0, value.indexOf( ' ' ) ) );
			}
		}
	);
} );