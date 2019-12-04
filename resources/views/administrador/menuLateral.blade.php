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
            <li class="nav-item {{ $pagActual == 'venta' ? 'active' : '' }}  ">
                <a class="nav-link" href=" {{ route('admin.ventas') }}">
                    <i class="material-icons">local_grocery_store</i>
                    <p>Ventas</p>
                </a>
            </li>


            <div id="accordion3" role="tablist" class="nav-item">
                <div class="card card-collapse nav-link pt-3 pb-3">
                    <h5 class="mb-0">
                        <a data-toggle="collapse" href="#collapse3" aria-expanded="true" aria-controls="collapse3">
                            Gestion de Usuarios
                            <i class="material-icons">keyboard_arrow_down</i>
                        </a>
                    </h5>
                    <div id="collapse3" class="collapse @if($pagActual == 'usuarios' || $pagActual == 'roles' || $pagActual == 'agregar' || $pagActual == 'editar' || $pagActual == 'password') show @endif" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                        <ul class="nav">
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
                            <li class="nav-item {{ $pagActual == 'password' ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('password.fsolicitudes') }}">
                                    <i class="material-icons">vpn_key</i>
                                    <p>Resetear contraseña</p>
                                </a>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
            {{-- end collapse3--}}

            <div id="accordion2" role="tablist" class="nav-item">
                <div class="card card-collapse nav-link pt-3 pb-3">
                        <h5 class="mb-0">
                            <a data-toggle="collapse" href="#collapse2" aria-expanded="true" aria-controls="collapse2">
                                Reportes
                                <i class="material-icons">keyboard_arrow_down</i>
                            </a>
                        </h5>
                        <div id="collapse2" class="collapse @if($pagActual == 'reporte' || $pagActual == 'reporteMascotas' || $pagActual == 'Reporte de Atencion') show @endif" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                            <ul class="nav">
                                <li class="nav-item {{ $pagActual == 'reporte' ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('admin.reporte') }}">
                                        <i class="material-icons">bar_chart</i>
                                        <p>Prod más vendidos</p>
                                    </a>
                                </li>
                                <li class="nav-item {{ $pagActual == 'reporteMascotas' ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('admin.reporteMascotas') }}">
                                        <i class="material-icons">bar_chart</i>
                                        <p>Rep de mascotas</p>
                                    </a>
                                </li>
                                <li class="nav-item {{ $pagActual == 'Reporte de Atencion' ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('admin.reporteAtencion') }}">
                                        <i class="material-icons">bar_chart</i>
                                        <p>Rep de atenciones</p>
                                    </a>
                                </li>
                            </ul>
                        </div>
                </div>
            </div>
            {{-- End arcordion2--}}
            <div id="accordion" role="tablist" class="nav-item pb-5">
                <div class="card card-collapse nav-link  pt-3 pb-3">
                        <h5 class="mb-0">
                            <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Mantenimiento
                                <i class="material-icons">keyboard_arrow_down</i>
                            </a>
                        </h5>

                        <div id="collapseOne" class="collapse @if($pagActual == 'vacunas' || $pagActual == 'servicios' || $pagActual == 'especies' || $pagActual == 'bodegas' || $pagActual == 'tiposProductos'|| $pagActual == 'razas') show @endif" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                            <ul class="nav">
                                <li class="nav-item {{ $pagActual == 'vacunas' ? 'active' : '' }} ">
                                    <a class="nav-link" href="{{ route('vacunas') }}">
                                        <i class="material-icons">table_chart</i>
                                        <p>Vacunas</p>
                                    </a>
                                </li>
                                <li class="nav-item {{ $pagActual == 'servicios' ? 'active' : '' }} ">
                                    <a class="nav-link" href="{{ route('servicios') }}">
                                        <i class="material-icons">table_chart</i>
                                        <p>Servicios peluqueria</p>
                                    </a>
                                </li>
                                <li class="nav-item {{ $pagActual == 'especies' ? 'active' : '' }} ">
                                    <a class="nav-link" href="{{ route('especies') }}">
                                        <i class="material-icons">table_chart</i>
                                        <p>Especies</p>
                                    </a>
                                </li>
                                <li class="nav-item {{ $pagActual == 'razas' ? 'active' : '' }} ">
                                    <a class="nav-link" href="{{ route('razas') }}">
                                        <i class="material-icons">table_chart</i>
                                        <p>Razas</p>
                                    </a>
                                </li>

{{--                                <li class="nav-item {{ $pagActual == 'bodegas' ? 'active' : '' }}">--}}
{{--                                    <a class="nav-link" href="{{ route('bodegas') }}">--}}
{{--                                        <i class="material-icons">table_chart</i>--}}
{{--                                        <p>Bodega</p>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
                            </ul>
                        </div>
                    </div>
            </div>
            {{-- End arcordion--}}
        </ul>

    </div>
</div>
