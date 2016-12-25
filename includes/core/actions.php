<?php

/**
 * IdeaBoard Actions
 *
 * @package IdeaBoard
 * @subpackage Core
 *
 * This file contains the actions that are used through-out IdeaBoard. They are
 * consolidated here to make searching for them easier, and to help developers
 * understand at a glance the order in which things occur.
 *
 * There are a few common places that additional actions can currently be found
 *
 *  - IdeaBoard: In {@link IdeaBoard::setup_actions()} in ideaboard.php
 *  - Admin: More in {@link BBP_Admin::setup_actions()} in admin.php
 *
 * @see /core/filters.php
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
 *           v--WordPress Actions        v--IdeaBoard Sub-actions
 */
add_action( 'plugins_loaded',           'ideaboard_loaded',                 10    );
add_action( 'init',                     'ideaboard_init',                   0     ); // Early for ideaboard_register
add_action( 'parse_query',              'ideaboard_parse_query',            2     ); // Early for overrides
add_action( 'widgets_init',             'ideaboard_widgets_init',           10    );
add_action( 'generate_rewrite_rules',   'ideaboard_generate_rewrite_rules', 10    );
add_action( 'wp_enqueue_scripts',       'ideaboard_enqueue_scripts',        10    );
add_action( 'wp_head',                  'ideaboard_head',                   10    );
add_action( 'wp_footer',                'ideaboard_footer',                 10    );
add_action( 'wp_roles_init',            'ideaboard_roles_init',             10    );
add_action( 'set_current_user',         'ideaboard_setup_current_user',     10    );
add_action( 'setup_theme',              'ideaboard_setup_theme',            10    );
add_action( 'after_setup_theme',        'ideaboard_after_setup_theme',      10    );
add_action( 'template_redirect',        'ideaboard_template_redirect',      8     ); // Before BuddyPress's 10 [BB2225]
add_action( 'login_form_login',         'ideaboard_login_form_login',       10    );
add_action( 'profile_update',           'ideaboard_profile_update',         10, 2 ); // user_id and old_user_data
add_action( 'user_register',            'ideaboard_user_register',          10    );

/**
 * ideaboard_loaded - Attached to 'plugins_loaded' above
 *
 * Attach various loader actions to the ideaboard_loaded action.
 * The load order helps to execute code at the correct time.
 *                                                         v---Load order
 */
add_action( 'ideaboard_loaded', 'ideaboard_constants',                 2  );
add_action( 'ideaboard_loaded', 'ideaboard_boot_strap_globals',        4  );
add_action( 'ideaboard_loaded', 'ideaboard_includes',                  6  );
add_action( 'ideaboard_loaded', 'ideaboard_setup_globals',             8  );
add_action( 'ideaboard_loaded', 'ideaboard_setup_option_filters',      10 );
add_action( 'ideaboard_loaded', 'ideaboard_setup_user_option_filters', 12 );
add_action( 'ideaboard_loaded', 'ideaboard_register_theme_packages',   14 );
add_action( 'ideaboard_loaded', 'ideaboard_filter_user_roles_option',  16 );

/**
 * ideaboard_init - Attached to 'init' above
 *
 * Attach various initialization actions to the init action.
 * The load order helps to execute code at the correct time.
 *                                               v---Load order
 */
add_action( 'ideaboard_init', 'ideaboard_load_textdomain',   0   );
add_action( 'ideaboard_init', 'ideaboard_register',          0   );
add_action( 'ideaboard_init', 'ideaboard_add_rewrite_tags',  20  );
add_action( 'ideaboard_init', 'ideaboard_add_rewrite_rules', 30  );
add_action( 'ideaboard_init', 'ideaboard_add_permastructs',  40  );
add_action( 'ideaboard_init', 'ideaboard_ready',             999 );

/**
 * ideaboard_roles_init - Attached to 'wp_roles_init' above
 */
add_action( 'ideaboard_roles_init', 'ideaboard_add_forums_roles', 1 );

/**
 * When setting up the current user, make sure they have a role for the forums.
 *
 * This is multisite aware, thanks to ideaboard_filter_user_roles_option(), hooked to
 * the 'ideaboard_loaded' action above.
 */
add_action( 'ideaboard_setup_current_user', 'ideaboard_set_current_user_default_role' );

