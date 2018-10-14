"use strict"

function loadData()
{
    $.ajax({
        url: 'index.php/ajax/get_members',
        type: 'post',
        data: {},
        success: function(data) {
            var membersData = JSON.parse(data);
            createDataTable(membersData);
            createGraphData(membersData);
            drawChart();
        }
    });
}

function createDataTable(membersData)
{
    var membersTable = $('#members_table');
    var table = membersTable.DataTable({ // create smart table from our table and our data
        data: membersData,
        columns: [
            {data: 'id'},
            {data: 'firstname'},
            {data: 'surname'},
            {data: 'email'},
            {data: 'gender'},
            {data: 'joined_date'}
        ]
    });
    $('#members_table tfoot th').each(function() { // add search boxes for required columns
        var title = $(this).text();
        if (title != '') {
            $(this).html('<input type="text" placeholder="Search ' + title + '" />');
        }
    });
    table.columns().every(function() { // event handlers for the additional search boxes
        var column = this;
        $('input', this.footer()).on('keyup change', function() {
            if (column.search() != this.value) {
                column.search(this.value).draw();
            }
        });
    });
    membersTable[0].style.visibility = 'visible'; // show the table when everything is ready
}

var yearStats = [], monthStats = [];

function createGraphData(membersData)
{
    for (var i in membersData) {
        var date = membersData[i].joined_date;
        var match = /^(\d{4})\-(\d{2})/.exec(date);
        if (match) {
            var year = match[1], month = +match[2];
            if (yearStats[year] == undefined) {
                yearStats[year] = 1;
            } else {
                yearStats[year]++;
            }
            if (monthStats[year] == undefined) {
                monthStats[year] = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
            }
            monthStats[year][month]++;
            if (monthStats[year][0] < monthStats[year][month]) {
                monthStats[year][0] = monthStats[year][month]; // storing maximum months sign-up
            }
        }
    }
}

function drawChart()
{
    var chartData = [['Year', 'Sign-ups per year']];
    for (var year in yearStats) {
        chartData.push([year, yearStats[year]]);
    }
    var pieChartData = google.visualization.arrayToDataTable(chartData);

    var options = {
        title: 'Sign-ups per year'
    };

    var pieChart = new google.visualization.PieChart(document.getElementById('pie_chart'));
    pieChart.draw(pieChartData, options);

    // Add our selection handler
    google.visualization.events.addListener(pieChart, 'select', selectHandler);

    function selectHandler()
    {
        var selection = pieChart.getSelection();
        var year = pieChartData.getFormattedValue(selection[0].row, 0);

        var chartData = [['Month', 'Sign-ups']];
        var monthStat = monthStats[year];
        var maxVerticalAxis;
        for (var month in monthStat) {
            if (month > 0) {
                chartData.push([month, monthStat[month]]);
            } else {
                maxVerticalAxis = monthStat[0];
            }
        }
        var columnChartData = google.visualization.arrayToDataTable(chartData);

        var options = {
            title: 'Sign-ups per month in ' + year,
            vAxis: {format: '0', viewWindow: {max: maxVerticalAxis}} // to fight against google charts' strange behaviour
        };

        var columnChart = new google.visualization.ColumnChart(document.getElementById('column_chart'));
        columnChart.draw(columnChartData, options);
    }
}

$(document).ready(function() {
    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(loadData);
});
