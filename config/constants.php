<?php 

//if ( ! defined('BASEPATH')) { exit('No direct script access allowed'); }

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

define('MOSTRA_IFRS_EMAIL', "mostra@poa.ifrs.edu.br");
define('MOSTRA_IFRS_ASSINATURA_EMAIL', "Esta mensagem foi enviada automaticamente pelo sistema de " 
            .  "inscri&ccedil;&atilde;o da 16a Mostra de Ensino, Pesquisa e Extens&atilde;o do IFRS - Câmpus Porto Alegre.<br />"
            ."http://mostra.poa.ifrs.edu.br/2015/sistema");

/**********************************************************************
 * Status dos usuários
 **********************************************************************/

//<<<<<<<<<< colocar estes
//Status Usuário:
define("STATUS_USUARIO_PENDENTE", 0);
define("STATUS_USUARIO_ACEITO", 1);
define("STATUS_USUARIO_RECUSADO", 2);

$arr_status_usuario = array();
$arr_status_usuario[0] = "Pendente";
$arr_status_usuario[1] = "Aceito";
$arr_status_usuario[2] = "Recusado";

/**********************************************************************
 * Tipos de Avaliadores, orientadores, ouvintes
 **********************************************************************/

//Tipos de avaliadores:
define("TIPO_AVALIADOR_DOCENTE", 1);
define("TIPO_AVALIADOR_TECNICO_ADMINISTRATIVO", 2);
define("TIPO_AVALIADOR_ESTUDANTE_POS_GRADUACAO", 3);

$arr_tipo_avaliador = array();
$arr_tipo_avaliador[0] = "---";
$arr_tipo_avaliador[1] = "Docente";
$arr_tipo_avaliador[2] = "Técnico Administrativo";
$arr_tipo_avaliador[3] = "Estudante de Pós-graduação";

//Tipos de orientadores:
define("TIPO_ORIENTADOR_DOCENTE", 1);
define("TIPO_ORIENTADOR_TECNICO_ADMINISTRATIVO", 2);
define("TIPO_ORIENTADOR_INVALIDO", 3); //Não utilizado, para manter compatibilidade com TIPO_AVALIADOR_ESTUDANTE_POS_GRADUACAO.
define("TIPO_ORIENTADOR_OUTRO", 4); //Somente para co-orientador.

$arr_tipo_orientador = array();
$arr_tipo_orientador[0] = "---";
$arr_tipo_orientador[1] = "Docente";
$arr_tipo_orientador[2] = "Técnico Administrativo";
$arr_tipo_orientador[4] = "---";
$arr_tipo_orientador[3] = "Outro";

//Tipos de ouvintes:
define("TIPO_OUVINTE_DOCENTE", 1);
define("TIPO_OUVINTE_TECNICO_ADMINISTRATIVO", 2);
define("TIPO_OUVINTE_ESTUDANTE", 3);
define("TIPO_OUVINTE_OUTRO", 4);

$arr_tipo_ouvinte = array();
$arr_tipo_ouvinte[0] = "---";
$arr_tipo_ouvinte[1] = "Docente";
$arr_tipo_ouvinte[2] = "Técnico Administrativo";
$arr_tipo_ouvinte[3] = "Estudante";
$arr_tipo_ouvinte[4] = "Outro";

/**********************************************************************
 * Nível de curso
 **********************************************************************/

//Nivel Curso:
define("NIVEL_CURSO_TECNICO", 2);
define("NIVEL_CURSO_SUPERIOR", 3);

$arr_nivel_curso = array();
$arr_nivel_curso[0] = "---";
$arr_nivel_curso[1] = "---";
$arr_nivel_curso[2] = "Técnico";
$arr_nivel_curso[3] = "Superior";

/**********************************************************************
 * Formação (usado nos avaliadores???)
 **********************************************************************/

//Formação
define("FORMACAO_SUPERIOR", 3);
define("FORMACAO_ESPECIALIZACAO", 4);
define("FORMACAO_MESTRADO", 5);
define("FORMACAO_DOUTORADO", 6);

$arr_formacao = array();
$arr_formacao[0] = "---";
$arr_formacao[1] = "---";
$arr_formacao[2] = "---";
$arr_formacao[3] = "Superior";
$arr_formacao[4] = "Especialização";
$arr_formacao[5] = "Mestrado";
$arr_formacao[6] = "Doutorado";

/**********************************************************************
 * Constantes relativas aos TRABALHO
 **********************************************************************/

define('MAX_TRABALHOS_COMO_AUTOR_PRINCIPAL', 2);
define('MAX_AUTORES_POR_TRABALHO', 5);
define('MAX_ORIENTADORES_POR_TRABALHO', 2);