/**
 * ideaboard_register - Attached to 'init' above on 0 priority
 *
 * Attach various initialization actions early to the init action.
 * The load order helps to execute code at the correct time.
 *                                                         v---Load order
 */
add_action( 'ideaboard_register', 'ideaboard_register_post_types',     2  );
add_action( 'ideaboard_register', 'ideaboard_register_post_statuses',  4  );
add_action( 'ideaboard_register', 'ideaboard_register_taxonomies',     6  );
add_action( 'ideaboard_register', 'ideaboard_register_views',          8  );
add_action( 'ideaboard_register', 'ideaboard_register_shortcodes',     10 );

// Autoembeds
add_action( 'ideaboard_init', 'ideaboard_reply_content_autoembed', 8 );
add_action( 'ideaboard_init', 'ideaboard_topic_content_autoembed', 8 );

/**
 * ideaboard_ready - attached to end 'ideaboard_init' above
 *
 * Attach actions to the ready action after IdeaBoard has fully initialized.
 * The load order helps to execute code at the correct time.
 *                                                v---Load order
 */
add_action( 'ideaboard_ready',  'ideaboard_setup_akismet',    2  ); // Spam prevention for topics and replies
add_action( 'bp_include', 'ideaboard_setup_buddypress', 10 ); // Social network integration

// Try to load the ideaboard-functions.php file from the active themes
add_action( 'ideaboard_after_setup_theme', 'ideaboard_load_theme_functions', 10 );

// Widgets
add_action( 'ideaboard_widgets_init', array( 'BBP_Login_Widget',   'register_widget' ), 10 );
add_action( 'ideaboard_widgets_init', array( 'BBP_Views_Widget',   'register_widget' ), 10 );
add_action( 'ideaboard_widgets_init', array( 'BBP_Search_Widget',  'register_widget' ), 10 );
add_action( 'ideaboard_widgets_init', array( 'BBP_Forums_Widget',  'register_widget' ), 10 );
add_action( 'ideaboard_widgets_init', array( 'BBP_Topics_Widget',  'register_widget' ), 10 );
add_action( 'ideaboard_widgets_init', array( 'BBP_Replies_Widget', 'register_widget' ), 10 );
add_action( 'ideaboard_widgets_init', array( 'BBP_Stats_Widget',   'register_widget' ), 10 );

// Notices (loaded after ideaboard_init for translations)
add_action( 'ideaboard_head',             'ideaboard_login_notices'    );
add_action( 'ideaboard_head',             'ideaboard_topic_notices'    );
add_action( 'ideaboard_template_notices', 'ideaboard_template_notices' );

// Always exclude private/hidden forums if needed
add_action( 'pre_get_posts', 'ideaboard_pre_get_posts_normalize_forum_visibility', 4 );

// Profile Page Messages
add_action( 'ideaboard_template_notices', 'ideaboard_notice_edit_user_success'           );
add_action( 'ideaboard_template_notices', 'ideaboard_notice_edit_user_is_super_admin', 2 );

// Before Delete/Trash/Untrash Topic
add_action( 'wp_trash_post', 'ideaboard_trash_forum'   );
add_action( 'trash_post',    'ideaboard_trash_forum'   );
add_action( 'untrash_post',  'ideaboard_untrash_forum' );
add_action( 'delete_post',   'ideaboard_delete_forum'  );

// After Deleted/Trashed/Untrashed Topic
add_action( 'trashed_post',   'ideaboard_trashed_forum'   );
add_action( 'untrashed_post', 'ideaboard_untrashed_forum' );
add_action( 'deleted_post',   'ideaboard_deleted_forum'   );

// Auto trash/untrash/delete a forums topics
add_action( 'ideaboard_delete_forum',  'ideaboard_delete_forum_topics',  10 );
add_action( 'ideaboard_trash_forum',   'ideaboard_trash_forum_topics',   10 );
add_action( 'ideaboard_untrash_forum', 'ideaboard_untrash_forum_topics', 10 );

// New/Edit Forum
add_action( 'ideaboard_new_forum',  'ideaboard_update_forum', 10 );
add_action( 'ideaboard_edit_forum', 'ideaboard_update_forum', 10 );

// Save forum extra metadata
add_action( 'ideaboard_new_forum_post_extras',         'ideaboard_save_forum_extras', 2 );
add_action( 'ideaboard_edit_forum_post_extras',        'ideaboard_save_forum_extras', 2 );
add_action( 'ideaboard_forum_attributes_metabox_save', 'ideaboard_save_forum_extras', 2 );

