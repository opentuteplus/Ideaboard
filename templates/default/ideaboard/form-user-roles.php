<?php

/**
 * User Roles Profile Edit Part
 *
 * @package IdeaBoard
 * @subpackage Theme
 */

?>

<div>
	<label for="role"><?php _e( 'Blog Role', 'ideaboard' ) ?></label>

	<?php ideaboard_edit_user_blog_role(); ?>

</div>

<div>
	<label for="forum-role"><?php _e( 'Forum Role', 'ideaboard' ) ?></label>

	<?php ideaboard_edit_user_forums_role(); ?>

</div>
