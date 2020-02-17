$(document).ready(function() {

    getUsers();

    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    });

    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    $("#form_create").submit(function(e) {
        e.preventDefault();
        var file = document.getElementById('customFile').files[0];
        if (!file) {
            swal('Atención', 'Agrega una imagen', 'info');
            return false;
        }
        getBase64(file, $(this));
    });

    $("#form_update").submit(function(e) {
        e.preventDefault();
        updateUser($(this));
    });

    $('#data_table tbody').on('click', 'a.btn-danger', function() {
        var row = $(this);
        deleteUser(row.attr('id'), row);
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': token
        }
    });

});

function getUsers() {
    var options = {
        method: 'GET',
        headers: { "Content-Type": "application/json" }
    };
    fetch('/users/getUsers', options)
        .then(function(response) {
            return response.json();
        })
        .then(function(response) {
            fillTable(response.users);
        }).catch(function(error) {
            console.log('Hubo un problema con la petición Fetch:' + error.message);
            swal('Ups', 'Ha ocurrio un error al obtener los datos del usuario.', 'error');
        });

}

function fillTable(users) {
    window.table = $('#data_table').DataTable({
        data: users,
        columns: [
            { data: 'id' },
            { data: "preview" },
            { data: 'name' },
            { data: 'last_name' },
            { data: 'phone' },
            { data: 'age' },
            { data: 'date_formated' },
            { data: "buttons" },
        ]
    });
}

function createUser(file_base_64, form) {
    var formData = form.serializeArray();
    var data = {
        _token: token,
        data: formData,
        file: file_base_64
    };

    $.ajax({
        url: '/users/create',
        type: 'POST',
        data: data,
        success: function(response) {
            swal(response.result, response.message, response.type);
            if (response.result == 'Ok') {
                $('#modalCreate').modal('hide');
                var user = response.user;
                window.table.row.add(user).draw();
            }
        },
        error: function(error) {
            console.log(error);
            swal('Ups', 'Ocurrio un error', 'error');
        }
    });
}

function updateUser(form) {
    var formData = form.serializeArray();
    var data = {
        _token: token,
        data: formData,
    };

    var id = $("#id").val();

    $.ajax({
        url: '/users/' + id + '/update',
        type: 'PUT',
        data: data,
        success: function(response) {
            if (response.result == 'Ok') {
                $('#modalUpdate').modal('hide');
                swal('Ok', 'Usuario actualizado', 'success').then(function() {
                    window.location.reload();
                });
            } else {
                swal('Error', 'Ha ocurrio un error', 'error');
            }
        },
        error: function(error) {
            console.log(error);
            swal('Error', 'Ha ocurrido un error', 'error');
        }
    });
}

function getUser(user) {
    var options = {
        method: 'GET',
        headers: { "Content-Type": "application/json" }
    };
    fetch('/users/' + user + '/getUser', options)
        .then(function(response) {
            return response.json();
        })
        .then(function(response) {
            fillForm(response.user);
        }).catch(function(error) {
            swal('Error', 'Ocurrio un error al obtener los datos del usuario', 'error');
        });
}

function fillForm(user) {
    $('#modalUpdate input[name=id]').val(user.id);
    $('#modalUpdate input[name=name]').val(user.name);
    $('#modalUpdate input[name=last_name]').val(user.last_name);
    $('#modalUpdate input[name=phone]').val(user.phone);
    $('#modalUpdate input[name=age]').val(user.age);
    $('#modalUpdate input[name=ingresed_at]').val(user.ingresed_at);
    $('#preview').css('background-image', 'url(/files/users/' + user.file + ')');
    $('#modalUpdate').modal('show');
}

function deleteUser(user, row) {
    swal({
        title: "Confirmar",
        text: "Eliminar registro",
        icon: "warning",
        buttons: ['Cancelar', 'Eliminar'],
        dangerMode: true,
    }).then(function(confirm) {
        if (confirm) {
            excuteDelete(user, row);
        }
    });
}

function excuteDelete(user, row) {
    $.ajax({
        url: '/users/' + user + '/delete',
        type: 'DELETE',
        success: function(response) {
            if (response.result == 'ok') {
                window.table
                    .row($(row).parents('tr'))
                    .remove()
                    .draw();
            }
        },
        error: function() {
            swal('Error', 'Ocurrio un error', 'error');
        }
    });
}

function getBase64(file, form) {
    var reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = function() {
        var file_base_64 = reader.result;
        createUser(file_base_64, form);
    };
    reader.onerror = function(error) {
        swal('Error', 'Ocurrio un error', 'error');
    };
}