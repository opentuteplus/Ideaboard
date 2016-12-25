<?php

/**
 * Search Loop
 *
 * @package IdeaBoard
 * @subpackage Theme
*/

?>

<?php do_action( 'ideaboard_template_before_search_results_loop' ); ?>

<ul id="ideaboard-search-results" class="forums ideaboard-search-results">

	<li class="ideaboard-header">

		<div class="ideaboard-search-author"><?php  _e( 'Author',  'ideaboard' ); ?></div><!-- .ideaboard-reply-author -->

		<div class="ideaboard-search-content">

			<?php _e( 'Search Results', 'ideaboard' ); ?>

		</div><!-- .ideaboard-search-content -->

	</li><!-- .ideaboard-header -->

	<li class="ideaboard-body">

		<?php while ( ideaboard_search_results() ) : ideaboard_the_search_result(); ?>

			<?php ideaboard_get_template_part( 'loop', 'search-' . get_post_type() ); ?>

		<?php endwhile; ?>

	</li><!-- .ideaboard-body -->

	<li class="ideaboard-footer">

		<div class="ideaboard-search-author"><?php  _e( 'Author',  'ideaboard' ); ?></div>

		<div class="ideaboard-search-content">

			<?php _e( 'Search Results', 'ideaboard' ); ?>

		</div><!-- .ideaboard-search-content -->

	</li><!-- .ideaboard-footer -->

</ul><!-- #ideaboard-search-results -->

<?php do_action( 'ideaboard_template_after_search_results_loop' ); ?>