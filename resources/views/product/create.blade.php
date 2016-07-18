@extends('layouts/app')

@section('page-title')
  @lang('product.menu_products')
@stop

@section('section-title')
  @lang('product.item_add_product')
@stop
@section('page-content') 
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="clearfix"></div>
    <form class="form-horizontal form-row-seperated" action="{{action('ProductController@store') }}"
      method="Post">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">@lang('product.label_name_product')
              <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="Name product" required="required" type="text">
              </div>
          </div>

          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="categories">@lang('product.label_categories_product')
              <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select autofocus name="category">
                  @foreach($categories as $category)
                      <option value="{{ $category->id }}">{{ $category->name }}</option>
                  @endforeach
              </select>
            </div>
          </div>

          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="descrition">@lang('product.label_descrition_product')
              <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text"  name="description" required="required" class="form-control col-md-7 col-xs-12" placeholder="Description">
            </div>
          </div>

          <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price">@lang('product.label_price_product')
                <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text"  name="price" required="required" class="form-control col-md-7 col-xs-12"  placeholder="Price">
              </div>
          </div>

          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="is_on_sale">@lang('product.label_is_on_sale_product')
              <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select autofocus name="is_on_sale">
                <option value="">---option--</option>
                <option value="0">0</option>
                <option value="1">1</option>
              </select>
            </div>
          </div>

          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="remaining_amount">@lang('product.label_remaining_amount_product')
              <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="remaining_amount"  name="remaining_amount" required="required" class="form-control col-md-7 col-xs-12"  placeholder="Remaining_amount">
            </div>
          </div>
          
          <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
              <button id="send" type="submit" class="btn btn-success">@lang('product.label_submit_add_product')</button>
            </div>
          </div>
    </form>
  </div>
</div>
@stop
@push('end-page-scripts')
  <script type="text/javascript">
    $(document).ready(function(){
      $('#datatable-buttons').DataTable();
    });
  </script>
    <link rel="stylesheet" href="/bower_resources/gentelella/vendors/datatables.net/css/jquery.dataTables.min.css" media="screen" title="no title" charset="utf-8">
    <script src="/bower_resources/gentelella/vendors/datatables.net/js/jquery.dataTables.min.js">
  </script>
@endpush