// New/Edit Reply
add_action( 'ideaboard_new_reply',  'ideaboard_update_reply', 10, 7 );
add_action( 'ideaboard_edit_reply', 'ideaboard_update_reply', 10, 7 );

// Before Delete/Trash/Untrash Reply
add_action( 'wp_trash_post', 'ideaboard_trash_reply'   );
add_action( 'trash_post',    'ideaboard_trash_reply'   );
add_action( 'untrash_post',  'ideaboard_untrash_reply' );
add_action( 'delete_post',   'ideaboard_delete_reply'  );

// After Deleted/Trashed/Untrashed Reply
add_action( 'trashed_post',   'ideaboard_trashed_reply'   );
add_action( 'untrashed_post', 'ideaboard_untrashed_reply' );
add_action( 'deleted_post',   'ideaboard_deleted_reply'   );

// New/Edit Topic
add_action( 'ideaboard_new_topic',  'ideaboard_update_topic', 10, 5 );
add_action( 'ideaboard_edit_topic', 'ideaboard_update_topic', 10, 5 );

// Split/Merge Topic
add_action( 'ideaboard_merged_topic',     'ideaboard_merge_topic_count', 1, 3 );
add_action( 'ideaboard_post_split_topic', 'ideaboard_split_topic_count', 1, 3 );

// Move Reply
add_action( 'ideaboard_post_move_reply', 'ideaboard_move_reply_count', 1, 3 );

// Before Delete/Trash/Untrash Topic
add_action( 'wp_trash_post', 'ideaboard_trash_topic'   );
add_action( 'trash_post',    'ideaboard_trash_topic'   );
add_action( 'untrash_post',  'ideaboard_untrash_topic' );
add_action( 'delete_post',   'ideaboard_delete_topic'  );

// After Deleted/Trashed/Untrashed Topic
add_action( 'trashed_post',   'ideaboard_trashed_topic'   );
add_action( 'untrashed_post', 'ideaboard_untrashed_topic' );
add_action( 'deleted_post',   'ideaboard_deleted_topic'   );

// Favorites
add_action( 'ideaboard_trash_topic',  'ideaboard_remove_topic_from_all_favorites' );
add_action( 'ideaboard_delete_topic', 'ideaboard_remove_topic_from_all_favorites' );

// Subscriptions
add_action( 'ideaboard_trash_topic',  'ideaboard_remove_topic_from_all_subscriptions'       );
add_action( 'ideaboard_delete_topic', 'ideaboard_remove_topic_from_all_subscriptions'       );
add_action( 'ideaboard_trash_forum',  'ideaboard_remove_forum_from_all_subscriptions'       );
add_action( 'ideaboard_delete_forum', 'ideaboard_remove_forum_from_all_subscriptions'       );
add_action( 'ideaboard_new_reply',    'ideaboard_notify_topic_subscribers',           11, 5 );
add_action( 'ideaboard_new_topic',    'ideaboard_notify_forum_subscribers',           11, 4 );

// Sticky
add_action( 'ideaboard_trash_topic',  'ideaboard_unstick_topic' );
add_action( 'ideaboard_delete_topic', 'ideaboard_unstick_topic' );

// Update topic branch
add_action( 'ideaboard_trashed_topic',   'ideaboard_update_topic_walker' );
add_action( 'ideaboard_untrashed_topic', 'ideaboard_update_topic_walker' );
add_action( 'ideaboard_deleted_topic',   'ideaboard_update_topic_walker' );
add_action( 'ideaboard_spammed_topic',   'ideaboard_update_topic_walker' );
add_action( 'ideaboard_unspammed_topic', 'ideaboard_update_topic_walker' );

// Update reply branch
add_action( 'ideaboard_trashed_reply',   'ideaboard_update_reply_walker' );
add_action( 'ideaboard_untrashed_reply', 'ideaboard_update_reply_walker' );
add_action( 'ideaboard_deleted_reply',   'ideaboard_update_reply_walker' );
add_action( 'ideaboard_spammed_reply',   'ideaboard_update_reply_walker' );
add_action( 'ideaboard_unspammed_reply', 'ideaboard_update_reply_walker' );

