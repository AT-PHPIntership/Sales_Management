$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': userData.token
        }
    });

    var deleteUser = function (id) {
        userData.userId = id;
        $('#delete-confirm').modal();
    }

    var confirmDelete = function () {
        $.post(userData.url + userData.userId, {
            _method : 'DELETE'
        }, function (response) {
            alert(response.message);
        }, "json");
        $('#confirm-deleting').modal('hide');
    }

    $('button.btn_delete').on('click', function() {
        var id = $(this).val();
        deleteUser(id);
    });

    $('#confirm-delete').on('click', confirmDelete);
});
