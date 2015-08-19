<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=8" />
        <link rel="shortcut icon" media="all" type="image/x-icon" href="<?=base_url()?>content/favicon.png" >
        <link rel="stylesheet" type="text/css" href="<?=  base_url().'/content/estilo_mostratec.css'?>" />
        <link rel="stylesheet" type="text/css" href="<?=  base_url().'/content/botao_gerar.css'?>" />
        <script src="<?=  base_url().'vendor/frameworks/jquery/jquery.min.js'?>" type="text/javascript"></script>
        <script src="<?= base_url() .'vendor/digitalBush/jquery.maskedinput.min.js'?>"></script>
        <title>16ª Mostra de Pesquisa, Ensino e Extensão - IFRS - Porto Alegre</title>
    </head>

    <body style="background-color: #FFFFFF;">
        
    <div class="cont_pdf">
          <input type="hidden" id="base_url" value="<?=base_url()?>" />

          <script type="text/javascript">
              window.base_url = $('#base_url').val();
          </script>

    <div class = "logo_trabalho_pdf">
          <div class="logo_pdf"><img src="<?= base_url()?>content/logo.fw.png" style="width: 235px; heigth: 85px;" /></div>
          <div class="trab_ac_pdf"><span>Trabalho aceito para apresentação na 16ª Mostra de Pesquisa, Ensino e Extensão<br>
          Instituto Federal de Educação, Ciência e Tecnologia do Rio Grande do Sul<br>
          Câmpus Porto Alegre<br>
          28 e 29 setembro de 2015
          </span></div>
          <p>&nbsp; </p>
    </div>

    <div class="trabalho_pdf">
      <p class = "trab_ac_pdf">Trabalho número: <span class = "trab_ac_pdf2"><?php echo $trabalho->id_trabalho; ?></span></p>
      <p>&nbsp; </p>
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


    <p>Instituto Federal de Educação, Ciência e Tecnologia do Rio Grande do Sul</p>
    <p>Câmpus: Porto Alegre</p>
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


          <?php if ($quant_orientadores == 0) : ?>
            <tr><td colspan=4><span style='color:red; font-size:14px;'>Deve ser incluído pelo menos um orientador.<br>
            <?php if ($habilita_botao_editar_trabalho) : ?>    
              Clique no botão Editar, logo abaixo, para incluir o(s) orientador(es).</span></td></tr>
            <?php endif; ?>
          <?php endif; ?>
<!--
        <div class="botao_gerar_pdf">
          <input type="button" value="Gerar PDF" class="button_gerar azul_um">
          <input type="hidden">
          <input type="button" value="Voltar" class="button_gerar vermelho_tres">
        </div>
-->
    </div>

    

</body>
</html>
