<?php if ( ! defined('BASEPATH')) { exit('No direct script access allowed'); }

/**************************************************************************
 * função para validar os CPFs hipotéticos aceitos neste sistema.
 * @param type $cpf o cfp do usuário para ser validado
 * @return boolean
 * false se não é válido
 * ou o cpf sem ponto e hífem se for válido
 **************************************************************************/
function valida_cpf_hipotetico($cpf) {
  $cpf = str_replace('.', '', $cpf);
  $cpf = str_replace('-', '', $cpf);
    
  // Verifiva se o número digitado contém todos os digitos
  $cpf = str_pad(preg_replace('[^0-9]', '', $cpf), 11, '0', STR_PAD_LEFT);
  
  $cpf_aux = substr($cpf, 0, 9);
 
  //Aceita os CPFs nos formatos 111.111.111-XX, 222.222.222-XX, etc...
  if ( ($cpf_aux == '111111111') || ($cpf_aux == '222222222') || 
       ($cpf_aux == '333333333') || ($cpf_aux == '444444444') || 
       ($cpf_aux == '555555555') || ($cpf_aux == '666666666') || 
       ($cpf_aux == '777777777') || ($cpf_aux == '888888888') || 
       ($cpf_aux == '999999999') ) {
    return $cpf;
  }
  else {
    return false;
  }  
}//valida_cpf_hipotetico()

/**************************************************************************
 * função para validar o cpf
 * @param type $cpf o cfp do usuário para ser validado
 * @return boolean
 * false se não é válido ou 
 * o cpf sem ponto e ífem se for válido
 **************************************************************************/
function valida_cpf_real($cpf) {
    
  $cpf = str_replace('.', '', $cpf);
  $cpf = str_replace('-', '', $cpf);
    
  // Verifiva se o número digitado contém todos os digitos
  $cpf = str_pad(preg_replace('[^0-9]', '', $cpf), 11, '0', STR_PAD_LEFT);
	
  //Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
  if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999') {
    return false;
  }
  
  else { // Calcula os números para verificar se o CPF é verdadeiro
    for ($t = 9; $t < 11; $t++) {
      for ($d = 0, $c = 0; $c < $t; $c++) {
        $d += $cpf{$c} * (($t + 1) - $c);
      }
      $d = ((10 * $d) % 11) % 10;
      if ($cpf{$c} != $d) {
        return false;
      }
    }
    return $cpf;
  }//else
  
}//valida_cpf_real()

/**************************************************************************
 * função para validar o cpf (aceita tanto CPFs reais como os CPFs hipotéticos utilizados neste sistema.
 * @param type $cpf o cfp do usuário para ser validado
 * @return boolean
 * false se não é válido ou o cpf sem ponto e hífem
 * true se for válido
 **************************************************************************/
function valida_cpf($cpf) {
  $cpf_aux = valida_cpf_hipotetico($cpf);
  if ($cpf_aux) {
    return $cpf_aux;
  }
  else {
    $cpf_aux = valida_cpf_real($cpf);
    if ($cpf_aux) {
      return $cpf_aux;
    }
    else {
      return false;    
    }
  }
}//valida_cpf()

/**************************************************************************
 * função para validar o cpf
 * @param type $cpf o cfp do usuário para ser validado
 * @return boolean
 * false se não é válido ou 
 * o cpf sem ponto e ífem se for válido
 **************************************************************************/
function valida_cpf_original($cpf) {
    
  $cpf = str_replace('.', '', $cpf);
  $cpf = str_replace('-', '', $cpf);
    
  // Verifiva se o número digitado contém todos os digitos
  $cpf = str_pad(preg_replace('[^0-9]', '', $cpf), 11, '0', STR_PAD_LEFT);
	
  //Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
  if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999') {
    return false;
  }
  
  else { // Calcula os números para verificar se o CPF é verdadeiro
    for ($t = 9; $t < 11; $t++) {
      for ($d = 0, $c = 0; $c < $t; $c++) {
        $d += $cpf{$c} * (($t + 1) - $c);
      }
      $d = ((10 * $d) % 11) % 10;
      if ($cpf{$c} != $d) {
        return false;
      }
    }
    return $cpf;
  }//else
  
}//valida_cpf_original()


/**************************************************************************
 **************************************************************************/
function comparar_senha_confirmacao($data) {
  if (array_key_exists('senha', $data) && $data['senha'] != $data['confirmar_senha']) {
    return true;
  }
  return false;
}//compara_senha_confirmacao

function comparar_email_confirmacao($data) {

  if (array_key_exists('email', $data) && $data['email'] != $data['confirmar_email']) {
    return true;
  }
  return false;
}

/**
 * Function Name
 *
 * Function description
 *
 * @access  public
 * @param  type  name
 * @return  type  
 */
 
if (! function_exists('gerarNovaSenha'))
{
  function gerarNovaSenha()
  {
       $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
       $pass = array(); //remember to declare $pass as an array
       $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
      for ($i = 0; $i < 8; $i++) {
          $n = rand(0, $alphaLength);
          $pass[] = $alphabet[$n];
      }
      return implode($pass); //turn the array into a string
  }
}