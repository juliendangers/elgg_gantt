<?php

	$project = $vars['entity'];
	$user = get_loggedin_user();	
	
	if (get_context() == "search") {
		$owner = $project->getOwnerEntity();
		$container = $project->getContainerEntity();
		$context = get_context();
		
		$output .= '<div>';
		
		$output .= '<div><a href="'.$project->getURL().'">'.$project->title.'</a></div>';
		$output .= '<div>'.elgg_echo('gantt:project:view:date').': '.date("d-m-y",$project->start_date).'</div>';

		$output .= '</div>';
		
		//$output .= elgg_view("event_manager/event/actions", $vars);
		
		if($context != 'widget')
		{
			$output .= '<div class="event_manager_event_list_actions">';
			$output .= '<div class="event_manager_event_list_owner">';
			$output .= elgg_echo('event_manager:event:view:createdby').' <a href="'.$owner->getURL().'">'.$owner->surname.' '.$owner->name.'</a>';
			if(($container instanceof ElggGroup) && (page_owner() !== $container->getGUID())){
				$output .= ' ' . elgg_echo('dans').' <a href="' . $vars['url'] . 'gantt/list/'.$container->username.'" title="'.$container->name.'">'.$container->name.'</a>';
			} 
			$output .= '</div>';
			
			$output .= '</div>';
		}
		
		$icon .= "<div class='event_manager_event_list_icon'>";
			$icon .= "<div class='event_manager_event_list_icon_month'>" . strtoupper(strftime("%b",$project->start_date)) . "</div>";
			$icon .= "<div class='event_manager_event_list_icon_day'>" . date("d",$project->start_date) . "</div>";
		$icon .= "</div>";
		
		echo elgg_view_listing($icon, $output);
		
	} else if(get_context() == 'gantt') {
		
		if($project->canEdit()) {
			add_submenu_item(elgg_echo("gantt:edit"), $CONFIG->wwwroot . "pg/gantt/edit/" . $project->guid, 'project_actions');
		}
?>
<a href="#" onClick="expand()" class="expandGantt">Expand</a>
<div class="gantt"></div>
<div class="ganttTask fn-gantt"></div>
<script>
	var expanded = false,
		leftbar_width = "",
		expand = function() {
			if(expanded)
			{
				$("#two_column_left_sidebar_maincontent").css("width",leftbar_width);
				$('#two_column_left_sidebar').toggle("slow");
				$('.expandGantt').html("Expand");
				expanded = false;
			} else 
			{
				leftbar_width = $("#two_column_left_sidebar_maincontent").css("width");
				$('#two_column_left_sidebar').toggle("slow", function() {
					$("#two_column_left_sidebar_maincontent").css("width","100%");	
				});
				$('.expandGantt').html("Reduce");
				expanded = true;
			}
		};
	
	elggGantt.fn.displayTask = function(guid) {
			$(".ganttTask").load(elggGantt.settings.gantt_base_url+'ajax/task/'+guid.toString(), function() {
				$(".ganttTask").show();	
			});
		};
	
	elggGantt.fn.displayGantt = function() {
		$(".gantt").gantt({
			source: elggGantt.settings.gantt_base_url+"ajax/project/<?php echo $project->guid;?>",
			navigate: "scroll",
			scale: "weeks",
			maxScale: "months",
			minScale: "days",
			itemsPerPage: 10,
			onItemClick: function(data) {
				elggGantt.fn.displayTask(data);
			},
			onAddClick: function(dt, rowId) {
			}
		});	
	}
		
	$(function() {
		"use strict";
		
		$('#ganttSprintSubmit').live('submit',function(){
			var ajax = false;
			if($($(this).parent().get(0)).hasClass('ui-tabs-panel'))
				ajax = true;
			if( ajax && elggGantt.fn.check_mandatory_fields($(this))) { 
				$(this).ajaxSubmit({ dataType: 'json', success: elggGantt.fn.ganttProcessResponse }); 
			} else if (!ajax && elggGantt.fn.check_mandatory_fields($(this))) {
				return true;
			}
			return false;
		});
		
		$('#ganttTaskSubmit').live('submit',function(){
			var ajax = false;
			if($($(this).parent().get(0)).hasClass('ui-tabs-panel'))
				ajax = true;
			if( ajax && elggGantt.fn.check_mandatory_fields($(this))) { 
				$(this).ajaxSubmit({ dataType: 'json', success: elggGantt.fn.ganttProcessResponse }); 
			} else if (!ajax && elggGantt.fn.check_mandatory_fields($(this))) {
				return true;
			}
			return false;
		});
<?php if(gantt_get_project_tasks_count($project)>0) { ?>

		// display the diagramm
		elggGantt.fn.displayGantt();
		
<?php } ?>
	});
</script>

<div id="gantt_actions_menu">
<input type="hidden" name="pid" id="projectid" value="<?php echo $project->guid; ?>" />
<?php
	if($project->canEdit())
	{
		echo elgg_view("gantt/project/menu/actions", array("project", $project));
	}
?>
</div>
<?php } ?>