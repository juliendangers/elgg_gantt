<?php

$task_guid = get_input('taskid', NULL);
$task = get_entity($task_guid);

if($task && $task->getSubtype() == 'gantt:task') {
	echo elgg_view("gantt/task/display", array('entity' => $task));
}
?>