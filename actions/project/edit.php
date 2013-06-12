<?php

global $CONFIG;
gatekeeper();

$user_guid = get_input('user_guid');
$user = get_entity($user_guid);

$object_guid = (int) get_input('object_guid');
if ($object_guid == '') {
    $object_guid = NULL;
} else {
    $object = gantt_get_project($object_guid);
}
$container_guid = (int) get_input('container_guid', 0);
if ($container_guid == 0) {
	$container_guid = get_loggedin_userid();
}

$access_id = (int) get_input('access_id');

$project = new ElggObject($object_guid);
$project->subtype = 'gantt';
$project->owner_guid = $user_guid;
$project->access_id = $access_id;
$project->container_guid = $container_guid;

$fields = getProjectFields();

foreach ($fields as $ref => $value) {
    if (get_input($ref)) {
        $project->$ref = get_input($ref);
    } else {
        $project->$ref = '';
    }
}

if ($object_guid == NULL) {
    $action = 'create';
} else {
    $action = 'update';
}
if ($object_guid == NULL or $project->canEdit()) {
    $result = $project->save();
} else {
    $result = false;
}

$topbar = get_resized_image_from_uploaded_file('projecticon', 16, 16, true, true);
$tiny = get_resized_image_from_uploaded_file('projecticon', 25, 25, true, true);
$small = get_resized_image_from_uploaded_file('projecticon', 40, 40, true, true);
$medium = get_resized_image_from_uploaded_file('projecticon', 100, 100, true, true);
$large = get_resized_image_from_uploaded_file('projecticon', 200, 200);
$master = get_resized_image_from_uploaded_file('projecticon', 550, 550);

if ($small !== false
        && $medium !== false
        && $large !== false
        && $tiny !== false) {


    $filehandler = new ElggFile();
    $filehandler->owner_guid = $project->owner_guid;
    $filehandler->setFilename("project/" . $project->guid . "large.jpg");
    $filehandler->open("write");
    $filehandler->write($large);
    $filehandler->close();
    $filehandler->setFilename("project/" . $project->guid . "medium.jpg");
    $filehandler->open("write");
    $filehandler->write($medium);
    $filehandler->close();
    $filehandler->setFilename("project/" . $project->guid . "small.jpg");
    $filehandler->open("write");
    $filehandler->write($small);
    $filehandler->close();
    $filehandler->setFilename("project/" . $project->guid . "tiny.jpg");
    $filehandler->open("write");
    $filehandler->write($tiny);
    $filehandler->close();
    $filehandler->setFilename("project/" . $project->guid . "topbar.jpg");
    $filehandler->open("write");
    $filehandler->write($topbar);
    $filehandler->close();
    $filehandler->setFilename("project/" . $project->guid . "master.jpg");
    $filehandler->open("write");
    $filehandler->write($master);
    $filehandler->close();
}

if ($result) {
    system_message(elgg_echo('gantt:savesuccess'));
    add_to_river('river/object/project/' . $action, $action, $user->guid, $project->guid);    
	if ($project->isEnabled())
        forward('pg/gantt/view/' . $project->guid);
    forward('pg/gantt/all');
} else {
    register_error(elgg_echo('gantt:noprivileges'));
    forward($_SERVER['HTTP_REFERER']);
}
?>