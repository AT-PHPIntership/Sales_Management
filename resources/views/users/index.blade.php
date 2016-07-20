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
        @if(!count($users))
            <div class="col-md-12 col-sm-12 col-xs-12">
                <h5>
                    @lang('users.index.message_no_account'), <a href="{{ route('user.create') }}">@lang('users.index.link_create_account')</a>
                </h5>
            </div>
        @else
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
                                        <a id='del' data-toggle="modal" data-target="#confirm-deleting" class="btn btn-danger btn-xs btn_delete" title="@lang('users.index.btn_remove_account')"><i class="fa fa-trash"></i></a>
                                        <input id="user_id" type="hidden" value="{{ $user->id }}">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
                {{ $users->links() }}
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 text-right">
        @endif
    </div>

    @if (count($users) > 0 )
    <!-- Modal Confirmation -->
      <div class="modal fade" id="confirm-deleting" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">@lang('users.delete.confirm_title')</h4>
            </div>
            <div class="modal-body">
              <h5>@lang('users.delete.confirm_msg')</h5>
            </div>
            <div class="modal-footer">
                <form action="{{ url('user/'.$user->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-danger">@lang('common.btn_delete')</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('common.btn_cancel')</button>
                </form>
            </div>
          </div>
        </div>
      </div>
    @endif
@stop

@push('end-page-scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click',".btn_delete", function() {
                var id = $(this).next().val();
                $('form').attr('action','user/'+id);
                $('#idDel').text(id);
            });
        });
    </script>
@endpush
