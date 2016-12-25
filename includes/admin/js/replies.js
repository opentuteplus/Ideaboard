jQuery( document ).ready(function() {

	var ideaboard_topic_id = jQuery( '#ideaboard_topic_id' );

	ideaboard_topic_id.suggest(
		ideaboard_topic_id.data( 'ajax-url' ),
		{
			onSelect: function() {
				var value = this.value;
				ideaboard_topic_id.val( value.substr( 0, value.indexOf( ' ' ) ) );
			}
		}
	);
} );