<?php

   /***
	* colors are linked to css file gantt/css.php
	* you can easily add colors if you add the folowing elements to the css file :
	* .fn-gantt .ganttNewColor {
	*     background-color: #XXXXXX; //hexa color code for the background
	* }
	* .fn-gantt .ganttNewColor .fn-label {
	*     color: #XXXXXX !important; //hexa color code for the text (must be different from the background if you want to read it...)
	* }
	* NewColor is the name of the color you want to add, next you have to add it to the array $colors
	* then you simply have to run an upgrade
	**/
	
	$colors = array('Red','Blue','Green','Orange','Yellow','Pink');

	echo elgg_view('input/pulldown', array('options'=>$colors, 'internalname' => $vars['internalname'], 'value' => $vars['value']));
?>