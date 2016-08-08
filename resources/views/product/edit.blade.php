@extends('layouts/app')

@section('page-title')
 @lang('common.menu_products')
@stop

@section('section-title')
@lang('products.item_edit_product')
@stop

@section('page-content')

@section('errors-message')
    @include('common.errors')
@stop

@section('susscess-message')
    @include('common.success')
@stop

<div class="x_content">
  <br />
  <form class="form-horizontal form-label-left" method="POST"
  action = "{{ route('product.update', [$product->id])}}">
  {{ csrf_field() }}
  {{ method_field('PUT') }}
  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12"
    for="name">@lang('products.label_name_product') <span class="required">
    *</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="2" data-validate-words="1" name="name"
      required="required" type="text" value="{{ $product->name }}" >
    </div>
  </div>
  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="categories">
    @lang('products.label_categories_product')
    <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-7 col-xs-12">
      <select  class="form-control" name="category_id">
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
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">@lang('products.label_description_product')<span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <textarea id="textarea" required="required" name="description" class="form-control col-md-7 col-xs-12">{{ $product->description }}</textarea>
      </div>
    </div>
    <div class="item form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12">
      @lang('products.label_is_on_sale_product') <span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="">
          <label>
            <input name="is_on_sale" type="checkbox" class="js-switch" {{ $product->is_on_sale ? 'checked' : ''}}/>
          </label>
        </div>
      </div>
    </div>
  <div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4 col-sm-offset-4 col-xs-offset-3">
      <a class="btn btn-primary" href="{{ route('product.index') }}">@lang('products.btn_cancel')</a>
      <button id="send" type="submit" class="btn btn-success"> @lang('products.btn_edit')</button>
    </div>
  </div>
</form>
</div>
@stop
@push('end-page-scripts')
  <script>
      var errorMessages = {!! json_encode(trans('errors')) !!};
  </script>

   <!-- validator -->
  <script src="/bower_resources/gentelella/vendors/validator/validator.min.js"></script>
  <!-- Validator submit -->
  <script>
    // Override validate message
    validator.message.min = errorMessages.min_2;
    validator.message.max = errorMessages.max_32;
    validator.message.date = errorMessages.invalid_date;
    validator.message.empty = errorMessages.field_required;
    validator.message.select = errorMessages.select_option;
    validator.message.complete = errorMessages.at_least_2_words;
    // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
      $('form')
        .on('blur', 'input[required], input.optional, select.required', validator.checkField)
        .on('change', 'select.required', validator.checkField)
        .on('keypress', 'input[required][pattern]', validator.keypress);
      $('.multi.required').on('keyup blur', 'input', function() {
        validator.checkField.apply($(this).siblings().last()[0]);
      });
      $('form').submit(function(e) {
        e.preventDefault();
        var submit = true;
        // evaluate the form using generic validaing
        if (!validator.checkAll($(this))) {
          submit = false;
        }
        if (submit)
          this.submit();
        return false;
      });
    </script>
    <!-- /validator -->
@endpush
@push('end-page-scripts')
<script type="text/javascript">
  $(document).ready(function(){
    $('#datatable-buttons').DataTable();
  });
</script>
<link href="/bower_resources/gentelella/vendors/switchery/dist/switchery.min.css" rel="stylesheet">
<link rel="stylesheet" href="/css/custom.css">
<link rel="stylesheet" href="/bower_resources/gentelella/vendors/datatables.net/css/jquery.dataTables.min.css" media="screen" title="no title" charset="utf-8">
<script src="/bower_resources/gentelella/vendors/datatables.net/js/jquery.dataTables.min.js"> </script>
<script src="/bower_resources/gentelella/vendors/switchery/dist/switchery.min.js"></script>
@endpush