<?=$this->load->view('../../../templates/header.html.php')?>
<<<<<<< HEAD
<?=$this->load->helper('funcoes_ver_trabalho')?>
=======
>>>>>>> f9b405479b0aa4f88530d1c9535f52b197308e2e
<?=modules::run('usuario/usuario_ctr/area_geral')?>
<?php /* echo set_breadcrumb(); */ ?>

<article>

  <h4 align="center">Área do Autor - Inscrição de Trabalhos</h4>

  <h4 align="center" style="color:#FF0000;">ATENÇÃO:</h4>
  
  <h5  align="center" style="color:#FF0000;">
    Somente o autor principal (primeiro autor) do trabalho deverá efetuar a inscrição do trabalho.
    <br>
    Os demais coautores, o orientador principal e o co-orientador (se houver) 
    <br>
    deverão ser vinculados ao trabalho SOMENTE pelo autor principal (primeiro autor).
  </h5>

  <?=$this->load->view('../info_fluxo_trabalho.html.php')?>
  
    <h4 align="center">Lista de trabalhos que você está vinculado como autor principal (primeiro autor) ou co-autor.</h4>
    
     <table class="table_autor">
       
      <tr>
        <th>Id</th>
        <th class="t_trabalho">Título do Trabalho</th>
        <th>Status</th>
        <th>Vinculação</th>
        <th>Ver/Modificar/Enviar...</th>
      </tr>
      
      <?php foreach ($trabalhos as $trabalho): ?>
        <tr>
          <?php      
          if ($trabalho->seq_trabalho == 1) {
            $texto_autor_coautor = "autor";
          }
          else {
            $texto_autor_coautor = "coautor";
          }
          ?>
          <td><?=$trabalho->id_trabalho?></td>
          <td class="t_trabalho"><?=$trabalho->titulo?></td>
<<<<<<< HEAD
          <td><?=mostra_status_trabalho($trabalho->status, false)?></td> 
          
          
=======
          <td><?=strtoupper($GLOBALS['arr_status_trab'][$trabalho->status])?></td> 
>>>>>>> f9b405479b0aa4f88530d1c9535f52b197308e2e
          <td>(<?=$texto_autor_coautor?>)</td> 
          <td>
            <a href="<?=base_url().'./trabalho/trabalho_ctr/ver/'.$trabalho->id_trabalho?>">
            <?php if($texto_autor_coautor=="autor"): ?>
              <!-- HTML do if texto_autor_coautor -->
              Ver/Modificar/Enviar...
            <?php else: ?>
              <!--- HTML do else texto_autor_coautor -->
              Ver...
            <?php endif; ?>
            </a>
          </td>
        </tr>
      <?php endforeach; ?>
        
    </table>
  
    <br>
    <br>
      <a href="<?=base_url()?>trabalho/trabalho_ctr/inscricao" class="btn btn-primary">Fazer inscrição de trabalho ...</a>

        
</article>
<input type="hidden" name="papel_corrente" value="autor" />
<?=$this->load->view('../../../templates/footer.html.php')?>
