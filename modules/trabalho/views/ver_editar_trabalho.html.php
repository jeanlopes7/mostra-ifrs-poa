<?php //= $this->load->view('../../../templates/header.html.php') ?>
<?php //=modules::run('usuario/usuario_ctr/principal')?>

<?=$this->load->view('../../../templates/header.html.php')?>
<<<<<<< HEAD
<?=$this->load->helper('funcoes_ver_trabalho')?>
=======
>>>>>>> f9b405479b0aa4f88530d1c9535f52b197308e2e
<?=modules::run('usuario/usuario_ctr/area_geral')?>
<?php /* echo set_breadcrumb();  */?>

<?php
    
/* @var $trabalho \Entity\Trabalho */
?>

<script>

  function enviar_trabalho(id_trabalho, quant_orientadores) {
    if (quant_orientadores == 0) {
      alert('O trabalho não possui nenhum orientador vinculado, então não é possível enviar o trabalho. Vincule pelo menos um orientador ao trabalho.');
      return;
    }
    
    if ( confirm("Tem certeza que deseja ENVIAR o trabalho? Após enviar o trabalho não haverá possibilidades de efetuar quaisquer mofificações no mesmo.") ) {
      window.location = "<?=base_url().'trabalho/trabalho_ctr/enviar/'?>"+id_trabalho;
    }    
  }//enviar_trabalho()

  function validar_trabalho(id_trabalho) {
    if ( confirm("Tem certeza que deseja VALIDAR o trabalho? Após validar o trabalho não haverá possibilidades de efetuar quaisquer mofificações no mesmo.") ) {
      window.location = "<?=base_url().'trabalho/trabalho_ctr/validar/'?>"+id_trabalho;
    }    
  }//validar_trabalho()

  function invalidar_trabalho(id_trabalho) {
    if ( confirm("Tem certeza que deseja INVALIDAR o trabalho? Após invalidar o trabalho não haverá possibilidades de efetuar quaisquer mofificações no mesmo.") ) {
      window.location = "<?=base_url().'trabalho/trabalho_ctr/invalidar/'?>"+id_trabalho;
    }    
  }//invalidar_trabalho()

  function pender_trabalho(id_trabalho) {
    if ( confirm("O trabalho será colocado no estado PENDENTE para permitir ao autor efetuar modificações. Tem certeza que deseja efetuar essa operação?") ) {
      window.location = "<?=base_url().'trabalho/trabalho_ctr/pender/'?>"+id_trabalho;
    }    
  }//pender_trabalho()

</script>

