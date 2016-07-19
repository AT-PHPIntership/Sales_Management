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
            <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                <div class="well profile_view">
                    <div class="col-sm-12">
                        <h4 class="brief"><b>{{ $user->name }}</b></h4>
                        <div class="left col-xs-7">
                            <p><strong>Email: </strong> {{ $user->email }} </p>
                            <ul class="list-unstyled">
                                <li><i class="fa fa-building"></i> Address: {{ $user->address }}</li>
                                <li><i class="fa fa-phone"></i> Phone: {{ $user->phone_number }}</li>
                            </ul>
                        </div>
                        <div class="right col-xs-5 text-center">
                            <img src="{{ url('/file/avatar/' . Auth::user()->avatar) }}" alt="" class="img-circle img-responsive">
                        </div>
                    </div>
                    <div class="col-xs-12 bottom">
                        <div class="col-xs-12 col-sm-6 emphasis text-left">
                            @if ($user->role_id == 1)
                                <span class="label label-danger">{{ $user->role->name }}</span>
                            @elseif ($user->role_id == 2)
                                <span class="label label-warning">{{ $user->role->name }}</span>
                            @else
                                <span class="label label-success">{{ $user->role->name }}</span>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-6 emphasis text-right">
                            <a href="{{ url('/user') }}/{{ $user->id }}" class="btn btn-primary btn-xs">
                                <i class="fa fa-user"> </i> View Profile
                            </a>
                            <a href="#" class="btn btn-danger btn-xs" title="Remove this account"><i class="fa fa-trash"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="col-md-12 col-sm-12 col-xs-12 text-right">
            {{ $users->links() }}
        </div>
    </div>
@stop
@push('end-page-scripts')

@endpush