// User status
// @todo make these sub-actions
add_action( 'make_ham_user',  'ideaboard_make_ham_user'  );
add_action( 'make_spam_user', 'ideaboard_make_spam_user' );

// User role
add_action( 'ideaboard_profile_update', 'ideaboard_profile_update_role' );

// Hook WordPress admin actions to IdeaBoard profiles on save
add_action( 'ideaboard_user_edit_after', 'ideaboard_user_edit_after' );

// Caches
add_action( 'ideaboard_new_forum_pre_extras',  'ideaboard_clean_post_cache' );
add_action( 'ideaboard_new_forum_post_extras', 'ideaboard_clean_post_cache' );
add_action( 'ideaboard_new_topic_pre_extras',  'ideaboard_clean_post_cache' );
add_action( 'ideaboard_new_topic_post_extras', 'ideaboard_clean_post_cache' );
add_action( 'ideaboard_new_reply_pre_extras',  'ideaboard_clean_post_cache' );
add_action( 'ideaboard_new_reply_post_extras', 'ideaboard_clean_post_cache' );

/**
 * IdeaBoard needs to redirect the user around in a few different circumstances:
 *
 * 1. POST and GET requests
 * 2. Accessing private or hidden content (forums/topics/replies)
 * 3. Editing forums, topics, replies, users, and tags
 * 4. IdeaBoard specific AJAX requests
 */
add_action( 'ideaboard_template_redirect', 'ideaboard_forum_enforce_blocked', 1  );
add_action( 'ideaboard_template_redirect', 'ideaboard_forum_enforce_hidden',  1  );
add_action( 'ideaboard_template_redirect', 'ideaboard_forum_enforce_private', 1  );
add_action( 'ideaboard_template_redirect', 'ideaboard_post_request',          10 );
add_action( 'ideaboard_template_redirect', 'ideaboard_get_request',           10 );
add_action( 'ideaboard_template_redirect', 'ideaboard_check_user_edit',       10 );
add_action( 'ideaboard_template_redirect', 'ideaboard_check_forum_edit',      10 );
add_action( 'ideaboard_template_redirect', 'ideaboard_check_topic_edit',      10 );
add_action( 'ideaboard_template_redirect', 'ideaboard_check_reply_edit',      10 );
add_action( 'ideaboard_template_redirect', 'ideaboard_check_topic_tag_edit',  10 );

// Theme-side POST requests
add_action( 'ideaboard_post_request', 'ideaboard_do_ajax',                1  );
add_action( 'ideaboard_post_request', 'ideaboard_edit_topic_tag_handler', 1  );
add_action( 'ideaboard_post_request', 'ideaboard_edit_user_handler',      1  );
add_action( 'ideaboard_post_request', 'ideaboard_edit_forum_handler',     1  );
add_action( 'ideaboard_post_request', 'ideaboard_edit_reply_handler',     1  );
add_action( 'ideaboard_post_request', 'ideaboard_edit_topic_handler',     1  );
add_action( 'ideaboard_post_request', 'ideaboard_merge_topic_handler',    1  );
add_action( 'ideaboard_post_request', 'ideaboard_split_topic_handler',    1  );
add_action( 'ideaboard_post_request', 'ideaboard_move_reply_handler',     1  );
add_action( 'ideaboard_post_request', 'ideaboard_new_forum_handler',      10 );
add_action( 'ideaboard_post_request', 'ideaboard_new_reply_handler',      10 );
add_action( 'ideaboard_post_request', 'ideaboard_new_topic_handler',      10 );

// Theme-side GET requests
add_action( 'ideaboard_get_request', 'ideaboard_toggle_topic_handler',        1  );
add_action( 'ideaboard_get_request', 'ideaboard_toggle_reply_handler',        1  );
add_action( 'ideaboard_get_request', 'ideaboard_favorites_handler',           1  );
add_action( 'ideaboard_get_request', 'ideaboard_subscriptions_handler',       1  );
add_action( 'ideaboard_get_request', 'ideaboard_forum_subscriptions_handler', 1  );
add_action( 'ideaboard_get_request', 'ideaboard_search_results_redirect',     10 );

// Maybe convert the users password
add_action( 'ideaboard_login_form_login', 'ideaboard_user_maybe_convert_pass' );

add_action( 'ideaboard_activation', 'ideaboard_add_activation_redirect' );