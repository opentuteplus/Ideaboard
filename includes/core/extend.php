<?php

/**
 * IdeaBoard Extentions
 *
 * There's a world of really cool plugins out there, and IdeaBoard comes with
 * support for some of the most popular ones.
 *
 * @package IdeaBoard
 * @subpackage Extend
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Loads Akismet inside the IdeaBoard global class
 *
 * @since IdeaBoard (r3277)
 *
 * @return If IdeaBoard is not active
 */
function ideaboard_setup_akismet() {

	// Bail if no akismet
	if ( !defined( 'AKISMET_VERSION' ) ) return;

	// Bail if Akismet is turned off
	if ( !ideaboard_is_akismet_active() ) return;

	// Include the Akismet Component
	require( ideaboard()->includes_dir . 'extend/akismet.php' );

	// Instantiate Akismet for IdeaBoard
	ideaboard()->extend->akismet = new IdeaBoard_Akismet();
}

/**
 * Requires and creates the BuddyPress extension, and adds component creation
 * action to bp_init hook. @see ideaboard_setup_buddypress_component()
 *
 * @since IdeaBoard (r3395)
 * @return If BuddyPress is not active
 */
function ideaboard_setup_buddypress() {

	if ( ! function_exists( 'buddypress' ) ) {

		/**
		 * Helper for BuddyPress 1.6 and earlier
		 *
		 * @since IdeaBoard (r4395)
		 * @return BuddyPress
		 */
		function buddypress() {
			return isset( $GLOBALS['bp'] ) ? $GLOBALS['bp'] : false;
		}
	}

	// Bail if in maintenance mode
	if ( ! buddypress() || buddypress()->maintenance_mode )
		return;

	// Include the BuddyPress Component
	require( ideaboard()->includes_dir . 'extend/buddypress/loader.php' );

	// Instantiate BuddyPress for IdeaBoard
	ideaboard()->extend->buddypress = new IdeaBoard_Forums_Component();
}
