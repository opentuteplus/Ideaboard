<?php

/**
 * Replies Loop - Single Reply
 *
 * @package IdeaBoard
 * @subpackage Theme
 */

?>

<div id="post-<?php ideaboard_reply_id(); ?>" class="ideaboard-reply-header">

	<div class="ideaboard-meta">

		<span class="ideaboard-reply-post-date"><?php ideaboard_reply_post_date(); ?></span>

		<?php if ( ideaboard_is_single_user_replies() ) : ?>

			<span class="ideaboard-header">
				<?php _e( 'in reply to: ', 'ideaboard' ); ?>
				<a class="ideaboard-topic-permalink" href="<?php ideaboard_topic_permalink( ideaboard_get_reply_topic_id() ); ?>"><?php ideaboard_topic_title( ideaboard_get_reply_topic_id() ); ?></a>
			</span>

		<?php endif; ?>

		<a href="<?php ideaboard_reply_url(); ?>" class="ideaboard-reply-permalink">#<?php ideaboard_reply_id(); ?></a>

		<?php do_action( 'ideaboard_theme_before_reply_admin_links' ); ?>

		<?php ideaboard_reply_admin_links(); ?>

		<?php do_action( 'ideaboard_theme_after_reply_admin_links' ); ?>

	</div><!-- .ideaboard-meta -->

</div><!-- #post-<?php ideaboard_reply_id(); ?> -->

<div <?php ideaboard_reply_class(); ?>>

	<div class="ideaboard-reply-author">

		<?php do_action( 'ideaboard_theme_before_reply_author_details' ); ?>

		<?php ideaboard_reply_author_link( array( 'sep' => '<br />', 'show_role' => true ) ); ?>

		<?php if ( ideaboard_is_user_keymaster() ) : ?>

			<?php do_action( 'ideaboard_theme_before_reply_author_admin_details' ); ?>

			<div class="ideaboard-reply-ip"><?php ideaboard_author_ip( ideaboard_get_reply_id() ); ?></div>

			<?php do_action( 'ideaboard_theme_after_reply_author_admin_details' ); ?>

		<?php endif; ?>

		<?php do_action( 'ideaboard_theme_after_reply_author_details' ); ?>

	</div><!-- .ideaboard-reply-author -->

	<div class="ideaboard-reply-content">

		<?php do_action( 'ideaboard_theme_before_reply_content' ); ?>

		<?php ideaboard_reply_content(); ?>

		<?php do_action( 'ideaboard_theme_after_reply_content' ); ?>

	</div><!-- .ideaboard-reply-content -->

</div><!-- .reply -->
