<!-- Modal Cadastrar instituição -->

<style type="text/css">
  .modal .modal-dialog {
  width: 70%;
}
</style>

<div class="modal fade" id="modalCadastrarInstituicao" tabindex="-1" role="dialog" aria-labelledby="modalCadastrarInstituicaoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">×</span>
        </button>
        <h3 class="modal-title" id="modalCadastrarInstituicaoLabel">Cadastrar Instituição</h3>
      </div>
      <div class="modal-body">
          <form id="cadastrarInstituicaoForm"  class="form-search" autocomplete="off">
              <p class="css_mostra2015_texto_modal">
                  ATENÇÃO: Somente cadastre uma nova Instituição se ela ainda não estiver cadastrada.
              </p>
              <div class="form-group">
                <label for="nome">Nome (somente o nome geral da instituição, não coloque o nome do campus, unidade ou departamento)</label>
                <input type="text" autofocus class="form-control" name="nome" maxlength="80"/>
              </div>
              
              <div class="form-group">
                <label for="sigla">Sigla (somente a sigla geral da instituição, não coloque a sigla do campus, unidade ou departamento)</label>
                <input type="text" class="form-control" name="sigla" maxlength="10" />
              </div>
              
              <div class="form-group">
                <label for="cidade">Cidade</label>
                <input type="text" class="form-control" name="cidade" maxlength="50" />
              </div>
              
              
              <div class="form-group">
                <label for="sigla">Estado</label>
                <input type="text" class="form-control" name="estado" maxlength="2" />
              </div>
              
              <div class="form-group">
                <label for="site">Site</label>
                <input type="text" class="form-control" name="site" maxlength="50" />
              </div>
              
              
              <div class="form-group">
                <label for="sigla">Tipo</label>
                <select class="form-control" name="tipo">
                    <option value="0">Selecione uma opcao</option>
                    <option value="1">Instituto Federal</option>
                    <option value="2">Escola Técnica</option>
                    <option value="3">Instituição de Ensino Superior</option>
                    <option value="4">Empresa</option>
                    <option value="5">Outro tipo</option>
                </select>
              </div>
        </form>
        
      </div>
      <div class="modal-footer">
        
          <button class="btn btn-default" type="reset" form="cadastrarInstituicaoForm">
              Limpar
        </button>
          <button type="submit" class="btn btn-primary" form="cadastrarInstituicaoForm">
            Entrar
        </button>
          
      </div>
    </div>
  </div>
</div>
