
<?php

$host = "sql104.infinityfree.com";
$dbname = "if0_43508814_agenda";
$user = "if0_43508814";
$password = "quMpshMSkK4xj";

try {
    $conexion = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $user,
        $password
    );

    $conexion->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
