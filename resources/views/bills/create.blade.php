@extends('layouts/app')

@section('page-title')
  @lang('common.menu_sales')
@stop

@section('section-title')
  @lang('common.item_new_bill')
@stop

@push('stylesheet')
  <link rel="stylesheet" href="/bower_resources/jquery-ui/themes/smoothness/jquery-ui.min.css" type="text/css" media="all" />
  <link rel="stylesheet" href="/bower_resources/jScrollPane/style/jquery.jscrollpane.css" type="text/css" media="all" />
  <link rel="stylesheet" href="/bower_resources/gentelella/vendors/datatables.net/css/jquery.dataTables.min.css" media="screen" title="no title" charset="utf-8">
@endpush

@section('errors-message')
    @include('common.errors')
@stop

@section('susscess-message')
    @include('common.success')
@stop

@section('page-content')
  <form action="{{ route('bill.store') }}" method="POST" class="form-horizontal form-label-left" novalidate id="print-bill">
    <div class="col-md-7 col-sm-7 col-xs-12">
      <div class="clearfix"></div>
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div id="print-visible">
        <div class="row">
          <div class="form-group">
            <label class="col-md-2 col-sm-2 col-xs-3 left"> @lang('bills.create.staff_name_label'): </label>
            <label class="col-md-4 col-sm-4 col-xs-6 left"> {{ Auth::user()->name }} </label>
          </div>
        </div>
        <div class="row">
          <div class="form-group">
            <label class="col-md-2 col-sm-2 col-xs-3 left"> @lang('bills.create.total_cost_label'): </label>
            <label class="col-md-4 col-sm-4 col-xs-6 left" id="print-cost"></label>
          </div>
        </div>
        <div class="row">
          <div class="form-group">
            <label class="col-md-2 col-sm-2 col-xs-3 left"> @lang('bills.common.label_date') </label>
            <label class="col-md-4 col-sm-4 col-xs-6 left" id="print-cost">{{ Carbon\Carbon::now() }}</label>
          </div>
        </div>
      </div>

      <div id="items_container" class="row">
        <div class="well">
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="text-input"> @lang('bills.create.product_label') : </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" required="required" id="text-input" class="product form-control col-md-7 col-xs-12" placeholder="{{ trans('bills.create.label_input_product') }}"/>
            </div>
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="amount-input"> @lang('bills.create.amount_label') : </label>
            <div class="col-md-2 col-sm-2 col-xs-12">
              <input type="number" min="1" max="1" value="1" id="amount-input" class="form-control col-md-7 col-xs-12">
            </div>
          </div>
        </div>
        <table id="selected-product-datatable" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>@lang('bills.create.index_label')</th>
              <th>@lang('bills.create.product_label')</th>
              <th>@lang('bills.create.amount_label')</th>
              <th>@lang('bills.create.cost_label') (@lang('bills.create.currency_label'))</th>
              <th class="print-hidden">@lang('bills.create.option_label')</th>
            </tr>
          </thead>
          <tbody>
            <tr id="itemRow0">
              <td class="center"> <span class="index"></span> </td>
              <td>
                <span class="product-label"></span>
                <input type="hidden" name="product_id[]" class="product-input" value="1">
              </td>
              <td class="center">
                <span class="amount-label"></span>
                <input type="hidden" name="amount[]" class="amount-input" value="1">
              </td>
              <td class="center">
                <span class="price-label"></span>
                <input type="hidden" name="price[]" class="price-input" value="1">
              </td>
              <td class="center print-hidden">
                <a name="remove" class="btn btn-danger btn-xs btn_remove"><i class="fa fa-trash" aria-hidden="true"></i></a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="col-md-5 col-sm-5 col-xs-12 print-hidden">
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12"> @lang('bills.create.staff_name_label'):</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <input type="text" class="form-control col-md-7 col-xs-12" required  value="{{ Auth::user()->name }}" disabled/>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="total_cost"> @lang('bills.create.total_cost_label'):</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <input type="text" id='total-cost-display' name="total_cost" class="form-control  col-md-7 col-xs-12" value="0$" required="required" disabled/>
          <input type="hidden" id='total-cost' name="total_cost" class="form-control" value="0" required="required"/>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description"> @lang('bills.create.description_label'):</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <textarea class="form-control col-md-7 col-xs-12" name="description"></textarea>
        </div>
      </div>

      <div class="ln_solid"></div>
      <div class="form-group print-hidden">
        <div class="col-md-9 col-sm-12 col-xs-12 col-md-offset-2 col-xs-offset-2">
          <a href="{{ route('bill.create') }}" class="btn btn-danger"><i class="fa fa-refresh"></i> @lang('bills.create.btn_reset')</a>
          <button type="button" class="btn btn-info" id="btn-print"><i class="fa fa-print"></i> @lang('common.btn_print')</button>
          <button type="submit" class="btn btn-success"><i class="fa fa-print" aria-hidden="true"></i> @lang('bills.create.btn_submit')</button>
        </div>
      </div>
    </div>
  </form>
  <!-- Modal -->
  <div class="modal fade" id="errorMessageModel" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">@lang('bills.create.title_model')</h4>
        </div>
        <div class="modal-body">
          <h5>@lang('bills.create.error_cost_message')</h5>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">@lang('bills.create.btn_close')</button>
        </div>
      </div>
    </div>
  </div>

@stop

@push('end-page-scripts')
  <script src="/bower_resources/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
  <script src="/bower_resources/flexcomplete/dist/jquery.flexcomplete.min.js"></script>
  <script src="/bower_resources/jquery-mousewheel/jquery.mousewheel.min.js" type="text/javascript"></script>
	<script src="/bower_resources/jScrollPane/script/jquery.jscrollpane.min.js" type="text/javascript"></script>
  <script src="/bower_resources/gentelella/vendors/validator/validator.min.js" type="text/javascript"></script>
  <script src="/bower_resources/gentelella/vendors/datatables.net/js/jquery.dataTables.min.js" charset="utf-8"></script>
  <script type="text/javascript">
    var currency_label = '{{ trans('bills.create.currency_label') }}';
    var url = '{{ url('api/product') }}';
  </script>
  <script src="/js/bills/main.js" type="text/javascript"></script>

  <script src="/js/printThis.js"></script>
  <script type="text/javascript">
      $('#btn-print').on('click', function() {
          $('#print-bill').printThis({
              importCSS: true,
              loadCSS: "/css/billPrint.css"
          });
      });
  </script>
@endpush
