@extends('layouts.app')
@section('page-title')
  @lang('categories.create.title')
@endsection

@section('section-title')
    @lang('categories.create.section-title')
@endsection

@section('errors-message')
    @include('common.errors')
@stop

@section('susscess-message')
    @include('common.success')
@stop

@section('page-content')
    <div class="x_content">
        <form class="form-horizontal form-label-left" role="form" method="POST" action="{{ action('CategoryController@store') }}">
            {{ csrf_field() }}
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">@lang('categories.common.label_name') <span class="required">*</span>
              </label>

              <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="name" type="text" name="name" data-validate-length-range="1,50" class="form-control col-md-7 col-xs-12" required="required">
              </div>
            </div>

            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">@lang('categories.common.label_description')</label>

              <div class="col-md-6 col-sm-6 col-xs-12">
                  <textarea id="description" name="description" rows="5" class="form-control col-md-7 col-xs-12"></textarea>
              </div>
            </div>

            <div class="ln_solid"></div>

            <div class="form-group">
              <div class="col-md-6 col-md-offset-3">
                <a href="{{ action('CategoryController@index') }}" class="btn btn-primary">@lang('categories.common.btn_cancel')</a>
                <button id="send" type="submit" class="btn btn-success">@lang('categories.common.btn_submit')</button>
              </div>
            </div>
        </form>
    </div>
@endsection

@push('end-page-scripts')
<script type="text/javascript">
    // Override validate message
    validator.message.empty = errorMessages.field_required;
</script>
<!-- validator -->
<script src="/bower_resources/gentelella/vendors/validator/validator.min.js"></script>
<script src="/js/categories/validator.js"></script>
@endpush
