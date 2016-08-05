@extends('layouts/app')

@section('page-title')
 @lang('common.menu_products')
@stop

@section('section-title')
@lang('products.item_show_product')
@stop

@section('page-content')
<div class="x_content">
  <br />
  <form class="form-horizontal form-label-left" method="POST">
  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12"
    for="name">@lang('products.label_name_product')
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input id="name" class="form-control col-md-7 col-xs-12"  name="name"  type="text" value="{{ $product->name }}" >
    </div>
  </div>
  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12"
    for="categories">
    @lang('products.label_categories_product')
    </label>
    <div class="col-md-6 col-sm-7 col-xs-12">
      <select  class="form-control" name="category_id" disabled="">
        @foreach($categories as $category)
        <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">
    @lang('products.label_price_product')</label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="text" name="price"   class="form-control col-md-7 col-xs-12" value="{{ $product->price }}" >
    </div>
  </div>
  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">@lang('products.label_remaining_amount_product')</label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="text" name="remaining_amount" class="form-control col-md-7 col-xs-12" value="{{ $product->remaining_amount }}">
    </div>
  </div>
    <div class="item form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">@lang('products.label_description_product')
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <textarea  name="description" class="form-control col-md-7 col-xs-12">{{ $product->description }}</textarea>
      </div>
    </div>

    <div class="item form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12">
      @lang('products.label_is_on_sale_product')
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="" >
          <label>
            <input name="is_on_sale" type="checkbox" class="js-switch" {{ $product->is_on_sale ? 'checked' : ''}}/>
          </label>
        </div>
      </div>
    </div>
  <div class="form-group">
    <div class="col-md-6 col-xs-offset-3">
      <a class="btn btn-primary" href="{{ route('product.index') }}">@lang('products.btn_cancel')</a>
    </div>
  </div>
</form>
</div>
@stop
@push('end-page-scripts')
   <!-- validator -->
  <script src="/bower_resources/gentelella/vendors/validator/validator.min.js"></script>
  <!-- Switchery -->
  <script src="/bower_resources/gentelella/vendors/switchery/dist/switchery.min.js"></script>
@endpush
@push('stylesheet')
    <!-- Switchery -->
    <link href="/bower_resources/gentelella/vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/custom.css">
@endpush
