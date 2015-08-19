<?php

require_once 'constantes_URL.php';
require_once 'constantes.php';

/* * *********************************************************
 * email_monta_header
 * ************************************************************ */
function email_monta_header() {
  $sHeader = "From: " . MOSTRA_EMAIL . "\n";
  //$sHeader .= "Bcc: " . MOSTRA_EMAIL . "\n";
  return $sHeader;
}//email_monta_header()

/* * ***********************************************************
 *  envia_email
 * ************************************************************ */
function envia_email($to, $assunto, $texto) {
  $header = email_monta_header();
//Inclui assinatura no corpo do texto.
  $texto .= MOSTRA_ASSINATURA_EMAIL;
  $envio = false;
  if (TIPO_VERSAO == "PRODUCAO")
    $envio = mail($to, $assunto, $texto, $header);
  return $envio;
}//envia_email()

/* * ***********************************************************
 *  envia_email_trabalho_inscrito
 * ************************************************************ */
function envia_email_trabalho_inscrito($id_trabalho, $titulo, $to) {
    //Envia email para autor do trabalho.
    $assunto = MOSTRA_TITULO_CURTO . " (trabalho inscrito)";
    $texto = "Você cadastrou um trabalho no sistema de inscrição da " . MOSTRA_TITULO . "\n\n";
    $texto .= "Código do Trabalho: " . $id_trabalho . "\n";
    $texto .= "Título do trabalho: " . $titulo . "\n\n";
    $texto .= "O seu trabalho encontra-se em estado PENDENTE. Nessa situação você ainda pode efetuar modificações no trabalho. Para completar o processo de inscrição você deverá entrar no sistema e efetuar o envio do trabalho (observar data limite para inscrição de trabalhos, conforme cronograma). Após o envio, não haverá possibilidades de modificações no trabalho.\n\n";
    if (TIPO_VERSAO == "PRODUCAO")
      envia_email($to, $assunto, $texto);
}//envia_email_trabalho_inscrito()

?>