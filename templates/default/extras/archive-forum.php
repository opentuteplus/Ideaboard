<?php

/**
 * IdeaBoard - Forum Archive
 *
 * @package IdeaBoard
 * @subpackage Theme
 */

get_header(); ?>

	<?php do_action( 'ideaboard_before_main_content' ); ?>

	<?php do_action( 'ideaboard_template_notices' ); ?>

	<div id="forum-front" class="ideaboard-forum-front">
		<h1 class="entry-title"><?php ideaboard_forum_archive_title(); ?></h1>
		<div class="entry-content">

			<?php ideaboard_get_template_part( 'content', 'archive-forum' ); ?>

		</div>
	</div><!-- #forum-front -->

	<?php do_action( 'ideaboard_after_main_content' ); ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
