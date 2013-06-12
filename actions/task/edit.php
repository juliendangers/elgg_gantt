<?php

global $CONFIG;
gatekeeper();

$ajax = get_input('via', NULL);
$user_guid = get_input('user_guid');
$user = get_entity($user_guid);

$sprint = get_input('sprint', false);
$project_guid = get_input('parent_project', false);

$object_guid = (int) get_input('object_guid');
if ($object_guid == '') {
    $object_guid = NULL;
} else {
    $object = get_entity($object_guid);
}

if(!$project_guid || !$sprint) {
	//on traite l'erreur
}

$task = new ElggObject($object_guid);
$task->subtype = 'gantt:task';
$task->owner_guid = $user_guid;
$task->access_id = $access_id;
$task->parent_sprint = $sprint;
$task->parent_project = $project_guid;

$fields = getTaskFields();

foreach ($fields as $ref => $value) {
    if (get_input($ref)) {
        $task->$ref = get_input($ref);
    } else {
        $task->$ref = '';
    }
}

if ($object_guid == NULL) {
    $action = 'create';
} else {
    $action = 'update';
}

if ($object_guid == NULL or $task->canEdit()) {
    $result = $task->save();
} else {
    $result = false;
}

if ($result) {
	$message = elgg_echo('gantt:task:savesuccess');
	if($ajax != NULL) {
		$return = new stdClass();
		$return->status = "OK";
		$return->message = $message;
		header('Content-type: application/json');
		echo json_encode($return);
		exit;		
	} else {
	    system_message($message); 
		/*
		if ($task->isEnabled()) {
        	forward($task->getURL());
		}*/
		/* === return to project === */
    	forward(get_entity($project_guid)->getURL());
	}
} else {
	$message = elgg_echo('gantt:task:noprivilege');
	if($ajax != NULL) {
		$return = new stdClass();
		$return->status = "KO";
		$return->message = $message;
		header('Content-type: application/json');
		echo json_encode($return);
		exit;		
	} else {
	    register_error($message); 
	    forward($_SERVER['HTTP_REFERER']);
	}
}
?>