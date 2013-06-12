<?php
	$project = $vars['entity'];
?>
<div id="gantttabs">
    <ul>
        <li><a href="<?php echo $vars['url'] ?>pg/gantt/ajax/tabs/addsprint/<?php echo $project->guid ?>">Add a Sprint</a></li>
        <li><a href="<?php echo $vars['url'] ?>pg/gantt/ajax/tabs/rmsprint/<?php echo $project->guid ?>">Remove a Sprint</a></li>
        <li><a href="<?php echo $vars['url'] ?>pg/gantt/ajax/tabs/addtask/<?php echo $project->guid ?>">Add a Task</a></li>
        <li><a href="<?php echo $vars['url'] ?>pg/gantt/ajax/tabs/rmtask/<?php echo $project->guid ?>">Remove a Task</a></li>
    </ul>
   
</div>
<div id="modalMessageWrapper">
	<div class="error message"></div>
    <div class="success message"></div>
</div>