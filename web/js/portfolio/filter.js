$(document).ready(function(){



    var time = 2300;
    var value = 'all';
    var url = Routing.generate('filter', { slug: value });

    ajaxCallPortfolio(url, time);

    setTimeout(
        function () {
            $('#loading').show();
        }, 300
    );

    setTimeout(
        function () {
            $('#loading').hide();
        }, time
    );

    $(".filter-button").click(function(){
        value = $(this).attr('data-filter');
        url = Routing.generate('filter', { slug: value });

        setTimeout(
            function () {
                $('#loading').show();
            }, 300
        );

        setTimeout(
          function () {
              $('#loading').hide();
          }, time
        );


        if ($(".filter-button").removeClass("active-category")) {
            $(this).removeClass("active-category");
        }
        $(this).addClass("active-category");

        ajaxCallPortfolio(url, time);
    });

    $(document).on('click', '.page-link', function (e) {
        $.ajax({
            url: $(this).attr('href'),
            type: 'post'
        })
            .done(function(data) {
                $('#portfolio-container').html(data);
                moove();
            });
        e.preventDefault();

        var aid = '#portfolio';
        $('html,body').animate({scrollTop: $(aid).offset().top}, 'slow');
    })

});

function ajaxCallPortfolio (url, time) {
    $.ajax({
        url: url,
        type: 'post'
    })
        .done(function (data) {
            $('#portfolio-container').html('');
            setTimeout(
                function () {
                    $('#portfolio-container').html(data).show();
                    moove();
                }, time
            );
        });

}
function moove () {
    console.log('test');
    $('#modals').html(($('#toMoove').html()));
    $('#toMoove').remove();
}
