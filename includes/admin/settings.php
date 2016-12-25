<?php

/**
 * IdeaBoard Admin Settings
 *
 * @package IdeaBoard
 * @subpackage Administration
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/** Sections ******************************************************************/

/**
 * Get the Forums settings sections.
 *
 * @since IdeaBoard (r4001)
 * @return array
 */
function ideaboard_admin_get_settings_sections() {
	return (array) apply_filters( 'ideaboard_admin_get_settings_sections', array(
		'ideaboard_settings_users' => array(
			'title'    => __( 'Forum User Settings', 'ideaboard' ),
			'callback' => 'ideaboard_admin_setting_callback_user_section',
			'page'     => 'discussion'
		),
		'ideaboard_settings_features' => array(
			'title'    => __( 'Forum Features', 'ideaboard' ),
			'callback' => 'ideaboard_admin_setting_callback_features_section',
			'page'     => 'discussion'
		),
		'ideaboard_settings_theme_compat' => array(
			'title'    => __( 'Forum Theme Packages', 'ideaboard' ),
			'callback' => 'ideaboard_admin_setting_callback_subtheme_section',
			'page'     => 'general'
		),
		'ideaboard_settings_per_page' => array(
			'title'    => __( 'Topics and Replies Per Page', 'ideaboard' ),
			'callback' => 'ideaboard_admin_setting_callback_per_page_section',
			'page'     => 'reading'
		),
		'ideaboard_settings_per_rss_page' => array(
			'title'    => __( 'Topics and Replies Per RSS Page', 'ideaboard' ),
			'callback' => 'ideaboard_admin_setting_callback_per_rss_page_section',
			'page'     => 'reading',
		),
		'ideaboard_settings_root_slugs' => array(
			'title'    => __( 'Forum Root Slug', 'ideaboard' ),
			'callback' => 'ideaboard_admin_setting_callback_root_slug_section',
			'page'     => 'permalink'
		),
		'ideaboard_settings_single_slugs' => array(
			'title'    => __( 'Single Forum Slugs', 'ideaboard' ),
			'callback' => 'ideaboard_admin_setting_callback_single_slug_section',
			'page'     => 'permalink',
		),
		'ideaboard_settings_user_slugs' => array(
			'title'    => __( 'Forum User Slugs', 'ideaboard' ),
			'callback' => 'ideaboard_admin_setting_callback_user_slug_section',
			'page'     => 'permalink',
		),
		'ideaboard_settings_buddypress' => array(
			'title'    => __( 'BuddyPress Integration', 'ideaboard' ),
			'callback' => 'ideaboard_admin_setting_callback_buddypress_section',
			'page'     => 'buddypress',
		),
		'ideaboard_settings_akismet' => array(
			'title'    => __( 'Akismet Integration', 'ideaboard' ),
			'callback' => 'ideaboard_admin_setting_callback_akismet_section',
			'page'     => 'discussion'
		)
	) );
}

/**
 * Get all of the settings fields.
 *
 * @since IdeaBoard (r4001)
 * @return type
 */
