$(document).ready(function() {
    var FADEOUT_DURATION  = 1000;

    var listCategoriesTable = $('#list-categories-table').DataTable({
        "columns": [
            {"width": "5%"},
            {"width": "15%"},
            {"width": "60%"},
            {"width": "15%"},
            {"width": "5%"}
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

    $('#list-categories-table').on('click', '.btn_delete', function() {
        var id = $(this).val();
        deleteCategory(id);
    });

    $('#confirm-delete').on('click', confirmDelete);
});
