<?php

/**
 * New/Edit Reply
 *
 * @package IdeaBoard
 * @subpackage Theme
 */

?>

<?php if ( ideaboard_is_reply_edit() ) : ?>

<div id="ideaboard-forums">

	<?php ideaboard_breadcrumb(); ?>

<?php endif; ?>

<?php if ( ideaboard_current_user_can_access_create_reply_form() ) : ?>

	<div id="new-reply-<?php ideaboard_topic_id(); ?>" class="ideaboard-reply-form">

		<form id="new-post" name="new-post" method="post" action="<?php the_permalink(); ?>">

			<?php do_action( 'ideaboard_theme_before_reply_form' ); ?>

			<fieldset class="ideaboard-form">
				<legend><?php printf( __( 'Reply To: %s', 'ideaboard' ), ideaboard_get_topic_title() ); ?></legend>

				<?php do_action( 'ideaboard_theme_before_reply_form_notices' ); ?>

				<?php if ( !ideaboard_is_topic_open() && !ideaboard_is_reply_edit() ) : ?>

					<div class="ideaboard-template-notice">
						<p><?php _e( 'This topic is marked as closed to new replies, however your posting capabilities still allow you to do so.', 'ideaboard' ); ?></p>
					</div>

				<?php endif; ?>

				<?php if ( current_user_can( 'unfiltered_html' ) ) : ?>

					<div class="ideaboard-template-notice">
						<p><?php _e( 'Your account has the ability to post unrestricted HTML content.', 'ideaboard' ); ?></p>
					</div>

				<?php endif; ?>

				<?php do_action( 'ideaboard_template_notices' ); ?>

				<div>

					<?php ideaboard_get_template_part( 'form', 'anonymous' ); ?>

					<?php do_action( 'ideaboard_theme_before_reply_form_content' ); ?>

					<?php ideaboard_the_content( array( 'context' => 'reply' ) ); ?>

					<?php do_action( 'ideaboard_theme_after_reply_form_content' ); ?>

					<?php if ( ! ( ideaboard_use_wp_editor() || current_user_can( 'unfiltered_html' ) ) ) : ?>

						<p class="form-allowed-tags">
							<label><?php _e( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes:','ideaboard' ); ?></label><br />
							<code><?php ideaboard_allowed_tags(); ?></code>
						</p>

					<?php endif; ?>
					
					<?php if ( ideaboard_allow_topic_tags() && current_user_can( 'assign_topic_tags' ) ) : ?>

						<?php do_action( 'ideaboard_theme_before_reply_form_tags' ); ?>

						<p>
							<label for="ideaboard_topic_tags"><?php _e( 'Tags:', 'ideaboard' ); ?></label><br />
							<input type="text" value="<?php ideaboard_form_topic_tags(); ?>" tabindex="<?php ideaboard_tab_index(); ?>" size="40" name="ideaboard_topic_tags" id="ideaboard_topic_tags" <?php disabled( ideaboard_is_topic_spam() ); ?> />
						</p>

						<?php do_action( 'ideaboard_theme_after_reply_form_tags' ); ?>

					<?php endif; ?>

					<?php if ( ideaboard_is_subscriptions_active() && !ideaboard_is_anonymous() && ( !ideaboard_is_reply_edit() || ( ideaboard_is_reply_edit() && !ideaboard_is_reply_anonymous() ) ) ) : ?>

						<?php do_action( 'ideaboard_theme_before_reply_form_subscription' ); ?>

						<p>

							<input name="ideaboard_topic_subscription" id="ideaboard_topic_subscription" type="checkbox" value="ideaboard_subscribe"<?php ideaboard_form_topic_subscribed(); ?> tabindex="<?php ideaboard_tab_index(); ?>" />

							<?php if ( ideaboard_is_reply_edit() && ( ideaboard_get_reply_author_id() !== ideaboard_get_current_user_id() ) ) : ?>

								<label for="ideaboard_topic_subscription"><?php _e( 'Notify the author of follow-up replies via email', 'ideaboard' ); ?></label>

							<?php else : ?>

								<label for="ideaboard_topic_subscription"><?php _e( 'Notify me of follow-up replies via email', 'ideaboard' ); ?></label>

							<?php endif; ?>

						</p>

						<?php do_action( 'ideaboard_theme_after_reply_form_subscription' ); ?>

					<?php endif; ?>

					<?php if ( ideaboard_allow_revisions() && ideaboard_is_reply_edit() ) : ?>

						<?php do_action( 'ideaboard_theme_before_reply_form_revisions' ); ?>

						<fieldset class="ideaboard-form">
							<legend>
								<input name="ideaboard_log_reply_edit" id="ideaboard_log_reply_edit" type="checkbox" value="1" <?php ideaboard_form_reply_log_edit(); ?> tabindex="<?php ideaboard_tab_index(); ?>" />
								<label for="ideaboard_log_reply_edit"><?php _e( 'Keep a log of this edit:', 'ideaboard' ); ?></label><br />
							</legend>

							<div>
								<label for="ideaboard_reply_edit_reason"><?php printf( __( 'Optional reason for editing:', 'ideaboard' ), ideaboard_get_current_user_name() ); ?></label><br />
								<input type="text" value="<?php ideaboard_form_reply_edit_reason(); ?>" tabindex="<?php ideaboard_tab_index(); ?>" size="40" name="ideaboard_reply_edit_reason" id="ideaboard_reply_edit_reason" />
							</div>
						</fieldset>

						<?php do_action( 'ideaboard_theme_after_reply_form_revisions' ); ?>

					<?php endif; ?>

					<?php do_action( 'ideaboard_theme_before_reply_form_submit_wrapper' ); ?>

					<div class="ideaboard-submit-wrapper">

						<?php do_action( 'ideaboard_theme_before_reply_form_submit_button' ); ?>

						<?php ideaboard_cancel_reply_to_link(); ?>

						<button type="submit" tabindex="<?php ideaboard_tab_index(); ?>" id="ideaboard_reply_submit" name="ideaboard_reply_submit" class="button submit"><?php _e( 'Submit', 'ideaboard' ); ?></button>

						<?php do_action( 'ideaboard_theme_after_reply_form_submit_button' ); ?>

					</div>

					<?php do_action( 'ideaboard_theme_after_reply_form_submit_wrapper' ); ?>

				</div>

				<?php ideaboard_reply_form_fields(); ?>

			</fieldset>

			<?php do_action( 'ideaboard_theme_after_reply_form' ); ?>

		</form>
	</div>

<?php elseif ( ideaboard_is_topic_closed() ) : ?>

	<div id="no-reply-<?php ideaboard_topic_id(); ?>" class="ideaboard-no-reply">
		<div class="ideaboard-template-notice">
			<p><?php printf( __( 'The topic &#8216;%s&#8217; is closed to new replies.', 'ideaboard' ), ideaboard_get_topic_title() ); ?></p>
		</div>
	</div>

<?php elseif ( ideaboard_is_forum_closed( ideaboard_get_topic_forum_id() ) ) : ?>

	<div id="no-reply-<?php ideaboard_topic_id(); ?>" class="ideaboard-no-reply">
		<div class="ideaboard-template-notice">
			<p><?php printf( __( 'The forum &#8216;%s&#8217; is closed to new topics and replies.', 'ideaboard' ), ideaboard_get_forum_title( ideaboard_get_topic_forum_id() ) ); ?></p>
		</div>
	</div>

<?php else : ?>

	<div id="no-reply-<?php ideaboard_topic_id(); ?>" class="ideaboard-no-reply">
		<div class="ideaboard-template-notice">
			<p><?php is_user_logged_in() ? _e( 'You cannot reply to this topic.', 'ideaboard' ) : _e( 'You must be logged in to reply to this topic.', 'ideaboard' ); ?></p>
		</div>
	</div>

<?php endif; ?>

<?php if ( ideaboard_is_reply_edit() ) : ?>

</div>

<?php endif; ?>
