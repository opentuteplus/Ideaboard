<?php

/**
 * IdeaBoard Admin Metaboxes
 *
 * @package IdeaBoard
 * @subpackage Administration
 */

/** Dashboard *****************************************************************/

/**
 * IdeaBoard Dashboard Right Now Widget
 *
 * Adds a dashboard widget with forum statistics
 *
 * @since IdeaBoard (r2770)
 *
 * @uses ideaboard_get_version() To get the current IdeaBoard version
 * @uses ideaboard_get_statistics() To get the forum statistics
 * @uses current_user_can() To check if the user is capable of doing things
 * @uses ideaboard_get_forum_post_type() To get the forum post type
 * @uses ideaboard_get_topic_post_type() To get the topic post type
 * @uses ideaboard_get_reply_post_type() To get the reply post type
 * @uses get_admin_url() To get the administration url
 * @uses add_query_arg() To add custom args to the url
 * @uses do_action() Calls 'ideaboard_dashboard_widget_right_now_content_table_end'
 *                    below the content table
 * @uses do_action() Calls 'ideaboard_dashboard_widget_right_now_table_end'
 *                    below the discussion table
 * @uses do_action() Calls 'ideaboard_dashboard_widget_right_now_discussion_table_end'
 *                    below the discussion table
 * @uses do_action() Calls 'ideaboard_dashboard_widget_right_now_end' below the widget
 */
