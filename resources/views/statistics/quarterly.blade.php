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
              <div id="graph_donut"></div>
            </div>
        </div>
        <!-- /Percentage -->
    </div>
    <div class="col-md-4 col-sm-4 col-xs-12">
        <!-- Top ten -->
        <div class="x_panel">
            <div class="x_title">
              <h2><i class="glyphicon glyphicon-calendar fa fa-list-ol"></i> @lang('statistics.top_ten')</h2>
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
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="clearfix"></div>

                </div>
              </div>
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
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="clearfix"></div>

                </div>
              </div>
          </div>
        </div>
        <!-- /Orders -->
    </div>
    <!-- /Tables -->
@stop

@push('end-page-scripts')
    <script>
        var language = {!! json_encode(trans('statistics')) !!};

@endpush

@push('stylesheet')
    <!-- Datatables -->
    <link href="/bower_resources/gentelella/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="/bower_resources/gentelella/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="/bower_resources/gentelella/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="/bower_resources/gentelella/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="/bower_resources/gentelella/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
@endpush
