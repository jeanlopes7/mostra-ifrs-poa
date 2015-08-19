<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

<<<<<<< HEAD
//só para testar comit.

//Alex <<<<<<< 
=======
//Jean <<<<<<< 
>>>>>>> f9b405479b0aa4f88530d1c9535f52b197308e2e
require_once "config/constants.php";
require_once "procedural/model/sql/ConnectionProperty.class.php";
require_once "procedural/model/sql/ConnectionFactory.class.php";
require_once "procedural/model/mysql/AutorCursoMySqlDAO.class.php";

require_once("procedural/dompdf6/dompdf_config.inc.php");

class Trabalho_ctr extends MX_Controller {


  /**
   * usuario busines object
   * @access private
   * @var Usuario_bo
   */
  private $usuario_bo;

  /**
   * trabalho business object
   * @access private
   * @var Trabalho_bo
   */
  private $trabalho_bo;

  /**
  *
  * @var Autor_curso_dao 
  */
  //private $autor_curso_dao;
  
  
    /**
     * @access private
     * @var Trabalho_vm
     */
    private $trabalho_vm;

  /*****************************************************************
   * 
   * 
   *****************************************************************/
  public function __construct() {
    parent::__construct();

    $this->load->helper('funcoes_inscricao_trabalho');
    
    $this->trabalho_vm = $this->load->model('trabalho_vm');
    
    $this->usuario_bo = $this->load->library('bo/usuario_bo');
    $this->trabalho_bo = $this->load->library('bo/trabalho_bo');
    //$this->autor_curso_dao = $this->load->library('dao/autor_curso_dao');


   // $this->autor_curso_dao = $this->load->library('proc_dao/AutorCursoMySqlDAO.class');
   // $this->con = $this->load->library('proc_dao/ConnectionFactory.class');
  }//__construct()

  /*===============================================================
   * Ações do Controller (métodos públicos)
   * index()
   * listar_trabalhos()
   * inscricao()
   * salvar_inscricao()
   * ver()
   * edicao()
   * salvar_edicao()
   ================================================================*/

  
  /*****************************************************************
   * 
   * 
   *****************************************************************/
  public function index() {
          echo 'index do trabalho';
  }//index()

  /*****************************************************************
   * 
   * 
   *****************************************************************/
  public function listar_trabalhos() {

  }//listar_trabalhos()

   /*****************************************************************
   *  inscricao()
   * Testa se é possível fazer a inscrição. Se for possível, 
   * mostra o formulário de inscrição, caso contrário, mostra página de erro.
   *****************************************************************/
  public function inscricao () {
    try {
      
      $this->trabalho_bo->usuarioLogadoPodeInscrever(); //gera exceção

      $user = $this->usuario_bo->getUserSession();
      
      // pegar áreas temáticas
      // por enquanto está fixo no arquivo HTML (deixar assim).

      // pegar categoria
      // por enquanto está fixo no arquivo HTML (deixar assim).

      // pegar modalidades
      // por enquanto está fixo no arquivo HTML (deixar assim).

      //Pegar cursos do autor principal;
      $id_usuario = $user['id'];
      //autor_curso_dao.find_one_by e find_all_by nao estao funcionando.
      //$cursos = $this->autor_curso_dao->find_one_by($id_usuario, 7);
      $autor_curso_dao = new AutorCursoMySqlDAO();
      $autor_cursos = $autor_curso_dao->loadAllCursosAutor($id_usuario);

      //Necessário para colocar como um campo oculto no formulário para evitar 
      //que insira o próprio autor principal como coautor.
      $data['autor_principal_id_aux']= $id_usuario; 
      $data['cursos_autor_principal']= $autor_cursos;
      //>>>>> Deveria pegar o email da entidade genérica Usuario
      $data['email_trabalho_autor_principal'] = $autor_cursos[0]->email;

      $data['titulo_janela'] = "Inscrição de Trabalho";
      $data['action_inscricao_edicao_trabalho'] = base_url()."trabalho/trabalho_ctr/salvar_inscricao/";
      
      $trabalho = new \Entity\Trabalho;
      //Vai precisar no controller valida trabalho.....
      $trabalho->setIdTrabalho(-1);
      
      $trabalho->setArea( new \Entity\Area);
      $trabalho->setCategoria(new \Entity\Categoria);
      $trabalho->setModalidade(new \Entity\Modalidade);
      
      $data['trabalho'] = $trabalho;

      $this->load->view('inscricao_trabalho.html.php', $data);
    }//try
    catch (Exception $ex) {
      $this->log->write_log('error', $ex->getMessage());
      $this->session->set_flashdata('erro', $ex->getMessage());
      redirect(base_url().'./usuario/autor_ctr');
    }//catch

  }//inscricao()