function ideaboard_admin_get_settings_fields() {
	return (array) apply_filters( 'ideaboard_admin_get_settings_fields', array(

		/** User Section ******************************************************/

		'ideaboard_settings_users' => array(

			// Edit lock setting
			'_ideaboard_edit_lock' => array(
				'title'             => __( 'Disallow editing after', 'ideaboard' ),
				'callback'          => 'ideaboard_admin_setting_callback_editlock',
				'sanitize_callback' => 'intval',
				'args'              => array()
			),

			// Throttle setting
			'_ideaboard_throttle_time' => array(
				'title'             => __( 'Throttle posting every', 'ideaboard' ),
				'callback'          => 'ideaboard_admin_setting_callback_throttle',
				'sanitize_callback' => 'intval',
				'args'              => array()
			),

			// Allow anonymous posting setting
			'_ideaboard_allow_anonymous' => array(
				'title'             => __( 'Anonymous posting', 'ideaboard' ),
				'callback'          => 'ideaboard_admin_setting_callback_anonymous',
				'sanitize_callback' => 'intval',
				'args'              => array()
			),

			// Allow global access (on multisite)
			'_ideaboard_allow_global_access' => array(
				'title'             => __( 'Auto role', 'ideaboard' ),
				'callback'          => 'ideaboard_admin_setting_callback_global_access',
				'sanitize_callback' => 'intval',
				'args'              => array()
			),

			// Allow global access (on multisite)
			'_ideaboard_default_role' => array(
				'sanitize_callback' => 'sanitize_text_field',
				'args'              => array()
			)
		),

		/** Features Section **************************************************/

		'ideaboard_settings_features' => array(

			// Allow topic and reply revisions
			'_ideaboard_allow_revisions' => array(
				'title'             => __( 'Revisions', 'ideaboard' ),
				'callback'          => 'ideaboard_admin_setting_callback_revisions',
				'sanitize_callback' => 'intval',
				'args'              => array()
			),

			// Allow favorites setting
			'_ideaboard_enable_favorites' => array(
				'title'             => __( 'Favorites', 'ideaboard' ),
				'callback'          => 'ideaboard_admin_setting_callback_favorites',
				'sanitize_callback' => 'intval',
				'args'              => array()
			),

			// Allow subscriptions setting
			'_ideaboard_enable_subscriptions' => array(
				'title'             => __( 'Subscriptions', 'ideaboard' ),
				'callback'          => 'ideaboard_admin_setting_callback_subscriptions',
				'sanitize_callback' => 'intval',
				'args'              => array()
			),

			// Allow topic tags
			'_ideaboard_allow_topic_tags' => array(
				'title'             => __( 'Topic tags', 'ideaboard' ),
				'callback'          => 'ideaboard_admin_setting_callback_topic_tags',
				'sanitize_callback' => 'intval',
				'args'              => array()
			),

			// Allow topic tags
			'_ideaboard_allow_search' => array(
				'title'             => __( 'Search', 'ideaboard' ),
				'callback'          => 'ideaboard_admin_setting_callback_search',
				'sanitize_callback' => 'intval',
				'args'              => array()
			),

			// Allow fancy editor setting
			'_ideaboard_use_wp_editor' => array(
				'title'             => __( 'Post Formatting', 'ideaboard' ),
				'callback'          => 'ideaboard_admin_setting_callback_use_wp_editor',
				'args'              => array(),
				'sanitize_callback' => 'intval'
			),

			// Allow auto embedding setting
			'_ideaboard_use_autoembed' => array(
				'title'             => __( 'Auto-embed links', 'ideaboard' ),
				'callback'          => 'ideaboard_admin_setting_callback_use_autoembed',
				'sanitize_callback' => 'intval',
				'args'              => array()
			),

			// Set reply threading level
			'_ideaboard_thread_replies_depth' => array(
				'title'             => __( 'Reply Threading', 'ideaboard' ),
				'callback'          => 'ideaboard_admin_setting_callback_thread_replies_depth',
				'sanitize_callback' => 'intval',
				'args'              => array()
			),

			// Allow threaded replies
			'_ideaboard_allow_threaded_replies' => array(
				'sanitize_callback' => 'intval',
				'args'              => array()
			)
		),

		/** Theme Packages ****************************************************/

		'ideaboard_settings_theme_compat' => array(

			// Theme package setting
			'_ideaboard_theme_package_id' => array(
				'title'             => __( 'Current Package', 'ideaboard' ),
				'callback'          => 'ideaboard_admin_setting_callback_subtheme_id',
				'sanitize_callback' => 'esc_sql',
				'args'              => array()
			)
		),

		/** Per Page Section **************************************************/

		'ideaboard_settings_per_page' => array(

			// Replies per page setting
			'_ideaboard_topics_per_page' => array(
				'title'             => __( 'Topics', 'ideaboard' ),
				'callback'          => 'ideaboard_admin_setting_callback_topics_per_page',
				'sanitize_callback' => 'intval',
				'args'              => array()
			),

			// Replies per page setting
			'_ideaboard_replies_per_page' => array(
				'title'             => __( 'Replies', 'ideaboard' ),
				'callback'          => 'ideaboard_admin_setting_callback_replies_per_page',
				'sanitize_callback' => 'intval',
				'args'              => array()
			)
		),

		/** Per RSS Page Section **********************************************/

		'ideaboard_settings_per_rss_page' => array(

			// Replies per page setting
			'_ideaboard_topics_per_rss_page' => array(
				'title'             => __( 'Topics', 'ideaboard' ),
				'callback'          => 'ideaboard_admin_setting_callback_topics_per_rss_page',
				'sanitize_callback' => 'intval',
				'args'              => array()
			),

			// Replies per page setting
			'_ideaboard_replies_per_rss_page' => array(
				'title'             => __( 'Replies', 'ideaboard' ),
				'callback'          => 'ideaboard_admin_setting_callback_replies_per_rss_page',
				'sanitize_callback' => 'intval',
				'args'              => array()
			)
		),

		/** Front Slugs *******************************************************/

		'ideaboard_settings_root_slugs' => array(

			// Root slug setting
			'_ideaboard_root_slug' => array(
				'title'             => __( 'Forum Root', 'ideaboard' ),
				'callback'          => 'ideaboard_admin_setting_callback_root_slug',
				'sanitize_callback' => 'ideaboard_sanitize_slug',
				'args'              => array()
			),

			// Include root setting
			'_ideaboard_include_root' => array(
				'title'             => __( 'Forum Prefix', 'ideaboard' ),
				'callback'          => 'ideaboard_admin_setting_callback_include_root',
				'sanitize_callback' => 'intval',
				'args'              => array()
			),

			// What to show on Forum Root
			'_ideaboard_show_on_root' => array(
				'title'             => __( 'Forum root should show', 'ideaboard' ),
				'callback'          => 'ideaboard_admin_setting_callback_show_on_root',
				'sanitize_callback' => 'sanitize_text_field',
				'args'              => array()
			),
		),

		/** Single Slugs ******************************************************/

		'ideaboard_settings_single_slugs' => array(

			// Forum slug setting
			'_ideaboard_forum_slug' => array(
				'title'             => __( 'Forum', 'ideaboard' ),
				'callback'          => 'ideaboard_admin_setting_callback_forum_slug',
				'sanitize_callback' => 'ideaboard_sanitize_slug',
				'args'              => array()
			),

			// Topic slug setting
			'_ideaboard_topic_slug' => array(
				'title'             => __( 'Topic', 'ideaboard' ),
				'callback'          => 'ideaboard_admin_setting_callback_topic_slug',
				'sanitize_callback' => 'ideaboard_sanitize_slug',
				'args'              => array()
			),

			// Topic tag slug setting
			'_ideaboard_topic_tag_slug' => array(
				'title'             => __( 'Topic Tag', 'ideaboard' ),
				'callback'          => 'ideaboard_admin_setting_callback_topic_tag_slug',
				'sanitize_callback' => 'ideaboard_sanitize_slug',
				'args'              => array()
			),

			// View slug setting
			'_ideaboard_view_slug' => array(
				'title'             => __( 'Topic View', 'ideaboard' ),
				'callback'          => 'ideaboard_admin_setting_callback_view_slug',
				'sanitize_callback' => 'ideaboard_sanitize_slug',
				'args'              => array()
			),

			// Reply slug setting
			'_ideaboard_reply_slug' => array(
				'title'             => __( 'Reply', 'ideaboard' ),
				'callback'          => 'ideaboard_admin_setting_callback_reply_slug',
				'sanitize_callback' => 'ideaboard_sanitize_slug',
				'args'              => array()
			),

			// Search slug setting
			'_ideaboard_search_slug' => array(
				'title'             => __( 'Search', 'ideaboard' ),
				'callback'          => 'ideaboard_admin_setting_callback_search_slug',
				'sanitize_callback' => 'ideaboard_sanitize_slug',
				'args'              => array()
			)
		),

		/** User Slugs ********************************************************/

		'ideaboard_settings_user_slugs' => array(

			// User slug setting
			'_ideaboard_user_slug' => array(
				'title'             => __( 'User Base', 'ideaboard' ),
				'callback'          => 'ideaboard_admin_setting_callback_user_slug',
				'sanitize_callback' => 'ideaboard_sanitize_slug',
				'args'              => array()
			),

			// Topics slug setting
			'_ideaboard_topic_archive_slug' => array(
				'title'             => __( 'Topics Started', 'ideaboard' ),
				'callback'          => 'ideaboard_admin_setting_callback_topic_archive_slug',
				'sanitize_callback' => 'ideaboard_sanitize_slug',
				'args'              => array()
			),

			// Replies slug setting
			'_ideaboard_reply_archive_slug' => array(
				'title'             => __( 'Replies Created', 'ideaboard' ),
				'callback'          => 'ideaboard_admin_setting_callback_reply_archive_slug',
				'sanitize_callback' => 'ideaboard_sanitize_slug',
				'args'              => array()
			),

			// Favorites slug setting
			'_ideaboard_user_favs_slug' => array(
				'title'             => __( 'Favorite Topics', 'ideaboard' ),
				'callback'          => 'ideaboard_admin_setting_callback_user_favs_slug',
				'sanitize_callback' => 'ideaboard_sanitize_slug',
				'args'              => array()
			),

			// Subscriptions slug setting
			'_ideaboard_user_subs_slug' => array(
				'title'             => __( 'Topic Subscriptions', 'ideaboard' ),
				'callback'          => 'ideaboard_admin_setting_callback_user_subs_slug',
				'sanitize_callback' => 'ideaboard_sanitize_slug',
				'args'              => array()
			)
		),

		/** BuddyPress ********************************************************/

		'ideaboard_settings_buddypress' => array(

			// Are group forums enabled?
			'_ideaboard_enable_group_forums' => array(
				'title'             => __( 'Enable Group Forums', 'ideaboard' ),
				'callback'          => 'ideaboard_admin_setting_callback_group_forums',
				'sanitize_callback' => 'intval',
				'args'              => array()
			),

			// Group forums parent forum ID
			'_ideaboard_group_forums_root_id' => array(
				'title'             => __( 'Group Forums Parent', 'ideaboard' ),
				'callback'          => 'ideaboard_admin_setting_callback_group_forums_root_id',
				'sanitize_callback' => 'intval',
				'args'              => array()
			)
		),

		/** Akismet ***********************************************************/

		'ideaboard_settings_akismet' => array(

			// Should we use Akismet
			'_ideaboard_enable_akismet' => array(
				'title'             => __( 'Use Akismet', 'ideaboard' ),
				'callback'          => 'ideaboard_admin_setting_callback_akismet',
				'sanitize_callback' => 'intval',
				'args'              => array()
			)
		)
	) );
}

/**
 * Get settings fields by section.
 *
 * @since IdeaBoard (r4001)
 * @param string $section_id
 * @return mixed False if section is invalid, array of fields otherwise.
 */
function ideaboard_admin_get_settings_fields_for_section( $section_id = '' ) {

	// Bail if section is empty
	if ( empty( $section_id ) )
		return false;

	$fields = ideaboard_admin_get_settings_fields();
	$retval = isset( $fields[$section_id] ) ? $fields[$section_id] : false;

	return (array) apply_filters( 'ideaboard_admin_get_settings_fields_for_section', $retval, $section_id );
}

/** User Section **************************************************************/

/**
 * User settings section description for the settings page
 *
 * @since IdeaBoard (r2786)
 */
function ideaboard_admin_setting_callback_user_section() {
?>

	<p><?php esc_html_e( 'Setting time limits and other user posting capabilities', 'ideaboard' ); ?></p>

<?php
}


/**
 * Edit lock setting field
 *
 * @since IdeaBoard (r2737)
 *
 * @uses ideaboard_form_option() To output the option value
 */
function ideaboard_admin_setting_callback_editlock() {
?>

	<input name="_ideaboard_edit_lock" id="_ideaboard_edit_lock" type="number" min="0" step="1" value="<?php ideaboard_form_option( '_ideaboard_edit_lock', '5' ); ?>" class="small-text"<?php ideaboard_maybe_admin_setting_disabled( '_ideaboard_edit_lock' ); ?> />
	<label for="_ideaboard_edit_lock"><?php esc_html_e( 'minutes', 'ideaboard' ); ?></label>

<?php
}

/**
 * Throttle setting field
 *
 * @since IdeaBoard (r2737)
 *
 * @uses ideaboard_form_option() To output the option value
 */
