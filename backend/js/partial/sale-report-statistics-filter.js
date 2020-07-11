$(function () {
    $('#datepicker').datepicker({
        autoclose: true,
        startView: 1,
        minViewMode: "months"
    });

    $('#yearPicker').datepicker({
        autoclose: true,
        startView: 2,
        minViewMode: "years"
    });
});

var baseUrl = $('#baseUrl').val();
var selected_month = $('#selected_month').val();
var selected_year = $('#selected_year').val();
var selected_branch = $('#selected_branch').val();
var search_type = $('#search_type').val();
$.get(baseUrl + "/chart/api/sale-report-statistics-filter/"+selected_month+"/"+selected_year+"/"+selected_branch + "/" +search_type, function (data) {
    var labels = [];
    var amounts = [];
    var currency = data[0]['currency'] + ' ';

    data.forEach(function (element) {
        labels.push(element['sell_date']);
        amounts.push(element['total_sell_amount']);
    });


// Area Chart Example
    var ctx = document.getElementById("myAreaChart");
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: "Sells ",
                lineTension: 0.3,
                backgroundColor: "rgba(78, 115, 223, 0.05)",
                borderColor: "rgba(78, 115, 223, 1)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                pointBorderColor: "rgba(78, 115, 223, 1)",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
                data: amounts,
            }],
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 50,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    time: {
                        unit: 'date'
                    },
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        maxTicksLimit: 12
                    }
                }],
                yAxes: [{
                    ticks: {
                        maxTicksLimit: 12,
                        padding: 30,
                        // Include a dollar sign in the ticks
                        callback: function(value, index, values) {
                            return currency + number_format(value);
                        }
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }],
            },
            legend: {
                display: false
            },
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                intersect: false,
                mode: 'index',
                caretPadding: 10,
                callbacks: {
                    label: function(tooltipItem, chart) {
                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                        return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
                    }
                }
            }
        }
    });
});
