<?php

	// Start engine
		require_once(dirname(dirname(dirname(dirname(__FILE__)))) . "/engine/start.php");
		
	// Get the current page's owner
		$page_owner = page_owner_entity();
		if ($page_owner === false || is_null($page_owner)) {
			$page_owner = $_SESSION['user'];
			set_page_owner($_SESSION['guid']);
		}
		
	// List bookmarks
		$area2 = elgg_view_title(elgg_echo('gantt:all'));
		set_context('search');
		$offset = (int)get_input('offset', 0);
		$area2 .= elgg_list_entities(array('type' => 'object', 'subtype' => 'gantt', 'limit' => 10, 'offset' => $offset, 'full_view' => FALSE, 'view_toggle_type' => FALSE));
		set_context('gantt');
		
	// Format page
		$body = elgg_view_layout('two_column_left_sidebar', $area1, $area2);
		
	// Draw it
		page_draw(elgg_echo('gannt:all'),$body);

?>