function ideaboard_admin_setting_callback_throttle() {
?>

	<input name="_ideaboard_throttle_time" id="_ideaboard_throttle_time" type="number" min="0" step="1" value="<?php ideaboard_form_option( '_ideaboard_throttle_time', '10' ); ?>" class="small-text"<?php ideaboard_maybe_admin_setting_disabled( '_ideaboard_throttle_time' ); ?> />
	<label for="_ideaboard_throttle_time"><?php esc_html_e( 'seconds', 'ideaboard' ); ?></label>

<?php
}

/**
 * Allow anonymous posting setting field
 *
 * @since IdeaBoard (r2737)
 *
 * @uses checked() To display the checked attribute
 */
function ideaboard_admin_setting_callback_anonymous() {
?>

	<input name="_ideaboard_allow_anonymous" id="_ideaboard_allow_anonymous" type="checkbox" value="1" <?php checked( ideaboard_allow_anonymous( false ) ); ideaboard_maybe_admin_setting_disabled( '_ideaboard_allow_anonymous' ); ?> />
	<label for="_ideaboard_allow_anonymous"><?php esc_html_e( 'Allow guest users without accounts to create topics and replies', 'ideaboard' ); ?></label>

<?php
}

/**
 * Allow global access setting field
 *
 * @since IdeaBoard (r3378)
 *
 * @uses checked() To display the checked attribute
 */
function ideaboard_admin_setting_callback_global_access() {

	// Get the default role once rather than loop repeatedly below
	$default_role = ideaboard_get_default_role();

	// Start the output buffer for the select dropdown
	ob_start(); ?>

	</label>
	<label for="_ideaboard_default_role">
		<select name="_ideaboard_default_role" id="_ideaboard_default_role" <?php ideaboard_maybe_admin_setting_disabled( '_ideaboard_default_role' ); ?>>
		<?php foreach ( ideaboard_get_dynamic_roles() as $role => $details ) : ?>

			<option <?php selected( $default_role, $role ); ?> value="<?php echo esc_attr( $role ); ?>"><?php echo ideaboard_translate_user_role( $details['name'] ); ?></option>

		<?php endforeach; ?>
		</select>

	<?php $select = ob_get_clean(); ?>

	<label for="_ideaboard_allow_global_access">
		<input name="_ideaboard_allow_global_access" id="_ideaboard_allow_global_access" type="checkbox" value="1" <?php checked( ideaboard_allow_global_access( true ) ); ideaboard_maybe_admin_setting_disabled( '_ideaboard_allow_global_access' ); ?> />
		<?php printf( esc_html__( 'Automatically give registered visitors the %s forum role', 'ideaboard' ), $select ); ?>
	</label>

<?php
}

/** Features Section **********************************************************/

/**
 * Features settings section description for the settings page
 *
 * @since IdeaBoard (r2786)
 */
function ideaboard_admin_setting_callback_features_section() {
?>

	<p><?php esc_html_e( 'Forum features that can be toggled on and off', 'ideaboard' ); ?></p>

<?php
}

/**
 * Allow favorites setting field
 *
 * @since IdeaBoard (r2786)
 *
 * @uses checked() To display the checked attribute
 */
function ideaboard_admin_setting_callback_favorites() {
?>

	<input name="_ideaboard_enable_favorites" id="_ideaboard_enable_favorites" type="checkbox" value="1" <?php checked( ideaboard_is_favorites_active( true ) ); ideaboard_maybe_admin_setting_disabled( '_ideaboard_enable_favorites' ); ?> />
	<label for="_ideaboard_enable_favorites"><?php esc_html_e( 'Allow users to mark topics as favorites', 'ideaboard' ); ?></label>

<?php
}

/**
 * Allow subscriptions setting field
 *
 * @since IdeaBoard (r2737)
 *
 * @uses checked() To display the checked attribute
 */
function ideaboard_admin_setting_callback_subscriptions() {
?>

	<input name="_ideaboard_enable_subscriptions" id="_ideaboard_enable_subscriptions" type="checkbox" value="1" <?php checked( ideaboard_is_subscriptions_active( true ) ); ideaboard_maybe_admin_setting_disabled( '_ideaboard_enable_subscriptions' ); ?> />
	<label for="_ideaboard_enable_subscriptions"><?php esc_html_e( 'Allow users to subscribe to forums and topics', 'ideaboard' ); ?></label>

<?php
}

/**
 * Allow topic tags setting field
 *
 * @since IdeaBoard (r4944)
 *
 * @uses checked() To display the checked attribute
 */
function ideaboard_admin_setting_callback_topic_tags() {
?>

	<input name="_ideaboard_allow_topic_tags" id="_ideaboard_allow_topic_tags" type="checkbox" value="1" <?php checked( ideaboard_allow_topic_tags( true ) ); ideaboard_maybe_admin_setting_disabled( '_ideaboard_allow_topic_tags' ); ?> />
	<label for="_ideaboard_allow_topic_tags"><?php esc_html_e( 'Allow topics to have tags', 'ideaboard' ); ?></label>

<?php
}

/**
 * Allow forum wide search
 *
 * @since IdeaBoard (r4970)
 *
 * @uses checked() To display the checked attribute
 */
function ideaboard_admin_setting_callback_search() {
?>

	<input name="_ideaboard_allow_search" id="_ideaboard_allow_search" type="checkbox" value="1" <?php checked( ideaboard_allow_search( true ) ); ideaboard_maybe_admin_setting_disabled( '_ideaboard_allow_search' ); ?> />
	<label for="_ideaboard_allow_search"><?php esc_html_e( 'Allow forum wide search', 'ideaboard' ); ?></label>

<?php
}

/**
 * Hierarchical reply maximum depth level setting field
 *
 * Replies will be threaded if depth is 2 or greater
 *
 * @since IdeaBoard (r4944)
 *
 * @uses apply_filters() Calls 'ideaboard_thread_replies_depth_max' to set a
 *                        maximum displayed level
 * @uses selected() To display the selected attribute
 */
function ideaboard_admin_setting_callback_thread_replies_depth() {

	// Set maximum depth for dropdown
	$max_depth     = (int) apply_filters( 'ideaboard_thread_replies_depth_max', 10 );
	$current_depth = ideaboard_thread_replies_depth();

	// Start an output buffer for the select dropdown
	ob_start(); ?>

	</label>
	<label for="_ideaboard_thread_replies_depth">
		<select name="_ideaboard_thread_replies_depth" id="_ideaboard_thread_replies_depth" <?php ideaboard_maybe_admin_setting_disabled( '_ideaboard_thread_replies_depth' ); ?>>
		<?php for ( $i = 2; $i <= $max_depth; $i++ ) : ?>

			<option value="<?php echo esc_attr( $i ); ?>" <?php selected( $i, $current_depth ); ?>><?php echo esc_html( $i ); ?></option>

		<?php endfor; ?>
		</select>

	<?php $select = ob_get_clean(); ?>

	<label for="_ideaboard_allow_threaded_replies">
		<input name="_ideaboard_allow_threaded_replies" id="_ideaboard_allow_threaded_replies" type="checkbox" value="1" <?php checked( '1', ideaboard_allow_threaded_replies( false ) ); ideaboard_maybe_admin_setting_disabled( '_ideaboard_allow_threaded_replies' ); ?> />
		<?php printf( esc_html__( 'Enable threaded (nested) replies %s levels deep', 'ideaboard' ), $select ); ?>
	</label>

<?php
}

/**
 * Allow topic and reply revisions
 *
 * @since IdeaBoard (r3412)
 *
 * @uses checked() To display the checked attribute
 */
function ideaboard_admin_setting_callback_revisions() {
?>

	<input name="_ideaboard_allow_revisions" id="_ideaboard_allow_revisions" type="checkbox" value="1" <?php checked( ideaboard_allow_revisions( true ) ); ideaboard_maybe_admin_setting_disabled( '_ideaboard_allow_revisions' ); ?> />
	<label for="_ideaboard_allow_revisions"><?php esc_html_e( 'Allow topic and reply revision logging', 'ideaboard' ); ?></label>

<?php
}

/**
 * Use the WordPress editor setting field
 *
 * @since IdeaBoard (r3586)
 *
 * @uses checked() To display the checked attribute
 */
function ideaboard_admin_setting_callback_use_wp_editor() {
?>

	<input name="_ideaboard_use_wp_editor" id="_ideaboard_use_wp_editor" type="checkbox" value="1" <?php checked( ideaboard_use_wp_editor( true ) ); ideaboard_maybe_admin_setting_disabled( '_ideaboard_use_wp_editor' ); ?> />
	<label for="_ideaboard_use_wp_editor"><?php esc_html_e( 'Add toolbar & buttons to textareas to help with HTML formatting', 'ideaboard' ); ?></label>

<?php
}

