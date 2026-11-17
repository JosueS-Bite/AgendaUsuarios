
<?php
session_start();
require_once "conexion.php";


if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit;
}

$mensaje = "";
$nombre = "";
$telefono = "";
$correo = "";
$ciudad = "";


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nombre = trim($_POST["nombre"] ?? "");
    $telefono = trim($_POST["telefono"] ?? "");
    $correo = trim($_POST["correo"] ?? "");
    $ciudad = trim($_POST["ciudad"] ?? "");

    if ($nombre === "" || $telefono === "" ||
        $correo === "" || $ciudad === "") {

        $mensaje = "Todos los campos son obligatorios.";

    } elseif (strlen($nombre) > 100 ||
              strlen($telefono) > 20 ||
              strlen($correo) > 150 ||
              strlen($ciudad) > 100) {

        $mensaje = "Uno de los campos supera la longitud permitida.";

    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {

        $mensaje = "Ingrese un correo electrónico válido.";

    } else {

        try {
            
            $id_usuario = $_SESSION["usuario_id"];

            $sql = "INSERT INTO contactos
                    (id_usuario, nombre, telefono, correo, ciudad)
                    VALUES (?, ?, ?, ?, ?)";

            $stmt = $conexion->prepare($sql);

            $stmt->execute([
                $id_usuario,
                $nombre,
                $telefono,
                $correo,
                $ciudad
            ]);

            header("Location: panel.php");
            exit;

        } catch (PDOException $e) {

            error_log($e->getMessage());
            $mensaje = "No se pudo guardar el contacto.";
        }
    }
}


function escapar($texto) {
    return htmlspecialchars(
        (string)$texto,
        ENT_QUOTES,
        "UTF-8"
    );
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Agregar contacto</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .contenedor {
            background: white;
            padding: 30px;
            border-radius: 10px;
            width: 400px;
            max-width: 85%;
            box-shadow: 0 4px 12px #0002;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #1d4ed8;
        }

        .volver {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #2563eb;
            text-decoration: none;
        }

        .error {
            color: #b91c1c;
            text-align: center;
        }
    </style>
</head>

<body>

<div class="contenedor">

    <h2>Agregar nuevo contacto</h2>

    <?php if ($mensaje !== ""): ?>
        <p class="error">
            <?= escapar($mensaje) ?>
        </p>
    <?php endif; ?>

    <form method="POST">

        <input
            type="text"
            name="nombre"
            placeholder="Nombre completo"
            maxlength="100"
            value="<?= escapar($nombre) ?>"
            required
        >

        <input
            type="tel"
            name="telefono"
            placeholder="Número de teléfono"
            maxlength="20"
            value="<?= escapar($telefono) ?>"
            required
        >

        <input
            type="email"
            name="correo"
            placeholder="Correo electrónico"
            maxlength="150"
            value="<?= escapar($correo) ?>"
            required
        >

        <input
            type="text"
            name="ciudad"
            placeholder="Ciudad de residencia"
            maxlength="100"
            value="<?= escapar($ciudad) ?>"
            required
        >

        <button type="submit">
            Guardar contacto
        </button>

    </form>

    <a href="panel.php" class="volver">
        Volver a mi agenda
    </a>

</div>

</body>
</html>
