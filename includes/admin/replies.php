<?php

/**
 * IdeaBoard Replies Admin Class
 *
 * @package IdeaBoard
 * @subpackage Administration
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

if ( !class_exists( 'BBP_Replies_Admin' ) ) :
/**
 * Loads IdeaBoard replies admin area
 *
 * @package IdeaBoard
 * @subpackage Administration
 * @since IdeaBoard (r2464)
 */
class BBP_Replies_Admin {

	/** Variables *************************************************************/

	/**
	 * @var The post type of this admin component
	 */
	private $post_type = '';

	/** Functions *************************************************************/

	/**
	 * The main IdeaBoard admin loader
	 *
	 * @since IdeaBoard (r2515)
	 *
	 * @uses BBP_Replies_Admin::setup_globals() Setup the globals needed
	 * @uses BBP_Replies_Admin::setup_actions() Setup the hooks and actions
	 * @uses BBP_Replies_Admin::setup_actions() Setup the help text
	 */
	public function __construct() {
		$this->setup_globals();
		$this->setup_actions();
	}

	/**
	 * Setup the admin hooks, actions and filters
	 *
	 * @since IdeaBoard (r2646)
	 * @access private
	 *
	 * @uses add_action() To add various actions
	 * @uses add_filter() To add various filters
	 * @uses ideaboard_get_forum_post_type() To get the forum post type
	 * @uses ideaboard_get_topic_post_type() To get the topic post type
	 * @uses ideaboard_get_reply_post_type() To get the reply post type
	 */
	private function setup_actions() {

		// Add some general styling to the admin area
		add_action( 'ideaboard_admin_head',        array( $this, 'admin_head'       ) );

		// Messages
		add_filter( 'post_updated_messages', array( $this, 'updated_messages' ) );

		// Reply column headers.
		add_filter( 'manage_' . $this->post_type . '_posts_columns',  array( $this, 'column_headers' ) );

		// Reply columns (in post row)
		add_action( 'manage_' . $this->post_type . '_posts_custom_column',  array( $this, 'column_data' ), 10, 2 );
		add_filter( 'post_row_actions',                                     array( $this, 'row_actions' ), 10, 2 );

		// Reply metabox actions
		add_action( 'add_meta_boxes', array( $this, 'attributes_metabox'      ) );
		add_action( 'save_post',      array( $this, 'attributes_metabox_save' ) );

		// Check if there are any ideaboard_toggle_reply_* requests on admin_init, also have a message displayed
		add_action( 'load-edit.php',  array( $this, 'toggle_reply'        ) );
		add_action( 'admin_notices',  array( $this, 'toggle_reply_notice' ) );

		// Anonymous metabox actions
		add_action( 'add_meta_boxes', array( $this, 'author_metabox'      ) );

		// Add ability to filter topics and replies per forum
		add_filter( 'restrict_manage_posts', array( $this, 'filter_dropdown'  ) );
		add_filter( 'ideaboard_request',           array( $this, 'filter_post_rows' ) );

		// Contextual Help
		add_action( 'load-edit.php',     array( $this, 'edit_help' ) );
		add_action( 'load-post.php',     array( $this, 'new_help'  ) );
		add_action( 'load-post-new.php', array( $this, 'new_help'  ) );
	}

	/**
	 * Should we bail out of this method?
	 *
	 * @since IdeaBoard (r4067)
	 * @return boolean
	 */
	private function bail() {
		if ( !isset( get_current_screen()->post_type ) || ( $this->post_type !== get_current_screen()->post_type ) )
			return true;

		return false;
	}

	/**
	 * Admin globals
	 *
	 * @since IdeaBoard (r2646)
	 * @access private
	 */
	private function setup_globals() {
		$this->post_type = ideaboard_get_reply_post_type();
	}

	/** Contextual Help *******************************************************/

