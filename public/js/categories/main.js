$(document).ready(function() {
    var FADEOUT_DURATION  = 1000;

    $('#list-categories-table').DataTable({
        "columns": [
            {"width": "5%"},
            {"width": "25%"},
            {"width": "30%"},
            {"width": "25%"},
            {"width": "15%"}
        ]
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': categoryData.token
        }
    });

    var deleteCategory = function (id) {
        categoryData.categoryId = id;
        $('#delete-confirm').modal();
    }

    var confirmDelete = function () {
        $.post(categoryData.url + categoryData.categoryId, {
            _method : 'delete'
        }, function (response) {
            alert(response.message);
            if (response.success) {
                $('#category-' + categoryData.categoryId).closest('tr').find('td').fadeOut(FADEOUT_DURATION, function(){
                    $(this).parents('tr:first').remove();
                });
            }
        }, "json");
        $('#delete-confirm').modal('hide');
    }

    $('button.btn_delete').on('click', function() {
        var id = $(this).val();
        deleteCategory(id);
    });

    $('#confirm-delete').on('click', confirmDelete);
});
