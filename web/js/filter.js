$(document).ready(function(){

    var time = 2300;
    var value = 'all';
    var url = Routing.generate('filter', { slug: value });

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

    ajaxCallPortfolio(url, time);

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

});

