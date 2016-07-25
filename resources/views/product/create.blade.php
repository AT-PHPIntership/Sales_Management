@extends('layouts/app')

@section('page-title')
  @lang('products.menu_products')
@stop

@section('section-title')
  @lang('products.item_add_product')
@stop
@section('errors-message')
    @include('common.errors')
@stop

@section('susscess-message')
    @include('common.success')
@stop
@section('page-content')
  <div class="x_content">
    <form class="form-horizontal form-label-left" role="form" method="POST" action="{{ route('product.store') }}">
        {!! csrf_field() !!}
         <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">@lang('products.label_name_product') <span class="required">@lang('products.required_product')</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="2" data-validate-words="1" name="name" placeholder="@lang('products.label_name_product')" required="required" type="text" >
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="categories">@lang('products.label_categories_product')
              <span class="required">@lang('products.required_product')</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select class="form-control" name="category_id">
                  @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                  @endforeach
              </select>
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number"> @lang('products.label_price_product') <span class="required">@lang('products.required_product')</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="number" id="number" name="price" required="required" class="form-control col-md-7 col-xs-12" placeholder="@lang('products.label_price_product')">
            </div>
          </div>
          <div class="item form-group">
            <label for="descrition" class="control-label col-md-3 col-sm-3 col-xs-12">@lang('products.label_description_product')
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea id="description" type="text" name="description" class="form-control col-md-7 col-xs-12" placeholder="@lang('products.label_description_product')"></textarea>
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">
            @lang('products.label_is_on_sale_product') <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <label class="control-label"> @lang('products.option_sale_no_product'): </label>
              <input type="radio" name="is_on_sale" value="@lang('products.option_sale_n_product')"/>
              <label class="control-label">@lang('products.option_sale_yes_product'): </label>
              <input type="radio" name="is_on_sale" value="@lang('products.option_sale_y_product')"/>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4 col-sm-offset-4 col-xs-offset-3">
              <a class="btn btn-primary" href="{{ route('product.create') }}">@lang('products.btn_cancel')</a>
              <button id="send" type="submit" class="btn btn-success"> @lang('products.label_submit_add_product')</button>
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
    validator.message.min = errorMessages.min_6;
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
