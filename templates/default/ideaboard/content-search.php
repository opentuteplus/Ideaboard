<?php

/**
 * Search Content Part
 *
 * @package IdeaBoard
 * @subpackage Theme
 */

?>

<div id="ideaboard-forums">

	<?php ideaboard_breadcrumb(); ?>

	<?php ideaboard_set_query_name( ideaboard_get_search_rewrite_id() ); ?>

	<?php do_action( 'ideaboard_template_before_search' ); ?>

	<?php if ( ideaboard_has_search_results() ) : ?>

		 <?php ideaboard_get_template_part( 'pagination', 'search' ); ?>

		 <?php ideaboard_get_template_part( 'loop',       'search' ); ?>

		 <?php ideaboard_get_template_part( 'pagination', 'search' ); ?>

	<?php elseif ( ideaboard_get_search_terms() ) : ?>

		 <?php ideaboard_get_template_part( 'feedback',   'no-search' ); ?>

	<?php else : ?>

		<?php ideaboard_get_template_part( 'form', 'search' ); ?>

	<?php endif; ?>

	<?php do_action( 'ideaboard_template_after_search_results' ); ?>

</div>

