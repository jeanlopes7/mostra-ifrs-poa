<?php
//require_once 'constantes_URL.php';
<<<<<<< HEAD
//require_once '../config/constants.php';
=======
//require_once 'constantes.php';
>>>>>>> f9b405479b0aa4f88530d1c9535f52b197308e2e
//require_once 'constantes_inscricao_trabalho.php';
//require_once 'funcoes_envia_email.php';

/************************************************************
 * tamanho_resumo
 * Retorna a quantidade de caracteres.
 * 
 *************************************************************/
function tamanho_resumo($resumo) {
  //Tem que fazer primeiro strip_tags() para depois html_entity_decode().
  $str = html_entity_decode(strip_tags($resumo));
  $str = str_replace("\n", "", $str);
  $str = str_replace("\r", "", $str);
  
  //Não colocar, pois devem ser contados os espaços.
  //$str = str_replace(" ", "", $str);

  $array1 = array("á", "à", "â", "ã", "ä", "é", "è", "ê", "ë", "í", "ì", "î", "ï", "ó", "ò", "ô", "õ", "ö", "ú", "ù", "û", "ü", "ç"
      , "Á", "À", "Â", "Ã", "Ä", "É", "È", "Ê", "Ë", "Í", "Ì", "Î", "Ï", "Ó", "Ò", "Ô", "Õ", "Ö", "Ú", "Ù", "Û", "Ü", "Ç");
  $array2 = array("a", "a", "a", "a", "a", "e", "e", "e", "e", "i", "i", "i", "i", "o", "o", "o", "o", "o", "u", "u", "u", "u", "c"
      , "A", "A", "A", "A", "A", "E", "E", "E", "E", "I", "I", "I", "I", "O", "O", "O", "O", "O", "U", "U", "U", "U", "C");
  $str = str_replace($array1, $array2, $str);
  $num_cars = count(str_split($str));
  return $num_cars;
}//tamanho_resumo()

/* * ***********************************************************
 *  turno_to_int
 * ************************************************************* */
function turno_to_int($turno) {
  switch ($turno) {
    case 'M':
      return 1;
    case 'T':
      return 2;
    case 'N':
      return 4;
  }
  return 0;
}//turno_to_int()

/* * ***********************************************************
 *  valida_turnos
 * ************************************************************* */
function valida_turnos($turno1, $turno2, $turno3) {
  //verifica turnos
  $t1 = turno_to_int($turno1);
  $t2 = turno_to_int($turno2);
  $t3 = turno_to_int($turno3);
  if ( ($t1 + $t2 + $t3) != 7) {
    //turnos inválidos.
    return false;
  }
  return true;
}//valida_turnos()

/* * ************************************************************
 *  valida_modalidade_trabalho_autor
 * Se $id_trabalho < 0 entao considera que está inserindo um trabalho novo.
 * Senao, se id_trabalho >= 0, considera que está fazendo uma edição de trabalho.
 * ************************************************************ */
