<?php

$html_fields = "";
$table_fields = $vars["table_fields"];
foreach($table_fields as $table_field){
    if(!$table_field->isPk()){
        $field_name = $table_field->getName();
        $label = ucwords($field_name);
        $html_fields .= "        <div>\n            <label>$label:</label>\n            <?php echo form_input('$field_name', \$object->$field_name) ?>\n        </div>\n";
    }
}

$form_template = "<?php echo form_open(\$this->uri->uri_string(), 'post') ?>
    <fieldset>
        <?php echo form_hidden(\"id\", \$object->id) ?>
$html_fields
        <div>
            <?php echo form_submit('', 'Save')?>
        </div>
    </fieldset>
<?php echo form_close() ?>
";
