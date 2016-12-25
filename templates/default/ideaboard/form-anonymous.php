<?php

/**
 * Anonymous User
 *
 * @package IdeaBoard
 * @subpackage Theme
 */

?>

<?php if ( ideaboard_current_user_can_access_anonymous_user_form() ) : ?>

	<?php do_action( 'ideaboard_theme_before_anonymous_form' ); ?>

	<fieldset class="ideaboard-form">
		<legend><?php ( ideaboard_is_topic_edit() || ideaboard_is_reply_edit() ) ? _e( 'Author Information', 'ideaboard' ) : _e( 'Your information:', 'ideaboard' ); ?></legend>

		<?php do_action( 'ideaboard_theme_anonymous_form_extras_top' ); ?>

		<p>
			<label for="ideaboard_anonymous_author"><?php _e( 'Name (required):', 'ideaboard' ); ?></label><br />
			<input type="text" id="ideaboard_anonymous_author"  value="<?php ideaboard_author_display_name(); ?>" tabindex="<?php ideaboard_tab_index(); ?>" size="40" name="ideaboard_anonymous_name" />
		</p>

		<p>
			<label for="ideaboard_anonymous_email"><?php _e( 'Mail (will not be published) (required):', 'ideaboard' ); ?></label><br />
			<input type="text" id="ideaboard_anonymous_email"   value="<?php ideaboard_author_email(); ?>" tabindex="<?php ideaboard_tab_index(); ?>" size="40" name="ideaboard_anonymous_email" />
		</p>

		<p>
			<label for="ideaboard_anonymous_website"><?php _e( 'Website:', 'ideaboard' ); ?></label><br />
			<input type="text" id="ideaboard_anonymous_website" value="<?php ideaboard_author_url(); ?>" tabindex="<?php ideaboard_tab_index(); ?>" size="40" name="ideaboard_anonymous_website" />
		</p>

		<?php do_action( 'ideaboard_theme_anonymous_form_extras_bottom' ); ?>

	</fieldset>

	<?php do_action( 'ideaboard_theme_after_anonymous_form' ); ?>

<?php endif; ?>
