// Morris.js Charts sample data for SB Admin template

$(function () {

    var project = $('#project').val();

    $.getJSON('/cruise/priceByDepartureTime?project=' + project, function (data) {
        Morris.Line({
            element: 'price-by-departure-time-chart',
            data: data,
            xkey: 'period',
            ykeys: ['inside', 'oceanview', 'balcony', 'suite'],
            labels: ['inside', 'oceanview', 'balcony', 'suite'],
            pointSize: 1,
            hideHover: 'auto',
            resize: true
        });
    });

    $.getJSON('/cruise/countByDepartureTime?project=' + project, function (data) {
        Morris.Donut({
            element: 'count-by-departure-time-chart',
            data: data,
            resize: true
        });
    });

    $.getJSON('/cruise/priceByDuration?project=' + project, function (data) {
        Morris.Bar({
            element: 'price-by-duration-chart',
            data: data,
            xkey: 'duration_group',
            ykeys: ['inside', 'oceanview', 'balcony', 'suite'],
            labels: ['inside', 'oceanview', 'balcony', 'suite'],
            hideHover: 'auto',
            resize: true
        });
    });

});