  /*****************************************************************
   *  salvar_inscricao()
   * Efetua a inscrição de um trabalho.
   * Insere dados na tabela Trabalho e na tabela trabalho_autor_curso.
   *****************************************************************/
  public function salvar_inscricao() {
    
    try {
      // TODO: lembrar de colocar validação no viewModel
      // * verificar se não tem autores iguais
      // * verificar se o autor não é igual ao coautor
      // * verificar se orientador e coorientador não são iguais

        $this->trabalho_bo->usuarioLogadoPodeInscrever(); //gera exceção
        
        $user = $this->usuario_bo->getUserSession();

        //Dados dos formulários da tela.
        $data_post = $this->input->post();

        //Carrega o trabalho do banco para carregar o status e outras informações que não estão na tela.
        $trabalho = new \Entity\Trabalho;

        //Pega dados da tela.
        //Se der erro, gera exceção.
        $this->tela_to_trabalho($trabalho);
        //<<<<<<<<<<<<<<<<<<<<<< Alex implementar
        //$trabalho->setIpCadastro($ip_cliente);
        //$trabalho->setIpAtualizacao($ip_cliente);
        //$trabalho->setDataCadastro($dataCadastro);
        //$trabalho->setDataAtualizacao($dataCadastro);
        //$trabalho->setSeqSessao(0);
        //$trabalho->setNivel($nivel);
        
        //Para repassar dados à próxima tela.
        //$data['trabalho'] = $trabalho;
     
        //Fazer consistencias aqui ou em tela_to_trabalho???????????

        //Pega dados do autor principal.
        $id_autor_principal = $user['id'];
        $id_curso_autor_principal       = $data_post['id_curso_autor_principal'];
        $email_trabalho_autor_principal = $data_post['email_trabalho_autor_principal'];

        //Inscreve trabalho e autor principal.
        $this->trabalho_bo->inscrever_trabalho($trabalho, $id_autor_principal, $id_curso_autor_principal, $email_trabalho_autor_principal);

        //Pega coautores da tela:
        $coautores_id       = $data_post['coautores_id'];
        $coautores_curso_id = $data_post['coautores_curso_id'];
        $coautores_email    = $data_post['coautores_email'];
        
        //Insere coautores no trabalho.
        $i = 0;
        for ($i=0; $i<sizeof($coautores_id); $i++) {
          $coautor_id = $coautores_id[$i];
          if ($coautor_id != '') {
            $coautor_curso_id = $coautores_curso_id[$i];
            $coautor_email = $coautores_email[$i];
            $this->trabalho_bo->insere_autor($trabalho->getIdTrabalho(), $coautor_id, $coautor_curso_id, $coautor_email);
          }//if
        }//for

        //Pega orientadores da tela:
        $orientadores_id       = $data_post['orientadores_id'];
        $orientadores_campus_id = $data_post['orientadores_campus_id'];
        $orientadores_email    = $data_post['orientadores_email'];

        //Insere orientadores no trabalho.
        $i = 0;
        for ($i=0; $i<sizeof($orientadores_id); $i++) {
          $orientador_id = $orientadores_id[$i];
          if ($orientador_id != '') {
            $orientador_campus_id = $orientadores_campus_id[$i];
            $orientador_email = $orientadores_email[$i];
            $this->trabalho_bo->insere_orientador($trabalho->getIdTrabalho(), $orientador_id, $orientador_campus_id, $orientador_email);
          }
        }

        $this->session->set_flashdata('aviso', 'trabalho cadastrado com sucesso');

        //carregar visualização do trabalho
        //$this->load->view('ver_editar_trabalho.html.php', $data);
        redirect(base_url().'./trabalho/trabalho_ctr/ver/'.$trabalho->getIdTrabalho());

    }//try
    
    catch (Exception $ex) {
        $this->log->write_log('error', $ex->getMessage());
        
        $this->session->set_flashdata('erro', $ex->getMessage());
        //Jean <<<<<<<< como repassar os dados que já foram preenchidos de volta para a tela de inscricao????
        
        //Redireciona para a mesma tela de inscrição ou chama a VIEW?
        //Se chamar a VIEW, aí o set_flashdata não funciona.
        redirect(base_url().'./trabalho/trabalho_ctr/inscricao');
        //$this->load->view('inscricao_trabalho.html.php', $data);

    }//catch

  }//salvar_inscricao()
  
  /*****************************************************************
  *  edicao()
  * Mostra formulário para editar os dados de um trabalho
  *****************************************************************/
  public function edicao($id_trabalho) {
    
    try {
      
    //Pega o ID do usuário logado.
    $user = $this->usuario_bo->getUserSession();
    $id_usuario = $user['id'];
    
    //Verifica se o usuário tem direito a editar o trabalho.
    $this->trabalho_bo->usuarioLogadoPodeEditar($id_trabalho); //gera exceção
    
    //Pega informações do trabalho.
    $trabalho = $this->trabalho_bo->get_trabalho2($id_trabalho);
    
    //Pega todos autores do trabalho.
    $coautores = $this->trabalho_bo->get_autores_trabalho_order_by_seq($id_trabalho);
    $data['id_curso_autor_principal'] = $coautores[0]->fk_curso;
    
    //Retira o autor principal e fica só com os coautores.
    $coautores[0]=$coautores[1];
    $coautores[1]=$coautores[2];
    $coautores[2]=$coautores[3];
    $coautores[3]=$coautores[4];
    $coautores[4]= null;
    
    //Pegar cursos do autor principal;
    //autor_curso_dao.find_one_by e find_all_by nao estao funcionando.
    //$cursos = $this->autor_curso_dao->find_one_by($id_usuario, 7);
    $autor_curso_dao = new AutorCursoMySqlDAO();
    $autor_cursos = $autor_curso_dao->loadAllCursosAutor($id_usuario);
    $data['cursos_autor_principal']= $autor_cursos;
    $data['email_trabalho_autor_principal'] = $autor_cursos[0]->email;

    //Necessário para colocar como um campo oculto no formulário para evitar 
    //que insira o próprio autor principal como coautor.
    $data['autor_principal_id_aux']= $id_usuario; 

    //Pega todos orientadores do trabalho.
    $orientadores = $this->trabalho_bo->get_orientadores_trabalho_order_by_seq($id_trabalho);

    $data['trabalho']                 = $trabalho;
    $data['coautores_do_trabalho']    = $coautores;
    $data['orientadores_do_trabalho'] = $orientadores;
    $data['titulo_janela'] = "Edição de Trabalho";
    $data['action_inscricao_edicao_trabalho'] = base_url()."trabalho/trabalho_ctr/salvar_edicao/".$id_trabalho;
    
    $this->load->view('inscricao_trabalho.html.php', $data);
    
    }
    catch (Exception $ex) {
        $this->log->write_log('error', $ex->getMessage());
        $this->session->set_flashdata('erro', $ex->getMessage());

        //Jean <<<<<<<< como repassar os dados que já foram preenchidos de volta para a tela de inscricao????
        
        //Redireciona para a mesma tela de inscrição ou chama a VIEW?
        //Se chamar a VIEW, aí o set_flashdata não funciona.
        redirect(base_url().'./autor/autor_ctr/'.$trabalho->id_trabalho);
        //$this->load->view('inscricao_trabalho.html.php', $data);
    }//catch

  }//edicao()

