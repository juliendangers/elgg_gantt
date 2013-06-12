<?php

global $CONFIG;

$project_guid = get_input('projectid');
$project = gantt_get_project($project_guid);

set_page_owner($project->container_guid);

/*

$hypepluginlist = string_to_tag_array(get_plugin_setting('hypepluginlist', 'hypeFramework'));
foreach ($hypepluginlist as $plugin) {
    $TabsArray = trigger_plugin_hook('hypeCompanies:projecttabs:' . $plugin, 'all', array('current' => $TabsArray), $TabsArray);
}
$TabsArray = trigger_plugin_hook('hypeCompanies:projecttabs', 'all', array('current' => $TabsArray), $TabsArray);

$body = elgg_view('hypeFramework/tabs', array('tabs' => $TabsArray));
$body = elgg_view('hypeFramework/wrappers/contentwrapper', array('body' => $body));
*/
$area1 = elgg_view_title($project->title);
$area2 = elgg_view_entity($project);//$body;
/*
$area3 = elgg_view('hypeCompanies/profile', array('entity' => $project));
$area3 = elgg_view('hypeFramework/wrappers/contentwrapper', array('body' => $area3));
$area4 = get_submenu() . '<div class="clearfloat"></div>';

*/
$title = elgg_echo('gantt:project');
$body = elgg_view_layout('two_column_left_sidebar', '', $area1 . $area2);
//$body = elgg_view_layout('one_column', $body);

page_draw($title, $body);
?>
