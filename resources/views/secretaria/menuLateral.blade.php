<div class="sidebar" data-color="azure" data-background-color="white">
    <!--
    Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

    Tip 2: you can also add an image using data-image tag
-->
    <div class="logo">
        <a href="#" class="simple-text logo-mini">
            <img src=" {{ asset('img/logo.png') }}" alt="logo.png" class="logo_dashboard">
        </a>
        <a href="#" class="simple-text logo-normal">
           Secretaria
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item {{ $pagActual == 'dashboard' ? 'active' : '' }}">
                <a class="nav-link" href=" {{ route('secretaria.dashboard') }}">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item {{ $pagActual == 'consulta' ? 'active' : '' }} ">
                <a class="nav-link" href="{{ route('secretaria.consulta') }}">
                    <i class="material-icons">healing</i>
                    <p>Servicios</p>
                </a>
            </li>
            {{-- Agregar --}}
            <div id="accordion" role="tablist" class="nav-item">
                <div class="card card-collapse nav-link">
                    <h5 class="mb-0">
                        <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Agregar
                            <i class="material-icons">keyboard_arrow_down</i>
                        </a>
                    </h5>

                    <div id="collapseOne" class="collapse @if($pagActual == 'agregar' || $pagActual == 'actualizar') show @endif" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                        <li class="nav-item  {{ $pagActual == 'agregar' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('secretaria.crear') }}">
                                <i class="material-icons">post_add</i>
                                <p>Nuevo registro</p>
                            </a>
                        </li>
                        <li class="nav-item {{ $pagActual == 'actualizar' ? 'active' : '' }} ">
                            <a class="nav-link" href="{{ route('secretaria.actualizar') }}">
                                <i class="material-icons">pets</i>
                                <p>Nueva mascota</p>
                            </a>
                        </li>
                    </div>
                </div>
            </div>
            {{-- Editar --}}
            <div id="accordion2" role="tablist" class="nav-item">
                <div class="card card-collapse nav-link">
                    <h5 class="mb-0">
                        <a data-toggle="collapse" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                            Editar
                            <i class="material-icons">keyboard_arrow_down</i>
                        </a>
                    </h5>

                    <div id="collapseTwo" class="collapse @if($pagActual == 'emascota' || $pagActual == 'epropietario') show @endif" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion2">
                        <li class="nav-item  {{ $pagActual == 'emascota' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('secretaria.actualizarMascota') }}">
                                <i class="material-icons">edit</i>
                                <p>Info. mascota</p>
                            </a>
                        </li>
                        <li class="nav-item {{ $pagActual == 'epropietario' ? 'active' : '' }} ">
                            <a class="nav-link" href="{{ route('secretaria.actualizarPropietario') }}">
                                <i class="material-icons">edit</i>
                                <p>Info. propietario</p>
                            </a>
                        </li>
                    </div>
                </div>
            </div>



        </ul>
    </div>
</div>
