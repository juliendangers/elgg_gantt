<?php

/**
 * JQuery data picker
 * 
 * @package gantt
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Kevin Jardine <kevin@radagast.biz>
 * @copyright Radagast Solutions 2008
 * @link http://radagast.biz/
 * 
 */
if ($vars['dateformat']) {
	$date_format = $vars['dateformat'];
} else {
	$date_format = "dd MM yy";
}
?>

<input type="text" size="30" value="<?php echo $vars['value']; ?>" name="<?php echo $vars['internalname']; ?>Display" id="<?php echo $vars['internalname']; ?>Display"/>
<input type="hidden" value="<?php echo $vars['value']; ?>" name="<?php echo $vars['internalname']; ?>" id="<?php echo $vars['internalname']; ?>"/>
<script language="javascript">
jQuery(document).ready(function(){
	jQuery("#<?php echo $vars['internalname']; ?>Display").datepicker({ 
		dateFormat: "<?php echo $date_format; ?>", 
		showOn: "both", 
		buttonImage: "<?php echo $vars['url']; ?>mod/gantt/images/calendar.gif", 
		buttonImageOnly: true 
	});
	jQuery("#<?php echo $vars['internalname']; ?>Display").live('change', function() {
		jQuery("#<?php echo $vars['internalname']; ?>").val(jQuery("#<?php echo $vars['internalname']; ?>Display").datepicker( "option", "dateFormat", '@' ).val());
		jQuery("#<?php echo $vars['internalname']; ?>Display").datepicker( "option", "dateFormat", '<?php echo $date_format; ?>' );
	});
});
</script>