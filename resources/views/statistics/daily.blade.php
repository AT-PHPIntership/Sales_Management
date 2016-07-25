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
                  @if(!count($bills->get()))
                      <div class="col-md-12 col-sm-12 col-xs-12">
                          <h5>
                              @lang('users.show.mgs_no_order')
                          </h5>
                      </div>
                  @else
                      <h4><b>@lang('statistics.label_total'): </b> @lang('common.currency') {{ number_format($bills->sum('total_cost')) }}</h4>
                      <table id="bills-datatable-buttons" class="table table-striped jambo_table table-bordered">
                        <thead>
                          <tr>
                            <th class="text-center">@lang('users.show.label_id')</th>
                            <th class="text-center">@lang('common.field_name_bill')</th>
                            <th class="text-center">@lang('common.field_description_bill')</th>
                            <th class="text-center">@lang('common.field_cost_bill')</th>
                            <th class="text-center">@lang('common.field_time_bill')</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($bills->get() as $bill)
                            <tr>
                              <td><a href="{{ route('bill.show', [$bill->id]) }}">{{ $bill->id }}</a></td>
                              <td>{{ $bill->user->name }}</td>
                              <td>{{ str_limit($bill->description, \Config::get('common.LIMIT_STRING_DESCRIPTION_75')) }}</td>
                              <td class="text-right">{{ $bill->total_cost }}</td>
                              <td class="text-right">{{ $bill->created_at }}</td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                @endif
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
                  @if(!count($orders))
                      <div class="col-md-12 col-sm-12 col-xs-12">
                          <h5>
                              @lang('users.show.mgs_no_order')
                          </h5>
                      </div>
                  @else
                      <h4><b>@lang('statistics.label_total'): </b> @lang('common.currency') {{ number_format($orders->sum('total_cost')) }}</h4>
                      <table id="orders-datatable-buttons" class="table table-striped jambo_table table-bordered">
                        <thead>
                          <tr>
                            <th class="text-center">@lang('users.show.label_id')</th>
                            <th class="text-center">@lang('common.field_name_bill')</th>
                            <th class="text-center">@lang('common.field_name_bill')</th>
                            <th class="text-center">@lang('common.field_description_bill')</th>
                            <th class="text-center">@lang('common.field_cost_bill')</th>
                            <th class="text-center">@lang('common.field_time_bill')</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($orders->get() as $order)
                            <tr>
                              <td><a href="{{ route('order.show', [$order->id]) }}">{{ $order->id }}</a></td>
                              <td>{{ $order->user->name }}</td>
                              <td>{{ $order->supplier->name }}</td>
                              <td>{{ str_limit($order->description, \Config::get('common.LIMIT_STRING_DESCRIPTION')) }}</td>
                              <td class="text-right">{{ $order->total_cost }}</td>
                              <td class="text-right">{{ $order->created_at }}</td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                @endif
                </div>
              </div>
          </div>
        </div>
        <!-- /Orders -->
    </div>
    <!-- /Tables -->

    <!-- Charts -->
    <div class="col-md-6 col-sm-6 col-xs-12">
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
              <div id="graph_donut" style="width:100%; height:300px;"></div>
            </div>
        </div>
        <!-- /Percentage -->
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <!-- Peak time -->
        <div class="x_panel">
            <div class="x_title">
              <h2><i class="glyphicon glyphicon-calendar fa fa-clock-o"></i> @lang('statistics.peak_time')</h2>
              <ul class="nav navbar-right panel_toolbox">
                <li class="pull-right">
                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="demo-container" style="height:250px">
                  <div id="placeholder3xx3" class="demo-placeholder" style="width: 100%; height:250px;"></div>
                </div>
            </div>
        </div>
        <!-- /Peak time -->
    </div>
    <!-- /Charts -->

@stop

@push('end-page-scripts')
    <!-- morris.js -->
    <script src="/bower_resources/gentelella/vendors/raphael/raphael.min.js"></script>
    <script src="/bower_resources/gentelella/vendors/morris.js/morris.min.js"></script>

    <!-- morris.js -->
    <script>
        var categoryData = [
            @foreach($data as $categoriesRatio)
                {label: {!! '\'' . $categoriesRatio->name . '\'' !!}, value: {!! $categoriesRatio->total !!} },
            @endforeach
        ];
    </script>
    <script src="/js/statistics/daily.categories.js"></script>

    <!-- Datatables -->
    <script src="/bower_resources/gentelella/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/bower_resources/gentelella/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="/bower_resources/gentelella/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/bower_resources/gentelella/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="/bower_resources/gentelella/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="/bower_resources/gentelella/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="/bower_resources/gentelella/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="/bower_resources/gentelella/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="/bower_resources/gentelella/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="/bower_resources/gentelella/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/bower_resources/gentelella/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="/bower_resources/gentelella/vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>
    <script src="/bower_resources/gentelella/vendors/jszip/dist/jszip.min.js"></script>
    <script src="/bower_resources/gentelella/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="/bower_resources/gentelella/vendors/pdfmake/build/vfs_fonts.js"></script>

    <script src="/js/statistics/datatable.buttons.custom.js"></script>
    <!-- /Datatables -->
@endpush

@push('stylesheet')
    <!-- Datatables -->
    <link href="/bower_resources/gentelella/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="/bower_resources/gentelella/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="/bower_resources/gentelella/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="/bower_resources/gentelella/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="/bower_resources/gentelella/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
@endpush
