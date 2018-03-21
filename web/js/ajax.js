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
              }, time
            );
        });

}