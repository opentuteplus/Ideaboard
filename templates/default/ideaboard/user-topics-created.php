<?php

/**
 * User Topics Created
 *
 * @package IdeaBoard
 * @subpackage Theme
 */

?>

	<?php do_action( 'ideaboard_template_before_user_topics_created' ); ?>

	<div id="bbp-user-topics-started" class="bbp-user-topics-started">
		<h2 class="entry-title"><?php _e( 'Forum Topics Started', 'ideaboard' ); ?></h2>
		<div class="bbp-user-section">

			<?php if ( ideaboard_get_user_topics_started() ) : ?>

				<?php ideaboard_get_template_part( 'pagination', 'topics' ); ?>

				<?php ideaboard_get_template_part( 'loop',       'topics' ); ?>

				<?php ideaboard_get_template_part( 'pagination', 'topics' ); ?>

			<?php else : ?>

				<p><?php ideaboard_is_user_home() ? _e( 'You have not created any topics.', 'ideaboard' ) : _e( 'This user has not created any topics.', 'ideaboard' ); ?></p>

			<?php endif; ?>

		</div>
	</div><!-- #bbp-user-topics-started -->

	<?php do_action( 'ideaboard_template_after_user_topics_created' ); ?>
