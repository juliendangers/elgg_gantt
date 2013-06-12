<?php

require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . "/engine/start.php");

$pid = get_input("projectid");
$project = gantt_get_project($pid);

if($project)
	echo elgg_view("gantt/project/tabs", array('entity' => $project));
?>