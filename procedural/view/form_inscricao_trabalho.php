<?php

session_start();
require_once '../controller/constantes_URL.php';
require_once '../controller/constantes.php';

if (isset($_SESSION['acao_form_inscricao_trabalho'])) {
  $acao_form_inscricao_trabalho = $_SESSION['acao_form_inscricao_trabalho'];
  $acao = "../controller/ControllerTrabalho.php?acao=" . $acao_form_inscricao_trabalho;
}
else {
  $acao_form_inscricao_trabalho = null;
  $acao = null;
}

//Verifica se usuário está logado.
if (!isset($_SESSION['id_usuario'])) {
  header("Location: " . HOME . "index.php");
  exit;
}

//Se usuário não for um autor entao sai.
if (!isset($_SESSION['is_papel_autor'])) {
  header("Location: " . HOME . "index.php");
  exit;
}

//Se SESSION trabalho existe, então é para editar trabalho.
if (isset($_SESSION['trabalho'])) {
  $id_trabalho = $_SESSION['id_trabalho'];
  //Se o usuário não for o autor principal então sai.
  if (!$_SESSION['is_autor_principal_do_trabalho']){
    header("Location: " . HOME . "index.php");
    exit;
  }
}
else {
  $id_trabalho = -1;  
}
 
//$HOME = '../';
include 'cabecalho.php';
        
//Pega ID do usuário logado.
$id_usuario = $_SESSION['id_usuario'];
//Pega os cursos do usuario (autor) logado.
$cursos_autor_logado = $_SESSION['cursos_autor_logado'];

$areas = $_SESSION['areas'];
$categorias = $_SESSION['categorias'];
$modalidades = $_SESSION['modalidades'];

//Se SESSION trabalho existe, então é para editar trabalho.
if (isset($_SESSION['trabalho'])) {

  $trab = $_SESSION['trabalho'];
  $autores_cursos_do_trabalho = $_SESSION['autores_cursos_do_trabalho'];
  
  if (isset($_SESSION['orientadores_campus_do_trabalho']))
    $orientadores_campus_do_trabalho = $_SESSION['orientadores_campus_do_trabalho'];
  else
    $orientadores_campus_do_trabalho = null;

  //Pega dados do trabalho.
  $titulo = $trab->titulo;
  $palavra1 = $trab->palavra1;
  $palavra2 = $trab->palavra2;
  $palavra3 = $trab->palavra3;
  $titulo = $trab->titulo;
  $resumo = $trab->resumo;
  $id_area = $trab->fk_area;
  $id_categoria = $trab->fk_categoria;
  $id_modalidade = $trab->fk_modalidade;
  $apoiadores = $trab->apoiadores;

  //Pega dados do autor principal cadastrados no trabalho.
  $id_curso = $autores_cursos_do_trabalho[0]->fk_curso;
  $email_trabalho = $autores_cursos_do_trabalho[0]->email_trabalho;
} else {
  //SESSION trabalho nao existe, então vai cadastrar um novo trabalho.
  $titulo = "";
  $resumo = "";
  $palavra1 = "";
  $palavra2 = "";
  $palavra3 = "";
  $id_area = 0;
  $id_categoria = 0;
  $id_modalidade = 0;
  $apoiadores = "";

  $id_curso = 0;
  $email_trabalho = "";
}
?>