function ideaboard_dashboard_widget_right_now() {

	// Get the statistics
	$r = ideaboard_get_statistics(); ?>

	<div class="table table_content">

		<p class="sub"><?php esc_html_e( 'Discussion', 'ideaboard' ); ?></p>

		<table>

			<tr class="first">

				<?php
					$num  = $r['forum_count'];
					$text = _n( 'Forum', 'Forums', $r['forum_count'], 'ideaboard' );
					if ( current_user_can( 'publish_forums' ) ) {
						$link = add_query_arg( array( 'post_type' => ideaboard_get_forum_post_type() ), get_admin_url( null, 'edit.php' ) );
						$num  = '<a href="' . esc_url( $link ) . '">' . $num  . '</a>';
						$text = '<a href="' . esc_url( $link ) . '">' . $text . '</a>';
					}
				?>

				<td class="first b b-forums"><?php echo $num; ?></td>
				<td class="t forums"><?php echo $text; ?></td>

			</tr>

			<tr>

				<?php
					$num  = $r['topic_count'];
					$text = _n( 'Topic', 'Topics', $r['topic_count'], 'ideaboard' );
					if ( current_user_can( 'publish_topics' ) ) {
						$link = add_query_arg( array( 'post_type' => ideaboard_get_topic_post_type() ), get_admin_url( null, 'edit.php' ) );
						$num  = '<a href="' . esc_url( $link ) . '">' . $num  . '</a>';
						$text = '<a href="' . esc_url( $link ) . '">' . $text . '</a>';
					}
				?>

				<td class="first b b-topics"><?php echo $num; ?></td>
				<td class="t topics"><?php echo $text; ?></td>

			</tr>

			<tr>

				<?php
					$num  = $r['reply_count'];
					$text = _n( 'Reply', 'Replies', $r['reply_count'], 'ideaboard' );
					if ( current_user_can( 'publish_replies' ) ) {
						$link = add_query_arg( array( 'post_type' => ideaboard_get_reply_post_type() ), get_admin_url( null, 'edit.php' ) );
						$num  = '<a href="' . esc_url( $link ) . '">' . $num  . '</a>';
						$text = '<a href="' . esc_url( $link ) . '">' . $text . '</a>';
					}
				?>

				<td class="first b b-replies"><?php echo $num; ?></td>
				<td class="t replies"><?php echo $text; ?></td>

			</tr>

			<?php if ( ideaboard_allow_topic_tags() ) : ?>

				<tr>

					<?php
						$num  = $r['topic_tag_count'];
						$text = _n( 'Topic Tag', 'Topic Tags', $r['topic_tag_count'], 'ideaboard' );
						if ( current_user_can( 'manage_topic_tags' ) ) {
							$link = add_query_arg( array( 'taxonomy' => ideaboard_get_topic_tag_tax_id(), 'post_type' => ideaboard_get_topic_post_type() ), get_admin_url( null, 'edit-tags.php' ) );
							$num  = '<a href="' . esc_url( $link ) . '">' . $num  . '</a>';
							$text = '<a href="' . esc_url( $link ) . '">' . $text . '</a>';
						}
					?>

					<td class="first b b-topic_tags"><span class="total-count"><?php echo $num; ?></span></td>
					<td class="t topic_tags"><?php echo $text; ?></td>

				</tr>

			<?php endif; ?>

			<?php do_action( 'ideaboard_dashboard_widget_right_now_content_table_end' ); ?>

		</table>

	</div>


	<div class="table table_discussion">

		<p class="sub"><?php esc_html_e( 'Users &amp; Moderation', 'ideaboard' ); ?></p>

		<table>

			<tr class="first">

				<?php
					$num  = $r['user_count'];
					$text = _n( 'User', 'Users', $r['user_count'], 'ideaboard' );
					if ( current_user_can( 'edit_users' ) ) {
						$link = get_admin_url( null, 'users.php' );
						$num  = '<a href="' . esc_url( $link ) . '">' . $num  . '</a>';
						$text = '<a href="' . esc_url( $link ) . '">' . $text . '</a>';
					}
				?>

				<td class="b b-users"><span class="total-count"><?php echo $num; ?></span></td>
				<td class="last t users"><?php echo $text; ?></td>

			</tr>

			<?php if ( isset( $r['topic_count_hidden'] ) ) : ?>

				<tr>

					<?php
						$num  = $r['topic_count_hidden'];
						$text = _n( 'Hidden Topic', 'Hidden Topics', $r['topic_count_hidden'], 'ideaboard' );
						$link = add_query_arg( array( 'post_type' => ideaboard_get_topic_post_type() ), get_admin_url( null, 'edit.php' ) );
						if ( '0' !== $num ) {
							$link = add_query_arg( array( 'post_status' => ideaboard_get_spam_status_id() ), $link );
						}
                        $num  = '<a href="' . esc_url( $link ) . '" title="' . esc_attr( $r['hidden_topic_title'] ) . '">' . $num  . '</a>';
						$text = '<a class="waiting" href="' . esc_url( $link ) . '" title="' . esc_attr( $r['hidden_topic_title'] ) . '">' . $text . '</a>';
					?>

					<td class="b b-hidden-topics"><?php echo $num; ?></td>
					<td class="last t hidden-replies"><?php echo $text; ?></td>

				</tr>

			<?php endif; ?>

			<?php if ( isset( $r['reply_count_hidden'] ) ) : ?>

				<tr>

					<?php
						$num  = $r['reply_count_hidden'];
						$text = _n( 'Hidden Reply', 'Hidden Replies', $r['reply_count_hidden'], 'ideaboard' );
						$link = add_query_arg( array( 'post_type' => ideaboard_get_reply_post_type() ), get_admin_url( null, 'edit.php' ) );
						if ( '0' !== $num ) {
							$link = add_query_arg( array( 'post_status' => ideaboard_get_spam_status_id() ), $link );
						}
                        $num  = '<a href="' . esc_url( $link ) . '" title="' . esc_attr( $r['hidden_reply_title'] ) . '">' . $num  . '</a>';
						$text = '<a class="waiting" href="' . esc_url( $link ) . '" title="' . esc_attr( $r['hidden_reply_title'] ) . '">' . $text . '</a>';
					?>

					<td class="b b-hidden-replies"><?php echo $num; ?></td>
					<td class="last t hidden-replies"><?php echo $text; ?></td>

				</tr>

			<?php endif; ?>

			<?php if ( ideaboard_allow_topic_tags() && isset( $r['empty_topic_tag_count'] ) ) : ?>

				<tr>

					<?php
						$num  = $r['empty_topic_tag_count'];
						$text = _n( 'Empty Topic Tag', 'Empty Topic Tags', $r['empty_topic_tag_count'], 'ideaboard' );
						$link = add_query_arg( array( 'taxonomy' => ideaboard_get_topic_tag_tax_id(), 'post_type' => ideaboard_get_topic_post_type() ), get_admin_url( null, 'edit-tags.php' ) );
						$num  = '<a href="' . esc_url( $link ) . '">' . $num  . '</a>';
						$text = '<a class="waiting" href="' . esc_url( $link ) . '">' . $text . '</a>';
					?>

					<td class="b b-hidden-topic-tags"><?php echo $num; ?></td>
					<td class="last t hidden-topic-tags"><?php echo $text; ?></td>

				</tr>

			<?php endif; ?>

			<?php do_action( 'ideaboard_dashboard_widget_right_now_discussion_table_end' ); ?>

		</table>

	</div>

	<?php do_action( 'ideaboard_dashboard_widget_right_now_table_end' ); ?>

	<div class="versions">

		<span id="wp-version-message">
			<?php printf( __( 'You are using <span class="b">IdeaBoard %s</span>.', 'ideaboard' ), ideaboard_get_version() ); ?>
		</span>

	</div>

	<br class="clear" />

	<?php

	do_action( 'ideaboard_dashboard_widget_right_now_end' );
}