/**
 * Main subtheme section
 *
 * @since IdeaBoard (r2786)
 */
function ideaboard_admin_setting_callback_subtheme_section() {
?>

	<p><?php esc_html_e( 'How your forum content is displayed within your existing theme.', 'ideaboard' ); ?></p>

<?php
}

/**
 * Use the WordPress editor setting field
 *
 * @since IdeaBoard (r3586)
 *
 * @uses checked() To display the checked attribute
 */
function ideaboard_admin_setting_callback_subtheme_id() {

	// Declare locale variable
	$theme_options   = '';
	$current_package = ideaboard_get_theme_package_id( 'default' );

	// Note: This should never be empty. /templates/ is the
	// canonical backup if no other packages exist. If there's an error here,
	// something else is wrong.
	//
	// @see IdeaBoard::register_theme_packages()
	foreach ( (array) ideaboard()->theme_compat->packages as $id => $theme ) {
		$theme_options .= '<option value="' . esc_attr( $id ) . '"' . selected( $theme->id, $current_package, false ) . '>' . sprintf( esc_html__( '%1$s - %2$s', 'ideaboard' ), esc_html( $theme->name ), esc_html( str_replace( WP_CONTENT_DIR, '', $theme->dir ) ) )  . '</option>';
	}

	if ( !empty( $theme_options ) ) : ?>

		<select name="_ideaboard_theme_package_id" id="_ideaboard_theme_package_id" <?php ideaboard_maybe_admin_setting_disabled( '_ideaboard_theme_package_id' ); ?>><?php echo $theme_options ?></select>
		<label for="_ideaboard_theme_package_id"><?php esc_html_e( 'will serve all IdeaBoard templates', 'ideaboard' ); ?></label>

	<?php else : ?>

		<p><?php esc_html_e( 'No template packages available.', 'ideaboard' ); ?></p>

	<?php endif;
}

/**
 * Allow oEmbed in replies
 *
 * @since IdeaBoard (r3752)
 *
 * @uses checked() To display the checked attribute
 */
function ideaboard_admin_setting_callback_use_autoembed() {
?>

	<input name="_ideaboard_use_autoembed" id="_ideaboard_use_autoembed" type="checkbox" value="1" <?php checked( ideaboard_use_autoembed( true ) ); ideaboard_maybe_admin_setting_disabled( '_ideaboard_use_autoembed' ); ?> />
	<label for="_ideaboard_use_autoembed"><?php esc_html_e( 'Embed media (YouTube, Twitter, Flickr, etc...) directly into topics and replies', 'ideaboard' ); ?></label>

<?php
}

/** Per Page Section **********************************************************/

/**
 * Per page settings section description for the settings page
 *
 * @since IdeaBoard (r2786)
 */
function ideaboard_admin_setting_callback_per_page_section() {
?>

	<p><?php esc_html_e( 'How many topics and replies to show per page', 'ideaboard' ); ?></p>

<?php
}

/**
 * Topics per page setting field
 *
 * @since IdeaBoard (r2786)
 *
 * @uses ideaboard_form_option() To output the option value
 */
function ideaboard_admin_setting_callback_topics_per_page() {
?>

	<input name="_ideaboard_topics_per_page" id="_ideaboard_topics_per_page" type="number" min="1" step="1" value="<?php ideaboard_form_option( '_ideaboard_topics_per_page', '15' ); ?>" class="small-text"<?php ideaboard_maybe_admin_setting_disabled( '_ideaboard_topics_per_page' ); ?> />
	<label for="_ideaboard_topics_per_page"><?php esc_html_e( 'per page', 'ideaboard' ); ?></label>

<?php
}

/**
 * Replies per page setting field
 *
 * @since IdeaBoard (r2786)
 *
 * @uses ideaboard_form_option() To output the option value
 */
function ideaboard_admin_setting_callback_replies_per_page() {
?>

	<input name="_ideaboard_replies_per_page" id="_ideaboard_replies_per_page" type="number" min="1" step="1" value="<?php ideaboard_form_option( '_ideaboard_replies_per_page', '15' ); ?>" class="small-text"<?php ideaboard_maybe_admin_setting_disabled( '_ideaboard_replies_per_page' ); ?> />
	<label for="_ideaboard_replies_per_page"><?php esc_html_e( 'per page', 'ideaboard' ); ?></label>

<?php
}

/** Per RSS Page Section ******************************************************/

/**
 * Per page settings section description for the settings page
 *
 * @since IdeaBoard (r2786)
 */
function ideaboard_admin_setting_callback_per_rss_page_section() {
?>

	<p><?php esc_html_e( 'How many topics and replies to show per RSS page', 'ideaboard' ); ?></p>

<?php
}

/**
 * Topics per RSS page setting field
 *
 * @since IdeaBoard (r2786)
 *
 * @uses ideaboard_form_option() To output the option value
 */
function ideaboard_admin_setting_callback_topics_per_rss_page() {
?>

	<input name="_ideaboard_topics_per_rss_page" id="_ideaboard_topics_per_rss_page" type="number" min="1" step="1" value="<?php ideaboard_form_option( '_ideaboard_topics_per_rss_page', '25' ); ?>" class="small-text"<?php ideaboard_maybe_admin_setting_disabled( '_ideaboard_topics_per_rss_page' ); ?> />
	<label for="_ideaboard_topics_per_rss_page"><?php esc_html_e( 'per page', 'ideaboard' ); ?></label>

<?php
}

/**
 * Replies per RSS page setting field
 *
 * @since IdeaBoard (r2786)
 *
 * @uses ideaboard_form_option() To output the option value
 */
function ideaboard_admin_setting_callback_replies_per_rss_page() {
?>

	<input name="_ideaboard_replies_per_rss_page" id="_ideaboard_replies_per_rss_page" type="number" min="1" step="1" value="<?php ideaboard_form_option( '_ideaboard_replies_per_rss_page', '25' ); ?>" class="small-text"<?php ideaboard_maybe_admin_setting_disabled( '_ideaboard_replies_per_rss_page' ); ?> />
	<label for="_ideaboard_replies_per_rss_page"><?php esc_html_e( 'per page', 'ideaboard' ); ?></label>

<?php
}

/** Slug Section **************************************************************/

/**
 * Slugs settings section description for the settings page
 *
 * @since IdeaBoard (r2786)
 */
function ideaboard_admin_setting_callback_root_slug_section() {

	// Flush rewrite rules when this section is saved
	if ( isset( $_GET['settings-updated'] ) && isset( $_GET['page'] ) )
		flush_rewrite_rules(); ?>

	<p><?php esc_html_e( 'Customize your Forums root. Partner with a WordPress Page and use Shortcodes for more flexibility.', 'ideaboard' ); ?></p>

<?php
}

/**
 * Root slug setting field
 *
 * @since IdeaBoard (r2786)
 *
 * @uses ideaboard_form_option() To output the option value
 */
function ideaboard_admin_setting_callback_root_slug() {
?>

        <input name="_ideaboard_root_slug" id="_ideaboard_root_slug" type="text" class="regular-text code" value="<?php ideaboard_form_option( '_ideaboard_root_slug', 'forums', true ); ?>"<?php ideaboard_maybe_admin_setting_disabled( '_ideaboard_root_slug' ); ?> />

<?php
	// Slug Check
	ideaboard_form_slug_conflict_check( '_ideaboard_root_slug', 'forums' );
}

/**
 * Include root slug setting field
 *
 * @since IdeaBoard (r2786)
 *
 * @uses checked() To display the checked attribute
 */
function ideaboard_admin_setting_callback_include_root() {
?>

	<input name="_ideaboard_include_root" id="_ideaboard_include_root" type="checkbox" value="1" <?php checked( ideaboard_include_root_slug() ); ideaboard_maybe_admin_setting_disabled( '_ideaboard_include_root' ); ?> />
	<label for="_ideaboard_include_root"><?php esc_html_e( 'Prefix all forum content with the Forum Root slug (Recommended)', 'ideaboard' ); ?></label>

<?php
}

/**
 * Include root slug setting field
 *
 * @since IdeaBoard (r2786)
 *
 * @uses checked() To display the checked attribute
 */
