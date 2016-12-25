<?php

/**
 * IdeaBoard User Options
 *
 * @package IdeaBoard
 * @subpackage UserOptions
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Get the default user options and their values
 *
 * @since IdeaBoard (r3910)
 * @return array Filtered user option names and values
 */
function ideaboard_get_default_user_options() {

	// Default options
	return apply_filters( 'ideaboard_get_default_user_options', array(
		'_ideaboard_last_posted'   => '0', // For checking flooding
		'_ideaboard_topic_count'   => '0', // Total topics per site
		'_ideaboard_reply_count'   => '0', // Total replies per site
		'_ideaboard_favorites'     => '',  // Favorite topics per site
		'_ideaboard_subscriptions' => ''   // Subscribed topics per site
	) );
}

/**
 * Add default user options
 *
 * This is destructive, so existing IdeaBoard user options will be overridden.
 *
 * @since IdeaBoard (r3910)
 * @uses ideaboard_get_default_user_options() To get default options
 * @uses update_user_option() Adds default options
 * @uses do_action() Calls 'ideaboard_add_user_options'
 */
function ideaboard_add_user_options( $user_id = 0 ) {

	// Validate user id
	$user_id = ideaboard_get_user_id( $user_id );
	if ( empty( $user_id ) )
		return;

	// Add default options
	foreach ( ideaboard_get_default_user_options() as $key => $value )
		update_user_option( $user_id, $key, $value );

	// Allow previously activated plugins to append their own user options.
	do_action( 'ideaboard_add_user_options', $user_id );
}

/**
 * Delete default user options
 *
 * Hooked to ideaboard_uninstall, it is only called once when IdeaBoard is uninstalled.
 * This is destructive, so existing IdeaBoard user options will be destroyed.
 *
 * @since IdeaBoard (r3910)
 * @uses ideaboard_get_default_user_options() To get default options
 * @uses delete_user_option() Removes default options
 * @uses do_action() Calls 'ideaboard_delete_options'
 */
function ideaboard_delete_user_options( $user_id = 0 ) {

	// Validate user id
	$user_id = ideaboard_get_user_id( $user_id );
	if ( empty( $user_id ) )
		return;

	// Add default options
	foreach ( array_keys( ideaboard_get_default_user_options() ) as $key )
		delete_user_option( $user_id, $key );

	// Allow previously activated plugins to append their own options.
	do_action( 'ideaboard_delete_user_options', $user_id );
}

/**
 * Add filters to each IdeaBoard option and allow them to be overloaded from
 * inside the $bbp->options array.
 *
 * @since IdeaBoard (r3910)
 * @uses ideaboard_get_default_user_options() To get default options
 * @uses add_filter() To add filters to 'pre_option_{$key}'
 * @uses do_action() Calls 'ideaboard_add_option_filters'
 */
function ideaboard_setup_user_option_filters() {

	// Add filters to each IdeaBoard option
	foreach ( array_keys( ideaboard_get_default_user_options() ) as $key )
		add_filter( 'get_user_option_' . $key, 'ideaboard_filter_get_user_option', 10, 3 );

	// Allow previously activated plugins to append their own options.
	do_action( 'ideaboard_setup_user_option_filters' );
}

/**
 * Filter default options and allow them to be overloaded from inside the
 * $bbp->user_options array.
 *
 * @since IdeaBoard (r3910)
 * @param bool $value Optional. Default value false
 * @return mixed false if not overloaded, mixed if set
 */
function ideaboard_filter_get_user_option( $value = false, $option = '', $user = 0 ) {
	$bbp = ideaboard();

	// Check the options global for preset value
	if ( isset( $user->ID ) && isset( $bbp->user_options[$user->ID] ) && !empty( $bbp->user_options[$user->ID][$option] ) )
		$value = $bbp->user_options[$user->ID][$option];

	// Always return a value, even if false
	return $value;
}

/** Post Counts ***************************************************************/

/**
 * Output a users topic count
 *
 * @since IdeaBoard (r3632)
 *
 * @param int $user_id
 * @param boolean $integer Optional. Whether or not to format the result
 * @uses ideaboard_get_user_topic_count()
 * @return string
 */
function ideaboard_user_topic_count( $user_id = 0, $integer = false ) {
	echo ideaboard_get_user_topic_count( $user_id, $integer );
}
	/**
	 * Return a users reply count
	 *
	 * @since IdeaBoard (r3632)
	 *
	 * @param int $user_id
	 * @param boolean $integer Optional. Whether or not to format the result
	 * @uses ideaboard_get_user_id()
	 * @uses get_user_option()
	 * @uses apply_filters()
	 * @return string
	 */
	function ideaboard_get_user_topic_count( $user_id = 0, $integer = false ) {

		// Validate user id
		$user_id = ideaboard_get_user_id( $user_id );
		if ( empty( $user_id ) )
			return false;

		$count  = (int) get_user_option( '_ideaboard_topic_count', $user_id );
		$filter = ( false === $integer ) ? 'ideaboard_get_user_topic_count_int' : 'ideaboard_get_user_topic_count';

		return apply_filters( $filter, $count, $user_id );
	}

