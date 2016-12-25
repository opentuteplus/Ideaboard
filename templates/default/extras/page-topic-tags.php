<?php

/**
 * Template Name: IdeaBoard - Topic Tags
 *
 * @package IdeaBoard
 * @subpackage Theme
 */

get_header(); ?>

	<?php do_action( 'ideaboard_before_main_content' ); ?>

	<?php do_action( 'ideaboard_template_notices' ); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<div id="ideaboard-topic-tags" class="ideaboard-topic-tags">
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<div class="entry-content">

				<?php get_the_content() ? the_content() : _e( '<p>This is a collection of tags that are currently popular on our forums.</p>', 'ideaboard' ); ?>

				<div id="ideaboard-forums">

					<?php ideaboard_breadcrumb(); ?>

					<div id="ideaboard-topic-hot-tags">

						<?php wp_tag_cloud( array( 'smallest' => 9, 'largest' => 38, 'number' => 80, 'taxonomy' => ideaboard_get_topic_tag_tax_id() ) ); ?>

					</div>
				</div>
			</div>
		</div><!-- #ideaboard-topic-tags -->

	<?php endwhile; ?>

	<?php do_action( 'ideaboard_after_main_content' ); ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