function ideaboard_admin_setting_callback_show_on_root() {

	// Current setting
	$show_on_root = ideaboard_show_on_root();

	// Options for forum root output
	$root_options = array(
		'forums' => array(
			'name' => __( 'Forum Index', 'ideaboard' )
		),
		'topics' => array(
			'name' => __( 'Topics by Freshness', 'ideaboard' )
		)
	); ?>

	<select name="_ideaboard_show_on_root" id="_ideaboard_show_on_root" <?php ideaboard_maybe_admin_setting_disabled( '_ideaboard_show_on_root' ); ?>>

		<?php foreach ( $root_options as $option_id => $details ) : ?>

			<option <?php selected( $show_on_root, $option_id ); ?> value="<?php echo esc_attr( $option_id ); ?>"><?php echo esc_html( $details['name'] ); ?></option>

		<?php endforeach; ?>

	</select>

<?php
}

/** User Slug Section *********************************************************/

/**
 * Slugs settings section description for the settings page
 *
 * @since IdeaBoard (r2786)
 */
function ideaboard_admin_setting_callback_user_slug_section() {
?>

	<p><?php esc_html_e( 'Customize your user profile slugs.', 'ideaboard' ); ?></p>

<?php
}

/**
 * User slug setting field
 *
 * @since IdeaBoard (r2786)
 *
 * @uses ideaboard_form_option() To output the option value
 */
function ideaboard_admin_setting_callback_user_slug() {
?>

	<input name="_ideaboard_user_slug" id="_ideaboard_user_slug" type="text" class="regular-text code" value="<?php ideaboard_form_option( '_ideaboard_user_slug', 'users', true ); ?>"<?php ideaboard_maybe_admin_setting_disabled( '_ideaboard_user_slug' ); ?> />

<?php
	// Slug Check
	ideaboard_form_slug_conflict_check( '_ideaboard_user_slug', 'users' );
}

/**
 * Topic archive slug setting field
 *
 * @since IdeaBoard (r2786)
 *
 * @uses ideaboard_form_option() To output the option value
 */
function ideaboard_admin_setting_callback_topic_archive_slug() {
?>

	<input name="_ideaboard_topic_archive_slug" id="_ideaboard_topic_archive_slug" type="text" class="regular-text code" value="<?php ideaboard_form_option( '_ideaboard_topic_archive_slug', 'topics', true ); ?>"<?php ideaboard_maybe_admin_setting_disabled( '_ideaboard_topic_archive_slug' ); ?> />

<?php
	// Slug Check
	ideaboard_form_slug_conflict_check( '_ideaboard_topic_archive_slug', 'topics' );
}

/**
 * Reply archive slug setting field
 *
 * @since IdeaBoard (r4932)
 *
 * @uses ideaboard_form_option() To output the option value
 */
function ideaboard_admin_setting_callback_reply_archive_slug() {
?>

	<input name="_ideaboard_reply_archive_slug" id="_ideaboard_reply_archive_slug" type="text" class="regular-text code" value="<?php ideaboard_form_option( '_ideaboard_reply_archive_slug', 'replies', true ); ?>"<?php ideaboard_maybe_admin_setting_disabled( '_ideaboard_reply_archive_slug' ); ?> />

<?php
	// Slug Check
	ideaboard_form_slug_conflict_check( '_ideaboard_reply_archive_slug', 'replies' );
}

/**
 * Favorites slug setting field
 *
 * @since IdeaBoard (r4932)
 *
 * @uses ideaboard_form_option() To output the option value
 */
function ideaboard_admin_setting_callback_user_favs_slug() {
?>

	<input name="_ideaboard_user_favs_slug" id="_ideaboard_user_favs_slug" type="text" class="regular-text code" value="<?php ideaboard_form_option( '_ideaboard_user_favs_slug', 'favorites', true ); ?>"<?php ideaboard_maybe_admin_setting_disabled( '_ideaboard_user_favs_slug' ); ?> />

<?php
	// Slug Check
	ideaboard_form_slug_conflict_check( '_ideaboard_reply_archive_slug', 'favorites' );
}

/**
 * Favorites slug setting field
 *
 * @since IdeaBoard (r4932)
 *
 * @uses ideaboard_form_option() To output the option value
 */
function ideaboard_admin_setting_callback_user_subs_slug() {
?>

	<input name="_ideaboard_user_subs_slug" id="_ideaboard_user_subs_slug" type="text" class="regular-text code" value="<?php ideaboard_form_option( '_ideaboard_user_subs_slug', 'subscriptions', true ); ?>"<?php ideaboard_maybe_admin_setting_disabled( '_ideaboard_user_subs_slug' ); ?> />

<?php
	// Slug Check
	ideaboard_form_slug_conflict_check( '_ideaboard_user_subs_slug', 'subscriptions' );
}

/** Single Slugs **************************************************************/

/**
 * Slugs settings section description for the settings page
 *
 * @since IdeaBoard (r2786)
 */
function ideaboard_admin_setting_callback_single_slug_section() {
?>

	<p><?php printf( esc_html__( 'Custom slugs for single forums, topics, replies, tags, views, and search.', 'ideaboard' ), get_admin_url( null, 'options-permalink.php' ) ); ?></p>

<?php
}

/**
 * Forum slug setting field
 *
 * @since IdeaBoard (r2786)
 *
 * @uses ideaboard_form_option() To output the option value
 */
function ideaboard_admin_setting_callback_forum_slug() {
?>

	<input name="_ideaboard_forum_slug" id="_ideaboard_forum_slug" type="text" class="regular-text code" value="<?php ideaboard_form_option( '_ideaboard_forum_slug', 'forum', true ); ?>"<?php ideaboard_maybe_admin_setting_disabled( '_ideaboard_forum_slug' ); ?> />

<?php
	// Slug Check
	ideaboard_form_slug_conflict_check( '_ideaboard_forum_slug', 'forum' );
}

/**
 * Topic slug setting field
 *
 * @since IdeaBoard (r2786)
 *
 * @uses ideaboard_form_option() To output the option value
 */
function ideaboard_admin_setting_callback_topic_slug() {
?>

	<input name="_ideaboard_topic_slug" id="_ideaboard_topic_slug" type="text" class="regular-text code" value="<?php ideaboard_form_option( '_ideaboard_topic_slug', 'topic', true ); ?>"<?php ideaboard_maybe_admin_setting_disabled( '_ideaboard_topic_slug' ); ?> />

<?php
	// Slug Check
	ideaboard_form_slug_conflict_check( '_ideaboard_topic_slug', 'topic' );
}

/**
 * Reply slug setting field
 *
 * @since IdeaBoard (r2786)
 *
 * @uses ideaboard_form_option() To output the option value
 */
function ideaboard_admin_setting_callback_reply_slug() {
?>

	<input name="_ideaboard_reply_slug" id="_ideaboard_reply_slug" type="text" class="regular-text code" value="<?php ideaboard_form_option( '_ideaboard_reply_slug', 'reply', true ); ?>"<?php ideaboard_maybe_admin_setting_disabled( '_ideaboard_reply_slug' ); ?> />

<?php
	// Slug Check
	ideaboard_form_slug_conflict_check( '_ideaboard_reply_slug', 'reply' );
}

/**
 * Topic tag slug setting field
 *
 * @since IdeaBoard (r2786)
 *
 * @uses ideaboard_form_option() To output the option value
 */
function ideaboard_admin_setting_callback_topic_tag_slug() {
?>

	<input name="_ideaboard_topic_tag_slug" id="_ideaboard_topic_tag_slug" type="text" class="regular-text code" value="<?php ideaboard_form_option( '_ideaboard_topic_tag_slug', 'topic-tag', true ); ?>"<?php ideaboard_maybe_admin_setting_disabled( '_ideaboard_topic_tag_slug' ); ?> />

<?php

	// Slug Check
	ideaboard_form_slug_conflict_check( '_ideaboard_topic_tag_slug', 'topic-tag' );
}

/**
 * View slug setting field
 *
 * @since IdeaBoard (r2789)
 *
 * @uses ideaboard_form_option() To output the option value
 */
function ideaboard_admin_setting_callback_view_slug() {
?>

	<input name="_ideaboard_view_slug" id="_ideaboard_view_slug" type="text" class="regular-text code" value="<?php ideaboard_form_option( '_ideaboard_view_slug', 'view', true ); ?>"<?php ideaboard_maybe_admin_setting_disabled( '_ideaboard_view_slug' ); ?> />

<?php
	// Slug Check
	ideaboard_form_slug_conflict_check( '_ideaboard_view_slug', 'view' );
}

