/* global $ */

//Função executada quando a página termina de carregar.
$(document).ready(function () {
    'use strict';

  //****************************************************
  // põe focus no primeiro campo de texto ou caixa de seleção do modal
  //****************************************************
  $('.modal').on('shown.bs.modal', function () {

        var self = $(this);
        var set_focus = function (modal) {
            var el = modal.find('select, input')[0];
            $(el).focus();
        };
        setTimeout(set_focus, 300, self);
  });


  //****************************************************
  // Evento change na SELECT #instituicao do formulário de inscrição 
  // de algum papel que necessite vínculo a uma instituição.
  // Cada vez que o usuário escolhe uma nova instituição tem que fazer duas coisas:
  // 1) Setar a mesma instituição no modal_escolher_instituicao
  // 2) Recarregar os campus da nova instituição selecionada.
  //****************************************************
  $('#instituicao').change(function () {
        //1) Setar na option SELECT da modal_escolher_instituicao
        //a mesma instituição que acaba de ser selecionada.
        var select = $('#instituicao');
        var selected = select.find(':selected').val();
        $('#escolher_instituicao option[value=' + selected + ']').prop('selected', true);

        //2) Buscar pelos campus da instituição selecionada e atualizar as respectivas
        //SELECTs no formulário de inscrição e na modal_escolher_campus.
        var id_instituicao = $(this).val();
        $('#campus').empty();
        $('#campus').append($('<option />').val('').text('Selecione um item da lista'));
        $('#escolher_campus').empty();
        $('#escolher_campus').append($('<option />').val('').text('Selecione um item da lista'));
        $.getJSON(window.base_url + 'instituicao/campus_ctr/get_campus_list/' + id_instituicao, {}, function (data) {
            $.each(data, function () {
                $('#campus').append($('<option />').val(this.id_campus).text(this.nome));
                $('#escolher_campus').append($('<option />').val(this.id_campus).text(this.nome));
            });
        });
  });//#instituicao.change()
    
  //****************************************************
  // Evento change na SELECT #campus do formulário de inscrição 
  // de algum papel que necessite vínculo a um campus.
  // Cada vez que o usuário escolhe um novo campus tem que fazer duas coisas:
  // 1) Setar o mesmo campus no modal_escolher_campus
  // 2) Recarregar os cursos do novo campus selecionado.
  //****************************************************
  $('#campus').change(function () {
        //1) Setar na option SELECT da modal_escolher_campus
        //o mesmo campus que acaba de ser selecionado.
        var select = $('#campus');
        var selected = select.find(':selected').val();
        $('#escolher_campus option[value=' + selected + ']').prop('selected', true);

        //2) Buscar pelos cursos do campus selecionado e atualizar as respectivas
        //SELECTs: no formulário de inscrição e na modal_escolher_curso
        var id_instituicao = $(this).val();
        $('#curso').empty();
        $('#curso').append($('<option />').val('').text('Selecione um item da lista'));
        $('#escolher_curso').empty();
        $('#escolher_curso').append($('<option />').val('').text('Selecione um item da lista'));
        $.getJSON(window.base_url + 'instituicao/curso_ctr/get_curso_list/' + id_instituicao, {}, function (data) {
            $.each(data, function () {
                $('#curso').append($('<option />').val(this.id_curso).text(this.nome));
                $('#escolher_curso').append($('<option />').val(this.id_curso).text(this.nome));
            });
        });
  });//#campus.change()

  //****************************************************
  // Evento change na SELECT #curso do formulário de inscrição 
  // de algum papel que necessite vínculo a um campus.
  // Cada vez que o usuário escolhe um novo curso tem que:
  // 1) Setar o mesmo curso no modal_escolher_curso
  //****************************************************
  $('#curso').change(function () {
        //1) Setar na option SELECT da modal_escolher_curso
        //o mesmo curso que acaba de ser selecionado.
        var select = $('#curso');
        var selected = select.find(':selected').val();
        $('#escolher_curso option[value=' + selected + ']').prop('selected', true);
  });//#curso.change()

  //****************************************************
  // Evento click em um dos botões cadastrar nova instituição/campus/curso.
  // Vai abrir o respectivo modal:
  // 1) modal_escolher_instituicao ou
  // 2) modal_escolher_campus ou
  // 3) modal_escolher_curso.
  //****************************************************
  $('select').parent().find('button').click(function () {
        var select_anterior = $(this).parents('.form-group').prev().find('select');
        var select = $(this).parent().find('select');
        var nome = select.attr('name');

        if (select.find('option').size() < 2 && $.isEmptyObject(select_anterior.find(':selected').val())) {
            window.alert('selecione um item na caixa de listagem anterior');
            event.preventDefault();
        }
        else {
            $('#modalEscolher' + nome.charAt(0).toUpperCase() + nome.slice(1)).modal();
        }
  });//botoes_cadastrar_inst_campus_curso.click()

  //****************************************************
  // Evento click do botão Escolher de uma das modais:
  // 1) modal_escolher_instituicao
  // 2) modal_escolher_campus
  // 3) modal_escolher_curso
  // Tem que atualizar a respectiva SELECT (instituicao, campus ou curso)
  // do formulário de inscrição.
  //****************************************************
  $('div.modal-footer > button.btn-default[type!=reset]').click(function () {
        //pega o componente SELECT da modal
        var select = $(this).parents('.modal').find('select');
        //pega o ID do componente SELECT da modal
        //e retira o texto "escolher".
        //Exemplo: se for o componente SELECT da modal_escolher_instituicao,
        //esse componente tem ID = escolher_instituicao.
        //Nesse caso a variável nome = "instituicao"
        var nome = select.attr('id').substr(9);
        //pega o nome da option que está selecionada na SELECT da modal.
        var selected = select.find(':selected').val();
        //Seta a mesma option na componenente SELECT do formulário de inscrição.
        $('#' + nome + ' option[value=' + selected + ']').prop('selected', true);
        //Aciona o evento change para atualizar os itens relacionados 
        //(para os casos de instituicao ou campus).
        $('#' + nome).change();
  });//modal_escolher_inst_campus_curso.botao_escolher.click()

  //****************************************************
  // Evento submit do form #cadastrarInstituicaoForm.
  //****************************************************
  $('#cadastrarInstituicaoForm').submit(function (e) {
        var dados = $(this).serialize();
        $.post(window.base_url + 'instituicao/instituicao_ctr/create', dados, function (data) {
            data = JSON.parse(data);
            //Adiciona a instituição recém cadastrada na SELECT do formulário de inscrição do papel
            //e na SELECT da modal_escolher_insticuicao.
            $('#instituicao').append($('<option />').val(data.id_instituicao).text(data.sigla+" - "+data.nome));
            $('#instituicao option[value=' + data.id_instituicao + ']').prop('selected', true);
            $('#escolher_instituicao').append($('<option />').val(data.id_instituicao).text(data.sigla+" - "+data.nome));
            $('#escolher_instituicao option[value=' + data.id_instituicao + ']').prop('selected', true);
            //Para atualizar os campus da SELECT campus (na verdade vai vir vazio).
            $('#instituicao').change();
            //Limpara o formulário da modal e fecha a modal.
            $('#modalCadastrarInstituicao button[type=reset]').click();
            $('#modalCadastrarInstituicao').modal('toggle');
        });
        e.preventDefault();
  });//#cadastrarInstituicaoForm.submit()

  //****************************************************
  // Evento submit do form #cadastrarCampusForm.
  //****************************************************
  $('#cadastrarCampusForm').submit(function (e) {
        var dados = $(this).serialize();
        dados += '&instituicao=' + $('#instituicao').val();
        $.post(window.base_url + 'instituicao/campus_ctr/create', dados, function (data) {
            data = JSON.parse(data);
            //Adiciona o campus recém cadastrado na SELECT do formulário de inscrição do papel
            //e na SELECT da modal_escolher_campus.
            $('#campus').append($('<option />').val(data.id_campus).text(data.nome));
            $('#campus option[value=' + data.id_campus + ']').prop('selected', true);
            $('#escolher_campus').append($('<option />').val(data.id_campus).text(data.nome));
            $('#escolher_campus option[value=' + data.id_campus + ']').prop('selected', true);
            //Para atualizar os cursos da SELECT curso (na verdade vai vir vazio).
            $('#campus').change();
            //Limpara o formulário da modal e fecha a modal.
            $('#modalCadastrarCampus button[type=reset]').click();
            $('#modalCadastrarCampus').modal('toggle');
        });
        e.preventDefault();
  });//#cadastrarCampusForm.submit()

  //****************************************************
  // Evento submit do form #cadastrarCursoForm.
  //****************************************************
  $('#cadastrarCursoForm').submit(function (e) {
        var dados = $(this).serialize();
        dados += '&campus=' + $('#campus').val();
        $.post(window.base_url + 'instituicao/curso_ctr/create', dados, function (data) {
            data = JSON.parse(data);
            //Adiciona o curso recém cadastrado na SELECT do formulário de inscrição do papel
            //e na SELECT da modal_escolher_curso.
            $('#curso').append($('<option />').val(data.id_curso).text(data.nome));
            $('#curso option[value=' + data.id_curso + ']').prop('selected', true);
            $('#escolher_curso').append($('<option />').val(data.id_curso).text(data.nome));
            $('#escolher_curso option[value=' + data.id_curso + ']').prop('selected', true);
            //Limpara o formulário da modal e fecha a modal.
            $('#modalCadastrarCurso button[type=reset]').click();
            $('#modalCadastrarCurso').modal('toggle');
        });
        e.preventDefault();
  });//#cadastrarCursoForm.submit()
  
});
