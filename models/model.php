<?php


	function getProjectFields() {
	
		$fields = array(
			'title' => array('display_name' => elgg_echo('gantt:project:title'), 'type' => 'text', 'section' => 'main', 'class' => 'mandatory'),
			'description' => array('display_name' => elgg_echo('gantt:project:description'), 'type' => 'longtext', 'section' => 'main'),
			'start_date' => array('display_name' => elgg_echo('gantt:project:start_date'), 'type' => 'gantt_datepicker_popup', 'section' => 'main', 'class' => 'mandatory'),
			'project_manager' => array('display_name' => elgg_echo('gantt:project:manager'), 'type' => 'text', 'section' => 'main', 'class' => 'mandatory'),
			'project_contributors' => array('display_name' => elgg_echo('gantt:project:contributors'), 'type' => 'gantt_autocomplete_users', 'section' => 'main', 'class' => 'mandatory'),
			'tags' => array('display_name' => elgg_echo('gantt:project:tags'), 'type' => 'tags', 'section' => 'main'),
	
		);
	   
		$fields = trigger_plugin_hook('gantt:project:customfields', 'all', array('current' => $fields), $fields);
	
		return $fields;
	}
	
	function getSprintFields() {
	
		$fields = array(
			'title' => array('display_name' => elgg_echo('gantt:sprint:title'), 'type' => 'text', 'section' => 'main', 'class' => 'mandatory'),
			'description' => array('display_name' => elgg_echo('gantt:sprint:description'), 'type' => 'plaintext', 'section' => 'main')	
		);
	   
		$fields = trigger_plugin_hook('gantt:sprint:customfields', 'all', array('current' => $fields), $fields);
	
		return $fields;
	}
	
	function getTaskFields($pguid = NULL) {
	
		 $fields = array(
			'title' => array('display_name' => elgg_echo('gantt:task:title'), 'type' => 'text', 'section' => 'main', 'class' => 'mandatory'),
			'label' => array('display_name' => elgg_echo('gantt:task:label'), 'type' => 'text', 'section' => 'main', 'class' => 'mandatory'),
			'description' => array('display_name' => elgg_echo('gantt:task:description'), 'type' => 'plaintext', 'section' => 'main'),
			'start_date' => array('display_name' => elgg_echo('gantt:task:start_date'), 'type' => 'gantt_datepicker_popup', 'section' => 'main', 'class' => 'mandatory'),
			'end_date' => array('display_name' => elgg_echo('gantt:task:end_date'), 'type' => 'gantt_datepicker_popup', 'section' => 'main', 'class' => 'mandatory'),
			'in_charge' => array('display_name' => elgg_echo('gantt:task:contributors'), 'type' => 'gantt_autocomplete_users', 'section' => 'main', 'class' => '', 'options' => $pguid),
			'completness' => array('display_name' => elgg_echo('gantt:task:completeness'), 'type' => 'progressbar', 'section' => 'main'),
			'colors' => array('display_name' => elgg_echo('gantt:task:color'), 'type' => 'pulldown', 'section' => 'main', 'options_values' => gantt_get_colors()),
			'tags' => array('display_name' => elgg_echo('gantt:task:tags'), 'type' => 'tags', 'section' => 'main')
	
		);
	   
		$fields = trigger_plugin_hook('gantt:task:customfields', 'all', array('current' => $fields), $fields);
	
		return $fields;
	}
	
	function gantt_get_colors() {
		$colors = array("Red" => elgg_echo('gantt:red'),"Blue" => elgg_echo('gantt:blue'), "Green" => elgg_echo('gantt:green'),"Orange" => elgg_echo('gantt:orange'), "Yellow" => elgg_echo('gantt:yellow'), "Pink" => elgg_echo('gantt:pink'));
		
		$colors = trigger_plugin_hook('gantt:task:colors', 'all', array('current' => $colors), $colors);
	
		return $colors;

	}
	
	function gantt_get_project($id)
	{
		$project = get_entity($id);

		if($project instanceof ElggObject && $project->getSubtype() == "gantt")
		{
			return $project;
		}
		return false;
	}
	
	function gantt_get_project_sprints($project)
	{
		if($project instanceof ElggObject && $project->getSubtype() == "gantt")
		{
			$options = array(
				'type' => 'object',
				'subtype' => 'gantt:sprint',
				'limit' => 0,
				'metadata_names' =>	'parent_project',
				'metadata_values' =>	$project->guid,
				'order_by' => 'guid ASC'
			);
			
			$sprints = elgg_get_entities_from_metadata($options);
		
			return $sprints;
		}
		
		return array();
	}

	function gantt_get_project_sprints_count($project)
	{
		if($project instanceof ElggObject && $project->getSubtype() == "gantt")
		{
			$options = array(
				'type' => 'object',
				'subtype' => 'gantt:sprint',
				'limit' => 0,
				'count' => TRUE,
				'metadata_names' =>	'parent_project',
				'metadata_values' =>	$project->guid
			);
			
			$sprints = elgg_get_entities_from_metadata($options);
		
			return $sprints;
		}
		
		return 0;
	}
	
	function gantt_get_project_tasks_count($project)
	{
		if($project instanceof ElggObject && $project->getSubtype() == "gantt")
		{
			$options = array(
				'type' => 'object',
				'subtype' => 'gantt:task',
				'limit' => 0,
				'count' => TRUE,
				'metadata_names' =>	'parent_project',
				'metadata_values' =>	$project->guid
			);
			
			$tasks = elgg_get_entities_from_metadata($options);
		
			return $tasks;
		}
		
		return 0;
	}
	
	function gantt_get_project_sprints_from_id($id)
	{
		if(is_numeric($id))
		{
			$project = get_entity($id);
			return gantt_get_project_sprints($project);
		}
		return NULL;
	}
	
	function gantt_get_project_tasks($project)
	{
		if($project instanceof ElggObject && $project->getSubtype() == "gantt")
		{
			$options = array(
				'type' => 'object',
				'subtype' => 'gantt:task',
				'limit' => 0,
				'metadata_names' =>	'parent_project',
				'metadata_values' =>	$project->guid
			);
			
			$sprints = elgg_get_entities_from_metadata($options);
		
			return $sprints;
		}
		
		return NULL;
	}
	
	function gantt_get_project_tasks_from_id($id)
	{
		if(is_numeric($id))
		{
			$project = get_entity($id);
			return gantt_get_project_tasks($project);
		}
		return NULL;
	}
	
	//FIXME why get project_guid as parameter???
	function gantt_get_project_task($project_guid, $task_guid)
	{
		if(is_numeric($project_guid))
		{
			$project = gantt_get_project($project_guid);
			if($project)
			{
				$options = array(
					'type' => 'object',
					'subtype' => 'gantt:task',
					'limit' => 0,
					'metadata_names' =>	'parent_project',
					'metadata_values' =>	$project->guid
				);
				
				$sprints = elgg_get_entities_from_metadata($options);
				
				return $sprints;
			}
		}
		return NULL;
	}
	
	function gantt_get_project_tasks_from_sprint($sprint)
	{
		if($sprint instanceof ElggObject && $sprint->getSubtype() == "gantt:sprint")
		{
			$options = array(
				'type' => 'object',
				'subtype' => 'gantt:task',
				'limit' => 0,
				'metadata_names' =>	'parent_sprint',
				'metadata_values' =>	$sprint->guid
			);
			
			$tasks = elgg_get_entities_from_metadata($options);
		
			return $tasks;
		}
		
		return NULL;
	}
	
	function gantt_get_project_tasks_from_sprint_id($id)
	{
		if(is_numeric($id))
		{
			$sprint = get_entity($id);
			return gantt_get_project_tasks_from_sprint($sprint);
		}
		return NULL;
	}
	
	function gantt_check_task_validity($task)
	{
		if($task instanceof ElggObject && $task->getSubtype() == "gantt:task")
		{
			if(gantt_util_check_date($task->start_date, $task->end_date))
				return true;
			
			return false;
		}
		return false;
	}
	
	function gantt_util_check_date($date1, $date2)
	{
		$start_date = mktime(0,0,0,$date1[0],$date1[1],$date1[2]);
		$end_date = mktime(0,0,0,$date2[0],$date2[1],$date2[2]);
		if($start_date <= $end_date)
			return true;
		
		return false;
	}
	

	function gantt_canCreateProject($user)
	{
		return true;
	}
	
	function gantt_get_task_contributors($task_guid)
	{
		$task = get_entity($task_guid);
		if($task && $task instanceof ElggObject && $task->getSubtype() == 'gantt:task') {
			
		}
		return false;
	}
	
	function gantt_can_edit_task($task, $user_guid)
	{
		if($task && $task instanceof ElggObject && $task->getSubtype() == 'gantt:task') {
			$incharge = $task->in_charge;
			if(!is_array($incharge))
				$incharge = array($incharge);
				
			if(in_array($user_guid,$incharge))
				return true;
		}
		return false;
	}	
	
	function gantt_join_project($project_guid, $users_guid)
	{
		$project = gantt_get_project($project_guid);
		if($project) {
			foreach($users_guid as $user_guid) {
	
				$user = get_entity($user_guid);
	
				$result = add_entity_relationship($user_guid, 'contributor', $project_guid);
				$result = add_entity_relationship($user_guid, 'notifymail', $project_guid);
				
				$message = elgg_echo('');
				$descr = elgg_echo('');
				$string = trigger_plugin_hook('notify:project:message', 'project', array('project' => get_entity($project_guid), 'user' => get_entity($user_guid)), $message);
				if (empty($string) && $string !== false) {
					$string = $message;
				}
				if ($string !== false) {
					notify_user($user->guid,$project->container_guid,$descr,$string);
				}
			}
			return true;
		}
		return false;
	}

	function gantt_get_project_manager($project_guid)
	{
		if($project = gantt_get_project($project_guid)) {
			return $project->project_manager;
		}
	}

	function gantt_alert_task_done($project_guid, $task_guid)
	{
		$project = gantt_get_project($project_guid);
		$task =get_entity($task_guid);
		if($project) {
			$title = elgg_echo('gantt:title:task:done');
			$message = sprintf(elgg_echo('gantt:alert:task:done'),$project,$task);
			notify_user($project->project_manager, $project->container_guid,$title,$message);
		}
		return false;
	}
	
	function gantt_alert_task_blocked($project_guid, $task_guid, $reason)
	{
		$project = gantt_get_project($project_guid);
		$task =get_entity($task_guid);
		if($project) {
			$title = elgg_echo('gantt:title:task:blocked');
			$message = sprintf(elgg_echo('gantt:alert:task:blocked'),$project,$task, $reason);
			notify_user($project->project_manager, $project->container_guid,$title,$message);
		}
		return false;
	}

	function gantt_generate_project_array($project)
	{
		if($project) {
			$sprints = gantt_get_project_sprints($project);
			$return = array();
			$tasks = array();
			foreach($sprints as $sprint) {
				$tasks = gantt_get_project_tasks_from_sprint($sprint);
				if(!empty($tasks)) {
					usort($tasks, 'gantt_date_cmp');
					$return[$sprint->title] = $tasks;
				}
			}
			return $return;
		}
		return false;
	}
	
	function gantt_delete_sprint_tasks($sprint)
	{
		$tasks = gantt_get_project_tasks_from_sprint($sprint);
		$return = true;
		foreach ( $tasks as $task) {
			if(!$task->delete()) {
				// we return false if one or more failed
				$return = false;
			}
		}
		return $return;
	}
	
	function gantt_date_cmp($a, $b)
	{
		if ($a->start_date == $b->start_date) {
			if($a->end_date == $b->end_date) {
				return 0;
			}
			return ($a->end_date < $b->end_date) ? -1 : 1;

		}
		return ($a->start_date < $b->start_date) ? -1 : 1;
	}
	
	function gantt_sprint_exist($sprint)
	{
		global $CONFIG;
		$options = array(
			'types' => "object",
			'subtypes' => "gantt:sprint",
			'count' => true,
			'joins' => array("JOIN " . $CONFIG->dbprefix . "objects_entity oe ON e.guid = oe.guid"),
			'wheres' => array("oe.title like '".$sprint . "'")
		);
		
		$sprint_count = elgg_get_entities($options);
		
		if($sprint_count == 0) {
			return false;
		}
		
		return true;
	}
	
	function gantt_handle_ajax_response($message, $status)
	{
		$return = new stdClass();
		$return->status = $status;
		$return->message = $message;
		header('Content-type: application/json');
		echo json_encode($return);
		exit;
	}
	
	function gantt_stack_message($message, $type = "info", $stack = array()) {
		if($type == 'info' || $type == "error") {
			$stack[$type][] = $message;
		}
		return $stack;
	}
	
	//TODO improve message /w ajax
	function gantt_process_messages($stack, $guid, $ajax = false) {
		$stack = array_unique ($stack);
		// FIX
		// will only consider first error or first success /w ajax
		if($ajax) {
			if(count($stack["error"])>0) {
				$return = new stdClass();
				$return->status = "KO";
				$return->message = $stack["error"][0];
				header('Content-type: application/json');
				echo json_encode($return);
				exit;
			}
			if (count($stack["info"])>0) {
				$return = new stdClass();
				$return->status = "OK";
				$return->message = $stack["info"][0];
				header('Content-type: application/json');
				echo json_encode($return);
				exit;	
			}
		} else {
			if(count($stack["error"])>0) {
				foreach($stack["error"] as $error) {
					register_error($error);
				}
			}
			if (count($stack["info"])>0) {
				foreach($stack["info"] as $info) {
					system_message($info);
				}
			}	
			forward(get_entity($guid)->getURL());
		}
	}
?>