@extends('layouts/app')

@section('page-title')
  Bill Detail
@stop

@section('section-title')
  {{ trans('page_titles.bill-detail-label') }}
@stop

@section('page-content')
  <div class="row">
    <div class="col-md-4 col-sm-4 col-xs-12">
      <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-6">
            Bill ID:
        </div>
        <div class="col-md-8 col-sm-8 col-xs-6">
            {{ $bill->id }}
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-6">
            Total Cost
        </div>
        <div class="col-md-8 col-sm-8 col-xs-6">
            {{ $bill->total_cost }}&#36;
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-6">
            Created Date
        </div>
        <div class="col-md-8 col-sm-8 col-xs-6">
            {{ $bill->created_at }}
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-6">
            Staff Name
        </div>
        <div class="col-md-8 col-sm-8 col-xs-6">
            {{ $bill->user->name }}
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-6">
            Description
        </div>
        <div class="col-md-8 col-sm-8 col-xs-6">
            {{ $bill->description }}
        </div>
      </div>
    </div>
    <div class="col-md-8 col-sm-8 col-xs-12">
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Product Name</th>
            <th>Amount</th>
            <th>Cost</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($bill->billsDetail as $bill_details)
            <tr>
              <td>{{ $bill_details->id }}</td>
              <td>{{ $bill_details->product->name }}</td>
              <td>{{ $bill_details->amount }}</td>
              <td>{{ $bill_details->cost }}&#36;</td>
            </tr>
          @endforeach
          <tr>
            <td></td>
            <td></td>
            <td align="right">Total:</td>
            <td>{{ $bill->billsDetail->sum('cost') }}&#36;</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
@stop
