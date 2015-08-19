<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "procedural/model/mysql/TrabalhoMySqlDAO.class.php";
require_once "procedural/model/mysql/TrabalhoAutorCursoMySqlDAO.class.php";
require_once "procedural/model/mysql/TrabalhoOrientadorCampusMySqlDAO.class.php";

class Trabalho_bo {

    /**
     *
     * @access private 
     */
    private $CI;

    /**
     * @var Trabalho_dao $trabalho_dao trabalho dao
     * @access private
     */
    private $trabalho_dao;
    
  /**
   * usuario busines object
   * @access private
   * @var \Usuario_bo $usuario_bo
   */
  private $usuario_bo;
    
  public function __construct()  {
    $this->CI =& get_instance();
    $this->CI->load->library('dao/trabalho_dao');
    $this->CI->load->library('bo/usuario_bo');
    $this->trabalho_dao =& $this->CI->trabalho_dao;
    $this->usuario_bo   =& $this->CI->usuario_bo;
    //Retirado por Alexdg (estava dando erro)
    //parent::__construct();
  }

  /**
   * Retorna a possibilidade do autor se cadastra no trabalho.
   * @param  int $id_autor o id do autor no banco
   * @return mixed  false - não pode mais cadastrar, 1 - oral, 2 - poster, 3 - ambos
   */
  public function canMakeTrabalho($id_autor) {

    /*
    //Verificar se a ETAPA do evento permite.
    if ( (ETAPA_INSCRICAO_TRABALHO == 0) && (ETAPA_CORRECAO_TRABALHO_1 == 0) ) {
      // erro: etapa não permite inserir trabalho.
      return 2;
    }

    
    //Verificar se $id_autor é um autor.
        //Verifica se o usuário é um autor.
    $autor_dao = new AutorMySqlDAO();
    $result = $autor_dao->load($id_usuario);
    if ($result == null) {
      // erro: usuário não é autor
      return 3;
    }

    
    //Verificar se esse autor não ultrapassou o limite máximo de trabalhos.
    
    
    
    */
    
    //Modificado para TRUE por Alexdg.
    return true;
  }//canMakeTrabalho()  
  
  public function valida_dados() {
    /*
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
*/
  }//valida_dados()
  
   /* * ***********************************************************
   * Inscreve um trabalho:
    * Insere o trabalho na tabela trabalho e o autor principal
   * na tabela trabalho_autor_curso
   * ************************************************************ */
  
  public function inscrever_trabalho(\Entity\Trabalho $trabalho, $id_autor_princial, $id_curso, $email_trabalho) {
    
    //Verifica se quantidade de trabalhos desse autor <2.
    //.....
    
    //Verifica se modalidade permitida.
    //.....
    
    //Jean <<<<<<<<<<<<
    //Consulta o nível do curso do autor principal.
    //......
    $nivel = 0;
    
    //-1 para inscrever um novo trabalho.
    $trabalho->setIdTrabalho(-1);
    $trabalho->setNivel($nivel);
    $trabalho->setSeqSessao(0);
    $trabalho->setStatus(STATUS_TRAB_PENDENTE);
    
    //START TRANSACTION ?????
    $this->salvar_dados_trabalho($trabalho);
    
    //echo $trabalho->getIdTrabalho()." ".$id_autor_princial." ".$id_curso;
    //die();
    
    //Insere autor principal na tabela trabalho_autor_curso
    $this->insere_autor($trabalho->getIdTrabalho(), $id_autor_princial, $id_curso, $email_trabalho);
    
    //END TRAnSACTION ???????

    //Envia email para autor do trabalho ???????
    //envia_email_trabalho_inscrito($id_trabalho, $titulo, $email_trabalho);
  }//inscrever_trabalho()

