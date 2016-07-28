@extends('layouts.app')

@section('page-title')
    @lang('statistics.title')
@stop

@section('section-title')
    @lang('statistics.title')
@stop

{{-- @section('errors-message')
    @include('common.errors')
@stop

@section('susscess-message')
    @include('common.success')
@stop --}}

@section('page-content')
    <div class="col-md-3 col-sm-3 col-xs-7 pull-right">
        <!--selectbox-->
        <div class="col-md-12">
            <div class="form-group pull-right">
                <form id="quater-selector" class="form-horizontal pull-right" action="{{ route('statistic.quarterly') }}">
                    <fieldset>
                        <div class="control-group">
                            <div class="controls">
                                <div class="input-prepend input-group">
                                    <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                    <select name="quarter" id="quarter" class="form-control pull-right">
                                        @foreach($quarterList as $index => $quarter)
                                            @if($index == 0)
                                                @continue
                                            @endif
                                            <option value="{{ $quarter->Year}}{{$quarter->Quarter }}">{{ $quarter->Year . ' - Q' . $quarter->Quarter }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
        <!--/selectbox-->
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12">
    <!-- Charts -->
    <div class="col-md-8 col-sm-8 col-xs-12">
        <!-- Percentage of Categories -->
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
              <canvas id="quater-bar-chart"></canvas>
            </div>
        </div>
        <!-- /Percentage -->
    </div>
    <div class="col-md-4 col-sm-4 col-xs-12 bg-white">
        <!-- Top ten -->
        <div class="x_panel">
            <div class="x_title">
              <h2><i class="glyphicon glyphicon-calendar fa fa-list-ol"></i> @lang('statistics.index')</h2>
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
        <!-- /Top ten -->
    </div>
    <!-- /Charts -->

    <!-- Tables -->
    <div class="col-md-12 col-sm-12 col-xs-12">
        <!-- bills -->
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
        <!-- /bills -->

        <!-- Orders -->
        <div class="x_panel">
            <div class="x_title">
              <h2><i class="glyphicon glyphicon-calendar fa fa-calendar"></i> @lang('statistics.label_orders')</h2>
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
        <!-- /Orders -->
    </div>
    <!-- /Tables -->
@stop

@push('end-page-scripts')
    <!-- Chart.js -->
    <script src="/bower_resources/gentelella/vendors/Chart.js/dist/Chart.js"></script>

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
     var ctx = document.getElementById("quater-bar-chart");
     var mybarChart = new Chart(ctx, {
       type: 'bar',
       data: {
         labels: ["April", "May", "June"],
         datasets: [{
           label: '# of Votes',
           backgroundColor: "#26B99A",
           data: [51, 30, 40]
         }, {
           label: '# of Votes',
           backgroundColor: "#03586A",
           data: [72, 34, 12]
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

    <script>
        $(document).ready(function() {
            $('#quarter').change(function() {
                $('#quater-selector').submit();
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
@endpush
