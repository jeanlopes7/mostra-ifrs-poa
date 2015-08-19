<?php echo form_open($this->uri->uri_string(), 'post') ?>
    <fieldset>
        <?php echo form_hidden("id", $object->getIdCampus()) ?>
        <div>
            <label>Nome:</label>
            <?php echo form_input('nome', $object->getNome()) ?>
        </div>
        <div>
            <label>Cidade:</label>
            <?php echo form_input('cidade', $object->getCidade()) ?>
        </div>
        <div>
            <label>Instituição:</label>
            <?php echo form_dropdown('fk_instituicao', $instituicao_list, $object->getInstituicao() != null ? $object->getInstituicao()->getIdInstituicao() : 'Selecione...') ?>
        </div>
        <div>
            <?php echo form_submit('', 'Save')?>
        </div>
    </fieldset>
<?php echo form_close(); ?>