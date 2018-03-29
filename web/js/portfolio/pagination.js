
$(document).ready(function(){

    moove();

    $('#toMoove').remove();

    $(".page-link").click(function (e) {
        $.ajax({
            url: $(this).attr('href'),
            type: 'post'
        })
            .done(function(data) {
                $('#portfolio-container').html(data);
                moove();
            });
        e.preventDefault();
    })
});


function moove () {
    $('#modals').html(($('#toMoove').html()));
}