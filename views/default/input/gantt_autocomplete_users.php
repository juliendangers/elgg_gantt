
<?php
/**
 *	Autocomplete Facebook Style Plugin
 *	@package autocomplete facebook style
 *	@author Liran Tal <liran.tal@gmail.com>
 *	@license GNU General Public License (GPL) version 2
 *	@copyright (c) Liran Tal of Enginx 2009
 *	@link http://www.enginx.com
 **/
?>
<!-- autocomplete facebook style plugin by Liran Tal of Enginx http://www.enginx.com -->
<?php

// create a unique token to add to the input element's id
// in case there are a couple of instances of this input type
// so that the javascript code doesn't get all drunk (confused)
// while using uniqid() is probably better it is also slower
$token = rand(0,10000);

	$class = $vars['class'];
	if (!$class)
		$class = "input-text";
	
	//force the autocomplete class
	$class = "autocomplete";
	
	$value = $vars['value'];
	
	$option = $vars['options'];
	$project = gantt_get_project($option);
	
	$internalname = $vars['internalname'];
	
	$name = "autocomplete_facebook_style".$token;

?>


<script language="javascript" type="text/javascript" src="<?php echo $vars['url']; ?>mod/gantt/vendors/autocomplete_fcbkcomplete/jquery.fcbkcomplete.min.js"></script>
<script language="JavaScript">
	$(document).ready(function() 
	{        
	 
	  $("#<?php echo $name;?>").fcbkcomplete({
<?php
	if($project) { ?>
		json_url: "<?php echo $vars['url']; ?>pg/gantt/ajax/autocomplete_users/<?php echo $project->guid; ?>",
<?php	} else {	?>
		json_url: "<?php echo $vars['url']; ?>pg/gantt/ajax/autocomplete_users",<?php } ?>
		addontab: false,
		filter_case: true,
		filter_hide: true,
		firstselected: true,
		filter_selected: true,
		cache: false,
		newel: false,
		select_all_text: "select"
	  });		 
<?php if(isset($value) && !empty($value)) { 

	for($i=0, $len = count($value); $i < $len; $i++ ) {
		$user = get_entity($value[$i]);
		if($user) {
			$username = $user->username;
			$guid = $user->guid;
			echo '$("#'.$name.'").trigger("addItem",[{"title": "'.$username.'", "value": "'.$guid.'"}]);';
		}
	}
} ?>

	});
</script>

<div id="text"></div>
<div>
      <select id="<?php echo $name;?>" name="<?php echo $internalname;?>[]" multiple="multiple" >
      </select>
</div>
