<?php

global $CONFIG;
gatekeeper();

$ajax = get_input('via', false);
$user_guid = get_input('user_guid');
$user = get_entity($user_guid);

$project_guid = get_input('parent_project');
$project = gantt_get_project($project_guid);

if($project) {
	$object_guid = (int) get_input('object_guid');
	if ($object_guid == '') {
		$object_guid = NULL;
		if( gantt_sprint_exist(get_input('title')) ) {
			$message = elgg_echo('gantt:sprint:invalidname');
			if($ajax) {
				gantt_handle_ajax_response($message, "OK");
			} else {
				register_error($message); 
				forward($_SERVER['HTTP_REFERER']);				
			}
		}
	} else {
		$object = gantt_get_sprint($object_guid);
	}
	
	$sprint = new ElggObject($object_guid);
	$sprint->subtype = 'gantt:sprint';
	$sprint->owner_guid = $user_guid;
	$sprint->access_id = $access_id;
	$sprint->parent_project = $project_guid;
	$fields = getSprintFields();
	
	foreach ($fields as $ref => $value) {
		if (get_input($ref)) {
			$sprint->$ref = get_input($ref);
		} else {
			$sprint->$ref = '';
		}
	}
	
	if ($object_guid == NULL) {
		$action = 'create';
	} else {
		$action = 'update';
	}
	if ($object_guid == NULL || $sprint->canEdit()) {
		$result = $sprint->save();
	} else {
		$result = false;
	}
	
	if ($result) {
		$message = elgg_echo('gantt:sprint:savesuccess');
		if($ajax) {
			gantt_handle_ajax_response($message, "OK");
		} else {
			system_message($message); 
			if ($sprint->isEnabled()) {
				forward($sprint->getURL());
			}
			forward('pg/gantt/all');
		}
	} else {
		$message = elgg_echo('gantt:sprint:noprivilege');
		if($ajax) {
			gantt_handle_ajax_response($message, "KO");
		} else {
			register_error($message); 
			forward($_SERVER['HTTP_REFERER']);
		}
	}
} else {
	register_error(elgg_echo("gantt:nosuch:project")); 
	forward($_SERVER['HTTP_REFERER']);
}
?>