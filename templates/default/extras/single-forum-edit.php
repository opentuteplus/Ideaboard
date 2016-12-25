<?php

/**
 * Edit handler for forums
 *
 * @package IdeaBoard
 * @subpackage Theme
 */

get_header(); ?>

	<?php do_action( 'ideaboard_before_main_content' ); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<div id="ideaboard-edit-page" class="ideaboard-edit-page">
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<div class="entry-content">

				<?php ideaboard_get_template_part( 'form', 'forum' ); ?>

			</div>
		</div><!-- #ideaboard-edit-page -->

	<?php endwhile; ?>

	<?php do_action( 'ideaboard_after_main_content' ); ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
