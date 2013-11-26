<?php global $CONFIG; ?>
<span class="<?php echo $vars['internalname'];?>"></span>
<script type="text/javascript">
$('.<?php echo $vars['internalname'];?>').html($.datepicker.formatDate('d MM yy', new Date(<?php echo $vars['value'];?>)<?php if($CONFIG->language != "en"):?>, {dayNamesShort: $.datepicker.regional['<?php echo $CONFIG->language;?>'].dayNamesShort, dayNames: $.datepicker.regional['<?php echo $CONFIG->language;?>'].dayNames, monthNamesShort: $.datepicker.regional['<?php echo $CONFIG->language;?>'].monthNamesShort, monthNAmes: $.datepicker.regional['<?php echo $CONFIG->language;?>'].monthNames}<?php endif;?>));
</script>