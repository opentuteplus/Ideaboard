<?php

/**
 * User Subscriptions
 *
 * @package IdeaBoard
 * @subpackage Theme
 */

?>

	<?php do_action( 'ideaboard_template_before_user_subscriptions' ); ?>

	<?php if ( ideaboard_is_subscriptions_active() ) : ?>

		<?php if ( ideaboard_is_user_home() || current_user_can( 'edit_users' ) ) : ?>

			<div id="ideaboard-user-subscriptions" class="ideaboard-user-subscriptions">
				<h2 class="entry-title"><?php _e( 'Subscribed Forums', 'ideaboard' ); ?></h2>
				<div class="ideaboard-user-section">

					<?php if ( ideaboard_get_user_forum_subscriptions() ) : ?>

						<?php ideaboard_get_template_part( 'loop', 'forums' ); ?>

					<?php else : ?>

						<p><?php ideaboard_is_user_home() ? _e( 'You are not currently subscribed to any forums.', 'ideaboard' ) : _e( 'This user is not currently subscribed to any forums.', 'ideaboard' ); ?></p>

					<?php endif; ?>

				</div>

				<h2 class="entry-title"><?php _e( 'Subscribed Topics', 'ideaboard' ); ?></h2>
				<div class="ideaboard-user-section">

					<?php if ( ideaboard_get_user_topic_subscriptions() ) : ?>

						<?php ideaboard_get_template_part( 'pagination', 'topics' ); ?>

						<?php ideaboard_get_template_part( 'loop',       'topics' ); ?>

						<?php ideaboard_get_template_part( 'pagination', 'topics' ); ?>

					<?php else : ?>

						<p><?php ideaboard_is_user_home() ? _e( 'You are not currently subscribed to any topics.', 'ideaboard' ) : _e( 'This user is not currently subscribed to any topics.', 'ideaboard' ); ?></p>

					<?php endif; ?>

				</div>
			</div><!-- #ideaboard-user-subscriptions -->

		<?php endif; ?>

	<?php endif; ?>

	<?php do_action( 'ideaboard_template_after_user_subscriptions' ); ?>