  /***************************************************************
  * Esta função se chamava salvar_trabalho
  * Se id_trabalho < 0 entao faz um insert
  * Senao faz um update.
  ****************************************************************/
  public function salvar_dados_trabalho(\Entity\Trabalho $trabalho) {

    //Instancia um DAO, para inserir ou atualizar o trabalho.
    $trabalho_dao = new TrabalhoMySqlDAO();

    $id_trabalho = $trabalho->getIdTrabalho();
    //Se id_trabalho for zero ou menor entao insere um novo trabalho.
    if ($id_trabalho <= 0) {
      //Insere trabalho.
      $id_trabalho = $trabalho_dao->insert($trabalho);

      //Insere trabalho_autor_curso.
      /*
      $trab_aut_curso = new TrabalhoAutorCurso();
      $trab_aut_curso_dao = new TrabalhoAutorCursoMySqlDAO();
      $trab_aut_curso->setFkAutor($id_usuario);
      $trab_aut_curso->setFkCurso($id_curso);
      $trab_aut_curso->setFkTrabalho($id_trabalho);
      $trab_aut_curso->setEmailTrabalho($email_trabalho);
      $trab_aut_curso->setSeq(1);
      $trab_aut_curso_dao->insert($trab_aut_curso);
       *
       */

      //Envia email para autor do trabalho.
      //envia_email_trabalho_inscrito($id_trabalho, $titulo, $email_trabalho);
    }
    else {
      //Atualiza trabalho.
      $trabalho_dao->update($trabalho);
    }

    
  /*

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


  */
    return 0;
  }//salvar_dados_trabalho()

  /***********************************************************
  * insere_autor()
  **************************************************************/
  public function insere_autor($id_trabalho, $id_autor, $id_curso, $email_trabalho) {
    $trab_aut_curso = new \Entity\TrabalhoAutorCurso();
    $trab_aut_curso->setFk_trabalho($id_trabalho);
    $trab_aut_curso->setFk_autor($id_autor);
    $trab_aut_curso->setFk_curso($id_curso);
    $trab_aut_curso->setEmailTrabalho($email_trabalho);
    
    $trab_aut_curso_dao = new TrabalhoAutorCursoMySqlDAO();
    //Verifica a maior sequencia.
    $seq = $trab_aut_curso_dao->queryMaxSeq($id_trabalho);
    
    if ($seq < 5) {
      $seq++;    
      $trab_aut_curso->setSequencia($seq); 
      $trab_aut_curso_dao->insert($trab_aut_curso);
    }
    else {
      throw new Exception("Número máximo de autores atingido: 5");
    }
  }//insere_autor()

  /***********************************************************
  * insere_orientador()
  **************************************************************/
  public function insere_orientador($id_trabalho, $id_orientador, $id_campus, $email_trabalho) {
    $trab_ori_cam = new \Entity\TrabalhoOrientadorCampus();
    $trab_ori_cam->setFk_trabalho($id_trabalho);
    $trab_ori_cam->setFk_orientador($id_orientador);
    $trab_ori_cam->setFk_campus($id_campus);
    $trab_ori_cam->setEmailTrabalho($email_trabalho);
    
    $trab_ori_cam_dao = new TrabalhoOrientadorCampusMySqlDAO();
    //Verifica a maior sequencia.
    $seq = $trab_ori_cam_dao->queryMaxSeq($id_trabalho);
    
    if ($seq < 2) {
      $seq++;    
      $trab_ori_cam->setSequencia($seq); 
      $trab_ori_cam_dao->insert($trab_ori_cam);
    }
    else {
     throw new Exception("Número máximo de orientadores atingido: 2");
    }
  }//insere_orientador()

  public function remove_autor($id_trabalho, $id_autor) {
    $trab_aut_curso_dao = new TrabalhoAutorCursoMySqlDAO();
    $trab_aut_curso_dao->delete($id_trabalho, $id_autor);
  }//remove_autor()

