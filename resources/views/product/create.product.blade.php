@extends('layouts/app')

@section('page-title')
  Products
@stop

@section('section-title')
  Products Management
@stop


@section('page-content')
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="clearfix"></div>
        <form class="form-horizontal form-row-seperated" action="{{action('ProductController@store') }}"
      method="Post">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">
              <label for="exampleInputEmail1">Name product</label>
              <input type="text" class="form-control" placeholder="Name product" name="name">
          </div>
        
           <div class="form-group">
              <label for="exampleInputdescriptionpt">Description:</label>
              <input type="text" class="form-control" placeholder=" Description" name="description">
          </div>

           <div class="form-group">
              <label for="exampleInputprice">price:</label>
              <input type="text" class="form-control" placeholder=" price" name="price">
          </div>
           <div class="form-group">
              <label for="exampleInputremaining_amount">remaining_amount:</label>
              <input type="text" class="form-control" placeholder=" remaining_amount" name="remaining_amount">
          </div>
           <div class="form-group">
              <label for="exampleInputis_on_sale">is_on_sale:</label>
              <input type="text" class="form-control" placeholder=" is_on_sale" name="is_on_sale" value="0">
          </div>
           <div class="form-group">
              <label for="exampleInputcategory">Choice category:</label>
              <select name="" class="form-control">
                  @foreach($categories as $category)
                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                  @endforeach
              </select>
            </div>
  

          <button type="submit" class="btn btn-default">Submit</button>
      </form>
    </div>
  </div>
@stop

@push('end-page-scripts')
  <script type="text/javascript">
    $(document).ready(function(){
      $('#datatable-buttons').DataTable();
    });
  </script>
  <link rel="stylesheet" href="/bower_resources/gentelella/vendors/datatables.net/css/jquery.dataTables.min.css" media="screen" title="no title" charset="utf-8">
  <script src="/bower_resources/gentelella/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
@endpush