/**
 * Search slug setting field
 *
 * @since IdeaBoard (r4579)
 *
 * @uses ideaboard_form_option() To output the option value
 */
function ideaboard_admin_setting_callback_search_slug() {
?>

	<input name="_ideaboard_search_slug" id="_ideaboard_search_slug" type="text" class="regular-text code" value="<?php ideaboard_form_option( '_ideaboard_search_slug', 'search', true ); ?>"<?php ideaboard_maybe_admin_setting_disabled( '_ideaboard_search_slug' ); ?> />

<?php
	// Slug Check
	ideaboard_form_slug_conflict_check( '_ideaboard_search_slug', 'search' );
}

/** BuddyPress ****************************************************************/

/**
 * Extension settings section description for the settings page
 *
 * @since IdeaBoard (r3575)
 */
function ideaboard_admin_setting_callback_buddypress_section() {
?>

	<p><?php esc_html_e( 'Forum settings for BuddyPress', 'ideaboard' ); ?></p>

<?php
}

/**
 * Allow BuddyPress group forums setting field
 *
 * @since IdeaBoard (r3575)
 *
 * @uses checked() To display the checked attribute
 */
function ideaboard_admin_setting_callback_group_forums() {
?>

	<input name="_ideaboard_enable_group_forums" id="_ideaboard_enable_group_forums" type="checkbox" value="1" <?php checked( ideaboard_is_group_forums_active( true ) );  ideaboard_maybe_admin_setting_disabled( '_ideaboard_enable_group_forums' ); ?> />
	<label for="_ideaboard_enable_group_forums"><?php esc_html_e( 'Allow BuddyPress Groups to have their own forums', 'ideaboard' ); ?></label>

<?php
}

/**
 * Replies per page setting field
 *
 * @since IdeaBoard (r3575)
 *
 * @uses ideaboard_form_option() To output the option value
 */
function ideaboard_admin_setting_callback_group_forums_root_id() {

	// Output the dropdown for all forums
	ideaboard_dropdown( array(
		'selected'           => ideaboard_get_group_forums_root_id(),
		'show_none'          => __( '&mdash; Forum root &mdash;', 'ideaboard' ),
		'orderby'            => 'title',
		'order'              => 'ASC',
		'select_id'          => '_ideaboard_group_forums_root_id',
		'disable_categories' => false,
		'disabled'           => '_ideaboard_group_forums_root_id'
	) ); ?>

	<label for="_ideaboard_group_forums_root_id"><?php esc_html_e( 'is the parent for all group forums', 'ideaboard' ); ?></label>
	<p class="description"><?php esc_html_e( 'Using the Forum Root is not recommended. Changing this does not move existing forums.', 'ideaboard' ); ?></p>

<?php
}

/** Akismet *******************************************************************/

/**
 * Extension settings section description for the settings page
 *
 * @since IdeaBoard (r3575)
 */
function ideaboard_admin_setting_callback_akismet_section() {
?>

	<p><?php esc_html_e( 'Forum settings for Akismet', 'ideaboard' ); ?></p>

<?php
}


/**
 * Allow Akismet setting field
 *
 * @since IdeaBoard (r3575)
 *
 * @uses checked() To display the checked attribute
 */
function ideaboard_admin_setting_callback_akismet() {
?>

	<input name="_ideaboard_enable_akismet" id="_ideaboard_enable_akismet" type="checkbox" value="1" <?php checked( ideaboard_is_akismet_active( true ) );  ideaboard_maybe_admin_setting_disabled( '_ideaboard_enable_akismet' ); ?> />
	<label for="_ideaboard_enable_akismet"><?php esc_html_e( 'Allow Akismet to actively prevent forum spam.', 'ideaboard' ); ?></label>

<?php
}

/** Settings Page *************************************************************/

/**
 * The main settings page
 *
 * @since IdeaBoard (r2643)
 *
 * @uses screen_icon() To display the screen icon
 * @uses settings_fields() To output the hidden fields for the form
 * @uses do_settings_sections() To output the settings sections
 */
function ideaboard_admin_settings() {
?>

	<div class="wrap">

		<?php screen_icon(); ?>

		<h2><?php esc_html_e( 'Forums Settings', 'ideaboard' ) ?></h2>

		<form action="options.php" method="post">

			<?php settings_fields( 'ideaboard' ); ?>

			<?php do_settings_sections( 'ideaboard' ); ?>

			<p class="submit">
				<input type="submit" name="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'ideaboard' ); ?>" />
			</p>
		</form>
	</div>

<?php
}


/** Converter Section *********************************************************/

/**
 * Main settings section description for the settings page
 *
 * @since IdeaBoard (r3813)
 */
function ideaboard_converter_setting_callback_main_section() {
?>

	<p><?php _e( 'Information about your previous forums database so that they can be converted. <strong>Backup your database before proceeding.</strong>', 'ideaboard' ); ?></p>

<?php
}

/**
 * Edit Platform setting field
 *
 * @since IdeaBoard (r3813)
 */
function ideaboard_converter_setting_callback_platform() {

	$platform_options = '';
	$curdir           = opendir( ideaboard()->admin->admin_dir . 'converters/' );

	// Bail if no directory was found (how did this happen?)
	if ( empty( $curdir ) )
		return;

	// Loop through files in the converters folder and assemble some options
	while ( $file = readdir( $curdir ) ) {
		if ( ( stristr( $file, '.php' ) ) && ( stristr( $file, 'index' ) === false ) ) {
			$file              = preg_replace( '/.php/', '', $file );
			$platform_options .= '<option value="' . $file . '">' . esc_html( $file ) . '</option>';
		}
	}

	closedir( $curdir ); ?>

	<select name="_ideaboard_converter_platform" id="_ideaboard_converter_platform" /><?php echo $platform_options ?></select>
	<label for="_ideaboard_converter_platform"><?php esc_html_e( 'is the previous forum software', 'ideaboard' ); ?></label>

<?php
}

/**
 * Edit Database Server setting field
 *
 * @since IdeaBoard (r3813)
 */
function ideaboard_converter_setting_callback_dbserver() {
?>

	<input name="_ideaboard_converter_db_server" id="_ideaboard_converter_db_server" type="text" value="<?php ideaboard_form_option( '_ideaboard_converter_db_server', 'localhost' ); ?>" class="medium-text" />
	<label for="_ideaboard_converter_db_server"><?php esc_html_e( 'IP or hostname', 'ideaboard' ); ?></label>

<?php
}

/**
 * Edit Database Server Port setting field
 *
 * @since IdeaBoard (r3813)
 */
function ideaboard_converter_setting_callback_dbport() {
?>

	<input name="_ideaboard_converter_db_port" id="_ideaboard_converter_db_port" type="text" value="<?php ideaboard_form_option( '_ideaboard_converter_db_port', '3306' ); ?>" class="small-text" />
	<label for="_ideaboard_converter_db_port"><?php esc_html_e( 'Use default 3306 if unsure', 'ideaboard' ); ?></label>

<?php
}

/**
 * Edit Database User setting field
 *
 * @since IdeaBoard (r3813)
 */
function ideaboard_converter_setting_callback_dbuser() {
?>

	<input name="_ideaboard_converter_db_user" id="_ideaboard_converter_db_user" type="text" value="<?php ideaboard_form_option( '_ideaboard_converter_db_user' ); ?>" class="medium-text" />
	<label for="_ideaboard_converter_db_user"><?php esc_html_e( 'User for your database connection', 'ideaboard' ); ?></label>

<?php
}

/**
 * Edit Database Pass setting field
 *
 * @since IdeaBoard (r3813)
 */
function ideaboard_converter_setting_callback_dbpass() {
?>

	<input name="_ideaboard_converter_db_pass" id="_ideaboard_converter_db_pass" type="password" value="<?php ideaboard_form_option( '_ideaboard_converter_db_pass' ); ?>" class="medium-text" />
	<label for="_ideaboard_converter_db_pass"><?php esc_html_e( 'Password to access the database', 'ideaboard' ); ?></label>

<?php
}

/**
 * Edit Database Name setting field
 *
 * @since IdeaBoard (r3813)
 */