  public function remove_orientador($id_trabalho, $id_orientador) {
    $trab_ori_cam_dao = new TrabalhoOrientadorCampusMySqlDAO();
    $trab_ori_cam_dao->delete($id_trabalho, $id_orientador);
  }//remove_orientador()

  public function get_trabalho($id_trabalho) {
    $trabalho_dao = new TrabalhoMySqlDAO();
    $trabalho = $trabalho_dao->load2($id_trabalho);
    return $trabalho;
  }//get_trabalho()
  
  public function get_trabalho2($id_trabalho) {
    $trabalho = $this->trabalho_dao->find_one_by($id_trabalho);
    return $trabalho;
  }//get_trabalho2()
  
  public function get_autores_trabalho_order_by_seq($id_trabalho) {
    $trabalho_dao = new TrabalhoMySqlDAO();
    $autores = $trabalho_dao->queryAllAutoresCursosOrderBySeq($id_trabalho);
    return $autores;
  }
  
  public function get_orientadores_trabalho_order_by_seq($id_trabalho) {
    $trabalho_dao = new TrabalhoMySqlDAO();
    $orientadores = $trabalho_dao->queryAllOrientadoresCampusOrderBySeq($id_trabalho);
    return $orientadores;
  }
  
  public function get_titulo($id_trabalho) {
    $trabalho_dao = new TrabalhoMySqlDAO();
    $trabalho = $trabalho_dao->load($id_trabalho);
    return $trabalho->titulo;
  }

  public function get_resumo($id_trabalho) {
    $trabalho_dao = new TrabalhoMySqlDAO();
    $trabalho = $trabalho_dao->load($id_trabalho);
    return $trabalho->resumo;
  }

  public function canUserEditarTrabalho($id_usuario, $id_trabalho){
  
    //<<<<<<<<<<<<<<<<<<<
    return true;
    
  }
  
  public function isUserInTrabalho($id_usuario, $id_trabalho) {
    if ($this->isUserAutorInTrabalho($id_usuario, $id_trabalho)) {
      return true;
    }
    if ($this->isUserOrientadorInTrabalho($id_usuario, $id_trabalho)) {
      return true;
    }
    return false;
  }//isUserInTrabalho()

public function isUserAutorPrincipalInTrabalho($id_usuario, $id_trabalho) {
    $resp = false;
    $autores = $this->get_autores_trabalho_order_by_seq($id_trabalho);
    $id_autor_principal = $autores[0]->fk_autor;
    //Cuidado com o NULL
    if ($id_autor_principal == $id_usuario) {
      $resp = true;
    }
    return $resp;
  }//isUserAutorPrincipalInTrabalho()

public function isUserAutorInTrabalho($id_usuario, $id_trabalho) {
    $resp = false;
    $autores = $this->get_autores_trabalho_order_by_seq($id_trabalho);
    //Verifica se o usuário é um dos autores do trabalho.
    foreach($autores as $autor) {
      if ($autor->fk_autor == $id_usuario) {
        $resp = true;
      }
    }
    return $resp;
  }//isUserAutorInTrabalho()

  public function isUserOrientadorPrincipalInTrabalho($id_usuario, $id_trabalho) {
    $resp = false;
    $orientadores = $this->get_orientadores_trabalho_order_by_seq($id_trabalho);
    $orientador = $orientadores[0];
    if ($orientador->fk_orientador == $id_usuario) {
      $resp = true;
    }
    return $resp;
  }//isUserOrientadorPrincipalInTrabalho()

  public function isUserOrientadorInTrabalho($id_usuario, $id_trabalho) {
    $resp = false;
    $orientadores = $this->get_orientadores_trabalho_order_by_seq($id_trabalho);
    //Verifica se o usuário é um dos orientadores do trabalho.
    foreach($orientadores as $orientador) {
      if ($orientador->fk_orientador == $id_usuario) {
        $resp = true;
      }
    }
    return $resp;
  }//isUserOrientadorInTrabalho()

