@extends('layouts.app')
@section('page-title')
  @lang('categories.index.title')
@endsection

@section('section-title')
    @lang('categories.index.section-title')
@endsection

@section('page-content')
    <div class="x_content">
        <table class="table table-striped jambo_table table-bordered">
          <thead>
            <tr class="headings">
              <th class="column-title text-center" style="width: 5%">#</th>
              <th class="column-title text-center" style="width: 25%">@lang('categories.common.field_name')</th>
              <th class="column-title text-center" style="width: 30%">@lang('categories.common.field_description')</th>
              <th class="column-title text-center" style="width: 25%">@lang('categories.common.field_time')</th>
              <th class="column-title text-center" style="width: 15%">@lang('categories.common.field_options')</th>
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
                  <a id="category-{{ $category->id }}" class="btn btn-danger btn-xs" onclick="deleteCategory({{ $category->id }})"><i class="fa fa-trash" title="Delete"></i></a>
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
            <button type="button" class="btn btn-primary" onclick="confirmDelete()">@lang('categories.common.btn_delete')</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@push('end-page-scripts')
    <script type="text/javascript">
    var categoryId = 0;
    var token = '{{csrf_token()}}';
    $(function(){
    	$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': token
            }
    	});

        $('[data-toggle="tooltip"]').tooltip()
        window.deleteCategory = function (id) {
        	categoryId = id;
        	$('#delete-confirm').modal();
        }
        window.confirmDelete = function (){
        	var url = "{{ action('CategoryController@destroy') }}/" + categoryId;
        	$.post(url, {
        		_method : 'delete'
        	}, function (response) {
        		alert(response.message);
                if (response.success) {
                    $('#category-' + categoryId).closest('tr').find('td').fadeOut(1000, function(){
                        $(this).parents('tr:first').remove();
                    });
                }
        	}, "json");
    	    $('#delete-confirm').modal('hide');
        }
    });
    </script>
@endpush
