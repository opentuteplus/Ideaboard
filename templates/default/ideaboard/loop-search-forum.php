<?php

/**
 * Search Loop - Single Forum
 *
 * @package IdeaBoard
 * @subpackage Theme
 */

?>

<div class="bbp-forum-header">

	<div class="bbp-meta">

		<span class="bbp-forum-post-date"><?php printf( __( 'Last updated %s', 'ideaboard' ), ideaboard_get_forum_last_active_time() ); ?></span>

		<a href="<?php ideaboard_forum_permalink(); ?>" class="bbp-forum-permalink">#<?php ideaboard_forum_id(); ?></a>

	</div><!-- .bbp-meta -->

	<div class="bbp-forum-title">

		<?php do_action( 'ideaboard_theme_before_forum_title' ); ?>

		<h3><?php _e( 'Forum: ', 'ideaboard' ); ?><a href="<?php ideaboard_forum_permalink(); ?>"><?php ideaboard_forum_title(); ?></a></h3>

		<?php do_action( 'ideaboard_theme_after_forum_title' ); ?>

	</div><!-- .bbp-forum-title -->

</div><!-- .bbp-forum-header -->

<div id="post-<?php ideaboard_forum_id(); ?>" <?php ideaboard_forum_class(); ?>>

	<div class="bbp-forum-content">

		<?php do_action( 'ideaboard_theme_before_forum_content' ); ?>

		<?php ideaboard_forum_content(); ?>

		<?php do_action( 'ideaboard_theme_after_forum_content' ); ?>

	</div><!-- .bbp-forum-content -->

</div><!-- #post-<?php ideaboard_forum_id(); ?> -->