function valida_modalidade_trabalho_autor($id_autor, $id_trabalho, $modalidade) {
  $autor_dao = new AutorMySqlDAO();
  
  //Quantidade de trabalhos como autor principal.
  $quant_trab = $autor_dao->queryQuantidadeTrabalhosAutorPrincipal($id_autor);
  if ($quant_trab == 0) {
    return 0; //ok
  }

  if ($quant_trab == 1) {
    //Tem apenas um trabalho
    //Verifica se é um trabalho com modalidade diferente 
    $trabalhos = $autor_dao->queryTrabalhosAutorPrincipal($id_autor);
    $trabalho = $trabalhos[0];
    $fk_trabalho = $trabalho->fk_trabalho;
    $modalidade_trabalho = $trabalho->fk_modalidade;
    
    //Se estiver inserindo um trabalho novo.
    if ( ($id_trabalho == -1)  ) {
      if ($modalidade_trabalho != $modalidade) {
        //Modalidade é diferente. Ok.
        return 0;
      }
      else {
        //Erro: mesma modalidade.
        return 11;
      }
    }
    //Não está inserindo um novo trabalho.
    else {
      //Está modificando o único trabalho então pode modificar a modalidade sem necessitar nenhuma verificação.
      return 0;
    }

  }//quant==1

  if ($quant_trab == 2) {
    //Se estiver inserindo um novo trabalho entao NAO pode.
    if ( ($id_trabalho == -1)  ) {
      return 12;
    }
    else {
      $trabalho_dao = new TrabalhoMySqlDAO();
      $trabalho = $trabalho_dao->load($id_trabalho);
      if ($trabalho->fk_modalidade == $modalidade) {
        //Ok, nao está tentando modificar modalidade do trabalho.
        return 0;
      }
      else {
        //Já é autor de 2 trabalhos.
        //Por enquanto não é permitido mudar a modalidade.
        //Está tentando modificar a modalidade, mas não pode, pois já tem 2 trabalhos.
        return 13;
      }
    }
  }

  //Mais de 2 trabalhos, algum ERRO de consistência no sistema.
  return 14;
}//valida_modalidade_trabalho_autor()

/* * ***********************************************************
 *  salvar_trabalho
 * Se id_trabalho < 0 entao faz um insert
 * Senao faz um update.
 * ************************************************************ */
function salvar_trabalho($id_trabalho, $status) {

  $id_usuario = (int) $_SESSION["id_usuario"];
  $titulo = $_POST["cTitulo"];
  //$titulo = mysql_real_escape_string($_POST["cTitulo"]);
  $titulo_ordenar = html_entity_decode(strip_tags($titulo), ENT_QUOTES, "UTF-8");
  $resumo = $_POST["cResumo"];
  //Se for usar mysql_real_escape_string() tem que ser depois de tamanho_resumo().
  //$resumo = mysql_real_escape_string($resumo);
  $resumo2 = html_entity_decode(strip_tags($resumo), ENT_QUOTES, "UTF-8");
  $palavra1 = html_entity_decode($_POST["palavra1"]);
  $palavra2 = html_entity_decode($_POST["palavra2"]);
  $palavra3 = html_entity_decode($_POST["palavra3"]);
  $area = (int) $_POST["area"];
  $categoria = (int) $_POST["categoria"];
  $modalidade = (int) $_POST["modalidade"];
  $apoiadores = html_entity_decode($_POST["apoiadores"]);
  $turno1 = $_POST["turno1"];
  $turno2 = $_POST["turno2"];
  $turno3 = $_POST["turno3"];
  $id_curso = (int) $_POST["curso"];
  
  $email_trabalho = html_entity_decode($_POST["email_trabalho"]);
  
  $ip_servidor = $_SERVER['REMOTE_ADDR'];
  
  $resp = 0;
  if (!isset($id_usuario)) {
    // erro: sessão expirou ou não existe
    return 1;
  }

  if ( (ETAPA_INSCRICAO_TRABALHO == 0) && (ETAPA_CORRECAO_TRABALHO_1 == 0) ) {
    // erro: etapa não permite inserir trabalho.
    return 2;
  }

  //Verifica se o usuário é um autor.
  $autor_dao = new AutorMySqlDAO();
  $result = $autor_dao->load($id_usuario);
  if ($result == null) {
    // erro: usuário não é autor
    return 3;
  }

  //Verifica se tamanho do resumo está correto.
  $tam_resumo = tamanho_resumo($resumo);
  if ($tam_resumo > QUANT_MAX_CARS_RESUMO) {
    return -$tam_resumo;
  }

  $curso_dao = new CursoMySqlDAO();
  $res_curso = $curso_dao->load($id_curso);
  if ($res_curso == null) {
    //Não é um curso do autor.
    return 5;
  }
  $nivel = $res_curso->nivel;
  $valida_modalidade = valida_modalidade_trabalho_autor($id_usuario, $id_trabalho, $modalidade);
  if ($valida_modalidade > 0) {
    //Erro na validacao da modalidade.
    return $valida_modalidade;
  }
  
  //verifica turnos
  if ( !valida_turnos($turno1, $turno2, $turno3) ) {
    //turnos inválidos.
    return 6;
  }

  //Instancia um trabalho.
  $trabalho_dao = new TrabalhoMySqlDAO();
  $trabalho = new Trabalho();
  $trabalho->setFkArea($area);
  $trabalho->setFkCategoria($categoria);
  $trabalho->setFkModalidade($modalidade);
  $trabalho->setNivel($nivel);

  $trabalho->setTitulo($titulo);
  $trabalho->setTituloOrdenar($titulo_ordenar);

  $trabalho->setResumo($resumo);
  $trabalho->setResumo2($resumo2);
  
  $trabalho->setPalavra1($palavra1);
  $trabalho->setPalavra2($palavra2);
  $trabalho->setPalavra3($palavra3);
  $trabalho->setApoiadores($apoiadores);
  $trabalho->setTurno1($turno1);
  $trabalho->setTurno2($turno2);
  $trabalho->setTurno3($turno3);
  $trabalho->setIpCadastro($ip_servidor);

  $trabalho->setStatus($status);
  
  //Se id_trabalho negativo entao insere um novo trabalho.
  if ($id_trabalho < 0) {
    //Insere trabalho.
    $id_trabalho = $trabalho_dao->insert($trabalho);
    
    //Insere trabalho_autor_curso.
    $trab_aut_curso = new TrabalhoAutorCurso();
    $trab_aut_curso_dao = new TrabalhoAutorCursoMySqlDAO();
    $trab_aut_curso->setFkAutor($id_usuario);
    $trab_aut_curso->setFkCurso($id_curso);
    $trab_aut_curso->setFkTrabalho($id_trabalho);
    $trab_aut_curso->setEmailTrabalho($email_trabalho);
    $trab_aut_curso->setSeq(1);
    $trab_aut_curso_dao->insert($trab_aut_curso);

    //Envia email para autor do trabalho.
    envia_email_trabalho_inscrito($id_trabalho, $titulo, $email_trabalho);
  }
  else {
    //Atualiza trabalho.
    $trabalho->setIdTrabalho($id_trabalho);
    $trabalho_dao->update($trabalho);
  }

  return 0;
}//salvar_trabalho()

