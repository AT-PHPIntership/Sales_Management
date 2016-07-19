@extends('layouts/app')

@section('page-title')
  @lang('common.menu_sales')
@stop

@section('section-title')
  @lang('common.item_new_bill')
@stop

@push('stylesheet')
  <link rel="stylesheet" href="/bower_resources/jquery-ui/themes/smoothness/jquery-ui.min.css" type="text/css" media="all" />
  <link rel="stylesheet" href="/bower_resources/jScrollPane/style/jquery.jscrollpane.css" type="text/css" media="all" />
@endpush

@section('page-content')

  <div class="row">
    <form action="{{ route('bill.store') }}" method="POST" class="form-horizontal form-label-left">
      <div class="col-md-7 col-sm-7 col-xs-12">
        <div class="clearfix"></div>
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div id="items_container" class="row">
            <div class="col-md-2 col-sm-2 col-xs-12">
              <button type="button" name="add" id="addItemBtn" class="btn btn-success">@lang('bills.button_add_item_label')</button>
            </div>
          </div>
          <div class="row">
            <div class="col-md-1 col-md-offset-5">
              <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" /> 
            </div>
          </div>
      </div>
      <div class="col-md-5 col-sm-5 col-xs-12">
        <label for="user_id">@lang('bills.staff_name_label'): </label>
        <input type="text" class="form-control" required  value="{{ Auth::user()->name }}" disabled/>
        <input type="text" name="user_id" class="form-control" required="required"  value="{{ Auth::user()->id }}"/>
        <label for="total_cost">@lang('bills.total_cost_label'): </label>
        <input type="text" id='total_cost' name="total_cost" class="form-control" required  value="10" />
        <label for="description">@lang('bills.description_label'): </label>
        <textarea required="required" class="form-control" name="description">ac</textarea>
      </div>
    </form>
  </div>
  
@stop

@push('end-page-scripts')
  <script src="/bower_resources/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
  <script src="/bower_resources/flexcomplete/dist/jquery.flexcomplete.min.js"></script>
  <script src="/bower_resources/jquery-mousewheel/jquery.mousewheel.min.js" type="text/javascript"></script>
	<script src="/bower_resources/jScrollPane/script/jquery.jscrollpane.min.js" type="text/javascript"></script>
  <script type="text/javascript">
    var products;
    var total_cost = 0;
    var index = 1;
    var items = [];
    $.getJSON( "{{ url('api/product') }}", function( data ) {
      products = data;
    });
    $("#addItemBtn").click(function () {
      var product_id = '#product' + index;
      var value_id = '#product_id' + index;
      var price_id = '#price' + index;
      var newItemDiv = $(document.createElement('div')).attr("id", 'itemDiv' + index);
      newItemDiv.after().html(
        '<div class="form-group" id="item'+ index +'">'+
          '<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">@lang('bills.product_label'): </label>'+
          '<div class="col-md-4 col-sm-4 col-xs-12">'+
            '<input type="text" required="required" id="product' + index + '" class="form-control col-md-7 col-xs-12" />'+
            'id<input type="text" name="product_id[]" class="form-control col-md-7 col-xs-12" required="required" value="" id="product_id' + index + '"/>'+
            'price<input type="text" name="price[]" class="form-control col-md-7 col-xs-12 price-box" id="price' + index + '"/>'+
          '</div>'+
          '<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">@lang('bills.number_label'): </label>'+
          '<div class="col-md-2 col-sm-2 col-xs-12">'+
            '<input type="number" name="number[]" min="1" id="number' + index + '" value="1" class="form-control col-md-7 col-xs-12">'+
          '</div>'+
          '<div class="col-md-2 col-sm-2 col-xs-12">'+
            '<button type="button" name="remove" id="'+ index +'" class="btn btn-danger btn_remove">X</button>'+
          '</div>'+
        '</div>'
      );
      newItemDiv.appendTo("#items_container");
      $(product_id).autocomplete({
        source: function (request, response) {
           response($.map(products, function (value, key) {
                return {
                    label: value.name,
                    value: value.id,
                    price: value.price
                }
            })
          );
        },
        messages: {
          noResults: '',
          results: function() {}
        },
        minLength: 0,
        select: function(event, ui) {
            // items.push({ id: ui.item.value, name: ui.item.label, price: ui.item.price, number: 1});
            $(product_id).val(ui.item.label);
            $(value_id).val(ui.item.value);
            $(price_id).val(ui.item.price);
            // calcTotal({price: ui.item.price, number: ui.item.amount});
            $('#total_cost').val(ui.item.price);
            return false;
        }
      });
      $(document).on('change', '.amount-box', function () {
        var val = $(this).val();
      });
      $(product_id).autocomplete( "close" );
      $(document).on('click', '.btn_remove', function(){  
           var selectedItem = $(this).attr("id");   
           $('#item'+selectedItem+'').remove();  
      });
      index++;
    });
  </script>
@endpush
