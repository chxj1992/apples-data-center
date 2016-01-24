$(function () {

    var project = $('#project').val();

    $('#crawl-btn').click(function () {
        $.post('/cruise/crawl?project=' + project);
    });

    $('#dump-btn').click(function () {
        $.post('/cruise/dump?project=' + project);
    });

    $('.close-modal').click(function(){
        location.reload();
    });

});