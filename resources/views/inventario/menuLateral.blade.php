<div class="sidebar" data-color="green" data-background-color="white">
    <!--
    Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

    Tip 2: you can also add an image using data-image tag
-->
    <div class="logo">
        <a href="#" class="simple-text logo-mini">
            <img src=" {{ asset('img/logo.png') }}" alt="logo.png" class="logo_dashboard">
        </a>
        <a href="#" class="simple-text logo-normal">
            Inventario
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">

            <li class="nav-item {{ $pagActual == 'dashboard' ? 'active' : 'null' }}">
                <a class="nav-link" href=" {{ route('inventario.dashboard') }}">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item {{ $pagActual == 'entrada' ? 'active' : 'null' }}">
                <a class="nav-link" href="{{ route('entrada') }}">
                    <i class="material-icons">unarchive</i>
                    <p>Entrada producto</p>
                </a>
            </li>
            <li class="nav-item {{ $pagActual == 'producto' ? 'active' : 'null' }}">
                <a class="nav-link" href="{{ route('productos') }}">
                    <i class="material-icons">storage</i>
                    <p>Existencias</p>
                </a>
            </li>
            <li class="nav-item {{ $pagActual == 'proveedor' ? 'active' : 'null' }}">
                <a class="nav-link" href="{{ route('proveedores') }}">
                    <i class="material-icons">local_shipping</i>
                    <p>Proveedores</p>
                </a>
            </li>

            <div id="acordeon1" role="tablist" class="nav-item">
                <div class="card card-collapse nav-link pt-3 pb-3">
                    <h5 class="mb-0">
                        <a data-toggle="collapse" href="#mostra1" aria-expanded="true" aria-controls="mostra1" class="text-gray">
                            Opciones
                            <i class="material-icons">keyboard_arrow_down</i>
                        </a>
                    </h5>

                    <div id="mostra1" class="collapse @if( $pagActual == 'tipoProducto' || $pagActual == 'ubicacion') show @endif" role="tabpanel" aria-labelledby="headingOne" data-parent="#acordeon1">
                        <ul class="nav">
                            <li class="nav-item {{ $pagActual == 'tipoProducto' ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('tipos.productos') }}">
                                    <i class="material-icons">create_new_folder</i>
                                    <p>Nueva Categoria</p>
                                </a>
                            </li>
                            <li class="nav-item {{ $pagActual == 'ubicacion' ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('ubicaciones') }}">
                                    <i class="material-icons">create_new_folder</i>
                                    <p>Nueva ubicación</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </ul>
    </div>
</div>
