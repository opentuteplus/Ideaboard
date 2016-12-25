<?php

/**
 * Forums Loop
 *
 * @package IdeaBoard
 * @subpackage Theme
 */

?>

<?php do_action( 'ideaboard_template_before_forums_loop' ); ?>

<ul id="forums-list-<?php ideaboard_forum_id(); ?>" class="ideaboard-forums">

	<li class="ideaboard-header">

		<ul class="forum-titles">
			<li class="ideaboard-forum-info"><?php _e( 'Forum', 'ideaboard' ); ?></li>
			<li class="ideaboard-forum-topic-count"><?php _e( 'Topics', 'ideaboard' ); ?></li>
			<li class="ideaboard-forum-reply-count"><?php ideaboard_show_lead_topic() ? _e( 'Replies', 'ideaboard' ) : _e( 'Posts', 'ideaboard' ); ?></li>
			<li class="ideaboard-forum-freshness"><?php _e( 'Freshness', 'ideaboard' ); ?></li>
		</ul>

	</li><!-- .ideaboard-header -->

	<li class="ideaboard-body">

		<?php while ( ideaboard_forums() ) : ideaboard_the_forum(); ?>

			<?php ideaboard_get_template_part( 'loop', 'single-forum' ); ?>

		<?php endwhile; ?>

	</li><!-- .ideaboard-body -->

	<li class="ideaboard-footer">

		<div class="tr">
			<p class="td colspan4">&nbsp;</p>
		</div><!-- .tr -->

	</li><!-- .ideaboard-footer -->

</ul><!-- .forums-directory -->

<?php do_action( 'ideaboard_template_after_forums_loop' ); ?>