	/**
	 * Contextual help for IdeaBoard reply edit page
	 *
	 * @since IdeaBoard (r3119)
	 * @uses get_current_screen()
	 */
	public function edit_help() {

		if ( $this->bail() ) return;

		// Overview
		get_current_screen()->add_help_tab( array(
			'id'		=> 'overview',
			'title'		=> __( 'Overview', 'ideaboard' ),
			'content'	=>
				'<p>' . __( 'This screen provides access to all of your replies. You can customize the display of this screen to suit your workflow.', 'ideaboard' ) . '</p>'
		) );

		// Screen Content
		get_current_screen()->add_help_tab( array(
			'id'		=> 'screen-content',
			'title'		=> __( 'Screen Content', 'ideaboard' ),
			'content'	=>
				'<p>' . __( 'You can customize the display of this screen&#8217;s contents in a number of ways:', 'ideaboard' ) . '</p>' .
				'<ul>' .
					'<li>' . __( 'You can hide/display columns based on your needs and decide how many replies to list per screen using the Screen Options tab.',                                                                                                                                                                          'ideaboard' ) . '</li>' .
					'<li>' . __( 'You can filter the list of replies by reply status using the text links in the upper left to show All, Published, Draft, or Trashed replies. The default view is to show all replies.',                                                                                                                   'ideaboard' ) . '</li>' .
					'<li>' . __( 'You can view replies in a simple title list or with an excerpt. Choose the view you prefer by clicking on the icons at the top of the list on the right.',                                                                                                                                             'ideaboard' ) . '</li>' .
					'<li>' . __( 'You can refine the list to show only replies in a specific category or from a specific month by using the dropdown menus above the replies list. Click the Filter button after making your selection. You also can refine the list by clicking on the reply author, category or tag in the replies list.', 'ideaboard' ) . '</li>' .
				'</ul>'
		) );

		// Available Actions
		get_current_screen()->add_help_tab( array(
			'id'		=> 'action-links',
			'title'		=> __( 'Available Actions', 'ideaboard' ),
			'content'	=>
				'<p>' . __( 'Hovering over a row in the replies list will display action links that allow you to manage your reply. You can perform the following actions:', 'ideaboard' ) . '</p>' .
				'<ul>' .
					'<li>' . __( '<strong>Edit</strong> takes you to the editing screen for that reply. You can also reach that screen by clicking on the reply title.',                                                                                 'ideaboard' ) . '</li>' .
					//'<li>' . __( '<strong>Quick Edit</strong> provides inline access to the metadata of your reply, allowing you to update reply details without leaving this screen.',                                                                  'ideaboard' ) . '</li>' .
					'<li>' . __( '<strong>Trash</strong> removes your reply from this list and places it in the trash, from which you can permanently delete it.',                                                                                       'ideaboard' ) . '</li>' .
					'<li>' . __( '<strong>Spam</strong> removes your reply from this list and places it in the spam queue, from which you can permanently delete it.',                                                                                   'ideaboard' ) . '</li>' .
					'<li>' . __( '<strong>Preview</strong> will show you what your draft reply will look like if you publish it. View will take you to your live site to view the reply. Which link is available depends on your reply&#8217;s status.', 'ideaboard' ) . '</li>' .
				'</ul>'
		) );

		// Bulk Actions
		get_current_screen()->add_help_tab( array(
			'id'		=> 'bulk-actions',
			'title'		=> __( 'Bulk Actions', 'ideaboard' ),
			'content'	=>
				'<p>' . __( 'You can also edit or move multiple replies to the trash at once. Select the replies you want to act on using the checkboxes, then select the action you want to take from the Bulk Actions menu and click Apply.',           'ideaboard' ) . '</p>' .
				'<p>' . __( 'When using Bulk Edit, you can change the metadata (categories, author, etc.) for all selected replies at once. To remove a reply from the grouping, just click the x next to its name in the Bulk Edit area that appears.', 'ideaboard' ) . '</p>'
		) );

		// Help Sidebar
		get_current_screen()->set_help_sidebar(
			'<p><strong>' . __( 'For more information:', 'ideaboard' ) . '</strong></p>' .
			'<p>' . __( '<a href="http://codex.ideaboard.org" target="_blank">IdeaBoard Documentation</a>',    'ideaboard' ) . '</p>' .
			'<p>' . __( '<a href="http://ideaboard.org/forums/" target="_blank">IdeaBoard Support Forums</a>', 'ideaboard' ) . '</p>'
		);
	}

