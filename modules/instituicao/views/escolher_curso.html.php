
    <div class="form-group">
        <label for="curso" class="col-sm-2 control-label">Curso</label>
        <div class="col-sm-8">
            <select required class="form-control" id="curso" name="curso">
                <option value="">Selecione um item da lista</option>
                <?php if ($is_registered) : ?>
                    <?php foreach ($curso_list as $curso): ?>
                        <option <?= $autor->id_curso == $curso['id_curso'] ? 'selected' : '' ?> value="<?= $curso['id_curso'] ?>">
                            <?= $curso['nome'] ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
            <br />
            <button class="btn btn-danger" type="button">Cadastrar outro curso...</button>
        </div>
    </div>
