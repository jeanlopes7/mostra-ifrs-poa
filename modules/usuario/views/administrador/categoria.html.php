<?=$this->load->view('../../../templates/header.html.php')?>
<?=set_breadcrumb()?>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>nome</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categories_list as $categoria ): ?>
        <tr>
            <td>
                <?=$categoria->id_categoria?>
            </td>
            <td>
                <?=$categoria->nome?>
            </td>            
            <td>
                <a class="delete" href="#">X</a>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
<a href="<?=base_url()?>/../organizador/categoria/inserir_categoria" class="btn btn-primary">Novo</a>

<script type="text/javascript" src="<?=base_url()?>/../content/organizador.js"></script>
<?=$this->load->view('../../../templates/footer.html.php')?>
