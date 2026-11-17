
<?php
session_start();
require_once "conexion.php";


if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit;
}


if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    exit("Método no permitido.");
}


$token = $_POST["csrf_token"] ?? "";

if (
    !isset($_SESSION["csrf_token"]) ||
    !is_string($token) ||
    !hash_equals($_SESSION["csrf_token"], $token)
) {
    http_response_code(403);
    exit("Solicitud no autorizada.");
}


$id_contacto = filter_input(
    INPUT_POST,
    "id",
    FILTER_VALIDATE_INT
);

if (!$id_contacto || $id_contacto < 1) {
    header("Location: panel.php");
    exit;
}


$id_usuario = $_SESSION["usuario_id"];

try {
    
    $sql = "DELETE FROM contactos
            WHERE id = ? AND id_usuario = ?";

    $stmt = $conexion->prepare($sql);

    $stmt->execute([
        $id_contacto,
        $id_usuario
    ]);

    header("Location: panel.php");
    exit;

} catch (PDOException $e) {
    error_log($e->getMessage());
    http_response_code(500);
    exit("No se pudo eliminar el contacto.");
}
?>
