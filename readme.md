<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

## Configuracion inicial del proyect Laravel

### Requisitos iniciales

1. Tener instalado [composer](https://getcomposer.org/ "composer")
2. Tener instalado PHP 7.2 o superior  
2. Configura el `$PATH` del sistema para tanto composer y PHP sean accedido de forma global

### Iniciar el proyecto ya creado

1. Ir a la carpeta del proyeto
2. `composer install`
3. Renombar el archivo .env.example a .env
4. `php artisan key:generate`  --> Generara un clave del proyecto aleatoria
5. configurar el archivo .env con la congiguracion del proyecto

### Ejemplo

* APP_NAME=petfamily
* APP_URL=http://www.petfamily.com (Opcion por si configuran un virtualhost)

* DB_CONNECTION=mysql
* DB_HOST=192.168.0.250
* DB_PORT=3306
* DB_DATABASE=petfamily
* DB_USERNAME=usario_db
* DB_PASSWORD=password

### Crear un nuevo proyecto

`composer create-project --prefer-dist laravel/laravel  [NombreAplicacion]`
o pueden usar el instalador de laravel
`laravel new [NombreProyecto]`

## Documentacion Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## License

The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/
