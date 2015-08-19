/* globals $, alert  */

$(document).ready(function () {
   
  'use strict';

  // máscara do cpf
  // ATENCAO -- DESABILITADO PARA FINS DE TESTES COM SELENIUM
  // TODO: habilitar depois
  $('input[name=cpf]').mask('999.999.999-99');

  //****************************************************
  // Evento focus
  //****************************************************
  $('.modal').on('shown.bs.modal', function() {
        setTimeout(function(){
            $('input[name=cpf]').focus();
        }, 300);
  });

  //****************************************************
  //Evento enter key (pressionamento da tecla ENTER).
  //****************************************************
  $('input').keyup(function (e) {
    if (e.which === 13) {
       $(this).parents('.modal').find('button.btn-primary').trigger('click');
     }
  });
  
  //****************************************************
  // Se ele não tiver uma ação definida no atributo action do formulário
  // isso quer dizer que o post do form será feito por meio de um evento javascript
  // provavelmente com ajax, então este evento abaixo serve para que ele não tente
  // dar submit para a mesma página
  //****************************************************
  $('form').submit(function(e) {
    if ($(this).attr('action') === undefined) 
       e.preventDefault();
  });
   
  //****************************************************
  //Evento Menu Inscrição:
  //Executado quando clica em um dos itens de menu Inscricao.
  //Guarda a URL de destino da verificação de CPF
  //****************************************************
   $('ul.dropdown-menu li a').click(function() {
       localStorage.setItem('url_insc', $(this).attr('data')); 
   });
   
  //****************************************************
  //Evento clique do botão Verificar CPF do modalVerificarCPF
  //AJAX do modal verificar CPF
  //Executado quando clicar no botão "Verificar CPF".
  //****************************************************
  $('#modalVerificarCPF').find('button[form=CPFForm]').click(function () {
        
        var cpf = $('#modalVerificarCPF').find('input[name=cpf]').val();

        cpf = cpf.replace('.','').replace('.','').replace('-', '');
        var papel = localStorage.getItem('url_insc');
        
        //Exemlo http://localhost/mostra-ifrs-poa/usuario/autor_ctr/inscricao/12345678900
        //var base_url = 'http://localhost/mostra-ifrs-poa/';
        
        //var redirect = base_url + 'usuario' + '/' + papel + '_ctr/inscricao/' + cpf;
        var redirect = window.base_url + 'usuario' + '/' + papel + '_ctr/inscricao/' + cpf;
        
        //Chama por ajax
        //$.get(base_url+'home/home_ctr/verificar_cpf/'+cpf, function (data) {
        
        $.get(window.base_url + 'home/home_ctr/verificar_cpf/'+cpf, function (data) {
           
            if (data === 'invalid') {
                alert('cpf inválido!');
                return;
            }
            var result = JSON.parse(data);
            //var result é verdade (qualquer coisa diferente de false, null, 0, etc...)
            if (result) {
                //Usuario existe, então solicita a senha
                //ARRUMAR, pois está solicitando também o CPF.
                $('#modalVerificarCPF').modal('toggle'); //fecha modalCPF
                $('#modalLogin').modal('toggle'); //abre modalLogin
                $('#modalLogin').find('input[name=cpf]').val(cpf);
                $('#modalLogin').find('input[name=redirect]').val(redirect);
            }
            else {
              //CPF não existe, então chama inscrição.  
              window.location.href = redirect;
            }
           
        });//get()
        
    });//modalCPF().
    
  });//Document.read.function()
