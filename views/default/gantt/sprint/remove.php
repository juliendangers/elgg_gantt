<?php

	$project = $vars['entity'];
	$via = $vars['via'];
	
	if(gantt_get_project_sprints_count($project) > 0) {
		
		$body = "<label>".elgg_echo('gantt:label:sprint:remove')."</label>";
		$body .= elgg_view("gantt/sprint/list", array('entity' => $project, 'internalname' => 'sprint'));
		if($via == "ajax") {
			$body .= elgg_view('input/hidden', array('internalname' => "ajax", 'value' => 1));
		}
		$body .= elgg_view("input/submit", array('value' => elgg_echo('delete')));
		echo elgg_view("input/form", array('body'=>$body,'internalname'=>"removeSprint",'internalid'=>"removeSprint",'action' => $vars['url']."action/gantt/sprint/delete"));
	} else {
		echo elgg_echo("gantt:project:nosprint");
	}
?>
<script>
 $(function() {
	 $('#removeSprint').live('submit',function(){
		var ajax = false;
		if($($(this).parent().get(0)).hasClass('ui-tabs-panel')) {
			ajax = true;
		}
		if( ajax) { 
			var submitButton = $(this, "input[type='submit']");
			submitButton.attr("disabled", "true");
			$(this).ajaxSubmit({ dataType: 'json', success: elggGantt.fn.ganttProcessResponse }); 
			$(this).each(function() { 
				this.reset(); 
			});
			return false;
		}
		return true;
	});
  });
  
 </script>