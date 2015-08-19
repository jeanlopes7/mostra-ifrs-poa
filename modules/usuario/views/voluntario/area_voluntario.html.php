<?=$this->load->view('../../../templates/header.html.php')?>
<?=modules::run('usuario/usuario_ctr/area_geral')?>
<?php /* echo set_breadcrumb(); */ ?>

<article>

    <h4 align="center">Você está inscrito como VOLUNTÁRIO.</h4>

</article>
<input type="hidden" name="papel_corrente" value="voluntario" />
<?=$this->load->view('../../../templates/footer.html.php')?>