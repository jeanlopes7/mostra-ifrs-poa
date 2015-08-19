<!-- Modal Escolher Curso -->
<div class="modal fade" id="modalEscolherCurso" tabindex="-1" role="dialog" aria-labelledby="modalEscolherCursoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">×</span>
                </button>
                <h3 class="modal-title" id="modalLoginLabel">Escolher Curso</h3>
            </div>
            <div class="modal-body">
                <p class="css_mostra2015_texto_modal">Certifique-se de que seu Curso não consta na lista abaixo antes de cadastrar um novo curso.</p>

                <p class="css_mostra2015_texto_modal">Se o curso estiver na lista, selecione o mesmo e clique em 'Escolher'.</p>

                <p class="css_mostra2015_texto_modal">Se o curso não estiver na lista, clique em 'Cadastrar Novo Curso ...'</p>
                <p>
                    <label for="escolher_curso" class="col-sm-2 control-label">Curso</label>

                    <select class="form-control" id="escolher_curso">
                        <option>Selecione um item da lista</option>
                        <?php if ($is_registered) : ?>
                            <?php foreach ($curso_list as $curso): ?>
                                <option <?= $autor->id_curso == $curso['id_curso'] ? 'selected' : '' ?> value="<?= $curso['id_curso'] ?>">
                                    <?= $curso['nome'] ?>
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

                <button data-toggle="modal" data-target="#modalCadastrarCurso" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">
                    Cadastrar novo curso
                </button>

            </div>
        </div>
    </div>
</div>