<script >

  function validaTrabalho() {
    h = document.form_trabalho;
    
    if (h.curso.value == "0") {
      alert('Por favor, selecione um Curso.');
      //h.curso.focus();
      return false;
    }

    if (h.email_trabalho.value == "") {
      alert('Por favor, preencha o email do trabalho.');
      h.email_trabalho.focus();
      return false;
    }
    if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(h.email_trabalho.value))) {
      alert("Favor digitar um endereço de e-mail válido.");
      h.email_trabalho.focus();
      return false;
    }
    if (h.area.value == "0") {
      alert('Por favor, selecione a área temática do trabalho.');
      h.area.focus();
      return false;
    }
    if (h.categoria.value == "0") {
      alert('Por favor, selecione a categoria do trabalho.');
      h.categoria.focus();
      return false;
    }
    if (h.modalidade.value == "0") {
      alert('Por favor, selecione a modalidade do trabalho.');
      h.modalidade.focus();
      return false;
    }
    
    turno_1 = h.turno1[0].checked + h.turno1[1].checked*2 + h.turno1[2].checked*4;
    turno_2 = h.turno2[0].checked + h.turno2[1].checked*2 + h.turno2[2].checked*4;
    turno_3 = h.turno3[0].checked + h.turno3[1].checked*2 + h.turno3[2].checked*4;
    if ( (turno_1 + turno_2 + turno_3) != 7 ) {
      alert('Você deve escolher obrigatoriamente três turnos diferentes para apresentação.');
      return false;
    }
    
    if (turno_1 == 0) {
      alert('Por favor, selecione o primeiro turno preferencial.');
      h.turno1.focus();
      return false;
    }
    if (turno_2 == 0) {
      alert('Por favor, selecione o segundo turno preferencial.');
      h.turno2.focus();
      return false;
    }
    if (turno_3 == 0) {
      alert('Por favor, selecione o terceiro turno preferencial.');
      h.turno3.focus();
      return false;
    }
    /*if(h.palavra1.value == "") {
     alert('Por favor, preencha a primeira palavra-chave do trabalho.');
     h.palavra1.focus();
     return false;
     }
     if(h.palavra2.value == "") {
     alert('Por favor, preencha a segunda palavra-chave do trabalho.');
     h.palavra2.focus();
     return false;
     }
     if(h.palavra3.value == "") {
     alert('Por favor, preencha a terceira palavra-chave do trabalho.');
     h.palavra3.focus();
     return false;
     }*/
    /*
     if(h.apoiadores.value == "") {
     alert('Por favor, preencha o campo "apoiadores" do trabalho.');
     h.apoiadores.focus();
     return false;
     }
     */
    return true;
  }//validaTrabalho()

  function salvarTrabalho(acao) {

    if (!validaTrabalho())
      return;

    var form = $("#form_trabalho").serialize();
    var cTitulo = CKEDITOR.instances.titulo.getData();
    var cResumo = CKEDITOR.instances.resumo.getData();
    var str = new Array();
    str.push(form);
    str.push("cTitulo=" + encodeURIComponent(cTitulo));
    str.push("cResumo=" + encodeURIComponent(cResumo));

    //titulo = document.form_trabalho.titulo;
    //resumo = document.form_trabalho.resumo;

    //str.push("titulo=" + titulo);
    //str.push("resumo=" + resumo);
    $.ajax({
      type: "POST",
      url: acao,
      data: str.join("&"),
      success: function(data) {
        if (data == 0) {
          alert('Trabalho salvo com sucesso! Você ainda precisará confirmar o envio do trabalho, acessando a área do Autor, clicar no botão "ver/modificar..." e a seguir clicar no botão "Enviar Trabalho".');
          //window.location = "controller/ControllerTrabalho?acao=ver_trabalho&id_trabalho="+data;
          //window.location = "<?php //echo HOME; ?>controller/ControllerLogin.php";
        }
        else if (data == 1) {
          alert('Erro ao salvar trabalho. Você deve efetuar o login no sistema.');
        }
        else if (data == 2) {
          alert('Período de inscrição de trabalho encerrado');
        }
        else if (data == 3) {
          alert('Erro: somente autores podem efetuar a inscrição de trabalho.');
        }
        else if (data == 5) {
          alert('Erro: curso inválido.');
        }
        else if (data == 6) {
          alert('Erro: turnos inválidos.');
        }
        else if (data == 11) {
          alert('ATENÇÃO: Você já é autor de um trabalho com esta modalidade. Escolha outra modalidade.');
        }
        else if (data == 12) {
          alert('ATENÇÃO: Você já é autor principal de dois trabalhos, que é o máximo permitido.');
        }
        else if (data == 13) {
          alert('ATENÇÃO: Você está tendando trocar a modalidade do trabalho mas já possui um trabalho com esta modalidade. Se for esta a sua inteção, contacte a comissão organizadora para solicitar a troca ou remova o outro trabalho.');
        }
        else if (data < 0) {
          alert("Resumo contém " + (-data) + " caracteres. O máximo permitido é 3000 caracteres.");
        }
        else {
          alert('Erro: código = ' + data);
        }
      }
    });
  }//salvarTrabalho()
  
function showBuscaCoautor() {
	$("#divSombra").show();
	$("#BuscarCoautor").show();
	$("#msg_erroBusca").hide();
}

