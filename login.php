
<?php
session_start();
require_once "conexion.php";


if (isset($_SESSION["usuario_id"])) {
    header("Location: panel.php");
    exit;
}

$mensaje = "";
$correo = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $correo = trim($_POST["correo"] ?? "");
    $password = $_POST["password"] ?? "";

    if ($correo === "" || $password === "") {
        $mensaje = "Complete todos los campos.";

    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $mensaje = "Ingrese un correo válido.";

    } else {
        try {
            
            $sql = "SELECT id, nombre, correo, password
                    FROM usuarios
                    WHERE correo = ?";

            $stmt = $conexion->prepare($sql);
            $stmt->execute([$correo]);

            $usuario = $stmt->fetch();

            
            if ($usuario &&
                password_verify($password, $usuario["password"])) {

                session_regenerate_id(true);

                
                $_SESSION["usuario_id"] = $usuario["id"];
                $_SESSION["usuario_nombre"] = $usuario["nombre"];
                $_SESSION["usuario_correo"] = $usuario["correo"];

                header("Location: panel.php");
                exit;

            } else {
                $mensaje = "Correo o contraseña incorrectos.";
            }

        } catch (PDOException $e) {
            error_log($e->getMessage());
            $mensaje = "Ocurrió un error al iniciar sesión.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión - Agenda de contactos</title>

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

        .exito {
            color: #15803d;
            text-align: center;
        }

        p {
            text-align: center;
        }
    </style>
</head>

<body>

<div class="contenedor">

    <h2>Iniciar sesión</h2>

    <?php if (isset($_GET["registro"]) &&
              $_GET["registro"] === "exitoso"): ?>
        <p class="exito">
            Registro exitoso. Ya puedes iniciar sesión.
        </p>
    <?php endif; ?>

    <?php if ($mensaje !== ""): ?>
        <p class="error">
            <?= htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8') ?>
        </p>
    <?php endif; ?>

    <form method="POST">

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
            placeholder="Contraseña"
            required
        >

        <button type="submit">
            Iniciar sesión
        </button>

    </form>

    <p>
        ¿No tienes una cuenta?
        <a href="registro.php">Regístrate aquí</a>
    </p>

</div>

</body>
</html>
