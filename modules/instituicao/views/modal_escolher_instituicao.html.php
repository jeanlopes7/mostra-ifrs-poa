<!-- Modal Escolher Instituição -->
<div class="modal fade" id="modalEscolherInstituicao" tabindex="-1" role="dialog" aria-labelledby="modalEscolherInstituicaoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">×</span>
                </button>
                <h3 class="modal-title" id="modalLoginLabel">Escolher Instituição</h3>
            </div>
            <div class="modal-body">
                <p class="css_mostra2015_texto_modal">Certifique-se de que sua instituição não consta na lista abaixo antes de cadastrar uma nova instituição.</p>

                <p class="css_mostra2015_texto_modal">Se a instituição estiver na lista, selecione a mesma e clique em 'Escolher'.</p>

                <p class="css_mostra2015_texto_modal">Se a instituição não estiver na lista, clique em 'Cadastrar Nova instituição ...'</p>
                <p>
                    <label for="escolher_instituicao" class="col-sm-2 control-label">Instituição</label>

                    <select class="form-control" id="escolher_instituicao">
                        <option>Selecione um item da lista</option>
                        <?php foreach ($instituicao_list as $instituicao): ?>
                            <option value="<?= $instituicao->getIdInstituicao() ?>"><?= $instituicao->getSigla() ?> - <?= $instituicao->getNome() ?></option>
                        <?php endforeach; ?>
                    </select>
                </p>     

            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">
                    Escolher
                </button>

                <button type="button" data-toggle="modal" data-target="#modalCadastrarInstituicao" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">
                    Cadastrar nova instituição
                </button>

            </div>
        </div>
    </div>
</div>
