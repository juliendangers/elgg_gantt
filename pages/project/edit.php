<?php

global $CONFIG;

gatekeeper();
if (is_callable('group_gatekeeper')) {
	group_gatekeeper();
}

$project_guid = get_input('projectid');
$project = gantt_get_project($project_guid);
$page_owner = page_owner_entity();
if ($page_owner === false || is_null($page_owner)) {
	$page_owner = $_SESSION['user'];
	set_page_owner($page_owner->getGUID());
}
$container_guid = page_owner();

$title = elgg_echo('gantt:editlisting');
$header = elgg_view('page_elements/title', array('title' => $title));
if ($project && $project->canEdit()) {
    $body = elgg_view('gantt/project/forms/edit', array('entity' => $project, 'user' => get_loggedin_user(), 'container_guid' => $container_guid));
} else if (!$project) {
    $body = elgg_view('gantt/project/forms/edit', array('user' => get_loggedin_user(),'container_guid' => $container_guid));
} else {
    $body = elgg_echo('gantt:noprivileges');
}
//$body = elgg_view('hypeFramework/wrappers/contentwrapper', array('body' => $body));
$body = elgg_view_layout('two_column_left_sidebar', "", $header . $body, "");

page_draw($title, $body);
?>

