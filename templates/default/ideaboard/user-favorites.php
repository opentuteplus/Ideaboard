<?php

/**
 * User Favorites
 *
 * @package IdeaBoard
 * @subpackage Theme
 */

?>

	<?php do_action( 'ideaboard_template_before_user_favorites' ); ?>

	<div id="bbp-user-favorites" class="bbp-user-favorites">
		<h2 class="entry-title"><?php _e( 'Favorite Forum Topics', 'ideaboard' ); ?></h2>
		<div class="bbp-user-section">

			<?php if ( ideaboard_get_user_favorites() ) : ?>

				<?php ideaboard_get_template_part( 'pagination', 'topics' ); ?>

				<?php ideaboard_get_template_part( 'loop',       'topics' ); ?>

				<?php ideaboard_get_template_part( 'pagination', 'topics' ); ?>

			<?php else : ?>

				<p><?php ideaboard_is_user_home() ? _e( 'You currently have no favorite topics.', 'ideaboard' ) : _e( 'This user has no favorite topics.', 'ideaboard' ); ?></p>

			<?php endif; ?>

		</div>
	</div><!-- #bbp-user-favorites -->

	<?php do_action( 'ideaboard_template_after_user_favorites' ); ?>
