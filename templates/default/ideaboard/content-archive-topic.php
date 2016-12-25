<?php

/**
 * Archive Topic Content Part
 *
 * @package IdeaBoard
 * @subpackage Theme
 */

?>

<div id="ideaboard-forums">

	<?php if ( ideaboard_allow_search() ) : ?>

		<div class="bbp-search-form">

			<?php ideaboard_get_template_part( 'form', 'search' ); ?>

		</div>

	<?php endif; ?>

	<?php ideaboard_breadcrumb(); ?>

	<?php if ( ideaboard_is_topic_tag() ) ideaboard_topic_tag_description(); ?>

	<?php do_action( 'ideaboard_template_before_topics_index' ); ?>

	<?php if ( ideaboard_has_topics() ) : ?>

		<?php ideaboard_get_template_part( 'pagination', 'topics'    ); ?>

		<?php ideaboard_get_template_part( 'loop',       'topics'    ); ?>

		<?php ideaboard_get_template_part( 'pagination', 'topics'    ); ?>

	<?php else : ?>

		<?php ideaboard_get_template_part( 'feedback',   'no-topics' ); ?>

	<?php endif; ?>

	<?php do_action( 'ideaboard_template_after_topics_index' ); ?>

</div>
