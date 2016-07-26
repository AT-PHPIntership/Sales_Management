var products;
var index = 0;
var old_cost = 0;
var VALUE_ONE = 1;
var isExistingElement;
$(document).ready(function(){
  $.getJSON( url, function( data ) {
    products = data;
    setAutocomplete();
  });
});

function setAutocomplete(id){
  $('#text-input').autocomplete({
    source: $.map(products, function (value, index) {
      return {
        label: value.id +' - '+value.name + ' - ' + value.price + currency_label,
        id: value.id,
        price: value.price,
        amount: value.remaining_amount,
        index: index             
      };
    }),
    messages: {
      noResults: '',
      results: function() {}
    },
    minLength: 0,
    select: function(event, ui) {
        index++;
        var newRow = $('#itemRow0').clone().attr('id', 'itemRow' + index).appendTo('#items_container table');
        $('#text-input').val('');
        $('#amount-input').val(VALUE_ONE);
        $('#amount-input').attr('max', ui.item.amount);
        $('#total-cost').val(getCurrentCost() + ui.item.price);
        $('#print-cost').html(getCurrentCost() + currency_label);
        $('#total-cost-display').val(getCurrentCost() + currency_label);
        var itemRow = newRow.children();
        newRow.children().find('.index').html(index);
        newRow.children().find('.product-label').html(ui.item.label);
        newRow.find('.amount-input').val(VALUE_ONE);
        newRow.find('.product-input').val(ui.item.id);
        newRow.find('.price-input').val(ui.item.price);
        newRow.children().find('.amount-label').html(VALUE_ONE);
        newRow.children().find('.price-label').html(ui.item.price);
        products.splice(ui.item.index, VALUE_ONE);
        setAutocomplete();
        old_cost = getCurrentCost();
        return false;
    }
  });
}

$(document).on('keyup click', '#amount-input', function () {
  var item = $(this).parent().parent().parent();
  isExistingElement = item.next().find('#itemRow' + index).length && item.next().find('#itemRow1').length;
  if(isExistingElement) {
    // check if remaining amount >= number input
    if(getValueNumberInput($('#amount-input')) > getMaxNumberInPut($('#amount-input'))) 
      $(item).find('#amount-input').val(getMaxNumberInPut($('#amount-input')));
    // check if number input < min value or number input is not a number
    if(getValueNumberInput($('#amount-input')) < $('#amount-input').attr('min') || isNaN(getValueNumberInput($('#amount-input'))))
      $(item).find('#amount-input').val(VALUE_ONE);
    item.next().find('#itemRow' + index +' .amount-label').html($(item).find('#amount-input').val());
    item.next().find('#itemRow' + index +' .amount-input').val($(item).find('#amount-input').val());
    var added_cost = getPriceProduct( item.next().find('#itemRow' + index + ' .price-input')) 
                                    * (getAmountProduct( item.next().find('#itemRow' + index + ' .amount-label')) -VALUE_ONE);
    var current_cost = old_cost + added_cost;
    item.next().find('#itemRow' + index +' .price-label').html(added_cost +getPriceProduct( item.next().find('#itemRow' + index + ' .price-input')));
    $('#total-cost').val(current_cost);
    $('#total-cost-display').val(getCurrentCost() + currency_label);
    $('#print-cost').html(getCurrentCost() + currency_label);
  }
});

$(document).on('click', '.btn_remove', function(){
  var item = $(this).parent().parent();
  var removed_cost = getAmountProduct($(item).find('.amount-label')) * getPriceProduct($(item).find('.price-input'));
  var left_cost = getCurrentCost() - parseInt(removed_cost);
  $('#total-cost').val(left_cost);
  $('#total-cost-display').val($('#total-cost').val() + currency_label);
  $('#print-cost').html(getCurrentCost() + currency_label);
  $('#amount-input').val(VALUE_ONE);
  refreshIndex(parseInt(item.find('.index').html()));
  item.remove();
});

function getCurrentCost () {
  return parseInt($('#total-cost').val());
}

function getAmountProduct(id) {
  return parseInt(id.html());
}

function getPriceProduct (id) {
  return parseInt(id.val());
}

function getMaxNumberInPut (id) {
  return parseInt(id.attr('max'));
}

function getValueNumberInput (id) {
  return parseInt(id.val());
}

function refreshIndex (selected) {
  size = parseInt($('#items_container table tr').length) -2;
  for (i = selected-1; i < size; i++) {
    $('#itemRow' + (i+1) + ' .index').html(i);
    $('#itemRow' + (i+1)).attr('id', 'itemRow' + i);
  } 
  index = size -1;
}


$('form').submit(function(e) {
  e.preventDefault();
  if((getCurrentCost() || index) == 0) {
    $('#errorMessageModel').modal('show'); 
    return false;
  }
  this.submit();
});
