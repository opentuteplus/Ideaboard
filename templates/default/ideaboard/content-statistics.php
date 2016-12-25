<?php

/**
 * Statistics Content Part
 *
 * @package IdeaBoard
 * @subpackage Theme
 */

// Get the statistics
$stats = ideaboard_get_statistics(); ?>

<dl role="main">

	<?php do_action( 'ideaboard_before_statistics' ); ?>

	<dt><?php _e( 'Registered Users', 'ideaboard' ); ?></dt>
	<dd>
		<strong><?php echo esc_html( $stats['user_count'] ); ?></strong>
	</dd>

	<dt><?php _e( 'Forums', 'ideaboard' ); ?></dt>
	<dd>
		<strong><?php echo esc_html( $stats['forum_count'] ); ?></strong>
	</dd>

	<dt><?php _e( 'Topics', 'ideaboard' ); ?></dt>
	<dd>
		<strong><?php echo esc_html( $stats['topic_count'] ); ?></strong>
	</dd>

	<dt><?php _e( 'Replies', 'ideaboard' ); ?></dt>
	<dd>
		<strong><?php echo esc_html( $stats['reply_count'] ); ?></strong>
	</dd>

	<dt><?php _e( 'Topic Tags', 'ideaboard' ); ?></dt>
	<dd>
		<strong><?php echo esc_html( $stats['topic_tag_count'] ); ?></strong>
	</dd>

	<?php if ( !empty( $stats['empty_topic_tag_count'] ) ) : ?>

		<dt><?php _e( 'Empty Topic Tags', 'ideaboard' ); ?></dt>
		<dd>
			<strong><?php echo esc_html( $stats['empty_topic_tag_count'] ); ?></strong>
		</dd>

	<?php endif; ?>

	<?php if ( !empty( $stats['topic_count_hidden'] ) ) : ?>

		<dt><?php _e( 'Hidden Topics', 'ideaboard' ); ?></dt>
		<dd>
			<strong>
				<abbr title="<?php echo esc_attr( $stats['hidden_topic_title'] ); ?>"><?php echo esc_html( $stats['topic_count_hidden'] ); ?></abbr>
			</strong>
		</dd>

	<?php endif; ?>

	<?php if ( !empty( $stats['reply_count_hidden'] ) ) : ?>

		<dt><?php _e( 'Hidden Replies', 'ideaboard' ); ?></dt>
		<dd>
			<strong>
				<abbr title="<?php echo esc_attr( $stats['hidden_reply_title'] ); ?>"><?php echo esc_html( $stats['reply_count_hidden'] ); ?></abbr>
			</strong>
		</dd>

	<?php endif; ?>

	<?php do_action( 'ideaboard_after_statistics' ); ?>

</dl>

<?php unset( $stats );