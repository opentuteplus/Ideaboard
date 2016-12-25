<?php

/**
 * Single View
 *
 * @package IdeaBoard
 * @subpackage Theme
 */

get_header(); ?>

	<?php do_action( 'ideaboard_before_main_content' ); ?>

	<?php do_action( 'ideaboard_template_notices' ); ?>

	<div id="bbp-view-<?php ideaboard_view_id(); ?>" class="bbp-view">
		<h1 class="entry-title"><?php ideaboard_view_title(); ?></h1>
		<div class="entry-content">

			<?php ideaboard_get_template_part( 'content', 'single-view' ); ?>

		</div>
	</div><!-- #bbp-view-<?php ideaboard_view_id(); ?> -->

	<?php do_action( 'ideaboard_after_main_content' ); ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
