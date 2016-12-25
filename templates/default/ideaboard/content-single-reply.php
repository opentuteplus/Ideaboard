<?php

/**
 * Single Reply Content Part
 *
 * @package IdeaBoard
 * @subpackage Theme
 */

?>

<div id="ideaboard-forums">

	<?php ideaboard_breadcrumb(); ?>

	<?php do_action( 'ideaboard_template_before_single_reply' ); ?>

	<?php if ( post_password_required() ) : ?>

		<?php ideaboard_get_template_part( 'form', 'protected' ); ?>

	<?php else : ?>

		<?php ideaboard_get_template_part( 'loop', 'single-reply' ); ?>

	<?php endif; ?>

	<?php do_action( 'ideaboard_template_after_single_reply' ); ?>

</div>
