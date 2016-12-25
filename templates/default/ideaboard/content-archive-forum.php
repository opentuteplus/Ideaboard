<?php

/**
 * Archive Forum Content Part
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

	<?php ideaboard_forum_subscription_link(); ?>

	<?php do_action( 'ideaboard_template_before_forums_index' ); ?>

	<?php if ( ideaboard_has_forums() ) : ?>

		<?php ideaboard_get_template_part( 'loop',     'forums'    ); ?>

	<?php else : ?>

		<?php ideaboard_get_template_part( 'feedback', 'no-forums' ); ?>

	<?php endif; ?>

	<?php do_action( 'ideaboard_template_after_forums_index' ); ?>

</div>
