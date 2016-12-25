<?php

/**
 * Move Reply
 *
 * @package IdeaBoard
 * @subpackage Theme
 */

?>

<div id="ideaboard-forums">

	<?php ideaboard_breadcrumb(); ?>

	<?php if ( is_user_logged_in() && current_user_can( 'edit_topic', ideaboard_get_topic_id() ) ) : ?>

		<div id="move-reply-<?php ideaboard_topic_id(); ?>" class="bbp-reply-move">

			<form id="move_reply" name="move_reply" method="post" action="<?php the_permalink(); ?>">

				<fieldset class="bbp-form">

					<legend><?php printf( __( 'Move reply "%s"', 'ideaboard' ), ideaboard_get_reply_title() ); ?></legend>

					<div>

						<div class="bbp-template-notice info">
							<p><?php _e( 'You can either make this reply a new topic with a new title, or merge it into an existing topic.', 'ideaboard' ); ?></p>
						</div>

						<div class="bbp-template-notice">
							<p><?php _e( 'If you choose an existing topic, replies will be ordered by the time and date they were created.', 'ideaboard' ); ?></p>
						</div>

						<fieldset class="bbp-form">
							<legend><?php _e( 'Move Method', 'ideaboard' ); ?></legend>

							<div>
								<input name="ideaboard_reply_move_option" id="ideaboard_reply_move_option_reply" type="radio" checked="checked" value="topic" tabindex="<?php ideaboard_tab_index(); ?>" />
								<label for="ideaboard_reply_move_option_reply"><?php printf( __( 'New topic in <strong>%s</strong> titled:', 'ideaboard' ), ideaboard_get_forum_title( ideaboard_get_reply_forum_id( ideaboard_get_reply_id() ) ) ); ?></label>
								<input type="text" id="ideaboard_reply_move_destination_title" value="<?php printf( __( 'Moved: %s', 'ideaboard' ), ideaboard_get_reply_title() ); ?>" tabindex="<?php ideaboard_tab_index(); ?>" size="35" name="ideaboard_reply_move_destination_title" />
							</div>

							<?php if ( ideaboard_has_topics( array( 'show_stickies' => false, 'post_parent' => ideaboard_get_reply_forum_id( ideaboard_get_reply_id() ), 'post__not_in' => array( ideaboard_get_reply_topic_id( ideaboard_get_reply_id() ) ) ) ) ) : ?>

								<div>
									<input name="ideaboard_reply_move_option" id="ideaboard_reply_move_option_existing" type="radio" value="existing" tabindex="<?php ideaboard_tab_index(); ?>" />
									<label for="ideaboard_reply_move_option_existing"><?php _e( 'Use an existing topic in this forum:', 'ideaboard' ); ?></label>

									<?php
										ideaboard_dropdown( array(
											'post_type'   => ideaboard_get_topic_post_type(),
											'post_parent' => ideaboard_get_reply_forum_id( ideaboard_get_reply_id() ),
											'selected'    => -1,
											'exclude'     => ideaboard_get_reply_topic_id( ideaboard_get_reply_id() ),
											'select_id'   => 'ideaboard_destination_topic'
										) );
									?>

								</div>

							<?php endif; ?>

						</fieldset>

						<div class="bbp-template-notice error">
							<p><?php _e( '<strong>WARNING:</strong> This process cannot be undone.', 'ideaboard' ); ?></p>
						</div>

						<div class="bbp-submit-wrapper">
							<button type="submit" tabindex="<?php ideaboard_tab_index(); ?>" id="ideaboard_move_reply_submit" name="ideaboard_move_reply_submit" class="button submit"><?php _e( 'Submit', 'ideaboard' ); ?></button>
						</div>
					</div>

					<?php ideaboard_move_reply_form_fields(); ?>

				</fieldset>
			</form>
		</div>

	<?php else : ?>

		<div id="no-reply-<?php ideaboard_reply_id(); ?>" class="bbp-no-reply">
			<div class="entry-content"><?php is_user_logged_in() ? _e( 'You do not have the permissions to edit this reply!', 'ideaboard' ) : _e( 'You cannot edit this reply.', 'ideaboard' ); ?></div>
		</div>

	<?php endif; ?>

</div>
