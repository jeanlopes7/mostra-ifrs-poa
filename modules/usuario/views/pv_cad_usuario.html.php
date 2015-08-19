
    <input name="cpf" type="hidden" value="<?=$cpf?>">
    <div class="form-group">
        <label for="nome" class="col-sm-2 control-label">Nome</label>
        <div class="col-sm-5">
            <input type="text" required class="form-control" id="nome" name="nome" value="" autofocus>
        </div>
    </div>
    
    <div class="form-group">
        <label for="email" class="col-sm-2 control-label">E-mail</label>
        <div class="col-sm-5">
            <input type="email" autocomplete="off" required class="form-control" name="email" id="email" value="" >
        </div>
    </div>
    
    <div class="form-group">
        <label for="email" class="col-sm-2 control-label">Confirmar E-mail</label>
        <div class="col-sm-5">
            <input type="email" autocomplete="off" required class="form-control" name="confirmar_email" value="" >
        </div>
    </div>
    

    <?php if (!$is_registered) : ?>
        <div class="form-group">
            <label for="senha" class="col-sm-2 control-label">Senha</label>
            <div class="col-sm-5">
                <input type="password" autocomplete="off" required class="form-control" id="senha" name="senha" >
            </div>
        </div>

        <div class="form-group">
            <label for="confirmar_senha" class="col-sm-2 control-label">Confirmar Senha</label>
            <div class="col-sm-5">
                <input type="password" required class="form-control" id="confirmar_senha" name="confirmar_senha" >
            </div>
        </div>
    
    <?php endif; ?>
    <script src="<?=base_url()?>content/usuario.js" type="text/javascript"></script>