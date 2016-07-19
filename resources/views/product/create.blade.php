@extends('layouts/app')

@section('page-title')
  @lang('product.menu_products')
@stop

@section('section-title')
  @lang('product.item_add_product')
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
      {{ csrf_field() }}
      
         <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">@lang('product.label_name_product') <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="2" data-validate-words="1" name="name" placeholder="@lang('product.label_name_product')" required="required" type="text" >
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
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="is_on_sale">@lang('product.label_is_on_sale_product')
              <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select autofocus name="is_on_sale">
                <option value="0">no</option>
                <option value="1">yes</option>
              </select>
            </div>
          </div>

          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number"> @lang('product.label_price_product') <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="number" id="number" name="price" required="required" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">@lang('product.label_remaining_amount_product') <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="number" id="number" name="remaining_amount" required="required" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
            </div>
          </div>
          
          <div class="item form-group">
            <label for="descrition" class="control-label col-md-3 col-sm-3 col-xs-12">@lang('product.label_descrition_product')<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea id="descrition" type="text" name="descrition" data-validate-length-range="6,32" class="form-control col-md-7 col-xs-12" required="required" placeholder="Description"></textarea> 
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4 col-sm-offset-4 col-xs-offset-3">
              <a class="btn btn-primary" href="{{ route('product.create') }}">Cancel</a>
              <button id="send" type="submit" class="btn btn-success"> @lang('product.label_submit_add_product')</button>
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
    validator.message.email = errorMessages.invalid_email;
    validator.message.empty = errorMessages.field_required;
    validator.message.select = errorMessages.select_option;
    validator.message.complete = errorMessages.at_least_2_words;
    validator.message.password_repeat = errorMessages.passwords_not_match;

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
