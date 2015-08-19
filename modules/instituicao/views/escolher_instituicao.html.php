
    <div class="form-group">
        <label for="instituicao" class="col-sm-2 control-label">Instituição</label>
        <div class="col-sm-8">
            <select required class="form-control" id="instituicao" name="instituicao">
                <option value="">Selecione um item da lista</option>
                <?php foreach ($instituicao_list as $instituicao): ?>
                    <option <?=
                    $is_registered == true ? $autor->id_instituicao == $instituicao->id_instituicao ? 'selected' : '' : ''
                    ?> value="<?= $instituicao->getIdInstituicao() ?>">
                            <?= $instituicao->getSigla() ?> - 
			    <?= $instituicao->getNome() ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br />
            <button class="btn btn-danger" type="button">Cadastrar outra instituição...</button>
        </div>
    </div>