function showBuscaOrientador() {
	$("#divSombra").show();
	$("#BuscarOrientador").show();
	$("#msg_erroBusca").hide();
}

function hideBuscaCoautor() { 
	$("#divSombra").hide();
	$("#BuscarCoautor").hide();
}

function hideBuscaOrientador() {
	$("#divSombra").hide();
	$("#BuscarOrientador").hide();
}

function buscaCoautor(){
  
    var str = new Array();
    str.push("acao=busca_coautor");
    str.push("nome_autor="+$("#nomeCoautor").val());
    
    $.ajax({
      type: "GET",
      url: '../controller/ControllerTrabalho.php',
      data: str.join("&"),
      success: function(data) {
        if (data == -1) {
          alert('ATENÇÃO: preencha o campo \'nome\' com pelo menos 4 caracteres.');
        } 
        else if(data == -2){
          $("#msg_erroBusca1").show();
        }
        else {
          $("#listBuscaCoautor").html(data);
          $("#resultBuscaCoautor").show();                  
        }
      }
    });
}

function buscaOrientador(){
    var str = new Array();
    str.push("acao=busca_orientador");
    str.push("nome_orientador="+$("#nomeOrientador").val());
    
    $.ajax({
      type: "GET",
      url: '../controller/ControllerTrabalho.php',
      data: str.join("&"),
      success: function(data) {
        if(data == -1) {
          alert('ATENÇÃO: preencha o campo \'nome\' corretamente.');
        }
        else if(data == -2){
          $("#msg_erroBusca2").show();
        } 
        else {
          $("#listBuscaOrientador").html(data);
          $("#resultBuscaOrientador").show();
        }
      }
    });
}

function inserirCoautor(id_autor, id_curso) {
  var str = new Array();
  str.push("acao=inserir_autor");
  str.push("id_autor="+id_autor);
  str.push("id_curso="+id_curso);
    
    $.ajax({
      type: "GET",
      url: '../controller/ControllerTrabalho.php',
      data: str.join("&"),
      success: function(data) {
        if (data == 0) {
          alert("Co-autor inserido com sucesso!");
          location.reload();
        }
        else if(data==-1){
            alert("Erro: -1.");
        } 
        else if(data==-2){
            alert("Erro: Co-autor já cadastrado neste trabaho.");
        } 
        else if(data==-3){
            alert("Erro: O número máximo de autores permitido é 5.");
        } 

        else { 
          alert('Erro: ' + data);
        }
      }
    });
}

function inserirOrientador(id_orientador, id_campus) {
  var str = new Array();
  str.push("acao=inserir_orientador");
  str.push("id_orientador="+id_orientador);
  str.push("id_campus="+id_campus);
  $.ajax({
      type: "GET",
      url: '../controller/ControllerTrabalho.php',
      data: str.join("&"),
      success: function(data) {
        if (data == 0) {
          alert("Orientador inserido com sucesso!");
          location.reload();
        }
        else if(data==-1){
            alert("Erro: -1.");
        } 
        else if(data==-2){
            alert("Erro: Orientador já cadastrado neste trabaho.");
        } 
        else if(data==-3){
            alert("Erro: O número máximo de orientadores permitido é 2.");
        } 
        else { 
          alert('Erro: ' + data);
        }
      }
    });
}//inserirOrientador

function removerCoautor(id_autor){
  if (confirm('Tem certeza que deseja remover este autor?')) {
    var str = new Array;
    str.push("acao=remover_coautor");
    str.push("id_autor="+id_autor);
    $.ajax({
      type: "GET",
      url: '../controller/ControllerTrabalho.php',
      data: str.join("&"),
      success: function(data) {
        if(data==0) {
          location.reload();
        }
        else {
          alert('Erro: ' + data);
        }
      }
    });
  }//if
}//removerCoautor

function removerOrientador(id_orientador){
  if (confirm('Tem certeza que deseja remover o orientador?')) {
    var str = new Array;
    str.push("acao=remover_orientador");
    str.push("id_orientador="+id_orientador);
    $.ajax({
      type: "GET",
      url: '../controller/ControllerTrabalho.php',
      data: str.join("&"),
      success: function(data) {
        if(data==0) {
          location.reload();
        }
        else if (data == -1) {
          alert('Erro: não pode remover o autor principal.');
        }
        else {
            alert('Erro: ' + data);
        }
      }
    });
  }//if confirm()
}//removerOrientador

