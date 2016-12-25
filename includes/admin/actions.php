<?php

/**
 * IdeaBoard Admin Actions
 *
 * @package IdeaBoard
 * @subpackage Admin
 *
 * This file contains the actions that are used through-out IdeaBoard Admin. They
 * are consolidated here to make searching for them easier, and to help developers
 * understand at a glance the order in which things occur.
 *
 * There are a few common places that additional actions can currently be found
 *
 *  - IdeaBoard: In {@link IdeaBoard::setup_actions()} in ideaboard.php
 *  - Admin: More in {@link IdeaBoard_Admin::setup_actions()} in admin.php
 *
 * @see ideaboard-core-actions.php
 * @see ideaboard-core-filters.php
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Attach IdeaBoard to WordPress
 *
 * IdeaBoard uses its own internal actions to help aid in third-party plugin
 * development, and to limit the amount of potential future code changes when
 * updates to WordPress core occur.
 *
 * These actions exist to create the concept of 'plugin dependencies'. They
 * provide a safe way for plugins to execute code *only* when IdeaBoard is
 * installed and activated, without needing to do complicated guesswork.
 *
 * For more information on how this works, see the 'Plugin Dependency' section
 * near the bottom of this file.
 *
 *           v--WordPress Actions       v--IdeaBoard Sub-actions
 */
add_action( 'admin_menu',              'ideaboard_admin_menu'                    );
add_action( 'admin_init',              'ideaboard_admin_init'                    );
add_action( 'admin_head',              'ideaboard_admin_head'                    );
add_action( 'admin_notices',           'ideaboard_admin_notices'                 );
add_action( 'custom_menu_order',       'ideaboard_admin_custom_menu_order'       );
add_action( 'menu_order',              'ideaboard_admin_menu_order'              );
add_action( 'wpmu_new_blog',           'ideaboard_new_site',               10, 6 );

// Hook on to admin_init
add_action( 'ideaboard_admin_init', 'ideaboard_admin_forums'                );
add_action( 'ideaboard_admin_init', 'ideaboard_admin_topics'                );
add_action( 'ideaboard_admin_init', 'ideaboard_admin_replies'               );
add_action( 'ideaboard_admin_init', 'ideaboard_setup_updater',          999 );
add_action( 'ideaboard_admin_init', 'ideaboard_register_importers'          );
add_action( 'ideaboard_admin_init', 'ideaboard_register_admin_style'        );
add_action( 'ideaboard_admin_init', 'ideaboard_register_admin_settings'     );
add_action( 'ideaboard_admin_init', 'ideaboard_do_activation_redirect', 1   );

// Initialize the admin area
add_action( 'ideaboard_init', 'ideaboard_admin' );

// Reset the menu order
add_action( 'ideaboard_admin_menu', 'ideaboard_admin_separator' );

// Activation
add_action( 'ideaboard_activation', 'ideaboard_delete_rewrite_rules'        );
add_action( 'ideaboard_activation', 'ideaboard_make_current_user_keymaster' );

// Deactivation
add_action( 'ideaboard_deactivation', 'ideaboard_remove_caps'          );
add_action( 'ideaboard_deactivation', 'ideaboard_delete_rewrite_rules' );

// New Site
add_action( 'ideaboard_new_site', 'ideaboard_create_initial_content', 8 );

// Contextual Helpers
add_action( 'load-settings_page_ideaboard', 'ideaboard_admin_settings_help' );

// Handle submission of Tools pages
add_action( 'load-tools_page_ideaboard-repair', 'ideaboard_admin_repair_handler' );
add_action( 'load-tools_page_ideaboard-reset',  'ideaboard_admin_reset_handler'  );

// Add sample permalink filter
add_filter( 'post_type_link', 'ideaboard_filter_sample_permalink', 10, 4 );

/**
 * When a new site is created in a multisite installation, run the activation
 * routine on that site
 *
 * @since IdeaBoard (r3283)
 *
 * @param int $blog_id
 * @param int $user_id
 * @param string $domain
 * @param string $path
 * @param int $site_id
 * @param array() $meta
 */
function ideaboard_new_site( $blog_id, $user_id, $domain, $path, $site_id, $meta ) {

	// Bail if plugin is not network activated
	if ( ! is_plugin_active_for_network( ideaboard()->basename ) )
		return;

	// Switch to the new blog
	switch_to_blog( $blog_id );

	// Do the IdeaBoard activation routine
	do_action( 'ideaboard_new_site', $blog_id, $user_id, $domain, $path, $site_id, $meta );

	// restore original blog
	restore_current_blog();
}

/** Sub-Actions ***************************************************************/

/**
 * Piggy back admin_init action
 *
 * @since IdeaBoard (r3766)
 * @uses do_action() Calls 'ideaboard_admin_init'
 */
function ideaboard_admin_init() {
	do_action( 'ideaboard_admin_init' );
}

/**
 * Piggy back admin_menu action
 *
 * @since IdeaBoard (r3766)
 * @uses do_action() Calls 'ideaboard_admin_menu'
 */
function ideaboard_admin_menu() {
	do_action( 'ideaboard_admin_menu' );
}

/**
 * Piggy back admin_head action
 *
 * @since IdeaBoard (r3766)
 * @uses do_action() Calls 'ideaboard_admin_head'
 */
function ideaboard_admin_head() {
	do_action( 'ideaboard_admin_head' );
}

/**
 * Piggy back admin_notices action
 *
 * @since IdeaBoard (r3766)
 * @uses do_action() Calls 'ideaboard_admin_notices'
 */
function ideaboard_admin_notices() {
	do_action( 'ideaboard_admin_notices' );
}

/**
 * Dedicated action to register IdeaBoard importers
 *
 * @since IdeaBoard (r3766)
 * @uses do_action() Calls 'ideaboard_admin_notices'
 */
function ideaboard_register_importers() {
	do_action( 'ideaboard_register_importers' );
}

/**
 * Dedicated action to register admin styles
 *
 * @since IdeaBoard (r3766)
 * @uses do_action() Calls 'ideaboard_admin_notices'
 */
function ideaboard_register_admin_style() {
	do_action( 'ideaboard_register_admin_style' );
}

/**
 * Dedicated action to register admin settings
 *
 * @since IdeaBoard (r3766)
 * @uses do_action() Calls 'ideaboard_register_admin_settings'
 */
function ideaboard_register_admin_settings() {
	do_action( 'ideaboard_register_admin_settings' );
}
