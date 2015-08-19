<?= $this->load->view('../../../templates/header.html.php') ?>

<form id="cadastrarCursoForm" method="post" class="form-search" autocomplete="off">
    <input type="hidden" name="id_curso" value="<?=$curso->id_curso?>" />
    <div class="form-group">
        <label for="nome">Nome</label>
        <input type="text" autofocus class="form-control" name="nome" value="<?=$curso->nome?>" />
    </div>

    <div class="form-group">
        <label for="nivel">Nível</label>
        <select name="nivel" class="form-control">
            <option>Selecione</option>
            <option <?=$curso->nivel == 2 ? 'selected' : ''?> value="2">Técnico</option>
            <option <?=$curso->nivel == 3 ? 'selected' : ''?> value="3">Superior</option>
        </select>
    </div>
    <div class="form-group">
        <label for="campus">Campus</label>
        <select name="campus" class="form-control">
            <option>Selecione</option>
        </select>
        <?php /*<input type="text" class="form-control" name="campus" value="<?=$curso->fk_campus?>"> */ ?>
    </div>
     <button class="btn btn-default" type="reset" form="cadastrarCursoForm">
              Limpar
        </button>
          <button type="submit" class="btn btn-primary" form="cadastrarCursoForm">
            Cadastrar
        </button>
</form>
<script type="text/javascript" src="<?= base_url() ?>/../content/curso.js"></script>
<?=$this->load->view('../../../templates/footer.html.php')?>