

<?php
$servidor = "127.0.0.1";
$puerto = "3307";
$usuario = "root";
$contrasena = "";
$base_datos = "agenda_contactos";

try {
    $conexion = new PDO(
        "mysql:host=$servidor;port=$puerto;dbname=$base_datos;charset=utf8mb4",
        $usuario,
        $contrasena,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );

} catch (PDOException $e) {
    error_log($e->getMessage());
    die("No se pudo conectar con la base de datos.");
}
?>
