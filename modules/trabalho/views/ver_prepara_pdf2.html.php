<<<<<<< HEAD
<html>
=======

>>>>>>> f9b405479b0aa4f88530d1c9535f52b197308e2e
    <style type="text/css">
      @charset 'UTF-8';
      body{
          margin:0;
          padding:0;
      }
      a img{
          border:none;
      }

<<<<<<< HEAD

      .cont_pdf{
          width: 210mm;
          height: 297mm;
          margin: 2.5cm;

          /*border: 1px solid #C3E191;
          border-radius: 7px;*/
      }

=======
>>>>>>> f9b405479b0aa4f88530d1c9535f52b197308e2e
      .logo_trabalho_pdf{
        width: 100%;
      }
      .logo_pdf{
          float: left;
          width: 235px;
      }

      .logo_pdf img{
        width: 235px;
        height: 62px;
        float: left;
      }

      .trab_ac_pdf{
      float: right;
      width: 450px;
      margin-right: 15px;
      }

      .trab_ac_pdf, .trab_ac_pdf2{
          text-align: right;
          font-size: 12px;
          font-family: 'Times New Roman';
      }

      .trab_ac_pdf2{
          font-weight: bold;
      }
      .trabalho_pdf_titulo{
<<<<<<< HEAD
          width: 100%;
=======
>>>>>>> f9b405479b0aa4f88530d1c9535f52b197308e2e
          text-transform: uppercase;
          text-align: center;
          font-weight: bold;
          font-size: 15px;
          font-family: 'Times New Roman';
      }
      .trabalho_pdf{
          text-align: center;
          font-size: 15px;
          font-family: 'Times New Roman';
      }
      .trabalho_pdf_resumo{
          text-align: justify;
          font-size: 15px;
          font-family: 'Times New Roman';
      }
      .trabalho_pdf_rodape{
          text-align: left;
          margin-left: 30px;
          font-size: 15px;
          font-family: 'Times New Roman';
      }
    </style>
<<<<<<< HEAD
    <div class="cont_pdf">
=======

>>>>>>> f9b405479b0aa4f88530d1c9535f52b197308e2e
        <input type="hidden" id="base_url" value="<?=base_url()?>" />

        <script type="text/javascript">
            window.base_url = $('#base_url').val();
        </script>

         <table class = "logo_trabalho_pdf">
          <tr>
              <td class="logo_pdf"><img src="C://xampp/htdocs/mostra-ifrs-poa/content/logo.png" /></td>
              <td class="trab_ac_pdf"><span>Trabalho aceito para apresentação na 16ª Mostra de Pesquisa, Ensino e Extensão<br>
              Instituto Federal de Educação, Ciência e Tecnologia do Rio Grande do Sul<br>
              Câmpus Porto Alegre<br>
              28 e 29 setembro de 2015
<<<<<<< HEAD
              </span></td></tr>
          <tr>
              <td><p class="trab_ac_pdf">Trabalho número: <span class = "trab_ac_pdf2"><?php echo $trabalho->id_trabalho; ?></span></p></td>
          </tr>
=======
              </span></td>
          </tr>
          <p class="trab_ac_pdf">Trabalho número: <span class = "trab_ac_pdf2"><?php echo $trabalho->id_trabalho; ?></span></p>
>>>>>>> f9b405479b0aa4f88530d1c9535f52b197308e2e
    <p>&nbsp; </p>
    </div>
  </table>
        
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


    <p>Instituto Federal de Educação, Ciência e Tecnologia do Rio Grande do Sul<br/>Câmpus: Porto Alegre</p>
    </div>
      <div class = "trabalho_pdf_resumo">
        <p><?php echo $trabalho->resumo; ?></p>
      </div>

      <div class = "trabalho_pdf_rodape">
        <p>Palavras-Chave: <?=$trabalho->palavra1.", ".$trabalho->palavra2.", ".$trabalho->palavra3; ?>
        <br><br>Apoiadores: <?=$trabalho->apoiadores; ?></p>
      </div>
<<<<<<< HEAD
      </div>
</html>
=======
>>>>>>> f9b405479b0aa4f88530d1c9535f52b197308e2e
