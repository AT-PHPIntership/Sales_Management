@extends('layouts/app')

@section('page-title')
 @lang('common.menu_products')
@stop

@section('section-title')
 @lang('common.item_list_product')
@stop

@section('page-content')
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="clearfix"></div>
      <table id="list-products-table" class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>#</th>
            <th>@lang('common.label_name_product')</th>
            <th>@lang('common.label_name_category')</th>
            <th>@lang('common.label_description_product')</th>
            <th>@lang('common.label_price_product')</th>
            <th>@lang('common.label_remaining_amount_product')</th>
            <th>@lang('common.label_is_on_sale_product')</th>
            <th>@lang('common.label_option_product')</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($products as $product)
            <tr>
              <td>{{ $product->id }}</td>
              <td>{{ $product->name }}</td>
              <td>{{ $product->category->name }}</td>
              <td>{{ str_limit($product->description, Config::get('common.LIMIT_STRING_PRODUCT_DESCRIPTION')) }}</td>
              <td>{{ $product->price }}</td>
              <td>{{ $product->remaining_amount }}</td>
              <td>{{ $product->is_on_sale }}</td>
              <td>
                <a href="{{ route('product.show', [$product->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                <a class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                <a class="btn btn-danger btn-xs"><i class="fa fa-trash" aria-hidden="true"></i></a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@stop

@push('stylesheet')
  <link rel="stylesheet" href="/bower_resources/gentelella/vendors/datatables.net/css/jquery.dataTables.min.css" media="screen" title="no title" charset="utf-8">
@endpush

@push('end-page-scripts')
  <script type="text/javascript">
    $(document).ready(function(){
      $('#list-products-table').DataTable();
    });
  </script>
  <script src="/bower_resources/gentelella/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
@endpush