// Morris.js Charts sample data for SB Admin template

$(function () {

    $.getJSON('/travelocity/chart', function (data) {
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
