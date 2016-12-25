<?php

/**
 * Split Topic
 *
 * @package IdeaBoard
 * @subpackage Theme
 */

?>

<div id="ideaboard-forums">

	<?php ideaboard_breadcrumb(); ?>

	<?php if ( is_user_logged_in() && current_user_can( 'edit_topic', ideaboard_get_topic_id() ) ) : ?>

		<div id="split-topic-<?php ideaboard_topic_id(); ?>" class="ideaboard-topic-split">

			<form id="split_topic" name="split_topic" method="post" action="<?php the_permalink(); ?>">

				<fieldset class="ideaboard-form">

					<legend><?php printf( __( 'Split topic "%s"', 'ideaboard' ), ideaboard_get_topic_title() ); ?></legend>

					<div>

						<div class="ideaboard-template-notice info">
							<p><?php _e( 'When you split a topic, you are slicing it in half starting with the reply you just selected. Choose to use that reply as a new topic with a new title, or merge those replies into an existing topic.', 'ideaboard' ); ?></p>
						</div>

						<div class="ideaboard-template-notice">
							<p><?php _e( 'If you use the existing topic option, replies within both topics will be merged chronologically. The order of the merged replies is based on the time and date they were posted.', 'ideaboard' ); ?></p>
						</div>

						<fieldset class="ideaboard-form">
							<legend><?php _e( 'Split Method', 'ideaboard' ); ?></legend>

							<div>
								<input name="ideaboard_topic_split_option" id="ideaboard_topic_split_option_reply" type="radio" checked="checked" value="reply" tabindex="<?php ideaboard_tab_index(); ?>" />
								<label for="ideaboard_topic_split_option_reply"><?php printf( __( 'New topic in <strong>%s</strong> titled:', 'ideaboard' ), ideaboard_get_forum_title( ideaboard_get_topic_forum_id( ideaboard_get_topic_id() ) ) ); ?></label>
								<input type="text" id="ideaboard_topic_split_destination_title" value="<?php printf( __( 'Split: %s', 'ideaboard' ), ideaboard_get_topic_title() ); ?>" tabindex="<?php ideaboard_tab_index(); ?>" size="35" name="ideaboard_topic_split_destination_title" />
							</div>

							<?php if ( ideaboard_has_topics( array( 'show_stickies' => false, 'post_parent' => ideaboard_get_topic_forum_id( ideaboard_get_topic_id() ), 'post__not_in' => array( ideaboard_get_topic_id() ) ) ) ) : ?>

								<div>
									<input name="ideaboard_topic_split_option" id="ideaboard_topic_split_option_existing" type="radio" value="existing" tabindex="<?php ideaboard_tab_index(); ?>" />
									<label for="ideaboard_topic_split_option_existing"><?php _e( 'Use an existing topic in this forum:', 'ideaboard' ); ?></label>

									<?php
										ideaboard_dropdown( array(
											'post_type'   => ideaboard_get_topic_post_type(),
											'post_parent' => ideaboard_get_topic_forum_id( ideaboard_get_topic_id() ),
											'selected'    => -1,
											'exclude'     => ideaboard_get_topic_id(),
											'select_id'   => 'ideaboard_destination_topic'
										) );
									?>

								</div>

							<?php endif; ?>

						</fieldset>

						<fieldset class="ideaboard-form">
							<legend><?php _e( 'Topic Extras', 'ideaboard' ); ?></legend>

							<div>

								<?php if ( ideaboard_is_subscriptions_active() ) : ?>

									<input name="ideaboard_topic_subscribers" id="ideaboard_topic_subscribers" type="checkbox" value="1" checked="checked" tabindex="<?php ideaboard_tab_index(); ?>" />
									<label for="ideaboard_topic_subscribers"><?php _e( 'Copy subscribers to the new topic', 'ideaboard' ); ?></label><br />

								<?php endif; ?>

								<input name="ideaboard_topic_favoriters" id="ideaboard_topic_favoriters" type="checkbox" value="1" checked="checked" tabindex="<?php ideaboard_tab_index(); ?>" />
								<label for="ideaboard_topic_favoriters"><?php _e( 'Copy favoriters to the new topic', 'ideaboard' ); ?></label><br />

								<?php if ( ideaboard_allow_topic_tags() ) : ?>

									<input name="ideaboard_topic_tags" id="ideaboard_topic_tags" type="checkbox" value="1" checked="checked" tabindex="<?php ideaboard_tab_index(); ?>" />
									<label for="ideaboard_topic_tags"><?php _e( 'Copy topic tags to the new topic', 'ideaboard' ); ?></label><br />

								<?php endif; ?>

							</div>
						</fieldset>

						<div class="ideaboard-template-notice error">
							<p><?php _e( '<strong>WARNING:</strong> This process cannot be undone.', 'ideaboard' ); ?></p>
						</div>

						<div class="ideaboard-submit-wrapper">
							<button type="submit" tabindex="<?php ideaboard_tab_index(); ?>" id="ideaboard_merge_topic_submit" name="ideaboard_merge_topic_submit" class="button submit"><?php _e( 'Submit', 'ideaboard' ); ?></button>
						</div>
					</div>

					<?php ideaboard_split_topic_form_fields(); ?>

				</fieldset>
			</form>
		</div>

	<?php else : ?>

		<div id="no-topic-<?php ideaboard_topic_id(); ?>" class="ideaboard-no-topic">
			<div class="entry-content"><?php is_user_logged_in() ? _e( 'You do not have the permissions to edit this topic!', 'ideaboard' ) : _e( 'You cannot edit this topic.', 'ideaboard' ); ?></div>
		</div>

	<?php endif; ?>

</div>
