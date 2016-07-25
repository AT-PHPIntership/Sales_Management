@extends('layouts/app')

@section('page-title')
  @lang('common.item_list_bill')
@stop

@section('section-title')
  @lang('common.item_list_bill')
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
                <a class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                <a class="btn btn-danger btn-xs"><i class="fa fa-trash" aria-hidden="true"></i></a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
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
@endpush
