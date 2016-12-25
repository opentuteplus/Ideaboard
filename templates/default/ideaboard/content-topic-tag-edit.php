<?php

/**
 * Topic Tag Edit Content Part
 *
 * @package IdeaBoard
 * @subpackage Theme
 */

?>

<div id="ideaboard-forums">

	<?php ideaboard_breadcrumb(); ?>

	<?php ideaboard_topic_tag_description(); ?>

	<?php do_action( 'ideaboard_template_before_topic_tag_edit' ); ?>

	<?php ideaboard_get_template_part( 'form', 'topic-tag' ); ?>

	<?php do_action( 'ideaboard_template_after_topic_tag_edit' ); ?>

</div>
