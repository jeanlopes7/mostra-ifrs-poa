<?=$this->load->view('../../../templates/header.html.php')?>
<?=modules::run('usuario/usuario_ctr/area_geral')?>
<?php /* echo set_breadcrumb(); */ ?>

<article>
    <h4 align="center">Área do Orientador - Validação de Trabalho</h4>
    
  <h4 align="center" style="color:#FF0000;">ATENÇÃO:</h4>
  
  <h5  align="center" style="color:#FF0000;">
    O orientador do trabalho deverá fazer a VALIDAÇÃO do trabalho para que este possa ser analisado pela comissão organizadora do evento.

  </h5>


  <?=$this->load->view('../info_fluxo_trabalho.html.php')?>
  
    <h4 align="center">Lista de trabalhos que você está vinculado como orientador principal (primeiro orientador) ou co-orientador.</h4>
    
    <table class="table_orientador">

      <tr>
        <th>Id</th>
        <th class="t_trabalho">Título do Trabalho</th>
        <th>Status</th>
        <th>Vinculação</th>
        <th>Ver/Validar...</th>
      </tr>

      <?php 
      foreach ($trabalhos as $trabalho) {
      ?>
      
        <?php      
        if ($trabalho->seq_trabalho == 1) {
          $texto_orientador_coorientador = "orientador";
        }
        else {
          $texto_orientador_coorientador = "co-oorientador";
        }
        ?>
      
      <tr>
        <td>
          <?=$trabalho->id_trabalho?>
        </td>
        
        <td>
          <?=$trabalho->titulo?>
        </td>
        
        <td>
          <?=strtoupper($GLOBALS["arr_status_trab"][$trabalho->status])?>
        </td> 
        
        <td>
          (<?=$texto_orientador_coorientador?>)
        </td>
        
        <td>
          <a href="<?=base_url().'./trabalho/trabalho_ctr/ver/'.$trabalho->id_trabalho?>">
            <?php if($texto_orientador_coorientador=="orientador"): ?>
              <!-- HTML do if texto_orientador_coorientador -->
              Ver/Validar...
              </a>
            <?php else: ?>
              <!--- HTML do else texto texto_orientador_coorientador -->
              Ver...
            <?php endif; ?>
          </a>
        </td>
        
      </tr>

      <?php 
      } //for 
      ?>
    </table>

    </p>
    
</article>
<input type="hidden" name="papel_corrente" value="orientador" />
<?=$this->load->view('../../../templates/footer.html.php')?>