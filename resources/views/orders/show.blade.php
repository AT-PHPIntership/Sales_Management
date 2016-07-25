@extends('layouts.app')
@section('page-title')
    @lang('orders.show.title', ['id' => $order->id])
@stop

@section('stylesheet')
    <link rel="stylesheet" href="/css/custom.css">
@stop

@Section('section-title')
    <a href="{{ url()->previous() }}"><i class="fa fa-arrow-circle-left fa-2x"></i></a>
    <span style="vertical-align: super;">&nbsp;@lang('orders.show.section-title', ['id' => $order->id])</span>
@stop

@section('errors-message')
    @include('common.errors')
@stop

@section('susscess-message')
    @include('common.success')
@stop

@section('page-content')
    <div class="x_content">
        <div id="print-order" class="row">
          <div class="col-sm-4 col-xs-12">
              <h2>@lang('orders.show.information_title')</h2>
              <table class="table table-borderless">
                <tbody>
                  <tr>
                    <td class="col-xs-4">@lang('orders.common.label_order_id')</td>
                    <td>{{ $order->id }}</td>
                  </tr>
                  <tr>
                    <td>@lang('orders.common.label_staff_id')</td>
                    <td>{{ $order->user_id }}</td>
                  </tr>
                  <tr>
                    <td>@lang('orders.common.label_staff')</td>
                    <td>{{ $order->user->name }}</td>
                  </tr>
                  <tr>
                    <td>@lang('orders.common.label_supplier')</td>
                    <td>{{ $order->supplier->name }}</td>
                  </tr>
                  <tr>
                    <td>@lang('orders.common.label_date')</td>
                    <td>{{ $order->created_at }}</td>
                  </tr>
                  <tr>
                    <td>@lang('orders.common.label_total_cost')</td>
                    <td>{{ $order->total_cost }}</td>
                  </tr>
                </tbody>
              </table>
              <button type="button" id="btn-print"><i class="fa fa-print" aria-hidden="true"></i> @lang('common.btn_print')</button>
          </div>
          <div class="col-sm-8 col-xs-12">
              <h2>@lang('orders.show.items_title')</h2>
              <table class="table table-striped">
                  <thead>
                      <tr>
                          <th class="width-10">@lang('orders.common.field_id')</th>
                          <th class="width-20">@lang('orders.common.field_product_id')</th>
                          <th class="width-50">@lang('orders.common.field_product')</th>
                          <th class="text-right width-20">@lang('orders.common.field_amount')</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($orderDetails as $index => $orderDetail)
                      <tr>
                          <th>{{ ++$index }}</th>
                          <td>{{ $orderDetail->product_id }}</td>
                          <td>{{ $orderDetail->product->name }}</td>
                          <td class="text-right">{{ $orderDetail->amount }}</td>
                      </tr>
                      @endforeach
                      <tr>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td class="text-right">
                              <b>@lang('orders.common.label_total') {{ $orderDetails->sum('amount') }}</b>
                          </td>
                      </tr>
                  </tbody>
              </table>
          </div>
        </div>
    </div>
@stop

@push('end-page-scripts')
    <script src="/js/printThis.js"></script>
    <script type="text/javascript">
        $('#btn-print').on('click', function() {
            $('#print-order').printThis({
                importCSS: false,
                loadCSS: "/css/printThis.css",
                header: "Order #{{ $order->id }} Details"
            });
        });
    </script>
@endpush
