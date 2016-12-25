<?php

/**
 * Single Topic Content Part
 *
 * @package IdeaBoard
 * @subpackage Theme
 */

?>

<div id="ideaboard-forums">

	<?php ideaboard_breadcrumb(); ?>

	<?php do_action( 'ideaboard_template_before_single_topic' ); ?>

	<?php if ( post_password_required() ) : ?>

		<?php ideaboard_get_template_part( 'form', 'protected' ); ?>

	<?php else : ?>

		<?php ideaboard_topic_tag_list(); ?>

		<?php ideaboard_single_topic_description(); ?>

		<?php if ( ideaboard_show_lead_topic() ) : ?>

			<?php ideaboard_get_template_part( 'content', 'single-topic-lead' ); ?>

		<?php endif; ?>

		<?php if ( ideaboard_has_replies() ) : ?>

			<?php ideaboard_get_template_part( 'pagination', 'replies' ); ?>

			<?php ideaboard_get_template_part( 'loop',       'replies' ); ?>

			<?php ideaboard_get_template_part( 'pagination', 'replies' ); ?>

		<?php endif; ?>

		<?php ideaboard_get_template_part( 'form', 'reply' ); ?>

	<?php endif; ?>

	<?php do_action( 'ideaboard_template_after_single_topic' ); ?>

</div>