define('TRAB_QUANT_MAX_CARS_RESUMO', 3000);

//Possíveis status de um Trabalho.
define("STATUS_TRAB_PENDENTE",    0);
define("STATUS_TRAB_ENVIADO",     1);
define("STATUS_TRAB_VALIDADO",    2);
define("STATUS_TRAB_INVALIDADO",  3);
define("STATUS_TRAB_ACEITO",      4);
define("STATUS_TRAB_CORRIGIR",    5);
define("STATUS_TRAB_EM_CORRECAO", 6);
define("STATUS_TRAB_CORRIGIDO",   7);
define("STATUS_TRAB_RECUSADO",    8);

$arr_status_trab = array();
$arr_status_trab[0] = "Pendente";
$arr_status_trab[1] = "Enviado";
$arr_status_trab[2] = "Validado";
$arr_status_trab[3] = "Invalidado";
$arr_status_trab[4] = "Aceito";
$arr_status_trab[5] = "Corrigir";
$arr_status_trab[6] = "Em Correção";
$arr_status_trab[7] = "Corrigido e Enviado";
$arr_status_trab[8] = "Recusado";

$arr_status_trab_completo = array();
$arr_status_trab_completo[0] = "Trabalho pendente (autor principal deve confirmar o envio do trabalho).";
$arr_status_trab_completo[1] = "Trabalho enviado (orientador deve efetuar a validação do trabalho).";
$arr_status_trab_completo[2] = "Trabalho validado pelo orientador (aguardando homologação da comissão organizadora).";
$arr_status_trab_completo[3] = "Trabalho invalidado pelo orientador.";
$arr_status_trab_completo[4] = "Trabalho foi aceito para apresentação no evento. Aguardar publicação da data de apresentação.";
$arr_status_trab_completo[5] = "Trabalho à corrigir (autor deve efetuar correções).";
$arr_status_trab_completo[6] = "Trabalho em correção (autor está efetuando as correções).";
$arr_status_trab_completo[7] = "Trabalho corrigido e enviado (aguardando homologação da comissão organizadora).";
$arr_status_trab_completo[8] = "Trabalho não foi aceito para apresentação no evento. O parecer pode ser consultado no sistema.";

$arr_turnos= array();
$arr_turnos["M"] = "Manhã";
$arr_turnos["T"] = "Tarde";
$arr_turnos["N"] = "Noite";
$arr_turnos["X"] = "-----";

//Jean <<<<<<< como definir as consantes neste arquivo e como pegar em outros arquivos???
$GLOBALS["arr_status_usuario"] = $arr_status_usuario;
$GLOBALS["arr_tipo_avaliador"] = $arr_tipo_avaliador;
$GLOBALS["arr_tipo_orientador"] = $arr_tipo_orientador;
$GLOBALS["arr_tipo_ouvinte"] = $arr_tipo_ouvinte;
$GLOBALS["arr_nivel_curso"] = $arr_nivel_curso;
$GLOBALS["arr_formacao"] = $arr_formacao;
$GLOBALS["arr_status_trab"] = $arr_status_trab;
$GLOBALS["arr_status_trab_completo"] = $arr_status_trab_completo;
$GLOBALS["arr_turnos"] = $arr_turnos;

/**********************************************************************

 **********************************************************************/

<<<<<<< HEAD
//Habilita as etapas de inscrição, análise e correção de trabalhos.
//Autor efetua inscrição e edição de trabalho.
define("ETAPA_INSCRICAO_TRABALHO", 1);

//Não utilizada
//Orientador efetua validação do trabalho.
define("ETAPA_VALIDACAO_TRABALHO", 0);

//Revisor analisa trabalhos e emite o primeiro paracer.
define("ETAPA_ANALISE_TRABALHO_1", 0);

//Autor efetua edição (correção) de trabalho.
define("ETAPA_CORRECAO_TRABALHO_1", 0);

//Revisor analisa trabalhos e emite o segundo (último) paracer.
define("ETAPA_ANALISE_TRABALHO_2", 0);

//Todas etapas finalizadas.
define("ETAPA_TRABALHOS_HOMOLOGADOS", 0);


=======
>>>>>>> f9b405479b0aa4f88530d1c9535f52b197308e2e
//?????????????????????
//$GLOBALS["arr_status_trab"] = $arr_status_trab;
//$GLOBALS["arr_status_trab_completo"] = $arr_status_trab_completo;


/* End of file constants.php */
/* Location: ./application/config/constants.php */