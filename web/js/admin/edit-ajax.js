/**
 * Created by Romain on 13/04/2018.
 */

$(document).ready(function(){

    // ADD

    $(document).on('click', '.add-info', function(e){

        var value = $(this).attr('data-filter');
        var id = '#' + value;
        var url = Routing.generate('Ajax Add', { slug: value });

        ajaxForm(url, id);

        e.preventDefault();
    });

    $(document).on('submit', '.cv-add', function(e) {

        e.preventDefault();

        var value = $(this).attr('data-filter');
        var id = '#' + value;
        var url = Routing.generate('Ajax Add', { slug: value });

        ajaxSubmit(url, value, id);

    });

    $(document).on('click', '.form_cancel', function (e) {

        var value = $(this).attr('data-filter');
        var id = '#' + value;
        var url = Routing.generate('Ajax Add', { slug: value });

        ajaxCancel(url, value, id);

        e.preventDefault();
    });

   // EDIT

    $(document).on('click', '.edit-info', function (e) {
        console.log('je clique sur editer');

        e.preventDefault();



        var value = $(this).attr('name');
        var id2 = $(this).attr('data-filter');
        var id = '#' + value;
        var url = Routing.generate('Ajax Edit', { slug: value, id: id2 });

        ajaxForm(url, id);

    });

    $(document).on('click', '.form_edit_cancel', function (e) {

        console.log('je clique sur annuler');

        var value = $(this).attr('data-filter'); //formation
        var id2 = $(this).attr('id-entity');
        var id = '#' + value; //#formation
        var url = Routing.generate('Ajax Edit', { slug: value, id: id2 });

        ajaxCancel(url, value, id);

        e.preventDefault();
    });

    $(document).on('submit', '.cv-edit', function (e) {

        e.preventDefault();

        var value = $(this).attr('data-filter');
        var id2 = $(this).attr('id-entity');
        var id = '#' + value;
        var url = Routing.generate('Ajax Edit', { slug: value, id: id2 });

        ajaxSubmit(url, value, id);
    });


});

// *******************************************************

function ajaxForm (url, id) {
    $.ajax({
        url: url,
        type: 'POST'
    })
        .done(function (data) {
            $(id).html('');
            $(id).html(data).show();
            tinymce.remove();
            tinymce.init({
                selector: '.tinymce'
            });
        });

}

function ajaxSubmit(url, value, id) {
    $.ajax({
        type: "POST",
        url: url,
        data: $('.'+value).serialize(), // serializes the form's elements.
        success: function(data)
        {
            $(id).html('');
            $(id).html(data).show();
        }
    });
}

function ajaxCancel(url, value, id) {
    $.ajax({
        type: "POST",
        url: url,
        data: $("[data-filter = 'filter_" +value+ "']").serialize(), // serializes the form's elements.
        success: function (data) {
            $(id).html('');
            $(id).html(data).show();
        }
    })
}