  public function enviar($id_trabalho) {
    $trabalho_dao = new TrabalhoMySqlDAO();
   //Verifica se trabalho tem pelo menos um orientdor vinculado
   $orienta = $trabalho_dao->loadOrientadorPrincipal($id_trabalho);
   if ($orienta != null) {
      $trabalho_dao->changeStatus($id_trabalho, STATUS_TRAB_ENVIADO);
   }
   else {
     throw new Exception("Trabalho não possui orientador. Adicione pelo menos um orientador ao trabalho.");
   }
  }//enviar()
  
  public function validar($id_trabalho) {
    $trabalho_dao = new TrabalhoMySqlDAO();
    $trabalho_dao->changeStatus($id_trabalho, STATUS_TRAB_VALIDADO);
  }

  public function invalidar($id_trabalho) {
    $trabalho_dao = new TrabalhoMySqlDAO();
    $trabalho_dao->changeStatus($id_trabalho, STATUS_TRAB_INVALIDADO);
  }

  public function pender($id_trabalho) {
    $trabalho_dao = new TrabalhoMySqlDAO();
    $trabalho_dao->changeStatus($id_trabalho, STATUS_TRAB_PENDENTE);
  }

  public function corrigir($id_trabalho) {
    $trabalho_dao = new TrabalhoMySqlDAO();
    $trabalho_dao->changeStatus($id_trabalho, STATUS_TRAB_CORRIGIR);
  }
  
  public function aceitar($id_trabalho) {
    $trabalho_dao = new TrabalhoMySqlDAO();
    $trabalho_dao->changeStatus($id_trabalho, STATUS_TRAB_ACEITO);
  }
  
  public function recusar($id_trabalho) {
    $trabalho_dao = new TrabalhoMySqlDAO();
    $trabalho_dao->changeStatus($id_trabalho, STATUS_TRAB_RECUSADO);
  }

  /***********************************************************
  * usuarioLogadoPodeInscrever()
  * Retorna true se:
  * 1) O usuário logado é um autor E
  * 2) O evento estiver na etapa adequada E
  * 3) O autor não atingiu o limite máximo de trabalhos como autor principal.
  * Senão, lança uma exceção.
  **************************************************************/
  public function usuarioLogadoPodeInscrever(){
    //Pega ID do usuario logado.
    $user = $this->usuario_bo->getUserSession();
    $id_usuario = $user['id'];

    //Verifica se é um autor.
    //Talvez não precisasse porque o sistema de regras já faz essa verificação.
    //...
    
    //Verifica se está na etapa adequada.
    
    //Verifica quantidade de trabalhos desse autor.
    $trabalho_dao = new TrabalhoMySqlDAO();
    $trabalho = $trabalho_dao->queryTrabalhosByAutorPrincipal($id_usuario);
    $quant = count($trabalho);
    if ($quant >= MAX_TRABALHOS_COMO_AUTOR_PRINCIPAL) {
      throw new Exception("Máximo de trabalhos como primeiro autor (autor principal) é ".MAX_TRABALHOS_COMO_AUTOR_PRINCIPAL.".");
    }
    return true;
  }//usuarioLogadoPodeInscrever()

  /***********************************************************
  * usuarioLogadoPodeEditar()
  * Retorna true se:
  * 1) O usuário logado é o autor principal do trabalho E
  * 2) O evento estiver na etapa adequada E
  * 3) O status do trabalho for adequado.
  * Senão, lança uma exceção.
  **************************************************************/
  public function usuarioLogadoPodeEditar($id_trabalho) {
    //Pega ID do usuario logado.
    $user = $this->usuario_bo->getUserSession();
    $id_usuario = $user['id'];

    //Verifica se evento está na ETAPA adequada.
    //Alexdg ..... <<<<<<<<<<
    if (false) {
      throw new Exception("Etapa do evento não permite edição.");
    }
 
    //Verifica se autor logado é o autor principal do trabalho.
    if ( ! $this->isUserAutorPrincipalInTrabalho($id_usuario, $id_trabalho) ) {
       throw new Exception("Usuário não é o autor principal (primeiro autor) do trabalho.");
    }

    //Verifica se status do trabalho permite edição.
    /* @var $trabalho \Entity\Trabalho */
    $trabalho = $this->trabalho_dao->find_one_by($id_trabalho);
    $status = $trabalho->getStatus();
    if ( ($status != STATUS_TRAB_PENDENTE) ) {
      throw new Exception("Status do trabalho não permite edição.");
    }
    
    return true;
    
  }//usuarioLogadoPodeEditar()
  
