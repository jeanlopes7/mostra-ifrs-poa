<?php

$form_template = "<?php echo form_open(\$this->uri->uri_string(), 'post') ?>
    <fieldset>
        <?php echo form_hidden(\"id\", \$object->id) ?>
        <div>
            <label>Nome:</label>
            <?php echo form_input('nome', \$object->nome) ?>
        </div>
        <div>
            <label>Alias:</label>
            <?php echo form_input('alias', \$object->alias) ?>
        </div>
        <div>
            <label>Estado_id:</label>
            <?php echo form_input('estado_id', \$object->estado_id) ?>
        </div>
        <div>
            <?php echo form_submit('', 'Save')?>
        </div>
    </fieldset>
<?php echo form_close() ?>
";
