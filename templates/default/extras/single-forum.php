<?php

/**
 * Single Forum
 *
 * @package IdeaBoard
 * @subpackage Theme
 */

get_header(); ?>

	<?php do_action( 'ideaboard_before_main_content' ); ?>

	<?php do_action( 'ideaboard_template_notices' ); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php if ( ideaboard_user_can_view_forum() ) : ?>

			<div id="forum-<?php ideaboard_forum_id(); ?>" class="ideaboard-forum-content">
				<h1 class="entry-title"><?php ideaboard_forum_title(); ?></h1>
				<div class="entry-content">

					<?php ideaboard_get_template_part( 'content', 'single-forum' ); ?>

				</div>
			</div><!-- #forum-<?php ideaboard_forum_id(); ?> -->

		<?php else : // Forum exists, user no access ?>

			<?php ideaboard_get_template_part( 'feedback', 'no-access' ); ?>

		<?php endif; ?>

	<?php endwhile; ?>

	<?php do_action( 'ideaboard_after_main_content' ); ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