  /***********************************************************
  * usuarioLogadoPodeEnviar()
   * Retorna true se:
   * 1) O usuário logado é o autor principal do trabalho E
   * 2) O evento estiver na etapa adequada E
   * 3) O status do trabalho for adequado.
   * Senão, lança uma exceção.
  **************************************************************/
  public function usuarioLogadoPodeEnviar($id_trabalho) {
    //Pega ID do usuario logado.
    $user = $this->usuario_bo->getUserSession();
    $id_usuario = $user['id'];

    //Verifica se evento está na ETAPA adequada.
    //Alexdg ..... <<<<<<<<<<
    if (false) {
      throw new Exception("Etapa do evento não permite enviar trabalho.");
    }
    
    /* @var $trabalho \Entity\Trabalho */
    $trabalho = $this->trabalho_dao->find_one_by($id_trabalho);
    $status = $trabalho->getStatus();

    //Verifica se o usuário logado é o autor principal do trabalho.
    if ( ! $this->isUserAutorPrincipalInTrabalho($id_usuario, $id_trabalho) ) {
      throw new Exception("Somente o autor principal (primeiro autor) pode efetuar o envio do trabalho.");
    }

    //Verifica se status do trabalho permite ENVIAR.
    if ( ($status != STATUS_TRAB_PENDENTE) ) {
      throw new Exception("Somente trabalho PENDENTE pode ser enviado.");
    }
    
    return true;
  
  }//usuarioLogadoPodeEnviar()
  
  /***********************************************************
  * usuarioLogadoPodeValidar()
   * Retorna true se:
   * 1) O usuário logado é o orientador principal do trabalho E
   * 2) O evento estiver na etapa adequada E
   * 3) O status do trabalho for adequado.
   * Senão, lança uma exceção.
  **************************************************************/
  public function usuarioLogadoPodeValidar($id_trabalho) {
    //Pega ID do usuario logado.
    $user = $this->usuario_bo->getUserSession();
    $id_usuario = $user['id'];
    
    //Verifica se o usuário logado é o orientador principal do trabalho.
    if (! $this->isUserOrientadorPrincipalInTrabalho($id_usuario, $id_trabalho) ) {
      throw new Exception("Somente o orientador pode VALIDAR o trabalho.");
    }

    //Verifica se evento está na ETAPA adequada.
    //Alexdg ..... <<<<<<<<<<
    if (false) {
      throw new Exception("Etapa do evento não permite VALIDAR trabalho.");
    }

    //Verifica se STATUS atual do trabalho permite VALIDAR.
    /* @var $trabalho \Entity\Trabalho */
    $trabalho = $this->trabalho_dao->find_one_by($id_trabalho);
    $status = $trabalho->getStatus();
    
    if ( $status != STATUS_TRAB_ENVIADO ) {
      throw new Exception("Somente trabalho ENVIADO pode ser VALIDADO.");
    }
    
    return true;
  }//usuarioLogadoPodeValidar()

