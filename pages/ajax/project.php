<?php

$project_guid = get_input('projectid', NULL);
$project = gantt_get_project($project_guid);
header("Content-type: application/json");
if($project) {
	echo "[".elgg_view("gantt/project/json", array('params' =>gantt_generate_project_array($project)))."]";
}
exit;

?>