	/**
	 * Contextual help for IdeaBoard reply edit page
	 *
	 * @since IdeaBoard (r3119)
	 * @uses get_current_screen()
	 */
	public function new_help() {

		if ( $this->bail() ) return;

		$customize_display = '<p>' . __( 'The title field and the big reply editing Area are fixed in place, but you can reposition all the other boxes using drag and drop, and can minimize or expand them by clicking the title bar of each box. Use the Screen Options tab to unhide more boxes (Excerpt, Send Trackbacks, Custom Fields, Discussion, Slug, Author) or to choose a 1- or 2-column layout for this screen.', 'ideaboard' ) . '</p>';

		get_current_screen()->add_help_tab( array(
			'id'      => 'customize-display',
			'title'   => __( 'Customizing This Display', 'ideaboard' ),
			'content' => $customize_display,
		) );

		get_current_screen()->add_help_tab( array(
			'id'      => 'title-reply-editor',
			'title'   => __( 'Title and Reply Editor', 'ideaboard' ),
			'content' =>
				'<p>' . __( '<strong>Title</strong> - Enter a title for your reply. After you enter a title, you&#8217;ll see the permalink below, which you can edit.', 'ideaboard' ) . '</p>' .
				'<p>' . __( '<strong>Reply Editor</strong> - Enter the text for your reply. There are two modes of editing: Visual and HTML. Choose the mode by clicking on the appropriate tab. Visual mode gives you a WYSIWYG editor. Click the last icon in the row to get a second row of controls. The HTML mode allows you to enter raw HTML along with your reply text. You can insert media files by clicking the icons above the reply editor and following the directions. You can go to the distraction-free writing screen via the Fullscreen icon in Visual mode (second to last in the top row) or the Fullscreen button in HTML mode (last in the row). Once there, you can make buttons visible by hovering over the top area. Exit Fullscreen back to the regular reply editor.', 'ideaboard' ) . '</p>'
		) );

		$publish_box = '<p>' . __( '<strong>Publish</strong> - You can set the terms of publishing your reply in the Publish box. For Status, Visibility, and Publish (immediately), click on the Edit link to reveal more options. Visibility includes options for password-protecting a reply or making it stay at the top of your blog indefinitely (sticky). Publish (immediately) allows you to set a future or past date and time, so you can schedule a reply to be published in the future or backdate a reply.', 'ideaboard' ) . '</p>';

		if ( current_theme_supports( 'reply-thumbnails' ) && post_type_supports( 'reply', 'thumbnail' ) ) {
			$publish_box .= '<p>' . __( '<strong>Featured Image</strong> - This allows you to associate an image with your reply without inserting it. This is usually useful only if your theme makes use of the featured image as a reply thumbnail on the home page, a custom header, etc.', 'ideaboard' ) . '</p>';
		}

		get_current_screen()->add_help_tab( array(
			'id'      => 'reply-attributes',
			'title'   => __( 'Reply Attributes', 'ideaboard' ),
			'content' =>
				'<p>' . __( 'Select the attributes that your reply should have:', 'ideaboard' ) . '</p>' .
				'<ul>' .
					'<li>' . __( '<strong>Forum</strong> dropdown determines the parent forum that the reply belongs to. Select the forum, or leave the default (Use Forum of Topic) to post the reply in forum of the topic.', 'ideaboard' ) . '</li>' .
					'<li>' . __( '<strong>Topic</strong> determines the parent topic that the reply belongs to.', 'ideaboard' ) . '</li>' .
					'<li>' . __( '<strong>Reply To</strong> determines the threading of the reply.', 'ideaboard' ) . '</li>' .
				'</ul>'
		) );

		get_current_screen()->add_help_tab( array(
			'id'      => 'publish-box',
			'title'   => __( 'Publish Box', 'ideaboard' ),
			'content' => $publish_box,
		) );

		get_current_screen()->set_help_sidebar(
			'<p><strong>' . __( 'For more information:', 'ideaboard' ) . '</strong></p>' .
			'<p>' . __( '<a href="http://codex.ideaboard.org" target="_blank">IdeaBoard Documentation</a>',    'ideaboard' ) . '</p>' .
			'<p>' . __( '<a href="http://ideaboard.org/forums/" target="_blank">IdeaBoard Support Forums</a>', 'ideaboard' ) . '</p>'
		);
	}

	/**
	 * Add the reply attributes metabox
	 *
	 * @since IdeaBoard (r2746)
	 *
	 * @uses ideaboard_get_reply_post_type() To get the reply post type
	 * @uses add_meta_box() To add the metabox
	 * @uses do_action() Calls 'ideaboard_reply_attributes_metabox'
	 */
	public function attributes_metabox() {

		if ( $this->bail() ) return;

		add_meta_box (
			'ideaboard_reply_attributes',
			__( 'Reply Attributes', 'ideaboard' ),
			'ideaboard_reply_metabox',
			$this->post_type,
			'side',
			'high'
		);

		do_action( 'ideaboard_reply_attributes_metabox' );
	}

	/**
	 * Pass the reply attributes for processing
	 *
	 * @since IdeaBoard (r2746)
	 *
	 * @param int $reply_id Reply id
	 * @uses current_user_can() To check if the current user is capable of
	 *                           editing the reply
	 * @uses do_action() Calls 'ideaboard_reply_attributes_metabox_save' with the
	 *                    reply id and parent id
	 * @return int Parent id
	 */
	public function attributes_metabox_save( $reply_id ) {

		if ( $this->bail() ) return $reply_id;

		// Bail if doing an autosave
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $reply_id;

		// Bail if not a post request
		if ( ! ideaboard_is_post_request() )
			return $reply_id;

		// Check action exists
		if ( empty( $_POST['action'] ) )
			return $reply_id;

		// Nonce check
		if ( empty( $_POST['ideaboard_reply_metabox'] ) || !wp_verify_nonce( $_POST['ideaboard_reply_metabox'], 'ideaboard_reply_metabox_save' ) )
			return $reply_id;

		// Current user cannot edit this reply
		if ( !current_user_can( 'edit_reply', $reply_id ) )
			return $reply_id;

		// Get the reply meta post values
		$topic_id = !empty( $_POST['parent_id']    ) ? (int) $_POST['parent_id']    : 0;
		$forum_id = !empty( $_POST['ideaboard_forum_id'] ) ? (int) $_POST['ideaboard_forum_id'] : ideaboard_get_topic_forum_id( $topic_id );
		$reply_to = !empty( $_POST['ideaboard_reply_to'] ) ? (int) $_POST['ideaboard_reply_to'] : 0;

		// Get reply author data
		$anonymous_data = ideaboard_filter_anonymous_post_data();
		$author_id      = ideaboard_get_reply_author_id( $reply_id );
		$is_edit        = (bool) isset( $_POST['save'] );

		// Formally update the reply
		ideaboard_update_reply( $reply_id, $topic_id, $forum_id, $anonymous_data, $author_id, $is_edit, $reply_to );

		// Allow other fun things to happen
		do_action( 'ideaboard_reply_attributes_metabox_save', $reply_id, $topic_id, $forum_id, $reply_to );
		do_action( 'ideaboard_author_metabox_save',           $reply_id, $anonymous_data                 );

		return $reply_id;
	}