  /***********************************************************
  * usuarioLogadoPodeInvalidar()
   * Retorna true se:
   * 1) O usuário logado é o orientador principal do trabalho E
   * 2) O evento estiver na etapa adequada E
   * 3) O status do trabalho for adequado.
   * Senão, lança uma exceção.
  **************************************************************/
  public function usuarioLogadoPodeInvalidar($id_trabalho) {
    //Pega ID do usuario logado.
    $user = $this->usuario_bo->getUserSession();
    $id_usuario = $user['id'];

    //Verifica se o usuário logado é o orientador principal do trabalho.
    if (! $this->isUserOrientadorPrincipalInTrabalho($id_usuario, $id_trabalho) ) {
      throw new Exception("Somente o orientador pode INVALIDAR o trabalho.");
    }

    //Verifica se evento está na ETAPA adequada.
    //Alexdg ..... <<<<<<<<<<
    if (false) {
      throw new Exception("Etapa do evento não permite INVALIDAR trabalho.");
    }

    //Verifica se STATUS atual do trabalho permite INVALIDAR.
    /* @var $trabalho \Entity\Trabalho */
    $trabalho = $this->trabalho_dao->find_one_by($id_trabalho);
    $status = $trabalho->getStatus();
    if ( ($status != STATUS_TRAB_PENDENTE) && ($status != STATUS_TRAB_ENVIADO)) {
      throw new Exception("Somente trabalhos PENDENTES ou ENVIADOS pode ser INVALIDADOS.");
    }
    
    return true;
  }//usuarioLogadoPodeInvalidar()


  /***********************************************************
  * usuarioLogadoPodePender()
   * Retorna true se o usuário logado pode colocar o trabalho no estado PENDENTE,
   * ou seja, se as seguintes condições são satisfeitas:
   * 1) O usuário logado é o orientador principal do trabalho E
   * 2) O evento estiver na etapa adequada E
   * 3) O status do trabalho for adequado.
   * Senão, lança uma exceção.
  **************************************************************/
  public function usuarioLogadoPodePender($id_trabalho) {
    //Pega ID do usuario logado.
    $user = $this->usuario_bo->getUserSession();
    $id_usuario = $user['id'];

    //Verifica se o usuário logado é o orientador principal do trabalho.
    if (! $this->isUserOrientadorPrincipalInTrabalho($id_usuario, $id_trabalho) ) {
      throw new Exception("Somente o orientador pode colocar o trabalho em estado PENDENTE.");
    }

    //Verifica se evento está na ETAPA adequada.
    //Alexdg ..... <<<<<<<<<<
    if (false) {
      throw new Exception("Etapa do evento não permite colocar o trabalho no estado PENDENTE.");
    }

    //Verifica se STATUS atual do trabalho permite ser colocado em PENDENTE.
    /* @var $trabalho \Entity\Trabalho */
    $trabalho = $this->trabalho_dao->find_one_by($id_trabalho);
    $status = $trabalho->getStatus();
    if ( $status != STATUS_TRAB_ENVIADO ) {
      throw new Exception("Somente trabalhos ENVIADOS podem ser colocados em PENDENTE.");
    }
    
    return true;
  }//usuarioLogadoPodePender()
  
  /***********************************************************
  * usuarioLogadoPodeCorrigir()
   * Retorna true se:
   * 1) O usuário logado é o orientador principal do trabalho E
   * 2) O evento estiver na etapa adequada E
   * 3) O status do trabalho for adequado.
   * Senão, lança uma exceção.
  **************************************************************/
  public function usuarioLogadoPodeCorrigir($id_trabalho) {
    //Pega ID do usuario logado.
    $user = $this->usuario_bo->getUserSession();
    $id_usuario = $user['id'];

    //Verifica se o usuário logado é o orientador principal do trabalho.
    if (! $this->isUserOrientadorPrincipalInTrabalho($id_usuario, $id_trabalho) ) {
      throw new Exception("Somente o orientador pode INVALIDAR o trabalho.");
    }

    //Verifica se evento está na ETAPA adequada.
    //Alexdg ..... <<<<<<<<<<
    if (false) {
      throw new Exception("Etapa do evento não permite INVALIDAR trabalho.");
    }

    //Verifica se STATUS atual do trabalho permite INVALIDAR.
    /* @var $trabalho \Entity\Trabalho */
    $trabalho = $this->trabalho_dao->find_one_by($id_trabalho);
    $status = $trabalho->getStatus();
    if ( $status != STATUS_TRAB_ENVIADO ) {
      throw new Exception("Somente trabalhos PENDENTES ou ENVIADOS pode ser INVALIDADOS.");
    }
    
    return true;
  }//usuarioLogadoPodeCorrigir()
  
