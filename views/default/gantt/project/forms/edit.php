<script type="text/javascript">
    function check_mandatory_fields(form_container) {
        var check = true;
        $('.mandatory', form_container).each(function(){
            if ($(this).val() == '') {
                check = false;
            }
        });
        if (!check) alert('<?php echo elgg_echo('hypeCompanies:mandatoryfieldmissing') ?>');
        return check;
    }
</script>

<?php
$fields = getProjectFields();
if (!$vars['entity']) {
    foreach ($fields as $ref => $value) {
        $vars['entity']->$ref = '';
    }
}
?>

<form action="<?php echo $vars['url']; ?>action/gantt/save" method="post" enctype="multipart/form-data" onsubmit="return check_mandatory_fields($(this));">
    <?php
    echo elgg_view('input/securitytoken');
    echo '<p><label>' . elgg_echo('gantt:project:icon') . '</label>' . elgg_view('input/file', array('internalname' => 'projecticon')) . '</p>';
    foreach ($fields as $ref => $value) {
        echo '<div><label>' . elgg_echo($value['display_name']) . '</label>' . elgg_view('input/' . $value['type'], array('value' => $vars['entity']->$ref,
            'internalname' => $ref, 'options' => $value['options'], 'class' => $value['class'])) . '</div>';
    }

    echo elgg_view('input/category', array('entity' => $vars['entity']));


    echo '<p><label>' . elgg_echo('gantt:project:access') . '</label>' . elgg_view('input/access', array('internalname' => 'access_id', 'value' => $vars['entity']->access_id)) . '</p>';
    echo elgg_view('input/hidden', array('value' => $vars['entity']->guid, 'internalname' => 'object_guid'));
    echo elgg_view('input/hidden', array('value' => $vars['user']->guid, 'internalname' => 'user_guid'));
    echo elgg_view('input/submit', array('value' => 'save', 'internalname' => 'save'));
    ?>
</form>
<?php
if ($vars['entity']->guid) {
?>
<form action="<?php echo $vars['url']; ?>action/company/delete" method="post">
    <?php
    echo elgg_view('input/securitytoken');
    echo elgg_view('input/hidden', array('value' => $vars['entity']->guid, 'internalname' => 'projectid'));
    echo elgg_view('input/submit', array('value' => 'Delete', 'internalname' => 'delete'));
    ?>
</form>
<?php } ?>