/** Forums ********************************************************************/

/**
 * Forum metabox
 *
 * The metabox that holds all of the additional forum information
 *
 * @since IdeaBoard (r2744)
 *
 * @uses ideaboard_is_forum_closed() To check if a forum is closed or not
 * @uses ideaboard_is_forum_category() To check if a forum is a category or not
 * @uses ideaboard_is_forum_private() To check if a forum is private or not
 * @uses ideaboard_dropdown() To show a dropdown of the forums for forum parent
 * @uses do_action() Calls 'ideaboard_forum_metabox'
 */
function ideaboard_forum_metabox() {

	// Post ID
	$post_id     = get_the_ID();
	$post_parent = ideaboard_get_global_post_field( 'post_parent', 'raw'  );
	$menu_order  = ideaboard_get_global_post_field( 'menu_order',  'edit' );

	/** Type ******************************************************************/

	?>

	<p>
		<strong class="label"><?php esc_html_e( 'Type:', 'ideaboard' ); ?></strong>
		<label class="screen-reader-text" for="ideaboard_forum_type_select"><?php esc_html_e( 'Type:', 'ideaboard' ) ?></label>
		<?php ideaboard_form_forum_type_dropdown( array( 'forum_id' => $post_id ) ); ?>
	</p>

	<?php

	/** Status ****************************************************************/

	?>

	<p>
		<strong class="label"><?php esc_html_e( 'Status:', 'ideaboard' ); ?></strong>
		<label class="screen-reader-text" for="ideaboard_forum_status_select"><?php esc_html_e( 'Status:', 'ideaboard' ) ?></label>
		<?php ideaboard_form_forum_status_dropdown( array( 'forum_id' => $post_id ) ); ?>
	</p>

	<?php

	/** Visibility ************************************************************/

	?>

	<p>
		<strong class="label"><?php esc_html_e( 'Visibility:', 'ideaboard' ); ?></strong>
		<label class="screen-reader-text" for="ideaboard_forum_visibility_select"><?php esc_html_e( 'Visibility:', 'ideaboard' ) ?></label>
		<?php ideaboard_form_forum_visibility_dropdown( array( 'forum_id' => $post_id ) ); ?>
	</p>

	<hr />

	<?php

	/** Parent ****************************************************************/

	?>

	<p>
		<strong class="label"><?php esc_html_e( 'Parent:', 'ideaboard' ); ?></strong>
		<label class="screen-reader-text" for="parent_id"><?php esc_html_e( 'Forum Parent', 'ideaboard' ); ?></label>
		<?php ideaboard_dropdown( array(
			'post_type'          => ideaboard_get_forum_post_type(),
			'selected'           => $post_parent,
			'numberposts'        => -1,
			'orderby'            => 'title',
			'order'              => 'ASC',
			'walker'             => '',
			'exclude'            => $post_id,

			// Output-related
			'select_id'          => 'parent_id',
			'tab'                => ideaboard_get_tab_index(),
			'options_only'       => false,
			'show_none'          => __( '&mdash; No parent &mdash;', 'ideaboard' ),
			'disable_categories' => false,
			'disabled'           => ''
		) ); ?>
	</p>

	<p>
		<strong class="label"><?php esc_html_e( 'Order:', 'ideaboard' ); ?></strong>
		<label class="screen-reader-text" for="menu_order"><?php esc_html_e( 'Forum Order', 'ideaboard' ); ?></label>
		<input name="menu_order" type="number" step="1" size="4" id="menu_order" value="<?php echo esc_attr( $menu_order ); ?>" />
	</p>

	<input name="ping_status" type="hidden" id="ping_status" value="open" />

	<?php
	wp_nonce_field( 'ideaboard_forum_metabox_save', 'ideaboard_forum_metabox' );
	do_action( 'ideaboard_forum_metabox', $post_id );
}

/** Topics ********************************************************************/

/**
 * Topic metabox
 *
 * The metabox that holds all of the additional topic information
 *
 * @since IdeaBoard (r2464)
 *
 * @uses ideaboard_get_topic_forum_id() To get the topic forum id
 * @uses do_action() Calls 'ideaboard_topic_metabox'
 */
