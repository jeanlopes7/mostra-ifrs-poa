<?= $this->load->view('../../../../templates/header.html.php') ?>

<div class="text-center">
    <h4>Inscrição de Voluntário</h4>
</div>

<form action="<?=base_url()?>usuario/voluntario_ctr/fazer_inscricao" method="post" class="form-horizontal" role="form">

<?= $this->load->view('../pv_cad_usuario.html.php') ?>

<!-- Inclui as partial views para escolher instituicao, campus e curso -->
<?= $this->load->view('../../../instituicao/views/escolher_instituicao.html.php') ?>
<?= $this->load->view('../../../instituicao/views/escolher_campus.html.php') ?>
<?= $this->load->view('../../../instituicao/views/escolher_curso.html.php') ?>

<fieldset>
	<legend>
		<div class="text-center">
			<h4>Turnos disponíveis</h4>
		</div>
	</legend>
	
		<p><div class="text-center">*selecione ao menos um</div></p>
	
	<div class="form-group">
		<label for="manha" class="col-sm-2 control-label"></label>
		<div class="col-sm-5">
			<h5>
				<input type="checkbox" id="manha" name="manha" value="">
				Turno da manhã
			</h5>
		</div>
	</div>
	<div class="form-group">
		<label for="tarde" class="col-sm-2 control-label"></label>
		<div class="col-sm-5">
			<h5>
				<input type="checkbox" id="tarde" name="tarde" value="">
				Turno da tarde
			</h5>
		</div>
	</div>
	<div class="form-group">
		<label for="noite" class="col-sm-2 control-label"></label>
		<div class="col-sm-5">
			<h5>
				<input type="checkbox" id="noite" name="noite" value="">
				Turno da noite
			</h5>
		</div>
	</div>
</fieldset>

<fieldset>
	<legend>
		<div class="text-center">
		    <h4>Telefones para contato</h4>
		</div>
	</legend>
	
	<div class="form-group">
		<label for="telefone1" class="col-sm-2 control-label">Telefone 1</label>
		<div class="col-sm-5">
			<input type="tel" id="telefone1" name="telefone1"  class="form-control" value="" required="required" title="telefone1">
		</div>
	</div>

	<div class="form-group">
		<label for="telefone2" class="col-sm-2 control-label">Telefone 2</label>
		<div class="col-sm-5">
			<input type="tel" id="telefone2" name="telefone2"  class="form-control" value="" title="telefone2">
		</div>
	</div>

	<div class="form-group">
		<label for="telefone3" class="col-sm-2 control-label">Telefone 3</label>
		<div class="col-sm-5">
			<input type="tel" id="telefone3" name="telefone3"  class="form-control" value="" title="telefone3">
		</div>
	</div>

</fieldset>

<div class="form-group">
	<label for="textareaObservacoes" class="col-sm-2 control-label">Observacoes:</label>
	<div class="col-sm-10">
		<textarea name="observacoes" id="textareaObservacoes" class="form-control" rows="3" ></textarea>
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

<<<<<<< HEAD
<script src="<?=base_url()?>content/instcamcur.js" type="text/javascript"></script>
<script src="<?=base_url()?>content/voluntario.js" type="text/javascript"></script>
=======
<script src="<?=base_url()?>content/instcamcur.js" type="text/javascript"></script>
>>>>>>> f9b405479b0aa4f88530d1c9535f52b197308e2e