	/**
	 * Add the author info metabox
	 *
	 * Allows editing of information about an author
	 *
	 * @since IdeaBoard (r2828)
	 *
	 * @uses ideaboard_get_topic() To get the topic
	 * @uses ideaboard_get_reply() To get the reply
	 * @uses ideaboard_get_topic_post_type() To get the topic post type
	 * @uses ideaboard_get_reply_post_type() To get the reply post type
	 * @uses add_meta_box() To add the metabox
	 * @uses do_action() Calls 'ideaboard_author_metabox' with the topic/reply
	 *                    id
	 */
	public function author_metabox() {

		if ( $this->bail() ) return;

		// Bail if post_type is not a reply
		if ( empty( $_GET['action'] ) || ( 'edit' !== $_GET['action'] ) )
			return;

		// Add the metabox
		add_meta_box(
			'ideaboard_author_metabox',
			__( 'Author Information', 'ideaboard' ),
			'ideaboard_author_metabox',
			$this->post_type,
			'side',
			'high'
		);

		do_action( 'ideaboard_author_metabox', get_the_ID() );
	}

	/**
	 * Add some general styling to the admin area
	 *
	 * @since IdeaBoard (r2464)
	 *
	 * @uses ideaboard_get_forum_post_type() To get the forum post type
	 * @uses ideaboard_get_topic_post_type() To get the topic post type
	 * @uses ideaboard_get_reply_post_type() To get the reply post type
	 * @uses sanitize_html_class() To sanitize the classes
	 * @uses do_action() Calls 'ideaboard_admin_head'
	 */
	public function admin_head() {

		if ( $this->bail() ) return;

		?>

		<style type="text/css" media="screen">
		/*<![CDATA[*/

			strong.label {
				display: inline-block;
				width: 60px;
			}

			.column-ideaboard_forum_topic_count,
			.column-ideaboard_forum_reply_count,
			.column-ideaboard_topic_reply_count,
			.column-ideaboard_topic_voice_count {
				width: 8% !important;
			}

			.column-author,
			.column-ideaboard_reply_author,
			.column-ideaboard_topic_author {
				width: 10% !important;
			}

			.column-ideaboard_topic_forum,
			.column-ideaboard_reply_forum,
			.column-ideaboard_reply_topic {
				width: 10% !important;
			}

			.column-ideaboard_forum_freshness,
			.column-ideaboard_topic_freshness {
				width: 10% !important;
			}

			.column-ideaboard_forum_created,
			.column-ideaboard_topic_created,
			.column-ideaboard_reply_created {
				width: 15% !important;
			}

			.status-closed {
				background-color: #eaeaea;
			}

			.status-spam {
				background-color: #faeaea;
			}

		/*]]>*/
		</style>

		<?php
	}

