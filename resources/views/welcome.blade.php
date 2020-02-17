<!DOCTYPE html>
<html>
    <head>
        <title>Intel - Test</title>
        @include('partials.styles')
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body class="hold-transition sidebar-mini">
    @include('partials.modal')
    @include('partials.modal_update')
        <div class="wrapper">
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalCreate"><i class="fa fa-plus"></i> Nuevo usuario</button>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-success m-l-5" href="/import"><i class="fas fa-file-excel"></i> Importar Usuarios</a>
                    </li>
                </ul>
            </nav>
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <div class="sidebar">
                    <nav class="mt-2">
                        <br><br>
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <a href="javascript:;" class="nav-link active">
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
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Usuarios</h1>
                            </div>
                        </div>
                    </div>
                </section>

                <div class="col-md-12">
                    @include('partials.table')
                </div>
            </div>
        </div>
        
        @include('partials.js')
        <script type="text/javascript">
            var token = '{{ csrf_token() }}';
        </script>
    </body>
</html>