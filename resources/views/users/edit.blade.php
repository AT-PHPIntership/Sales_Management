@extends('layouts/app')

@section('page-title')
  @lang('users.edit.title_page')
@stop

@section('section-title')
  <a href="{{ url()->previous() }}"><i class="fa fa-arrow-circle-left fa-2x"></i></a>
  <span style="vertical-align: super;">&nbsp;@lang('users.edit.label_page', ['id' => $user->id])</span>
@stop

@section('susscess-message')
  @include('common.success')
@stop

@section('errors-message')
  @include('common.errors')
@stop

@push('stylesheet')
  <link rel="stylesheet" href="/bower_resources/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.css" media="screen" title="no title" charset="utf-8">
@endpush

@section('page-content')
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_content">
        <div class="col-md-3 col-sm-3 col-xs-12 profile_left my-text-align padding-top-5">
          <div class="profile_img">
            <!-- end of image cropping -->
            <div id="crop-avatar" class="pdf-thumb-box">
              <!-- Current avatar -->
              <a data-toggle="modal" data-target="#avatar-modal">
                <div class="pdf-thumb-box-overlay">
                  <span class="fa-stack fa-lg">
                    <i class="fa fa-camera"></i>
                  </span>
                </div>
                <img class="img-responsive avatar-view" src="/file/avatar/{{ $user->avatar }}" alt="Avatar" title="Change the avatar">
              </a>
              <!-- Cropping modal -->
              <div class="modal fade col-md-offset-2" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <form class="avatar-form" action="{{ route('user.updateAvatar', [$user->id]) }}" enctype="multipart/form-data" method="post">
                      <input type="hidden" name="_method" value="PUT">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <div class="modal-header">
                        <button class="close" data-dismiss="modal" type="button">&times;</button>
                        <h4 class="modal-title" id="avatar-modal-label"> @lang('users.label_change_avatar') </h4>
                      </div>
                      <div class="modal-body">
                        <div class="avatar-body">

                          <!-- Upload image and data -->
                          <div class="avatar-upload">
                            <input class="avatar-src" name="avatar_src" type="hidden">
                            <input class="avatar-data" name="avatar_data" type="hidden">
                            <label for="avatarInput"> @lang('users.edit.label_input_file') </label>
                            <input class="avatar-input" id="avatarInput" name="image" type="file" required="required">
                          </div>

                          <!-- Crop and preview -->
                          <div class="row">
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <div class="avatar-preview avatar-wrapper">
                                <img class="img-responsive my-avatar-preview" src="">
                              </div>
                            </div>
                            <div class="col-md-3 col-sm-5 col-xs-12">
                              <div class="avatar-preview preview-lg"><img class="img-responsive avatar-view my-avatar-preview" src=""></div>
                              <div class="avatar-preview preview-md"><img class="img-responsive avatar-view my-avatar-preview" src=""></div>
                              <div class="avatar-preview preview-sm"><img class="img-responsive avatar-view my-avatar-preview" src=""></div>
                            </div>
                          </div>

                          <div class="row avatar-btns">
                            <div class="col-md-3 col-sm-3 col-xs-12 col-md-offset-3 col-sm-offset-3">
                              <button class="btn btn-primary btn-block avatar-save" type="submit"> @lang('users.edit.btn_save_avatar') </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- /.modal -->
              <!-- Loading state -->
              <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
            </div>
            <!-- end of image cropping -->
          </div>
        <h3 class="center">{{ $user->name }}</h3>
        </div>
        
        
        <div class="col-md-9 col-sm-9 col-xs-12">
          <form action="{{ route('user.update', [$user->id]) }}" novalidate data-parsley-validate class="form-horizontal form-label-left form-validate" method="POST">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            
            <!-- start profile -->
            <div class="x_title">
              <h2><i class="fa fa-user"></i> @lang('users.edit.label_profile') </h2>
              <div class="clearfix"></div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">
                @lang('users.label_name') <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="name" required="required" placeholder="@lang('users.eg_name')" data-validate-length-range="2" 
                  data-validate-words="2" class="form-control col-md-7 col-xs-12" value="{{ old('name') == null ? $user->name : old('name') }}">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">
                @lang('users.label_phone') <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="tel" name="phone_number" required="required" data-validate-length-range="6,20" 
                  class="form-control col-md-7 col-xs-12" value="{{ old('phone_number') == null ? $user->phone_number : old('phone_number') }}">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">
                @lang('users.label_account_permission') <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" name="role_id" class="form-control col-md-7 col-xs-12">
                  <option value="{{ \Config::get('common.MANAGER_ROLE_ID') }}"> @lang('users.option_manager') </option>
                  <option value="{{ \Config::get('common.STAFF_ROLE_ID') }}"> @lang('users.option_staff') </option>
                </select>
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">
                @lang('users.label_address') <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input class="form-control col-md-7 col-xs-12" type="text" name="address" data-validate-length-range="2" required="required" 
                  value="{{ old('address') == null ? $user->address : old('address') }}">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">
                @lang('users.label_gender') <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <label class="control-label"> @lang('users.edit.label_male'): </label>
                <input type="radio" name="gender" value="{{ \Config::get('common.MALE_GENDER') }}" {{ $user->gender == \Config::get('common.MALE_GENDER') ? 'checked':''}} />
                <label class="control-label">@lang('users.edit.label_female'): </label>
                <input type="radio" name="gender" value="{{ \Config::get('common.FEMALE_GENDER') }}" {{ $user->gender == \Config::get('common.FEMALE_GENDER') ? 'checked':''}} />
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">
                @lang('users.label_birthday') <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input name="birthday" id="birthday" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text"
                  value="{{ $user->birthday->format('d/m/Y') }}">
              </div>
            </div>
            <!-- end profile -->
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4 col-sm-offset-4 col-xs-offset-3">
                <a href="{{ route('user.edit', [$user->id]) }}" class="btn btn-primary"><i class="fa fa-refresh"></i> @lang('common.btn_reset') </a>
                <button type="submit" class="btn btn-success"><i class="fa fa-gavel"></i> @lang('common.btn_submit') </button>
              </div>
            </div>
          </form>
          <form action="{{ route('user.updateAccount', [$user->id]) }}" novalidate data-parsley-validate class="form-horizontal form-label-left form-validate" method="POST">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <!-- start account -->
            <div class="x_title">
              <h2><i class="fa fa-cogs"></i> @lang('users.edit.label_account') </h2>
              <div class="clearfix"></div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">
                @lang('users.label_email') <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="email" name="email" required="required" class="form-control col-md-7 col-xs-12" value="{{ $user->email }}">
              </div>
            </div>
            <div class="item form-group">
              <label for="current_password" class="control-label col-md-3 col-sm-3 col-xs-12">@lang('users.label_current_password') 
                <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="current_password" type="password" name="current_password" data-validate-length-range="6,32" 
                  class="form-control col-md-7 col-xs-12" required="required" placeholder="{{ trans('users.edit.place_holder_current_password') }}"/>
              </div>
            </div>
            <div class="item form-group">
              <label for="password" class="control-label col-md-3 col-sm-3 col-xs-12">@lang('users.label_new_password') 
                <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="password" type="password" name="password" data-validate-length-range="6,32" 
                  class="form-control col-md-7 col-xs-12" required="required" placeholder="{{ trans('users.edit.place_holder_new_password') }}"/>
              </div>
            </div>
            <div class="item form-group">
              <label for="password_confirmation" class="control-label col-md-3 col-sm-3 col-xs-12">@lang('users.label_password_confirm') 
                <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="password_confirmation" type="password" name="password_confirmation" data-validate-linked="password" 
                  class="form-control col-md-7 col-xs-12" required="required" placeholder="{{ trans('users.edit.place_holder_renew_password') }}"/>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4 col-sm-offset-4 col-xs-offset-3">
                <a href="{{ route('user.edit', [$user->id]) }}" class="btn btn-primary"><i class="fa fa-refresh"></i> @lang('common.btn_reset') </a>
                <button type="submit" class="btn btn-success"><i class="fa fa-gavel"></i> @lang('common.btn_submit') </button>
              </div>
            </div>
            <!-- end account -->
          </form>
        </div>
      </div>
    </div>
  </div>
@stop

@push('end-page-scripts')
<!-- /validator -->
  <script src="/bower_resources/gentelella/vendors/validator/validator.min.js"></script>
  <script src="/bower_resources/gentelella/vendors/iCheck/icheck.min.js" charset="utf-8"></script>
  <script src="/bower_resources/moment/moment.js" charset="utf-8"></script>
  <script src="/bower_resources/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.js" charset="utf-8"></script>
  <script type="text/javascript">
    var errorMessages = {!! json_encode(trans('errors')) !!};
  </script>
  <script src="/js/users/edit.js" charset="utf-8"></script>
  <script src="/js/common/validator.js" charset="utf-8"></script>
@endpush
