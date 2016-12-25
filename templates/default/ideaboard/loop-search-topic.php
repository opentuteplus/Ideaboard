<?php

/**
 * Search Loop - Single Topic
 *
 * @package IdeaBoard
 * @subpackage Theme
 */

?>

<div class="ideaboard-topic-header">

	<div class="ideaboard-meta">

		<span class="ideaboard-topic-post-date"><?php ideaboard_topic_post_date( ideaboard_get_topic_id() ); ?></span>

		<a href="<?php ideaboard_topic_permalink(); ?>" class="ideaboard-topic-permalink">#<?php ideaboard_topic_id(); ?></a>

	</div><!-- .ideaboard-meta -->

	<div class="ideaboard-topic-title">

		<?php do_action( 'ideaboard_theme_before_topic_title' ); ?>

		<h3><?php _e( 'Topic: ', 'ideaboard' ); ?>
		<a href="<?php ideaboard_topic_permalink(); ?>"><?php ideaboard_topic_title(); ?></a></h3>

		<div class="ideaboard-topic-title-meta">

			<?php if ( function_exists( 'ideaboard_is_forum_group_forum' ) && ideaboard_is_forum_group_forum( ideaboard_get_topic_forum_id() ) ) : ?>

				<?php _e( 'in group forum ', 'ideaboard' ); ?>

			<?php else : ?>

				<?php _e( 'in forum ', 'ideaboard' ); ?>

			<?php endif; ?>

			<a href="<?php ideaboard_forum_permalink( ideaboard_get_topic_forum_id() ); ?>"><?php ideaboard_forum_title( ideaboard_get_topic_forum_id() ); ?></a>

		</div><!-- .ideaboard-topic-title-meta -->

		<?php do_action( 'ideaboard_theme_after_topic_title' ); ?>

	</div><!-- .ideaboard-topic-title -->

</div><!-- .ideaboard-topic-header -->

<div id="post-<?php ideaboard_topic_id(); ?>" <?php ideaboard_topic_class(); ?>>

	<div class="ideaboard-topic-author">

		<?php do_action( 'ideaboard_theme_before_topic_author_details' ); ?>

		<?php ideaboard_topic_author_link( array( 'sep' => '<br />', 'show_role' => true ) ); ?>

		<?php if ( ideaboard_is_user_keymaster() ) : ?>

			<?php do_action( 'ideaboard_theme_before_topic_author_admin_details' ); ?>

			<div class="ideaboard-reply-ip"><?php ideaboard_author_ip( ideaboard_get_topic_id() ); ?></div>

			<?php do_action( 'ideaboard_theme_after_topic_author_admin_details' ); ?>

		<?php endif; ?>

		<?php do_action( 'ideaboard_theme_after_topic_author_details' ); ?>

	</div><!-- .ideaboard-topic-author -->

	<div class="ideaboard-topic-content">

		<?php do_action( 'ideaboard_theme_before_topic_content' ); ?>

		<?php ideaboard_topic_content(); ?>

		<?php do_action( 'ideaboard_theme_after_topic_content' ); ?>

	</div><!-- .ideaboard-topic-content -->

</div><!-- #post-<?php ideaboard_topic_id(); ?> -->
