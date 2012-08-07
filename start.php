<?php

	function gantt_init(){
		
		global $CONFIG;
		
		if (isloggedin()) {
    				
			add_menu(elgg_echo('gantts'), $CONFIG->wwwroot . "pg/gantt/" . $_SESSION['user']->username);
		} else {
			add_menu(elgg_echo('gantts'), $CONFIG->wwwroot . "pg/gantt/all");
		}
				
		elgg_extend_view("css", "gantt/css");
		
		register_page_handler('gantt','gantt_page_handler');
		
		//register subtypes
		add_subtype("object","gantt");
		add_subtype("object","gantt:task");
			
		// Register a URL handler for project
		register_entity_url_handler('gantt_url','object','gantt');
		
		// Add group menu option
		add_group_tool_option('gantt',elgg_echo('gantt:enableblog'),true);
		elgg_extend_view('groups/left_column', 'gantt/groupprofile_gantt');

	}
	
	function gantt_page_handler($page){
		
		switch($page[0]){
			
		}
	}
	
	function gantt_url($ganttproject) {
		
		global $CONFIG;
		$title = $ganttproject->title;
		$title = elgg_get_friendly_title($title);
		return $CONFIG->url . "pg/gantt/watch/" . $ganttproject->getOwnerEntity()->username . "/" . $ganttproject->getGUID() . "/" . $title;	
	}
	
	
	
	elgg_register_event_handler("init","system","gantt_init");
	
?>