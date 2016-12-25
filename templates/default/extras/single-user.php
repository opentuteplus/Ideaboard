<?php

/**
 * Single User
 *
 * @package IdeaBoard
 * @subpackage Theme
 */

get_header(); ?>

	<?php do_action( 'ideaboard_before_main_content' ); ?>

	<div id="ideaboard-user-<?php ideaboard_current_user_id(); ?>" class="ideaboard-single-user">
		<div class="entry-content">

			<?php ideaboard_get_template_part( 'content', 'single-user' ); ?>

		</div><!-- .entry-content -->
	</div><!-- #ideaboard-user-<?php ideaboard_current_user_id(); ?> -->

	<?php do_action( 'ideaboard_after_main_content' ); ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
