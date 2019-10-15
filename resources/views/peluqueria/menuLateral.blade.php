<div class="sidebar" data-color="orange" data-background-color="white">
    <!--
    Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

    Tip 2: you can also add an image using data-image tag
-->
    <div class="logo">
        <a href="#" class="simple-text logo-mini">
            <img src=" {{ asset('img/logo.png') }}" alt="logo.png" class="logo_dashboard">
        </a>
        <a href="#" class="simple-text logo-normal">
            Peluqueria
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item  {{ $pagActual == 'dashboard' ? 'active' : '' }}">
                <a class="nav-link" href=" {{ route('peluqueria.dashboard') }}">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item   {{ $pagActual == 'servicio' ? 'active' : '' }} ">
                <a class="nav-link" href=" {{ route('peluqueria.atender') }}">
                    <i class="material-icons">pets</i>
                    <p>Servicio</p>
                </a>
            </li>

        </ul>
    </div>
</div>
