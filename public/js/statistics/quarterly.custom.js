// Line chart
var ctx = document.getElementById("lineChart");
var lineChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: quartersLabel,
        datasets: [{
            label: language.quarterly.label_bill_gi,
            backgroundColor: "rgba(38, 185, 154, 0.31)",
            borderColor: "rgba(38, 185, 154, 0.7)",
            pointBorderColor: "rgba(38, 185, 154, 0.7)",
            pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
            pointHoverBackgroundColor: "#fff",
            pointHoverBorderColor: "rgba(220,220,220,1)",
            pointBorderWidth: 1,
            data: billsData
        }, {
            label: language.quarterly.label_order_gi,
            backgroundColor: "rgba(3, 88, 106, 0.3)",
            borderColor: "rgba(3, 88, 106, 0.70)",
            pointBorderColor: "rgba(3, 88, 106, 0.70)",
            pointBackgroundColor: "rgba(3, 88, 106, 0.70)",
            pointHoverBackgroundColor: "#fff",
            pointHoverBorderColor: "rgba(151,187,205,1)",
            pointBorderWidth: 1,
            data: ordersData
        }]
    },
});
Chart.defaults.global.legend = {
    enabled: false
};

// Bar chart
var ctx = document.getElementById("quater-bar-chart");
var mybarChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: months,
        datasets: [{
            label: language.quarterly.label_of_orders,
            backgroundColor: "#26B99A",
            data: totalOrder
        }, {
            label: language.quarterly.label_of_orders,
            backgroundColor: "#03586A",
            data: totalBill
        }]
    },
});

//morris.js
$(document).ready(function() {
    Morris.Bar({
        element: 'graph_bar',
        data: topTenData,
        xkey: 'product',
        ykeys: ['total'],
        labels: [language.label_total],
        barRatio: 0.4,
        barColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
        xLabelAngle: 35,
        hideHover: 'auto',
        resize: true,
        gridTextSize: 10
    });

    Morris.Donut({
        element: 'graph_donut',
        data: categoryData,
        colors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
        formatter: function(y) {
            return y + "%";
        },
        resize: true
    });

    $MENU_TOGGLE.on('click', function() {
        $(window).resize();
    });
});
