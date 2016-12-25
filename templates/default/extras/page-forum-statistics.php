<?php

/**
 * Template Name: IdeaBoard - Statistics
 *
 * @package IdeaBoard
 * @subpackage Theme
 */

get_header(); ?>

	<?php do_action( 'ideaboard_before_main_content' ); ?>

	<?php do_action( 'ideaboard_template_notices' ); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<div id="ideaboard-statistics" class="ideaboard-statistics">
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<div class="entry-content">

				<?php get_the_content() ? the_content() : _e( '<p>Here are the statistics and popular topics of our forums.</p>', 'ideaboard' ); ?>

				<div id="ideaboard-forums">

					<?php ideaboard_get_template_part( 'content', 'statistics' ); ?>

					<?php do_action( 'ideaboard_before_popular_topics' ); ?>

					<?php ideaboard_set_query_name( 'ideaboard_popular_topics' ); ?>

					<?php if ( ideaboard_view_query( 'popular' ) ) : ?>

						<h2 class="entry-title"><?php _e( 'Popular Topics', 'ideaboard' ); ?></h2>

						<?php ideaboard_get_template_part( 'pagination', 'topics' ); ?>

						<?php ideaboard_get_template_part( 'loop',       'topics' ); ?>

						<?php ideaboard_get_template_part( 'pagination', 'topics' ); ?>

					<?php endif; ?>

					<?php ideaboard_reset_query_name(); ?>

					<?php do_action( 'ideaboard_after_popular_topics' ); ?>

				</div>
			</div>
		</div><!-- #ideaboard-statistics -->

	<?php endwhile; ?>

	<?php do_action( 'ideaboard_after_main_content' ); ?>

<?php get_sidebar(); ?>

<?php get_footer();