function ideaboard_topic_metabox() {

	// Post ID
	$post_id = get_the_ID();

	/** Type ******************************************************************/

	?>

	<p>
		<strong class="label"><?php esc_html_e( 'Type:', 'ideaboard' ); ?></strong>
		<label class="screen-reader-text" for="ideaboard_stick_topic"><?php esc_html_e( 'Topic Type', 'ideaboard' ); ?></label>
		<?php ideaboard_form_topic_type_dropdown( array( 'topic_id' => $post_id ) ); ?>
	</p>

	<?php

	/** Status ****************************************************************/

	?>

	<p>
		<strong class="label"><?php esc_html_e( 'Status:', 'ideaboard' ); ?></strong>
		<label class="screen-reader-text" for="ideaboard_open_close_topic"><?php esc_html_e( 'Select whether to open or close the topic.', 'ideaboard' ); ?></label>
		<?php ideaboard_form_topic_status_dropdown( array( 'select_id' => 'post_status', 'topic_id' => $post_id ) ); ?>
	</p>

	<?php

	/** Parent *****************************************************************/

	?>

	<p>
		<strong class="label"><?php esc_html_e( 'Forum:', 'ideaboard' ); ?></strong>
		<label class="screen-reader-text" for="parent_id"><?php esc_html_e( 'Forum', 'ideaboard' ); ?></label>
		<?php ideaboard_dropdown( array(
			'post_type'          => ideaboard_get_forum_post_type(),
			'selected'           => ideaboard_get_topic_forum_id( $post_id ),
			'numberposts'        => -1,
			'orderby'            => 'title',
			'order'              => 'ASC',
			'walker'             => '',
			'exclude'            => '',

			// Output-related
			'select_id'          => 'parent_id',
			'tab'                => ideaboard_get_tab_index(),
			'options_only'       => false,
			'show_none'          => __( '&mdash; No parent &mdash;', 'ideaboard' ),
			'disable_categories' => current_user_can( 'edit_forums' ),
			'disabled'           => ''
		) ); ?>
	</p>

	<input name="ping_status" type="hidden" id="ping_status" value="open" />

	<?php
	wp_nonce_field( 'ideaboard_topic_metabox_save', 'ideaboard_topic_metabox' );
	do_action( 'ideaboard_topic_metabox', $post_id );
}

/** Replies *******************************************************************/

/**
 * Reply metabox
 *
 * The metabox that holds all of the additional reply information
 *
 * @since IdeaBoard (r2464)
 *
 * @uses ideaboard_get_topic_post_type() To get the topic post type
 * @uses do_action() Calls 'ideaboard_reply_metabox'
 */
function ideaboard_reply_metabox() {

	// Post ID
	$post_id = get_the_ID();

	// Get some meta
	$reply_topic_id = ideaboard_get_reply_topic_id( $post_id );
	$reply_forum_id = ideaboard_get_reply_forum_id( $post_id );
	$reply_to       = ideaboard_get_reply_to(       $post_id );

	// Allow individual manipulation of reply forum
	if ( current_user_can( 'edit_others_replies' ) || current_user_can( 'moderate' ) ) : ?>

		<p>
			<strong class="label"><?php esc_html_e( 'Forum:', 'ideaboard' ); ?></strong>
			<label class="screen-reader-text" for="ideaboard_forum_id"><?php esc_html_e( 'Forum', 'ideaboard' ); ?></label>
			<?php ideaboard_dropdown( array(
				'post_type'          => ideaboard_get_forum_post_type(),
				'selected'           => $reply_forum_id,
				'numberposts'        => -1,
				'orderby'            => 'title',
				'order'              => 'ASC',
				'walker'             => '',
				'exclude'            => '',

				// Output-related
				'select_id'          => 'ideaboard_forum_id',
				'tab'                => ideaboard_get_tab_index(),
				'options_only'       => false,
				'show_none'          => __( '&mdash; No parent &mdash;', 'ideaboard' ),
				'disable_categories' => current_user_can( 'edit_forums' ),
				'disabled'           => ''
			) ); ?>
		</p>

	<?php endif; ?>

	<p>
		<strong class="label"><?php esc_html_e( 'Topic:', 'ideaboard' ); ?></strong>
		<label class="screen-reader-text" for="parent_id"><?php esc_html_e( 'Topic', 'ideaboard' ); ?></label>
		<input name="parent_id" id="ideaboard_topic_id" type="text" value="<?php echo esc_attr( $reply_topic_id ); ?>" data-ajax-url="<?php echo esc_url( wp_nonce_url( add_query_arg( array( 'action' => 'ideaboard_suggest_topic' ), admin_url( 'admin-ajax.php', 'relative' ) ) ), 'ideaboard_suggest_topic_nonce' ); ?>" />
	</p>

	<p>
		<strong class="label"><?php esc_html_e( 'Reply To:', 'ideaboard' ); ?></strong>
		<label class="screen-reader-text" for="ideaboard_reply_to"><?php esc_html_e( 'Reply To', 'ideaboard' ); ?></label>
		<input name="ideaboard_reply_to" id="ideaboard_reply_to" type="text" value="<?php echo esc_attr( $reply_to ); ?>" />
	</p>

	<input name="ping_status" type="hidden" id="ping_status" value="open" />

	<?php
	wp_nonce_field( 'ideaboard_reply_metabox_save', 'ideaboard_reply_metabox' );
	do_action( 'ideaboard_reply_metabox', $post_id );
}

