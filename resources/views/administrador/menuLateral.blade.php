<div class="sidebar" data-color="purple" data-background-color="white">
    <!--
    Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

    Tip 2: you can also add an image using data-image tag
-->
    <div class="logo">
        <a href="#" class="simple-text logo-mini">
            <img src=" {{ asset('img/logo.png') }}" alt="logo.png" class="logo_dashboard">
        </a>
        <a href="#" class="simple-text logo-normal">
            Administración
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">

            <li class="nav-item {{ $pagActual == 'dashboard' ? 'active' : '' }}  ">
                <a class="nav-link" href=" {{ route('admin.dashboard') }}">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item {{ $pagActual == 'usuarios' ? 'active' : '' }}">
                <a class="nav-link" href=" {{ route('admin.empleados') }}">
                    <i class="material-icons">security</i>
                    <p>Usuarios</p>
                </a>
            </li>
            <li class="nav-item {{ $pagActual == 'roles' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.roles') }}">
                    <i class="material-icons">security</i>
                    <p>Roles</p>
                </a>
            </li>
            <li class="nav-item {{ $pagActual == 'agregar' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.agregar') }}">
                    <i class="material-icons">add_box</i>
                    <p>Agregar usuario</p>
                </a>
            </li>
            <li class="nav-item {{ $pagActual == 'editar' ? 'active' : '' }}">
                <a class="nav-link" href="#">
                    <i class="material-icons">create</i>
                    <p>Editar usuario</p>
                </a>
            </li>
            
            <div id="accordion2" role="tablist" class="nav-item">
                <div class="card card-collapse nav-link">
                        <h5 class="mb-0">
                            <a data-toggle="collapse" href="#collapse2" aria-expanded="true" aria-controls="collapse2">
                                Reportes
                                <i class="material-icons">keyboard_arrow_down</i>
                            </a>
                        </h5>
                        <div id="collapse2" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ route('admin.agregar') }}">
                                    <i class="material-icons">bar_chart</i>
                                    <p>Productos más vendidos</p>
                                </a>
                            </li>
                        </div>
                </div>
            </div>
            <div id="accordion" role="tablist" class="nav-item">
                <div class="card card-collapse nav-link">
                        <h5 class="mb-0">
                            <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Mantenimiento
                                <i class="material-icons">keyboard_arrow_down</i>
                            </a>
                        </h5>
                    <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                            <li class="nav-item ">
                                <a class="nav-link" href="#">
                                    <i class="material-icons">table_chart</i>
                                    <p>Especialidades</p>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="#">
                                    <i class="material-icons">table_chart</i>
                                    <p>Vacunas</p>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="#">
                                    <i class="material-icons">table_chart</i>
                                    <p>Servicios peluqueria</p>
                                </a>
                            </li> <li class="nav-item ">
                                <a class="nav-link" href="#">
                                    <i class="material-icons">table_chart</i>
                                    <p>Especies</p>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="#">
                                    <i class="material-icons">table_chart</i>
                                    <p>Razas</p>
                                </a>
                            </li>

                            <li class="nav-item ">
                                <a class="nav-link" href="#">
                                    <i class="material-icons">table_chart</i>
                                    <p>Bodega</p>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="#">
                                    <i class="material-icons">table_chart</i>
                                    <p>Tipo producto</p>
                                </a>
                            </li>

                        </div>
                    </div>
                </div>


        </ul>
    </div>
</div>
