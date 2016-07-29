@extends('layouts/app')

@section('page-title')
  @lang('bills.edit.title', ['id' => $bill->id])
@stop

@section('section-title')
  <a href="{{ url()->previous() }}"><i class="fa fa-arrow-circle-left fa-2x"></i></a>
  <span style="vertical-align: super;">&nbsp;@lang('bills.edit.label_page', ['id' => $bill->id])</span>
@stop

@push('stylesheet')
  <link rel="stylesheet" href="/bower_resources/jquery-ui/themes/smoothness/jquery-ui.min.css" type="text/css" media="all" />
  <link rel="stylesheet" href="/bower_resources/jScrollPane/style/jquery.jscrollpane.css" type="text/css" media="all" />
@endpush

@section('susscess-message')
  @include('common.success')
@stop

@section('errors-message')
  @include('common.errors')
@stop

@section('page-content')
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_content">
        <form action="{{ route('bill.update', [$bill->id]) }}" method="POST" class="form-horizontal form-label-left" novalidate id="print-bill">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="_method" value="PUT">
          <div class="col-md-7 col-sm-7 col-xs-12">
            <div id="items_container" class="row">
              <div class="well">
                <div class="form-group">
                  <label class="control-label col-md-2 col-sm-2 col-xs-12" for="text-input"> @lang('bills.common.label_product') : </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" required="required" id="text-input" class="product form-control col-md-7 col-xs-12" placeholder="{{ trans('bills.common.label_input_product') }}"/>
                  </div>
                  <label class="control-label col-md-2 col-sm-2 col-xs-12" for="amount-input"> @lang('bills.common.label_amount') : </label>
                  <div class="col-md-2 col-sm-2 col-xs-12">
                    <input type="number" min="1" max="1" value="1" id="amount-input" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
              </div>
              <div class="table-container">
                <table id="selected-product-datatable" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>@lang('bills.common.field_id')</th>
                      <th>@lang('bills.common.field_product')</th>
                      <th>@lang('bills.common.field_amount')</th>
                      <th>@lang('bills.common.field_cost') (@lang('bills.create.currency_label'))</th>
                      <th class="print-hidden">@lang('bills.common.field_option')</th>
                    </tr>
                  </thead>
                  <?php $i=1; ?>
                  <tbody>
                    @foreach ($bill->billDetails as $billDetail)
                    <tr id="itemRow{{ $i }}">
                      <td class="center">
                        <span class="index">{{ $i++ }}</span>
                      </td>
                      <td>
                        <span class="product-label"> {{ $billDetail->product_id }} - {{ $billDetail->product->name }} - {{ $billDetail->product->price }}{{ trans('bills.common.currency_label') }}</span>
                        <input type="hidden" name="product_id[]" class="product-input form-control" value="{{ $billDetail->product_id }}" disabled>
                      </td> 
                      <td class="center">
                        <span class="amount-label"> {{ $billDetail->amount }}</span>
                        <input type="hidden" name="amount[]" class="amount-input form-control" min="1" value="{{ $billDetail->amount }}">
                      </td>
                      <td class="center">
                        <span class="price-label">{{ $billDetail->cost }}</span>
                        <input type="hidden" name="price[]" class="price-input" value="{{ $billDetail->product->price }}">
                      </td>
                      <td class="center print-hidden">
                        <a name="remove" class="btn btn-danger btn-xs btn_remove" disabled><i class="fa fa-trash" aria-hidden="true"></i></a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="col-md-5 col-sm-5 col-xs-12">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12"> @lang('bills.common.label_staff')</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control col-md-7 col-xs-12" required  value="{{ $bill->user->name }}" disabled/>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="total_cost"> @lang('bills.common.label_total_cost')</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" id='total-cost-display' class="form-control  col-md-7 col-xs-12" value="{{ $bill->total_cost }}{{ trans('bills.create.currency_label') }}" required="required" disabled/>
                <input type="hidden" id='total-cost' name="total_cost" class="form-control" value="{{ $bill->total_cost }}" required="required"/>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description"> @lang('bills.common.label_description'):</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <textarea class="form-control col-md-7 col-xs-12" name="description">{{ $bill->description }}</textarea>
              </div>
            </div>

            <div class="ln_solid"></div>
            <div class="form-group print-hidden">
              <div class="col-md-9 col-sm-12 col-xs-12 col-md-offset-3 col-xs-offset-2">
                <a href="{{ route('bill.edit', [$bill->id]) }}" class="btn btn-danger"><i class="fa fa-refresh"></i> @lang('bills.common.btn_reset')</a>
                <button type="submit" class="btn btn-success"><i class="fa fa-print" aria-hidden="true"></i> @lang('bills.common.btn_submit')</button>
              </div>
            </div>
          </div>
        </form>
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
    var currency_label = '{{ trans('bills.create.currency_label') }}';
    var url = '{{ url('api/product') }}';
    var size = {{ count($bill->billDetails) }};
    var existing_id = [
      @foreach($bill->billDetails as $billDetail)
        {{ $billDetail->product_id }},
      @endforeach
    ];
  </script>
  <script src="/js/bills/edit.js" type="text/javascript"></script>
@endpush
