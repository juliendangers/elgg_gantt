<?php

$project = $vars['entity'];
$name = $vars['internalname'];

$sprints = gantt_get_project_sprints($project);

$sprint_ids = array();
foreach($sprints as $sprint) {
	if($sprint->guid)
		$sprint_ids[$sprint->guid] = $sprint->title;
}

echo elgg_view("input/pulldown", array('internalname' => $name, 'options_values' => $sprint_ids));

?>