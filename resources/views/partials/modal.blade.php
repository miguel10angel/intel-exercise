<div class="modal fade in" id="modalCreate">
    <div class="modal-dialog">
        <form class="modal-content" method="post" action="" id="form_create" data-parsley-validate="true" enctype="multipart/form-data">
            <div class="modal-header">
                <h4 class="modal-title">
                    Nuevo usuario
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Nombre</label>
                    <div class="col-md-9">
                        <input class="form-control" name="name" placeholder="Nombre" type="text" required />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Apellidos</label>
                    <div class="col-md-9">
                        <input class="form-control" name="last_name" placeholder="Apellidos" type="text" required />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Teléfono</label>
                    <div class="col-md-9">
                        <input class="form-control" name="phone" placeholder="Teléfono" type="text" required />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Edad</label>
                    <div class="col-md-9">
                        <input class="form-control" name="age" placeholder="Edad" type="number" step="1" required min="0"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Fecha de ingreso</label>
                    <div class="col-md-9">
                        <input class="form-control datepicker" name="ingresed_at" placeholder="Fecha de Ingreso" value="{{ date('Y-m-d')}}" type="text" required/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Foto</label>
                    <div class="col-md-9">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="file" accept="image/*">
                            <label class="custom-file-label" for="customFile">Seleccionar archivo</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Cerrar</a>
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>
        </form>
    </div>
</div>
