<?php

/**
 * Plugin Dependency
 *
 * The purpose of the following hooks is to mimic the behavior of something
 * called 'plugin dependency' which enables a plugin to have plugins of their
 * own in a safe and reliable way.
 *
 * We do this in IdeaBoard by mirroring existing WordPress hookss in many places
 * allowing dependant plugins to hook into the IdeaBoard specific ones, thus
 * guaranteeing proper code execution only when IdeaBoard is active.
 *
 * The following functions are wrappers for hookss, allowing them to be
 * manually called and/or piggy-backed on top of other hooks if needed.
 *
 * @todo use anonymous functions when PHP minimun requirement allows (5.3)
 */

/** Activation Actions ********************************************************/

/**
 * Runs on IdeaBoard activation
 *
 * @since IdeaBoard (r2509)
 * @uses register_uninstall_hook() To register our own uninstall hook
 * @uses do_action() Calls 'ideaboard_activation' hook
 */
function ideaboard_activation() {
	do_action( 'ideaboard_activation' );
}

/**
 * Runs on IdeaBoard deactivation
 *
 * @since IdeaBoard (r2509)
 * @uses do_action() Calls 'ideaboard_deactivation' hook
 */
function ideaboard_deactivation() {
	do_action( 'ideaboard_deactivation' );
}

/**
 * Runs when uninstalling IdeaBoard
 *
 * @since IdeaBoard (r2509)
 * @uses do_action() Calls 'ideaboard_uninstall' hook
 */
function ideaboard_uninstall() {
	do_action( 'ideaboard_uninstall' );
}

/** Main Actions **************************************************************/

/**
 * Main action responsible for constants, globals, and includes
 *
 * @since IdeaBoard (r2599)
 * @uses do_action() Calls 'ideaboard_loaded'
 */
function ideaboard_loaded() {
	do_action( 'ideaboard_loaded' );
}

/**
 * Setup constants
 *
 * @since IdeaBoard (r2599)
 * @uses do_action() Calls 'ideaboard_constants'
 */
function ideaboard_constants() {
	do_action( 'ideaboard_constants' );
}

/**
 * Setup globals BEFORE includes
 *
 * @since IdeaBoard (r2599)
 * @uses do_action() Calls 'ideaboard_boot_strap_globals'
 */
function ideaboard_boot_strap_globals() {
	do_action( 'ideaboard_boot_strap_globals' );
}

/**
 * Include files
 *
 * @since IdeaBoard (r2599)
 * @uses do_action() Calls 'ideaboard_includes'
 */
function ideaboard_includes() {
	do_action( 'ideaboard_includes' );
}

/**
 * Setup globals AFTER includes
 *
 * @since IdeaBoard (r2599)
 * @uses do_action() Calls 'ideaboard_setup_globals'
 */
function ideaboard_setup_globals() {
	do_action( 'ideaboard_setup_globals' );
}

/**
 * Register any objects before anything is initialized
 *
 * @since IdeaBoard (r4180)
 * @uses do_action() Calls 'ideaboard_register'
 */
function ideaboard_register() {
	do_action( 'ideaboard_register' );
}

/**
 * Initialize any code after everything has been loaded
 *
 * @since IdeaBoard (r2599)
 * @uses do_action() Calls 'ideaboard_init'
 */
function ideaboard_init() {
	do_action( 'ideaboard_init' );
}

/**
 * Initialize widgets
 *
 * @since IdeaBoard (r3389)
 * @uses do_action() Calls 'ideaboard_widgets_init'
 */
function ideaboard_widgets_init() {
	do_action( 'ideaboard_widgets_init' );
}

/**
 * Initialize roles
 *
 * @since IdeaBoard (r6147)
 *
 * @param WP_Roles $wp_roles The main WordPress roles global
 *
 * @uses do_action() Calls 'ideaboard_roles_init'
 */
function ideaboard_roles_init( $wp_roles = null ) {
	do_action( 'ideaboard_roles_init', $wp_roles );
}

/**
 * Setup the currently logged-in user
 *
 * @since IdeaBoard (r2695)
 * @uses do_action() Calls 'ideaboard_setup_current_user'
 */
function ideaboard_setup_current_user() {
	do_action( 'ideaboard_setup_current_user' );
}

/** Supplemental Actions ******************************************************/

/**
 * Load translations for current language
 *
 * @since IdeaBoard (r2599)
 * @uses do_action() Calls 'ideaboard_load_textdomain'
 */
