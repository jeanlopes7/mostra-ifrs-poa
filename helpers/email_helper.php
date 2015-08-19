<?php if ( ! defined('BASEPATH')) { exit('No direct script access allowed'); }
 

/**
 * Function Name
 *
 * Function description
 *
 * @access    public
 * @param    type    name
 * @return    type    
 */
 
if (! function_exists('sendPasswordEmail'))
{
    function sendPasswordEmail($password, $userEmail)
    {
        try {

            $body  = "Prezado(a) participante,\n\n";
            $body .= "Você alterou sua senha como usuário no sistema de inscrição da 16ª Mostra de Pesquisa, "
                . "Ensino e Extensão do IFRS - Câmpus Porto Alegre.\n\n";

            $body .= "Sua senha é " . $password . "\n\n";
            $body .= "Guarde-a em um lugar seguro. \n\n";

            $body .= "Caso haja alguma inconsistência, entre em contato com a Comissão Organizadora do evento através do email informado no final desta mensagem.\n\n";
            $body .= "Agradecemos sua participação.\n\n";
      
            $body .= "Esta mensagem foi enviada automaticamente pelo sistema de inscrição da 16ª Mostra de Pesquisa, Ensino e Extensão do IFRS - Câmpus Porto Alegre.\n";
            $body .= "http://mostra.poa.ifrs.edu.br/2015/sistema\n";
            $body .= "Email: mostra@poa.ifrs.edu.br\n";

            $resultado_envio = false;

        if (ENVIRONMENT != 'development') {
            //$return = $this->email->send();
            $resultado_envio = mail($userEmail, "Mostra-IFRS-Poa (recuperacao de senha)", $body, "from: Mostra-IFRS-Poa<mostra@poa.ifrs.edu.br>");
        }
        else {
            error_log('um e-mail foi enviado - nova senha: ' . $password);
            $resultado_envio = true;
        }
        
        return $resultado_envio;
            
        } catch (Exception $ex) {
            
        }
    }
}


function sendEmailAfterRecordUser($cpf, $nome, $userEmail, $papel) {
    
    $body = mountBody($cpf, $nome, $userEmail, $papel);
        
    //$ci = &get_instance();
    
    try {
    
        //$email = $ci->load->library('email');
        //$email->from(MOSTRA_EMAIL, 'Mostra do IFRS - Campus Porto Alegre');
        //$email->to($userEmail);
        //$email->bcc(MOSTRA_EMAIL);
        //$email->subject('Aviso Mostra do IFRS - Campus Porto Alegre');
        //$email->message($body);

        $resultado_envio = false;
        if (ENVIRONMENT != 'development') {
            //$return = $this->email->send();
            $resultado_envio = mail($userEmail, "Mostra-IFRS-Poa (inscrição)", $body, "from: Mostra-IFRS-Poa<mostra@poa.ifrs.edu.br>");
        }
        else {
            error_log('um e-mail foi enviado. papel: ' . $papel.", cpf:".$cpf.", nome:".$nome.", email:".$userEmail);
            $resultado_envio = true;
        }
        
        return $resultado_envio;
    
    } catch (Exception $ex) {
        $ci->log->write_log('error', $ex->getMessage() . " - email_helper::sendEmailAfterRecordUser ");
    }
}

function mountBody($cpf, $nome, $userEmail, $papel) {
  
    $body  = "Prezado(a) " . utf8_decode($nome) . ",\n\n";
    $body .= "Você efetuou inscrição como " . strtoupper(utf8_decode($papel)) . " na 16ª Mostra de Pesquisa, "
            . "Ensino e Extensão do IFRS - Câmpus Porto Alegre.\n\n";
    
    $cpf_formatado = substr($cpf, 0, 3).".".
            substr($cpf, 3, 3).".".
            substr($cpf, 6, 3)."-".
            substr($cpf, 9, 2);
    
    $body .= "Verifique se seus dados informados estão corretos, pois o certificado de participação será gerado com base nesses dados:\n\n";
    $body .= "Nome: " . utf8_decode($nome) . "\n";
    $body .= "CPF: " . utf8_decode($cpf_formatado) . "\n";
    $body .= "Email: " . utf8_decode($userEmail) . "\n\n";
    
    $body .= "Caso haja alguma inconsistência, entre em contato com a Comissão Organizadora do evento através do email informado no final desta mensagem.\n\n";
    $body .= "Agradecemos sua participação.\n\n";
  
    $body .= "Esta mensagem foi enviada automaticamente pelo sistema de inscrição da 16ª Mostra de Pesquisa, Ensino e Extensão do IFRS - Câmpus Porto Alegre.\n";
    $body .= "http://mostra.poa.ifrs.edu.br/2015/sistema\n";
    $body .= "Email: mostra@poa.ifrs.edu.br\n";
    
    return $body;
}