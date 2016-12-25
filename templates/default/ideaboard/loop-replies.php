<?php

/**
 * Replies Loop
 *
 * @package IdeaBoard
 * @subpackage Theme
 */

?>

<?php do_action( 'ideaboard_template_before_replies_loop' ); ?>

<ul id="topic-<?php ideaboard_topic_id(); ?>-replies" class="forums ideaboard-replies">

	<li class="ideaboard-header">

		<div class="ideaboard-reply-author"><?php  _e( 'Author',  'ideaboard' ); ?></div><!-- .ideaboard-reply-author -->

		<div class="ideaboard-reply-content">

			<?php if ( !ideaboard_show_lead_topic() ) : ?>

				<?php _e( 'Posts', 'ideaboard' ); ?>

				<?php ideaboard_topic_subscription_link(); ?>

				<?php ideaboard_user_favorites_link(); ?>

			<?php else : ?>

				<?php _e( 'Replies', 'ideaboard' ); ?>

			<?php endif; ?>

		</div><!-- .ideaboard-reply-content -->

	</li><!-- .ideaboard-header -->

	<li class="ideaboard-body">

		<?php if ( ideaboard_thread_replies() ) : ?>

			<?php ideaboard_list_replies(); ?>

		<?php else : ?>

			<?php while ( ideaboard_replies() ) : ideaboard_the_reply(); ?>

				<?php ideaboard_get_template_part( 'loop', 'single-reply' ); ?>

			<?php endwhile; ?>

		<?php endif; ?>

	</li><!-- .ideaboard-body -->

	<li class="ideaboard-footer">

		<div class="ideaboard-reply-author"><?php  _e( 'Author',  'ideaboard' ); ?></div>

		<div class="ideaboard-reply-content">

			<?php if ( !ideaboard_show_lead_topic() ) : ?>

				<?php _e( 'Posts', 'ideaboard' ); ?>

			<?php else : ?>

				<?php _e( 'Replies', 'ideaboard' ); ?>

			<?php endif; ?>

		</div><!-- .ideaboard-reply-content -->

	</li><!-- .ideaboard-footer -->

</ul><!-- #topic-<?php ideaboard_topic_id(); ?>-replies -->

<?php do_action( 'ideaboard_template_after_replies_loop' ); ?>
