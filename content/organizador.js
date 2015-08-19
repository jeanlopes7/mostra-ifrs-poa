
$(document).ready(function () {
   
    $('.delete').click(function () {

        var href = location.href;
        href = href.replace('#','');
        var td = $(this).parents('tr').find('td')[0];
        var id = $(td).text();

        var ask = confirm("Você quer mesmo excluir?");
        if (ask) {
            $.get(href + '/delete', {id: id.trim()}, function () {
                location.reload();
            });
        }
    }); 
});

