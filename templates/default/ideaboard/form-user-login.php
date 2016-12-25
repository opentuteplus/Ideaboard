<?php

/**
 * User Login Form
 *
 * @package IdeaBoard
 * @subpackage Theme
 */

?>

<form method="post" action="<?php ideaboard_wp_login_action( array( 'context' => 'login_post' ) ); ?>" class="ideaboard-login-form">
	<fieldset class="ideaboard-form">
		<legend><?php _e( 'Log In', 'ideaboard' ); ?></legend>

		<div class="ideaboard-username">
			<label for="user_login"><?php _e( 'Username', 'ideaboard' ); ?>: </label>
			<input type="text" name="log" value="<?php ideaboard_sanitize_val( 'user_login', 'text' ); ?>" size="20" id="user_login" tabindex="<?php ideaboard_tab_index(); ?>" />
		</div>

		<div class="ideaboard-password">
			<label for="user_pass"><?php _e( 'Password', 'ideaboard' ); ?>: </label>
			<input type="password" name="pwd" value="<?php ideaboard_sanitize_val( 'user_pass', 'password' ); ?>" size="20" id="user_pass" tabindex="<?php ideaboard_tab_index(); ?>" />
		</div>

		<div class="ideaboard-remember-me">
			<input type="checkbox" name="rememberme" value="forever" <?php checked( ideaboard_get_sanitize_val( 'rememberme', 'checkbox' ) ); ?> id="rememberme" tabindex="<?php ideaboard_tab_index(); ?>" />
			<label for="rememberme"><?php _e( 'Keep me signed in', 'ideaboard' ); ?></label>
		</div>

		<?php do_action( 'login_form' ); ?>

		<div class="ideaboard-submit-wrapper">

			<button type="submit" tabindex="<?php ideaboard_tab_index(); ?>" name="user-submit" class="button submit user-submit"><?php _e( 'Log In', 'ideaboard' ); ?></button>

			<?php ideaboard_user_login_fields(); ?>

		</div>
	</fieldset>
</form>