<div class="text-center">
    <h4>Visualização de Trabalho</h4>

  <div class = "tituloEditTrab">
    <h5>Número do Trabalho (ID): <?php echo $trabalho->getIdTrabalho(); ?> </h5>
  </div>
  <br/>
  <div class = "tituloEditTrab">
    <h5>Título: </h5>
  </div>
    <div class="edit_bt"><p><?php echo $trabalho->getTitulo(); ?></p></div>

  <br/>

  <div class = "tituloEditTrab">
    <h5>Resumo: </h5>
  </div>
    <div class="edit_bt"><p><?php echo $trabalho->getResumo(); ?></p></div>

  <br/>
  <div class = "tituloEditTrab">
    <h5>Palavras-Chave: <span class="texto-info"><?php echo $trabalho->getPalavra1(); ?>, <?php echo $trabalho->getPalavra2(); ?>, <?php echo $trabalho->getPalavra3(); ?>.</span></h5>
  </div>
  

  <br/>
  <div class = "tituloEditTrab">
    <h5>Área Temática: <span class="texto-info"><?php echo $trabalho->getArea()->getNome(); ?></span></h5>
  </div>

  <br/>
  <div class = "tituloEditTrab">
    <h5>Categoria: <span class="texto-info"><?php echo $trabalho->getCategoria()->getNome(); ?></span></h5>
  </div>
    

  <br/>
  <div class = "tituloEditTrab">
    <h5>Modalidade de Apresentação: <span class="texto-info"><?php echo $trabalho->getModalidade()->getNome(); ?></span></h5>
  </div>
    

  <br/>
  <div class = "tituloEditTrab">
    <h5>Apoiadores:  <span class="texto-info"><?php echo $trabalho->getApoiadores(); ?></span></h5>
  </div>

  <br/>
  <div class = "tituloEditTrab">
    <h5>Autor(es): </h5>
  </div>
  Esta é a ordem dos autores no trabalho.<br>
    <table class="tab_autor">
      <tr>
        <th class="sub_autor">
          Id
        </th>
        <th class="sub_autor">
          Nome
        </th>
        <th class="sub_autor">
          E-mail
        </th>
        <th class="sub_autor">
          Instituição/Campus/Curso
        </th>
      </tr>

      <?php foreach ($autores_do_trabalho as $autor_curso): ?>
      <tr>
        <td><?=$autor_curso->fk_autor?></td>
        <td><?=$autor_curso->nome_usuario?></td>
        <td><?=$autor_curso->email_trabalho?></td>
        <td>(<?=$autor_curso->sigla."/".$autor_curso->nome_campus."/".$autor_curso->nome_curso?>)</td>
      </tr>
      <?php endforeach;?>
        
    </table>

  <br/>
  <div class = "tituloEditTrab">
    <h5>Orientador/co-orientador: </h5>
  </div>
    <table class="tab_orientador">
      <tr>
        <th  class="sub_orientador">
          Id
        </th>
        <th  class="sub_orientador">
          Nome
        </th>
        <th  class="sub_orientador">
          E-mail
        </th>
        <th  class="sub_orientador">
          Instituição/Campus
        </th>
        <th  class="sub_orientador">
          Orientador/<br>co-orientador
        </th>
      </tr>

      <?php $quant_orientadores = 0; ?>
      <?php foreach ($orientadores_do_trabalho as $orientador_campus):?>
        <?php 
          $quant_orientadores++;
          if ($quant_orientadores==1) {
            $orientador_coorientador="orientador";
          }
          else {
            $orientador_coorientador="co-orientador";
          }
        ?>
        <tr>
          <td><?=$orientador_campus->fk_orientador?></td>
          <td><?=$orientador_campus->nome_usuario?></td>
          <td><?=$orientador_campus->email_trabalho?></td>
          <td>(<?=$orientador_campus->sigla."/".$orientador_campus->nome_campus?>)</td>
          <td>(<?=$orientador_coorientador?>)</td>
        </tr>
      <?php endforeach;?>

      <?php if ($quant_orientadores == 0) : ?>
        <tr><td colspan=5><span style='color:red; font-size:14px;'>Deve ser incluído pelo menos um orientador no trabalho.<br>
        <?php if ($habilita_botao_editar_trabalho) : ?>    
          Clique no botão Editar, logo abaixo, para incluir o(s) orientador(es).</span></td></tr>
        <?php endif; ?>
      <?php endif; ?>
      
    </table>

  <br/>
  <div class = "tituloEditTrab">
    <h5>Turnos preferenciais para apresentação do trabalho:</h5>
  </div>
    <table class="tab_autor">
      <tr>
        <th class="sub_autor">Primeira preferência:</th>
        <th class="sub_autor">Segunda preferência:</th>
        <th class="sub_autor">Terceira preferência:</th>
      </tr>

      <tr>
        <td><?php echo $GLOBALS["arr_turnos"][$trabalho->getTurno1()]; ?></td>
        <td><?php echo $GLOBALS["arr_turnos"][$trabalho->getTurno2()]; ?></td>
        <td><?php echo $GLOBALS["arr_turnos"][$trabalho->getTurno3()]; ?></td>
      </tr>

    </table>

  <br/>
  <div class = "tituloEditTrab">
    <h5>Estado do Trabalho:
    <span class="texto-info">
      <?php 
      //Jean <<<<<< como definir e pegar as constantes?
<<<<<<< HEAD

      echo mostra_status_trabalho($trabalho->getStatus(), false);
      //$arr_status_trab = $GLOBALS["arr_status_trab"];
      //$arr_status_trab_completo = $GLOBALS["arr_status_trab_completo"];
      //echo $arr_status_trab[$trabalho->getStatus()];
=======
      $arr_status_trab = $GLOBALS["arr_status_trab"];
      $arr_status_trab_completo = $GLOBALS["arr_status_trab_completo"];
      //echo $arr_status_trab[$trabalho->getStatus()]; 
      echo $arr_status_trab[$trabalho->getStatus()];
>>>>>>> f9b405479b0aa4f88530d1c9535f52b197308e2e
      ?>
    </span></h5>
    
  </div>
<<<<<<< HEAD
  <div class="edit_b"><p><?=mostra_status_trabalho_completo($trabalho->getStatus(), false)?></p></div>
=======
  <div class="edit_b"><p><?=$arr_status_trab_completo[$trabalho->getStatus()]?></p></div>
>>>>>>> f9b405479b0aa4f88530d1c9535f52b197308e2e
  </div>

