<?php

/**
 * Single Topic Lead Content Part
 *
 * @package IdeaBoard
 * @subpackage Theme
 */

?>

<?php do_action( 'ideaboard_template_before_lead_topic' ); ?>

<ul id="ideaboard-topic-<?php ideaboard_topic_id(); ?>-lead" class="ideaboard-lead-topic">

	<li class="ideaboard-header">

		<div class="ideaboard-topic-author"><?php  _e( 'Creator',  'ideaboard' ); ?></div><!-- .ideaboard-topic-author -->

		<div class="ideaboard-topic-content">

			<?php _e( 'Topic', 'ideaboard' ); ?>

			<?php ideaboard_topic_subscription_link(); ?>

			<?php ideaboard_topic_favorite_link(); ?>

		</div><!-- .ideaboard-topic-content -->

	</li><!-- .ideaboard-header -->

	<li class="ideaboard-body">

		<div class="ideaboard-topic-header">

			<div class="ideaboard-meta">

				<span class="ideaboard-topic-post-date"><?php ideaboard_topic_post_date(); ?></span>

				<a href="<?php ideaboard_topic_permalink(); ?>" class="ideaboard-topic-permalink">#<?php ideaboard_topic_id(); ?></a>

				<?php do_action( 'ideaboard_theme_before_topic_admin_links' ); ?>

				<?php ideaboard_topic_admin_links(); ?>

				<?php do_action( 'ideaboard_theme_after_topic_admin_links' ); ?>

			</div><!-- .ideaboard-meta -->

		</div><!-- .ideaboard-topic-header -->

		<div id="post-<?php ideaboard_topic_id(); ?>" <?php ideaboard_topic_class(); ?>>

			<div class="ideaboard-topic-author">

				<?php do_action( 'ideaboard_theme_before_topic_author_details' ); ?>

				<?php ideaboard_topic_author_link( array( 'sep' => '<br />', 'show_role' => true ) ); ?>

				<?php if ( ideaboard_is_user_keymaster() ) : ?>

					<?php do_action( 'ideaboard_theme_before_topic_author_admin_details' ); ?>

					<div class="ideaboard-topic-ip"><?php ideaboard_author_ip( ideaboard_get_topic_id() ); ?></div>

					<?php do_action( 'ideaboard_theme_after_topic_author_admin_details' ); ?>

				<?php endif; ?>

				<?php do_action( 'ideaboard_theme_after_topic_author_details' ); ?>

			</div><!-- .ideaboard-topic-author -->

			<div class="ideaboard-topic-content">

				<?php do_action( 'ideaboard_theme_before_topic_content' ); ?>

				<?php ideaboard_topic_content(); ?>

				<?php do_action( 'ideaboard_theme_after_topic_content' ); ?>

			</div><!-- .ideaboard-topic-content -->

		</div><!-- #post-<?php ideaboard_topic_id(); ?> -->

	</li><!-- .ideaboard-body -->

	<li class="ideaboard-footer">

		<div class="ideaboard-topic-author"><?php  _e( 'Creator',  'ideaboard' ); ?></div>

		<div class="ideaboard-topic-content">

			<?php _e( 'Topic', 'ideaboard' ); ?>

		</div><!-- .ideaboard-topic-content -->

	</li>

</ul><!-- #ideaboard-topic-<?php ideaboard_topic_id(); ?>-lead -->

<?php do_action( 'ideaboard_template_after_lead_topic' ); ?>
