// Morris.js Charts sample data for SB Admin template

$(function () {

    var itineraries = Morris.Line({
        element: 'travelocity-itineraries-chart',
        data: [{
            period: '2015-04',
            inside: 765,
            oceanview: 874,
            balcony: 1082,
            suite: 1768
        }, {
            period: '2015-05',
            inside: 875,
            oceanview: 983,
            balcony: 1284,
            suite: 2018
        }, {
            period: '2015-06',
            inside: 981,
            oceanview: 1021,
            balcony: 1178,
            suite: 2250
        }, {
            period: '2015-07',
            inside: 839,
            oceanview: 940,
            balcony: 1039,
            suite: 1900
        }, {
            period: '2015-08',
            inside: 799,
            oceanview: 834,
            balcony: 1127,
            suite: 1689
        }],
        xkey: 'period',
        ykeys: ['inside', 'oceanview', 'balcony', 'suite'],
        labels: ['inside', 'oceanview', 'balcony', 'suite'],
        pointSize: 1,
        hideHover: 'auto',
        resize: true
    });


});