  /*****************************************************************
  *  salvar_edicao()
  * Atualiza os dados de um trabalho.
  *****************************************************************/
  public function salvar_edicao($id_trabalho) {
    /*    
    $data_post = $this->input->post();
    $str = $data_post['cresumo'];
    
    echo $str;
    echo "\n******************************************\n";
    $str = strip_tags($str);
    echo $str;
    echo "\n******************************************\n";
    
    $str = html_entity_decode($str);
    echo $str;
    echo "\n******************************************\n";
    
    $str = str_replace("\n", "", $str);
    echo $str;
    echo "\n******************************************\n";

    $str = str_replace("\r", "", $str);
        echo $str;
    echo "\n******************************************\n";

    $str = str_replace(" ", "", $str);
        echo $str;
    echo "\n******************************************\n";
    
    die();
    */
    
    try {

      if ($this->valida_salvar_inscricao_redirect() ) {
        $user = $this->usuario_bo->getUserSession();

        //Dados dos formulários da tela.
        $data_post = $this->input->post();

        //Carrega o trabalho do banco para carregar o status e outras informações que não estão na tela.
        $trabalho = $this->trabalho_bo->get_trabalho2($id_trabalho);

        //Pega dados da tela.
        $this->tela_to_trabalho($trabalho);
        //$trabalho->setIdTrabalho($id_trabalho);
        //<<<<<<<<<<<<<<<<<<<<<< Alex implementar
        //$trabalho->setIpCadastro($ip_cliente);
        //$trabalho->setIpAtualizacao($ip_cliente);
        //$trabalho->setDataCadastro($dataCadastro);
        //$trabalho->setDataAtualizacao($dataCadastro);
        //$trabalho->setSeqSessao(0);
        //$trabalho->setNivel($nivel);
        
        //Para repassar dados à próxima tela.
        //$data['trabalho'] = $trabalho;
     
        //Fazer consistencias aqui ou em tela_to_trabalho???????????

        //Pega dados do autor principal.
        $id_autor_principal = $user['id'];
        $id_curso_autor_principal       = $data_post['id_curso_autor_principal'];
        $email_trabalho_autor_principal = $data_post['email_trabalho_autor_principal'];

        //Salva trabalho.
        $this->trabalho_bo->salvar_dados_trabalho($trabalho);

        //Pega todos os autores do trabalho.
        $coautores = $this->trabalho_bo->get_autores_trabalho_order_by_seq($id_trabalho);
        //Retira o autor principal e fica só com os coautores.
        $coautores[0]=$coautores[1];
        $coautores[1]=$coautores[2];
        $coautores[2]=$coautores[3];
        $coautores[3]=$coautores[4];
        //$data['id_curso_autor_principal'] = $coautores[0]->fk_curso;

        //Pega coautores da tela:
        $coautores_id       = $data_post['coautores_id'];
        $coautores_curso_id = $data_post['coautores_curso_id'];
        $coautores_email    = $data_post['coautores_email'];
        
        //Verifica se algum coautor do trabalho não está mais na tela (então tem que excluí-lo do trabalho).
        foreach ($coautores as $coautor) {
          //Verifica se coautor não está mais na tela.
          if ( !in_array($coautor->fk_autor, $coautores_id) ){
            $this->trabalho_bo->remove_autor($id_trabalho, $coautor->fk_autor);
            //echo "Remove:".$coautor->fk_autor." ";
          }//if
        }//foreach
        
        //Verifica se o autor da tela não está no trabalho (então tem que incluílo)
        $i = 0;
        for ($i=0; $i<sizeof($coautores_id); $i++) {
          $coautor_id = $coautores_id[$i];
          if ($coautor_id != '') {
            if (! $this->trabalho_bo->isUserInTrabalho($coautor_id, $id_trabalho)) {
              $coautor_curso_id = $coautores_curso_id[$i];
              $coautor_email = $coautores_email[$i];
              $this->trabalho_bo->insere_autor($id_trabalho, $coautor_id, $coautor_curso_id, $coautor_email);
              //echo "Insere: ".$coautor_id.$coautor_curso_id;
            }
          }//if
        }//for
        
        //Pega todos orientadores do trabalho.
        $orientadores = $this->trabalho_bo->get_orientadores_trabalho_order_by_seq($id_trabalho);
        
        //Pega orientadores da tela:
        $orientadores_id       = $data_post['orientadores_id'];
        $orientadores_campus_id = $data_post['orientadores_campus_id'];
        $orientadores_email    = $data_post['orientadores_email'];
        
        //Verifica se algum orientador do trabalho não está mais na tela (então tem que excluí-lo do trabalho).
        foreach ($orientadores as $orientador) {
          //Verifica se orientador não está mais na tela.
          if ( !in_array($orientador->fk_orientador, $orientadores_id) ){
            $this->trabalho_bo->remove_orientador($id_trabalho, $orientador->fk_orientador);
            //echo "Remove:".$coautor->fk_autor." ";
          }//if
        }//foreach

        //Verifica se o orientador da tela não está no trabalho (então tem que incluílo)
        $i = 0;
        for ($i=0; $i<sizeof($orientadores_id); $i++) {
          $orientador_id = $orientadores_id[$i];
          if ($orientador_id != '') {
            if (! $this->trabalho_bo->isUserInTrabalho($orientador_id, $id_trabalho)) {
              $orientador_campus_id = $orientadores_campus_id[$i];
              $orientador_email = $orientadores_email[$i];
              $this->trabalho_bo->insere_orientador($id_trabalho, $orientador_id, $orientador_campus_id, $orientador_email);
              //echo "Insere: ".$orientador_id.",".$orientador_campus_id;
            }
          }//if
        }//for
        
        $this->session->set_flashdata('aviso', 'trabalho salvo com sucesso');

        //carregar visualização do trabalho
        //$this->load->view('ver_editar_trabalho.html.php', $data);
        redirect(base_url().'./trabalho/trabalho_ctr/ver/'.$trabalho->getIdTrabalho());
        

      }//if

    }//try
    
    catch (Exception $ex) {
        $this->log->write_log('error', $ex->getMessage());
        
        $this->session->set_flashdata('erro', $ex->getMessage());
        //Jean <<<<<<<< como repassar os dados que já foram preenchidos de volta para a tela de inscricao????
        
        //Redireciona para a mesma tela de inscrição ou chama a VIEW?
        //Se chamar a VIEW, aí o set_flashdata não funciona.
        //redirect(base_url().'./trabalho/trabalho_ctr/edicao/'.$trabalho->getIdTrabalho());
        $this->load->view('inscricao_trabalho.html.php', $data);

    }//catch


  }//salvar_edicao()
  

