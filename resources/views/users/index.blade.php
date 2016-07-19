@extends('layouts.app')

@section('page-title')
    @lang('users.index.title')
@stop

@section('section-title')
    @lang('users.index.title')
@stop

@section('page-header-right')
    @include('common.searchbar')
@stop

@section('errors-message')
    @include('common.errors')
@stop

@section('susscess-message')
    @include('common.success')
@stop

@section('page-content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
        </div>
        <div class="clearfix"></div>
        @foreach ($users as $user)
            @if($user->role_id != \Config::get('common.SUPERADMIN_ROLE_ID'))
                <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                    <div class="well profile_view">
                        <div class="col-sm-12">
                            <h4 class="brief"><b><a href="{{ route('user.show', $user->id) }}">{{ $user->name }}</a></b></h4>
                            <div class="left col-xs-7">
                                <p><i class="fa fa-envelope"></i> @lang('users.index.label_email'): {{ $user->email }} </p>
                                <ul class="list-unstyled">
                                    <li><i class="fa fa-home"></i> @lang('users.index.label_address'): {{ $user->address }}</li>
                                    <li><i class="fa fa-phone"></i> @lang('users.index.label_phone'): {{ $user->phone_number }}</li>
                                </ul>
                            </div>
                            <div class="right col-xs-5 text-center">
                                <img src="{{ url('/file/avatar/' . Auth::user()->avatar) }}" alt="" class="img-circle img-responsive" title="{{ $user->name }}">
                            </div>
                        </div>
                        <div class="col-xs-12 bottom">
                            <div class="col-xs-4 col-sm-3 emphasis text-left">
                                @if ($user->role_id == \Config::get('common.SUPERADMIN_ROLE_ID'))
                                    <span class="label label-danger">{{ $user->role->name }}</span>
                                @elseif ($user->role_id == \Config::get('common.MANAGER_ROLE_ID'))
                                    <span class="label label-warning">{{ $user->role->name }}</span>
                                @else
                                    <span class="label label-success">{{ $user->role->name }}</span>
                                @endif
                            </div>
                            <div class="col-xs-12 col-sm-9 emphasis text-right">
                                <a href="{{ route('user.show', $user->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-user"> </i> @lang('users.index.btn_view_profile')</a>
                                @if((Auth::user()->role_id == \Config::get('common.MANAGER_ROLE_ID') || Auth::user()->role_id == \Config::get('common.SUPERADMIN_ROLE_ID')))
                                    <a href="#" class="btn btn-warning btn-xs" title="@lang('users.index.btn_edit_info')"><i class="fa fa-edit"></i></a>
                                @endif
                                @if((Auth::user()->role_id == \Config::get('common.SUPERADMIN_ROLE_ID')))
                                    <a href="#" class="btn btn-danger btn-xs" title="@lang('users.index.btn_remove_account')"><i class="fa fa-trash"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
        <div class="col-md-12 col-sm-12 col-xs-12 text-right">
            {{ $users->links() }}
        </div>
    </div>
@stop
@push('end-page-scripts')

@endpush
