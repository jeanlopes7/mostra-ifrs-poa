<?= $this->load->view('../../../../templates/header.html.php') ?>

<div class="text-center">
    <h4>Inscrição de Avaliador</h4>
</div>

<form action="<?=base_url()?>usuario/avaliador_ctr/inscricao_incremental" method="post" class="form-horizontal" role="form">

<?= $this->load->view('../pv_tipo_avaliador.html.php') ?>

<div class="form-group">
        <label for="input_formacao" class="col-sm-2 control-label">Formação</label>
        <div class="col-sm-5">
            <select name="formacao" id="input_formacao" class="form-control" required="required">
                <option value="">Selecione um item da lista</option>
                <option value="1">Superior</option>
                <option value="2">Especialização</option>
                <option value="3">Mestrado</option>
                <option value="4">Doutorado</option>
            </select>
        </div>
</div>

<div class="form-group">
        <label for="input_area_tematica" class="col-sm-2 control-label">Área temática que deseja ser avaliador</label>
        <div class="col-sm-5">
            <select required class="form-control" name="area_tematica" id="input_area_tematica">
                <option value="">Selecione um item da lista</option>
                <option value="1">Ciências Exatas e da Terra</option>
                <option value="2">Ciências Biológicas</option>
                <option value="3">Engenharias</option>
                <option value="4">Ciências da Saúde</option>
                <option value="5">Ciências Agrárias</option>
                <option value="6">Ciências Sociais Aplicadas</option>
                <option value="7">Ciências Humanas</option>
                <option value="8">Lingüística, Letras e Artes</option>
            </select>
        </div>
    </div>

<!-- Inclui as partial views para escolher instituicao e campus -->
<?= $this->load->view('../../../instituicao/views/escolher_instituicao.html.php') ?>
<?= $this->load->view('../../../instituicao/views/escolher_campus.html.php') ?>

    

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