	/**
	 * Toggle reply
	 *
	 * Handles the admin-side spamming/unspamming of replies
	 *
	 * @since IdeaBoard (r2740)
	 *
	 * @uses ideaboard_get_reply() To get the reply
	 * @uses current_user_can() To check if the user is capable of editing
	 *                           the reply
	 * @uses wp_die() To die if the user isn't capable or the post wasn't
	 *                 found
	 * @uses check_admin_referer() To verify the nonce and check referer
	 * @uses ideaboard_is_reply_spam() To check if the reply is marked as spam
	 * @uses ideaboard_unspam_reply() To unmark the reply as spam
	 * @uses ideaboard_spam_reply() To mark the reply as spam
	 * @uses do_action() Calls 'ideaboard_toggle_reply_admin' with success, post
	 *                    data, action and message
	 * @uses add_query_arg() To add custom args to the url
	 * @uses wp_safe_redirect() Redirect the page to custom url
	 */
	public function toggle_reply() {

		if ( $this->bail() ) return;

		// Only proceed if GET is a reply toggle action
		if ( ideaboard_is_get_request() && !empty( $_GET['action'] ) && in_array( $_GET['action'], array( 'ideaboard_toggle_reply_spam' ) ) && !empty( $_GET['reply_id'] ) ) {
			$action    = $_GET['action'];            // What action is taking place?
			$reply_id  = (int) $_GET['reply_id'];    // What's the reply id?
			$success   = false;                      // Flag
			$post_data = array( 'ID' => $reply_id ); // Prelim array

			// Get reply and die if empty
			$reply = ideaboard_get_reply( $reply_id );
			if ( empty( $reply ) ) // Which reply?
				wp_die( __( 'The reply was not found!', 'ideaboard' ) );

			if ( !current_user_can( 'moderate', $reply->ID ) ) // What is the user doing here?
				wp_die( __( 'You do not have the permission to do that!', 'ideaboard' ) );

			switch ( $action ) {
				case 'ideaboard_toggle_reply_spam' :
					check_admin_referer( 'spam-reply_' . $reply_id );

					$is_spam = ideaboard_is_reply_spam( $reply_id );
					$message = $is_spam ? 'unspammed' : 'spammed';
					$success = $is_spam ? ideaboard_unspam_reply( $reply_id ) : ideaboard_spam_reply( $reply_id );

					break;
			}

			$success = wp_update_post( $post_data );
			$message = array( 'ideaboard_reply_toggle_notice' => $message, 'reply_id' => $reply->ID );

			if ( false === $success || is_wp_error( $success ) )
				$message['failed'] = '1';

			// Do additional reply toggle actions (admin side)
			do_action( 'ideaboard_toggle_reply_admin', $success, $post_data, $action, $message );

			// Redirect back to the reply
			$redirect = add_query_arg( $message, remove_query_arg( array( 'action', 'reply_id' ) ) );
			wp_safe_redirect( $redirect );

			// For good measure
			exit();
		}
	}

	/**
	 * Toggle reply notices
	 *
	 * Display the success/error notices from
	 * {@link BBP_Admin::toggle_reply()}
	 *
	 * @since IdeaBoard (r2740)
	 *
	 * @uses ideaboard_get_reply() To get the reply
	 * @uses ideaboard_get_reply_title() To get the reply title of the reply
	 * @uses esc_html() To sanitize the reply title
	 * @uses apply_filters() Calls 'ideaboard_toggle_reply_notice_admin' with
	 *                        message, reply id, notice and is it a failure
	 */
	public function toggle_reply_notice() {

		if ( $this->bail() ) return;

		// Only proceed if GET is a reply toggle action
		if ( ideaboard_is_get_request() && !empty( $_GET['ideaboard_reply_toggle_notice'] ) && in_array( $_GET['ideaboard_reply_toggle_notice'], array( 'spammed', 'unspammed' ) ) && !empty( $_GET['reply_id'] ) ) {
			$notice     = $_GET['ideaboard_reply_toggle_notice'];         // Which notice?
			$reply_id   = (int) $_GET['reply_id'];                  // What's the reply id?
			$is_failure = !empty( $_GET['failed'] ) ? true : false; // Was that a failure?

			// Empty? No reply?
			if ( empty( $notice ) || empty( $reply_id ) )
				return;

			// Get reply and bail if empty
			$reply = ideaboard_get_reply( $reply_id );
			if ( empty( $reply ) )
				return;

			$reply_title = ideaboard_get_reply_title( $reply->ID );

			switch ( $notice ) {
				case 'spammed' :
					$message = $is_failure === true ? sprintf( __( 'There was a problem marking the reply "%1$s" as spam.', 'ideaboard' ), $reply_title ) : sprintf( __( 'Reply "%1$s" successfully marked as spam.', 'ideaboard' ), $reply_title );
					break;

				case 'unspammed' :
					$message = $is_failure === true ? sprintf( __( 'There was a problem unmarking the reply "%1$s" as spam.', 'ideaboard' ), $reply_title ) : sprintf( __( 'Reply "%1$s" successfully unmarked as spam.', 'ideaboard' ), $reply_title );
					break;
			}

			// Do additional reply toggle notice filters (admin side)
			$message = apply_filters( 'ideaboard_toggle_reply_notice_admin', $message, $reply->ID, $notice, $is_failure );

			?>

			<div id="message" class="<?php echo $is_failure === true ? 'error' : 'updated'; ?> fade">
				<p style="line-height: 150%"><?php echo esc_html( $message ); ?></p>
			</div>

			<?php
		}
	}

