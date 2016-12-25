<?php

/**
 * IdeaBoard - Topic Archive
 *
 * @package IdeaBoard
 * @subpackage Theme
 */

get_header(); ?>

	<?php do_action( 'ideaboard_before_main_content' ); ?>

	<?php do_action( 'ideaboard_template_notices' ); ?>

	<div id="topic-front" class="ideaboard-topics-front">
		<h1 class="entry-title"><?php ideaboard_topic_archive_title(); ?></h1>
		<div class="entry-content">

			<?php ideaboard_get_template_part( 'content', 'archive-topic' ); ?>

		</div>
	</div><!-- #topics-front -->

	<?php do_action( 'ideaboard_after_main_content' ); ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