function ideaboard_converter_setting_callback_dbname() {
?>

	<input name="_ideaboard_converter_db_name" id="_ideaboard_converter_db_name" type="text" value="<?php ideaboard_form_option( '_ideaboard_converter_db_name' ); ?>" class="medium-text" />
	<label for="_ideaboard_converter_db_name"><?php esc_html_e( 'Name of the database with your old forum data', 'ideaboard' ); ?></label>

<?php
}

/**
 * Main settings section description for the settings page
 *
 * @since IdeaBoard (r3813)
 */
function ideaboard_converter_setting_callback_options_section() {
?>

	<p><?php esc_html_e( 'Some optional parameters to help tune the conversion process.', 'ideaboard' ); ?></p>

<?php
}

/**
 * Edit Table Prefix setting field
 *
 * @since IdeaBoard (r3813)
 */
function ideaboard_converter_setting_callback_dbprefix() {
?>

	<input name="_ideaboard_converter_db_prefix" id="_ideaboard_converter_db_prefix" type="text" value="<?php ideaboard_form_option( '_ideaboard_converter_db_prefix' ); ?>" class="medium-text" />
	<label for="_ideaboard_converter_db_prefix"><?php esc_html_e( '(If converting from BuddyPress Forums, use "wp_bb_" or your custom prefix)', 'ideaboard' ); ?></label>

<?php
}

/**
 * Edit Rows Limit setting field
 *
 * @since IdeaBoard (r3813)
 */
function ideaboard_converter_setting_callback_rows() {
?>

	<input name="_ideaboard_converter_rows" id="_ideaboard_converter_rows" type="text" value="<?php ideaboard_form_option( '_ideaboard_converter_rows', '100' ); ?>" class="small-text" />
	<label for="_ideaboard_converter_rows"><?php esc_html_e( 'rows to process at a time', 'ideaboard' ); ?></label>
	<p class="description"><?php esc_html_e( 'Keep this low if you experience out-of-memory issues.', 'ideaboard' ); ?></p>

<?php
}

/**
 * Edit Delay Time setting field
 *
 * @since IdeaBoard (r3813)
 */
function ideaboard_converter_setting_callback_delay_time() {
?>

	<input name="_ideaboard_converter_delay_time" id="_ideaboard_converter_delay_time" type="text" value="<?php ideaboard_form_option( '_ideaboard_converter_delay_time', '1' ); ?>" class="small-text" />
	<label for="_ideaboard_converter_delay_time"><?php esc_html_e( 'second(s) delay between each group of rows', 'ideaboard' ); ?></label>
	<p class="description"><?php esc_html_e( 'Keep this high to prevent too-many-connection issues.', 'ideaboard' ); ?></p>

<?php
}

/**
 * Edit Restart setting field
 *
 * @since IdeaBoard (r3813)
 */
function ideaboard_converter_setting_callback_restart() {
?>

	<input name="_ideaboard_converter_restart" id="_ideaboard_converter_restart" type="checkbox" value="1" <?php checked( get_option( '_ideaboard_converter_restart', false ) ); ?> />
	<label for="_ideaboard_converter_restart"><?php esc_html_e( 'Start a fresh conversion from the beginning', 'ideaboard' ); ?></label>
	<p class="description"><?php esc_html_e( 'You should clean old conversion information before starting over.', 'ideaboard' ); ?></p>

<?php
}

/**
 * Edit Clean setting field
 *
 * @since IdeaBoard (r3813)
 */
function ideaboard_converter_setting_callback_clean() {
?>

	<input name="_ideaboard_converter_clean" id="_ideaboard_converter_clean" type="checkbox" value="1" <?php checked( get_option( '_ideaboard_converter_clean', false ) ); ?> />
	<label for="_ideaboard_converter_clean"><?php esc_html_e( 'Purge all information from a previously attempted import', 'ideaboard' ); ?></label>
	<p class="description"><?php esc_html_e( 'Use this if an import failed and you want to remove that incomplete data.', 'ideaboard' ); ?></p>

<?php
}

/**
 * Edit Convert Users setting field
 *
 * @since IdeaBoard (r3813)
 */
function ideaboard_converter_setting_callback_convert_users() {
?>

	<input name="_ideaboard_converter_convert_users" id="_ideaboard_converter_convert_users" type="checkbox" value="1" <?php checked( get_option( '_ideaboard_converter_convert_users', false ) ); ?> />
	<label for="_ideaboard_converter_convert_users"><?php esc_html_e( 'Attempt to import user accounts from previous forums', 'ideaboard' ); ?></label>
	<p class="description"><?php esc_html_e( 'Non-IdeaBoard passwords cannot be automatically converted. They will be converted as each user logs in.', 'ideaboard' ); ?></p>

<?php
}

/** Converter Page ************************************************************/

/**
 * The main settings page
 *
 * @uses screen_icon() To display the screen icon
 * @uses settings_fields() To output the hidden fields for the form
 * @uses do_settings_sections() To output the settings sections
 */
function ideaboard_converter_settings() {
?>

	<div class="wrap">

		<?php screen_icon( 'tools' ); ?>

		<h2 class="nav-tab-wrapper"><?php ideaboard_tools_admin_tabs( esc_html__( 'Import Forums', 'ideaboard' ) ); ?></h2>

		<form action="#" method="post" id="ideaboard-converter-settings">

			<?php settings_fields( 'ideaboard_converter' ); ?>

			<?php do_settings_sections( 'ideaboard_converter' ); ?>

			<p class="submit">
				<input type="button" name="submit" class="button-primary" id="ideaboard-converter-start" value="<?php esc_attr_e( 'Start', 'ideaboard' ); ?>" onclick="bbconverter_start();" />
				<input type="button" name="submit" class="button-primary" id="ideaboard-converter-stop" value="<?php esc_attr_e( 'Stop', 'ideaboard' ); ?>" onclick="bbconverter_stop();" />
				<img id="ideaboard-converter-progress" src="">
			</p>

			<div class="ideaboard-converter-updated" id="ideaboard-converter-message"></div>
		</form>
	</div>

<?php
}

/** Helpers *******************************************************************/

/**
 * Contextual help for Forums settings page
 *
 * @since IdeaBoard (r3119)
 * @uses get_current_screen()
 */
function ideaboard_admin_settings_help() {

	$current_screen = get_current_screen();

	// Bail if current screen could not be found
	if ( empty( $current_screen ) )
		return;

	// Overview
	$current_screen->add_help_tab( array(
		'id'      => 'overview',
		'title'   => __( 'Overview', 'ideaboard' ),
		'content' => '<p>' . __( 'This screen provides access to all of the Forums settings.',                          'ideaboard' ) . '</p>' .
					 '<p>' . __( 'Please see the additional help tabs for more information on each indiviual section.', 'ideaboard' ) . '</p>'
	) );

	// Main Settings
	$current_screen->add_help_tab( array(
		'id'      => 'main_settings',
		'title'   => __( 'Main Settings', 'ideaboard' ),
		'content' => '<p>' . __( 'In the Main Settings you have a number of options:', 'ideaboard' ) . '</p>' .
					 '<p>' .
						'<ul>' .
							'<li>' . __( 'You can choose to lock a post after a certain number of minutes. "Locking post editing" will prevent the author from editing some amount of time after saving a post.',              'ideaboard' ) . '</li>' .
							'<li>' . __( '"Throttle time" is the amount of time required between posts from a single author. The higher the throttle time, the longer a user will need to wait between posting to the forum.', 'ideaboard' ) . '</li>' .
							'<li>' . __( 'Favorites are a way for users to save and later return to topics they favor. This is enabled by default.',                                                                           'ideaboard' ) . '</li>' .
							'<li>' . __( 'Subscriptions allow users to subscribe for notifications to topics that interest them. This is enabled by default.',                                                                 'ideaboard' ) . '</li>' .
							'<li>' . __( 'Topic-Tags allow users to filter topics between forums. This is enabled by default.',                                                                                                'ideaboard' ) . '</li>' .
							'<li>' . __( '"Anonymous Posting" allows guest users who do not have accounts on your site to both create topics as well as replies.',                                                             'ideaboard' ) . '</li>' .
							'<li>' . __( 'The Fancy Editor brings the luxury of the Visual editor and HTML editor from the traditional WordPress dashboard into your theme.',                                                  'ideaboard' ) . '</li>' .
							'<li>' . __( 'Auto-embed will embed the media content from a URL directly into the replies. For example: links to Flickr and YouTube.',                                                            'ideaboard' ) . '</li>' .
						'</ul>' .
					'</p>' .
					'<p>' . __( 'You must click the Save Changes button at the bottom of the screen for new settings to take effect.', 'ideaboard' ) . '</p>'
	) );

	// Per Page
	$current_screen->add_help_tab( array(
		'id'      => 'per_page',
		'title'   => __( 'Per Page', 'ideaboard' ),
		'content' => '<p>' . __( 'Per Page settings allow you to control the number of topics and replies appear on each page.',                                                    'ideaboard' ) . '</p>' .
					 '<p>' . __( 'This is comparable to the WordPress "Reading Settings" page, where you can set the number of posts that should show on blog pages and in feeds.', 'ideaboard' ) . '</p>' .
					 '<p>' . __( 'These are broken up into two separate groups: one for what appears in your theme, another for RSS feeds.',                                        'ideaboard' ) . '</p>'
	) );

	// Slugs
	$current_screen->add_help_tab( array(
		'id'      => 'slus',
		'title'   => __( 'Slugs', 'ideaboard' ),
		'content' => '<p>' . __( 'The Slugs section allows you to control the permalink structure for your forums.',                                                                                                            'ideaboard' ) . '</p>' .
					 '<p>' . __( '"Archive Slugs" are used as the "root" for your forums and topics. If you combine these values with existing page slugs, IdeaBoard will attempt to output the most correct title and content.', 'ideaboard' ) . '</p>' .
					 '<p>' . __( '"Single Slugs" are used as a prefix when viewing an individual forum, topic, reply, user, or view.',                                                                                          'ideaboard' ) . '</p>' .
					 '<p>' . __( 'In the event of a slug collision with WordPress or BuddyPress, a warning will appear next to the problem slug(s).', 'ideaboard' ) . '</p>'
	) );

	// Help Sidebar
	$current_screen->set_help_sidebar(
		'<p><strong>' . __( 'For more information:', 'ideaboard' ) . '</strong></p>' .
		'<p>' . __( '<a href="http://codex.ideaboard.org" target="_blank">IdeaBoard Documentation</a>',    'ideaboard' ) . '</p>' .
		'<p>' . __( '<a href="http://ideaboard.org/forums/" target="_blank">IdeaBoard Support Forums</a>', 'ideaboard' ) . '</p>'
	);
}

