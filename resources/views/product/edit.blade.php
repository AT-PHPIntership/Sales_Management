@extends('layouts/app')

@section('page-title')
edit product
@stop

@section('section-title')
Edit products
@stop


@section('page-content') 

@if(Session::has('flash_message'))
    <div class="alert alert-success">
      {{ Session::get('flash_message') }}
    </div>
@endif
<div class="x_content">
  <br />
  <form class="form-horizontal form-label-left" method="POST" 
  action = "{{ route('product.update', [$product->id])}}">
  {{ csrf_field() }}
  {{ method_field('PUT') }}
  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" 
    for="name">@lang('products.label_name_product') <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="2"
       data-validate-words="1" name="name" required="required" type="text" 
       value="{{ $product->name }}" >
    </div>
  </div>
  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="categories">
    @lang('products.label_name_category')
    <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <select autofocus name="category">
        @foreach($categories as $category)
        <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number"> 
    @lang('products.label_price_product') <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="number" id="number" name="price" required="required" 
      class="form-control col-md-7 col-xs-12" value="{{ $product->price }}" >
    </div>
  </div>
  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">@lang('products.label_remaining_amount_product') <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="number" id="number" name="remaining_amount" required="required" class="form-control col-md-7 col-xs-12" value="{{ $product->remaining_amount }}">
    </div>
  </div>
    <div class="item form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">@lang('products.label_description_product')<span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <textarea id="textarea" required="required" name="textarea" class="form-control col-md-7 col-xs-12">{{ $product->description }}</textarea>
      </div>
    </div>
    <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">@lang('products.label_is_on_sale_product')<span class="required">*</span></label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <label class="control-label">@lang('products.option_yes')</label>
         <input type="radio" class="flat" name="gender" id="genderM" value="@lang('products.value_1')" {{ $product->is_on_sale == '1' ? 'checked':''}} />
      <label class="control-label">@lang('products.option_no')</label>
      <input type="radio" class="flat" name="gender" id="genderF" value="@lang('products.value_0')" {{ $product->is_on_sale == '0' ? 'checked':''}} />
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4 col-sm-offset-4 col-xs-offset-3">
      <a class="btn btn-primary" href="{{ route('product.index') }}">@lang('products.btn_cancel')</a>
      <button id="send" type="submit" class="btn btn-success"> @lang('products.btn_edit_product')</button>
    </div>
  </div>  

</form>
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