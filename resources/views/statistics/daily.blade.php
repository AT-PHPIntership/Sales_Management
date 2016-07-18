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
    <!-- pie chart -->
    <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Categories Ratio</h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content2">
          <div id="graph_donut" style="width:100%; height:300px;"></div>
          <div class="">
              {{dd($products)}}
          </div>
        </div>
      </div>
    </div>
    <!-- /Pie chart -->
@stop

@push('end-page-scripts')
    <!-- morris.js -->
    <script src="/bower_resources/gentelella/vendors/raphael/raphael.min.js"></script>
    <script src="/bower_resources/gentelella/vendors/morris.js/morris.min.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

    <!-- morris.js -->
    <script>
      $(document).ready(function() {
        Morris.Donut({
          element: 'graph_donut',
          data: [
            {label: 'Jam', value: 50},
            {label: 'Frosted', value: 22},
            {label: 'Custard', value: 25},
            {label: 'Sugar', value: 3}
          ],
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
    </script>
    <!-- /morris.js -->
@endpush
