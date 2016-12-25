<?php

/**
 * User Profile
 *
 * @package IdeaBoard
 * @subpackage Theme
 */

?>

	<?php do_action( 'ideaboard_template_before_user_profile' ); ?>

	<div id="ideaboard-user-profile" class="ideaboard-user-profile">
		<h2 class="entry-title"><?php _e( 'Profile', 'ideaboard' ); ?></h2>
		<div class="ideaboard-user-section">

			<?php if ( ideaboard_get_displayed_user_field( 'description' ) ) : ?>

				<p class="ideaboard-user-description"><?php ideaboard_displayed_user_field( 'description' ); ?></p>

			<?php endif; ?>

			<p class="ideaboard-user-forum-role"><?php  printf( __( 'Forum Role: %s',      'ideaboard' ), ideaboard_get_user_display_role()    ); ?></p>
			<p class="ideaboard-user-topic-count"><?php printf( __( 'Topics Started: %s',  'ideaboard' ), ideaboard_get_user_topic_count_raw() ); ?></p>
			<p class="ideaboard-user-reply-count"><?php printf( __( 'Replies Created: %s', 'ideaboard' ), ideaboard_get_user_reply_count_raw() ); ?></p>
		</div>
	</div><!-- #ideaboard-author-topics-started -->

	<?php do_action( 'ideaboard_template_after_user_profile' ); ?>
