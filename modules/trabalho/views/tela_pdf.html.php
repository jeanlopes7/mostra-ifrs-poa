

        <td class="trab_ac_pdf" align="right" width="80%">
          <span>Trabalho aceito para apresentação na 16ª Mostra de Pesquisa, 
          Ensino e Extensão<br>Instituto Federal de Educação, Ciência e 
          Tecnologia do Rio Grande do Sul<br>Câmpus Porto Alegre<br>
          28 e 29 setembro de 2015
          </span>
        </td>
      </table>

    <div class="trabalho_pdf">
      <p class = "trab_ac_pdf">
        Trabalho número: <span><?php echo $trabalho->id_trabalho; ?></span>
      </p>
    </div>
        
    <div class = "trabalho_pdf_titulo">
      <p><?php echo $trabalho->titulo; ?></p>
    </div>

    <div class="trabalho_pdf">
      <?php
      foreach ($autores_do_trabalho as $autor_curso) {
        echo $autor_curso->nome_usuario.", ";
      }
      ?>
                
      <?php
      $quant_orientadores = 0;
      foreach ($orientadores_do_trabalho as $orientador_campus) {
        $quant_orientadores++;
        echo $orientador_campus->nome_usuario.", ";
        }//for
      ?>
            
              <br>
              <br>
      <?php
      foreach ($autores_do_trabalho as $autor_curso) {
        echo $autor_curso->email_trabalho.", ";
      }
      ?>
              
                
      <?php
      $quant_orientadores = 0;
      foreach ($orientadores_do_trabalho as $orientador_campus) {
        $quant_orientadores++;
        echo $orientador_campus->email_trabalho.", ";
        }//for
      ?>


      <p>
        Instituto Federal de Educação, Ciência e Tecnologia do Rio Grande do Sul<br>
        Câmpus: Porto Alegre
      </p>

    </div>
      <div class = "trabalho_pdf_resumo">
        <p><?php echo $trabalho->resumo; ?></p>
      </div>

      <div class = "trabalho_pdf_rodape">
        <p>Palavras-Chave: <?=$trabalho->palavra1.", ".$trabalho->palavra2.", ".$trabalho->palavra3; ?></p>
      </div>

      <div class = "trabalho_pdf_rodape">
        <p>Apoiadores: <?=$trabalho->apoiadores; ?></p>
      </div>