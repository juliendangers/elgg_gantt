<?php

$params = $vars['params'];

	$numItems; $i;
	$numItems = count($params);
	$i = 0;
	$last_sprint = end(array_keys($params));
	foreach($params as $k=>$sprint) {
		$last_task = end(array_keys($sprint));
		foreach($sprint as $j=>$task) {
			echo ($j == 0) ? elgg_view("gantt/task/json", array('entity' => $task, 'title' => $k))
					: elgg_view("gantt/task/json", array('entity' => $task, 'title' => ""));
			echo ($last_task === $j) ?  '' : ',';			
		}		
		echo ($last_sprint === $k) ?  '' : ',';
	}
?>