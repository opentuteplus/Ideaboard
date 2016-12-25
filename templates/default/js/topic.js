jQuery( document ).ready( function ( $ ) {

	function ideaboard_ajax_call( action, topic_id, nonce, update_selector ) {
		var $data = {
			action : action,
			id     : topic_id,
			nonce  : nonce
		};

		$.post( ideaboardTopicJS.ideaboard_ajaxurl, $data, function ( response ) {
			if ( response.success ) {
				$( update_selector ).html( response.content );
			} else {
				if ( !response.content ) {
					response.content = ideaboardTopicJS.generic_ajax_error;
				}
				alert( response.content );
			}
		} );
	}

	$( '#favorite-toggle' ).on( 'click', 'span a.favorite-toggle', function( e ) {
		e.preventDefault();
		ideaboard_ajax_call( 'favorite', $( this ).attr( 'data-topic' ), ideaboardTopicJS.fav_nonce, '#favorite-toggle' );
	} );

	$( '#subscription-toggle' ).on( 'click', 'span a.subscription-toggle', function( e ) {
		e.preventDefault();
		ideaboard_ajax_call( 'subscription', $( this ).attr( 'data-topic' ), ideaboardTopicJS.subs_nonce, '#subscription-toggle' );
	} );
} );