function retornarAreaAutor(){
  if (confirm('Certifique-se que você já salvou o trabalho, senão os dados serão perdidos. Tem certeza que deseja retornar?')) {
    window.location = "<?php echo HOME; ?>controller/ControllerLogin.php";
  }//if confirm()
}//removerOrientador

</script>

<div id="cont">

  <script>


  </script>


  <div id="divSombra" style="width:100%; height:300%; position:absolute; top:0px; left:0px; z-index: 50; background: black; opacity: 0.7; display:none;"></div>	

  <!------------------------------ BuscarCoautor ------------------------------->
  <div id="BuscarCoautor" style="top:200px; left:10%; width:800px; height:300px; position:absolute; border:1px solid #CCCCCC; z-index: 60; background: white; border-radius: 10px;display:none;padding:5px;">
    <div id="pesquisa">
      <table style="margin-left:20px;">
        <tr><td>
            <span>Pesquisa autor por nome:</span>
            <input type="text" id="nomeCoautor" name="nomeCoautor" style="margin-left:5px;" />
          </td></tr><tr><td>
            <a href="#" class="link1" style="margin-left:5px;text-decoration:underline;" onclick="buscaCoautor(); return false;">Buscar</a>
            <a href="#" class="link1" style="margin-left:10px;text-decoration:underline;" onclick="hideBuscaCoautor(); return false;">Cancelar</a>
          </td></tr>
        <tr><td>
            <div id="msg_erroBusca1" style="color:#ff0000;height:20px;display:none;"><br>
              Não foram encontrados registros relacionados à busca.
            </div></td></tr>
      </table>
    </div>
    <div id="resultBuscaCoautor" style="display:none;width:800px;height:170px;overflow:auto;margin-top:15px;">
      <h4>Resultado:</h4>
      <table id="listBuscaCoautor"></table>
    </div>
  </div>

  <!------------------------------ BuscarOrientador ------------------------------->
  <div id="BuscarOrientador" style="top:200px; left:35%; width:600px; height:300px; position:absolute; border:1px solid #CCCCCC; z-index: 60; background: white; border-radius: 10px;display:none;padding:5px;">
    <table style="margin-left:20px;">
      <tr><td>
          <span>Pesquisa orientador por nome:</span>
          <input type="text" id="nomeOrientador" name="nomeOrientador" style="margin-left:5px;" />
        </td></tr><tr><td>
          <a href="#" class="link1" style="margin-left:5px;text-decoration:underline;" onclick="buscaOrientador();
              return false;">Buscar</a>
          <a href="#" class="link1" style="margin-left:10px;text-decoration:underline;" onclick="hideBuscaOrientador();
              return false;">Cancelar</a>
        </td></tr>
      <tr><td><div id="msg_erroBusca2" style="color:#ff0000;height:20px;display:none;"><br> Não foram encontrados registros relacionados à busca. </div></td></tr>
    </table>
    <div id="resultBuscaOrientador"  style="display:none;width:600px;height:170px;overflow:auto;margin-top:15px;">
      <h4>Resultado:</h4>
      <table id="listBuscaOrientador"></table>
    </div>
  </div>



  <h2>Inscrição de Trabalho </h2>

  <form name="form_trabalho" id="form_trabalho" method="POST">

    <div class="resumo">
      <h4>Título</h4>
      <textarea name="titulo" class="resumotextarea" id="titulo" value="aaa"></textarea>
    </div>

    <div class="resumo">
      <h4>Resumo</h4>
      <textarea name="resumo" class="resumotextarea2" id="resumo"></textarea>
    </div>

    <div id="complemento">
      <h4>Palavras-Chave</h4>
      <p>Palavra 1</p><input type="text" name="palavra1" class="palavraChave" value="<?php echo $palavra1; ?>" /><br /><br />
      <p>Palavra 2</p><input type="text" name="palavra2" class="palavraChave" value="<?php echo $palavra2; ?>"/><br /><br />
      <p>Palavra 3</p><input type="text" name="palavra3" class="palavraChave" value="<?php echo $palavra3; ?>"/>

      <br>
      <br>
      <br>

      <div>Curso: </div>
      <select id="curso" name="curso">
        <option value="0">Selecione</option>
        
        <?php
        
        
        foreach ($cursos_autor_logado as $curso) {
          $select = "";
          if ($curso->fk_curso == $id_curso) {
            $select = "selected";
          }
          echo "<option value='" . $curso->fk_curso . "' $select>" . $curso->nome . "</option>";
        }
        ?>
        
      </select>

      <!--
      <a href="#" class="links" onclick="novo_curso()">Novo</a><br /><br />
      -->

      <p>E-mail a ser publicado no trabalho</p>
      <input type="text" class="email" name="email_trabalho" value="<?php echo $email_trabalho; ?>"/><br /><br />

      
      <p>Área Temática:</p>
      <select class="areaTematica" name="area">
        <option value="0">Selecione</option>
        
        <?php
        foreach ($areas as $area) {
          $selected = "";
          if ($area->id_area == $id_area) {
            $selected = "selected";
          }
          echo "<option value='" . $area->id_area . "' " . $selected . ">" . $area->nome . "</option>";
        }
        ?>
        
      </select>

      <p>Categoria:</p>
      <select class="categoria" name="categoria">
        <option value="0">Selecione</option>
          <?php
          foreach ($categorias as $categoria) {
            $selected = "";
            if ($categoria->id_categoria == $id_categoria) {
              $selected = "selected";
            }
            echo "<option value='" . $categoria->id_categoria . "' " . $selected . ">" . $categoria->nome . "</option>";
          }
          ?>
      </select>

      <!---------------------- Modalidade de Apresentação -------------------------->
      <p>Modalidade de Apresentação:</p>
      <select class="modApresentacao" name="modalidade">
        <option value="0">Selecione</option>
          <?php
          foreach ($modalidades as $modalidade) {
            $selected = "";
            if ($modalidade->id_modalidade == $id_modalidade) {
              $selected = "selected";
            }
            echo "<option value='" . $modalidade->id_modalidade . "' " . $selected . ">" . $modalidade->nome . "</option>";
          }
          ?>
      </select>

      <h4>Apoiadores</h4>
      <input type="text" class="apoiadores" name="apoiadores" <?php echo "value='" . $apoiadores . "'"; ?>/><br /><br />

      
      <h4>Turnos preferenciais para apresentação do trabalho (escolha três turnos diferentes):</h4>
       Primeira preferência: 
       <input name="turno1" type="radio" value="M" <?php echo $trab->turno1=='M'?"checked":""; ?>>Manhã
       <input name="turno1" type="radio" value="T" <?php echo $trab->turno1=='T'?"checked":""; ?>>Tarde
       <input name="turno1" type="radio" value="N" <?php echo $trab->turno1=='N'?"checked":""; ?>>Noite
       <br>
       
       Segunda preferência: 
       <input name="turno2" type="radio" value="M" <?php echo $trab->turno2=='M'?"checked":""; ?>>Manhã
       <input name="turno2" type="radio" value="T" <?php echo $trab->turno2=='T'?"checked":""; ?>>Tarde
       <input name="turno2" type="radio" value="N" <?php echo $trab->turno2=='N'?"checked":""; ?>>Noite
       <br>
       
       Terceira preferência: 
       <input name="turno3" type="radio" value="M" <?php echo $trab->turno3=='M'?"checked":""; ?>>Manhã
       <input name="turno3" type="radio" value="T" <?php echo $trab->turno3=='T'?"checked":""; ?>>Tarde
       <input name="turno3" type="radio" value="N" <?php echo $trab->turno3=='N'?"checked":""; ?>>Noite
       <br>
       
      <div style='width:600px;'>

        <br>
        <br>
        
      <!------------------------------ Autores ------------------------------->
      <?php //Se estiver na funcao de edicao, entao habilita botao para incluir co-autores.
      if ($acao_form_inscricao_trabalho == "salvar_trabalho") : ?>

          <label style='font-weight:bold;height:18px;margin-top:10px;'>Autores </label>
          <br> <br> <br>
          <table id='showCoautores'>
            <tr>
              <td class='subAutor'>Id</td>
              <td class='subAutor'>Nome</td>
              <td class='subAutor'>E-mail</td>
              <td class='subAutor'>Curso/Campus/Instituição</td>
              <td class='subAutor'>X</td>
            </tr>
          <?php $i = 0; ?>
          <?php foreach ($autores_cursos_do_trabalho as $autor_curso) : ?>
            <tr>
              <td><?php echo $autor_curso->fk_autor; ?></td>
              <td><?php echo $autor_curso->nome_usuario; ?></td>
              <td><?php echo $autor_curso->email_trabalho; ?></td>
              <td><?php echo "(".$autor_curso->nome_curso."/".$autor_curso->nome_campus."/".$autor_curso->sigla.")"; ?> </td>
            <?php if ($i != 0): ?>
              <td><a id='btRemoverCoautor' href='#' class='link1' style='text-decoration:underline;' onclick='removerCoautor(<?php echo $autor_curso->fk_autor; ?>)'>X</a></td>
            <?php endif; ?>
            <?php $i++; ?>
            </tr>
          <?php endforeach; ?>
            <!--
            <tr>
              <td colspan=4><a id='btAdicionarCoautor' href='#' class='linkBotao' style='text-decoration:underline;' onclick='showBuscaCoautor();'> Adicionar co-autor no trabalho... </a></td>
            </tr>
            -->
          </table>

          <br>
                    <b>ATENÇÃO: salve o trabalho antes de adicionar um co-autor (clique no botão SALVAR logo abaixo).</b>
          <br>
          <br>
          <a id='btAdicionarCoautor' href='#' class='linkBotao' onclick='showBuscaCoautor();'> Adicionar co-autor no trabalho... </a> 
          <br>
          <br>
          <br>
    <?php endif; ?>
      
        
      <!------------------------------ Orientadores ------------------------------->
        <?php
        //Está na funcao de edicao, entao habilita botao para incluir orientadores.
        if ($acao_form_inscricao_trabalho == "salvar_trabalho"){
          echo "<label style='font-weight:bold;height:18px;margin-top:10px;'>Orientadores </label>";
          echo "<br>";
          echo "<br>";
          echo "<br>";
          echo "<table id='listaOrientadores'>
                <tr>
                <td  class='subOrientador'>Id</td>
                <td  class='subOrientador'>Nome</td>
                <td  class='subOrientador'>E-mail</td>
                <td  class='subOrientador'>Campus/Instituição</td>
                <td class='subOrientador'>X</td>
                </tr>";
          if ($orientadores_campus_do_trabalho != null) {
            foreach ($orientadores_campus_do_trabalho as $orientador_campus) {
              echo "<tr>";
              echo "<td>$orientador_campus->fk_orientador</td>";
              echo "<td>$orientador_campus->nome_usuario</td>";
              echo "<td>$orientador_campus->email_trabalho</td>";
              echo "<td>($orientador_campus->nome_campus/$orientador_campus->sigla)</td>";
              echo "<td><a id='btRemoverOrientador' href='#' class='link1' style='text-decoration:underline;' onclick='removerOrientador(".$orientador_campus->fk_orientador.");'>X</a></td>";
              echo "</tr>";
            }
          }
          //echo "<tr>";
          //echo "<td colspan=4><a id='btAdicionarOrientador' href='#' class='linkBotao' style='text-decoration:underline;' onclick='showBuscaOrientador();'> Adicionar orientador no trabalho... </a></td>";
          //echo "</tr>";
          echo "</table>";
          
          
        echo "<br><b>ATENÇÃO: salve o trabalho antes de adicionar um orientador (clique no botão SALVAR logo abaixo).</b>";
        echo "<br /><br>";
        echo "<a id='btAdicionarOrientador' href='#' class='linkBotao' onclick='showBuscaOrientador();'> Adicionar orientador no trabalho... </a>";
        echo "<br />";
                
        }
        ?>
        
      </div>
      
      <br>
      <br>
      
        <p>
        ATENÇÃO:<br /><br />

        Ao clicar no botão Salvar você estará salvando os dados do seu trabalho no sistema. A qualquer momento, enquanto estiver aberto o prazo de inscrição de trabalhos, o autor principal do trabalho poderá efetuar modificações em qualquer parte do trabalho (título, resumo, palavras-chave, coautores, orientadores, categoria, temática, modalidade, etc.).<br /><br /><br />
        
        <?php if ($acao_form_inscricao_trabalho=="inserir_trabalho") : ?>
          Após salvar o trabalho não esqueça de vincular pelo menos um orientador ao trabalho bem como os demais coautores ou coorientador. Para isso, os orientadores e coautores devem estar previamente cadastrados no sistema. Somente após estes terem efetuado a inscrição será possível adicioná-los ao trabalho.<br /><br />
        <?php endif; ?>
      </p>

