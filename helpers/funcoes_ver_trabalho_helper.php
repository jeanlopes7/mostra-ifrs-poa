<?php
//require_once "../config/constants.php";
//require_once "constantes_inscricao_trabalho.php";

/* * ***********************************************************
 *  mostra_status_trabalho
 * Retorna o texto a ser mostrado sobre o status do trabalho,
 * consierando a ETAPA de inscrição.
 * ************************************************************* */
function mostra_status_trabalho($status, $is_organizador) {
  
  $arr_status_trab = $GLOBALS["arr_status_trab"];
  
  //Alguns status não podem ser mostrados pois os Revisores poderão emitir 
  //parecer nessas etapas, e o novo status devido ao parecer não podem ser mostrados
  //aos autores e orientadores.
  if ( (ETAPA_INSCRICAO_TRABALHO == 1) || (ETAPA_ANALISE_TRABALHO_1 == 1) ) {
    //PENDENTE, ENVIADO, VALIDADO, INVALIDADO
    if ( ($status == STATUS_TRAB_PENDENTE) || ($status == STATUS_TRAB_ENVIADO) || ($status == STATUS_TRAB_VALIDADO) || ($status == STATUS_TRAB_INVALIDADO) ) {
      $texto_status_trabalho = $arr_status_trab[$status];
    }
    else if ($is_organizador) {
      $texto_status_trabalho = $arr_status_trab[$status];
    }
    else {
      $texto_status_trabalho = "Em análise";
    }
  }

  //Pode mostrar o status pois os Revisores não podem emitir parecer nessa etapa.
  if (ETAPA_CORRECAO_TRABALHO_1 == 1) {
    $texto_status_trabalho = $arr_status_trab[$status];
  }
  
  if ( ETAPA_ANALISE_TRABALHO_2 == 1 ) {
    if ($is_organizador) {
      $texto_status_trabalho = $arr_status_trab[$status];
    }
    else {
      switch ($status){
        case STATUS_TRAB_PENDENTE:
        case STATUS_TRAB_ENVIADO:
        case STATUS_TRAB_VALIDADO:
        case STATUS_TRAB_INVALIDADO:
        case STATUS_TRAB_CORRIGIR:
        case STATUS_TRAB_EM_CORRECAO:
        case STATUS_TRAB_CORRIGIDO:
        case STATUS_TRAB_ACEITO:   //<<<<< Na verdade só poderia mostrar se tiver apenas um parecer.
        case STATUS_TRAB_RECUSADO: //<<<<< Na verdade só poderia mostrar se tiver apenas um parecer.
          $texto_status_trabalho = $arr_status_trab[$status];
          break;
        default:
          $texto_status_trabalho = "Em análise";
      }//switch
    }//else
  }

  if ( ETAPA_TRABALHOS_HOMOLOGADOS == 1 ) {
    $texto_status_trabalho = $arr_status_trab[$status];
  }

  return $texto_status_trabalho;
}//mostra_status_trabalho()

function mostra_status_trabalho_completo($status, $is_organizador) {
  
  $arr_status_trab_completo = $GLOBALS["arr_status_trab_completo"];
  
  //Alguns status não podem ser mostrados pois os Revisores poderão emitir 
  //parecer nessas etapas, e o novo status devido ao parecer não podem ser mostrados
  //aos autores e orientadores.
  if ( (ETAPA_INSCRICAO_TRABALHO == 1) || (ETAPA_ANALISE_TRABALHO_1 == 1) ) {
    //PENDENTE, ENVIADO, VALIDADO, INVALIDADO
    if ( ($status == STATUS_TRAB_PENDENTE) || ($status == STATUS_TRAB_ENVIADO) || ($status == STATUS_TRAB_VALIDADO) || ($status == STATUS_TRAB_INVALIDADO) ) {
      $texto_status_trabalho = $arr_status_trab_completo[$status];
    }
    else if ($is_organizador) {
      $texto_status_trabalho = $arr_status_trab_completo[$status];
    }
    else {
      $texto_status_trabalho = "Trabalho em análise pela comissão organizadora.";
    }
  }

  //Pode mostrar o status pois os Revisores não podem emitir parecer nessa etapa.
  if (ETAPA_CORRECAO_TRABALHO_1 == 1) {
    $texto_status_trabalho = $arr_status_trab_completo[$status];
  }
  
  if ( ETAPA_ANALISE_TRABALHO_2 == 1 ) {
    if ($is_organizador) {
      $texto_status_trabalho = $arr_status_trab_completo[$status];
    }
    else {
      switch ($status){
        case STATUS_TRAB_PENDENTE:
        case STATUS_TRAB_ENVIADO:
        case STATUS_TRAB_VALIDADO:
        case STATUS_TRAB_INVALIDADO:
        case STATUS_TRAB_CORRIGIR:
        case STATUS_TRAB_EM_CORRECAO:
        case STATUS_TRAB_CORRIGIDO:
        case STATUS_TRAB_ACEITO:   //<<<<< Na verdade só poderia mostrar se tiver apenas um parecer.
        case STATUS_TRAB_RECUSADO: //<<<<< Na verdade só poderia mostrar se tiver apenas um parecer.
          $texto_status_trabalho = $arr_status_trab_completo[$status];
          break;
        default:
          $texto_status_trabalho = "Trabalho em análise pela comissão organizadora.";
      }//switch
    }//else
  }

  if ( ETAPA_TRABALHOS_HOMOLOGADOS == 1 ) {
    $texto_status_trabalho = $arr_status_trab_completo[$status];
  }

  return $texto_status_trabalho;
}//mostra_status_trabalho_completo()

?>
