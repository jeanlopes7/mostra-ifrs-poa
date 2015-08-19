<?= $this->load->view('../../../../templates/header.html.php') ?>

<div class="text-center">
    <h4>Inscrição de Orientador</h4>
</div>
<form action="<?=base_url()?>usuario/orientador_ctr/inscricao_incremental" method="post" class="form-horizontal" role="form">


<!-- Inclui as partial views para escolher instituicao e campus -->
<?= $this->load->view('../../../instituicao/views/escolher_instituicao.html.php') ?>
<?= $this->load->view('../../../instituicao/views/escolher_campus.html.php') ?>

    <div class="form-group">
        <label for="inputTipo_servidor" class="col-sm-2 control-label">Tipo sevidor</label>
        <div class="col-sm-5">
            <select name="tipo_servidor" id="inputTipo_servidor" class="form-control" required="required">
                <option>Selecione um item da lista</option>
                <option value="1">Docente</option>
                <option value="2">Técnico Administrativo</option>
            </select>
        </div>
    </div>

    <div class="form-group text-right">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="button" onclick="history.back()" class="btn btn-danger">Voltar</button>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </div>
</form>

<?= $this->load->view('../../../instituicao/views/modal_escolher_instituicao.html.php') ?>
<?= $this->load->view('../../../instituicao/views/modal_cadastrar_instituicao.html.php') ?>

<?= $this->load->view('../../../instituicao/views/modal_escolher_campus.html.php') ?>
<?= $this->load->view('../../../instituicao/views/modal_cadastrar_campus.html.php') ?>

<script src="<?=base_url()?>content/instcamcur.js" type="text/javascript"></script>

<?=$this->load->view('../../../templates/footer.html.php')?>