	/**
	 * Manage the column headers for the replies page
	 *
	 * @since IdeaBoard (r2577)
	 *
	 * @param array $columns The columns
	 * @uses apply_filters() Calls 'ideaboard_admin_replies_column_headers' with
	 *                        the columns
	 * @return array $columns IdeaBoard reply columns
	 */
	public function column_headers( $columns ) {

		if ( $this->bail() ) return $columns;

		$columns = array(
			'cb'                => '<input type="checkbox" />',
			'title'             => __( 'Title',   'ideaboard' ),
			'ideaboard_reply_forum'   => __( 'Forum',   'ideaboard' ),
			'ideaboard_reply_topic'   => __( 'Topic',   'ideaboard' ),
			'ideaboard_reply_author'  => __( 'Author',  'ideaboard' ),
			'ideaboard_reply_created' => __( 'Created', 'ideaboard' ),
		);

		return apply_filters( 'ideaboard_admin_replies_column_headers', $columns );
	}

	/**
	 * Print extra columns for the replies page
	 *
	 * @since IdeaBoard (r2577)
	 *
	 * @param string $column Column
	 * @param int $reply_id reply id
	 * @uses ideaboard_get_reply_topic_id() To get the topic id of the reply
	 * @uses ideaboard_topic_title() To output the reply's topic title
	 * @uses apply_filters() Calls 'reply_topic_row_actions' with an array
	 *                        of reply topic actions
	 * @uses ideaboard_get_topic_permalink() To get the topic permalink
	 * @uses ideaboard_get_topic_forum_id() To get the forum id of the topic of
	 *                                 the reply
	 * @uses ideaboard_get_forum_permalink() To get the forum permalink
	 * @uses admin_url() To get the admin url of post.php
	 * @uses apply_filters() Calls 'reply_topic_forum_row_actions' with an
	 *                        array of reply topic forum actions
	 * @uses ideaboard_reply_author_display_name() To output the reply author name
	 * @uses get_the_date() Get the reply creation date
	 * @uses get_the_time() Get the reply creation time
	 * @uses esc_attr() To sanitize the reply creation time
	 * @uses ideaboard_get_reply_last_active_time() To get the time when the reply was
	 *                                    last active
	 * @uses do_action() Calls 'ideaboard_admin_replies_column_data' with the
	 *                    column and reply id
	 */
	public function column_data( $column, $reply_id ) {

		if ( $this->bail() ) return;

		// Get topic ID
		$topic_id = ideaboard_get_reply_topic_id( $reply_id );

		// Populate Column Data
		switch ( $column ) {

			// Topic
			case 'ideaboard_reply_topic' :

				// Output forum name
				if ( !empty( $topic_id ) ) {

					// Topic Title
					$topic_title = ideaboard_get_topic_title( $topic_id );
					if ( empty( $topic_title ) ) {
						$topic_title = esc_html__( 'No Topic', 'ideaboard' );
					}

					// Output the title
					echo $topic_title;

				// Reply has no topic
				} else {
					esc_html_e( 'No Topic', 'ideaboard' );
				}

				break;

			// Forum
			case 'ideaboard_reply_forum' :

				// Get Forum ID's
				$reply_forum_id = ideaboard_get_reply_forum_id( $reply_id );
				$topic_forum_id = ideaboard_get_topic_forum_id( $topic_id );

				// Output forum name
				if ( !empty( $reply_forum_id ) ) {

					// Forum Title
					$forum_title = ideaboard_get_forum_title( $reply_forum_id );
					if ( empty( $forum_title ) ) {
						$forum_title = esc_html__( 'No Forum', 'ideaboard' );
					}

					// Alert capable users of reply forum mismatch
					if ( $reply_forum_id !== $topic_forum_id ) {
						if ( current_user_can( 'edit_others_replies' ) || current_user_can( 'moderate' ) ) {
							$forum_title .= '<div class="attention">' . esc_html__( '(Mismatch)', 'ideaboard' ) . '</div>';
						}
					}

					// Output the title
					echo $forum_title;

				// Reply has no forum
				} else {
					_e( 'No Forum', 'ideaboard' );
				}

				break;

			// Author
			case 'ideaboard_reply_author' :
				ideaboard_reply_author_display_name ( $reply_id );
				break;

			// Freshness
			case 'ideaboard_reply_created':

				// Output last activity time and date
				printf( '%1$s <br /> %2$s',
					get_the_date(),
					esc_attr( get_the_time() )
				);

				break;

			// Do action for anything else
			default :
				do_action( 'ideaboard_admin_replies_column_data', $column, $reply_id );
				break;
		}
	}

