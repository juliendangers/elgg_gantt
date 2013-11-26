<?php

$project = $vars['project'];

$fields = getSprintFields();
if (!$vars['entity']) {
    foreach ($fields as $ref => $value) {
        $vars['entity']->$ref = '';
    }
}
$via = $vars['via'];

?>
<form action="<?php echo $vars['url']; ?>action/gantt/sprint/save" method="post" id="ganttSprintSubmit">
    <?php
    echo elgg_view('input/securitytoken');
    foreach ($fields as $ref => $value) {
        echo '<div><label>' . elgg_echo($value['display_name']) . '</label>' . elgg_view('input/' . $value['type'], array('value' => $vars['entity']->$ref,
            'internalname' => $ref, 'options' => $value['options'], 'class' => $value['class'])) . '</div>';
    }
	if ($via == 'ajax')
		echo elgg_view('input/hidden', array('value' => $via, 'internalname' => 'via'));
    echo elgg_view('input/hidden', array('value' => $vars['entity']->guid, 'internalname' => 'object_guid'));
    echo elgg_view('input/hidden', array('value' => $project->guid, 'internalname' => 'parent_project'));
    echo elgg_view('input/hidden', array('value' => $vars['user']->guid, 'internalname' => 'user_guid'));
    echo elgg_view('input/submit', array('value' => 'save', 'internalname' => 'save'));
    ?>
</form>