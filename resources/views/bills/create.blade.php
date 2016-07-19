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
@endpush

@section('errors-message')
    @include('common.errors')
@stop

@section('susscess-message')
    @include('common.success')
@stop

@section('page-content')

  <div class="row">
    <form action="{{ route('bill.store') }}" method="POST" class="form-horizontal form-label-left" novalidate>
      <div class="col-md-7 col-sm-7 col-xs-12">
        <div class="clearfix"></div>
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div id="items_container" class="row">
            <div class="row">
              <div class="col-md-4 col-sm-4 col-xs-12">
                <button type="button" name="add" id="addItemBtn" class="btn btn-success">@lang('bills.create.button_add_item_label')</button>
              </div>
            </div>
          </div>
      </div>
      <div class="col-md-5 col-sm-5 col-xs-12">
        <div class="row">
          <label for="user_id">@lang('bills.create.staff_name_label'): </label>
          <input type="text" class="form-control" required  value="{{ Auth::user()->name }}" disabled/>
        </div>
        <div class="row">
          <label for="total_cost">@lang('bills.create.total_cost_label'): </label>
          <input type="text" id='cost_display' name="total_cost" class="form-control" value="0$" required="required" disabled/>
          <input type="hidden" id='total_cost' name="total_cost" class="form-control" value="0" required="required"/>
        </div>
        <div class="row">
          <div class="form-group">
            <label for="description">@lang('bills.create.description_label'): </label>
            <textarea class="form-control" name="description"></textarea>
          </div>
        </div>
        <div class="row">
          <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-5 col-sm-offset-5 col-xs-offset-5">
              <button type="submit" class="btn btn-success">Submit</button>
            </div>
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
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
  <script type="text/javascript">
    var product_label = {!! '\''.trans('bills.create.product_label').'\'' !!};
    var amount_label = {!! '\''.trans('bills.create.amount_label').'\'' !!};
    var url = {!! '\''.url('api/product').'\'' !!};
  </script>
  <script src="/js/bills/main.js" type="text/javascript"></script>
@endpush
