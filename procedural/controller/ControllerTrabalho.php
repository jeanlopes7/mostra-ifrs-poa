<?php
require_once 'autoload_a.php';
//$controller = new Controller();
session_start();
ob_start();

require_once "funcoes_inscricao_trabalho.php";

//<<<<<<<<<<<<<<<<<<<< Retirar este código <<<<<<<<<<<<<<<<<<<<<<
/*
if (isset($_REQUEST['acao'])) {
  $acao = $_REQUEST['acao'];
  if ($acao == 'entrar') {
    //Simula que o usuário fez login.
    $_SESSION['id_usuario'] = $_REQUEST['id'];
    echo "Entrou";
    exit;
  }
  if ($acao == 'sair') {
    session_destroy();
    echo "Saiu";
    exit;
  }
} 
 */
//<<<<<<<<<<<<<<<<<<<<<<<<<< retirar

//=====================================================================
//Verifica se usuário está logado.
//=====================================================================
if (!isset($_SESSION['id_usuario'])) {
  header("Location: " . HOME . "index.php");
  exit;
}
//Pega ID do usuário logado.
$id_usuario = $_SESSION['id_usuario'];

//=====================================================================
//Verifica se o usuário possui papel de autor.
//=====================================================================
$is_papel_autor = false;
$cursos_autor_logado = null;

$autor_dao = new AutorMySqlDAO();
$autor = $autor_dao->load($id_usuario);
if ($autor != null) {
  $is_papel_autor = true;
  //Carrega Cursos do Autor, para poder vincular no trabalho, caso ele esteja inscrevendo um trabalho.
  $cursos_autor_dao = new AutorMySqlDAO();
  $cursos_autor_logado = $cursos_autor_dao->queryCursosDoAutor($id_usuario);
}

//Coloca na session.
$_SESSION['is_papel_autor'] = $is_papel_autor;
$_SESSION['cursos_autor_logado'] = $cursos_autor_logado;

//=====================================================================
//Verifica se foi fornecido o ID do trabalho.
//=====================================================================
$id_trabalho = -1;
$trab = null;

