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

@section('errors-message')
    @include('common.errors')
@stop

@section('susscess-message')
    @include('common.success')
@stop

@section('page-content')

  <div class="row">
    <form action="{{ route('bill.store') }}" method="POST" class="form-horizontal form-label-left" novalidate>
      <div class="col-md-7 col-sm-7 col-xs-12">
        <div class="clearfix"></div>
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div id="items_container" class="row">
            <div class="row">
              <div class="col-md-4 col-sm-4 col-xs-12">
                <button type="button" name="add" id="addItemBtn" class="btn btn-success">@lang('bills.create.button_add_item_label')</button>
              </div>
            </div>
          </div>
      </div>
      <div class="col-md-5 col-sm-5 col-xs-12">
        <div class="row">
          <label for="user_id">@lang('bills.create.staff_name_label'): </label>
          <input type="text" class="form-control" required  value="{{ Auth::user()->name }}" disabled/>
        </div>
        <div class="row">
          <label for="total_cost">@lang('bills.create.total_cost_label'): </label>
          <input type="text" id='cost_display' name="total_cost" class="form-control" value="0$" required="required" disabled/>
          <input type="hidden" id='total_cost' name="total_cost" class="form-control" value="0" required="required"/>
        </div>
        <div class="row">
          <div class="form-group">
            <label for="description">@lang('bills.create.description_label'): </label>
            <textarea class="form-control" name="description"></textarea>
          </div>
        </div>
        <div class="row">
          <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-5 col-sm-offset-5 col-xs-offset-5">
              <button type="submit" class="btn btn-success">Submit</button>
            </div>
          </div>
        </div>
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
    var old_cost = 0;
    var index = 1;
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
          '<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">@lang('bills.create.product_label'): </label>'+
          '<div class="col-md-4 col-sm-4 col-xs-12">'+
            '<input type="text" required="required" id="product' + index + '" class="form-control col-md-7 col-xs-12" />'+
            '<input type="hidden" name="product_id[]" class="form-control col-md-7 col-xs-12" required="required" value="" id="product_id' + index + '"/>'+
            '<input type="hidden" name="price[]" class="form-control col-md-7 col-xs-12 price-box" id="price' + index + '"/>'+
          '</div>'+
          '<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">@lang('bills.create.amount_label'): </label>'+
          '<div class="col-md-2 col-sm-2 col-xs-12">'+
            '<input type="number" name="amount[]" min="1" id="amount' + index + '" value="1" class="form-control col-md-7 col-xs-12 amount-box">'+
          '</div>'+
          '<div class="col-md-2 col-sm-2 col-xs-12">'+
            '<button type="button" name="remove" id="'+ index +'" class="btn btn-danger btn_remove">X</button>'+
          '</div>'+
        '</div>'
      );
      newItemDiv.appendTo("#items_container");
      $(product_id).autocomplete({
        source: $.map(products, function (value, index) {
          return {
            label: value.name + " - " + value.price +"$",
            value: value.id,
            price: value.price              
          };
        }),
        messages: {
          noResults: '',
          results: function() {}
        },
        minLength: 0,
        select: function(event, ui) {
            $(product_id).val(ui.item.label);
            $(value_id).val(ui.item.value);
            $(price_id).val(ui.item.price);
            $('#cost_display').val(ui.item.price + Number($('#total_cost').val()) + '$');
            $('#total_cost').val(ui.item.price + Number($('#total_cost').val()));
            old_cost = Number($('#total_cost').val());
            return false;
        }
      });
      $(product_id).autocomplete( "close" );
      $(document).on('click', '.btn_remove', function(){  
           var selectedItem = $(this).attr("id");   
           $('#item'+selectedItem+'').remove();  
      });
      index++;
    });
    $(document).on('keyup click', '.amount-box', function () {
      var item = $(this).parent().parent().parent();
      var amount = $(item).find('.amount-box').val();
      var price = $(item).find('.price-box').val();
      $('#total_cost').val(old_cost+Number(price)*(amount-1));
      $('#cost_display').val($('#total_cost').val() + '$');
    });
  </script>
  
  <!-- check submit button -->
  <script type="text/javascript">
    $('form').submit(function(e) {
      e.preventDefault();
      if($('#total_cost').val()=='0') {
        alert("please! select at least one item");
        return false;
      }
      this.submit();
    });
  </script>
@endpush
