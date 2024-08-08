Prueba entrada , salidas e historial de los movimientos

Ide utilizado -> Visual Studo Code

Versión : PHP versión 8.2.12

DBMS: Mysql Versión del servidor: 10.4.32-MariaDB - mariadb.org binary distribution.

Se necesita tener instalado también composer.

Pasos para iniciar el programa

1.-Abrir la carpeta del proyecto

2.-En la terminal ejecutar el siguiente comando "composer update", mientras se realiza este paso en nuestro servidor de base datos que en este caso es mysql crear la siguiente base de datos "bodega_db"

3.-Modificar el archivo. env de acuerdo a la conexión y la base de datos, como se muestra en el siguiente ejemplo.

DB_CONNECTION=mysql

DB_HOST=127.0.0.1

DB_PORT=3306

DB_DATABASE=bodega_db

DB_USERNAME= (usuario de mysql)

DB_PASSWORD= (contraseña de mysql)

4.-Cuando se termine la ejecución del comando ejecutar el siguiente "php artisan migrate:refresh --seed" . Este comando permite crear las tablas y así mismo llenar los datos necesarios para su ejecución.

5.-Cuando se termine de ejecutar , iniciar el siguiente comando "php artisan serve".

Los Usuarios vienen descritos en "database/seeders/DatabaseSeeder.php"