/** Users *********************************************************************/

/**
 * Anonymous user information metabox
 *
 * @since IdeaBoard (r2828)
 *
 * @uses ideaboard_is_reply_anonymous() To check if reply is anonymous
 * @uses ideaboard_is_topic_anonymous() To check if topic is anonymous
 * @uses get_the_ID() To get the global post ID
 * @uses get_post_meta() To get the author user information
 */
function ideaboard_author_metabox() {

	// Post ID
	$post_id = get_the_ID();

	// Show extra bits if topic/reply is anonymous
	if ( ideaboard_is_reply_anonymous( $post_id ) || ideaboard_is_topic_anonymous( $post_id ) ) : ?>

		<p>
			<strong class="label"><?php esc_html_e( 'Name:', 'ideaboard' ); ?></strong>
			<label class="screen-reader-text" for="ideaboard_anonymous_name"><?php esc_html_e( 'Name', 'ideaboard' ); ?></label>
			<input type="text" id="ideaboard_anonymous_name" name="ideaboard_anonymous_name" value="<?php echo esc_attr( get_post_meta( $post_id, '_ideaboard_anonymous_name', true ) ); ?>" />
		</p>

		<p>
			<strong class="label"><?php esc_html_e( 'Email:', 'ideaboard' ); ?></strong>
			<label class="screen-reader-text" for="ideaboard_anonymous_email"><?php esc_html_e( 'Email', 'ideaboard' ); ?></label>
			<input type="text" id="ideaboard_anonymous_email" name="ideaboard_anonymous_email" value="<?php echo esc_attr( get_post_meta( $post_id, '_ideaboard_anonymous_email', true ) ); ?>" />
		</p>

		<p>
			<strong class="label"><?php esc_html_e( 'Website:', 'ideaboard' ); ?></strong>
			<label class="screen-reader-text" for="ideaboard_anonymous_website"><?php esc_html_e( 'Website', 'ideaboard' ); ?></label>
			<input type="text" id="ideaboard_anonymous_website" name="ideaboard_anonymous_website" value="<?php echo esc_attr( get_post_meta( $post_id, '_ideaboard_anonymous_website', true ) ); ?>" />
		</p>

	<?php else : ?>

		<p>
			<strong class="label"><?php esc_html_e( 'ID:', 'ideaboard' ); ?></strong>
			<label class="screen-reader-text" for="ideaboard_author_id"><?php esc_html_e( 'ID', 'ideaboard' ); ?></label>
			<input type="text" id="ideaboard_author_id" name="post_author_override" value="<?php echo esc_attr( ideaboard_get_global_post_field( 'post_author' ) ); ?>" data-ajax-url="<?php echo esc_url( wp_nonce_url( add_query_arg( array( 'action' => 'ideaboard_suggest_user' ), admin_url( 'admin-ajax.php', 'relative' ) ) ), 'ideaboard_suggest_user_nonce' ); ?>" />
		</p>

	<?php endif; ?>

	<p>
		<strong class="label"><?php esc_html_e( 'IP:', 'ideaboard' ); ?></strong>
		<label class="screen-reader-text" for="ideaboard_author_ip_address"><?php esc_html_e( 'IP Address', 'ideaboard' ); ?></label>
		<input type="text" id="ideaboard_author_ip_address" name="ideaboard_author_ip_address" value="<?php echo esc_attr( get_post_meta( $post_id, '_ideaboard_author_ip', true ) ); ?>" disabled="disabled" />
	</p>

	<?php

	do_action( 'ideaboard_author_metabox', $post_id );
}
