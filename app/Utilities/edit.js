
$(document).ready(function () {

    var editForm = $("#editForm");
    var id = editForm.find("input[name=id]").val();
    var token = editForm.find("input[name=_token]").val();
    var url = "upload/image/" + id;
    var urlFiles = "upload/file/" + id;

    $('#tags').tagit({
        availableTags: categories, allowSpaces: true
    });

    uploader.add('panelInfo', {
        url: url
    }, function(data){
        if(data.result == 'ok'){
            $('#image').css('background-image', 'url(' + data.file + ')')
        }
    });

    uploader.add('panelFiles', {
        url: urlFiles
    }, function(data){
        if(data.result == 'ok'){
            var newItem = $($("#be_file").html());

            newItem.find(".image-inner").addClass("file_" + data.ext);
            newItem.find(".img").css("background-image", "url(" + data.file + ")");
            newItem.find(".image-caption").html(data.ext + " File");
            newItem.find("input[name=file_id]").val(data.id);
            newItem.find("input[name=file_title]").val(data.title);
            newItem.find("textarea[name=file_description]").val("");

            $("#gallery_files").append(newItem);
            productFilesEvents();
        }
    });

    $("#panelFilesTrigger").on({
        click: function (e) {
            e.preventDefault();
            $("#panelFiles").trigger("click");
        }
    });

    $("#image").on({
        click: function (e) {
            e.preventDefault();
            $("#panelInfo").trigger("click");
        }
    });

    productFilesEvents();

});

function productFilesEvents() {
    $("#gallery_files .btnSave").off("click");
    $("#gallery_files .btnSave").on({
        click: function (e) {
            e.preventDefault();
            var btn = $(this);
            var fileItem = $(this).closest(".image");
            var formData = {
                id: fileItem.find("input[name=file_id]").val(),
                title: fileItem.find("input[name=file_title]").val(),
                description: fileItem.find("textarea[name=file_description]").val()
            };

            $.ajax({
                url: "update-file",
                data: formData,
                type: "GET",
                success: function (response) {
                    if (response.result === "ok") {
                        btn.addClass("btn-success").find("span").html("Guardado");
                        setTimeout(function () {
                            btn.removeClass("btn-success").find("span").html("Guardar");
                        }, 2000);
                    }
                }
            });
        }
    });
    $("#gallery_files .btnDel").off("click");
    $("#gallery_files .btnDel").on({
        click: function (e) {
            e.preventDefault();
            var btn = $(this);
            var fileItem = $(this).closest(".image");
            var formData = {
                id: fileItem.find("input[name=file_id]").val()
            };
            window.msg.confirm("Eliminar archivo", "Confirma eliminar este archivo del producto?", "Eliminar", function () {
                $.ajax({
                    url: "delete-file",
                    data: formData,
                    type: "GET",
                    success: function (response) {
                        if (response.result === "ok") {
                            fileItem.remove();
                            productFilesEvents();
                        }
                    }
                });
            });
        }
    });
}
