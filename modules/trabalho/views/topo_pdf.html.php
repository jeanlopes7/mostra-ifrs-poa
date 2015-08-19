        .logo_pdf{
            background-image : url(/../../../content/logo.png);
            float: left;
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
            text-transform: uppercase;
            text-align: center;
            font-weight: bold;
            font-size: 16px;
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
            font-size: 15px;
            font-family: 'Times New Roman';
        }
        /*.botao_gerar_pdf{
            margin-bottom: 12%;
          }*/

/* button_gerar 
---------------------------------------------- */
.button_gerar {
    display: inline-block;
    zoom: 1; /* zoom and *display = ie7 hack for display:inline-block */
    *display: inline;
    vertical-align: baseline;
    margin: 2px;
    outline: none;
    cursor: pointer;
    text-align: center;
    text-decoration: none;
    font: 14px/100% Arial, Helvetica, sans-serif;
    padding: 10px;
    width: 100px;
    text-shadow: 0 1px 1px rgba(0,0,0,.3);
    -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.2);
    -moz-box-shadow: 0 1px 2px rgba(0,0,0,.2);
    box-shadow: 0 1px 2px rgba(0,0,0,.2);
    text-align: center;
    border-radius: 7px;
}
.button_gerar:hover {
    text-decoration: none;
}
.button_gerar:active {
    position: relative;
    top: 1px;
}
.med_gerar {
    font-size: 12px;
    padding: .4em 1.5em .42em;
}
.small_gerar {
    font-size: 11px;
    padding: .2em 1em .275em;
}

.azul_um {
    color: #d9eef7;
    border: solid 1px #0076a3;
    background: #0095cd;
    background: -webkit-gradient(linear, left top, left bottom, from(#00adee), to(#0078a5));
    background: -moz-linear-gradient(top,  #00adee,  #0078a5);
    filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#00adee', endColorstr='#0078a5');
}
.azul_um:hover {
    background: #007ead;
    background: -webkit-gradient(linear, left top, left bottom, from(#0095cc), to(#00678e));
    background: -moz-linear-gradient(top,  #0095cc,  #00678e);
    filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#0095cc', endColorstr='#00678e');
}
.azul_um:active {
    color: #80bed6;
    background: -webkit-gradient(linear, left top, left bottom, from(#0078a5), to(#00adee));
    background: -moz-linear-gradient(top,  #0078a5,  #00adee);
    filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#0078a5', endColorstr='#00adee');
}
.vermelho_dois {
    color: #faddde;
    border: solid 1px #980c10;
    background: #d81b21;
    background: -webkit-gradient(linear, left top, left bottom, from(#ed1c24), to(#aa1317));
    background: -moz-linear-gradient(top,  #ed1c24,  #aa1317);
    filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#ed1c24', endColorstr='#aa1317');
}
.vermelho_dois:hover {
    background: #b61318;
    background: -webkit-gradient(linear, left top, left bottom, from(#c9151b), to(#a11115));
    background: -moz-linear-gradient(top,  #c9151b,  #a11115);
    filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#c9151b', endColorstr='#a11115');
}
.vermelho_dois:active {
    color: #de898c;
    background: -webkit-gradient(linear, left top, left bottom, from(#aa1317), to(#ed1c24));
    background: -moz-linear-gradient(top,  #aa1317,  #ed1c24);
    filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#aa1317', endColorstr='#ed1c24');
}



      </style>
      <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
    </head>

    <body>
        
    <div class="cont_pdf">
          <input type="hidden" id="base_url" value="<?=base_url()?>" />

          <script type="text/javascript">
              window.base_url = $('#base_url').val();
          </script>

      <table class = "logo_trabalho_pdf" width="100%">
      <tr>


     