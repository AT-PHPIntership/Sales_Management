var products;
var index = 1;
var product_id = '#item' + index + ' .product';
var value_id = '#item' + index + ' .product_id';

$(document).ready(function() {
    $.getJSON(url, function(data) {
        products = data;
        setAutocomplete(product_id, value_id);
        index++;
    });
});

$("#addItemBtn").click(function() {
    var product_id = '#item' + index + ' .product';
    var value_id = '#item' + index + ' .product_id';
    var newItem = $('#item1').clone().attr('id', 'item' + index).appendTo('#items_container');
    $(newItem).find('input').val('');
    $(newItem).find('.amount').val('1');
    $(newItem).find('.btn_remove').removeAttr('disabled');
    setAutocomplete(product_id, value_id);
    index++;
});
$(document).on('click', '.btn_remove', function() {
    var item = $(this).parent().parent();
    item.remove();
});


$('form').submit(function(e) {
    e.preventDefault();
    for (i = 0; i < (index - 1); i++) {
        if ($('#item' + (i + 1) + ' .product').val() == '') {
            $('#item' + (i + 1)).remove();
        }
    }
    this.submit();
});

var setAutocomplete = function(product_id, value_id) {
    $(product_id).autocomplete({
        source: $.map(products, function(value, index) {
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
            return false;
        }
    });
}
