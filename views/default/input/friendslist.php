<?php
	
	$friends = get_loggedin_user()->getFriends("", 5000);
	$user_guid = array();
	if ($friends) {
		foreach ($friends as $friend) {
			$user_guid[] = $friend->getGUID();
		}
	}
	
?>