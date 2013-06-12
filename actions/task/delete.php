<?php

	$guids = get_input('deltask');
	$ajax = get_input('ajax', false);

	$forward = false;
	$stack =array();
	
	if(is_array($guids)) {	
		foreach($guids as $guid) {
			if ($task = get_entity($guid)) {
				$forward = $task->parent_project;
				if ($task->canEdit()) {
					
					if (!$task->delete()) {
						$stack = gantt_stack_message(elgg_echo("gantt:task:deletefailed"), 'error', $stack);
					} else {
						$stack = gantt_stack_message(elgg_echo("gantt:task:deleted"), 'info', $stack);
					}
				} else {
					$stack = gantt_stack_message(elgg_echo("gantt:task:noright"));	
				}
			} else {
				$stack = gantt_stack_message(elgg_echo("gantt:task:deletefailed"));
			}
		}
	}
	
	gantt_process_messages($stack, $forward, ($ajax) ? true : false);
	/*
	if($forward)
		forward("pg/gantt/view/$forward");
	else
		forward("pg/gantt/all/");*/
?>