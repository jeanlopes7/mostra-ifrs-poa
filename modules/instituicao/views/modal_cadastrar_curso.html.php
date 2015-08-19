<!-- Modal Cadastrar curso -->
<div class="modal fade" id="modalCadastrarCurso" tabindex="-1" role="dialog" aria-labelledby="modalCadastrarCursoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">×</span>
        </button>
        <h3 class="modal-title" id="modalCadastrarCursoLabel">Cadastrar Curso</h3>
      </div>
      <div class="modal-body">
          <form id="cadastrarCursoForm"  class="form-search" autocomplete="off">
              <p class="css_mostra2015_texto_modal">
                  Obs: Tenha certeza de ter selecionado o Campus correto.
              </p>
              <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" autofocus class="form-control" name="nome" maxlength="80"/>
              </div>
                            
<<<<<<< HEAD
              <?php /* 
              <div class="form-group">
                <label for="cidade">Cidade</label>
                <input type="text" class="form-control" name="cidade" maxlength="50">
              </div> */ ?>
=======
              
              <div class="form-group">
                <label for="cidade">Cidade</label>
                <input type="text" class="form-control" name="cidade" maxlength="50">
              </div>
>>>>>>> f9b405479b0aa4f88530d1c9535f52b197308e2e
              
              <div class="form-group">
                  <label for="nivel">Nível</label>
                  <select name="nivel" class="form-control">
                      <option>Selecione</option>
                      <option value="2">Técnico</option>
                      <option value="3">Superior</option>
                  </select>
              </div>
              
        </form>
        
      </div>
      <div class="modal-footer">
        
          <button class="btn btn-default" type="reset" form="cadastrarCursoForm">
              Limpar
        </button>
          <button type="submit" class="btn btn-primary" form="cadastrarCursoForm">
            Cadastrar
        </button>
          
      </div>
    </div>
  </div>
</div>
