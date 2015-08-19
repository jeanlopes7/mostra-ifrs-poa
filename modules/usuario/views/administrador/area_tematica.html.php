<?=$this->load->view('../../../templates/header.html.php')?>
<?php /* set_breadcrumb() */?>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>nome</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($area_tematica_list as $area ): ?>
        <tr>
            <td>
                <?=$area->id_area?>
            </td>
            <td>
                <?=$area->nome?>
            </td>            
            <td>
                <a class="delete" href="#">X</a>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
<a href="<?=base_url()?>/../organizador/area_tematica/inserir_area_tematica" class="btn btn-primary">Novo</a>
<script type="text/javascript" src="<?=base_url()?>/../content/organizador.js"></script>
<?=$this->load->view('../../../templates/footer.html.php')?>
