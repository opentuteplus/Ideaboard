<?php

/**
 * Forums Loop - Single Forum
 *
 * @package IdeaBoard
 * @subpackage Theme
 */

?>

<ul id="ideaboard-forum-<?php ideaboard_forum_id(); ?>" <?php ideaboard_forum_class(); ?>>

	<li class="ideaboard-forum-info">

		<?php if ( ideaboard_is_user_home() && ideaboard_is_subscriptions() ) : ?>

			<span class="ideaboard-row-actions">

				<?php do_action( 'ideaboard_theme_before_forum_subscription_action' ); ?>

				<?php ideaboard_forum_subscription_link( array( 'before' => '', 'subscribe' => '+', 'unsubscribe' => '&times;' ) ); ?>

				<?php do_action( 'ideaboard_theme_after_forum_subscription_action' ); ?>

			</span>

		<?php endif; ?>

		<?php do_action( 'ideaboard_theme_before_forum_title' ); ?>

		<a class="ideaboard-forum-title" href="<?php ideaboard_forum_permalink(); ?>"><?php ideaboard_forum_title(); ?></a>

		<?php do_action( 'ideaboard_theme_after_forum_title' ); ?>

		<?php do_action( 'ideaboard_theme_before_forum_description' ); ?>

		<div class="ideaboard-forum-content"><?php ideaboard_forum_content(); ?></div>

		<?php do_action( 'ideaboard_theme_after_forum_description' ); ?>

		<?php do_action( 'ideaboard_theme_before_forum_sub_forums' ); ?>

		<?php ideaboard_list_forums(); ?>

		<?php do_action( 'ideaboard_theme_after_forum_sub_forums' ); ?>

		<?php ideaboard_forum_row_actions(); ?>

	</li>

	<li class="ideaboard-forum-topic-count"><?php ideaboard_forum_topic_count(); ?></li>

	<li class="ideaboard-forum-reply-count"><?php ideaboard_show_lead_topic() ? ideaboard_forum_reply_count() : ideaboard_forum_post_count(); ?></li>

	<li class="ideaboard-forum-freshness">

		<?php do_action( 'ideaboard_theme_before_forum_freshness_link' ); ?>

		<?php ideaboard_forum_freshness_link(); ?>

		<?php do_action( 'ideaboard_theme_after_forum_freshness_link' ); ?>

		<p class="ideaboard-topic-meta">

			<?php do_action( 'ideaboard_theme_before_topic_author' ); ?>

			<span class="ideaboard-topic-freshness-author"><?php ideaboard_author_link( array( 'post_id' => ideaboard_get_forum_last_active_id(), 'size' => 14 ) ); ?></span>

			<?php do_action( 'ideaboard_theme_after_topic_author' ); ?>

		</p>
	</li>

</ul><!-- #ideaboard-forum-<?php ideaboard_forum_id(); ?> -->
