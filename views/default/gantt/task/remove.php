<?php

	$project = $vars['entity'];
	
	
	$via = $vars['via'];

	$body = "<div id=\"accordionSprints\">";
	
	if(gantt_get_project_tasks_count($project) > 0) {
		$tabs = gantt_generate_project_array($project);
		$i = 0;
		foreach ($tabs as $k => $sprint) {
			$body .= "<h3>".$k."</h3><div>";
			foreach($sprint as $task) {
				$body .= elgg_view("input/checkboxes", array('internalname' => "deltask", 'options' => array($task->title => $task->guid), 'split' => $i))."<br/>";
			$i++;			
			}
			$body .= "</div>";
		}
		$body .= "</div>";
		$body .= elgg_view('input/hidden',array('internalname' => 'ajax', 'value' => ($via == 'ajax') ? 1 : 0));
		$body .= elgg_view('input/submit',array('value' => elgg_echo('remove')));
		echo elgg_view('input/form', array("internalid" => "ganttTaskRemove", "internalname" => "ganttTaskRemove", "body" => $body, "action" => $vars['url']."action/gantt/task/delete"));
	} else {
		echo elgg_echo("gantt:project:notask");
	}
?>
<script>
 $(function() {
    var icons = {
      header: "ui-icon-circle-arrow-e",
      activeHeader: "ui-icon-circle-arrow-s"
    };
    $( "#accordionSprints" ).accordion({
      icons: icons,
	  collapsible: true
    });
	$('#accordionSprints').live('submit',function(){
		var ajax = false;
		if($($(this).parent().get(0)).hasClass('ui-tabs-panel')) {
			ajax = true;
		}
		if( ajax) { 
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