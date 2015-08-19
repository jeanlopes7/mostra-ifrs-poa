<html>
    <head>
      <style type="text/css">
        @charset "UTF-8";

        body, html{
            margin: 0;
            padding: 0;
        }

        .cont_pdf{
            width: 210mm;
            height: 297mm;
            margin: 12.5mm auto;
            padding: 12.5mm;
            background-color: #FFFFFF;
            /*
            border: 1px solid #C3E191;
            border-radius: 7px;*/
        }

        <?php 
              include_once "topo_pdf.html.php";
              include_once "logo_pdf.html.php";
              include_once "tela_pdf.html.php";
              include_once "rodape_pdf.html.php";
        ?>