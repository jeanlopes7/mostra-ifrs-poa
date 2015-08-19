<?= $this->load->view('../../../../templates/header.html.php') ?>

<div class="text-center">
    <h4>Inscrição de Ouvinte</h4>
</div>

<form action="<?=base_url()?>usuario/ouvinte_ctr/fazer_inscricao" method="post" class="form-horizontal" role="form">

<?= $this->load->view('../pv_cad_usuario.html.php') ?>

<div class="form-group">
    <label for="input_formacao" class="col-sm-2 control-label">Tipo de ouvinte</label>
        <div class="col-sm-5">
            <select name="tipo_ouvinte" id="input_tipo_ouvinte" class="form-control" required="required">
                <option value="">Selecione um item da lista</option>
                <option value="1">Docente</option>
                <option value="2">Técnico Administrativo</option>
                <option value="3">Estudante</option>
                <option value="4">Outro</option>
            </select>
        </div>
</div>

<div class="form-group">
	<label for="input" class="col-sm-2 control-label">Tipo de ouvinte "Outro"</label>
	<div class="col-sm-5">
		<input type="text" name="outro" class="form-control" value="" placeholder="opcional" title="outro">
	</div>
</div>

<!-- Inclui as partial views para escolher instituicao, campus e curso -->
<?= $this->load->view('../../../instituicao/views/escolher_instituicao.html.php') ?>
<?= $this->load->view('../../../instituicao/views/escolher_campus.html.php') ?>
<?= $this->load->view('../../../instituicao/views/escolher_curso.html.php') ?>

<div class="form-group">
	<label for="input" class="col-sm-2 control-label">Empresa ou outra instituição</label>
	<div class="col-sm-5">
		<input type="text" name="empresa" id="input" class="form-control" placeholder="opcional" title="empresa">
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
<script src="<?=base_url()?>content/ouvinte.js" type="text/javascript"></script>

<?=$this->load->view('../../../templates/footer.html.php')?>
