<?php

/**
 * Edit Topic Tag
 *
 * @package IdeaBoard
 * @subpackage Theme
 */

?>

<?php if ( current_user_can( 'edit_topic_tags' ) ) : ?>

	<div id="edit-topic-tag-<?php ideaboard_topic_tag_id(); ?>" class="ideaboard-topic-tag-form">

		<fieldset class="ideaboard-form" id="ideaboard-edit-topic-tag">

			<legend><?php printf( __( 'Manage Tag: "%s"', 'ideaboard' ), ideaboard_get_topic_tag_name() ); ?></legend>

			<fieldset class="ideaboard-form" id="tag-rename">

				<legend><?php _e( 'Rename', 'ideaboard' ); ?></legend>

				<div class="ideaboard-template-notice info">
					<p><?php _e( 'Leave the slug empty to have one automatically generated.', 'ideaboard' ); ?></p>
				</div>

				<div class="ideaboard-template-notice">
					<p><?php _e( 'Changing the slug affects its permalink. Any links to the old slug will stop working.', 'ideaboard' ); ?></p>
				</div>

				<form id="rename_tag" name="rename_tag" method="post" action="<?php the_permalink(); ?>">

					<div>
						<label for="tag-name"><?php _e( 'Name:', 'ideaboard' ); ?></label>
						<input type="text" id="tag-name" name="tag-name" size="20" maxlength="40" tabindex="<?php ideaboard_tab_index(); ?>" value="<?php echo esc_attr( ideaboard_get_topic_tag_name() ); ?>" />
					</div>

					<div>
						<label for="tag-slug"><?php _e( 'Slug:', 'ideaboard' ); ?></label>
						<input type="text" id="tag-slug" name="tag-slug" size="20" maxlength="40" tabindex="<?php ideaboard_tab_index(); ?>" value="<?php echo esc_attr( apply_filters( 'editable_slug', ideaboard_get_topic_tag_slug() ) ); ?>" />
					</div>

					<div class="ideaboard-submit-wrapper">
						<button type="submit" tabindex="<?php ideaboard_tab_index(); ?>" class="button submit"><?php esc_attr_e( 'Update', 'ideaboard' ); ?></button>

						<input type="hidden" name="tag-id" value="<?php ideaboard_topic_tag_id(); ?>" />
						<input type="hidden" name="action" value="ideaboard-update-topic-tag" />

						<?php wp_nonce_field( 'update-tag_' . ideaboard_get_topic_tag_id() ); ?>

					</div>
				</form>

			</fieldset>

			<fieldset class="ideaboard-form" id="tag-merge">

				<legend><?php _e( 'Merge', 'ideaboard' ); ?></legend>

				<div class="ideaboard-template-notice">
					<p><?php _e( 'Merging tags together cannot be undone.', 'ideaboard' ); ?></p>
				</div>

				<form id="merge_tag" name="merge_tag" method="post" action="<?php the_permalink(); ?>">

					<div>
						<label for="tag-existing-name"><?php _e( 'Existing tag:', 'ideaboard' ); ?></label>
						<input type="text" id="tag-existing-name" name="tag-existing-name" size="22" tabindex="<?php ideaboard_tab_index(); ?>" maxlength="40" />
					</div>

					<div class="ideaboard-submit-wrapper">
						<button type="submit" tabindex="<?php ideaboard_tab_index(); ?>" class="button submit" onclick="return confirm('<?php echo esc_js( sprintf( __( 'Are you sure you want to merge the "%s" tag into the tag you specified?', 'ideaboard' ), ideaboard_get_topic_tag_name() ) ); ?>');"><?php esc_attr_e( 'Merge', 'ideaboard' ); ?></button>

						<input type="hidden" name="tag-id" value="<?php ideaboard_topic_tag_id(); ?>" />
						<input type="hidden" name="action" value="ideaboard-merge-topic-tag" />

						<?php wp_nonce_field( 'merge-tag_' . ideaboard_get_topic_tag_id() ); ?>
					</div>
				</form>

			</fieldset>

			<?php if ( current_user_can( 'delete_topic_tags' ) ) : ?>

				<fieldset class="ideaboard-form" id="delete-tag">

					<legend><?php _e( 'Delete', 'ideaboard' ); ?></legend>

					<div class="ideaboard-template-notice info">
						<p><?php _e( 'This does not delete your topics. Only the tag itself is deleted.', 'ideaboard' ); ?></p>
					</div>
					<div class="ideaboard-template-notice">
						<p><?php _e( 'Deleting a tag cannot be undone.', 'ideaboard' ); ?></p>
						<p><?php _e( 'Any links to this tag will no longer function.', 'ideaboard' ); ?></p>
					</div>

					<form id="delete_tag" name="delete_tag" method="post" action="<?php the_permalink(); ?>">

						<div class="ideaboard-submit-wrapper">
							<button type="submit" tabindex="<?php ideaboard_tab_index(); ?>" class="button submit" onclick="return confirm('<?php echo esc_js( sprintf( __( 'Are you sure you want to delete the "%s" tag? This is permanent and cannot be undone.', 'ideaboard' ), ideaboard_get_topic_tag_name() ) ); ?>');"><?php esc_attr_e( 'Delete', 'ideaboard' ); ?></button>

							<input type="hidden" name="tag-id" value="<?php ideaboard_topic_tag_id(); ?>" />
							<input type="hidden" name="action" value="ideaboard-delete-topic-tag" />

							<?php wp_nonce_field( 'delete-tag_' . ideaboard_get_topic_tag_id() ); ?>
						</div>
					</form>

				</fieldset>

			<?php endif; ?>

		</fieldset>
	</div>

<?php endif; ?>
