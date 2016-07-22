@extends('layouts/app')

@section('page-title')
 @lang('common.menu_products')
@stop

@section('section-title')
 @lang('common.item_list_product')
@stop
@section('errors-message')
    @include('common.errors')
@stop

@section('susscess-message')
    @include('common.success')
@stop

@section('page-content')
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="clearfix"></div>
      <table id="list-products-table" class="table table-striped 
      jambo_table table-bordered">
        <thead>
          <tr>
            <th class="column-title text-center">#</th>
            <th class="column-title text-center">
            @lang('products.label_name_product')</th>
            <th class="column-title text-center">
            @lang('products.label_categories_product')</th>
            <th class="column-title text-center"> 
            @lang('products.label_description_product')</th>
            <th class="column-title text-center">
            @lang('products.label_price_product')</th>
            <th class="column-title text-center">
            @lang('products.label_remaining_amount_product')</th>
            <th class="column-title text-center">
            @lang('products.label_is_on_sale_product')</th>
            <th class="column-title text-center">
            @lang('products.label_date_product')</th>
            <th class="column-title text-center">
            @lang('products.label_option_product')</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($products as $product)
            <tr class="even pointer">
              <td class="text-center">{{ $product->id }}</td>
              <td class="text-left">{{ $product->name }}</td>
              <td class="text-left">{{ $product->category->name }}</td>
              <td class="text-left">{{ str_limit($product->description, Config::get('common.LIMIT_STRING_PRODUCT_DESCRIPTION')) }}</td>
              <td class="text-right">{{ $product->price }}</td>
              <td class="text-right">{{ $product->remaining_amount }}</td>
              <td class="text-center">{{ $product->is_on_sale ? \Config::get('common.IS_ON_SALE_YES') : \Config::get('common.IS_ON_SALE_NO') }}</td>
              <td class="text-center">{{ $product->created_at }}</td>
              <td class="text-center">
                <a href="{{ route('product.edit', [$product->id]) }}" title="@lang('products.title_edit_product')" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                 <a id='del' data-toggle="modal" data-target="#confirm-deleting" class="btn btn-danger btn-xs btn_delete" title="@lang('products.btn_remove_product')"><i class="fa fa-trash"></i></a>
                 <input id="product_id" type="hidden" value="{{ $product->id }}">
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    @if (count($products) > 0 )
    <!-- Modal Confirmation -->
      <div class="modal fade" id="confirm-deleting" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">@lang('products.delete.confirm_title')</h4>
            </div>
            <div class="modal-body">
              <h5>@lang('products.delete.confirm_msg')</h5>
            </div>
            <div class="modal-footer">
                <form action="{{ url('$product->id') }}" method="POST">
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
  </div>
@stop

@push('stylesheet')
    <!-- Datatables -->
    <link href="/bower_resources/gentelella/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="/bower_resources/gentelella/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="/bower_resources/gentelella/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="/bower_resources/gentelella/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="/bower_resources/gentelella/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <style media="screen">
        td {
            word-break: break-all;
        }
    </style>
@endpush

@push('end-page-scripts')
<script>
        $(document).ready(function() {
            $(document).on('click',".btn_delete", function() {
                var id = $(this).next().val();
                $('form').attr('action','product/'+id);
                $('#idDel').text(id);
            });
        });
    </script>

  <script type="text/javascript">
    $(document).ready(function(){
      $('#list-products-table').DataTable();
    });
  </script>
  <script src="/bower_resources/gentelella/vendors/datatables.net/js/jquery.dataTables.min.js"></script>


@endpush