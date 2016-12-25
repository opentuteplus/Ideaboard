<?php

/**
 * Pagination for pages of replies (when viewing a topic)
 *
 * @package IdeaBoard
 * @subpackage Theme
 */

?>

<?php do_action( 'ideaboard_template_before_pagination_loop' ); ?>

<div class="bbp-pagination">
	<div class="bbp-pagination-count">

		<?php ideaboard_topic_pagination_count(); ?>

	</div>

	<div class="bbp-pagination-links">

		<?php ideaboard_topic_pagination_links(); ?>

	</div>
</div>

<?php do_action( 'ideaboard_template_after_pagination_loop' ); ?>
