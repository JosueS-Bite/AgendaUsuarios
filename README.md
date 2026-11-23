Este proyecto consiste en el desarrollo de una aplicación web de agenda personal de contactos, utilizando PHP y MySQL. Su objetivo es permitir que los usuarios puedan registrar una cuenta, iniciar sesión y administrar sus contactos personales de manera sencilla y segura.

La aplicación cuenta con un sistema de autenticación y manejo de sesiones, que permite controlar el acceso a la información. Cada usuario puede visualizar, agregar, editar y eliminar únicamente sus propios contactos.

Además, se implementan mecanismos básicos de seguridad para proteger la información almacenada en la base de datos y evitar accesos no autorizados.
TECNOLOGIAS USADAS
PHP
MySQL
HTML
XAMPP
phpMyAdmin
Visual Studio Code
Paso 1. Descargar el proyecto

Descargar el repositorio desde GitHub:

https://github.com/JosueS-Bite/AgendaUsuarios

Seleccionar la opción Code → Download ZIP y extraer los archivos.

Paso 2. Copiar los archivos

Copiar la carpeta del proyecto dentro del directorio htdocs de XAMPP.
Paso 3. Iniciar los servicios

Abrir el panel de control de XAMPP e iniciar los servicios Apache y MySQL.

Paso 4. Crear la base de datos

Ingresar a phpMyAdmin desde el navegador:

http://localhost/phpmyadmin

Crear la base de datos con el nombre utilizado en el archivo conexion.php.

Paso 5. Importar el script SQL

Seleccionar la base de datos creada, ingresar a la pestaña Importar, seleccionar el archivo .sql proporcionado con el proyecto y ejecutar la importación.

Paso 6. Configurar la conexión

Abrir el archivo conexion.php y verificar que los parámetros de conexión coincidan con la configuración local de MySQL:

Servidor: localhost

Puerto: 3307 (configuración utilizada durante el desarrollo; puede variar según el equipo).

Usuario y contraseña: según la configuración local.

Base de datos: nombre utilizado al importar el script SQL.

Paso 7. Ejecutar la aplicación

Abrir el navegador e ingresar a:

http://localhost/agenda_usuarios/login.php

Paso 8. Probar el funcionamiento

Registrar un nuevo usuario, iniciar sesión y comprobar las funciones de agregar, visualizar, editar y eliminar contactos.
