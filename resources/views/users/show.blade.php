@extends('layouts/app')

@section('page-title')
  @lang('users.option_staff')
@stop

@section('section-title')
  @lang('users.option_staff')
@stop

@section('page-content')
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_content">
          <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="profile_img">
              <!-- end of image cropping -->
              <div id="crop-avatar">
                <!-- Current avatar -->
                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#avatar-modal">
                  <img class="img-responsive avatar-view" src="/file/avatar/{{ $user->avatar }}" alt="Avatar" title="Change the avatar">
                </button>
                <!-- Cropping modal -->
                <div class="modal fade col-md-offset-2" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <form class="avatar-form" action="crop.php" enctype="multipart/form-data" method="post">
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
                              <label for="avatarInput">Local upload</label>
                              <input class="avatar-input" id="avatarInput" name="avatar_file" type="file">
                            </div>

                            <!-- Crop and preview -->
                            <div class="row">
                              <div class="col-md-9">
                                <div class="avatar-wrapper"><img src="" class="img-rounded my-avatar-preview"></div>
                              </div>
                              <div class="col-md-3">
                                <div class="avatar-preview preview-lg"><img src="" class="img-rounded my-avatar-preview"></div>
                                <div class="avatar-preview preview-md"><img src="" class="img-rounded my-avatar-preview"></div>
                                <div class="avatar-preview preview-sm"><img src="" class="img-rounded my-avatar-preview"></div>
                              </div>
                            </div>

                            <div class="row avatar-btns">
                              <div class="col-md-3 col-md-offset-4">
                                <button class="btn btn-primary btn-block avatar-save" type="submit">Done</button>
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
            <div class="center">
              <a href="{{ route('user.edit', [$user->id]) }}" class="btn btn-success" ><i class="fa fa-edit m-center-xs"></i> Edit Profile</a>  
            </div>
          </div>
          <div class="col-md-9 col-sm-9 col-xs-12 text-size-16">
            <div class="row margin-bottom-1">
              <div class="col-md-2">
                <i class="fa fa-map-marker user-profile-icon fa-lg"></i> @lang('users.label_address'):
              </div>
              <div class="col-md-10">
                {{ $user->address }}
              </div>
            </div>
            <div class="row margin-bottom-1">
              <div class="col-md-2">
                <i class="fa fa-mobile user-profile-icon fa-lg"></i> @lang('users.label_phone'):
              </div>
              <div class="col-md-10">
                {{ $user->phone_number }}
              </div>
            </div>
            <div class="row margin-bottom-1">
              <div class="col-md-2">
                <i class="fa fa-envelope-o user-profile-icon"></i> @lang('users.label_email'):
              </div>
              <div class="col-md-10">
                {{ $user->email }}
              </div>
            </div>
            <div class="row margin-bottom-1">
              <div class="col-md-2">
                <i class="fa fa-calendar user-profile-icon"></i> @lang('users.label_birthday'):
              </div>
              <div class="col-md-10">
                {{ $user->birthday }}
              </div>
            </div>
            <div class="row margin-bottom-1">
              <div class="col-md-2">
                <i class="fa fa-venus-double user-profile-icon"></i> @lang('users.label_gender'):
              </div>
              <div class="col-md-10">
                {{ $user->gender == 1 ? 'Male' : 'Female' }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop

@push('end-page-scripts')
  <script type="text/javascript">
  $('#avatarInput').change( function(event) {
    var tmppath = URL.createObjectURL(event.target.files[0]);
      $('.my-avatar-preview').fadeIn('fast').attr('src',URL.createObjectURL(event.target.files[0]));
    });
  </script>
@endpush
