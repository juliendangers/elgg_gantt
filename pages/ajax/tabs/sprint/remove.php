<?php 

	$project_guid = get_input('pid', 0);
	$project = gantt_get_project($project_guid);
	
	if($project) {
		echo elgg_view("gantt/sprint/remove", array('entity' => $project, 'via' => 'ajax'));
	} else {
		echo elgg_echo("gantt:tabs:noproject");	
	}
?>