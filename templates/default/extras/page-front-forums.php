<?php

/**
 * Template Name: IdeaBoard - Forums (Index)
 *
 * @package IdeaBoard
 * @subpackage Theme
 */

get_header(); ?>

	<?php do_action( 'ideaboard_before_main_content' ); ?>

	<?php do_action( 'ideaboard_template_notices' ); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<div id="forum-front" class="ideaboard-forum-front">
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<div class="entry-content">

				<?php the_content(); ?>

				<?php ideaboard_get_template_part( 'content', 'archive-forum' ); ?>

			</div>
		</div><!-- #forum-front -->

	<?php endwhile; ?>

	<?php do_action( 'ideaboard_after_main_content' ); ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