<a href="#" class="linkBotao" onclick="salvarTrabalho('<?php echo $acao; ?>'); return false;" >Salvar Trabalho</a>
<a href="#" class="linkBotao" onclick='retornarAreaAutor();'>Retornar à área do Autor</a>

<!--

<a href="ControllerTrabalho.php?acao=ver_trabalho&id_trabalho=<?php //echo $id_trabalho; ?>">Ver Trabalho</a> <br><br>


      <input type="submit" class="buttonNtrab"value="Salvar" name="enviar" onclick="salvarTrabalho('<?php //echo $acao; ?>'); return false;">
      <input type="button" class="buttonNtrab" value="Voltar" name="voltar">
-->
    </div> <!-- Fim da DIV Complemento -->

  </form> <!-- Fim do Form -->

</div><!-- Fim da DIV cont -->

<script type="text/javascript">

  //CKEDITOR.replace('titulo');


  $(function()
  {

    //Aqui configura a textarea titulo para ser um CKEDITOR.
    CKEDITOR.replace('titulo',
            {
              height: 50,
              width: 600,
              toolbarCanCollapse: false,
              removePlugins: 'elementspath', //remove tags da barra inferior (barra de status)
              resize_enabled: false,
              //allowedContent: 'p b i; a[!href]',
              toolbar:
                      [
                        ['Bold', 'Italic', 'Subscript', 'Superscript', 'RemoveFormat'],
                        ['UIColor']
                      ],
              on:
                      {
                        instanceReady: function(ev)
                        {
                          // Output paragraphs as <p>Text</p>.
                          this.dataProcessor.writer.setRules('p',
                                  {
                                    indent: false,
                                    breakBeforeOpen: false,
                                    breakAfterOpen: false,
                                    breakBeforeClose: false,
                                    breakAfterClose: false
                                  });
                        }
                      }
            });//CKEditor titulo


    //Aqui configura a textarea resumo para ser um CKEDITOR.
    CKEDITOR.replace('resumo',
            {
              height: 400,
              width: 600,
              toolbarCanCollapse: false,
              removePlugins: 'elementspath',
              resize_enabled: false,
              toolbar:
                      [
                        ['Bold', 'Italic', 'Subscript', 'Superscript', 'RemoveFormat'],
                        ['UIColor']
                      ],
                      
              on:
                      {
                        instanceReady: function(ev)
                        {
                          // Output paragraphs as <p>Text</p>.
                          this.dataProcessor.writer.setRules('p',
                                  {
                                    indent: false,
                                    breakBeforeOpen: false,
                                    breakAfterOpen: false,
                                    breakBeforeClose: false,
                                    breakAfterClose: false
                                  });
                        }
                      }
            });////CKEditor resumo

  }); //function()


  //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
  //Estou testando como preencher o conteúdo do CKEditor, mas não está funcionando.
  $(document).ready(function() {
    getTituloTrabalho(<?php echo $id_trabalho;?>);
    //CKEDITOR.instances.titulo.setData($("#titulo").val(<?php //echo "\"".$titulo."\""; ?>));
  });


  //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
  //Estou testando como preencher o conteúdo do CKEditor, mas não está funcionando.
  $(document).ready(function() {
    getResumoTrabalho(<?php echo $id_trabalho;?>);
    //CKEDITOR.instances.titulo.setData($("#resumo").val(<?php //echo "\"".$resumo."\""; ?>));
    
  });



function getTituloTrabalho(id_trabalho){
  if (id_trabalho > 0) {
    var str = new Array();
    str.push("acao=get_titulo_trabalho");
    str.push("id_trabalho=" + id_trabalho);
    $.ajax({
      type: "GET",
      url: '../controller/ControllerTrabalho.php',
      data: str.join("&"),
      success: function(data) {
        CKEDITOR.instances.titulo.setData(data);
      }
    });
  }//if
}

function getResumoTrabalho(id_trabalho){
  if (id_trabalho > 0) {
    var str = new Array();
    str.push("acao=get_resumo_trabalho");
    str.push("id_trabalho=" + id_trabalho);
    $.ajax({
      type: "GET",
      url: '../controller/ControllerTrabalho.php',
      data: str.join("&"),
      success: function(data) {
        CKEDITOR.instances.resumo.setData(data);
      }
    });
  }//if
}
 
</script>

<?php
require_once 'rodape.php';
?>
