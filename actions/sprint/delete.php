<?php

	$guid = (int) get_input('sprint');
	$ajax = get_input('ajax', false);
	
	$forward = false;
	$stack = array();
	
	if ($sprint = get_entity($guid)) {
		$forward = $sprint->parent_project;
		if ($sprint->canEdit()) {
			
			if (!gantt_delete_sprint_tasks($sprint)) {
				$stack = gantt_stack_message(elgg_echo("gantt:sprint:cancel:taskdeletefailed"),'error',$stack);
				//we cancel the sprint deletion if a task failed
			} else {			
				if( !$sprint->delete()) {
					$stack = gantt_stack_message(elgg_echo("gantt:sprint:deletefailed"),'error',$stack);
				} else {
					$stack = gantt_stack_message(elgg_echo("gantt:sprint:deleted"),'info', $stack);
				}
			}
		} else {
			
			$stack = gantt_stack_message(elgg_echo("gantt:sprint:deletefailed"),'error', $stack);
			
		}

	} else {
		
		$stack = gantt_stack_message(elgg_echo("gantt:sprint:deletefailed"),'error',$stack);
		
	}
	gantt_process_messages($stack, $forward, ($ajax) ? true : false);
?>