var products;
var products_clone;
var index = size;
var old_cost = 0;
var VALUE_ONE = 1;
var isExistingElement;
$(document).ready(function(){
  $.getJSON( url, function( data ) {
    products = data;
    console.log(products);
    products_clone = products;
    for (var i = 0; i < size; i++) {
      $('#itemRow' + (i+1)).find('.product-input').attr('name', (i+1));
      $('#itemRow' + (i+1)).find('.amount-input').attr('name', (i+1));
      products = $.grep(products, function(e){ 
        return e.id != existing_id[i];
      });
      
    }
    setAutocomplete('#text-input');
  });
});

function setAutocomplete(id){
  $(id).autocomplete({
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
        var newRow = $('#itemRow'+size).clone().attr('id', 'itemRow' + index).appendTo('#items_container table');
        $('#text-input').val('');
        $('#amount-input').val(VALUE_ONE);
        $('#amount-input').attr('max', ui.item.amount);
        $('#total-cost').val(getCurrentCost() + ui.item.price);
        $('#print-cost').html(getCurrentCost() + currency_label);
        $('#total-cost-display').val(getCurrentCost() + currency_label);
        var itemRow = newRow.children();
        newRow.children().find('.index').html(index);
        newRow.children().find('.product-label').html(ui.item.label);
        newRow.find('.amount-input').attr('name', 'amount[]');
        newRow.find('.product-input').attr('name', 'product_id[]');
        newRow.find('.amount-input').val(VALUE_ONE);
        newRow.find('.product-input').val(ui.item.id);
        newRow.find('.product-input').removeAttr('disabled');
        newRow.find('.btn_remove').removeAttr('disabled');
        newRow.find('.price-input').val(ui.item.price);
        newRow.children().find('.amount-label').html(VALUE_ONE);
        newRow.children().find('.price-label').html(ui.item.price);
        products.splice(ui.item.index, VALUE_ONE);
        setAutocomplete('#text-input');
        old_cost = getCurrentCost();
        $('.table-container').scrollTop($('.table-container').scrollTop() + $('.table-container').height());
        return false;
    }
  });
}

$(document).on('keyup click', '#amount-input', function () {
  var item = $(this).parent().parent().parent();
  // check if has new item
  if(index > size) {
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
  if(parseInt(item.find('.index').html()) > size) {
    var removed_cost = getAmountProduct($(item).find('.amount-label')) * getPriceProduct($(item).find('.price-input'));
    var left_cost = getCurrentCost() - parseInt(removed_cost);
    $('#total-cost').val(left_cost);
    $('#total-cost-display').val($('#total-cost').val() + currency_label);
    $('#print-cost').html(getCurrentCost() + currency_label);
    $('#amount-input').val(VALUE_ONE);
    refreshIndex(parseInt(item.find('.index').html()));
    products.push(products_clone.find(function (product) {
      return product.id == item.find('.product-input').val();
    }));
    setAutocomplete('#text-input');
    item.remove();
  }
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
  length = parseInt($('#items_container table tbody tr').length);
  for (i = selected-1; i < length; i++) {
    $('#itemRow' + (i+1) + ' .index').html(i);
    $('#itemRow' + (i+1)).attr('id', 'itemRow' + i);
  } 
  index = length -1
}

$('form').submit(function(e) {
  e.preventDefault();
  if((getCurrentCost() || index) == 0) {
    $('#errorMessageModel').modal('show'); 
    return false;
  }
  this.submit();
});
