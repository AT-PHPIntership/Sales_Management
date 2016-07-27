@extends('layouts.app')

@section('page-title')
    @lang('statistics.title')
@stop

@section('section-title')
    @lang('statistics.title')
@stop

@section('errors-message')
    @include('common.errors')
@stop

@section('susscess-message')
    @include('common.success')
@stop --}}

@section('page-content')
    <!-- Tables -->
    <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Line graph<small>Sessions</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <canvas id="lineChart"></canvas>
                  </div>
                </div>
              </div>
    <!-- /Charts -->
@stop

@push('end-page-scripts')
    <script>
        var language = {!! json_encode(trans('statistics')) !!};
    </script>
    <!-- morris.js -->
    <script src="/bower_resources/gentelella/vendors/raphael/raphael.min.js"></script>
    <script src="/bower_resources/gentelella/vendors/morris.js/morris.min.js"></script>

    <!-- morris.js -->
    <script>
        var categoryData = [
            @foreach($categories->get() as $category)
                {label: '{{ $category->name }}', value: {{ $category->percentage }}},
            @endforeach
        ];

        var topTenData = [
            @foreach($topTen->paginate(10) as $product)
                {product: '{{ $product->name }}', total: {{ $product->total }}},
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
    <script src="/bower_resources/gentelella/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
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
