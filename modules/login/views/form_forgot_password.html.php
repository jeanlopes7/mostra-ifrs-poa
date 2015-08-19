<?= $this->load->view('../../../templates/header.html.php') ?>

<div class="text-center">
    <h4>Formulário de Recuperação de Senha</h4>
</div>
<br />

<form action="<?=base_url()?>login/login_ctr/recuperar_senha" method="post" class="form-horizontal" role="form">

    <div class="form-group">
        <label for="email" class="col-sm-2 control-label">E-mail</label>
        <div class="col-sm-5">
            <input type="email" autocomplete="off" required class="form-control" name="email" id="email" value="" autofocus>
        </div>
    </div>

<div class="form-group text-right">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="button" onclick="history.back()" class="btn btn-danger">Voltar</button>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </div>
</form>

<?=$this->load->view('../../../templates/footer.html.php')?>