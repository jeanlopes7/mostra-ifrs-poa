<!-- Modal Escolher Campus -->
<div class="modal fade" id="modalEscolherCampus" tabindex="-1" role="dialog" aria-labelledby="modalEscolherCampusLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">×</span>
                </button>
                <h3 class="modal-title" id="modalLoginLabel">Escolher Campus</h3>
            </div>
            <div class="modal-body">
                <p class="css_mostra2015_texto_modal">Certifique-se de que seu campus não consta na lista abaixo antes de cadastrar um novo campus.</p>

                <p class="css_mostra2015_texto_modal">Se o campus estiver na lista, selecione o mesmo e clique em 'Escolher'.</p>

                <p class="css_mostra2015_texto_modal">Se o campus não estiver na lista, clique em 'Cadastrar Novo Campus ...'</p>
                <p>
                    <label for="escolher_campus" class="col-sm-2 control-label">Campus</label>

                    <select class="form-control" id="escolher_campus">
                        <option>Selecione um item da lista</option>
                        <?php if ($is_registered) : ?>
                            <?php foreach ($campus_list as $campus): ?>
                                <option <?= $autor->id_campus == $campus['id_campus'] ? 'selected' : '' ?> value="<?= $campus['id_campus'] ?>">
                                    <?= $campus['nome'] ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </p>     

            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">
                    Escolher
                </button>

                <button data-toggle="modal" data-target="#modalCadastrarCampus" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">
                    Cadastrar novo campus
                </button>

            </div>
        </div>
    </div>
</div>
