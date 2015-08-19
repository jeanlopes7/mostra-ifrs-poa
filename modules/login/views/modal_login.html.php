<!-- Modal Login -->


<div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="modalLoginLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">×</span>
        </button>
        <h3 class="modal-title" id="modalLoginLabel">Fazer Login</h3>
      </div>
      <div class="modal-body">
        <form id="loginForm" action="<?=base_url()?>login/login_ctr" method="post" class="form-search" autocomplete="off">
             <div class="form-group">
                <label for="cpf">CPF</label>
                <input type="text" autofocus class="form-control" id="cpf" name="cpf" />
              </div>
              <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" class="form-control" id="password" name="password">
              </div>
            <input type="hidden" name="redirect" value="" />
        </form>
        <label for="lembrarme" class="checkbox"></label>
        <input id="lembrarme" type="checkbox"/>
        <label> Lembrar-me </label>
      </div>
      <div class="modal-footer">
        <a class="btn btn-warning" href="<?=base_url()?>login/login_ctr/recuperar_senha">
            Esqueci a senha
        </a>
          <button class="btn btn-default" type="reset" form="loginForm">
              Limpar
        </button>
          <button type="submit" form="loginForm" class="btn btn-primary">
            Entrar
        </button>
          
      </div>
    </div>
  </div>
</div>