@extends('layouts/app')

@section('page-title')
  @lang('common.item_list_bill')
@stop

@section('section-title')
  @lang('common.item_list_bill')
@stop
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
      <table id="list-bills-table" class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>#</th>
            <th>@lang('common.field_name_bill')</th>
            <th>@lang('common.field_description_bill')</th>
            <th>@lang('common.field_cost_bill')</th>
            <th>@lang('common.field_time_bill')</th>
            <th>@lang('common.field_options_bill')</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($bills as $bill)
            <tr>
              <td>{{ $bill->id }}</td>
              <td>{{ $bill->user->name }}</td>
              <td>{{ str_limit($bill->description, \Config::get('common.LIMIT_STRING_DESCRIPTION')) }}</td>
              <td>{{ $bill->total_cost }}</td>
              <td>{{ $bill->created_at }}</td>
              <td class="center">
                <a href="{{ route('bill.show', [$bill->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                <a href="{{ route('bill.edit', [$bill->id]) }}" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                <a id='del' data-toggle="modal" data-target="#confirm-deleting" class="btn btn-danger btn-xs btn_delete" title="@lang('bills.delete.btn_remove_account')"><i class="fa fa-trash"></i></a>
                <input id="bill_id" type="hidden" value="{{ $bill->id }}">
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    @if (count($bills) > 0 )
    <!-- Modal Confirmation -->
      <div class="modal fade" id="confirm-deleting" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">@lang('bills.delete.confirm_title')</h4>
            </div>
            <div class="modal-body">
              <h5>@lang('bills.delete.confirm_msg')</h5>
            </div>
            <div class="modal-footer">
                <form action="{{ url('$bill->id') }}" method="POST">
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
@stop

@push('end-page-scripts')
  <script type="text/javascript">
    $(document).ready(function(){
      $('#list-bills-table').DataTable();
    });
  </script>
  <link rel="stylesheet" href="/bower_resources/gentelella/vendors/datatables.net/css/jquery.dataTables.min.css" media="screen" title="no title" charset="utf-8">
  <script src="/bower_resources/gentelella/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
  <script>
        $(document).ready(function() {
            $(document).on('click',".btn_delete", function() {
                var id = $(this).next().val();
                $('form').attr('action','bill/'+id);
                $('#idDel').text(id);
            });
        });
    </script>
@endpush
