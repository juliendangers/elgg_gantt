<?php

$val = $vars['value'];
if(! $val>0) {
	$val = 0;
}
$name = $vars['internalname'];
$class = $vars['class'];
?><script>
    $(function() {
        $( ".<?php echo $name; ?>" ).progressbar({
            value: <?php echo $val; ?>
        });
    });
</script>

<div class="progressbar <?php echo $name; ?>"></div>