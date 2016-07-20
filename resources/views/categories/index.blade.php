@extends('layouts.app')
@section('page-title')
  @lang('categories.index.title')
@endsection

@section('section-title')
    @lang('categories.index.section-title')
@endsection

@section('errors-message')
    @include('common.errors')
@stop

@section('susscess-message')
    @include('common.success')
@stop

@section('page-content')
    <div class="x_content">
        <table id="list-categories-table" class="table table-striped jambo_table table-bordered">
          <thead>
            <tr class="headings">
              <th class="column-title text-center">@lang('categories.common.field_id')</th>
              <th class="column-title text-center">@lang('categories.common.field_name')</th>
              <th class="column-title text-center">@lang('categories.common.field_description')</th>
              <th class="column-title text-center">@lang('categories.common.field_time')</th>
              <th class="column-title text-center">@lang('categories.common.field_options')</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($categories as $category)
            <tr class="even pointer">
              <td class="text-center">{{ $category->id }}</td>
              <td>{{ $category->name }}</td>
              <td>{{ $category->description }}</td>
              <td class="text-center">{{ $category->created_at }}</td>
              <td class="text-center">
                  <a href="{!! action('CategoryController@edit', ['id' => $category->id]) !!}" class="btn btn-warning btn-xs"><i class="fa fa-edit" title="Edit"></i></a>
                  <button id="category-{{ $category->id }}" class="btn_delete btn btn-danger btn-xs" value="{{ $category->id }}"><i class="fa fa-trash" title="Delete"></i></button>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
    </div>

    <!-- Modal Dialogs -->
    <div class="modal fade" id="delete-confirm">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">@lang('categories.delete.confirm_title')</h4>
          </div>
          <div class="modal-body">
            <p>@lang('categories.delete.confirm_msg')</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">@lang('categories.common.btn_cancel')</button>
            <button id="confirm-delete" type="button" class="btn btn-primary">@lang('categories.common.btn_delete')</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@push('stylesheet')
    <!-- Datatables -->
    <link href="/bower_resources/gentelella/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="/bower_resources/gentelella/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="/bower_resources/gentelella/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="/bower_resources/gentelella/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="/bower_resources/gentelella/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
@endpush

@push('end-page-scripts')
    <script src="/bower_resources/gentelella/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
    var categoryData = {
        'categoryId' : 0,
        'token' : '{{csrf_token()}}',
        'url' : '{{ action('CategoryController@destroy') }}/'
    };
    </script>
    <script src="/js/categories/main.js"></script>
@endpush
