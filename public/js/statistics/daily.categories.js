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
