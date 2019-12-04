<div class="card-body">
    <p class="card-text ">Rol: {{ $usuario->tipo_usuario->tipo }}</p>
    <p class="card-text">Nombre completo: {{ $usuario->empleados->nombres }} {{ $usuario->empleados->apellidos }}</p>
    <p class="card-text">Dui: {{ $usuario->empleados->dui }}</p>
    <p class="card-text">Fecha de nacimiento: {{ date('d/m/Y',strtotime($usuario->empleados->fech_nac)) }}</p>
    <p class="card-text">Género: {{ $usuario->empleados->genero->genero }}</p>
    <p class="card-text">Telefono 1: {{ $usuario->empleados->telefono1 }}</p>
    <p class="card-text">Telefono 2: {{ $usuario->empleados->telefono2 ?? '---- ----' }}</p>
    <p class="card-text">Correo: {{ $usuario->empleados->correo ?? 'No especificado' }}</p>
    <p class="card-text">Dirección: {{ $usuario->empleados->direccion }}</p>
</div>

