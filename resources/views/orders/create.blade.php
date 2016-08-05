@extends('layouts/app')

@section('page-title')
  @lang('orders.create.title')
@stop

@section('section-title')
  @lang('orders.create.section-title')
@stop

@push('stylesheet')
  <link rel="stylesheet" href="/bower_resources/jquery-ui/themes/smoothness/jquery-ui.min.css" type="text/css" media="all" />
  <link rel="stylesheet" href="/bower_resources/jScrollPane/style/jquery.jscrollpane.css" type="text/css" media="all" />
@endpush

@section('errors-message')
    @include('common.errors')
@stop

@section('susscess-message')
    @include('common.success')
@stop

@section('page-content')

  <div class="row">
    <form action="{{ action('OrderController@store') }}" method="POST" class="form-horizontal form-label-left" novalidate>
      <!--left section-->
      <div class="col-md-7 col-sm-7 col-xs-12">
          {{ csrf_field() }}

          <div class="input-group col-md-offset-9 margin-button-add">
              <button type="button" name="add" id="addItemBtn" class="btn btn-success pull-right">
                  <i class="fa fa-plus" aria-hidden="true"></i> @lang('orders.common.btn_add_item')
              </button>
          </div>

          <div id="items_container" class="row">
            <div class="form-group" id="item1">
              <label class="control-label col-md-2 col-sm-2 col-xs-12" for="product_id"> @lang('orders.common.label_product')</label>
              <div class="col-md-4 col-sm-4 col-xs-12">
                <input type="text" required="required" class="product form-control col-md-7 col-xs-12" />
                <input type="hidden" name="product_id[]" class="product_id form-control col-md-7 col-xs-12" required="required"/>
              </div>
              <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name"> @lang('orders.common.label_amount') : </label>
              <div class="col-md-2 col-sm-2 col-xs-12">
                <input type="number" name="amount[]" min="1" value="1" class="amount form-control col-md-7 col-xs-12 amount-box">
              </div>
              <div class="col-md-1 col-sm-2 col-xs-12">
                <button type="button" name="remove" class="btn btn-danger btn_remove" disabled="disabled"><i class="fa fa-times" aria-hidden="true"></i></button>
              </div>
            </div>
          </div>
      </div>
      <!--/left section-->

      <div class="col-md-5 col-sm-5 col-xs-12">
        <div class="form-group">
          <label class="control-label" for="user_id">@lang('orders.common.label_staff_name'): </label>
          <div class="input-group col-md-12 col-sm-12 col-xs-12">
              <input type="text" class="form-control" required  value="{{ Auth::user()->name }}" disabled>
          </div>
        </div>

        <div class="form-group">
            <label for="user_id">@lang('orders.common.label_supplier'): </label>
            <div class="input-group col-md-12 col-sm-12 col-xs-12">
                <select class="form-control" autofocus="" name="supplier_id">
                    @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="total_cost">@lang('orders.common.label_total_cost'): </label>
            <div class="input-group col-md-12 col-sm-12 col-xs-12">
                <input type="number" name="total_cost" class="form-control">
                <span class="input-group-addon">@lang('common.usa_currency_label')</span>
            </div>
        </div>
        <div class="form-group">
            <label for="description">@lang('orders.common.label_description'): </label>
            <div class="input-group col-md-12 col-sm-12 col-xs-12">
                <textarea class="form-control" name="description" row=3></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-3 col-sm-3 col-xs-12 col-md-offset-3">
              <a href="{{ action('OrderController@create') }}" class="btn btn-danger"><i class="fa fa-refresh"></i> @lang('orders.common.btn_reset')</a>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <button type="submit" class="btn btn-success"><i class="fa fa-print" aria-hidden="true"></i> @lang('orders.common.btn_submit')</button>
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
            <h4 class="modal-title">@lang('orders.create.title_model')</h4>
          </div>
          <div class="modal-body">
            <h5>@lang('orders.common.error_cost_message')</h5>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">@lang('orders.common.btn_close')</button>
          </div>
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
  <script type="text/javascript">
    var currency_label = '{{ trans('common.currency') }}';
    var url = '{{ url('api/order/product') }}';
  </script>
  <script src="/js/orders/main.js" type="text/javascript"></script>
@endpush
