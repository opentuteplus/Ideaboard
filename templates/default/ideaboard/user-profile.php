<?php

/**
 * User Profile
 *
 * @package IdeaBoard
 * @subpackage Theme
 */

?>

	<?php do_action( 'ideaboard_template_before_user_profile' ); ?>

	<div id="bbp-user-profile" class="bbp-user-profile">
		<h2 class="entry-title"><?php _e( 'Profile', 'ideaboard' ); ?></h2>
		<div class="bbp-user-section">

			<?php if ( ideaboard_get_displayed_user_field( 'description' ) ) : ?>

				<p class="bbp-user-description"><?php ideaboard_displayed_user_field( 'description' ); ?></p>

			<?php endif; ?>

			<p class="bbp-user-forum-role"><?php  printf( __( 'Forum Role: %s',      'ideaboard' ), ideaboard_get_user_display_role()    ); ?></p>
			<p class="bbp-user-topic-count"><?php printf( __( 'Topics Started: %s',  'ideaboard' ), ideaboard_get_user_topic_count_raw() ); ?></p>
			<p class="bbp-user-reply-count"><?php printf( __( 'Replies Created: %s', 'ideaboard' ), ideaboard_get_user_reply_count_raw() ); ?></p>
		</div>
	</div><!-- #bbp-author-topics-started -->

	<?php do_action( 'ideaboard_template_after_user_profile' ); ?>
