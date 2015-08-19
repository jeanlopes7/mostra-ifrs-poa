
<div class="form-group">
        <label for="campus" class="col-sm-2 control-label">Campus</label>
        <div class="col-sm-8">

            <select required class="form-control" id="campus" name="campus">
                <option value="">Selecione um item da lista</option>
                <?php if ($is_registered) : ?>
                    <?php foreach ($campus_list as $campus): ?>
                        <option <?= $autor->id_campus == $campus['id_campus'] ? 'selected' : '' ?> value="<?= $campus['id_campus'] ?>">
                            <?= $campus['nome'] ?> - <?=$campus['sigla'] ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
            <br />
            <button class="btn btn-danger" type="button">Cadastrar outro campus...</button>
        </div>
    </div>
