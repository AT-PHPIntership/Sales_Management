@extends('layouts.app')

@section('page-title')
    @lang('statistics.quarterly.title')
@stop

@section('section-title')
    {{ $year }} - @lang('statistics.quarterly.msg_quarter') {{ $quarter }} @lang('statistics.quarterly.msg_statistics')
@stop

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
                                            <option>@lang('statistics.quarterly.msg_select')</option>
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
              <h2><i class="glyphicon glyphicon-calendar fa fa-sort"></i> @lang('statistics.quarterly.pi')</h2>
              <ul class="nav navbar-right panel_toolbox">
                <li class="pull-right">
                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <div class="x_title">
                <div class="row tile_count">
                  <div class="col-md-12 col-sm-12 col-xs-12 tile_stats_count">
                    <span class="count_top"><i class="fa fa-calendar"></i><b> @lang('statistics.quarterly.label_current') {{ $pi[0]->year }}-Q{{ $pi[0]->quarter }}</b></span>
                    <div class="count green">{{ $pi[0]->PI }}%</div>
                    <span class="count_bottom">
                    @if(($diffrence = $pi[0]->PI - $pi[1]->PI) > 0)
                      <i class="green">
                            <i class="fa fa-sort-asc"></i>{{ $diffrence }}%
                    @else
                      <i class="red">
                            <i class="fa fa-sort-desc"></i>{{ $diffrence }}%
                    @endif
                </i> @lang('statistics.quarterly.label_from_last_quarter')
                    </span>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
              <div class="col-md-12 col-sm-12 col-xs-6">
                @for($i = 1; $i < 4; $i++)
                <div>
                  <div class="count">
                      <p><b>{{ $pi[$i]->year }}-Q{{ $pi[$i]->quarter }}: <span class="green">{{ $pi[$i]->PI }}%</span></b>
                      @if(($diffrence = $pi[$i]->PI - $pi[$i + 1]->PI) > 0)
                      <i class="green pull-right">
                          <i class="fa fa-sort-asc"></i> {{ $diffrence }}%
                      @else
                      <i class="red pull-right">
                          <i class="fa fa-sort-desc"></i> {{ $diffrence }}%
                      @endif
                      </i>
                      </p>
                  </div>
                    <div class="">
                        <div class="progress progress_sm">
                            <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="{{ $pi[$i]->PI }}"></div>
                        </div>
                    </div>
                </div>
                @endfor
              </div>
            </div>
        </div>
    </div> <!-- /numbers -->

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
                <h2><i class="glyphicon glyphicon-calendar fa fa-list-ol"></i> @lang('statistics.quarterly.label_top_products')</h2>
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

    <!-- index -->
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2><i class="glyphicon glyphicon-calendar fa fa-line-chart"></i> @lang('statistics.quarterly.label_growth_chart') <small>@lang('statistics.quarterly.label_cmp_to_first')</small></h2>
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
    var quartersLabel = [
      @for ($i = 0; $i < 8; $i++)
        "{{ $billIndex[$i]->year }}-Q{{ $billIndex[$i]->quarter }}",
      @endfor
    ].reverse();
    var billsData = [
      @for ($i = 0; $i < 8; $i++)
        {{ $billIndex[$i]->index }},
      @endfor
    ].reverse();
    var ordersData = [
      @for ($i = 0; $i < 8; $i++)
        {{ $orderIndex[$i]->index }},
      @endfor
    ].reverse();

    Chart.defaults.global.legend = {
      enabled: false
    };

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
    </script>
    <!-- /Chart.js -->

    <!-- morris.js -->
    <script src="/bower_resources/gentelella/vendors/raphael/raphael.min.js"></script>
    <script src="/bower_resources/gentelella/vendors/morris.js/morris.min.js"></script>

    <!-- morris.js -->
    <script>
        var categoryData = [
        @foreach($categories as $category)
            {label: '{{ $category->name }}', value: {{ $category->percentage }}},
        @endforeach
            {label: language.quarterly.label_others, value: 100 - {{ $categories->sum('percentage') }}}
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
    <script src="/js/statistics/quarterly.custom.js"></script>
@endpush

@push('stylesheet')
    <!-- bootstrap-progressbar -->
    <link href="/bower_resources/gentelella/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="/bower_resources/gentelella/build/css/custom.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/custom.css">
@endpush
