$(document).on('click', '#addCategory', function(e){

    e.preventDefault();

    var url = Routing.generate('Ajax Add Category');

    ajaxShowForm(url, '#divCategory');

});

$(document).on('submit', '.categoryForm', function (e) {

    e.preventDefault();

    var url = Routing.generate('Ajax Add Category');

    var value = '.categoryForm';

    var id = '#categories';

    ajaxSubmit(url, value, id);
});

//

function ajaxShowForm (url, id) {
    $.ajax({
        url: url,
        type: 'POST'
    })
        .done(function (data) {
            $(id).html('');
            $(id).html(data).show();
        });

}

function ajaxSubmit(url, value, id) {
    $.ajax({
        type: "POST",
        url: url,
        data: $(value).serialize(), // serializes the form's elements.
        success: function(data)
        {
            $(id).html('');
            $(id).html(data).show();
        }
    });
}