  /*****************************************************************
  *  ver()
  * Mostra os dados de um trabalho
  *****************************************************************/
  public function ver($id_trabalho) {
    /* @var $trabalho \Entity\Trabalho */
    
    //Pega o ID do usuário logado.
    $user = $this->usuario_bo->getUserSession();
    
    $id_usuario = $user['id'];
    //Verifica se o usuário tem direito a visualizar o trabalho.
    if (! $this->trabalho_bo->isUserInTrabalho($id_usuario, $id_trabalho) ) {
      //Jean<<<< mensagem de erro nao aparece.
      //Soh aparece se eu enviar para usuario/autor_ctr
      $this->session->set_flashdata('erro', "Usuário não está vinculado a esse trabalho.");
      redirect(base_url().'./usuario/usuario_ctr');
    };

    //Pega informações do trabalho.
    $trabalho = $this->trabalho_bo->get_trabalho2($id_trabalho);

    $autores = $this->trabalho_bo->get_autores_trabalho_order_by_seq($id_trabalho);
    $orientadores = $this->trabalho_bo->get_orientadores_trabalho_order_by_seq($id_trabalho);

    $id_autor_principal = $autores[0]->fk_autor;
    if ($id_autor_principal == $id_usuario) {
      $is_autor_principal_do_trabalho = true;
    }
    else {
       $is_autor_principal_do_trabalho = false;
    }
    
    $id_orientador_principal = $orientadores[0]->fk_orientador;
    if ($id_orientador_principal == $id_usuario) {
      $is_orientador_principal_do_trabalho = true;
    }
    else {
      $is_orientador_principal_do_trabalho = false;
    }
    
    //Habilita/desabilita botões da tela.
    
    try {
      $data['mostrar_botao_editar_trabalho']    = $this->trabalho_bo->usuarioLogadoPodeEditar($id_trabalho);
    }
    catch (Exception $ex) {
      $data['mostrar_botao_editar_trabalho']    = false;
    }

    try {
      $data['mostrar_botao_enviar_trabalho']    = $this->trabalho_bo->usuarioLogadoPodeEnviar($id_trabalho);
    }
    catch (Exception $ex) {
      $data['mostrar_botao_enviar_trabalho']   = false;
    }
     
    try {
      $data['mostrar_botao_validar_trabalho']   = $this->trabalho_bo->usuarioLogadoPodeValidar($id_trabalho);
    }
    catch (Exception $ex) {
      $data['mostrar_botao_validar_trabalho']   = false;
    }
    
    try {
      $data['mostrar_botao_invalidar_trabalho'] = $this->trabalho_bo->usuarioLogadoPodeInvalidar($id_trabalho);
    }
    catch (Exception $ex) {
      $data['mostrar_botao_invalidar_trabalho'] = false;
    }

    try {
      $data['mostrar_botao_corrigir_trabalho'] = $this->trabalho_bo->usuarioLogadoPodeCorrigir($id_trabalho);
    }
    catch (Exception $ex) {
      $data['mostrar_botao_corrigir_trabalho'] = false;
    }

    //URL de Retorno
    
    if ($this->trabalho_bo->isUserAutorInTrabalho($id_usuario, $id_trabalho)) {
      $url_voltar = base_url()."usuario/autor_ctr/";
    }
    else if ($this->trabalho_bo->isUserOrientadorInTrabalho($id_usuario, $id_trabalho)) {
      $url_voltar = base_url()."usuario/orientador_ctr/";
    }
    else {
      $url_voltar = base_url()."home/home_ctr";
    }

    $data['url_voltar'] = $url_voltar;
    
    $data['trabalho']     = $trabalho;
    $data['autores_do_trabalho']      = $autores;
    $data['orientadores_do_trabalho'] = $orientadores;
    
    $this->load->view('ver_editar_trabalho.html.php', $data);
    
  }//ver()
  
