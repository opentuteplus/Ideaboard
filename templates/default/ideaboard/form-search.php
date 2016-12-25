<?php

/**
 * Search 
 *
 * @package IdeaBoard
 * @subpackage Theme
 */

?>

<form role="search" method="get" id="ideaboard-search-form" action="<?php ideaboard_search_url(); ?>">
	<div>
		<label class="screen-reader-text hidden" for="ideaboard_search"><?php _e( 'Search for:', 'ideaboard' ); ?></label>
		<input type="hidden" name="action" value="ideaboard-search-request" />
		<input tabindex="<?php ideaboard_tab_index(); ?>" type="text" value="<?php echo esc_attr( ideaboard_get_search_terms() ); ?>" name="ideaboard_search" id="ideaboard_search" />
		<input tabindex="<?php ideaboard_tab_index(); ?>" class="button" type="submit" id="ideaboard_search_submit" value="<?php esc_attr_e( 'Search', 'ideaboard' ); ?>" />
	</div>
</form>
