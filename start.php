<?php

include_once(dirname(__FILE__) . '/models/model.php');

	function gantt_init(){
		global $CONFIG;

		elgg_extend_view('css','gantt/css');
		
		// Register a page handler, so we can have nice URLs
		register_page_handler('gantt','gantt_page_handler');
		
		// Register a URL handler for thewire posts
		register_entity_url_handler('gantt_url','object','gantt');
		
		// Register entity type
		register_entity_type('object','gantt');
		
		add_subtype('object','gantt:sprint');
		
		add_subtype('object','gantt:task');
		
		// Register some actions	
		register_action("gantt/save",false, $CONFIG->pluginspath . "gantt/actions/project/edit.php");
		register_action("gantt/delete",false, $CONFIG->pluginspath . "gantt/actions/project/delete.php");
		register_action("gantt/task/save",false, $CONFIG->pluginspath . "gantt/actions/task/edit.php");
		register_action("gantt/task/delete",false, $CONFIG->pluginspath . "gantt/actions/task/delete.php");
		register_action("gantt/sprint/save",false, $CONFIG->pluginspath . "gantt/actions/sprint/edit.php");
		register_action("gantt/sprint/delete",false, $CONFIG->pluginspath . "gantt/actions/sprint/delete.php");
		
		
		register_plugin_hook('permissions_check', 'object', 'gantt_override_permissions_hook');
		register_plugin_hook('permissions_check:metadata','object','gantt_override_permissions_hook');
	
		// Your gannt widget
		//add_widget_type('gantt',elgg_echo("gantt:read"),elgg_echo("gantt:yourdesc"));
		
		elgg_extend_view("metatags", "gantt/metatags");
    	elgg_extend_view('page_elements/footer', 'gantt/popup', 275);
		
		// add the group gantt tool option     
        add_group_tool_option('gantt',elgg_echo('groups:enablegantt'),true);
			
	}
	
	function gantt_page_handler($page){
		global $CONFIG;

		if(isset($page[0]))
		{
			switch($page[0])
			{
				case 'ajax':
					if(isset($page[1]))
					{
						switch($page[1])
						{
							case 'autocomplete_users':
								set_input('projectid', $page[2]);
								include($CONFIG->pluginspath . "gantt/pages/ajax/autocomplete_users.php");
							break;
							case 'task':
								set_input('taskid', $page[2]);
								include($CONFIG->pluginspath . "gantt/pages/ajax/gettask.php");
							break;
							case 'tabs':
								if(isset($page[2]))
								{
									set_input('pid', $page[3]);
									switch($page[2])
									{
										case 'addsprint':
											include($CONFIG->pluginspath . "gantt/pages/ajax/tabs/sprint/edit.php");
										break;
										case 'rmsprint':
											include($CONFIG->pluginspath . "gantt/pages/ajax/tabs/sprint/remove.php");
										break;
										case 'addtask':
											include($CONFIG->pluginspath . "gantt/pages/ajax/tabs/task/edit.php");
										break;
										case 'rmtask':
											include($CONFIG->pluginspath . "gantt/pages/ajax/tabs/task/remove.php");
										break;
									}
								}
							break;
							case 'project':
								set_input('projectid', $page[2]);
								include($CONFIG->pluginspath . "gantt/pages/ajax/project.php");
							break;
						}
					}
                break;
				case 'new':
	                include($CONFIG->pluginspath . 'gantt/pages/project/edit.php');
				break;
				case 'edit':
					if(isset($page[1]))
		            {	
						switch($page[1])
						{
							case 'task':
								set_input('taskid', $page[2]);
								include($CONFIG->pluginspath . 'gantt/pages/task/edit.php');
							break;
							case 'sprint':
								set_input('sprintid', $page[2]);
								include($CONFIG->pluginspath . 'gantt/pages/sprint/edit.php');
							break;
							default:
								set_input('projectid', $page[1]);
								include($CONFIG->pluginspath . 'gantt/pages/project/edit.php');
						}
					}
				break;
				case 'view':
					if(isset($page[1]))
		            {
						set_input('projectid', $page[1]);
						include($CONFIG->pluginspath . 'gantt/pages/project/view.php');
					}
				break;
				case 'all':
					include($CONFIG->pluginspath . "gantt/pages/all.php");
				break;
				default:
					if (isset($page[1])) {
						set_input('username',$page[1]);
					}
					include($CONFIG->pluginspath . "gantt/pages/index.php");
					
			}
		}
		return true;
	}
	
	function gantt_override_permissions_hook($hook, $entity_type, $returnvalue, $params) {
		
		if ($params['entity']->getSubtype() == 'gantt:task') {
			
			if ( isadminloggedin()) {
				return TRUE;
			}
			
			return gantt_can_edit_task($params['entity'], $params['user']) ;
		}
		
	}
		
	function gantt_url($entity) {
		global $CONFIG;
		$title = elgg_get_friendly_title($entity->title);
		return $CONFIG->url . "pg/gantt/view/{$entity->guid}/$title";
	}
	
	/**
	 * Sets up submenus for the gantt system.  Triggered on pagesetup.
	 *
	 */
	function gantt_submenus() {
		
		global $CONFIG;
		
		$page_owner = page_owner_entity();
		
		if(get_context() == 'gantt') {
			if ((page_owner() == $_SESSION['guid'] || !page_owner()) && isloggedin()) {
				add_submenu_item(sprintf(elgg_echo("gantt:yours"),$page_owner->name), $CONFIG->wwwroot . "pg/gantt/" . $page_owner->username);
			} else if (page_owner()) {
				add_submenu_item(sprintf(elgg_echo("gantt:user"),$page_owner->name), $CONFIG->wwwroot . "pg/gantt/" . $page_owner->username);
			}
			add_submenu_item(elgg_echo('gantt:all'), $CONFIG->wwwroot . "pg/gantt/all/");
			if (can_write_to_container($_SESSION['guid'], page_owner()) && isloggedin())
				add_submenu_item(elgg_echo('gantt:new'), $CONFIG->wwwroot . "pg/gantt/new/".$page_owner->username);
		}
		
		// Group submenu option	
		if ($page_owner instanceof ElggGroup && get_context() == 'groups') {
			if($page_owner->gantt_enable != "no"){
				add_submenu_item(sprintf(elgg_echo("gantt:group"),$page_owner->name), $CONFIG->wwwroot . "pg/gantt/owned/" . $page_owner->username);
			}
		}
					
    }
	
	register_elgg_event_handler('init', 'system', 'gantt_init');
	register_elgg_event_handler('pagesetup','system','gantt_submenus');

?>