  /*****************************************************************
  *  ver_prepara_pdf()
  * Gera um HTML no formato do trabalho a ser impresso em PDF.
  *****************************************************************/
  public function ver_prepara_pdf($id_trabalho) {

    //Pega o ID do usuário logado.
    $user = $this->usuario_bo->getUserSession();
    $id_usuario = $user['id'];
    //Verifica se o usuário tem direito a visualizar o trabalho.
    if (! $this->trabalho_bo->isUserInTrabalho($id_usuario, $id_trabalho) ) {
      throw new Exception("Usuário não está vinculado a esse trabalho");
    };

    //Pega informações do trabalho.
    $trabalho = $this->trabalho_bo->get_trabalho($id_trabalho);
    $autores = $this->trabalho_bo->get_autores_trabalho_order_by_seq($id_trabalho);
    $orientadores = $this->trabalho_bo->get_orientadores_trabalho_order_by_seq($id_trabalho);

    $data['trabalho']     = $trabalho;
    $data['autores_do_trabalho']      = $autores;
    $data['orientadores_do_trabalho'] = $orientadores;
    
<<<<<<< HEAD
    $this->load->view('ver_prepara_pdf3.html.php', $data);
=======
    $this->load->view('ver_prepara_pdf.html.php', $data);
>>>>>>> f9b405479b0aa4f88530d1c9535f52b197308e2e
    
  }//ver_prepara_pdf()

/*****************************************************************
   * Retorna o arquivo HTML do qual será gerado o PDF.
   * 
   *****************************************************************/
  public function gerar_pdf($id_trabalho) {
<<<<<<< HEAD
    
=======
    /*
>>>>>>> f9b405479b0aa4f88530d1c9535f52b197308e2e
    //Pega o ID do usuário logado.
    $user = $this->usuario_bo->getUserSession();
    $id_usuario = $user['id'];
    //Verifica se o usuário tem direito a visualizar o trabalho.
    if (! $this->trabalho_bo->isUserInTrabalho($id_usuario, $id_trabalho) ) {
      throw new Exception("Usuário não está vinculado a esse trabalho");
    };

    //Pega informações do trabalho.
    $trabalho = $this->trabalho_bo->get_trabalho($id_trabalho);
    $autores = $this->trabalho_bo->get_autores_trabalho_order_by_seq($id_trabalho);
    $orientadores = $this->trabalho_bo->get_orientadores_trabalho_order_by_seq($id_trabalho);

    $data['trabalho']     = $trabalho;
    $data['autores_do_trabalho']      = $autores;
    $data['orientadores_do_trabalho'] = $orientadores;

    //O terceiro parâmetro (true) especifica para não direcionar para a view,
    //mas sim, para retornar o conteúdo HTML gerado pela view.

<<<<<<< HEAD
    $var_html = ('<html>
    <head>
      <style type="text/css">{
              ');
    $var_html = $var_html.$this->load->view('topo_pdf.html.php', $data, true);
    $var_html = $var_html.('<td class="logo_pdf" align="left"><img src="logo.png" style="width: 235px; heigth: 85px;" /></td>');
    $var_html = $var_html.$this->load->view('tela_pdf.html.php', $data, true);
    $var_html = $var_html.('</div></body></html>');
=======

    $var_html = $this->load->view('ver_prepara_pdf2.html.php', $data, true);

>>>>>>> f9b405479b0aa4f88530d1c9535f52b197308e2e


    //Colocar aqui o código para gerar o PDF a partir do DOMPDF.
    //... 
<<<<<<< HEAD

=======
*/
    
    $var_html = "<html><body>teste</body></html>";
>>>>>>> f9b405479b0aa4f88530d1c9535f52b197308e2e
    
  $local = array("::1", "127.0.0.1");
  $is_local = in_array($_SERVER['REMOTE_ADDR'], $local);
  if (get_magic_quotes_gpc())
      {
        $var_html = stripslashes($var_html);
      }
  $dompdf = new DOMPDF();
  $dompdf->load_html($var_html); 
  $dompdf->set_paper("a4","portrait");
  $dompdf->render();

  //$dompdf->stream("dompdf_out.pdf", array("Attachment" => true));
  //$dompdf->stream("dompdf_out.pdf", array("Attachment" => false));
  
  //$dompdf->stream("ficha_avaliacao_".str_pad($id_trabalho, 3, "0", STR_PAD_LEFT)."_".$seq.".pdf", array("Attachment" => false));

<<<<<<< HEAD
$dompdf->stream("ficha_avaliacao_".$trabalho->id_trabalho, array("Attachment" => false));
=======
$dompdf->stream("ficha_avaliacao", array("Attachment" => false));
>>>>>>> f9b405479b0aa4f88530d1c9535f52b197308e2e

  }//gerar_pdf()

