<?php

/**
 * Topics Loop - Single
 *
 * @package IdeaBoard
 * @subpackage Theme
 */

?>

<ul id="bbp-topic-<?php ideaboard_topic_id(); ?>" <?php ideaboard_topic_class(); ?>>

	<li class="bbp-topic-title">

		<?php if ( ideaboard_is_user_home() ) : ?>

			<?php if ( ideaboard_is_favorites() ) : ?>

				<span class="bbp-row-actions">

					<?php do_action( 'ideaboard_theme_before_topic_favorites_action' ); ?>

					<?php ideaboard_topic_favorite_link( array( 'before' => '', 'favorite' => '+', 'favorited' => '&times;' ) ); ?>

					<?php do_action( 'ideaboard_theme_after_topic_favorites_action' ); ?>

				</span>

			<?php elseif ( ideaboard_is_subscriptions() ) : ?>

				<span class="bbp-row-actions">

					<?php do_action( 'ideaboard_theme_before_topic_subscription_action' ); ?>

					<?php ideaboard_topic_subscription_link( array( 'before' => '', 'subscribe' => '+', 'unsubscribe' => '&times;' ) ); ?>

					<?php do_action( 'ideaboard_theme_after_topic_subscription_action' ); ?>

				</span>

			<?php endif; ?>

		<?php endif; ?>

		<?php do_action( 'ideaboard_theme_before_topic_title' ); ?>

		<a class="bbp-topic-permalink" href="<?php ideaboard_topic_permalink(); ?>"><?php ideaboard_topic_title(); ?></a>

		<?php do_action( 'ideaboard_theme_after_topic_title' ); ?>

		<?php ideaboard_topic_pagination(); ?>

		<?php do_action( 'ideaboard_theme_before_topic_meta' ); ?>

		<p class="bbp-topic-meta">

			<?php do_action( 'ideaboard_theme_before_topic_started_by' ); ?>

			<span class="bbp-topic-started-by"><?php printf( __( 'Started by: %1$s', 'ideaboard' ), ideaboard_get_topic_author_link( array( 'size' => '14' ) ) ); ?></span>

			<?php do_action( 'ideaboard_theme_after_topic_started_by' ); ?>

			<?php if ( !ideaboard_is_single_forum() || ( ideaboard_get_topic_forum_id() !== ideaboard_get_forum_id() ) ) : ?>

				<?php do_action( 'ideaboard_theme_before_topic_started_in' ); ?>

				<span class="bbp-topic-started-in"><?php printf( __( 'in: <a href="%1$s">%2$s</a>', 'ideaboard' ), ideaboard_get_forum_permalink( ideaboard_get_topic_forum_id() ), ideaboard_get_forum_title( ideaboard_get_topic_forum_id() ) ); ?></span>

				<?php do_action( 'ideaboard_theme_after_topic_started_in' ); ?>

			<?php endif; ?>

		</p>

		<?php do_action( 'ideaboard_theme_after_topic_meta' ); ?>

		<?php ideaboard_topic_row_actions(); ?>

	</li>

	<li class="bbp-topic-voice-count"><?php ideaboard_topic_voice_count(); ?></li>

	<li class="bbp-topic-reply-count"><?php ideaboard_show_lead_topic() ? ideaboard_topic_reply_count() : ideaboard_topic_post_count(); ?></li>

	<li class="bbp-topic-freshness">

		<?php do_action( 'ideaboard_theme_before_topic_freshness_link' ); ?>

		<?php ideaboard_topic_freshness_link(); ?>

		<?php do_action( 'ideaboard_theme_after_topic_freshness_link' ); ?>

		<p class="bbp-topic-meta">

			<?php do_action( 'ideaboard_theme_before_topic_freshness_author' ); ?>

			<span class="bbp-topic-freshness-author"><?php ideaboard_author_link( array( 'post_id' => ideaboard_get_topic_last_active_id(), 'size' => 14 ) ); ?></span>

			<?php do_action( 'ideaboard_theme_after_topic_freshness_author' ); ?>

		</p>
	</li>

</ul><!-- #bbp-topic-<?php ideaboard_topic_id(); ?> -->
