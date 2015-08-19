<?= $this->load->view('../../../templates/header.html.php') ?>
<?=set_breadcrumb()?>
<form id="cadastrarModalidadeForm" method="post" class="form-search" autocomplete="off">
    <input type="hidden" name="id_modalidade" />
    <div class="form-group">
        <label for="nome" class="col-sm-2 control-label">Nome</label>
        <div class="col-sm-5">
            <input type="text" required class="form-control" id="nome" name="nome" autofocus>
        </div>
    </div>
    <div class="form-group text-right">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary" form="cadastrarModalidadeForm">
                Cadastrar
            </button>
        </div>
    </div>
</form>
<?=$this->load->view('../../../templates/footer.html.php')?>