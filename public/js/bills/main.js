var products;
var old_cost = 0;
var index = 1;
$.getJSON( url, function( data ) {
  products = data;
});
$("#addItemBtn").click(function () {
  var product_id = '#product' + index;
  var value_id = '#product_id' + index;
  var price_id = '#price' + index;
  var newItemDiv = $(document.createElement('div')).attr("id", 'itemDiv' + index);
  newItemDiv.after().html(
    '<div class="form-group" id="item'+ index +'">'+
      '<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">'+ product_label +': </label>'+
      '<div class="col-md-4 col-sm-4 col-xs-12">'+
        '<input type="text" required="required" id="product' + index + '" class="form-control col-md-7 col-xs-12" />'+
        '<input type="hidden" name="product_id[]" class="form-control col-md-7 col-xs-12" required="required" id="product_id' + index + '"/>'+
        '<input type="hidden" name="price[]" class="form-control col-md-7 col-xs-12 price-box" id="price' + index + '"/>'+
      '</div>'+
      '<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">'+ amount_label +': </label>'+
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

$('form').submit(function(e) {
  e.preventDefault();
  if($('#total_cost').val() == 0) {
    $('#errorMessageModel').modal('show'); 
    return false;
  }
  for (i = 0; i < (index-1); i++) { 
    if($('#product_id'+ (i+1)).val() == '') {
      $('#errorMessageModel').modal('show'); 
      return false;
    }
  }
  this.submit();
});
