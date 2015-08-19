<?=$this->load->view('../../../templates/header.html.php')?>
<?=modules::run('usuario/usuario_ctr/area_geral')?>
<?php /* echo set_breadcrumb(); */ ?>

<article>

    <h4 align="center">Você está inscrito para participar como avaliador de trabalhos.</h4>
    <h4 align="center">A comissão organizadora do evento entrará em contato informando a homologação da sua inscrição.</h4>

</article>
<input type="hidden" name="papel_corrente" value="avaliador" />
<?=$this->load->view('../../../templates/footer.html.php')?>