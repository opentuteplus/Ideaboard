<?php

/**
 * Single Topic Lead Content Part
 *
 * @package IdeaBoard
 * @subpackage Theme
 */

?>

<?php do_action( 'ideaboard_template_before_lead_topic' ); ?>

<ul id="bbp-topic-<?php ideaboard_topic_id(); ?>-lead" class="bbp-lead-topic">

	<li class="bbp-header">

		<div class="bbp-topic-author"><?php  _e( 'Creator',  'ideaboard' ); ?></div><!-- .bbp-topic-author -->

		<div class="bbp-topic-content">

			<?php _e( 'Topic', 'ideaboard' ); ?>

			<?php ideaboard_topic_subscription_link(); ?>

			<?php ideaboard_topic_favorite_link(); ?>

		</div><!-- .bbp-topic-content -->

	</li><!-- .bbp-header -->

	<li class="bbp-body">

		<div class="bbp-topic-header">

			<div class="bbp-meta">

				<span class="bbp-topic-post-date"><?php ideaboard_topic_post_date(); ?></span>

				<a href="<?php ideaboard_topic_permalink(); ?>" class="bbp-topic-permalink">#<?php ideaboard_topic_id(); ?></a>

				<?php do_action( 'ideaboard_theme_before_topic_admin_links' ); ?>

				<?php ideaboard_topic_admin_links(); ?>

				<?php do_action( 'ideaboard_theme_after_topic_admin_links' ); ?>

			</div><!-- .bbp-meta -->

		</div><!-- .bbp-topic-header -->

		<div id="post-<?php ideaboard_topic_id(); ?>" <?php ideaboard_topic_class(); ?>>

			<div class="bbp-topic-author">

				<?php do_action( 'ideaboard_theme_before_topic_author_details' ); ?>

				<?php ideaboard_topic_author_link( array( 'sep' => '<br />', 'show_role' => true ) ); ?>

				<?php if ( ideaboard_is_user_keymaster() ) : ?>

					<?php do_action( 'ideaboard_theme_before_topic_author_admin_details' ); ?>

					<div class="bbp-topic-ip"><?php ideaboard_author_ip( ideaboard_get_topic_id() ); ?></div>

					<?php do_action( 'ideaboard_theme_after_topic_author_admin_details' ); ?>

				<?php endif; ?>

				<?php do_action( 'ideaboard_theme_after_topic_author_details' ); ?>

			</div><!-- .bbp-topic-author -->

			<div class="bbp-topic-content">

				<?php do_action( 'ideaboard_theme_before_topic_content' ); ?>

				<?php ideaboard_topic_content(); ?>

				<?php do_action( 'ideaboard_theme_after_topic_content' ); ?>

			</div><!-- .bbp-topic-content -->

		</div><!-- #post-<?php ideaboard_topic_id(); ?> -->

	</li><!-- .bbp-body -->

	<li class="bbp-footer">

		<div class="bbp-topic-author"><?php  _e( 'Creator',  'ideaboard' ); ?></div>

		<div class="bbp-topic-content">

			<?php _e( 'Topic', 'ideaboard' ); ?>

		</div><!-- .bbp-topic-content -->

	</li>

</ul><!-- #bbp-topic-<?php ideaboard_topic_id(); ?>-lead -->

<?php do_action( 'ideaboard_template_after_lead_topic' ); ?>