/**
 * Output a users reply count
 *
 * @since IdeaBoard (r3632)
 *
 * @param int $user_id
 * @param boolean $integer Optional. Whether or not to format the result
 * @uses ideaboard_get_user_reply_count()
 * @return string
 */
function ideaboard_user_reply_count( $user_id = 0, $integer = false ) {
	echo ideaboard_get_user_reply_count( $user_id, $integer );
}
	/**
	 * Return a users reply count
	 *
	 * @since IdeaBoard (r3632)
	 *
	 * @param int $user_id
	 * @param boolean $integer Optional. Whether or not to format the result
	 * @uses ideaboard_get_user_id()
	 * @uses get_user_option()
	 * @uses apply_filters()
	 * @return string
	 */
	function ideaboard_get_user_reply_count( $user_id = 0, $integer = false ) {

		// Validate user id
		$user_id = ideaboard_get_user_id( $user_id );
		if ( empty( $user_id ) )
			return false;

		$count  = (int) get_user_option( '_ideaboard_reply_count', $user_id );
		$filter = ( true === $integer ) ? 'ideaboard_get_user_topic_count_int' : 'ideaboard_get_user_topic_count';

		return apply_filters( $filter, $count, $user_id );
	}

/**
 * Output a users total post count
 *
 * @since IdeaBoard (r3632)
 *
 * @param int $user_id
 * @param boolean $integer Optional. Whether or not to format the result
 * @uses ideaboard_get_user_post_count()
 * @return string
 */
function ideaboard_user_post_count( $user_id = 0, $integer = false ) {
	echo ideaboard_get_user_post_count( $user_id, $integer );
}
	/**
	 * Return a users total post count
	 *
	 * @since IdeaBoard (r3632)
	 *
	 * @param int $user_id
	 * @param boolean $integer Optional. Whether or not to format the result
	 * @uses ideaboard_get_user_id()
	 * @uses get_user_option()
	 * @uses apply_filters()
	 * @return string
	 */
	function ideaboard_get_user_post_count( $user_id = 0, $integer = false ) {

		// Validate user id
		$user_id = ideaboard_get_user_id( $user_id );
		if ( empty( $user_id ) )
			return false;

		$topics  = ideaboard_get_user_topic_count( $user_id, true );
		$replies = ideaboard_get_user_reply_count( $user_id, true );
		$count   = (int) $topics + $replies;
		$filter  = ( true === $integer ) ? 'ideaboard_get_user_post_count_int' : 'ideaboard_get_user_post_count';

		return apply_filters( $filter, $count, $user_id );
	}

/** Last Posted ***************************************************************/

/**
 * Update a users last posted time, for use with post throttling
 *
 * @since IdeaBoard (r3910)
 * @param int $user_id User ID to update
 * @param int $time Time in time() format
 * @return bool False if no user or failure, true if successful
 */
function ideaboard_update_user_last_posted( $user_id = 0, $time = 0 ) {

	// Validate user id
	$user_id = ideaboard_get_user_id( $user_id );
	if ( empty( $user_id ) )
		return false;

	// Set time to now if nothing is passed
	if ( empty( $time ) )
		$time = time();

	return update_user_option( $user_id, '_ideaboard_last_posted', $time );
}

/**
 * Output the raw value of the last posted time.
 *
 * @since IdeaBoard (r3910)
 * @param int $user_id User ID to retrieve value for
 * @uses ideaboard_get_user_last_posted() To output the last posted time
 */
function ideaboard_user_last_posted( $user_id = 0 ) {
	echo ideaboard_get_user_last_posted( $user_id );
}

	/**
	 * Return the raw value of teh last posted time.
	 *
	 * @since IdeaBoard (r3910)
	 * @param int $user_id User ID to retrieve value for
	 * @return mixed False if no user, time() format if exists
	 */
	function ideaboard_get_user_last_posted( $user_id = 0 ) {

		// Validate user id
		$user_id = ideaboard_get_user_id( $user_id );
		if ( empty( $user_id ) )
			return false;

		$time = get_user_option( '_ideaboard_last_posted', $user_id );

		return apply_filters( 'ideaboard_get_user_last_posted', $time, $user_id );
	}
