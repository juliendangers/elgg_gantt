<?php

$project = $vars['project'];

$fields = getTaskFields($project->guid);
if (!$vars['entity']) {
    foreach ($fields as $ref => $value) {
        $vars['entity']->$ref = '';
    }
}

$via = $vars['via'];
$js = "";
if($via == 'ajax')
	$js = <<<EOF
if( check_mandatory_fields($(this))){ $(this).ajaxSubmit(); resetForm($(this)); return false; } else return false;
EOF;
else
	$js = <<<EOF
return check_mandatory_fields($(this));	
EOF;
if(gantt_get_project_sprints_count($project) > 0) {
?>
<form action="<?php echo $vars['url']; ?>action/gantt/task/save" method="post" id="ganttTaskSubmit">
    <?php
    echo elgg_view('input/securitytoken');
    foreach ($fields as $ref => $value) {
        echo '<div><label>' . elgg_echo($value['display_name']) . '</label>' . elgg_view('input/' . $value['type'], array('value' => $vars['entity']->$ref,
            'internalname' => $ref, 'options' => $value['options'], 'options_values' => $value['options_values'], 'class' => $value['class'])) . '</div>';
    }
	echo '<div><label>' . elgg_echo('gantt:task:sprint') . '</label>';
	echo elgg_view('gantt/sprint/list', array('entity'=>$project, 'class' => "mandatory", 'internalname' => 'sprint'));
	echo "</div>";
	if ($via == 'ajax')
		echo elgg_view('input/hidden', array('value' => $via, 'internalname' => 'via'));
    echo elgg_view('input/hidden', array('value' => $project->guid, 'internalname' => 'parent_project'));
    echo elgg_view('input/hidden', array('value' => $vars['entity']->guid, 'internalname' => 'object_guid'));
    echo elgg_view('input/hidden', array('value' => $vars['user']->guid, 'internalname' => 'user_guid'));
    echo elgg_view('input/submit', array('value' => 'save', 'internalname' => 'save'));
    ?>
</form>
<?php } else {
	echo elgg_echo("gantt:task:needsprint");
} ?>