<?php

/**
 * User Registration Form
 *
 * @package IdeaBoard
 * @subpackage Theme
 */

?>

<form method="post" action="<?php ideaboard_wp_login_action( array( 'context' => 'login_post' ) ); ?>" class="ideaboard-login-form">
	<fieldset class="ideaboard-form">
		<legend><?php _e( 'Create an Account', 'ideaboard' ); ?></legend>

		<div class="ideaboard-template-notice">
			<p><?php _e( 'Your username must be unique, and cannot be changed later.', 'ideaboard' ) ?></p>
			<p><?php _e( 'We use your email address to email you a secure password and verify your account.', 'ideaboard' ) ?></p>

		</div>

		<div class="ideaboard-username">
			<label for="user_login"><?php _e( 'Username', 'ideaboard' ); ?>: </label>
			<input type="text" name="user_login" value="<?php ideaboard_sanitize_val( 'user_login' ); ?>" size="20" id="user_login" tabindex="<?php ideaboard_tab_index(); ?>" />
		</div>

		<div class="ideaboard-email">
			<label for="user_email"><?php _e( 'Email', 'ideaboard' ); ?>: </label>
			<input type="text" name="user_email" value="<?php ideaboard_sanitize_val( 'user_email' ); ?>" size="20" id="user_email" tabindex="<?php ideaboard_tab_index(); ?>" />
		</div>

		<?php do_action( 'register_form' ); ?>

		<div class="ideaboard-submit-wrapper">

			<button type="submit" tabindex="<?php ideaboard_tab_index(); ?>" name="user-submit" class="button submit user-submit"><?php _e( 'Register', 'ideaboard' ); ?></button>

			<?php ideaboard_user_register_fields(); ?>

		</div>
	</fieldset>
</form>