  /*****************************************************************
   * Função chamada pelo AJAX da tela inscricao_trabalho
  *****************************************************************/
  public function get_titulo($id_trabalho) {
    $titulo = $this->trabalho_bo->get_titulo($id_trabalho);
    echo $titulo;
  }//get_titulo()
  
  /*****************************************************************
   * Função chamada pelo AJAX da tela inscricao_trabalho
  *****************************************************************/
  public function get_resumo($id_trabalho) {
    $titulo = $this->trabalho_bo->get_resumo($id_trabalho);
    echo $titulo;
  }//get_resumo()

  /*****************************************************************
  *****************************************************************/
  public function enviar($id_trabalho) {
    try {
      if ($this->trabalho_bo->usuarioLogadoPodeEnviar($id_trabalho)) {
        //Envia trabalho
        $this->trabalho_bo->enviar($id_trabalho);
        $this->session->set_flashdata('aviso', "Trabalho enviado com sucesso. O orientador deverá VALIDAR o trabalho para que o mesmo possa ser analisado pela comissão organizadora do evento.");
        redirect(base_url().'./trabalho/trabalho_ctr/ver/'.$id_trabalho);
      }
      //Não precisa else pois deveria gerar exceção.
      
    }//try
    
    catch (Exception $ex) {
      $this->log->write_log('error', "Erro ao enviar trabalho: ".$ex->getMessage());
      $this->session->set_flashdata('erro', "Erro ao enviar trabalho: ".$ex->getMessage());
      redirect(base_url().'./trabalho/trabalho_ctr/ver/'.$id_trabalho);
    }//catch
    
  }//enviar()

  /*****************************************************************
  *****************************************************************/
  public function validar($id_trabalho) {
    try {
      if ($this->trabalho_bo->usuarioLogadoPodeValidar($id_trabalho)) {
        //Valida trabalho
        $this->trabalho_bo->validar($id_trabalho);
        $this->session->set_flashdata('aviso', "Trabalho VALIDADO com sucesso. Aguarde análise da comissão organizadora do evento.");
        redirect(base_url().'./trabalho/trabalho_ctr/ver/'.$id_trabalho);
      }//if
      //Não precisa else pois deveria gerar exceção.
      
    }//try
    catch (Exception $ex) {
      $this->log->write_log('error', "Erro ao validar trabalho: ".$ex->getMessage());
      $this->session->set_flashdata('erro', "Erro ao validar trabalho: ".$ex->getMessage());
      redirect(base_url().'./trabalho/trabalho_ctr/ver/'.$id_trabalho);
    }//catch
  }//validar()

  /*****************************************************************
  *****************************************************************/
  public function invalidar($id_trabalho) {
    try {
      if ($this->trabalho_bo->usuarioLogadoPodeInvalidar($id_trabalho)) {
        //Invalida trabalho
        $this->trabalho_bo->invalidar($id_trabalho);
        $this->session->set_flashdata('aviso', "O trabalho foi INVALIDADO pelo orientador e portanto não será analisado pela comissão organizadora do evento.");
        redirect(base_url().'./trabalho/trabalho_ctr/ver/'.$id_trabalho);
      }//if
      //Não precisa else pois deveria gerar exceção.

    }//try
    catch (Exception $ex) {
      $this->log->write_log('error', "Erro ao invalidar trabalho: ".$ex->getMessage());
      $this->session->set_flashdata('erro', "Erro ao invalidar trabalho: ".$ex->getMessage());
      redirect(base_url().'./trabalho/trabalho_ctr/ver/'.$id_trabalho);
    }//catch
  }//invalidar()
    
  /*****************************************************************
   * pender()
   * Colocar o trabalho no estado pendente
  *****************************************************************/
  public function pender($id_trabalho) {
    try {
      if ($this->trabalho_bo->usuarioLogadoPodePender($id_trabalho)) {
        //Coloca trabalho no estado PENDENTE.
        $this->trabalho_bo->pender($id_trabalho);
        $this->session->set_flashdata('aviso', "O trabalho foi colocado no estado PENDENTE para permitir ao autor efetuar correções. O autor deverá ENVIAR novamente o trabalho e o orientador deverá VALIDAR ou INVALIDAR o trabalho.");
        redirect(base_url().'./trabalho/trabalho_ctr/ver/'.$id_trabalho);
      }//if
      //Não precisa else pois deveria gerar exceção.

    }//try
    catch (Exception $ex) {
      $this->log->write_log('error', "Erro na solicitação para colocar o trabalho no estado PENDENTE: ".$ex->getMessage());
      $this->session->set_flashdata('erro', "Erro na solicitação para colocar o trabalho no estado PENDENTE: ".$ex->getMessage());
      redirect(base_url().'./trabalho/trabalho_ctr/ver/'.$id_trabalho);
    }//catch
  }//pender()

