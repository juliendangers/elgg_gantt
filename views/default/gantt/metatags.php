<!-- Gantt -->
<!--<script type="text/javascript" src="<?php echo $vars['url']; ?>mod/gantt/vendors/jquery-ui-1.9.2.custom.min.js"></script>-->
<?php 

	global $gantt;
	global $CONFIG;
    if (empty($datepicker)) 
    {
        echo <<<END
<script type="text/javascript" src="{$vars['url']}mod/gantt/vendors/jquery.datepick.package-4.0.5/jquery.datepick-fr.js"></script>
END;
		if(!empty($locale_js))
		{
			echo "<script type='text/javascript' src='" . $vars['url'] . "mod/gantt/vendors/jquery.datepick.package-4.0.5/" . $locale_js . "'></script>";
		}
        $datepicker = 1;
    } 
    else 
    {
    	$datepicker++;
    }
    if(empty($gantt) && get_context() == "gantt")
    {
    	echo <<<END
<script src="{$vars['url']}mod/gantt/vendors/jquery.fn.gantt.js"></script>
<script src="http://twitter.github.com/bootstrap/assets/js/bootstrap-tooltip.js"></script>
<script src="http://twitter.github.com/bootstrap/assets/js/bootstrap-popover.js"></script>
<script src="http://taitems.github.com/UX-Lab/core/js/prettify.js"></script>
<!--<link rel="stylesheet" href="http://twitter.github.com/bootstrap/assets/css/bootstrap.css" />-->
<link rel="stylesheet" href="http://taitems.github.com/UX-Lab/core/css/prettify.css" />
END;
		$gantt = 1;
    }
    ?>
<?php if(get_context() == "gantt") { 	?>
<script type="text/javascript">

$(document).ready(function(){
	$('a.ganttpopuplink').live('click', function(){
		var _this = $(this);
		$('#gantt_popup_wrapper').dialog({
			width: 'auto',
			modal: true,
			beforeClose: function(event, ui) {
				if(elggGantt.settings.hasChanged) {
					 //we reload the diagramm
					 $('.gantt').empty();
					 elggGantt.fn.displayGantt();
				}
				elggGantt.settings.hasChanged = false;
			},
			buttons: {
			  'Close': function() { $(this).dialog('close'); }
			}
		});
    	$('#gantt_popup').load('<?php echo $CONFIG->site->url; ?>mod/gantt/pages/ajax/popup.php', {projectid:$('#projectid').val() }, function() {
			$('#gantttabs').tabs({
				beforeLoad: function( event, ui ) {
					ui.jqXHR.error(function() {
						ui.panel.html("Couldn't load this tab. We'll try to fix this as soon as possible. " );
					});
				},
				select: function(event, ui) {
					$('#modalMessageWrapper .message').hide();
					$('#modalMessageWrapper .message').empty();
				},
				selected:_this.data('tabindex')
			});
		});		
		$('#gantt_popup').show();		
		return false;
    });
	
});
elggGantt = {
	fn: {
		check_mandatory_fields: function(form_container) {
			var check = true;
			$('.mandatory', form_container).each(function(){
				if ($(this).val() == '') {
					check = false;
				}
			});
			if (!check) {
				$('#modalMessageWrapper .error').html("<?php echo elgg_echo('gantt:mandatoryfieldmissing') ?>");
				$('#modalMessageWrapper .error').show();	
			}
			return check;
		},
		ganttProcessResponse: function(data) {
			if(data.status == "OK") {
				$('#modalMessageWrapper .success').html(data.message);
				$('#modalMessageWrapper .success').show();
			} else {
				$('#modalMessageWrapper .error').html(data.message);
				$('#modalMessageWrapper .error').show();
			}
			//gantt diagramm might have change
			elggGantt.settings.hasChanged = true;
			//reload the current tab
			$('#gantttabs').tabs('load', $('#gantttabs').tabs('option', 'selected'));
			setTimeout("$('#modalMessageWrapper .message').fadeOut('slow', function() { $(this).empty(); });", 3000);
		}
	},
	settings: {
		gantt_base_url: "<?php echo $CONFIG->wwwroot . "pg/gantt/";?>",
		hasChanged: false,
		currentJson:null
		}
};

</script>
<?php } ?>