function ideaboard_load_textdomain() {
	do_action( 'ideaboard_load_textdomain' );
}

/**
 * Setup the post types
 *
 * @since IdeaBoard (r2464)
 * @uses do_action() Calls 'ideaboard_register_post_type'
 */
function ideaboard_register_post_types() {
	do_action( 'ideaboard_register_post_types' );
}

/**
 * Setup the post statuses
 *
 * @since IdeaBoard (r2727)
 * @uses do_action() Calls 'ideaboard_register_post_statuses'
 */
function ideaboard_register_post_statuses() {
	do_action( 'ideaboard_register_post_statuses' );
}

/**
 * Register the built in IdeaBoard taxonomies
 *
 * @since IdeaBoard (r2464)
 * @uses do_action() Calls 'ideaboard_register_taxonomies'
 */
function ideaboard_register_taxonomies() {
	do_action( 'ideaboard_register_taxonomies' );
}

/**
 * Register the default IdeaBoard views
 *
 * @since IdeaBoard (r2789)
 * @uses do_action() Calls 'ideaboard_register_views'
 */
function ideaboard_register_views() {
	do_action( 'ideaboard_register_views' );
}

/**
 * Register the default IdeaBoard shortcodes
 *
 * @since IdeaBoard (r4211)
 * @uses do_action() Calls 'ideaboard_register_shortcodes'
 */
function ideaboard_register_shortcodes() {
	do_action( 'ideaboard_register_shortcodes' );
}

/**
 * Enqueue IdeaBoard specific CSS and JS
 *
 * @since IdeaBoard (r3373)
 * @uses do_action() Calls 'ideaboard_enqueue_scripts'
 */
function ideaboard_enqueue_scripts() {
	do_action( 'ideaboard_enqueue_scripts' );
}

/**
 * Add the IdeaBoard-specific rewrite tags
 *
 * @since IdeaBoard (r2753)
 * @uses do_action() Calls 'ideaboard_add_rewrite_tags'
 */
function ideaboard_add_rewrite_tags() {
	do_action( 'ideaboard_add_rewrite_tags' );
}

/**
 * Add the IdeaBoard-specific rewrite rules
 *
 * @since IdeaBoard (r4918)
 * @uses do_action() Calls 'ideaboard_add_rewrite_rules'
 */
function ideaboard_add_rewrite_rules() {
	do_action( 'ideaboard_add_rewrite_rules' );
}

/**
 * Add the IdeaBoard-specific permalink structures
 *
 * @since IdeaBoard (r4918)
 * @uses do_action() Calls 'ideaboard_add_permastructs'
 */
function ideaboard_add_permastructs() {
	do_action( 'ideaboard_add_permastructs' );
}

/**
 * Add the IdeaBoard-specific login forum action
 *
 * @since IdeaBoard (r2753)
 * @uses do_action() Calls 'ideaboard_login_form_login'
 */
function ideaboard_login_form_login() {
	do_action( 'ideaboard_login_form_login' );
}

/** User Actions **************************************************************/

/**
 * The main action for hooking into when a user account is updated
 *
 * @since IdeaBoard (r4304)
 *
 * @param int $user_id ID of user being edited
 * @param array $old_user_data The old, unmodified user data
 * @uses do_action() Calls 'ideaboard_profile_update'
 */
function ideaboard_profile_update( $user_id = 0, $old_user_data = array() ) {
	do_action( 'ideaboard_profile_update', $user_id, $old_user_data );
}

/**
 * The main action for hooking into a user being registered
 *
 * @since IdeaBoard (r4304)
 * @param int $user_id ID of user being edited
 * @uses do_action() Calls 'ideaboard_user_register'
 */
function ideaboard_user_register( $user_id = 0 ) {
	do_action( 'ideaboard_user_register', $user_id );
}

/** Final Action **************************************************************/

/**
 * IdeaBoard has loaded and initialized everything, and is okay to go
 *
 * @since IdeaBoard (r2618)
 * @uses do_action() Calls 'ideaboard_ready'
 */
function ideaboard_ready() {
	do_action( 'ideaboard_ready' );
}

/** Theme Permissions *********************************************************/

/**
 * The main action used for redirecting IdeaBoard theme actions that are not
 * permitted by the current_user
 *
 * @since IdeaBoard (r3605)
 * @uses do_action()
 */
function ideaboard_template_redirect() {
	do_action( 'ideaboard_template_redirect' );
}

/** Theme Helpers *************************************************************/

