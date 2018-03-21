/**
 * Created by Romain on 21/03/2018.
 */

$(document).ready(function() {

    $(".page-link").click(function (e) {
        e.preventDefault();
        var aid = '#portfolio';
        $('html,body').animate({scrollTop: $(aid).offset().top}, 'slow');
    });

});