  /*******************************************************************
   * valida_modalidade_trabalho_autor()
   * Retorna true se o usuario pode salvar trabalho com esta modalidade.
   * Caso contrário, gera uma excecao.
   * Se $id_trabalho < 0 entao considera que está inserindo um trabalho novo.
   * Senao, se id_trabalho >= 0, considera que está fazendo uma edição de trabalho.
   * ************************************************************ */
  function valida_modalidade_trabalho_autor($id_modalidade, $id_trabalho, $id_autor) {
    //Quantidade de trabalhos como autor principal.

    $trabalho_dao = new TrabalhoMySqlDAO();
    $trabalhos = $trabalho_dao->queryTrabalhosByAutorPrincipal($id_autor);
    $quant_trab = count($trabalhos);
    if ($quant_trab == 0) {
      return true; //ok
    }

    if ($quant_trab == 1) {
      //Tem apenas um trabalho
      //Verifica se é um trabalho com modalidade diferente 
      //$trabalhos = $autor_dao->queryTrabalhosAutorPrincipal($id_autor);
      $trabalho = $trabalhos[0];
      $fk_trabalho = $trabalho->fk_trabalho;
      $modalidade_trabalho = $trabalho->fk_modalidade;

      //Se estiver inserindo um trabalho novo.
      if ( ($id_trabalho == -1)  ) {
        if ($modalidade_trabalho != $id_modalidade) {
          //Modalidade é diferente. Ok.
          return true; //ok
        }
        else {
          //Erro: mesma modalidade.
          throw new Exception("Não é permitido mais de um trabalho do mesmo autor com mesma modalidade. Você não pode inscrever um trabalho com a mesma modalidade.");
        }
      }
      //Não está inserindo um novo trabalho.
      else {
        //Está modificando o único trabalho então pode modificar a modalidade sem necessitar nenhuma verificação.
        return true; //ok
      }

    }//quant==1

    if ($quant_trab == MAX_TRABALHOS_COMO_AUTOR_PRINCIPAL) {
      //Se estiver inserindo um novo trabalho entao NAO pode.
      if ( ($id_trabalho == -1)  ) {
        throw new Exception("Número máximo de trabalhos permitidos é ".MAX_TRABALHOS_COMO_AUTOR_PRINCIPAL);
      }
      else {
        $trabalho_dao = new TrabalhoMySqlDAO();
        $trabalho = $trabalho_dao->load($id_trabalho);
        if ($trabalho->fk_modalidade == $id_modalidade) {
          //Ok, nao está tentando modificar modalidade do trabalho.
          return true;//ok
        }
        else {
          //Já é autor de 2 trabalhos.
          //Por enquanto não é permitido mudar a modalidade.
          //Está tentando modificar a modalidade, mas não pode, pois já tem 2 trabalhos.
          throw new Exception("Não é permitido mais de um trabalho do mesmo autor com mesma modalidade. Você não pode salvar um trabalho com a mesma modalidade.");
        }
      }
    }// quant == 2

    //Mais de 2 trabalhos, algum ERRO de consistência no sistema.
    throw new Exception("Autor possui mais de ".MAX_TRABALHOS_COMO_AUTOR_PRINCIPAL." trabalhos");
  }//valida_modalidade_trabalho_autor()

}

/* End of file trabalho_bo.php */