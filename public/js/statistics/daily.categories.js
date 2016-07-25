$(document).ready(function() {
  Morris.Donut({
    element: 'graph_donut',
    data: categoryData,
    colors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
    formatter: function (y) {
      return y + "%";
    },
    resize: true
  });

  $MENU_TOGGLE.on('click', function() {
    $(window).resize();
  });
});
