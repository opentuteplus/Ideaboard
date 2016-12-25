<?php

/**
 * New/Edit Forum
 *
 * @package IdeaBoard
 * @subpackage Theme
 */

?>

<?php if ( ideaboard_is_forum_edit() ) : ?>

<div id="ideaboard-forums">

	<?php ideaboard_breadcrumb(); ?>

	<?php ideaboard_single_forum_description( array( 'forum_id' => ideaboard_get_forum_id() ) ); ?>

<?php endif; ?>

<?php if ( ideaboard_current_user_can_access_create_forum_form() ) : ?>

	<div id="new-forum-<?php ideaboard_forum_id(); ?>" class="ideaboard-forum-form">

		<form id="new-post" name="new-post" method="post" action="<?php the_permalink(); ?>">

			<?php do_action( 'ideaboard_theme_before_forum_form' ); ?>

			<fieldset class="ideaboard-form">
				<legend>

					<?php
						if ( ideaboard_is_forum_edit() )
							printf( __( 'Now Editing &ldquo;%s&rdquo;', 'ideaboard' ), ideaboard_get_forum_title() );
						else
							ideaboard_is_single_forum() ? printf( __( 'Create New Forum in &ldquo;%s&rdquo;', 'ideaboard' ), ideaboard_get_forum_title() ) : _e( 'Create New Forum', 'ideaboard' );
					?>

				</legend>

				<?php do_action( 'ideaboard_theme_before_forum_form_notices' ); ?>

				<?php if ( !ideaboard_is_forum_edit() && ideaboard_is_forum_closed() ) : ?>

					<div class="ideaboard-template-notice">
						<p><?php _e( 'This forum is closed to new content, however your account still allows you to do so.', 'ideaboard' ); ?></p>
					</div>

				<?php endif; ?>

				<?php if ( current_user_can( 'unfiltered_html' ) ) : ?>

					<div class="ideaboard-template-notice">
						<p><?php _e( 'Your account has the ability to post unrestricted HTML content.', 'ideaboard' ); ?></p>
					</div>

				<?php endif; ?>

				<?php do_action( 'ideaboard_template_notices' ); ?>

				<div>

					<?php do_action( 'ideaboard_theme_before_forum_form_title' ); ?>

					<p>
						<label for="ideaboard_forum_title"><?php printf( __( 'Forum Name (Maximum Length: %d):', 'ideaboard' ), ideaboard_get_title_max_length() ); ?></label><br />
						<input type="text" id="ideaboard_forum_title" value="<?php ideaboard_form_forum_title(); ?>" tabindex="<?php ideaboard_tab_index(); ?>" size="40" name="ideaboard_forum_title" maxlength="<?php ideaboard_title_max_length(); ?>" />
					</p>

					<?php do_action( 'ideaboard_theme_after_forum_form_title' ); ?>

					<?php do_action( 'ideaboard_theme_before_forum_form_content' ); ?>

					<?php ideaboard_the_content( array( 'context' => 'forum' ) ); ?>

					<?php do_action( 'ideaboard_theme_after_forum_form_content' ); ?>

					<?php if ( ! ( ideaboard_use_wp_editor() || current_user_can( 'unfiltered_html' ) ) ) : ?>

						<p class="form-allowed-tags">
							<label><?php _e( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes:','ideaboard' ); ?></label><br />
							<code><?php ideaboard_allowed_tags(); ?></code>
						</p>

					<?php endif; ?>

					<?php do_action( 'ideaboard_theme_before_forum_form_type' ); ?>

					<p>
						<label for="ideaboard_forum_type"><?php _e( 'Forum Type:', 'ideaboard' ); ?></label><br />
						<?php ideaboard_form_forum_type_dropdown(); ?>
					</p>

					<?php do_action( 'ideaboard_theme_after_forum_form_type' ); ?>

					<?php do_action( 'ideaboard_theme_before_forum_form_status' ); ?>

					<p>
						<label for="ideaboard_forum_status"><?php _e( 'Status:', 'ideaboard' ); ?></label><br />
						<?php ideaboard_form_forum_status_dropdown(); ?>
					</p>

					<?php do_action( 'ideaboard_theme_after_forum_form_status' ); ?>

					<?php do_action( 'ideaboard_theme_before_forum_form_status' ); ?>

					<p>
						<label for="ideaboard_forum_visibility"><?php _e( 'Visibility:', 'ideaboard' ); ?></label><br />
						<?php ideaboard_form_forum_visibility_dropdown(); ?>
					</p>

					<?php do_action( 'ideaboard_theme_after_forum_visibility_status' ); ?>

					<?php do_action( 'ideaboard_theme_before_forum_form_parent' ); ?>

					<p>
						<label for="ideaboard_forum_parent_id"><?php _e( 'Parent Forum:', 'ideaboard' ); ?></label><br />

						<?php
							ideaboard_dropdown( array(
								'select_id' => 'ideaboard_forum_parent_id',
								'show_none' => __( '(No Parent)', 'ideaboard' ),
								'selected'  => ideaboard_get_form_forum_parent(),
								'exclude'   => ideaboard_get_forum_id()
							) );
						?>
					</p>

					<?php do_action( 'ideaboard_theme_after_forum_form_parent' ); ?>

					<?php do_action( 'ideaboard_theme_before_forum_form_submit_wrapper' ); ?>

					<div class="ideaboard-submit-wrapper">

						<?php do_action( 'ideaboard_theme_before_forum_form_submit_button' ); ?>

						<button type="submit" tabindex="<?php ideaboard_tab_index(); ?>" id="ideaboard_forum_submit" name="ideaboard_forum_submit" class="button submit"><?php _e( 'Submit', 'ideaboard' ); ?></button>

						<?php do_action( 'ideaboard_theme_after_forum_form_submit_button' ); ?>

					</div>

					<?php do_action( 'ideaboard_theme_after_forum_form_submit_wrapper' ); ?>

				</div>

				<?php ideaboard_forum_form_fields(); ?>

			</fieldset>

			<?php do_action( 'ideaboard_theme_after_forum_form' ); ?>

		</form>
	</div>

<?php elseif ( ideaboard_is_forum_closed() ) : ?>

	<div id="no-forum-<?php ideaboard_forum_id(); ?>" class="ideaboard-no-forum">
		<div class="ideaboard-template-notice">
			<p><?php printf( __( 'The forum &#8216;%s&#8217; is closed to new content.', 'ideaboard' ), ideaboard_get_forum_title() ); ?></p>
		</div>
	</div>

<?php else : ?>

	<div id="no-forum-<?php ideaboard_forum_id(); ?>" class="ideaboard-no-forum">
		<div class="ideaboard-template-notice">
			<p><?php is_user_logged_in() ? _e( 'You cannot create new forums.', 'ideaboard' ) : _e( 'You must be logged in to create new forums.', 'ideaboard' ); ?></p>
		</div>
	</div>

<?php endif; ?>

<?php if ( ideaboard_is_forum_edit() ) : ?>

</div>

<?php endif; ?>
