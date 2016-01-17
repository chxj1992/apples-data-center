// Morris.js Charts sample data for SB Admin template

$(function () {

    var project = $('#project').val();

    $.getJSON('/cruise/chart?project=' + project, function (data) {
        var itineraries = Morris.Line({
            element: 'travelocity-itineraries-chart',
            data: data,
            xkey: 'period',
            ykeys: ['inside', 'oceanview', 'balcony', 'suite'],
            labels: ['inside', 'oceanview', 'balcony', 'suite'],
            pointSize: 1,
            hideHover: 'auto',
            resize: true
        });
    });

});
