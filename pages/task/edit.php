<?php

global $CONFIG;

gatekeeper();
if (is_callable('group_gatekeeper')) {
	group_gatekeeper();
}

$task_guid = get_input('taskid');
$task = get_entity($task_guid);

$page_owner = page_owner_entity();
if ($page_owner === false || is_null($page_owner)) {
	$page_owner = $_SESSION['user'];
	set_page_owner($page_owner->getGUID());
}
$container_guid = page_owner();

$title = elgg_echo('gantt:task:editlisting');
$header = elgg_view('page_elements/title', array('title' => $title));

if ($task && $task->canEdit()) {
	$project = get_entity($task->parent_project);
    $body = elgg_view('gantt/task/forms/edit', array('entity' => $task, 'project' => $project, 'user' => get_loggedin_user(), 'container_guid' => $container_guid));
} else if (!$task) {
	$project = get_entity($task->parent_project);
    $body = elgg_view('gantt/task/forms/edit', array('project' => $project, 'user' => get_loggedin_user(),'container_guid' => $task));
} else {
    $body = elgg_echo('gantt:noprivileges');
}
//$body = elgg_view('hypeFramework/wrappers/contentwrapper', array('body' => $body));
$body = elgg_view_layout('two_column_left_sidebar', "", $header . $body, "");

page_draw($title, $body);
?>

