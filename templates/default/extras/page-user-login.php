<?php

/**
 * Template Name: IdeaBoard - User Login
 *
 * @package IdeaBoard
 * @subpackage Theme
 */

// No logged in users
ideaboard_logged_in_redirect();

// Begin Template
get_header(); ?>

	<?php do_action( 'ideaboard_before_main_content' ); ?>

	<?php do_action( 'ideaboard_template_notices' ); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<div id="ideaboard-login" class="ideaboard-login">
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<div class="entry-content">

				<?php the_content(); ?>

				<div id="ideaboard-forums">

					<?php ideaboard_breadcrumb(); ?>

					<?php ideaboard_get_template_part( 'form', 'user-login' ); ?>

				</div>
			</div>
		</div><!-- #ideaboard-login -->

	<?php endwhile; ?>

	<?php do_action( 'ideaboard_after_main_content' ); ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
