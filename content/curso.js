/* global $*/

$(document).ready(function () {
    'use strict';

    $('.delete').click(function () {

        var td = $(this).parents('tr').find('td')[0];
        var id = $(td).text();

        var ask = window.confirm('Você quer mesmo excluir?');

        if (ask) {
            $.get(location.origin + '/instituicao/curso_ctr/delete/' + id.trim(), {}, function () {
                location.reload();
            });
        }
    });
    
    $('button[type=submit]').click(function () {
        window.alert('cadastrado com sucesso!');
        location.href = location.origin + '/instituicao/curso_ctr';
    });
});

