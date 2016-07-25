@extends('layouts.app')

@section('page-title')
  @lang('bills.show.title', ['id' => $bill->id])
@stop

@section('stylesheet')
  <link rel="stylesheet" href="/css/custom.css">
@stop

@Section('section-title')
  <a href="{{ url()->previous() }}"><i class="fa fa-arrow-circle-left fa-2x"></i></a>
  <span style="vertical-align: super;">&nbsp;@lang('bills.show.section-title', ['id' => $bill->id])</span>
@stop

@section('errors-message')
    @include('common.errors')
@stop

@section('susscess-message')
    @include('common.success')
@stop

@section('page-content')
    <div class="x_content">
        <div id="print-bill" class="row">
          <div class="col-sm-4 col-xs-12">
              <h2>@lang('bills.show.information_title')</h2>
              <table class="table table-borderless">
                <tbody>
                  <tr>
                    <td class="col-xs-4"> @lang('bills.common.label_bill_id')</td>
                    <td> {{ $bill->id }}</td>
                  </tr>
                  <tr>
                    <td> @lang('bills.common.label_staff_id')</td>
                    <td> {{ $bill->user_id }}</td>
                  </tr>
                  <tr>
                    <td> @lang('bills.common.label_staff')</td>
                    <td> {{ $bill->user->name }}</td>
                  </tr>
                  <tr>
                    <td> @lang('bills.common.label_date')</td>
                    <td>{{ $bill->created_at }}</td>
                  </tr>
                  <tr>
                    <td> @lang('bills.common.label_total_cost')</td>
                    <td> @lang('common.usa_currency_label'){{ $bill->total_cost }}</td>
                  </tr>
                </tbody>
              </table>
              <button type="button" class="btn btn-info" id="btn-print"><i class="fa fa-print" aria-hidden="true"></i> @lang('common.btn_print')</button>
          </div>
          <div class="col-sm-8 col-xs-12">
            <h2>@lang('bills.show.items_title')</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="width-10">@lang('bills.common.field_id')</th>
                        <th class="width-20">@lang('bills.common.field_product_id')</th>
                        <th class="width-50">@lang('bills.common.field_product')</th>
                        <th class="text-right width-20">@lang('bills.common.field_amount')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($billDetails as $index => $billDetail)
                    <tr>
                        <th>{{ ++$index }}</th>
                        <td>{{ $billDetail->product_id }}</td>
                        <td>{{ $billDetail->product->name }}</td>
                        <td class="text-right">{{ $billDetail->amount }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-right">
                            <b>@lang('bills.common.label_total') {{ $billDetails->sum('amount') }}</b>
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
            $('#print-bill').printThis({
                importCSS: false,
                loadCSS: "/css/printThis.css",
                header: "bill #{{ $bill->id }} Details"
            });
        });
    </script>
@endpush