  /*****************************************************************
   * corrigir()
  *****************************************************************/
  public function corrigir($id_trabalho) {
    
    return; //<<<<<<<<<<<<<<<<<<<<<<<
    
    //<<<<<<<<<<<<<<<<<<<< ver mensagens <<<<<<
    
    try {
      if ($this->trabalho_bo->usuarioLogadoPodeCorrigir($id_trabalho)) {        
        //Coloca trabalho no estado CORRIGIR
        $this->trabalho_bo->corrigir($id_trabalho);
        $this->session->set_flashdata('aviso', "O trabalho foi colocado no estado A CORRIGIR. O autor deverá efetuar as modificações solicitas e ENVIAR novamente o trabalho. Após enviar o trabalho não haverá mais possibilidade de modificações no mesmo.");
        redirect(base_url().'./trabalho/trabalho_ctr/ver/'.$id_trabalho);
      }//if
      //Não precisa else pois deveria gerar exceção.

    }//try
    catch (Exception $ex) {
      $this->log->write_log('error', "Erro na solicitação CORRIGIR TRABALHO: ".$ex->getMessage());
      $this->session->set_flashdata('erro', "Erro na solicitação CORRIGIR TRABALHO: ".$ex->getMessage());
      redirect(base_url().'./trabalho/trabalho_ctr/ver/'.$id_trabalho);
    }//catch
  }//corrigir()

  public function excluir($id_trabalho){
    
  }
  
  public function inserir_coautor() {
    
  }

  public function inserir_orientador() {
    
  }
  
  /*****************************************************************
   * Funções chamadas por ajax.
  *****************************************************************/

  /*****************************************************************
  *  validaSalvar()
  * Chamada por Ajax.
  * Valida e retorna ok se o trabalho pode ser salvo,
  * senão, retorna uma mensagem de erro.
  *****************************************************************/
  public function validaSalvar($id_trabalho) {
    
    try {
      $user = $this->usuario_bo->getUserSession();
      $id_usuario = $user['id'];
    
      $data_post = $this->input->post();
      //$resumo = $data_post["cresumo"];
      //echo "xxxxx";
      //die();

      //$trabalho = new \Entity\Trabalho;
      //Pega dados da tela.
      //Se der erro, gera exceção.
      //$id_trabalho;
      //$titulo = mysql_real_escape_string($data["cTitulo"]);
      //$titulo_ordenar = html_entity_decode(strip_tags($titulo), ENT_QUOTES, "UTF-8");
      
      $resumo = $data_post["resumo_ajax"];
      if ($resumo == '') {
        echo "Resumo do trabalho não preenchido";
        return;
      }
      //<<<<<<<<<<<<<<<<<< Alex implementar<<<<<<<<<<<<<<<<<<<<<<<<<
      $quant_cars_resumo = tamanho_resumo($resumo);

      if ($quant_cars_resumo > TRAB_QUANT_MAX_CARS_RESUMO) {
        echo "Resumo com ".$quant_cars_resumo." caracteres. Excedeu o máximo permitido (".TRAB_QUANT_MAX_CARS_RESUMO." caracteres)";
        return;
      }
      
      try {
        //Verifica modalidade do trabalho.
        $id_modalidade = $data_post["id_modalidade"];
        $this->trabalho_bo->valida_modalidade_trabalho_autor($id_modalidade, $id_trabalho, $id_usuario);
      }
      catch (Exception $ex) {
        echo $ex->getMessage();
        return;
      }
      
      //Se chegou aqui então está ok.
      echo "ok";
    }
    catch (Exception $ex){
      echo $ex->getMessage();
    }
  }//validaSalvar()
  
  /*===============================================================
   * Ações internas do Controller (métodos privados)   
   ================================================================*/
  
  /*****************************************************************
   *  valida_inscricao_redirect()
   * Testa se é possível fazer a inscrição senão redireciona.
   * Retorno:
   * true = ok
   * false = erro na validacao. Na verdade vai redirecionar, não vai chegar a retornar false.
  *****************************************************************/
  private function valida_inscricao_redirect() {
    $user = $this->usuario_bo->getUserSession();
    $canMake = $this->trabalho_bo->canMakeTrabalho($user['id']);

    $aviso = "não é possível cadastrar trabalho";
    
    //Verifica se está na ETAPA_INSCRICAO_TRABALHO
    //...
    if (false) {
      $aviso = "Etapa de inscrição de trabalhos encerrada.";
    }

    //Verifica se o autor esgotou o número máximo de trabalhos como autor principal (2).
    if (false) {
      $aviso = "Autor atingiu número máximo de trabalhos permitidos como autor principal (2).";
    }
    
    //>>>>>> Deveria testar os diveros tipos de erros possíveis e dar a mensagem adequada.
    if ($canMake) {
      return true;
    }
    else {
<<<<<<< HEAD
        $this->session->set_flashdata('aviso', $aviso);
        redirect(base_url().'usuario/autor_ctr/index');
=======
    	$this->session->set_flashdata('aviso', $aviso);
    	redirect(base_url().'usuario/autor_ctr/index');
>>>>>>> f9b405479b0aa4f88530d1c9535f52b197308e2e
        return false; //<<<<<<<< talvez não precise (mas deixa assim).
    }
  }//valida_inscricao_redirect()

