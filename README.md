<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Instalación
1. Clonar el repositorio
```bash
$ git clone https://github.com/suselancha/paradores.git
```
2. Ejecutar
```bash
$ cd paradores
$ npm install
$ composer install
```
3. Levantar la base de datos
* En la carpeta "sql", migrar "paradores.sql"
* Con MysqlWorkbench levantar los modelos entidad-relacion (der-ventas.mwb)
4. Clonar el archico __.env.example y renombrar la copia a __.env__
6. Cambiar las variables de entorno de MySql
7. Reconstruir base de datos y ejecutar seeds (opcional - en caso de no tener éxito con el punto 3)
```bash
$ php make:migrate:fresh --seed
```
9. Levantar la aplicación
```bash
$ php artisan serve
```

## Pruebas (a modificar)

```bash
# unit tests
$ npm run test

# e2e tests
$ npm run test:e2e

# test coverage
$ npm run test:cov
```

## Tips para desarrollo

1. Generar modelos, migraciones y factorias
```
php artisan make:model Client -mf
```

2. Para tablas intermedias, no es necesario crear modelo, sólo migración
```
php artisan make:migration create_imte_sale_table
```

3. Ejecutar migraciones. Nombre modelo singular
```
- php artisan migrate
- php artisan migrate:fresh
```

4. Autenticación
```
- composer require laravel/ui
- php artisan ui bootstrap
- php artisan ui bootstrap --auth
- npm install
- Crear la carpeta "css" en "public" y copiar el .css de bootstrap
- Modificar el archivo "app-blade.php".
{{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
```

5. Plantilla AdminLTE
```
- https://adminlte.io/
- Descargar plantilla
- Descomprimir y copiar en la carpete "public", las carpetas "dist y plugins"
- Ejecutar: php artisan livewire:layout
- Crear el archivo: C:\xampp\htdocs\ventas\resources\views\components\layouts\app.blade.php
- Copiar el codigo del archivo "index.html" al archivo "app.blade.php"
- En "app.blade.php" agregar {{$slot}}
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        {{$slot}}
    </div><!--/. container-fluid -->
</section>
<!-- /.content -->
```

6. Crear componentes livewire
```
1. php artisan make:livewire Home/inicio
CLASS: app/Livewire//Home/Inicio.php
VIEW:  C:\xampp\htdocs\ventas\resources\views/livewire/home\inicio.blade.php

```

7. Iconos con Fontawesome
```
https://fontawesome.com/v5/search
```

8. Paginación
```
1. php artisan livewire:publish --config
2. [C:\xampp\htdocs\ventas\config\livewire.php] .......... DONE
3. Modificar: 'pagination_theme' => 'bootstrap',
```

9. Traducción
```
1. Descargar desde: https://github.com/laraveles/spanish
2. Copiar en "resources\lang" la carpeta "es"
3. En "config, app.php" modificar => 'locale' => 'es',
```

10. Imagenes
* No almacenar en la carpeta "public", manejar el "storage" => \storage\app\public
* Ejecutar: ```php artisan storage:link``` -> INFO  The [C:\xampp\htdocs\ventas\public\storage] link has been connected to [C:\xampp\htdocs\ventas\storage\app/public].
* En "config.php, filesystems.php" => modificar: 'default' => env('FILESYSTEM_DISK', 'public')
* En el modelo importar el trait -> use Livewire\WithFileUploads; use WithFileUploads;
* Si no muestra la tabla las imagenes, eliminar carpeta "storage" en "public" y volver a ejecutar el punto 2

11. Extensiono de Chrome para rellenar campos automaticamente
* Fake Filler

12. Controladores
Crear controlador: ```php artisan make:controller PdfController```

13. Migraciones y Seed
Ejecutar Seed: ```php artisan make:seed```
Ejecutar Migraciones y Seeds: ```php artisan migrate:fresh --seed```

## Stack usado
* MySQL
* Laravel