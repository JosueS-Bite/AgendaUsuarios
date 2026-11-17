
<?php
require_once "conexion.php";

$mensaje = "";
$nombre = "";
$correo = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nombre = trim($_POST["nombre"] ?? "");
    $correo = trim($_POST["correo"] ?? "");
    $password = $_POST["password"] ?? "";

    if ($nombre === "" || $correo === "" || $password === "") {
        $mensaje = "Todos los campos son obligatorios.";

    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $mensaje = "Ingrese un correo electrónico válido.";

    } elseif (strlen($password) < 8) {
        $mensaje = "La contraseña debe tener al menos 8 caracteres.";

    } else {
        try {
            
            $sql = "SELECT id FROM usuarios WHERE correo = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->execute([$correo]);

            if ($stmt->fetch()) {
                $mensaje = "Este correo ya está registrado.";

            } else {
                
                $password_segura = password_hash(
                    $password,
                    PASSWORD_DEFAULT
                );

                
                $sql = "INSERT INTO usuarios
                        (nombre, correo, password)
                        VALUES (?, ?, ?)";

                $stmt = $conexion->prepare($sql);
                $stmt->execute([
                    $nombre,
                    $correo,
                    $password_segura
                ]);

                header("Location: login.php?registro=exitoso");
                exit;
            }

        } catch (PDOException $e) {
            error_log($e->getMessage());
            $mensaje = "No se pudo completar el registro.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de usuarios</title>
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
            width: 350px;
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

        .error {
            color: #b91c1c;
            text-align: center;
        }

        p {
            text-align: center;
        }
    </style>
</head>
<body>

<div class="contenedor">
    <h2>Crear cuenta</h2>

    <?php if ($mensaje !== ""): ?>
        <p class="error">
            <?= htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8') ?>
        </p>
    <?php endif; ?>

    <form method="POST">
        <input
            type="text"
            name="nombre"
            placeholder="Nombre completo"
            value="<?= htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8') ?>"
            required
        >

        <input
            type="email"
            name="correo"
            placeholder="Correo electrónico"
            value="<?= htmlspecialchars($correo, ENT_QUOTES, 'UTF-8') ?>"
            required
        >

        <input
            type="password"
            name="password"
            placeholder="Contraseña (mínimo 8 caracteres)"
            required
        >

        <button type="submit">Registrarse</button>
    </form>

    <p>
        ¿Ya tienes una cuenta?
        <a href="login.php">Iniciar sesión</a>
    </p>
</div>

</body>
</html>