if (isset($_REQUEST['id_trabalho'])) {
  
  $autores = null;
  $autor_principal = null;
  $orientadores = null;
  $orientador_principal = null;

  $pode_visualizar_trabalho = false;

  $is_autor_do_trabalho = false;
  $is_autor_principal_do_trabalho = false;
  $is_orientador_do_trabalho = false;
  $is_orientador_principal_do_trabalho = false;

  //Pega ID do trabalho a ser visualizado ou editado.
  $id_trabalho = $_REQUEST['id_trabalho'];

  //Verifica se o trabalho existe.
  $trab_dao = new TrabalhoMySqlDAO();
  $trab = $trab_dao->load2($id_trabalho);
  if ($trab == null) {
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< trabalho nao existe.
    exit;
  }
  
  //Pega todos os autores do trabalho.
  $trab_dao = new TrabalhoMySqlDAO();
  $autores = $trab_dao->queryAllAutoresCursosOrderBySeq($id_trabalho);
  //Pega autor principal do trabalho.
  $autor_principal = $autores[0];

  //Pega todos os orientadores do trabalho.
  $orientadores = $trab_dao->queryAllOrientadoresCampusOrderBySeq($id_trabalho);
  if ($orientadores != null) {
    //Pega orientador principal do trabalho.
    $orientador_principal = $orientadores[0];
  }
  else {
    $orientador_principal = null;
  }
  
  //Verifica se usuário tem direito a visualizar o trabalho

  //Verifica se o usuário atual é um dos autores do trabalho.
  foreach ($autores as $autor) {
    if ($autor->id_usuario == $id_usuario) {
      $is_autor_do_trabalho = true;
      $pode_visualizar_trabalho = true;
    }
  }

  //Verifica se o usuário atual é o autor principal do trabalho.
  if ($autor_principal->id_usuario == $id_usuario) {
    $is_autor_principal_do_trabalho = true;
    $pode_visualizar_trabalho = true;
  }
  
  //Verifica se o usuário atual é um dos orientadores do trabalho.
  foreach ($orientadores as $orientador) {
    if ($orientador->id_usuario == $id_usuario) {
      $is_orientador_do_trabalho = true;
      $pode_visualizar_trabalho = true;
    }
  }
  
  //Verifica se o usuário atual é o orientador principal do trabalho.
  if ($orientador_principal != null) {
    if ($orientador_principal->id_usuario == $id_usuario) {
      $is_orientador_principal_do_trabalho = true;
      $pode_visualizar_trabalho = true;
    }
  }

  //Verifica se o usuário atual é um organizador.
  if ($_SESSION['authUser']->organizador != null) {
    $pode_visualizar_trabalho = true;
  }
  
  //Se usuário não tem direito a visualizar o trabalho, entao
  //zera todos os dados para colocar na SESSION.
  if (!$pode_visualizar_trabalho) {
    $autores = null;
    $autor_principal = null;
    $orientadores = null;
    $orientador_principal = null;

    $is_autor_do_trabalho = false;
    $is_autor_principal_do_trabalho = false;
    $is_orientador_do_trabalho = false;
    $is_orientador_principal_do_trabalho = false;
    
    $trab = null;
    $id_trabalho = -1;
  }//if (pode_visualizar_trabalho)
 
  $_SESSION['trabalho'] = $trab;
  $_SESSION['id_trabalho'] = $id_trabalho;
 
  $_SESSION['is_autor_principal_do_trabalho'] = $is_autor_principal_do_trabalho;
  $_SESSION['is_autor_do_trabalho'] = $is_autor_do_trabalho;
  $_SESSION['is_orientador_principal_do_trabalho'] = $is_orientador_principal_do_trabalho;
  $_SESSION['is_orientador_do_trabalho'] = $is_orientador_do_trabalho;
  
  $_SESSION['autores_cursos_do_trabalho'] = $autores;
  $_SESSION['orientadores_campus_do_trabalho'] = $orientadores;
  
  $_SESSION['pode_visualizar_trabalho'] = $pode_visualizar_trabalho;
  
}//if isset(id_trabalho)

//=====================================================================
//Carrega Áreas, Categorias e Modalidades
//=====================================================================

//Carrega Áreas Temática
$areas = null;
$area_dao = new AreaMySqlDAO();
$areas = $area_dao->queryAll();

//Carrega Categorias
$categorias = null;
$categoria_dao = new CategoriaMySqlDAO();
$categorias = $categoria_dao->queryAll();

//Carrega Modalidades
$modalidades = null;
$modalidade_dao = new ModalidadeMySqlDAO();
$modalidades = $modalidade_dao->queryAll();
  
$_SESSION['areas'] = $areas;
$_SESSION['categorias'] = $categorias;
$_SESSION['modalidades'] = $modalidades;

//=====================================================================
// Responde às requisições
//=====================================================================

