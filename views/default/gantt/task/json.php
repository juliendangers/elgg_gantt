<?php

$task = $vars['entity'];
$title = $vars['title'];

?>
{ "name": "<?php echo $title;?>", "desc": "<?php echo $task->title;?>", "values": [{ "from": "/Date(<?php echo $task->start_date;?>)/", "to": "/Date(<?php echo $task->end_date;?>)/", "label": "<?php echo $task->label;?>", "customClass": "<?php if($task->colors) echo "gantt".ucfirst($task->colors);?>","dataObj": "<?php echo $task->guid;?>"}] }