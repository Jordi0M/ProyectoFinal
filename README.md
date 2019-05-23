# ProyectoFinal: DrumSecuence

Para que cargar bien los MP3, debemos hacer el siguiente comando: "php artisan storage:link", esto creara un link a la carpeta storage.

## Tabla de contenidos
1. [Desarrolladores](#desarrolladores)
2. [Contenido](#contenido)
3. [Requisitos](#requisitos)

## Desarrolladores <a name="desarrolladores"></a>
El equipo está formado por:
- Eric Pérez (Xus) - https://github.com/EricPerLuq
- Jordi Martínez - https://github.com/Jordi0M


## Contenido
Como en cualquier repositorio de Laravel, todo el contenido del javascript, css e imagenes, se encuentra en la carpeta "public".

Todas las rutas externas, las podremos ver en la vista "master" o "app", situadas en: 

> /resources/views/layouts

El resto del contenido se encuentra en las demas vistas 

> /resources/views/

## Requisitos: <a name="requisitos"></a>
Para poder ejecutar la aplicacion, necesitaremos tener instalado un servidor **[mysql](https://www.mysql.com)**, **[composer](https://getcomposer.org/)** y **[Laravel](https://laravel.com)**.

Una vez lo tengamos todo instalado, crearemos la base de datos.

Al tener ya la base de datos, tendremos que hacer dentro de la carpeta un **composer install**, copiaremos el fichero ".env.example" y crearemos uno, llamado ".env", donde pegaremos el contenido, cambiando el nombre de la base de datos, el usuario y la contraseña.

***
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE="nombre_de_la_base_de_datos"
    DB_USERNAME="usuario"
    DB_PASSWORD="contraseña"
***

Procederemos a hacer el comando para generar la clave que utilizará la aplicación:
***
    php artisan key:generate.
***

Haremos la migracion de la base de datos con:
***
    php artisan migrate
***

(En caso de que ya tuviesemos una migracion hecha, podemos usar el comando "php artisan migrate:refresh" para borrar las tablas de la base de datos, y que nos la vuelva a crear. **Borrara toda la informacion que tengamos en la base de datos**)

