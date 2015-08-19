<?php echo form_open($this->uri->uri_string(), 'post') ?>
    <fieldset>
        <?php echo form_hidden("id_instituicao", $object->getIdInstituicao()) ?>
        <div>
            <label>Nome:</label>
            <?php echo form_input(array('name'=>'nome','value' => $object->getNome(), 'autofocus'=>'autofocus')) ?>
        </div>
        <div>
            <label>Sigla:</label>
            <?php echo form_input('sigla', $object->getSigla()) ?>
        </div>
        <div>
            <label>Cidade:</label>
            <?php echo form_input('cidade', $object->getCidade()) ?>
        </div>
        <div>
            <label>Estado:</label>
            <?php echo form_input('estado', $object->getEstado()) ?>
        </div>
        <div>
            <label>Site:</label>
            <?php echo form_input('site', $object->getSite()) ?>
        </div>
        <div>
            <label>Tipo:</label>
            <?php echo form_input('tipo', $object->getTipo()) ?>
        </div>

        <div>
            <?php echo form_submit('', 'Save')?>
        </div>
    </fieldset>
<?php echo form_close() ?>