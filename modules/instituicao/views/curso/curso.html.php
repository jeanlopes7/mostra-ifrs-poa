<?=$this->load->view('../../../templates/header.html.php')?>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>nome</th>
            <th>nível</th>
            <th>Campus</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($curso_list as $curso ): ?>
        <tr>
            <td>
                <?=$curso->id_curso?>
            </td>
            <td>
                <a href="<?= base_url() ?>curso/update/<?= $curso->id_curso ?>"><?= $curso->nome ?></a>
            </td>
            <td>
                <?=$curso->nivel?>
            </td>
            <td>
                <?=$curso->fk_campus?>
            </td>
            <td>
                <a class="delete" href="#">X</a>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
    <a href="<?= base_url() ?>curso/create" class="btn btn-primary">Novo</a>
<br /><br />
<?=$this->pagination->create_links()?>
<script type="text/javascript" src="<?=base_url()?>/../content/curso.js"></script>
<?=$this->load->view('../../../templates/footer.html.php')?>