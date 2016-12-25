<?php

/**
 * Template Name: IdeaBoard - Topics (No Replies)
 *
 * @package IdeaBoard
 * @subpackage Theme
 */

get_header(); ?>

	<?php do_action( 'ideaboard_before_main_content' ); ?>

	<?php do_action( 'ideaboard_template_notices' ); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<div id="topics-front" class="bbp-topics-front">
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<div class="entry-content">

				<?php the_content(); ?>

				<div id="ideaboard-forums">

					<?php ideaboard_breadcrumb(); ?>

					<?php ideaboard_set_query_name( 'ideaboard_no_replies' ); ?>

					<?php if ( ideaboard_has_topics( array( 'meta_key' => '_ideaboard_reply_count', 'meta_value' => '1', 'meta_compare' => '<', 'orderby' => 'date', 'show_stickies' => false ) ) ) : ?>

						<?php ideaboard_get_template_part( 'pagination', 'topics'    ); ?>

						<?php ideaboard_get_template_part( 'loop',       'topics'    ); ?>

						<?php ideaboard_get_template_part( 'pagination', 'topics'    ); ?>

					<?php else : ?>

						<?php ideaboard_get_template_part( 'feedback',   'no-topics' ); ?>

					<?php endif; ?>

					<?php ideaboard_reset_query_name(); ?>

				</div>
			</div>
		</div><!-- #topics-front -->

	<?php endwhile; ?>

	<?php do_action( 'ideaboard_after_main_content' ); ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