<table class="table_acoes" border="0">
  <tr><th colspan="2" class="sub_autor"><h5>Possíveis ações sobre o trabalho</h5></th></tr>

  <?php if ($mostrar_botao_editar_trabalho): ?>
    <tr>
    <td class="t_botoes">
      <a href="<?=base_url().'trabalho/trabalho_ctr/edicao/'.$trabalho->getIdTrabalho()?>" class="btn btn-primary" id="botao_editar_trabalho" >
        Modificar...
      </a>
    </td>
    <td>
      Permite fazer modificações no trabalho, bem como adicionar ou remover coautores e orientadores.
    </td>
    </tr>
  <?php endif; ?>
    
  <?php if ($mostrar_botao_enviar_trabalho): ?>
    <tr>
    <td class="t_botoes">
     <a href="#" onclick="enviar_trabalho(<?=$trabalho->getIdTrabalho()?>, <?=$quant_orientadores?>)" class="btn btn-primary" id="botao_enviar_trabalho">
      Enviar...
    </a>
    </td>
    <td>
      Envia o trabalho para que o orientador efetue a VALIDAÇÃO.<br>
      ATENÇÃO: Após enviar o trabalho não é possível efetuar quaisquer outras modificações.
    </td>
    </tr>
  <?php endif; ?>

  <?php if ($mostrar_botao_validar_trabalho): ?>
    <tr>
    <td class="t_botoes">
    <a href="#" onclick="validar_trabalho(<?=$trabalho->getIdTrabalho()?>)" class="btn btn-primary" id="botao_validar_trabalho">
      Validar...
    </a>
    </td>
    <td>
      Valida o trabalho submetido por seu orientando, permitindo à comissão organizadora do evento efetuar a análise do trabalho.<br>
      ATENÇÃO: Após VALIDAR o trabalho não será possível efetuar quaisquer modificações no mesmo.
    </td>
    </tr>
  <?php endif; ?>

  <?php if ($mostrar_botao_invalidar_trabalho): ?>
    <tr>
    <td class="t_botoes">
    <a href="#" onclick="invalidar_trabalho(<?=$trabalho->getIdTrabalho()?>)" class="btn btn-primary" id="botao_invalidar_trabalho">
      Invalidar...
    </a>
    </td>
    <td>
      Invalida (rejeita) o trabalho submetido por seu orientando.<br>
      ATENÇÃO: Após INVALIDAR o trabalho não será possível efetuar quaisquer modificações no mesmo, nem tampouco enviar o trabalho novamente.
    </td>
    </tr>
  <?php endif; ?>

  <?php if ($mostrar_botao_corrigir_trabalho): ?>
    <tr>
    <td class="t_botoes">
    <a href="#" onclick="pender_trabalho(<?=$trabalho->getIdTrabalho()?>)" class="btn btn-primary" id="botao_corrigir_trabalho">
      Refazer...
    </a>
    </td>
    <td>
      Coloca o trabalho no estado PENDENTE para permitir ao autor efetuar modificações. O autor deverá ENVIAR novamente o trabalho e o orientador deverá VALIDAR ou INVALIDAR o trabalho.<br>
    </td>
    </tr>
  <?php endif; ?>

<<<<<<< HEAD
    <!--
  <tr>
  <td class="t_botoes">
   <button class="btn btn-primary" id="botao_exportar_pdf" type="button">Salvar PDF...</button>
   <a href="<?=base_url()?>trabalho/trabalho_ctr/ver_prepara_pdf/<?=$trabalho->getIdTrabalho()?>" class="btn btn-primary" id="botao_exportar_pdf" target="_blank">Salvar PDF...</a>
   <a href="<?=base_url()?>trabalho/trabalho_ctr/gerar_pdf/<?=$trabalho->getIdTrabalho()?>" class="btn btn-primary" id="botao_exportar_pdf" target="_blank">Salvar PDF2...</a>

=======
    
  <tr>
  <td class="t_botoes">
   <!-- <button class="btn btn-primary" id="botao_exportar_pdf" type="button">Salvar PDF...</button> -->
   <a href="<?=base_url()?>trabalho/trabalho_ctr/ver_prepara_pdf/<?=$trabalho->getIdTrabalho()?>" class="btn btn-primary" id="botao_exportar_pdf" target="_blank">Salvar PDF...</a>
   <a href="<?=base_url()?>trabalho/trabalho_ctr/gerar_pdf/<?=$trabalho->getIdTrabalho()?>" class="btn btn-primary" id="botao_exportar_pdf" target="_blank">Salvar PDF2...</a>
>>>>>>> f9b405479b0aa4f88530d1c9535f52b197308e2e
  </td>
  
  <td>
    Baixa o trabalho em formato PDF.
  </td>
  </tr>
<<<<<<< HEAD
-->  
=======
  
>>>>>>> f9b405479b0aa4f88530d1c9535f52b197308e2e
  
  <tr>
    <td class="t_botoes">
    <a href="<?=$url_voltar?>" class="btn btn-danger" id="botao_voltar" >Voltar</button>
    </td>
    <td>
      Retorna à tela anterior.
    </td>
  </tr>
</table>
          
<!--
  <div class="form-group text-right">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="button" onclick="history.back()" class="btn btn-danger">Voltar</button>
    </div>
  </div>
-->

<?=$this->load->view('./modal_buscar_coautor.html.php')?>
<script src="<?=base_url()?>content/trabalho.js" type="text/javascript"></script>
<?=$this->load->view('../../../templates/footer.html.php')?>
</div>
