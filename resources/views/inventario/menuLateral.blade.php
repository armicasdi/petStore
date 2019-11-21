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

        </ul>
    </div>
</div>
