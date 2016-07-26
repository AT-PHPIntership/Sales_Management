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
    <div class="col-md-6 col-sm-6 col-xs-12">
      <select autofocus name="category_id">
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
        <label class="control-label"> @lang('products.option_sale_no_product'): </label>
        <input type="radio" name="is_on_sale" value="{{ \Config::get('common.IS_ON_SALE_NO') }}" {{ $product->is_on_sale == \Config::get('common.IS_ON_SALE_NO') ? 'checked':''}} />
        <label class="control-label">@lang('products.option_sale_yes_product'): </label>
        <input type="radio" name="is_on_sale" value="{{ \Config::get('common.IS_ON_SALE_YES') }}" {{ $product->is_on_sale == \Config::get('common.IS_ON_SALE_YES') ? 'checked':''}} />
      </div>
    </div>
  <div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4 col-sm-offset-4 col-xs-offset-3">
      <a class="btn btn-primary" href="{{ route('product.index') }}">@lang('products.btn_cancel')</a>
      <a class="btn btn-primary" href="{{ route('product.edit',[$product->id]) }}">@lang('products.btn_edit')</a>
    </div>
  </div>  
</form>
</div>
@stop
