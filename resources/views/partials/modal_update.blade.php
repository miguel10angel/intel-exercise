<div class="modal fade bd-example-modal-lg" id="modalUpdate">
    <div class="modal-dialog modal-lg">
        <form class="modal-content" method="head" action=""
            id="form_update" data-parsley-validate="true">
            <input name="id" id="id"  type="hidden" />
            <div class="modal-header">
                <h4 class="modal-title">
                    Editar usuario
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body row">
                <div class="col-md-6">
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
                            <input class="form-control datepicker" name="ingresed_at" placeholder="Fecha de Ingreso" type="text" required/>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="preview" style="width: 100%; height: 170px;" id="preview"></div>
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
