<?php

/**
 * IdeaBoard Core Functions
 *
 * @package IdeaBoard
 * @subpackage Functions
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/** Versions ******************************************************************/

/**
 * Output the IdeaBoard version
 *
 * @since IdeaBoard (r3468)
 * @uses ideaboard_get_version() To get the IdeaBoard version
 */
function ideaboard_version() {
	echo ideaboard_get_version();
}
	/**
	 * Return the IdeaBoard version
	 *
	 * @since IdeaBoard (r3468)
	 * @retrun string The IdeaBoard version
	 */
	function ideaboard_get_version() {
		return ideaboard()->version;
	}

/**
 * Output the IdeaBoard database version
 *
 * @since IdeaBoard (r3468)
 * @uses ideaboard_get_version() To get the IdeaBoard version
 */
function ideaboard_db_version() {
	echo ideaboard_get_db_version();
}
	/**
	 * Return the IdeaBoard database version
	 *
	 * @since IdeaBoard (r3468)
	 * @retrun string The IdeaBoard version
	 */
	function ideaboard_get_db_version() {
		return ideaboard()->db_version;
	}

/**
 * Output the IdeaBoard database version directly from the database
 *
 * @since IdeaBoard (r3468)
 * @uses ideaboard_get_version() To get the current IdeaBoard version
 */
function ideaboard_db_version_raw() {
	echo ideaboard_get_db_version_raw();
}
	/**
	 * Return the IdeaBoard database version directly from the database
	 *
	 * @since IdeaBoard (r3468)
	 * @retrun string The current IdeaBoard version
	 */
	function ideaboard_get_db_version_raw() {
		return get_option( '_ideaboard_db_version', '' );
	}

/** Post Meta *****************************************************************/

/**
 * Update a posts forum meta ID
 *
 * @since IdeaBoard (r3181)
 *
 * @param int $post_id The post to update
 * @param int $forum_id The forum
 */
function ideaboard_update_forum_id( $post_id, $forum_id ) {

	// Allow the forum ID to be updated 'just in time' before save
	$forum_id = apply_filters( 'ideaboard_update_forum_id', $forum_id, $post_id );

	// Update the post meta forum ID
	update_post_meta( $post_id, '_ideaboard_forum_id', (int) $forum_id );
}

/**
 * Update a posts topic meta ID
 *
 * @since IdeaBoard (r3181)
 *
 * @param int $post_id The post to update
 * @param int $forum_id The forum
 */
function ideaboard_update_topic_id( $post_id, $topic_id ) {

	// Allow the topic ID to be updated 'just in time' before save
	$topic_id = apply_filters( 'ideaboard_update_topic_id', $topic_id, $post_id );

	// Update the post meta topic ID
	update_post_meta( $post_id, '_ideaboard_topic_id', (int) $topic_id );
}

/**
 * Update a posts reply meta ID
 *
 * @since IdeaBoard (r3181)
 *
 * @param int $post_id The post to update
 * @param int $forum_id The forum
 */
function ideaboard_update_reply_id( $post_id, $reply_id ) {

	// Allow the reply ID to be updated 'just in time' before save
	$reply_id = apply_filters( 'ideaboard_update_reply_id', $reply_id, $post_id );

	// Update the post meta reply ID
	update_post_meta( $post_id, '_ideaboard_reply_id',(int) $reply_id );
}

/** Views *********************************************************************/

/**
 * Get the registered views
 *
 * Does nothing much other than return the {@link $ideaboard->views} variable
 *
 * @since IdeaBoard (r2789)
 *
 * @return array Views
 */
function ideaboard_get_views() {
	return ideaboard()->views;
}

/**
 * Register a IdeaBoard view
 *
 * @todo Implement feeds - See {@link http://trac.ideaboard.org/ticket/1422}
 *
 * @since IdeaBoard (r2789)
 *
 * @param string $view View name
 * @param string $title View title
 * @param mixed $query_args {@link ideaboard_has_topics()} arguments.
 * @param bool $feed Have a feed for the view? Defaults to true. NOT IMPLEMENTED
 * @param string $capability Capability that the current user must have
 * @uses sanitize_title() To sanitize the view name
 * @uses esc_html() To sanitize the view title
 * @return array The just registered (but processed) view
 */
function ideaboard_register_view( $view, $title, $query_args = '', $feed = true, $capability = '' ) {

	// Bail if user does not have capability
	if ( ! empty( $capability ) && ! current_user_can( $capability ) )
		return false;

	$ideaboard   = ideaboard();
	$view  = sanitize_title( $view );
	$title = esc_html( $title );

	if ( empty( $view ) || empty( $title ) )
		return false;

	$query_args = ideaboard_parse_args( $query_args, '', 'register_view' );

	// Set show_stickies to false if it wasn't supplied
	if ( !isset( $query_args['show_stickies'] ) )
		$query_args['show_stickies'] = false;

	$ideaboard->views[$view] = array(
		'title'  => $title,
		'query'  => $query_args,
		'feed'   => $feed
	);

	return $ideaboard->views[$view];
}

