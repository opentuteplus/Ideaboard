<?php

/**
 * Search Loop - Single Forum
 *
 * @package IdeaBoard
 * @subpackage Theme
 */

?>

<div class="ideaboard-forum-header">

	<div class="ideaboard-meta">

		<span class="ideaboard-forum-post-date"><?php printf( __( 'Last updated %s', 'ideaboard' ), ideaboard_get_forum_last_active_time() ); ?></span>

		<a href="<?php ideaboard_forum_permalink(); ?>" class="ideaboard-forum-permalink">#<?php ideaboard_forum_id(); ?></a>

	</div><!-- .ideaboard-meta -->

	<div class="ideaboard-forum-title">

		<?php do_action( 'ideaboard_theme_before_forum_title' ); ?>

		<h3><?php _e( 'Forum: ', 'ideaboard' ); ?><a href="<?php ideaboard_forum_permalink(); ?>"><?php ideaboard_forum_title(); ?></a></h3>

		<?php do_action( 'ideaboard_theme_after_forum_title' ); ?>

	</div><!-- .ideaboard-forum-title -->

</div><!-- .ideaboard-forum-header -->

<div id="post-<?php ideaboard_forum_id(); ?>" <?php ideaboard_forum_class(); ?>>

	<div class="ideaboard-forum-content">

		<?php do_action( 'ideaboard_theme_before_forum_content' ); ?>

		<?php ideaboard_forum_content(); ?>

		<?php do_action( 'ideaboard_theme_after_forum_content' ); ?>

	</div><!-- .ideaboard-forum-content -->

</div><!-- #post-<?php ideaboard_forum_id(); ?> -->