/**
 * The main action used for executing code before the theme has been setup
 *
 * @since IdeaBoard (r3829)
 * @uses do_action()
 */
function ideaboard_register_theme_packages() {
	do_action( 'ideaboard_register_theme_packages' );
}

/**
 * The main action used for executing code before the theme has been setup
 *
 * @since IdeaBoard (r3732)
 * @uses do_action()
 */
function ideaboard_setup_theme() {
	do_action( 'ideaboard_setup_theme' );
}

/**
 * The main action used for executing code after the theme has been setup
 *
 * @since IdeaBoard (r3732)
 * @uses do_action()
 */
function ideaboard_after_setup_theme() {
	do_action( 'ideaboard_after_setup_theme' );
}

/**
 * The main action used for handling theme-side POST requests
 *
 * @since IdeaBoard (r4550)
 * @uses do_action()
 */
function ideaboard_post_request() {

	// Bail if not a POST action
	if ( ! ideaboard_is_post_request() )
		return;

	// Bail if no action
	if ( empty( $_POST['action'] ) )
		return;

	// This dynamic action is probably the one you want to use. It narrows down
	// the scope of the 'action' without needing to check it in your function.
	do_action( 'ideaboard_post_request_' . $_POST['action'] );

	// Use this static action if you don't mind checking the 'action' yourself.
	do_action( 'ideaboard_post_request',   $_POST['action'] );
}

/**
 * The main action used for handling theme-side GET requests
 *
 * @since IdeaBoard (r4550)
 * @uses do_action()
 */
function ideaboard_get_request() {

	// Bail if not a POST action
	if ( ! ideaboard_is_get_request() )
		return;

	// Bail if no action
	if ( empty( $_GET['action'] ) )
		return;

	// This dynamic action is probably the one you want to use. It narrows down
	// the scope of the 'action' without needing to check it in your function.
	do_action( 'ideaboard_get_request_' . $_GET['action'] );

	// Use this static action if you don't mind checking the 'action' yourself.
	do_action( 'ideaboard_get_request',   $_GET['action'] );
}

/** Filters *******************************************************************/

/**
 * Filter the plugin locale and domain.
 *
 * @since IdeaBoard (r4213)
 *
 * @param string $locale
 * @param string $domain
 */
function ideaboard_plugin_locale( $locale = '', $domain = '' ) {
	return apply_filters( 'ideaboard_plugin_locale', $locale, $domain );
}

/**
 * Piggy back filter for WordPress's 'request' filter
 *
 * @since IdeaBoard (r3758)
 * @param array $query_vars
 * @return array
 */
function ideaboard_request( $query_vars = array() ) {
	return apply_filters( 'ideaboard_request', $query_vars );
}

/**
 * The main filter used for theme compatibility and displaying custom IdeaBoard
 * theme files.
 *
 * @since IdeaBoard (r3311)
 * @uses apply_filters()
 * @param string $template
 * @return string Template file to use
 */
function ideaboard_template_include( $template = '' ) {
	return apply_filters( 'ideaboard_template_include', $template );
}

/**
 * Generate IdeaBoard-specific rewrite rules
 *
 * @since IdeaBoard (r2688)
 * @deprecated since IdeaBoard (r4918)
 * @param WP_Rewrite $wp_rewrite
 * @uses do_action() Calls 'ideaboard_generate_rewrite_rules' with {@link WP_Rewrite}
 */
function ideaboard_generate_rewrite_rules( $wp_rewrite ) {
	do_action_ref_array( 'ideaboard_generate_rewrite_rules', array( &$wp_rewrite ) );
}

/**
 * Filter the allowed themes list for IdeaBoard specific themes
 *
 * @since IdeaBoard (r2944)
 * @uses apply_filters() Calls 'ideaboard_allowed_themes' with the allowed themes list
 */
function ideaboard_allowed_themes( $themes ) {
	return apply_filters( 'ideaboard_allowed_themes', $themes );
}

/**
 * Maps forum/topic/reply caps to built in WordPress caps
 *
 * @since IdeaBoard (r2593)
 *
 * @param array $caps Capabilities for meta capability
 * @param string $cap Capability name
 * @param int $user_id User id
 * @param mixed $args Arguments
 */
function ideaboard_map_meta_caps( $caps = array(), $cap = '', $user_id = 0, $args = array() ) {
	return apply_filters( 'ideaboard_map_meta_caps', $caps, $cap, $user_id, $args );
}
