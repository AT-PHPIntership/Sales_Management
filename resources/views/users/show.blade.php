@extends('layouts/app')

@section('page-title')
  @lang('users.option_staff')
@stop

@section('section-title')
  {{ $user->name }}
@stop

@section('page-content')
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
              <h2><i class="fa fa-user"></i> @lang('users.show.label_public_profile')</h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                  <div class="col-xs-6 col-sm-3 col-md-3 ">
                      <img class="img-responsive avatar-view" src="/file/avatar/{{ $user->avatar }}" alt="Avatar" title="{{ $user->name }}">
                  </div>
                  <div class="col-xs-12 col-sm-9 col-md-9 text-size-16">
                      <div class="row margin-bottom-1">
                        <div class="col-md-3">
                          <i class="fa fa-map-marker user-profile-icon fa-lg"></i> @lang('users.label_address'):
                        </div>
                        <div class="col-md-9">
                          {{ $user->address }}
                        </div>
                      </div>
                      <div class="row margin-bottom-1">
                        <div class="col-md-3">
                          <i class="fa fa-mobile user-profile-icon fa-lg"></i> @lang('users.label_phone'):
                        </div>
                        <div class="col-md-9">
                          {{ $user->phone_number }}
                        </div>
                      </div>
                      <div class="row margin-bottom-1">
                        <div class="col-md-3">
                          <i class="fa fa-envelope-o user-profile-icon"></i> @lang('users.label_email'):
                        </div>
                        <div class="col-md-9">
                          {{ $user->email }}
                        </div>
                      </div>
                      <div class="row margin-bottom-1">
                        <div class="col-md-3">
                          <i class="fa fa-calendar user-profile-icon"></i> @lang('users.label_birthday'):
                        </div>
                        <div class="col-md-9">
                          {{ $user->birthday }}
                        </div>
                      </div>
                      <div class="row margin-bottom-1">
                        <div class="col-md-3">
                          <i class="fa fa-venus-double user-profile-icon"></i> @lang('users.label_gender'):
                        </div>
                        <div class="col-md-9">
                          @if ($user->gender == \Config::get('common.MALE_GENDER'))
                            {{ trans('users.show.label_male') }}
                          @else
                            {{ trans('users.show.label_female') }}
                          @endif
                        </div>
                      </div>
                      <div class="row margin-bottom-1">
                        <div class="col-md-3">
                          <i class="fa fa-gavel user-profile-icon"></i> @lang('users.show.label_role'):
                        </div>
                        <div class="col-md-9">
                          @if ($user->role_id == \Config::get('common.SUPERADMIN_ROLE_ID'))
                              <span class="label label-danger">{{ $user->role->name }}</span>
                          @elseif ($user->role_id == \Config::get('common.MANAGER_ROLE_ID'))
                              <span class="label label-warning">{{ $user->role->name }}</span>
                          @else
                              <span class="label label-success">{{ $user->role->name }}</span>
                          @endif
                        </div>
                      </div>
                      <div class="row margin-top-2">
                          <div class="col-md-3">
                          </div>
                          <div class="col-md-9 col-sm-12 col-xs-12">
                              <a href="{{ route('user.edit', [$user->id]) }}" class="btn btn-primary btn-sm" title="@lang('users.show.title_update_info')"><i class="fa fa-cogs"></i> Update</a>
                          </div>
                      </div>
                  </div>
                </div>
            </div>
        </div>

        <div class="x_panel">
          <div class="x_title">
            <h2><i class="fa fa-file-text-o"></i> @lang('users.show.label_all_bills') {{ $user->name }}</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="clearfix"></div>
                  @if(!count($bills))
                      <div class="col-md-12 col-sm-12 col-xs-12">
                          <h5>
                              @lang('users.index.message_no_account'), <a href="{{ route('user.create') }}">@lang('users.index.link_create_account')</a>
                          </h5>
                      </div>
                  @else
                      <table id="list-bills-table" class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th class="text-center">@lang('users.show.label_id')</th>
                            <th class="text-center">@lang('common.field_name_bill')</th>
                            <th class="text-center">@lang('common.field_description_bill')</th>
                            <th class="text-center">@lang('common.field_cost_bill')</th>
                            <th class="text-center">@lang('common.field_time_bill')</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($bills as $bill)
                            <tr>
                              <td>{{ $bill->id }}</td>
                              <td>{{ $bill->user->name }}</td>
                              <td>{{ str_limit($bill->description, \Config::get('common.LIMIT_STRING_DESCRIPTION_75')) }}</td>
                              <td class="text-right">{{ $bill->total_cost }}</td>
                              <td class="text-right">{{ $bill->created_at }}</td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                  <div class="col-md-12 col-sm-12 col-xs-12 text-right">
                      {{ $bills->links() }}
                  </div>
                @endif
                </div>
              </div>
          </div>
        </div>

        <div class="x_panel">
          <div class="x_title">
            <h2><i class="fa fa-file-text-o"></i> @lang('users.show.label_all_orders') {{ $user->name }} </h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

          </div>
        </div>
    </div>
  </div>
@stop

@push('stylesheet')
    <link rel="stylesheet" href="/css/custom.css">
@endpush