/**
 * Deregister a IdeaBoard view
 *
 * @since IdeaBoard (r2789)
 *
 * @param string $view View name
 * @uses sanitize_title() To sanitize the view name
 * @return bool False if the view doesn't exist, true on success
 */
function ideaboard_deregister_view( $view ) {
	$ideaboard  = ideaboard();
	$view = sanitize_title( $view );

	if ( !isset( $ideaboard->views[$view] ) )
		return false;

	unset( $ideaboard->views[$view] );

	return true;
}

/**
 * Run the view's query
 *
 * @since IdeaBoard (r2789)
 *
 * @param string $view Optional. View id
 * @param mixed $new_args New arguments. See {@link ideaboard_has_topics()}
 * @uses ideaboard_get_view_id() To get the view id
 * @uses ideaboard_get_view_query_args() To get the view query args
 * @uses sanitize_title() To sanitize the view name
 * @uses ideaboard_has_topics() To make the topics query
 * @return bool False if the view doesn't exist, otherwise if topics are there
 */
function ideaboard_view_query( $view = '', $new_args = '' ) {

	$view = ideaboard_get_view_id( $view );
	if ( empty( $view ) )
		return false;

	$query_args = ideaboard_get_view_query_args( $view );

	if ( !empty( $new_args ) ) {
		$new_args   = ideaboard_parse_args( $new_args, '', 'view_query' );
		$query_args = array_merge( $query_args, $new_args );
	}

	return ideaboard_has_topics( $query_args );
}

/**
 * Return the view's query arguments
 *
 * @since IdeaBoard (r2789)
 *
 * @param string $view View name
 * @uses ideaboard_get_view_id() To get the view id
 * @return array Query arguments
 */
function ideaboard_get_view_query_args( $view ) {
	$view   = ideaboard_get_view_id( $view );
	$retval = !empty( $view ) ? ideaboard()->views[$view]['query'] : false;

	return apply_filters( 'ideaboard_get_view_query_args', $retval, $view );
}

/** Errors ********************************************************************/

/**
 * Adds an error message to later be output in the theme
 *
 * @since IdeaBoard (r3381)
 *
 * @see WP_Error()
 * @uses WP_Error::add();
 *
 * @param string $code Unique code for the error message
 * @param string $message Translated error message
 * @param string $data Any additional data passed with the error message
 */
function ideaboard_add_error( $code = '', $message = '', $data = '' ) {
	ideaboard()->errors->add( $code, $message, $data );
}

/**
 * Check if error messages exist in queue
 *
 * @since IdeaBoard (r3381)
 *
 * @see WP_Error()
 *
 * @uses is_wp_error()
 * @usese WP_Error::get_error_codes()
 */
function ideaboard_has_errors() {
	$has_errors = ideaboard()->errors->get_error_codes() ? true : false;

	return apply_filters( 'ideaboard_has_errors', $has_errors, ideaboard()->errors );
}

/** Mentions ******************************************************************/

/**
 * Set the pattern used for matching usernames for mentions.
 *
 * Moved into its own function to allow filtering of the regex pattern
 * anywhere mentions might be used.
 *
 * @since IdeaBoard (r4997)
 * @deprecated 2.6.0 ideaboard_make_clickable()
 *
 * @return string Pattern to match usernames with
 */
function ideaboard_find_mentions_pattern() {
	return apply_filters( 'ideaboard_find_mentions_pattern', '/[@]+([A-Za-z0-9-_\.@]+)\b/' );
}

/**
 * Searches through the content to locate usernames, designated by an @ sign.
 *
 * @since IdeaBoard (r4323)
 * @deprecated 2.6.0 ideaboard_make_clickable()
 *
 * @param string $content The content
 * @return bool|array $usernames Existing usernames. False if no matches.
 */
function ideaboard_find_mentions( $content = '' ) {
	$pattern   = ideaboard_find_mentions_pattern();
	preg_match_all( $pattern, $content, $usernames );
	$usernames = array_unique( array_filter( $usernames[1] ) );

	// Bail if no usernames
	if ( empty( $usernames ) ) {
		$usernames = false;
	}

	return apply_filters( 'ideaboard_find_mentions', $usernames, $pattern, $content );
}

/**
 * Finds and links @-mentioned users in the content
 *
 * @since IdeaBoard (r4323)
 * @deprecated 2.6.0 ideaboard_make_clickable()
 *
 * @uses ideaboard_find_mentions() To get usernames in content areas
 * @return string $content Content filtered for mentions
 */
function ideaboard_mention_filter( $content = '' ) {

	// Get Usernames and bail if none exist
	$usernames = ideaboard_find_mentions( $content );
	if ( empty( $usernames ) )
		return $content;

	// Loop through usernames and link to profiles
	foreach ( (array) $usernames as $username ) {

		// Skip if username does not exist or user is not active
		$user = get_user_by( 'slug', $username );
		if ( empty( $user->ID ) || ideaboard_is_user_inactive( $user->ID ) )
			continue;

		// Replace name in content
		$content = preg_replace( '/(@' . $username . '\b)/', sprintf( '<a href="%1$s" rel="nofollow">@%2$s</a>', ideaboard_get_user_profile_url( $user->ID ), $username ), $content );
	}

	// Return modified content
	return $content;
}

/** Post Statuses *************************************************************/

/**
 * Return the public post status ID
 *
 * @since IdeaBoard (r3504)
 *
 * @return string
 */
function ideaboard_get_public_status_id() {
	return ideaboard()->public_status_id;
}

/**
 * Return the pending post status ID
 *
 * @since IdeaBoard (r3581)
 *
 * @return string
 */
function ideaboard_get_pending_status_id() {
	return ideaboard()->pending_status_id;
}

/**
 * Return the private post status ID
 *
 * @since IdeaBoard (r3504)
 *
 * @return string
 */
function ideaboard_get_private_status_id() {
	return ideaboard()->private_status_id;
}

/**
 * Return the hidden post status ID
 *
 * @since IdeaBoard (r3504)
 *
 * @return string
 */
function ideaboard_get_hidden_status_id() {
	return ideaboard()->hidden_status_id;
}

/**
 * Return the closed post status ID
 *
 * @since IdeaBoard (r3504)
 *
 * @return string
 */
function ideaboard_get_closed_status_id() {
	return ideaboard()->closed_status_id;
}

/**
 * Return the spam post status ID
 *
 * @since IdeaBoard (r3504)
 *
 * @return string
 */
function ideaboard_get_spam_status_id() {
	return ideaboard()->spam_status_id;
}

/**
 * Return the trash post status ID
 *
 * @since IdeaBoard (r3504)
 *
 * @return string
 */
function ideaboard_get_trash_status_id() {
	return ideaboard()->trash_status_id;
}

/**
 * Return the orphan post status ID
 *
 * @since IdeaBoard (r3504)
 *
 * @return string
 */
function ideaboard_get_orphan_status_id() {
	return ideaboard()->orphan_status_id;
}

/** Rewrite IDs ***************************************************************/

/**
 * Return the unique ID for user profile rewrite rules
 *
 * @since IdeaBoard (r3762)
 * @return string
 */
function ideaboard_get_user_rewrite_id() {
	return ideaboard()->user_id;
}

/**
 * Return the unique ID for all edit rewrite rules (forum|topic|reply|tag|user)
 *
 * @since IdeaBoard (r3762)
 * @return string
 */
function ideaboard_get_edit_rewrite_id() {
	return ideaboard()->edit_id;
}

/**
 * Return the unique ID for all search rewrite rules
 *
 * @since IdeaBoard (r4579)
 *
 * @return string
 */
function ideaboard_get_search_rewrite_id() {
	return ideaboard()->search_id;
}

/**
 * Return the unique ID for user topics rewrite rules
 *
 * @since IdeaBoard (r4321)
 * @return string
 */
function ideaboard_get_user_topics_rewrite_id() {
	return ideaboard()->tops_id;
}

/**
 * Return the unique ID for user replies rewrite rules
 *
 * @since IdeaBoard (r4321)
 * @return string
 */
function ideaboard_get_user_replies_rewrite_id() {
	return ideaboard()->reps_id;
}

/**
 * Return the unique ID for user caps rewrite rules
 *
 * @since IdeaBoard (r4181)
 * @return string
 */
function ideaboard_get_user_favorites_rewrite_id() {
	return ideaboard()->favs_id;
}

/**
 * Return the unique ID for user caps rewrite rules
 *
 * @since IdeaBoard (r4181)
 * @return string
 */
function ideaboard_get_user_subscriptions_rewrite_id() {
	return ideaboard()->subs_id;
}

/**
 * Return the unique ID for topic view rewrite rules
 *
 * @since IdeaBoard (r3762)
 * @return string
 */
function ideaboard_get_view_rewrite_id() {
	return ideaboard()->view_id;
}

/** Rewrite Extras ************************************************************/

/**
 * Get the id used for paginated requests
 *
 * @since IdeaBoard (r4926)
 * @return string
 */
function ideaboard_get_paged_rewrite_id() {
	return ideaboard()->paged_id;
}

/**
 * Get the slug used for paginated requests
 *
 * @since IdeaBoard (r4926)
 * @global object $wp_rewrite The WP_Rewrite object
 * @return string
 */
function ideaboard_get_paged_slug() {
	global $wp_rewrite;
	return $wp_rewrite->pagination_base;
}

/**
 * Delete a blogs rewrite rules, so that they are automatically rebuilt on
 * the subsequent page load.
 *
 * @since IdeaBoard (r4198)
 */
function ideaboard_delete_rewrite_rules() {
	delete_option( 'rewrite_rules' );
}

/** Requests ******************************************************************/

/**
 * Return true|false if this is a POST request
 *
 * @since IdeaBoard (r4790)
 * @return bool
 */
function ideaboard_is_post_request() {
	return (bool) ( 'POST' === strtoupper( $_SERVER['REQUEST_METHOD'] ) );
}

/**
 * Return true|false if this is a GET request
 *
 * @since IdeaBoard (r4790)
 * @return bool
 */
function ideaboard_is_get_request() {
	return (bool) ( 'GET' === strtoupper( $_SERVER['REQUEST_METHOD'] ) );
}