/* ***********************************************************
 *  enviar_trabalho
 ************************************************************* */
function enviar_trabalho($id_trabalho) {
  //Verificar se o trabalho tem pelo menos um orientador.
  if (!isset($_SESSION['orientadores_campus_do_trabalho']) || ($_SESSION['orientadores_campus_do_trabalho']==null)){
    return -1;
  };
  //verifica turnos
  $turno1 = $_SESSION['trabalho']->turno1;
  $turno2 = $_SESSION['trabalho']->turno2;
  $turno3 = $_SESSION['trabalho']->turno3;
  if ( !valida_turnos($turno1, $turno2, $turno3) ) {
    //turnos inválidos.
    return -2;
  }
  
  //GAMBIARRA <<<<<<<<<<<<<<<<<<<<<
  		if (ETAPA_INSCRICAO_TRABALHO == 1) {
		  $status = STATUS_TRAB_PENDENTE;
		}
		else if (ETAPA_CORRECAO_TRABALHO_1 == 1) {
		  $status = STATUS_TRAB_CORRIGIDO;
		}
    
  $trabalho_dao = new TrabalhoMySqlDAO();
  $trabalho_dao->changeStatus($id_trabalho, $status);
  return 0;
}//enviar_trabalho

/* ***********************************************************
 *  validar_trabalho
 ************************************************************* */
function validar_trabalho($id_trabalho, $status) {
  $trabalho_dao = new TrabalhoMySqlDAO();
  $trabalho_dao->changeStatus($id_trabalho, $status);
  return 0;
}//validar_trabalho

<<<<<<< HEAD
=======

>>>>>>> f9b405479b0aa4f88530d1c9535f52b197308e2e
?>