/**
 * Disable a settings field if the value is forcibly set in IdeaBoard's global
 * options array.
 *
 * @since IdeaBoard (r4347)
 *
 * @param string $option_key
 */
function ideaboard_maybe_admin_setting_disabled( $option_key = '' ) {
	disabled( isset( ideaboard()->options[$option_key] ) );
}

/**
 * Output settings API option
 *
 * @since IdeaBoard (r3203)
 *
 * @uses ideaboard_get_ideaboard_form_option()
 *
 * @param string $option
 * @param string $default
 * @param bool $slug
 */
function ideaboard_form_option( $option, $default = '' , $slug = false ) {
	echo ideaboard_get_form_option( $option, $default, $slug );
}
	/**
	 * Return settings API option
	 *
	 * @since IdeaBoard (r3203)
	 *
	 * @uses get_option()
	 * @uses esc_attr()
	 * @uses apply_filters()
	 *
	 * @param string $option
	 * @param string $default
	 * @param bool $slug
	 */
	function ideaboard_get_form_option( $option, $default = '', $slug = false ) {

		// Get the option and sanitize it
		$value = get_option( $option, $default );

		// Slug?
		if ( true === $slug ) {
			$value = esc_attr( apply_filters( 'editable_slug', $value ) );

		// Not a slug
		} else {
			$value = esc_attr( $value );
		}

		// Fallback to default
		if ( empty( $value ) )
			$value = $default;

		// Allow plugins to further filter the output
		return apply_filters( 'ideaboard_get_form_option', $value, $option );
	}

/**
 * Used to check if a IdeaBoard slug conflicts with an existing known slug.
 *
 * @since IdeaBoard (r3306)
 *
 * @param string $slug
 * @param string $default
 *
 * @uses ideaboard_get_form_option() To get a sanitized slug string
 */
function ideaboard_form_slug_conflict_check( $slug, $default ) {

	// Only set the slugs once ver page load
	static $the_core_slugs = array();

	// Get the form value
	$this_slug = ideaboard_get_form_option( $slug, $default, true );

	if ( empty( $the_core_slugs ) ) {

		// Slugs to check
		$core_slugs = apply_filters( 'ideaboard_slug_conflict_check', array(

			/** WordPress Core ****************************************************/

			// Core Post Types
			'post_base'       => array( 'name' => __( 'Posts',         'ideaboard' ), 'default' => 'post',          'context' => 'WordPress' ),
			'page_base'       => array( 'name' => __( 'Pages',         'ideaboard' ), 'default' => 'page',          'context' => 'WordPress' ),
			'revision_base'   => array( 'name' => __( 'Revisions',     'ideaboard' ), 'default' => 'revision',      'context' => 'WordPress' ),
			'attachment_base' => array( 'name' => __( 'Attachments',   'ideaboard' ), 'default' => 'attachment',    'context' => 'WordPress' ),
			'nav_menu_base'   => array( 'name' => __( 'Menus',         'ideaboard' ), 'default' => 'nav_menu_item', 'context' => 'WordPress' ),

			// Post Tags
			'tag_base'        => array( 'name' => __( 'Tag base',      'ideaboard' ), 'default' => 'tag',           'context' => 'WordPress' ),

			// Post Categories
			'category_base'   => array( 'name' => __( 'Category base', 'ideaboard' ), 'default' => 'category',      'context' => 'WordPress' ),

			/** IdeaBoard Core ******************************************************/

			// Forum archive slug
			'_ideaboard_root_slug'          => array( 'name' => __( 'Forums base', 'ideaboard' ), 'default' => 'forums', 'context' => 'IdeaBoard' ),

			// Topic archive slug
			'_ideaboard_topic_archive_slug' => array( 'name' => __( 'Topics base', 'ideaboard' ), 'default' => 'topics', 'context' => 'IdeaBoard' ),

			// Forum slug
			'_ideaboard_forum_slug'         => array( 'name' => __( 'Forum slug',  'ideaboard' ), 'default' => 'forum',  'context' => 'IdeaBoard' ),

			// Topic slug
			'_ideaboard_topic_slug'         => array( 'name' => __( 'Topic slug',  'ideaboard' ), 'default' => 'topic',  'context' => 'IdeaBoard' ),

			// Reply slug
			'_ideaboard_reply_slug'         => array( 'name' => __( 'Reply slug',  'ideaboard' ), 'default' => 'reply',  'context' => 'IdeaBoard' ),

			// User profile slug
			'_ideaboard_user_slug'          => array( 'name' => __( 'User base',   'ideaboard' ), 'default' => 'users',  'context' => 'IdeaBoard' ),

			// View slug
			'_ideaboard_view_slug'          => array( 'name' => __( 'View base',   'ideaboard' ), 'default' => 'view',   'context' => 'IdeaBoard' ),

			// Topic tag slug
			'_ideaboard_topic_tag_slug'     => array( 'name' => __( 'Topic tag slug', 'ideaboard' ), 'default' => 'topic-tag', 'context' => 'IdeaBoard' ),
		) );

		/** BuddyPress Core *******************************************************/

		if ( defined( 'BP_VERSION' ) ) {
			$bp = buddypress();

			// Loop through root slugs and check for conflict
			if ( !empty( $bp->pages ) ) {
				foreach ( $bp->pages as $page => $page_data ) {
					$page_base    = $page . '_base';
					$page_title   = sprintf( __( '%s page', 'ideaboard' ), $page_data->title );
					$core_slugs[$page_base] = array( 'name' => $page_title, 'default' => $page_data->slug, 'context' => 'BuddyPress' );
				}
			}
		}

		// Set the static
		$the_core_slugs = apply_filters( 'ideaboard_slug_conflict', $core_slugs );
	}

	// Loop through slugs to check
	foreach ( $the_core_slugs as $key => $value ) {

		// Get the slug
		$slug_check = ideaboard_get_form_option( $key, $value['default'], true );

		// Compare
		if ( ( $slug !== $key ) && ( $slug_check === $this_slug ) ) : ?>

			<span class="attention"><?php printf( esc_html__( 'Possible %1$s conflict: %2$s', 'ideaboard' ), $value['context'], '<strong>' . $value['name'] . '</strong>' ); ?></span>

		<?php endif;
	}
}
