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
        <?php foreach ($modalidade_list as $modalidade ): ?>
        <tr>
            <td>
                <?=$modalidade->id_modalidade?>
            </td>
            <td>
                <?=$modalidade->nome?>
            </td>
            <td>
                <a class="delete" href="#">X</a>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
<a href="<?=base_url()?>/../organizador/modalidade/inserir_modalidade" class="btn btn-primary">Novo</a>
<script type="text/javascript" src="<?=base_url()?>/../content/organizador.js"></script>
<?=$this->load->view('../../../templates/footer.html.php')?>
