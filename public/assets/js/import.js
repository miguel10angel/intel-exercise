$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': token
        }
    });

    $("#form_excel").submit(function(e) {
        e.preventDefault();
        var file = document.getElementById('input_excel').files[0];
        var delete_rows = document.getElementById("delete_rows").checked;

        if (!file) {
            swal('Atención', 'Selecciona un archivo de excel', 'info');
            return false;
        }
        if (file.type == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' || file.type == 'application/vnd.ms-excel') {
            getBase64(file, delete_rows);
        } else {
            swal('Atención', 'Solo se permiten archivos de excel', 'info');
            return false;
        }

    });

});


function processFile(file_base_64, delete_rows) {
    swal({
        title: "",
        text: "Se esta procesando el archivo",
        icon: "info",
        showCancelButton: false,
        showConfirmButton: false
    });
    var data = {
        _token: token,
        delete_rows: delete_rows,
        file: file_base_64
    };

    $.ajax({
        url: '/upload_excel',
        data: data,
        type: 'POST',

        dataType: 'json',
        success: function(response) {
            if (response.result == 'ok') {
                var users = response.data;
                fillImport(users);
                swal('OK', 'Usuarios importados.', 'success');
            }
        },
        error: function(error) {
            swal('Error', 'Ocurrio un error al importar a los usuarios', 'error');
        }
    });
}

function getBase64(file, delete_rows) {
    var reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = function() {
        var file_base_64 = reader.result;
        processFile(file_base_64, delete_rows);
    };
    reader.onerror = function(error) {
        swal('Error', 'Ocurrio un error al importar a los usuarios', 'error');
    };
}

function fillImport(users) {
    var table = $("table#TableImport tbody");
    table.empty();
    users.forEach(user => {
        table.append('<tr>' +
            '<td>' + user.id + '</td>' +
            '<td>' + user.name + '</td>' +
            '<td>' + user.last_name + '</td>' +
            '<td>' + user.phone + '</td>' +
            '<td>' + user.age + '</td>' +
            '<td>' + user.date_formated + '</td>' +
            '</tr>');
    });
    $("#total_import").val(users.length).attr('disabled', 'disabled');
    $("#show_total").css('display', 'block');
}