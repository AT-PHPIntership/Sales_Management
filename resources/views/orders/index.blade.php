@extends('layouts.app')
@section('page-title')
  @lang('orders.index.title')
@endsection

@section('section-title')
    @lang('orders.index.title')
@endsection

@section('errors-message')
    @include('common.errors')
@stop

@section('susscess-message')
    @include('common.success')
@stop

@section('page-content')
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="clearfix"></div>
        <table id="list-orders-table" class="table table-striped jambo_table table-bordered">
          <thead>
            <tr>
            <th class="text-center">@lang('orders.index.label_id')</th>
            <th class="text-center">@lang('orders.index.label_staff_name')</th>
            <th class="text-center">@lang('orders.index.label_description')</th>
            <th class="text-center">@lang('orders.index.label_supplier')</th>
            <th class="text-center">@lang('orders.index.label_total_cost')</th>
            <th class="text-center">@lang('orders.index.label_date')</th>
            <th class="text-center">@lang('orders.index.label_option')</th>
          </tr>
          </thead>
          <tbody>
            @foreach ($orders as $order)
            <tr class="even pointer">
              <td>{{ $order->id }}</td>
              <td>{{ $order->user->name }}</td>
              <td>{{ str_limit($order->description, Config::get('common.LIMIT_STRING_PRODUCT_DESCRIPTION')) }}</td>
              <td>{{ $order->supplier->name }}</td>
              <td class="text-right">{{ $order->total_cost }}</td>
              <td>{{ $order->created_at }}</td>
              <td class="text-center">
                  <a href="{{ route('order.show', [$order->id]) }}" title="@lang('orders.index.title_btn_detail')" class="btn btn-info btn-xs"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                  <a href="{{ route('order.edit', [$order->id]) }}" class="btn btn-warning btn-xs"><i class="fa fa-edit" title="@lang('orders.index.title_btn_edit')"></i></a>
                  <a id='del' data-toggle="modal" data-target="#confirm-deleting" class="btn btn-danger btn-xs btn_delete" title="@lang('orders.index.title_btn_delete')"><i class="fa fa-trash"></i></a>
                 <input id="order_id" type="hidden" value="{{ $order->id }}">
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
    </div>
        @if (count($orders) > 0 )
    <!-- Modal Confirmation -->
      <div class="modal fade" id="confirm-deleting" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">@lang('orders.delete.confirm_title')</h4>
            </div>
            <div class="modal-body">
              <h5>@lang('orders.delete.confirm_msg')</h5>
            </div>
            <div class="modal-footer">
                <form action="{{ url('$order->id') }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-danger">@lang('common.btn_delete')</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('common.btn_cancel')</button>
                </form>
            </div>
          </div>
        </div>
      </div>
    @endif
  </div>
@endsection

@push('stylesheet')
    <!-- Datatables -->
    <link href="/bower_resources/gentelella/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="/bower_resources/gentelella/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="/bower_resources/gentelella/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="/bower_resources/gentelella/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="/bower_resources/gentelella/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
@endpush

@push('end-page-scripts')
    <script src="/bower_resources/gentelella/vendors/datatables.net/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
      $(document).ready(function(){
        $('#list-orders-table').DataTable();
      });
    </script>

      <script>
        $(document).ready(function() {
            $(document).on('click',".btn_delete", function() {
                var id = $(this).next().val();
                $('form').attr('action','order/'+id);
                $('#idDel').text(id);
            });
        });
    </script>
@endpush
