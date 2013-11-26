<?php
	$usersId = $vars['value'];
	$users = array();
	foreach($usersId as $userId) {
		$users[] = get_entity($userId);
		echo elgg_view_entity(get_entity($userId));
	}
?>