	/**
	 * Reply Row actions
	 *
	 * Remove the quick-edit action link under the reply title and add the
	 * content and spam link
	 *
	 * @since IdeaBoard (r2577)
	 *
	 * @param array $actions Actions
	 * @param array $reply Reply object
	 * @uses ideaboard_get_reply_post_type() To get the reply post type
	 * @uses ideaboard_reply_content() To output reply content
	 * @uses ideaboard_get_reply_permalink() To get the reply link
	 * @uses ideaboard_get_reply_title() To get the reply title
	 * @uses current_user_can() To check if the current user can edit or
	 *                           delete the reply
	 * @uses ideaboard_is_reply_spam() To check if the reply is marked as spam
	 * @uses get_post_type_object() To get the reply post type object
	 * @uses add_query_arg() To add custom args to the url
	 * @uses remove_query_arg() To remove custom args from the url
	 * @uses wp_nonce_url() To nonce the url
	 * @uses get_delete_post_link() To get the delete post link of the reply
	 * @return array $actions Actions
	 */
	public function row_actions( $actions, $reply ) {

		if ( $this->bail() ) return $actions;

		unset( $actions['inline hide-if-no-js'] );

		// Reply view links to topic
		$actions['view'] = '<a href="' . esc_url( ideaboard_get_reply_url( $reply->ID ) ) . '" title="' . esc_attr( sprintf( __( 'View &#8220;%s&#8221;', 'ideaboard' ), ideaboard_get_reply_title( $reply->ID ) ) ) . '" rel="permalink">' . esc_html__( 'View', 'ideaboard' ) . '</a>';

		// User cannot view replies in trash
		if ( ( ideaboard_get_trash_status_id() === $reply->post_status ) && !current_user_can( 'view_trash' ) )
			unset( $actions['view'] );

		// Only show the actions if the user is capable of viewing them
		if ( current_user_can( 'moderate', $reply->ID ) ) {
			if ( in_array( $reply->post_status, array( ideaboard_get_public_status_id(), ideaboard_get_spam_status_id() ) ) ) {
				$spam_uri  = wp_nonce_url( add_query_arg( array( 'reply_id' => $reply->ID, 'action' => 'ideaboard_toggle_reply_spam' ), remove_query_arg( array( 'ideaboard_reply_toggle_notice', 'reply_id', 'failed', 'super' ) ) ), 'spam-reply_'  . $reply->ID );
				if ( ideaboard_is_reply_spam( $reply->ID ) ) {
					$actions['spam'] = '<a href="' . esc_url( $spam_uri ) . '" title="' . esc_attr__( 'Mark the reply as not spam', 'ideaboard' ) . '">' . esc_html__( 'Not spam', 'ideaboard' ) . '</a>';
				} else {
					$actions['spam'] = '<a href="' . esc_url( $spam_uri ) . '" title="' . esc_attr__( 'Mark this reply as spam',    'ideaboard' ) . '">' . esc_html__( 'Spam',     'ideaboard' ) . '</a>';
				}
			}
		}

		// Trash
		if ( current_user_can( 'delete_reply', $reply->ID ) ) {
			if ( ideaboard_get_trash_status_id() === $reply->post_status ) {
				$post_type_object   = get_post_type_object( ideaboard_get_reply_post_type() );
				$actions['untrash'] = "<a title='" . esc_attr__( 'Restore this item from the Trash', 'ideaboard' ) . "' href='" . esc_url( add_query_arg( array( '_wp_http_referer' => add_query_arg( array( 'post_type' => ideaboard_get_reply_post_type() ), admin_url( 'edit.php' ) ) ), wp_nonce_url( admin_url( sprintf( $post_type_object->_edit_link . '&amp;action=untrash', $reply->ID ) ), 'untrash-' . $reply->post_type . '_' . $reply->ID ) ) ) . "'>" . esc_html__( 'Restore', 'ideaboard' ) . "</a>";
			} elseif ( EMPTY_TRASH_DAYS ) {
				$actions['trash'] = "<a class='submitdelete' title='" . esc_attr__( 'Move this item to the Trash', 'ideaboard' ) . "' href='" . esc_url( add_query_arg( array( '_wp_http_referer' => add_query_arg( array( 'post_type' => ideaboard_get_reply_post_type() ), admin_url( 'edit.php' ) ) ), get_delete_post_link( $reply->ID ) ) ) . "'>" . esc_html__( 'Trash', 'ideaboard' ) . "</a>";
			}

			if ( ideaboard_get_trash_status_id() === $reply->post_status || !EMPTY_TRASH_DAYS ) {
				$actions['delete'] = "<a class='submitdelete' title='" . esc_attr__( 'Delete this item permanently', 'ideaboard' ) . "' href='" . esc_url( add_query_arg( array( '_wp_http_referer' => add_query_arg( array( 'post_type' => ideaboard_get_reply_post_type() ), admin_url( 'edit.php' ) ) ), get_delete_post_link( $reply->ID, '', true ) ) ) . "'>" . esc_html__( 'Delete Permanently', 'ideaboard' ) . "</a>";
			} elseif ( ideaboard_get_spam_status_id() === $reply->post_status ) {
				unset( $actions['trash'] );
			}
		}

		return $actions;
	}

