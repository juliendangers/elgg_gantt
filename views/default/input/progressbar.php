<?php

$token = rand(0,10000);

if (isset($vars['class'])) {
	$class = $vars['class'];
} else {
	$class = "input-progress";
}

$internalid = $vars['internalid'];
if(!$internalid)
	$internalid = 'amount-slider-'.$token;
	
$disabled = false;
if (isset($vars['disabled'])) {
	$disabled = $vars['disabled'];
}

$value = $vars['value'];
if(!$value) {
	$value = 0;
}
?>
<script type="text/javascript">
    $(function() {
        $( "#slider-range-<?php echo $token;?>" ).slider({
            range: "min",
            value: <?php echo $value;?>,
            min: 0,
            max: 100,
            slide: function( event, ui ) {                
				$( "#<?php echo $internalid.$token;?>" ).val( ui.value );
				$( "#<?php echo $internalid;?>" ).val( ui.value );
            }
        });
        $( "#<?php echo $internalid.$token;?>" ).val( $( "#slider-range-<?php echo $token;?>" ).slider( "value" ));
        $( "#<?php echo $internalid;?>" ).val( $( "#slider-range-<?php echo $token;?>" ).slider( "value" ));
    });
</script>
<p>
    <input type="text" disabled="yes" <?php echo $vars['js']; ?> name="<?php echo $vars['internalname'].$token; ?>" id="<?php echo $internalid.$token; ?>" class="<?php echo $class ?>" style="border: 0; color: #f6931f; font-weight: bold;" value="<?php echo htmlentities($vars['value'], ENT_QUOTES, 'UTF-8'); ?>" />
	<input type="hidden" name="<?php echo $vars['internalname']; ?>" id="<?php echo $internalid; ?>" value="<?php echo htmlentities($vars['value'], ENT_QUOTES, 'UTF-8'); ?>" />
</p>
 
<div id="slider-range-<?php echo $token;?>"></div>