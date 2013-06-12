<?php

	require_once(dirname(dirname(dirname(dirname(__FILE__)))) . "/engine/start.php");

	// access check for closed groups
	group_gatekeeper();
	
	//set the title
	$page_owner = page_owner_entity();
	if ($page_owner === false || is_null($page_owner)) {
		$page_owner = $_SESSION['user'];
		set_page_owner($page_owner->getGUID());
	}
		
	if (page_owner() == get_loggedin_userid()) {
		$title = elgg_echo('gantt:yours');
	} else {
		$title = sprintf(elgg_echo("gantt:user"),page_owner_entity()->name);
	}
			
	$area2 = elgg_view_title($title);
		
	// Get objects
	set_context('search');
	$offset = (int)get_input('offset', 0);
	$area2 .= elgg_list_entities(array('types' => 'object', 'subtypes' => 'gantt', 'container_guid' => page_owner(), 'limit' => 10, 'offset' => $offset, 'full_view' => FALSE));
	set_context('gantt');

	$body = elgg_view_layout('two_column_left_sidebar', "", $area2);
	
	page_draw($title, $body);
?>