<?php

/**
 * IdeaBoard Forum Admin Class
 *
 * @package IdeaBoard
 * @subpackage Administration
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

if ( !class_exists( 'BBP_Forums_Admin' ) ) :
/**
 * Loads IdeaBoard forums admin area
 *
 * @package IdeaBoard
 * @subpackage Administration
 * @since IdeaBoard (r2464)
 */
class BBP_Forums_Admin {

	/** Variables *************************************************************/

	/**
	 * @var The post type of this admin component
	 */
	private $post_type = '';

	/** Functions *************************************************************/

	/**
	 * The main IdeaBoard forums admin loader
	 *
	 * @since IdeaBoard (r2515)
	 *
	 * @uses BBP_Forums_Admin::setup_globals() Setup the globals needed
	 * @uses BBP_Forums_Admin::setup_actions() Setup the hooks and actions
	 * @uses BBP_Forums_Admin::setup_help() Setup the help text
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

		// Metabox actions
		add_action( 'add_meta_boxes',        array( $this, 'attributes_metabox'      ) );
		add_action( 'save_post',             array( $this, 'attributes_metabox_save' ) );

		// Column headers.
		add_filter( 'manage_' . $this->post_type . '_posts_columns',        array( $this, 'column_headers' )        );

		// Columns (in page row)
		add_action( 'manage_' . $this->post_type . '_posts_custom_column',  array( $this, 'column_data'    ), 10, 2 );
		add_filter( 'page_row_actions',                                     array( $this, 'row_actions'    ), 10, 2 );

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
		if ( !isset( get_current_screen()->post_type ) || ( $this->post_type != get_current_screen()->post_type ) )
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
		$this->post_type = ideaboard_get_forum_post_type();
	}

	/** Contextual Help *******************************************************/

