<?php

/**
 * Topics Loop
 *
 * @package IdeaBoard
 * @subpackage Theme
 */

?>

<?php do_action( 'ideaboard_template_before_topics_loop' ); ?>

<ul id="bbp-forum-<?php ideaboard_forum_id(); ?>" class="bbp-topics">

	<li class="bbp-header">

		<ul class="forum-titles">
			<li class="bbp-topic-title"><?php _e( 'Topic', 'ideaboard' ); ?></li>
			<li class="bbp-topic-voice-count"><?php _e( 'Voices', 'ideaboard' ); ?></li>
			<li class="bbp-topic-reply-count"><?php ideaboard_show_lead_topic() ? _e( 'Replies', 'ideaboard' ) : _e( 'Posts', 'ideaboard' ); ?></li>
			<li class="bbp-topic-freshness"><?php _e( 'Freshness', 'ideaboard' ); ?></li>
		</ul>

	</li>

	<li class="bbp-body">

		<?php while ( ideaboard_topics() ) : ideaboard_the_topic(); ?>

			<?php ideaboard_get_template_part( 'loop', 'single-topic' ); ?>

		<?php endwhile; ?>

	</li>

	<li class="bbp-footer">

		<div class="tr">
			<p>
				<span class="td colspan<?php echo ( ideaboard_is_user_home() && ( ideaboard_is_favorites() || ideaboard_is_subscriptions() ) ) ? '5' : '4'; ?>">&nbsp;</span>
			</p>
		</div><!-- .tr -->

	</li>

</ul><!-- #bbp-forum-<?php ideaboard_forum_id(); ?> -->

<?php do_action( 'ideaboard_template_after_topics_loop' ); ?>
