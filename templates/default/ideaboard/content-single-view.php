<?php

/**
 * Single View Content Part
 *
 * @package IdeaBoard
 * @subpackage Theme
 */

?>

<div id="ideaboard-forums">

	<?php ideaboard_breadcrumb(); ?>

	<?php ideaboard_set_query_name( ideaboard_get_view_rewrite_id() ); ?>

	<?php if ( ideaboard_view_query() ) : ?>

		<?php ideaboard_get_template_part( 'pagination', 'topics'    ); ?>

		<?php ideaboard_get_template_part( 'loop',       'topics'    ); ?>

		<?php ideaboard_get_template_part( 'pagination', 'topics'    ); ?>

	<?php else : ?>

		<?php ideaboard_get_template_part( 'feedback',   'no-topics' ); ?>

	<?php endif; ?>

	<?php ideaboard_reset_query_name(); ?>

</div>
