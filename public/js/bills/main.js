var products;
var old_cost = 0;
var current_cost = 0;
var index = 1;
$(document).ready(function(){
  $.getJSON( url, function( data ) {
    products = data;
    setAutocomplete('#item' + index + ' .product', '#item' + index + ' .product_id', '#item' + index + ' .price');
    index++;
  });
});
$("#addItemBtn").click(function () {
  var product_id = '#item' + index + ' .product';
  var value_id = '#item' + index + ' .product_id';
  var price_id = '#item' + index + ' .price';
  var newItem = $('#item1').clone().attr('id', 'item' + index).appendTo('#items_container');
  $(newItem).find('input').val('');
  $(newItem).find('.amount').val('1');
  $(newItem).find('.btn_remove').removeAttr('disabled');
  setAutocomplete(product_id, value_id, price_id);
  index++;
});
$(document).on('click', '.btn_remove', function(){
  $(this).parent().parent().remove();  
});
$(document).on('keyup click', '.amount-box', function () {
  var item = $(this).parent().parent();
  var amount = $(item).find('.amount-box').val();
  var price = $(item).find('.price-box').val();
  current_cost = old_cost+Number(price)*(amount-1);
  $('#total_cost').val(current_cost);
  $('#cost_display').val($('#total_cost').val() + currency_label);
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
function setAutocomplete(product_id, value_id, price_id){
  $(product_id).autocomplete({
    source: $.map(products, function (value, index) {
      return {
        label: value.name + " - " + value.price + currency_label,
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
        current_cost = ui.item.price + Number($('#total_cost').val());
        $('#cost_display').val(current_cost + currency_label);
        $('#total_cost').val(current_cost);
        old_cost = Number($('#total_cost').val());
        return false;
    }
  });
}
