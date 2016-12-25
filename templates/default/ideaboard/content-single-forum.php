<?php

/**
 * Single Forum Content Part
 *
 * @package IdeaBoard
 * @subpackage Theme
 */

?>

<div id="ideaboard-forums">

	<?php ideaboard_breadcrumb(); ?>

	<?php ideaboard_forum_subscription_link(); ?>

	<?php do_action( 'ideaboard_template_before_single_forum' ); ?>

	<?php if ( post_password_required() ) : ?>

		<?php ideaboard_get_template_part( 'form', 'protected' ); ?>

	<?php else : ?>

		<?php ideaboard_single_forum_description(); ?>

		<?php if ( ideaboard_has_forums() ) : ?>

			<?php ideaboard_get_template_part( 'loop', 'forums' ); ?>

		<?php endif; ?>

		<?php if ( !ideaboard_is_forum_category() && ideaboard_has_topics() ) : ?>

			<?php ideaboard_get_template_part( 'pagination', 'topics'    ); ?>

			<?php ideaboard_get_template_part( 'loop',       'topics'    ); ?>

			<?php ideaboard_get_template_part( 'pagination', 'topics'    ); ?>

			<?php ideaboard_get_template_part( 'form',       'topic'     ); ?>

		<?php elseif ( !ideaboard_is_forum_category() ) : ?>

			<?php ideaboard_get_template_part( 'feedback',   'no-topics' ); ?>

			<?php ideaboard_get_template_part( 'form',       'topic'     ); ?>

		<?php endif; ?>

	<?php endif; ?>

	<?php do_action( 'ideaboard_template_after_single_forum' ); ?>

</div>
