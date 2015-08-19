<<<<<<< HEAD
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=8" />
        <meta charset="UTF-8" />
        <link rel="shortcut icon" media="all" type="image/x-icon" href="<?=base_url()?>content/favicon.png" >
        <link rel="stylesheet" type="text/css" href="<?=  base_url().'vendor/twitter/bootstrap/dist/css/bootstrap.css' ?>" />
        <link rel="stylesheet" type="text/css" href="<?=  base_url().'/content/estilo_mostratec.css'?>" />
        <script src="<?=  base_url().'vendor/frameworks/jquery/jquery.min.js'?>" type="text/javascript"></script>
        <script src="<?= base_url() .'vendor/digitalBush/jquery.maskedinput.min.js'?>"></script>
        <title>16ª Mostra de Pesquisa, Ensino e Extensão - IFRS - Porto Alegre</title>
    </head>
    <body>

        <div id="conteudo">
            <div id="header">
                <div id="logo">
                    <a href="<?=base_url()?>"><img alt="logo" src="<?=  base_url().'content/logo.fw.png'?>" width="235" height="60"/></a>
                </div>
                <div id="frase">16ª Mostra de Pesquisa, Ensino e Extensão<br/>IFRS Câmpus Porto Alegre</div>
            </div>
        
        <div id="inner_content">
          <h3 style="color:red;" align="center">
            Atenção ! INSCRIÇÕES PRORROGADAS!<br>
            As inscrições de autores e orientadores bem como o envio de trabalhos foram prorrogadas até 20/08/2015.</h3>
          <!-- Alertas -->
         <?php if ($this->session->flashdata('aviso')) :?>
            <div class="alert alert-warning fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <strong>Aviso!</strong> <?=$this->session->flashdata('aviso')?>
            </div>
         <?php endif;?>
         <?php if ($this->session->flashdata('erro')) :?>
            <div class="alert alert-danger fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <strong>Erro!</strong> <?=$this->session->flashdata('erro')?>
            </div>
         <?php endif;?>
         <?php if ($this->session->flashdata('sucesso')) :?>
            <div class="alert alert-success fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <strong>Sucesso!</strong> <?=$this->session->flashdata('sucesso')?>
            </div>
         <?php endif;?>
        
        <input type="hidden" id="base_url" value="<?=base_url()?>" />
        <script type="text/javascript">
        
            window.base_url = $('#base_url').val();
=======
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=8" />
        <meta charset="UTF-8" />
        <link rel="shortcut icon" media="all" type="image/x-icon" href="<?=base_url()?>content/favicon.png" >
        <link rel="stylesheet" type="text/css" href="<?=  base_url().'vendor/twitter/bootstrap/dist/css/bootstrap.css' ?>" />
        <link rel="stylesheet" type="text/css" href="<?=  base_url().'/content/estilo_mostratec.css'?>" />
        <script src="<?=  base_url().'vendor/frameworks/jquery/jquery.min.js'?>" type="text/javascript"></script>
        <script src="<?= base_url() .'vendor/digitalBush/jquery.maskedinput.min.js'?>"></script>
        <title>16ª Mostra de Pesquisa, Ensino e Extensão - IFRS - Porto Alegre</title>
    </head>
    <body>

        <div id="conteudo">
            <div id="header">
                <div id="logo">
                    <a href="<?=base_url()?>"><img alt="logo" src="<?=  base_url().'content/logo.fw.png'?>" width="235" height="60"/></a>
                </div>
                <div id="frase">16ª Mostra de Pesquisa, Ensino e Extensão<br/>IFRS Câmpus Porto Alegre</div>
            </div>
        
        <div id="inner_content">
            
          <!-- Alertas -->
         <?php if ($this->session->flashdata('aviso')) :?>
            <div class="alert alert-warning fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <strong>Aviso!</strong> <?=$this->session->flashdata('aviso')?>
            </div>
         <?php endif;?>
         <?php if ($this->session->flashdata('erro')) :?>
            <div class="alert alert-danger fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <strong>Erro!</strong> <?=$this->session->flashdata('erro')?>
            </div>
         <?php endif;?>
         <?php if ($this->session->flashdata('sucesso')) :?>
            <div class="alert alert-success fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <strong>Sucesso!</strong> <?=$this->session->flashdata('sucesso')?>
            </div>
         <?php endif;?>
        
        <input type="hidden" id="base_url" value="<?=base_url()?>" />
        <script type="text/javascript">
        
            window.base_url = $('#base_url').val();
>>>>>>> f9b405479b0aa4f88530d1c9535f52b197308e2e
        </script>