/* global $, total_coautores, total_orientadores, total_orientador */

$(document).ready(function () {

  'use strict';

//**********************************************************************
//**********************************************************************
//                          AUTORES
//**********************************************************************
//**********************************************************************


  //*******************************************************************
  //Evento click do botão "Inserir Coautor no trabalho..." do form inscricao trabalho.
  //*******************************************************************
  $('.botao_inserir_coautor').click(function () {
    if (total_coautores >= 4) {
      window.alert('O número máximo de coautores permitido é 4.');
      return;
    }
    else {
      $('#modal_buscar_coautor').modal('toggle');
    }
  });//botao_inserir_coautor.click()

  //*******************************************************************
  //Evento click do botão "Remover_coautor...".
  //*******************************************************************
    $('.botao_remover_coautor').click(function  () {
      if (window.confirm('Tem certeza que deseja remover esse coautor do trabalho?')) {
        var ordem = parseInt($(this).attr('data'));
        var i=0;
        for (i=ordem; i < (total_coautores-1); i++) {
          $('#coautor_nome' + i).val( $('#coautor_nome' + (i+1) ).val() );
          $('#coautor_id' + i).val( $('#coautor_id' + (i+1) ).val() );
          $('#coautor_curso_id' + i).val( $('#coautor_curso_id' + (i+1) ).val() );
          $('#coautor_email' + i).val( $('#coautor_email' + (i+1) ).val() );
        }//for

        $('#botao_remover_coautor'+i).hide();
        $('#coautor_nome'+i).hide();
        
        $('#coautor_nome'+i).val('');
        $('#coautor_id'+i).val('');
        $('#coautor_curso_id'+i).val('');
        $('#coautor_email'+i).val('');

        total_coautores--;
      }//if
    });//botao_remover_coautor()

//*******************************************************************
  //Evento click do botão Buscar coautor do modal_buscar_coautor.
  //*******************************************************************
  $('.botao_buscar_coautor').click(function () {
    var nome_coautor = $('#nome_coautor').val();
    if (nome_coautor.length < 4) {
            window.alert('Por favor, insira pelo menos 4 caracteres');
            return;
    }
    $.getJSON(window.base_url + 'usuario/autor_ctr/find_autores_by_name/' + nome_coautor, function(autores) {
      $('#table_coautor tbody tr').remove();
      autores.forEach(function(autor) {
        var coautor_id = autor.usuario.id_usuario;
        var coautor_curso_id = autor.curso.id_curso;
        var coautor_nome = autor.usuario.nome;
        var coautor_email = autor.usuario.email;
        var curso  = autor.curso.nome;
        var campus = autor.curso.campus.nome;
        var inst   = autor.curso.campus.instituicao.sigla;
        $('#table_coautor tbody').append(
                '<tr><td><a href="#" class="opcao_coautor" '+
                ' data-coautor-id="'+coautor_id+'"' +
                ' data-coautor-curso-id="'+coautor_curso_id+ '"' +
                ' data-coautor-email="'+coautor_email+'"  >'+coautor_nome+'</a></td>'+
                '<td>'+curso+'</td><td>'+campus+'</td><td>'+inst+'</td></tr>'
                );
      });
     escolher_coautor();
    });//JSON
  });//botao_buscar_coautor.click()

//*******************************************************************
  //Verifica se o coautor já está no trabalho:
  //Retorno:
  //true = já está.
  //false = não está.
  //*******************************************************************
  function coautor_estah_no_trabalho (id_autor) {
    //Verifica se é igual ao autor principal.
    if ( $('#autor_principal_id_aux').val() == id_autor) {    
      return true;
    }
    var i=0;
    for (i=0; i<4; i++) {
      if ( $('#coautor_id' + i).val() !== '' ) {
        if ($('#coautor_id' + i).val() == id_autor)
          return true;
      }
    }
    return false;
  }//coautor_estah_no_trabalho()
  
  //*******************************************************************
  //Evento click em um dos coautores da modal buscar_coautor.
  //*******************************************************************
  function escolher_coautor () {
    $('.opcao_coautor').click(function  () {
      //Verifica se coautor já está nesse trabalho.
      var coautor_id = $(this).attr('data-coautor-id');
      if ( coautor_estah_no_trabalho(coautor_id) ) {
        window.alert('Esse autor já está vinculado ao trabalho.');
        return;
      }
      total_coautores++;
      var i;
      //Procura pela primeira caixa de coautor disponível.
      for (i=0; i<4; i++) {
        if ($('#coautor_nome' + i).val() === '') {
          coautor_id = $(this).attr('data-coautor-id');
          var coautor_curso_id = $(this).attr('data-coautor-curso-id');
          var coautor_email = $(this).attr('data-coautor-email');
          var nome  = $(this).text();
          $('#modal_buscar_coautor').modal('toggle');
          $('#botao_remover_coautor' + i).show();
          $('#coautor_nome' + i).show();
          $('#coautor_nome' + i).val(nome);
          $('#coautor_id' + i).val(coautor_id);
          $('#coautor_curso_id' + i).val(coautor_curso_id);
          $('#coautor_email' + i).val(coautor_email);
          return;
        }
      }//for
    });//

  }//function escolher_coautor()

//**********************************************************************
//**********************************************************************
//                          ORIENTADORES
//**********************************************************************
//**********************************************************************
  
    //*******************************************************************
  //Evento click do botão "Inserir Orientador no trabalho..." do form inscricao trabalho.
  //*******************************************************************
  $('.botao_inserir_orientador').click(function () {
    if (total_orientadores >= 2) {
      window.alert('O número máximo de orientadores permitido é 2.');
      return;
    }
    else {
      $('#modal_buscar_orientador').modal('toggle');
    }
  });//botao_inserir_orientador.click()

  //*******************************************************************
  //Evento click do botão "Remover_orientador...".
  //*******************************************************************
    $('.botao_remover_orientador').click(function  () {
      if (window.confirm('Tem certeza que deseja remover esse orientador do trabalho?')) {
        var ordem = parseInt($(this).attr('data'));
        var i=0;
        for (i=ordem; i < (total_orientadores-1); i++) {
          // prof Alex, qual era intenção para essa variável??????
          //var proximo = parseInt(i);
          $('#orientador_nome' + i).val( $('#orientador_nome' + (i+1) ).val() );
          $('#orientador_id' + i).val( $('#orientador_id' + (i+1) ).val() );
          $('#orientador_campus_id' + i).val( $('#orientador_campus_id' + (i+1) ).val() );
          $('#orientador_email' + i).val( $('#orientador_email' + (i+1) ).val() );
        }//for

        $('#botao_remover_orientador'+i).hide();
        $('#orientador_nome'+i).hide();
        
        $('#orientador_nome'+i).val('');
        $('#orientador_id'+i).val('');
        $('#orientador_campus_id'+i).val('');
        $('#orientador_email'+i).val('');

        total_orientadores--;
      }//if
    });//botao_remover_orientador()

//*******************************************************************
  //Evento click do botão Buscar orientador do modal_buscar_orientador.
  //*******************************************************************
  $('.botao_buscar_orientador').click(function () {
    var nome_orientador = $('#nome_orientador').val();
    if (nome_orientador.length < 4) {
            window.alert('Por favor, insira pelo menos 4 caracteres');
            return;
    }

    $.getJSON(window.base_url + 'usuario/orientador_ctr/find_orientadores_by_name/' + nome_orientador, function(orientadores) {
      $('#table_orientador tbody tr').remove();
      orientadores.forEach(function(orientador) {
        window.console.log(orientador);
        var orientador_id = orientador.usuario.usuario.id_usuario;
        var orientador_campus_id = orientador.campus.id_campus;
        var orientador_nome = orientador.usuario.usuario.nome;
        var orientador_email = orientador.usuario.usuario.email;
        var campus = orientador.campus.nome;
        var inst   = orientador.campus.instituicao.sigla;
        $('#table_orientador tbody').append(
                '<tr><td><a href="#" class="opcao_orientador" '+
                ' data-orientador-id="'+orientador_id+'"' +
                ' data-orientador-campus-id="'+orientador_campus_id+ '"' +
                ' data-orientador-email="'+orientador_email+'"  >'+orientador_nome+'</a></td>'+
                '<td>'+campus+'</td><td>'+inst+'</td></tr>'
                );
      });
     escolher_orientador();
    });//JSON
  });//botao_buscar_orientador.click()

//*******************************************************************
  //Verifica se o orientador já está no trabalho:
  //Retorno:
  //true = já está.
  //false = não está.
  //*******************************************************************
  function orientador_estah_no_trabalho (id_orientador) {
    var i=0;
    for (i=0; i<2; i++) {
      if ( $('#orientador_id' + i).val() !== '' ) {
        if ($('#orientador_id' + i).val() == id_orientador)
          return true;
      }
    }
    return false;
  }//orientador_estah_no_trabalho()
  
  //*******************************************************************
  //Evento click em um dos orientadores da modal buscar_orientador.
  //*******************************************************************
  function escolher_orientador () {
    $('.opcao_orientador').click(function  () {
      //Verifica se orientador já está nesse trabalho.
      var orientador_id = $(this).attr('data-orientador-id');
      if ( orientador_estah_no_trabalho(orientador_id) ) {
        window.alert('Esse orientador já está vinculado ao trabalho 2.');
        return;
      }
      total_orientadores++;
      var i;
      //Procura pela primeira caixa de orientador disponível.
      for (i=0; i<2; i++) {
        if ($('#orientador_nome' + i).val() === '') {
          orientador_id = $(this).attr('data-orientador-id');
          var orientador_campus_id = $(this).attr('data-orientador-campus-id');
          var orientador_email = $(this).attr('data-orientador-email');
          var nome  = $(this).text();
          $('#modal_buscar_orientador').modal('toggle');
          $('#botao_remover_orientador' + i).show();
          $('#orientador_nome' + i).show();
          $('#orientador_nome' + i).val(nome);
          $('#orientador_id' + i).val(orientador_id);
          $('#orientador_campus_id' + i).val(orientador_campus_id);
          $('#orientador_email' + i).val(orientador_email);
          return;
        }
      }//for
    });//

  }//function escolher_orientador()


  //**********************************************************************
  //**********************************************************************
  //**********************************************************************
  
  //*******************************************************************
  //Faz a validação de todos os campos do formulário.
  //*******************************************************************
  //function validacao() {
    
  //}


});