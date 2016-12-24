<?php

/**
 * Password Protected
 *
 * @package IdeaBoard
 * @subpackage Theme
 */

?>

<div id="ideaboard-forums">
	<fieldset class="bbp-form" id="bbp-protected">
		<Legend><?php _e( 'Protected', 'ideaboard' ); ?></legend>

		<?php echo get_the_password_form(); ?>

	</fieldset>
</div>