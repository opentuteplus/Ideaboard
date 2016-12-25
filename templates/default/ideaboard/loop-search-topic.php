<?php

/**
 * Search Loop - Single Topic
 *
 * @package IdeaBoard
 * @subpackage Theme
 */

?>

<div class="bbp-topic-header">

	<div class="bbp-meta">

		<span class="bbp-topic-post-date"><?php ideaboard_topic_post_date( ideaboard_get_topic_id() ); ?></span>

		<a href="<?php ideaboard_topic_permalink(); ?>" class="bbp-topic-permalink">#<?php ideaboard_topic_id(); ?></a>

	</div><!-- .bbp-meta -->

	<div class="bbp-topic-title">

		<?php do_action( 'ideaboard_theme_before_topic_title' ); ?>

		<h3><?php _e( 'Topic: ', 'ideaboard' ); ?>
		<a href="<?php ideaboard_topic_permalink(); ?>"><?php ideaboard_topic_title(); ?></a></h3>

		<div class="bbp-topic-title-meta">

			<?php if ( function_exists( 'ideaboard_is_forum_group_forum' ) && ideaboard_is_forum_group_forum( ideaboard_get_topic_forum_id() ) ) : ?>

				<?php _e( 'in group forum ', 'ideaboard' ); ?>

			<?php else : ?>

				<?php _e( 'in forum ', 'ideaboard' ); ?>

			<?php endif; ?>

			<a href="<?php ideaboard_forum_permalink( ideaboard_get_topic_forum_id() ); ?>"><?php ideaboard_forum_title( ideaboard_get_topic_forum_id() ); ?></a>

		</div><!-- .bbp-topic-title-meta -->

		<?php do_action( 'ideaboard_theme_after_topic_title' ); ?>

	</div><!-- .bbp-topic-title -->

</div><!-- .bbp-topic-header -->

<div id="post-<?php ideaboard_topic_id(); ?>" <?php ideaboard_topic_class(); ?>>

	<div class="bbp-topic-author">

		<?php do_action( 'ideaboard_theme_before_topic_author_details' ); ?>

		<?php ideaboard_topic_author_link( array( 'sep' => '<br />', 'show_role' => true ) ); ?>

		<?php if ( ideaboard_is_user_keymaster() ) : ?>

			<?php do_action( 'ideaboard_theme_before_topic_author_admin_details' ); ?>

			<div class="bbp-reply-ip"><?php ideaboard_author_ip( ideaboard_get_topic_id() ); ?></div>

			<?php do_action( 'ideaboard_theme_after_topic_author_admin_details' ); ?>

		<?php endif; ?>

		<?php do_action( 'ideaboard_theme_after_topic_author_details' ); ?>

	</div><!-- .bbp-topic-author -->

	<div class="bbp-topic-content">

		<?php do_action( 'ideaboard_theme_before_topic_content' ); ?>

		<?php ideaboard_topic_content(); ?>

		<?php do_action( 'ideaboard_theme_after_topic_content' ); ?>

	</div><!-- .bbp-topic-content -->

</div><!-- #post-<?php ideaboard_topic_id(); ?> -->
