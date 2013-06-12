<?php

	$task = $vars['entity'];
	//$.datepicker.formatDate('DD, MM d, yy', new Date(2007, 7 - 1, 14), {dayNamesShort: $.datepicker.regional['fr'].dayNamesShort, dayNames: $.datepicker.regional['fr'].dayNames, monthNamesShort: $.datepicker.regional['fr'].monthNamesShort, monthNAmes: $.datepicker.regional['fr'].monthNames});
	
$fields = getTaskFields($task->parent_project);

?>
<div class="task" id="task<?php echo $task->guid; ?>">
<?php
	if($task->canEdit()) { ?>
<div class="taskactions">
<div><a href="<?php echo $vars['url']."pg/gantt/edit/task/".$task->guid;?>"><?php echo elgg_echo('gantt:task:edit');?></a></div>
</div>
<?php	}
	foreach ($fields as $ref => $value) {
        echo '<div><label class="gantt';
		echo ($task->colors != "") ? ucfirst($task->colors) : 'Blue';
		echo '">' . elgg_echo($value['display_name']) . '</label>' . elgg_view('output/' . $value['type'], array('value' => $task->$ref,
            'internalname' => $ref, 'options' => $value['options'], 'class' => $value['class'])) . '</div>';
    }
?>
</div>