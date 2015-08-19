/* global $ */

$(document).ready(function () {

    'use strict';

    String.prototype.capitalizeFirstLetter = function() {
        return this.charAt(0).toUpperCase() + this.slice(1);
    };
   
    $('.already').click(function () {
        window.alert('Você já está cadastrado neste papel');
    });
    
        var papel_corrente = $('input[name=papel_corrente]').val();
    if (papel_corrente) {
        papel_corrente = papel_corrente.capitalizeFirstLetter();

        var elemento_papel = $('a:contains('+ papel_corrente +')');
        elemento_papel.html( '<strong>' + elemento_papel.html() + '</strong>');
    }

    $('.confirm_avaliador').click(function () {

        var text = 'ATENÇÃO: apenas PROFESSORES e TÉCNICOS ADMINSTRATIVOS podem se inscrever como AVALIADOR. Você tem certeza que deseja se inscrever nesse papel?';
        var link = window.base_url + 'usuario/avaliador_ctr/inscricao_incremental';

        var resp = window.confirm(text);

        if (resp) {
            window.location.href = link;
        }

    });

    $('.confirm_orientador').click(function () {

        var text = 'ATENÇÃO: apenas PROFESSORES e TÉCNICOS ADMINSTRATIVOS podem se inscrever como ORIENTADOR. Você tem certeza que deseja se inscrever nesse papel?';
        var link = window.base_url + 'usuario/orientador_ctr/inscricao_incremental';

        var resp = window.confirm(text);

        if (resp) {
            window.location.href = link;
        }

    });
    
    $('.confirm_autor').click(function () {

        var text = 'ATENÇÃO: apenas ESTUDANTES podem se inscrever como AUTOR. Você tem certeza que deseja se inscrever nesse papel?';
        var link = window.base_url + 'usuario/autor_ctr/inscricao_incremental';

        var resp = window.confirm(text);

        if (resp) {
            window.location.href = link;
        }

    });
    
});