	/**
	 * Contextual help for IdeaBoard forum edit page
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
				'<p>' . __( 'This screen displays the individual forums on your site. You can customize the display of this screen to suit your workflow.', 'ideaboard' ) . '</p>'
		) );

		// Screen Content
		get_current_screen()->add_help_tab( array(
			'id'		=> 'screen-content',
			'title'		=> __( 'Screen Content', 'ideaboard' ),
			'content'	=>
				'<p>' . __( 'You can customize the display of this screen&#8217;s contents in a number of ways:', 'ideaboard' ) . '</p>' .
				'<ul>' .
					'<li>' . __( 'You can hide/display columns based on your needs and decide how many forums to list per screen using the Screen Options tab.',                                                                                                                                'ideaboard' ) . '</li>' .
					'<li>' . __( 'You can filter the list of forums by forum status using the text links in the upper left to show All, Published, or Trashed forums. The default view is to show all forums.',                                                                                 'ideaboard' ) . '</li>' .
					'<li>' . __( 'You can refine the list to show only forums from a specific month by using the dropdown menus above the forums list. Click the Filter button after making your selection. You also can refine the list by clicking on the forum creator in the forums list.', 'ideaboard' ) . '</li>' .
				'</ul>'
		) );

		// Available Actions
		get_current_screen()->add_help_tab( array(
			'id'		=> 'action-links',
			'title'		=> __( 'Available Actions', 'ideaboard' ),
			'content'	=>
				'<p>' . __( 'Hovering over a row in the forums list will display action links that allow you to manage your forum. You can perform the following actions:', 'ideaboard' ) . '</p>' .
				'<ul>' .
					'<li>' . __( '<strong>Edit</strong> takes you to the editing screen for that forum. You can also reach that screen by clicking on the forum title.',                                                                              'ideaboard' ) . '</li>' .
					'<li>' . __( '<strong>Trash</strong> removes your forum from this list and places it in the trash, from which you can permanently delete it.',                                                                                    'ideaboard' ) . '</li>' .
					'<li>' . __( '<strong>View</strong> will show you what your draft forum will look like if you publish it. View will take you to your live site to view the forum. Which link is available depends on your forum&#8217;s status.', 'ideaboard' ) . '</li>' .
				'</ul>'
		) );

		// Bulk Actions
		get_current_screen()->add_help_tab( array(
			'id'		=> 'bulk-actions',
			'title'		=> __( 'Bulk Actions', 'ideaboard' ),
			'content'	=>
				'<p>' . __( 'You can also edit or move multiple forums to the trash at once. Select the forums you want to act on using the checkboxes, then select the action you want to take from the Bulk Actions menu and click Apply.',           'ideaboard' ) . '</p>' .
				'<p>' . __( 'When using Bulk Edit, you can change the metadata (categories, author, etc.) for all selected forums at once. To remove a forum from the grouping, just click the x next to its name in the Bulk Edit area that appears.', 'ideaboard' ) . '</p>'
		) );

		// Help Sidebar
		get_current_screen()->set_help_sidebar(
			'<p><strong>' . __( 'For more information:', 'ideaboard' ) . '</strong></p>' .
			'<p>' . __( '<a href="http://codex.ideaboard.org" target="_blank">IdeaBoard Documentation</a>',    'ideaboard' ) . '</p>' .
			'<p>' . __( '<a href="http://ideaboard.org/forums/" target="_blank">IdeaBoard Support Forums</a>', 'ideaboard' ) . '</p>'
		);
	}

	/**
	 * Contextual help for IdeaBoard forum edit page
	 *
	 * @since IdeaBoard (r3119)
	 * @uses get_current_screen()
	 */
	public function new_help() {

		if ( $this->bail() ) return;

		$customize_display = '<p>' . __( 'The title field and the big forum editing Area are fixed in place, but you can reposition all the other boxes using drag and drop, and can minimize or expand them by clicking the title bar of each box. Use the Screen Options tab to unhide more boxes (Excerpt, Send Trackbacks, Custom Fields, Discussion, Slug, Author) or to choose a 1- or 2-column layout for this screen.', 'ideaboard' ) . '</p>';

		get_current_screen()->add_help_tab( array(
			'id'      => 'customize-display',
			'title'   => __( 'Customizing This Display', 'ideaboard' ),
			'content' => $customize_display,
		) );

		get_current_screen()->add_help_tab( array(
			'id'      => 'title-forum-editor',
			'title'   => __( 'Title and Forum Editor', 'ideaboard' ),
			'content' =>
				'<p>' . __( '<strong>Title</strong> - Enter a title for your forum. After you enter a title, you&#8217;ll see the permalink below, which you can edit.', 'ideaboard' ) . '</p>' .
				'<p>' . __( '<strong>Forum Editor</strong> - Enter the text for your forum. There are two modes of editing: Visual and HTML. Choose the mode by clicking on the appropriate tab. Visual mode gives you a WYSIWYG editor. Click the last icon in the row to get a second row of controls. The HTML mode allows you to enter raw HTML along with your forum text. You can insert media files by clicking the icons above the forum editor and following the directions. You can go to the distraction-free writing screen via the Fullscreen icon in Visual mode (second to last in the top row) or the Fullscreen button in HTML mode (last in the row). Once there, you can make buttons visible by hovering over the top area. Exit Fullscreen back to the regular forum editor.', 'ideaboard' ) . '</p>'
		) );

		$publish_box = '<p>' . __( '<strong>Publish</strong> - You can set the terms of publishing your forum in the Publish box. For Status, Visibility, and Publish (immediately), click on the Edit link to reveal more options. Visibility includes options for password-protecting a forum or making it stay at the top of your blog indefinitely (sticky). Publish (immediately) allows you to set a future or past date and time, so you can schedule a forum to be published in the future or backdate a forum.', 'ideaboard' ) . '</p>';

		if ( current_theme_supports( 'forum-thumbnails' ) && post_type_supports( 'forum', 'thumbnail' ) ) {
			$publish_box .= '<p>' . __( '<strong>Featured Image</strong> - This allows you to associate an image with your forum without inserting it. This is usually useful only if your theme makes use of the featured image as a forum thumbnail on the home page, a custom header, etc.', 'ideaboard' ) . '</p>';
		}

		get_current_screen()->add_help_tab( array(
			'id'      => 'forum-attributes',
			'title'   => __( 'Forum Attributes', 'ideaboard' ),
			'content' =>
				'<p>' . __( 'Select the attributes that your forum should have:', 'ideaboard' ) . '</p>' .
				'<ul>' .
					'<li>' . __( '<strong>Type</strong> indicates if the forum is a category or forum. Categories generally contain other forums.',                                                                                'ideaboard' ) . '</li>' .
					'<li>' . __( '<strong>Status</strong> allows you to close a forum to new topics and forums.',                                                                                                                  'ideaboard' ) . '</li>' .
					'<li>' . __( '<strong>Visibility</strong> lets you pick the scope of each forum and what users are allowed to access it.',                                                                                     'ideaboard' ) . '</li>' .
					'<li>' . __( '<strong>Parent</strong> dropdown determines the parent forum. Select the forum or category from the dropdown, or leave the default (No Parent) to create the forum at the root of your forums.', 'ideaboard' ) . '</li>' .
					'<li>' . __( '<strong>Order</strong> allows you to order your forums numerically.',                                                                                                                            'ideaboard' ) . '</li>' .
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
	 * Add the forum attributes metabox
	 *
	 * @since IdeaBoard (r2746)
	 *
	 * @uses ideaboard_get_forum_post_type() To get the forum post type
	 * @uses add_meta_box() To add the metabox
	 * @uses do_action() Calls 'ideaboard_forum_attributes_metabox'
	 */
	public function attributes_metabox() {

		if ( $this->bail() ) return;

		add_meta_box (
			'ideaboard_forum_attributes',
			__( 'Forum Attributes', 'ideaboard' ),
			'ideaboard_forum_metabox',
			$this->post_type,
			'side',
			'high'
		);

		do_action( 'ideaboard_forum_attributes_metabox' );
	}

	/**
	 * Pass the forum attributes for processing
	 *
	 * @since IdeaBoard (r2746)
	 *
	 * @param int $forum_id Forum id
	 * @uses current_user_can() To check if the current user is capable of
	 *                           editing the forum
	 * @uses ideaboard_get_forum() To get the forum
	 * @uses ideaboard_is_forum_closed() To check if the forum is closed
	 * @uses ideaboard_is_forum_category() To check if the forum is a category
	 * @uses ideaboard_is_forum_private() To check if the forum is private
	 * @uses ideaboard_close_forum() To close the forum
	 * @uses ideaboard_open_forum() To open the forum
	 * @uses ideaboard_categorize_forum() To make the forum a category
	 * @uses ideaboard_normalize_forum() To make the forum normal (not category)
	 * @uses ideaboard_privatize_forum() To mark the forum as private
	 * @uses ideaboard_publicize_forum() To mark the forum as public
	 * @uses do_action() Calls 'ideaboard_forum_attributes_metabox_save' with the
	 *                    forum id
	 * @return int Forum id
	 */
	public function attributes_metabox_save( $forum_id ) {

		if ( $this->bail() ) return $forum_id;

		// Bail if doing an autosave
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $forum_id;

		// Bail if not a post request
		if ( ! ideaboard_is_post_request() )
			return $forum_id;

		// Nonce check
		if ( empty( $_POST['ideaboard_forum_metabox'] ) || !wp_verify_nonce( $_POST['ideaboard_forum_metabox'], 'ideaboard_forum_metabox_save' ) )
			return $forum_id;

		// Only save for forum post-types
		if ( ! ideaboard_is_forum( $forum_id ) )
			return $forum_id;

		// Bail if current user cannot edit this forum
		if ( !current_user_can( 'edit_forum', $forum_id ) )
			return $forum_id;

		// Parent ID
		$parent_id = ( !empty( $_POST['parent_id'] ) && is_numeric( $_POST['parent_id'] ) ) ? (int) $_POST['parent_id'] : 0;

		// Update the forum meta bidness
		ideaboard_update_forum( array(
			'forum_id'    => $forum_id,
			'post_parent' => (int) $parent_id
		) );

		do_action( 'ideaboard_forum_attributes_metabox_save', $forum_id );

		return $forum_id;
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

			#misc-publishing-actions,
			#save-post {
				display: none;
			}

			strong.label {
				display: inline-block;
				width: 60px;
			}

			#ideaboard_forum_attributes hr {
				border-style: solid;
				border-width: 1px;
				border-color: #ccc #fff #fff #ccc;
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
	 * Manage the column headers for the forums page
	 *
	 * @since IdeaBoard (r2485)
	 *
	 * @param array $columns The columns
	 * @uses apply_filters() Calls 'ideaboard_admin_forums_column_headers' with
	 *                        the columns
	 * @return array $columns IdeaBoard forum columns
	 */
	public function column_headers( $columns ) {

		if ( $this->bail() ) return $columns;

		$columns = array (
			'cb'                    => '<input type="checkbox" />',
			'title'                 => __( 'Forum',     'ideaboard' ),
			'ideaboard_forum_topic_count' => __( 'Topics',    'ideaboard' ),
			'ideaboard_forum_reply_count' => __( 'Replies',   'ideaboard' ),
			'author'                => __( 'Creator',   'ideaboard' ),
			'ideaboard_forum_created'     => __( 'Created' ,  'ideaboard' ),
			'ideaboard_forum_freshness'   => __( 'Freshness', 'ideaboard' )
		);

		return apply_filters( 'ideaboard_admin_forums_column_headers', $columns );
	}

	/**
	 * Print extra columns for the forums page
	 *
	 * @since IdeaBoard (r2485)
	 *
	 * @param string $column Column
	 * @param int $forum_id Forum id
	 * @uses ideaboard_forum_topic_count() To output the forum topic count
	 * @uses ideaboard_forum_reply_count() To output the forum reply count
	 * @uses get_the_date() Get the forum creation date
	 * @uses get_the_time() Get the forum creation time
	 * @uses esc_attr() To sanitize the forum creation time
	 * @uses ideaboard_get_forum_last_active_time() To get the time when the forum was
	 *                                    last active
	 * @uses do_action() Calls 'ideaboard_admin_forums_column_data' with the
	 *                    column and forum id
	 */
	public function column_data( $column, $forum_id ) {

		if ( $this->bail() ) return;

		switch ( $column ) {
			case 'ideaboard_forum_topic_count' :
				ideaboard_forum_topic_count( $forum_id );
				break;

			case 'ideaboard_forum_reply_count' :
				ideaboard_forum_reply_count( $forum_id );
				break;

			case 'ideaboard_forum_created':
				printf( '%1$s <br /> %2$s',
					get_the_date(),
					esc_attr( get_the_time() )
				);

				break;

			case 'ideaboard_forum_freshness' :
				$last_active = ideaboard_get_forum_last_active_time( $forum_id, false );
				if ( !empty( $last_active ) )
					echo esc_html( $last_active );
				else
					esc_html_e( 'No Topics', 'ideaboard' );

				break;

			default:
				do_action( 'ideaboard_admin_forums_column_data', $column, $forum_id );
				break;
		}
	}

	/**
	 * Forum Row actions
	 *
	 * Remove the quick-edit action link and display the description under
	 * the forum title
	 *
	 * @since IdeaBoard (r2577)
	 *
	 * @param array $actions Actions
	 * @param array $forum Forum object
	 * @uses ideaboard_forum_content() To output forum description
	 * @return array $actions Actions
	 */
	public function row_actions( $actions, $forum ) {

		if ( $this->bail() ) return $actions;

		unset( $actions['inline hide-if-no-js'] );

		// simple hack to show the forum description under the title
		ideaboard_forum_content( $forum->ID );

		return $actions;
	}

	/**
	 * Custom user feedback messages for forum post type
	 *
	 * @since IdeaBoard (r3080)
	 *
	 * @global int $post_ID
	 * @uses ideaboard_get_forum_permalink()
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

		// URL for the current forum
		$forum_url = ideaboard_get_forum_permalink( $post_ID );

		// Current forum's post_date
		$post_date = ideaboard_get_global_post_field( 'post_date', 'raw' );

		// Messages array
		$messages[$this->post_type] = array(
			0 =>  '', // Left empty on purpose

			// Updated
			1 =>  sprintf( __( 'Forum updated. <a href="%s">View forum</a>', 'ideaboard' ), $forum_url ),

			// Custom field updated
			2 => __( 'Custom field updated.', 'ideaboard' ),

			// Custom field deleted
			3 => __( 'Custom field deleted.', 'ideaboard' ),

			// Forum updated
			4 => __( 'Forum updated.', 'ideaboard' ),

			// Restored from revision
			// translators: %s: date and time of the revision
			5 => isset( $_GET['revision'] )
					? sprintf( __( 'Forum restored to revision from %s', 'ideaboard' ), wp_post_revision_title( (int) $_GET['revision'], false ) )
					: false,

			// Forum created
			6 => sprintf( __( 'Forum created. <a href="%s">View forum</a>', 'ideaboard' ), $forum_url ),

			// Forum saved
			7 => __( 'Forum saved.', 'ideaboard' ),

			// Forum submitted
			8 => sprintf( __( 'Forum submitted. <a target="_blank" href="%s">Preview forum</a>', 'ideaboard' ), esc_url( add_query_arg( 'preview', 'true', $forum_url ) ) ),

			// Forum scheduled
			9 => sprintf( __( 'Forum scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview forum</a>', 'ideaboard' ),
					// translators: Publish box date format, see http://php.net/date
					date_i18n( __( 'M j, Y @ G:i', 'ideaboard' ),
					strtotime( $post_date ) ),
					$forum_url ),

			// Forum draft updated
			10 => sprintf( __( 'Forum draft updated. <a target="_blank" href="%s">Preview forum</a>', 'ideaboard' ), esc_url( add_query_arg( 'preview', 'true', $forum_url ) ) ),
		);

		return $messages;
	}
}
endif; // class_exists check

/**
 * Setup IdeaBoard Forums Admin
 *
 * This is currently here to make hooking and unhooking of the admin UI easy.
 * It could use dependency injection in the future, but for now this is easier.
 *
 * @since IdeaBoard (r2596)
 *
 * @uses BBP_Forums_Admin
 */
function ideaboard_admin_forums() {
	ideaboard()->admin->forums = new BBP_Forums_Admin();
}
