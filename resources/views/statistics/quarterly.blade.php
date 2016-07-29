@extends('layouts.app')

@section('page-title')
    @lang('statistics.quarterly.title')
@stop

@section('section-title')
    @lang('statistics.quarterly.title')
@stop

{{-- @section('errors-message')
    @include('common.errors')
@stop

@section('susscess-message')
    @include('common.success')
@stop --}}

@section('page-content')
    <div class="col-md-4 col-sm-4 col-xs-12 pull-right">
        <!--selectbox-->
            <div class="form-group pull-right">
                <form id="quater-selector" class="form-horizontal pull-right" action="{{ route('statistic.quarterly') }}">
                    <fieldset>
                        <div class="control-group">
                            <div class="controls">
                                <div class="input-prepend input-group">
                                    <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                    <select name="quarter" id="quarter" class="form-control pull-right">
                                            <option>Select a Quarter</option>
                                        @foreach($quatersList as $index => $quarter)
                                            @if($index == 0)
                                                @continue
                                            @endif
                                            <option value="{{ $quarter->year }}Q{{ $quarter->quarter }}">{{ $quarter->year . ' - Q' . $quarter->quarter }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        <!--/selectbox-->
    </div>

    <div class="clearfix"></div>

    <!-- bar chart -->
    <div class="col-md-8 col-sm-8 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
              <h2><i class="glyphicon glyphicon-calendar fa fa-bar-chart"></i> @lang('statistics.quarterly.label_totals')</h2>
              <ul class="nav navbar-right panel_toolbox">
                <li class="pull-right">
                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <canvas id="quater-bar-chart"></canvas>
            </div>
        </div>
    </div> <!-- /bar chart -->

    <!-- numbers -->
    <div class="col-md-4 col-sm-4 col-xs-12 bg-white">
        <!-- Top ten -->
        <div class="x_panel">
            <div class="x_title">
              <h2><i class="glyphicon glyphicon-calendar fa fa-list-ol"></i> @lang('statistics.quarterly.pi')</h2>
              <ul class="nav navbar-right panel_toolbox">
                <li class="pull-right">
                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <div class="x_title">
                <h2>Top Campaign Performance</h2>
                <div class="clearfix"></div>
              </div>

              <div class="col-md-12 col-sm-12 col-xs-6">
                <div>
                  <p>Facebook Campaign</p>
                  <div class="">
                    <div class="progress progress_sm" style="width: 76%;">
                      <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="80"></div>
                    </div>
                  </div>
                </div>
                <div>
                  <p>Twitter Campaign</p>
                  <div class="">
                    <div class="progress progress_sm" style="width: 76%;">
                      <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="60"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12 col-sm-12 col-xs-6">
                <div>
                  <p>Conventional Media</p>
                  <div class="">
                    <div class="progress progress_sm" style="width: 76%;">
                      <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="40"></div>
                    </div>
                  </div>
                </div>
                <div>
                  <p>Bill boards</p>
                  <div class="">
                    <div class="progress progress_sm" style="width: 76%;">
                      <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div> <!-- /numbers -->

    <!-- index -->
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2><i class="glyphicon glyphicon-calendar fa fa-calendar"></i> @lang('statistics.label_bills')</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li class="pull-right">
                  <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <canvas id="lineChart"></canvas>
          </div>
        </div>
    </div> <!-- /index -->

    <!-- product -->
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="glyphicon glyphicon-calendar fa fa-pie-chart"></i> @lang('statistics.quarterly.per_cate')</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li class="pull-right">
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div id="graph_donut"></div>
            </div>
        </div>
    </div> <!-- /product -->

    <!-- user -->
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="glyphicon glyphicon-calendar fa fa-pie-chart"></i> @lang('statistics.per_cate')</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li class="pull-right">
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div id="graph_bar"></div>
            </div>
        </div>
    </div> <!-- /user -->
@stop

@push('end-page-scripts')
    <script>
        $(document).ready(function() {
            $('#quarter').change(function() {
                console.log('clicked');
                $('#quater-selector').submit();
            });
        });
    </script>

    <!-- Chart.js -->
    <script src="/bower_resources/gentelella/vendors/Chart.js/dist/Chart.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="/bower_resources/gentelella/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- Flot -->
    <script src="/bower_resources/gentelella/vendors/Flot/jquery.flot.js"></script>
    <script src="/bower_resources/gentelella/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="/bower_resources/gentelella/vendors/Flot/jquery.flot.time.js"></script>
    <script src="/bower_resources/gentelella/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="/bower_resources/gentelella/vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="/bower_resources/gentelella/production/js/flot/jquery.flot.orderBars.js"></script>
    <script src="/bower_resources/gentelella/production/js/flot/date.js"></script>
    <script src="/bower_resources/gentelella/production/js/flot/jquery.flot.spline.js"></script>
    <script src="/bower_resources/gentelella/production/js/flot/curvedLines.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="/bower_resources/gentelella/build/js/custom.min.js"></script>

    <script>
        var language = {!! json_encode(trans('statistics')) !!};
    </script>

    <!-- Chart.js -->
    <script>
        Chart.defaults.global.legend = {
            enabled: false
        };

        // Line chart
        var ctx = document.getElementById("lineChart");
        var lineChart = new Chart(ctx, {
          type: 'line',
          data: {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [{
              label: "My First dataset",
              backgroundColor: "rgba(38, 185, 154, 0.31)",
              borderColor: "rgba(38, 185, 154, 0.7)",
              pointBorderColor: "rgba(38, 185, 154, 0.7)",
              pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
              pointHoverBackgroundColor: "#fff",
              pointHoverBorderColor: "rgba(220,220,220,1)",
              pointBorderWidth: 1,
              data: [31, 74, 6, 39, 20, 85, 7]
            }, {
              label: "My Second dataset",
              backgroundColor: "rgba(3, 88, 106, 0.3)",
              borderColor: "rgba(3, 88, 106, 0.70)",
              pointBorderColor: "rgba(3, 88, 106, 0.70)",
              pointBackgroundColor: "rgba(3, 88, 106, 0.70)",
              pointHoverBackgroundColor: "#fff",
              pointHoverBorderColor: "rgba(151,187,205,1)",
              pointBorderWidth: 1,
              data: [82, 23, 66, 9, 99, 4, 2]
            }]
          },
        });

          // Bar chart
         var months = [
             @foreach($quaterlyTotalOrder as $totalOrder)
                 "{{ $totalOrder->month }}",
             @endforeach
         ];
         var totalOrder = [
             @foreach($quaterlyTotalOrder as $totalOrder)
                 "{{ $totalOrder->total }}",
             @endforeach
         ];
         var totalBill = [
             @foreach($quaterlyTotalBill as $totalBill)
                 "{{ $totalBill->total }}",
             @endforeach
         ];
         console.log(months);
         console.log(totalOrder);
         console.log(totalBill);
         var ctx = document.getElementById("quater-bar-chart");
         var mybarChart = new Chart(ctx, {
           type: 'bar',
           data: {
             labels: months,
             datasets: [{
               label: '# of Votes',
               backgroundColor: "#26B99A",
               data: totalOrder
             }, {
               label: '# of Votes',
               backgroundColor: "#03586A",
               data: totalBill
             }]
           },

           options: {
             scales: {
               yAxes: [{
                 ticks: {
                   beginAtZero: true
                 }
               }]
             }
           }
         });
        </script>
        <!-- /Chart.js -->


        <!-- Flot -->
        <script>
          $(document).ready(function() {
            var data1 = [
              [gd(2012, 1, 1), 17],
              [gd(2012, 1, 2), 74],
              [gd(2012, 1, 3), 6],
              [gd(2012, 1, 4), 39],
              [gd(2012, 1, 5), 20],
              [gd(2012, 1, 6), 85],
              [gd(2012, 1, 7), 7]
            ];

            var data2 = [
              [gd(2012, 1, 1), 82],
              [gd(2012, 1, 2), 23],
              [gd(2012, 1, 3), 66],
              [gd(2012, 1, 4), 9],
              [gd(2012, 1, 5), 119],
              [gd(2012, 1, 6), 6],
              [gd(2012, 1, 7), 9]
            ];
            $("#canvas_dahs").length && $.plot($("#canvas_dahs"), [
              data1, data2
            ], {
              series: {
                lines: {
                  show: false,
                  fill: true
                },
                splines: {
                  show: true,
                  tension: 0.4,
                  lineWidth: 1,
                  fill: 0.4
                },
                points: {
                  radius: 0,
                  show: true
                },
                shadowSize: 2
              },
              grid: {
                verticalLines: true,
                hoverable: true,
                clickable: true,
                tickColor: "#d5d5d5",
                borderWidth: 1,
                color: '#fff'
              },
              colors: ["rgba(38, 185, 154, 0.38)", "rgba(3, 88, 106, 0.38)"],
              xaxis: {
                tickColor: "rgba(51, 51, 51, 0.06)",
                mode: "time",
                tickSize: [1, "day"],
                //tickLength: 10,
                axisLabel: "Date",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Verdana, Arial',
                axisLabelPadding: 10
              },
              yaxis: {
                ticks: 8,
                tickColor: "rgba(51, 51, 51, 0.06)",
              },
              tooltip: false
            });

            function gd(year, month, day) {
              return new Date(year, month - 1, day).getTime();
            }
          });
        </script>
        <!-- /Flot -->

        <!-- morris.js -->
        <script src="/bower_resources/gentelella/vendors/raphael/raphael.min.js"></script>
        <script src="/bower_resources/gentelella/vendors/morris.js/morris.min.js"></script>

        <!-- morris.js -->
        <script>
            var categoryData = [
            @foreach($categories as $category)
                {label: '{{ $category->name }}', value: {{ $category->percentage }}},
            @endforeach
                {label: 'Others', value: 100 - {{ $categories->sum('percentage') }}}
            ];

            var topTenData = [
                @foreach($topTen as $product)
                    {product: '{{ $product->name }}', total: {{ $product->total }}},
                @endforeach
            ];
        </script>
        <script>
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

        </script>
@endpush

@push('stylesheet')
    <!-- Datatables -->
    <link href="/bower_resources/gentelella/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="/bower_resources/gentelella/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="/bower_resources/gentelella/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="/bower_resources/gentelella/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="/bower_resources/gentelella/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="/bower_resources/gentelella/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
@endpush