  /*****************************************************************
   *  valida_salvar_inscricao_redirect()
   * Verifica se dados da interface estão consistentes senão redireciona para página de erro.
   * Retorno:
   * true = ok
   * false = dados não são consistentes, vai redirecionar para página de erro e não chega a retornar true.
   *****************************************************************/
  private function valida_salvar_inscricao_redirect() {
    
    if (!$this->valida_inscricao_redirect() ) {
      return false; //
    }
    
    $validacao = 1;
    
    $user = $this->usuario_bo->getUserSession();
    //Dados dos formulários da tela.
    $data_post = $this->input->post();

    //Verifica se tamanho do resumo está correto.
    //$tam_resumo = tamanho_resumo($resumo);
    //if ($tam_resumo > QUANT_MAX_CARS_RESUMO) {
   //   $validacao = -$tam_resumo;
    //}
    
    //verifica turnos
    //if ( !valida_turnos($turno1, $turno2, $turno3) ) {
      //turnos inválidos.
     // return 6;
    //}

    if ($validacao == 1) {
      return true;
    }
    else if ($validacao < 0) {
      $erro = "Quantidade máxima de caracteres no resumo está errada.";
    }
    else if ($validacao == 2) {
      $erro = "erro 2";
    }
    else if ($validacao == 3) {
      $erro = "erro 3";
    }
    else {
      $erro = "erro x";
    }
    //redireciona.
    
    //Não deve chegar a retornar 
    return false;

  }//valida_salvar_inscricao_redirect()

  /*****************************************************************
   *  tela_to_trabalho()
   * Pega os dados da interface, instanciando e retornando um 
   * um objeto \Entity\Trabalho
   *****************************************************************/
  private function tela_to_trabalho(\Entity\Trabalho $trabalho) {

    //Pega dados da interface.
    $data = $this->input->post();

    //$id_usuario = (int) $_SESSION["id_usuario"];
    $titulo = $data["ctitulo"];
    if ($titulo == '') {
      throw new Exception("Título do trabalho não preenchido");
    }

    //$titulo = mysql_real_escape_string($data["cTitulo"]);
    //$titulo_ordenar = html_entity_decode(strip_tags($titulo), ENT_QUOTES, "UTF-8");
    $resumo = $data["cresumo"];
    if ($resumo == '') {
      throw new Exception("Resumo do trabalho não preenchido");
    }
    
    //<<<<<<<<<<<<<<<<<< Alex implementar<<<<<<<<<<<<<<<<<<<<<<<<<
    $quant_cars_resumo = tamanho_resumo($resumo);
    if ($quant_cars_resumo > TRAB_QUANT_MAX_CARS_RESUMO) {
      throw new Exception("Resumo com ".$quant_cars_resumo." caracteres. Excedeu o máximo permitido (".TRAB_QUANT_MAX_CARS_RESUMO." caracteres)");
    }

    //Campo é obrigatório <<<<<<<<<<<<<<<<<<
    $resumo2 = "---";
    //Se for usar mysql_real_escape_string() tem que ser depois de tamanho_resumo().
    //$resumo = mysql_real_escape_string($resumo);
    //$resumo2 = html_entity_decode(strip_tags($resumo), ENT_QUOTES, "UTF-8");
    $palavra1 = html_entity_decode($data["palavra1"]);
    if ($palavra1 == '') {
      throw new Exception("Palavra-chave 1 não preenchida");
    }
    $palavra2 = html_entity_decode($data["palavra2"]);
    if ($palavra2 == '') {
      throw new Exception("Palavra-chave 2 não preenchida");
    }
    $palavra3 = html_entity_decode($data["palavra3"]);
    if ($palavra3 == '') {
      throw new Exception("Palavra-chave 3 não preenchida");
    }
    $id_area = (int) $data["id_area"];
    if ($id_area <= 0) {
      throw new Exception("Área temática não preenchida");
    }
    $id_categoria = (int) $data["id_categoria"];
    if ($id_categoria <= 0) {
      throw new Exception("Categoria não preenchida");
    }
    $id_modalidade = (int) $data["id_modalidade"];
    if ($id_modalidade <= 0) {
      throw new Exception("Modalidade não preenchida");
    }
    $apoiadores = html_entity_decode($data["apoiadores"]);
    $turno1 = $data["turno1"];
    $turno2 = $data["turno2"];
    $turno3 = $data["turno3"];
    if ($turno1 == '') {
      throw new Exception("Turno preferencial 1 não foi escolhido");
    }
    if ($turno1 == '') {
      throw new Exception("Turno preferencial 2 não foi escolhido");
    }
    if ($turno1 == '') {
      throw new Exception("Turno preferencial 3 não foi escolhido");
    }
    if ( ($turno1==$turno2) || ($turno1==$turno3) || ($turno2==$turno3) ) {
      throw new Exception("Os três turnos devem ser diferentes");
    }

    //Nao instancia trabalho pois estah vindo por parametro.
    //$trabalho = new \Entity\Trabalho;
    
    $trabalho->setTitulo($titulo);
    //$trabalho->setTituloOrdenar($titulo_ordenar);
    $trabalho->fk_area = $id_area;
    $trabalho->fk_categoria = $id_categoria;
    $trabalho->fk_modalidade = $id_modalidade;
    $trabalho->setResumo($resumo);
    $trabalho->setResumo2($resumo2);
    $trabalho->setPalavra1($palavra1);
    $trabalho->setPalavra2($palavra2);
    $trabalho->setPalavra3($palavra3);
    $trabalho->setApoiadores($apoiadores);
    $trabalho->setTurno1($turno1);
    $trabalho->setTurno2($turno2);
    $trabalho->setTurno3($turno3);

    return $trabalho;
  }//tela_to_trabalho()
  
}

/* End of file trabalho_ctr.php */
/* Location: ./application/controllers/trabalho_ctr.php */
