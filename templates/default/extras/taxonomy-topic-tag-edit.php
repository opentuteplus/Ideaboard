<?php

/**
 * Topic Tag Edit
 *
 * @package IdeaBoard
 * @subpackage Theme
 */

get_header(); ?>

	<?php do_action( 'ideaboard_before_main_content' ); ?>

	<?php do_action( 'ideaboard_template_notices' ); ?>

	<div id="topic-tag" class="bbp-topic-tag">
		<h1 class="entry-title"><?php printf( __( 'Topic Tag: %s', 'ideaboard' ), '<span>' . ideaboard_get_topic_tag_name() . '</span>' ); ?></h1>

		<div class="entry-content">

			<?php ideaboard_get_template_part( 'content', 'topic-tag-edit' ); ?>

		</div>
	</div><!-- #topic-tag -->

	<?php do_action( 'ideaboard_after_main_content' ); ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
