<?php

/**
 * Search Loop
 *
 * @package IdeaBoard
 * @subpackage Theme
*/

?>

<?php do_action( 'ideaboard_template_before_search_results_loop' ); ?>

<ul id="bbp-search-results" class="forums bbp-search-results">

	<li class="bbp-header">

		<div class="bbp-search-author"><?php  _e( 'Author',  'ideaboard' ); ?></div><!-- .bbp-reply-author -->

		<div class="bbp-search-content">

			<?php _e( 'Search Results', 'ideaboard' ); ?>

		</div><!-- .bbp-search-content -->

	</li><!-- .bbp-header -->

	<li class="bbp-body">

		<?php while ( ideaboard_search_results() ) : ideaboard_the_search_result(); ?>

			<?php ideaboard_get_template_part( 'loop', 'search-' . get_post_type() ); ?>

		<?php endwhile; ?>

	</li><!-- .bbp-body -->

	<li class="bbp-footer">

		<div class="bbp-search-author"><?php  _e( 'Author',  'ideaboard' ); ?></div>

		<div class="bbp-search-content">

			<?php _e( 'Search Results', 'ideaboard' ); ?>

		</div><!-- .bbp-search-content -->

	</li><!-- .bbp-footer -->

</ul><!-- #bbp-search-results -->

<?php do_action( 'ideaboard_template_after_search_results_loop' ); ?>