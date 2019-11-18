<div class="sidebar" data-color="green" data-background-color="white">  
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
              <li class="nav-item {{ $pagActual == 'dashboard' ? 'active' : '' }} ">
                <a class="nav-link" href=" {{ route('inventario.dashboard') }}">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li>
             <li class="nav-item {{ $pagActual == 'ingreso' ? 'active' : '' }} ">
                <a class="nav-link" href=" {{ route('inventario.ingreso') }}">
                    <i class="material-icons">vertical_split</i>
                    <p>Ingresar producto</p>
                </a>
            </li>
        </ul>
    </div>
</div>
