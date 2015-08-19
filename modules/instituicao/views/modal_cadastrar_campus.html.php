<!-- Modal Cadastrar campus -->
<div class="modal fade" id="modalCadastrarCampus" tabindex="-1" role="dialog" aria-labelledby="modalCadastrarCampusLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">×</span>
        </button>
        <h3 class="modal-title" id="modalCadastrarCampusLabel">Cadastrar Campus</h3>
      </div>
      <div class="modal-body">
          <form id="cadastrarCampusForm"  class="form-search" autocomplete="off">
              <p class="css_mostra2015_texto_modal">
                  Obs: Tenha certeza de ter selecionado a Instituição correta.
              </p>
              <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" autofocus class="form-control" name="nome" maxlength="80"/>
              </div>
                            
              
              <div class="form-group">
                <label for="cidade">Cidade</label>
                <input type="text" class="form-control" name="cidade" maxlength="50">
              </div>
              
        </form>
        
      </div>
      <div class="modal-footer">
        
          <button class="btn btn-default" type="reset" form="cadastrarCampusForm">
              Limpar
        </button>
          <button type="submit" class="btn btn-primary" form="cadastrarCampusForm">
            Cadastrar
        </button>
          
      </div>
    </div>
  </div>
</div>