if (isset($_REQUEST['acao'])) {
  $acao = $_REQUEST['acao'];

  //------------ inscricao_trabalho ----------------------
  if ($acao == 'inscricao_trabalho') {
    exit; //<<<<<<<<
    if ($is_papel_autor) {
      //Remover qualquer trabalho que possa estar na SESSION, pois vai criar um novo trabalho.
      $_SESSION['trabalho'] = null;
      $_SESSION['id_trabalho'] = null;
      $_SESSION['acao_form_inscricao_trabalho'] = "inserir_trabalho";
      //Chamar form_inscricao_trabalho.php
      header("Location: " . HOME . "view/form_inscricao_trabalho.php");
      exit;
    } else {
      //<<<<<<<<<<<<<<<<<< erro, nao é autor.
      exit;
    }
  }//inscricao_trabalho

  //------------ inserir_trabalho ----------------------
  else if ($acao == 'inserir_trabalho') {
    exit; //<<<<<<<<<<<<<<<<<
    //Verifica se o usuário é um autor.
    if ($is_papel_autor) {
      //inserirTrabalho (passa id_trabalho = -1)    
      $res = salvar_trabalho(-1, STATUS_TRAB_PENDENTE);
      echo $res;
      exit;
    } else {
      //<<<<<<<<<<<<<<<<<< erro, nao é autor.
      exit;
    }
    exit;
  }//inserir_trabalho
  
  //------------ edicao_trabalho ----------------------
  else if ($acao == 'edicao_trabalho') {
    if ($_SESSION['is_autor_principal_do_trabalho']) {
      $_SESSION['acao_form_inscricao_trabalho'] = "salvar_trabalho";
      header("Location: " . HOME . "view/form_inscricao_trabalho.php");
      exit;
    } else {
      //<<<<<<<<<<<<<<<<<< erro, nao é o autor principal do trabalho.
      exit;
    }
    exit;
  }//edicao_trabalho
  
  //------------ salvar_trabalho ----------------------
  else if ($acao == 'salvar_trabalho') {
    //Pega o id_trabalho da SESSION.
    if (isset($_SESSION['id_trabalho'])) {
      $id_trabalho = $_SESSION['id_trabalho'];
      if ($_SESSION['is_autor_principal_do_trabalho']) {
	    //GAMBIARRA<<<<<<<<<<<<<<<
		if (ETAPA_INSCRICAO_TRABALHO == 1) {
		  $status = STATUS_TRAB_PENDENTE;
		}
		else if (ETAPA_CORRECAO_TRABALHO_1 == 1) {
		  $status = STATUS_TRAB_EM_CORRECAO;
		}
        $res = salvar_trabalho($id_trabalho, $status);
        echo $res;
        exit;
      } else {
        //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
        echo "99";
        exit;
      }
    }
    echo "100";
    exit;
  }//salvar_trabalho

  //------------ enviar_trabalho ----------------------
  else if ($acao == 'enviar_trabalho') {
    //Pega o id_trabalho da SESSION.
    if (isset($_SESSION['id_trabalho'])) {
      $id_trabalho = $_SESSION['id_trabalho'];
      if ($_SESSION['is_autor_principal_do_trabalho']) {
        $res = enviar_trabalho($id_trabalho);
        echo $res;
        exit;
      } else {
        //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
        echo "99";
        exit;
      }
    }
    echo "100";
    exit;
  }//enviar_trabalho

  //------------ get_titulo_trabalho ----------------------
  else if ($acao == 'get_titulo_trabalho') {
    //Pega o id_trabalho da SESSION.
    if (isset($_SESSION['id_trabalho'])) {
      $id_trabalho = $_SESSION['id_trabalho'];
      if ($_SESSION['is_autor_principal_do_trabalho']) {
        $res = $trab->titulo;
        echo $res;
        exit;
      } else {
        //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
        echo "99";
        exit;
      }
    }
    echo "100";
    exit;
  }//get_titulo_trabalho
  
  //------------ get_resumo_trabalho ----------------------
  else if ($acao == 'get_resumo_trabalho') {
    //Pega o id_trabalho da SESSION.
    if (isset($_SESSION['id_trabalho'])) {
      $id_trabalho = $_SESSION['id_trabalho'];
      if ($_SESSION['is_autor_principal_do_trabalho']) {
        $res = $trab->resumo;
        echo $res;
        exit;
      } else {
        //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
        echo "99";
        exit;
      }
    }
    echo "100";
    exit;
  }//get_resumo_trabalho
    
  //------------ ver_trabalho ----------------------
  else if ($acao == 'ver_trabalho') {

    if (!$pode_visualizar_trabalho) {
      //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< usuário nao tem direito a visualizar trabalho.
      exit;
    }

    $_SESSION['id_trabalho'] = $id_trabalho;

    //Carrega Trabalho e coloca na SESSION.
    //$trab_dao = new TrabalhoMySqlDAO();
    //$trab = $trab_dao->load2($id_trabalho);
    //$_SESSION['trabalho'] = $trab;

    //Carrega os trabalho_autor_curso do trabalho e coloca na SESSION.
    //$trab_dao = new TrabalhoMySqlDAO();
    //$trab_autor_curso = $trab_dao->queryAllAutoresCursosOrderBySeq($id_trabalho);
    //$_SESSION['autores_cursos_do_trabalho'] = $trab_autor_curso;

    //Carrega os trabalho_orientador_campus do trabalho e coloca na SESSION.
    //$trab_dao = new TrabalhoMySqlDAO();
    //$trab_orientador_campus = $trab_dao->queryAllOrientadoresCampusOrderBySeq($id_trabalho);
    //$_SESSION['orientadores_campus_do_trabalho'] = $trab_orientador_campus;

    header("Location: " . HOME . "view/ver_trabalho.php");

    //echo $res;
    exit;
  }//ver_trabalho

  //------------ valida_trabalho ----------------------
  else if ($acao == 'validar_trabalho') {

    //Pega o id_trabalho da SESSION.
    if (isset($_SESSION['id_trabalho'])) {
      $id_trabalho = $_SESSION['id_trabalho'];
      if ($_SESSION['is_orientador_principal_do_trabalho']) {
        $status_validacao = $_REQUEST['status_validacao'];
        $res = validar_trabalho($id_trabalho, $status_validacao);
        echo $res;
        exit;
      } else {
        //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
        echo "99";
        exit;
      }
    }
    echo "100";
    exit;
  }//validar_trabalho

  //------------ busca_coautor ----------------------
  else if ($acao == 'busca_coautor') {
    if ($_SESSION['is_autor_principal_do_trabalho']) {
      $nome_autor = $_REQUEST['nome_autor'];
      $quant_cars = count(str_split($nome_autor));
      if ($quant_cars < 4) {
        echo -1;
        exit;
      }
      $autor_dao = new AutorMySqlDAO();
      $autores = $autor_dao->queryAutoresCursosByName($nome_autor);
      if ($autores == null) {
        echo "-2";
        exit;
      }
      $str = "";
      foreach($autores as $autor) {
        $str .= '<tr>';
        $str .= '<td style="padding-right:10px;">'.$autor->nome_usuario.'</td><td style="padding-right:10px;">'.$autor->nome_curso.' ('.$autor->sigla.' - '.$autor->nome_campus.')</td>';
        $str .= '<td style="padding-right:10px;"><a href="#" class="link1" style="margin-right:20px;text-decoration:underline;" onclick="inserirCoautor('.$autor->id_usuario.', '.$autor->fk_curso.'); return false;">Adicionar co-autor</a></td>';
        $str .= '</tr>';
      }
      echo $str;
    }
  }//busca_coautor

  //------------ busca_orientador ----------------------
  else if ($acao == 'busca_orientador') {
    if ($_SESSION['is_autor_principal_do_trabalho']) {
      $nome_orientador = $_REQUEST['nome_orientador'];
      $quant_cars = count(str_split($nome_orientador));
      if ($quant_cars < 4) {
        echo -1;
        exit;
      }
      $orientador_dao = new OrientadorMySqlDAO();
      $orientadores = $orientador_dao->queryOrientadoresCampusByName($nome_orientador);
      if ($orientadores == null) {
        echo "-2";
        exit;
      }
      $str = "";
      foreach($orientadores as $orientador) {
        $str .= '<tr>';
        $str .= '<td style="padding-right:10px;">'.$orientador->nome_usuario.'</td><td style="padding-right:10px;"> ('.$orientador->sigla.' - '.$orientador->nome_campus.')</td>';
        $str .= '<td style="padding-right:10px;"><a href="#" class="link1" style="margin-right:20px;text-decoration:underline;" onclick="inserirOrientador('.$orientador->id_usuario.', '.$orientador->fk_campus.'); return false;">Adicionar orientador</a></td>';
        $str .= '</tr>';
      }
      echo $str;
    }
  }//busca_orientador

  //------------ inserir_coautor ----------------------
  else if ($acao == 'inserir_autor') {
    //if(ETAPA_INSCRICAO_TRABALHO == 1 || ETAPA_CORRECAO_TRABALHO == 1) {
      //exit;
    //}
    if ($_SESSION['is_autor_principal_do_trabalho']) {
      $id_autor = $_REQUEST['id_autor'];
      $id_curso = $_REQUEST['id_curso'];
      $id_trabalho = $_SESSION['id_trabalho'];
      $autores = $_SESSION['autores_cursos_do_trabalho'];
      //Verifica se autor curso existe.
      $autor_curso_dao = new AutorCursoMySqlDAO();
      $autor = $autor_curso_dao->loadAutorCurso($id_autor, $id_curso);
      if ($autor == null) {
        echo -1;
        exit;
      }
      //Verifica se esse autor já está no trabalho
      foreach ($autores as $autor) {
        if ($id_autor == $autor->id_usuario) {
          //Autor já está no trabalho.
          echo -2;
          exit;
        }
      }
      //Descobre quantos autores existem no trabalho.
      $trab_dao = new TrabalhoMySqlDAO();
      $quant = $trab_dao->queryQuantAutores($id_trabalho);
      if ($quant->quant >= 5)  {
        echo -3;
        exit;
      }
      
      //Pega dados do coautor.
      $autor_curso_dao = new AutorCursoMySqlDAO();
      $autor_curso = $autor_curso_dao->load2($id_autor, $id_curso);
      
      //Insere autor curso no trabalho
      $trab_autor_curso = new TrabalhoAutorCurso();
      $trab_autor_curso->setFkTrabalho($id_trabalho);
      $trab_autor_curso->setFkAutor($id_autor);
      $trab_autor_curso->setFkCurso($id_curso);
      $trab_autor_curso->setSeq($quant->quant + 1);
      $trab_autor_curso->setEmailTrabalho($autor_curso->email);
      $trab_autor_curso_dao = new TrabalhoAutorCursoMySqlDAO();
      $trab_autor_curso_dao->insert($trab_autor_curso);
      
      //Re-carrega os trabalho_autor_curso do trabalho e coloca na SESSION.
      $trab_dao = new TrabalhoMySqlDAO();
      $trab_autor_curso = $trab_dao->queryAllAutoresCursosOrderBySeq($id_trabalho);
      $_SESSION['autores_cursos_do_trabalho'] = $trab_autor_curso;
      
      echo 0;
      exit;
      
    }
    //Nao é autor principal do trabalho.
    echo -4;
    exit;
  }

  //------------ inserir_orientador ----------------------
  else if ($acao == 'inserir_orientador') {
    //if(ETAPA_INSCRICAO_TRABALHO == 1 || ETAPA_CORRECAO_TRABALHO == 1) {
      //exit;
    //}
    if ($_SESSION['is_autor_principal_do_trabalho']) {
      $id_orientador = $_REQUEST['id_orientador'];
      $id_campus = $_REQUEST['id_campus'];
      $id_trabalho = $_SESSION['id_trabalho'];
      $orientadores = $_SESSION['orientadores_campus_do_trabalho'];
      //Verifica se orientador campus existe.
      $orientador_campus_dao = new OrientadorCampusMySqlDAO();
      $orientador = $orientador_campus_dao->loadOrientadorCampus($id_orientador, $id_campus);
      if ($orientador == null) {
        echo -1;
        exit;
      }
      //Verifica se esse orientador já está no trabalho
      foreach ($orientadores as $orientador) {
        if ($id_orientador == $orientador->id_usuario) {
          //Orientador já está no trabalho.
          echo -2;
          exit;
        }
      }
      //Descobre quantos orientadores existem no trabalho.
      $trab_dao = new TrabalhoMySqlDAO();
      $quant = $trab_dao->queryQuantOrientadores($id_trabalho);
      if ($quant->quant >= 2)  {
        echo -3;
        exit;
      }
      
      //Pega dados do orientador.
      $orientador_campus_dao = new OrientadorCampusMySqlDAO();
      $orientador_campus = $orientador_campus_dao->load2($id_orientador, $id_campus);
      
      //Insere orientador campus no trabalho
      $trab_orient_campus = new TrabalhoOrientadorCampus();
      $trab_orient_campus->setFkTrabalho($id_trabalho);
      $trab_orient_campus->setFkOrientador($id_orientador);
      $trab_orient_campus->setFkCampus($id_campus);
      $trab_orient_campus->setSeq($quant->quant + 1);
      $trab_orient_campus->setEmailTrabalho($orientador_campus->email);
      $trab_orient_campus_dao = new TrabalhoOrientadorCampusMySqlDAO();
    
      $trab_orient_campus_dao->insert($trab_orient_campus);
      
      //Re-carrega os trabalho_orientador_campus do trabalho e coloca na SESSION.
      $trab_dao = new TrabalhoMySqlDAO();
      $trab_orient_campus = $trab_dao->queryAllOrientadoresCampusOrderBySeq($id_trabalho);
      $_SESSION['orientadores_campus_do_trabalho'] = $trab_orient_campus;
      
      echo 0;
      exit;
      
    }
    //Nao é autor principal do trabalho.
    echo -4;
    exit;
  }//inserir_orientador

  else if ($acao == 'remover_coautor') {
    if ($_SESSION['is_autor_principal_do_trabalho']) {
      $id_autor = $_REQUEST['id_autor'];
      $id_trabalho = $_SESSION['id_trabalho'];

      $trab_dao = new TrabalhoMySqlDAO();
      $autor_principal = $trab_dao->loadAutorPrincipal($id_trabalho);
      if ($autor_principal->id_usuario == $id_autor) {
        //Nao pode remover o autor principal.
        echo -1;
        exit;
      }
      
      //Remove o trabalho_autor_curso.
      $trab_autor_curso_dao = new TrabalhoAutorCursoMySqlDAO();
      $trab_autor_curso_dao->delete($id_trabalho, $id_autor);
      
      //Re-carrega os trabalho_autor_curso do trabalho e coloca na SESSION.
      $trab_dao = new TrabalhoMySqlDAO();
      $trab_autor_curso = $trab_dao->queryAllAutoresCursosOrderBySeq($id_trabalho);
      $_SESSION['autores_cursos_do_trabalho'] = $trab_autor_curso;
      
      echo 0;
      exit;
      
    }
    //Nao é autor principal do trabalho.
    echo -4;
    exit;
  }//remover_coautor
  
  else if ($acao == 'remover_orientador') {
    if ($_SESSION['is_autor_principal_do_trabalho']) {
      $id_orientador = $_REQUEST['id_orientador'];
      $id_trabalho = $_SESSION['id_trabalho'];

      //Remove o trabalho_orientador_campus.
      $trab_orient_camp_dao = new TrabalhoOrientadorCampusMySqlDAO();
      $trab_orient_camp_dao->delete($id_trabalho, $id_orientador);
      
      //Re-carrega os trabalho_orientador_campus do trabalho e coloca na SESSION.
      $trab_dao = new TrabalhoMySqlDAO();
      $trab_orient_camp = $trab_dao->queryAllOrientadoresCampusOrderBySeq($id_trabalho);
      $_SESSION['orientadores_campus_do_trabalho'] = $trab_orient_camp;
      
      echo 0;
      exit;
      
    }
    //Nao é o autor principal do trabalho.
    echo -4;
    exit;
  }//remover_orientador
  
  else if ($acao == 'teste') {
    //inserirTrabalho
    $dao = new UsuarioMySqlDAO();
    $result = $dao->load(601);

    echo $result->id_usuario . "<br>";
    echo $result->nome . "<br>";
    var_dump($result);
    exit;
  }//teste
}
?>