<?php

/**
 * User Replies Created
 *
 * @package IdeaBoard
 * @subpackage Theme
 */

?>

	<?php do_action( 'ideaboard_template_before_user_replies' ); ?>

	<div id="ideaboard-user-replies-created" class="ideaboard-user-replies-created">
		<h2 class="entry-title"><?php _e( 'Forum Replies Created', 'ideaboard' ); ?></h2>
		<div class="ideaboard-user-section">

			<?php if ( ideaboard_get_user_replies_created() ) : ?>

				<?php ideaboard_get_template_part( 'pagination', 'replies' ); ?>

				<?php ideaboard_get_template_part( 'loop',       'replies' ); ?>

				<?php ideaboard_get_template_part( 'pagination', 'replies' ); ?>

			<?php else : ?>

				<p><?php ideaboard_is_user_home() ? _e( 'You have not replied to any topics.', 'ideaboard' ) : _e( 'This user has not replied to any topics.', 'ideaboard' ); ?></p>

			<?php endif; ?>

		</div>
	</div><!-- #ideaboard-user-replies-created -->

	<?php do_action( 'ideaboard_template_after_user_replies' ); ?>
