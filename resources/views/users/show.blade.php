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
              <!-- Current avatar -->
              <img class="img-responsive avatar-view" src="/file/avatar/{{ $user->avatar }}" alt="Avatar" title="user avatar">
            </div>
            <h3 class="center">{{ $user->name }}</h3>
            <div class="center">
              <a href="{{ route('user.edit', [$user->id]) }}" class="btn btn-success" ><i class="fa fa-edit m-center-xs"></i> @lang('users.show.edit_profile')</a>  
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
                @if ($user->gender == 1)
                  {{ trans('users.show.label_male') }}
                @else
                  {{ trans('users.show.label_female') }}
                @endif
              </div>
            </div>
            <div class="row margin-bottom-1">
              <div class="col-md-2">
                <i class="fa fa-gavel user-profile-icon"></i> @lang('users.show.label_role'):
              </div>
              <div class="col-md-10">
                @if ($user->role_id == \Config::get('common.SUPERADMIN_ROLE_ID'))
                    <span class="label label-danger">{{ $user->role->name }}</span>
                @elseif ($user->role_id == \Config::get('common.MANAGER_ROLE_ID'))
                    <span class="label label-warning">{{ $user->role->name }}</span>
                @else
                    <span class="label label-success">{{ $user->role->name }}</span>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop
