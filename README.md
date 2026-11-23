
URL PUBLICO: https://miagenda2026.free.nf/
<img width="1772" height="887" alt="image" src="https://github.com/user-attachments/assets/ea6504e1-3a8b-458c-b3c3-50290973e168" />
<img width="1902" height="951" alt="image" src="https://github.com/user-attachments/assets/37ba6642-25f3-450f-90e3-ae0e24c26403" />
<img width="1894" height="938" alt="image" src="https://github.com/user-attachments/assets/0b61be82-53a5-4aa3-bb87-660f11da3912" />
Gestión de contactos
<img width="1319" height="471" alt="image" src="https://github.com/user-attachments/assets/75857ec1-2c9c-4014-9c17-48829f3da2b6" />
<img width="1367" height="458" alt="image" src="https://github.com/user-attachments/assets/65238d99-4659-466f-a16a-a1ce895a1f6d" />
Para el desarrollo de esta aplicación se utilizaron las siguientes tecnologías:

PHP: lenguaje utilizado para desarrollar la lógica del sistema y procesar las solicitudes.

MySQL: sistema gestor de bases de datos utilizado para almacenar usuarios y contactos.

HTML5: estructura de las páginas web.

CSS3: diseño y presentación de las interfaces.

PDO: conexión y ejecución segura de consultas a la base de datos.

XAMPP: entorno de desarrollo local para ejecutar PHP y MySQL.

Visual Studio Code: editor utilizado para desarrollar y modificar el código.

InfinityFree: servicio de hosting gratuito utilizado para publicar la aplicación.

Git y GitHub: herramientas utilizadas para el control de versiones y almacenamiento del proyecto.
Paso 1. Descargar el proyecto

Clonar el repositorio desde GitHub o descargarlo en formato ZIP y extraerlo.

Paso 2. Copiar los archivos

Colocar la carpeta del proyecto dentro del directorio htdocs de XAMPP.

Ejemplo:

C:\xampp\htdocs\agenda_usuarios

Paso 3. Iniciar los servicios

Abrir el panel de control de XAMPP e iniciar los servicios Apache y MySQL.

Importante: En este entorno, MySQL está configurado para utilizar el puerto 3307.

Paso 4. Crear e importar la base de datos

Abrir el navegador e ingresar a http://localhost/phpmyadmin.

Crear una nueva base de datos para el proyecto.

Seleccionar la base de datos creada.

Ingresar a la pestaña Importar.

Seleccionar el script SQL incluido en el proyecto.

Ejecutar la importación para crear las tablas usuarios y contactos, junto con su estructura correspondiente.

Paso 5. Configurar la conexión a la base de datos

Abrir el archivo conexion.php y configurar los datos de conexión para el entorno local:

Host: localhost

Puerto: 3307

Usuario: root

Contraseña: vacía por defecto en una instalación estándar de XAMPP.

Nombre de la base de datos: el nombre utilizado al crearla en phpMyAdmin.

La conexión debe utilizar el puerto 3307 en la configuración PDO.

Ejemplo:

mysql:host=localhost;port=3307;dbname=nombre_base_datos;charset=utf8mb4

Paso 6. Ejecutar la aplicación

Abrir el navegador e ingresar a:

http://localhost/agenda_usuarios/registro.php

Desde esta dirección se puede crear una cuenta, iniciar sesión y comenzar a administrar los contactos.


MEJORAS:
Autenticación de usuarios: se incorporaron formularios de registro e inicio de sesión.

Seguridad de contraseñas: se implementó password_hash() para almacenar contraseñas protegidas y password_verify() para comprobarlas durante el inicio de sesión.

Manejo de sesiones: se incorporó el control de sesiones para restringir el acceso a usuarios autenticados.

Privacidad de la información: cada usuario puede acceder y administrar únicamente sus propios contactos.

Operaciones CRUD: se implementaron funciones para agregar, consultar, editar y eliminar contactos.

Validación de datos: se añadieron comprobaciones para evitar campos vacíos, correos inválidos y registros duplicados.

Consultas preparadas: se utilizó PDO para ejecutar consultas parametrizadas y reducir riesgos de inyección SQL.

Publicación en internet: la aplicación dejó de funcionar únicamente en el entorno local y se publicó mediante InfinityFree.

Organización del proyecto: se actualizaron los archivos y se sincronizaron los cambios mediante GitHub.