	/**
	 * Add forum dropdown to topic and reply list table filters
	 *
	 * @since IdeaBoard (r2991)
	 *
	 * @uses ideaboard_get_reply_post_type() To get the reply post type
	 * @uses ideaboard_get_topic_post_type() To get the topic post type
	 * @uses ideaboard_dropdown() To generate a forum dropdown
	 * @return bool False. If post type is not topic or reply
	 */
	public function filter_dropdown() {

		if ( $this->bail() ) return;

		// Add Empty Spam button
		if ( !empty( $_GET['post_status'] ) && ( ideaboard_get_spam_status_id() === $_GET['post_status'] ) && current_user_can( 'moderate' ) ) {
			wp_nonce_field( 'bulk-destroy', '_destroy_nonce' );
			$title = esc_attr__( 'Empty Spam', 'ideaboard' );
			submit_button( $title, 'button-secondary apply', 'delete_all', false );
		}

		// Get which forum is selected
		$selected = !empty( $_GET['ideaboard_forum_id'] ) ? $_GET['ideaboard_forum_id'] : '';

		// Show the forums dropdown
		ideaboard_dropdown( array(
			'selected'  => $selected,
			'show_none' => __( 'In all forums', 'ideaboard' )
		) );
	}

	/**
	 * Adjust the request query and include the forum id
	 *
	 * @since IdeaBoard (r2991)
	 *
	 * @param array $query_vars Query variables from {@link WP_Query}
	 * @uses is_admin() To check if it's the admin section
	 * @uses ideaboard_get_topic_post_type() To get the topic post type
	 * @uses ideaboard_get_reply_post_type() To get the reply post type
	 * @return array Processed Query Vars
	 */
	public function filter_post_rows( $query_vars ) {

		if ( $this->bail() ) return $query_vars;

		// Add post_parent query_var if one is present
		if ( !empty( $_GET['ideaboard_forum_id'] ) ) {
			$query_vars['meta_key']   = '_ideaboard_forum_id';
			$query_vars['meta_value'] = $_GET['ideaboard_forum_id'];
		}

		// Return manipulated query_vars
		return $query_vars;
	}

	/**
	 * Custom user feedback messages for reply post type
	 *
	 * @since IdeaBoard (r3080)
	 *
	 * @global int $post_ID
	 * @uses ideaboard_get_topic_permalink()
	 * @uses wp_post_revision_title()
	 * @uses esc_url()
	 * @uses add_query_arg()
	 *
	 * @param array $messages
	 *
	 * @return array
	 */
	public function updated_messages( $messages ) {
		global $post_ID;

		if ( $this->bail() ) return $messages;

		// URL for the current topic
		$topic_url = ideaboard_get_topic_permalink( ideaboard_get_reply_topic_id( $post_ID ) );

		// Current reply's post_date
		$post_date = ideaboard_get_global_post_field( 'post_date', 'raw' );

		// Messages array
		$messages[$this->post_type] = array(
			0 =>  '', // Left empty on purpose

			// Updated
			1 =>  sprintf( __( 'Reply updated. <a href="%s">View topic</a>', 'ideaboard' ), $topic_url ),

			// Custom field updated
			2 => __( 'Custom field updated.', 'ideaboard' ),

			// Custom field deleted
			3 => __( 'Custom field deleted.', 'ideaboard' ),

			// Reply updated
			4 => __( 'Reply updated.', 'ideaboard' ),

			// Restored from revision
			// translators: %s: date and time of the revision
			5 => isset( $_GET['revision'] )
					? sprintf( __( 'Reply restored to revision from %s', 'ideaboard' ), wp_post_revision_title( (int) $_GET['revision'], false ) )
					: false,

			// Reply created
			6 => sprintf( __( 'Reply created. <a href="%s">View topic</a>', 'ideaboard' ), $topic_url ),

			// Reply saved
			7 => __( 'Reply saved.', 'ideaboard' ),

			// Reply submitted
			8 => sprintf( __( 'Reply submitted. <a target="_blank" href="%s">Preview topic</a>', 'ideaboard' ), esc_url( add_query_arg( 'preview', 'true', $topic_url ) ) ),

			// Reply scheduled
			9 => sprintf( __( 'Reply scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview topic</a>', 'ideaboard' ),
					// translators: Publish box date format, see http://php.net/date
					date_i18n( __( 'M j, Y @ G:i', 'ideaboard' ),
					strtotime( $post_date ) ),
					$topic_url ),

			// Reply draft updated
			10 => sprintf( __( 'Reply draft updated. <a target="_blank" href="%s">Preview topic</a>', 'ideaboard' ), esc_url( add_query_arg( 'preview', 'true', $topic_url ) ) ),
		);

		return $messages;
	}
}
endif; // class_exists check

/**
 * Setup IdeaBoard Replies Admin
 *
 * This is currently here to make hooking and unhooking of the admin UI easy.
 * It could use dependency injection in the future, but for now this is easier.
 *
 * @since IdeaBoard (r2596)
 *
 * @uses BBP_Replies_Admin
 */
function ideaboard_admin_replies() {
	ideaboard()->admin->replies = new BBP_Replies_Admin();
}
