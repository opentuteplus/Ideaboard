<?php

/**
 * Single Reply
 *
 * @package IdeaBoard
 * @subpackage Theme
 */

get_header(); ?>

	<?php do_action( 'ideaboard_before_main_content' ); ?>

	<?php do_action( 'ideaboard_template_notices' ); ?>

	<?php if ( ideaboard_user_can_view_forum( array( 'forum_id' => ideaboard_get_reply_forum_id() ) ) ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<div id="ideaboard-reply-wrapper-<?php ideaboard_reply_id(); ?>" class="ideaboard-reply-wrapper">
				<h1 class="entry-title"><?php ideaboard_reply_title(); ?></h1>
				<div class="entry-content">

					<?php ideaboard_get_template_part( 'content', 'single-reply' ); ?>

				</div><!-- .entry-content -->
			</div><!-- #ideaboard-reply-wrapper-<?php ideaboard_reply_id(); ?> -->

		<?php endwhile; ?>

	<?php elseif ( ideaboard_is_forum_private( ideaboard_get_reply_forum_id(), false ) ) : ?>

		<?php ideaboard_get_template_part( 'feedback', 'no-access' ); ?>

	<?php endif; ?>

	<?php do_action( 'ideaboard_after_main_content' ); ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
