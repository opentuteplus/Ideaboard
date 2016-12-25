<?php

/**
 * Single User Content Part
 *
 * @package IdeaBoard
 * @subpackage Theme
 */

?>

<div id="ideaboard-forums">

	<?php do_action( 'ideaboard_template_notices' ); ?>

	<div id="ideaboard-user-wrapper">
		<?php ideaboard_get_template_part( 'user', 'details' ); ?>

		<div id="ideaboard-user-body">
			<?php if ( ideaboard_is_favorites()                 ) ideaboard_get_template_part( 'user', 'favorites'       ); ?>
			<?php if ( ideaboard_is_subscriptions()             ) ideaboard_get_template_part( 'user', 'subscriptions'   ); ?>
			<?php if ( ideaboard_is_single_user_topics()        ) ideaboard_get_template_part( 'user', 'topics-created'  ); ?>
			<?php if ( ideaboard_is_single_user_replies()       ) ideaboard_get_template_part( 'user', 'replies-created' ); ?>
			<?php if ( ideaboard_is_single_user_edit()          ) ideaboard_get_template_part( 'form', 'user-edit'       ); ?>
			<?php if ( ideaboard_is_single_user_profile()       ) ideaboard_get_template_part( 'user', 'profile'         ); ?>
		</div>
	</div>
</div>
