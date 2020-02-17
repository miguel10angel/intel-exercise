<!DOCTYPE html>
<html>
    <head>
        <title>Intel - Test</title>
        @include('partials.styles')
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="btn btn-secondary" href="/"><i class="fa fa-arrow-circle-left"></i> Regresar</a>
                    </li>
                </ul>
            </nav>
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <div class="sidebar">
                    <nav class="mt-2">
                        <br><br>
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <a href="/" class="nav-link active">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                Usuarios        
                                </p>
                            </a>
                        </ul>
                    </nav>
                </div>
            </aside>
            <div class="content-wrapper">
                <div class="col-md-12 row m-t-10">
                    <div class="col-md-6">
                        <form class="modal-content" method="post" action=""
                            id="form_excel" data-parsley-validate="true" enctype="multipart/form-data">
                            <div class="form-group row m-t-10">
                                <div class="col-md-9 m-l-5">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="input_excel" name="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                        <label class="custom-file-label" for="customFile">Seleccionar archivo</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group m-t-10">
                                <input type="checkbox" class="m-l-5" id="delete_rows">
                                <label class="label-form">Eliminar usuarios existentes</label>
                                <button type="submit" class="btn btn-info">Procesar archivo</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6" id="show_total" style="display: none">
                        <form class=" modal-content">
                            <div class="form-group m-t-10">
                                <br>
                                <label class="label-form m-l-5">Total de usuarios importados</label>
                                <input type="number" class="m-l-5" id="total_import">
                                <br>
                                <br>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-12 m-t-10">
                    <table class="table table-bordered table-hover" id="TableImport">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Teléfono</th>
                                <th>Edad</th>
                                <th>Fecha de ingreso</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        @include('partials.js')
        <script src="/assets/js/import.js"></script>
        <script type="text/javascript">
            var token = '{{ csrf_token() }}';
        </script>
    </body>
</html>