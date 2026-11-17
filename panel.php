
<?php
session_start();
require_once "conexion.php";


if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit;
}
if (empty($_SESSION["csrf_token"])) {
    $_SESSION["csrf_token"] = bin2hex(random_bytes(32));
}

$id_usuario = $_SESSION["usuario_id"];
$nombre_usuario = $_SESSION["usuario_nombre"];
$correo_usuario = $_SESSION["usuario_correo"];


$sql = "SELECT id, nombre, telefono, correo, ciudad
        FROM contactos
        WHERE id_usuario = ?
        ORDER BY nombre ASC";

$stmt = $conexion->prepare($sql);
$stmt->execute([$id_usuario]);
$contactos = $stmt->fetchAll();


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

    <title>Mi agenda de contactos</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f2f5;
            margin: 0;
        }

        header {
            background: #2563eb;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .contenedor {
            max-width: 1000px;
            margin: 30px auto;
            padding: 20px;
        }

        .tarjeta {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 4px 12px #0001;
        }

        .boton {
            display: inline-block;
            background: #2563eb;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            margin: 5px 5px 5px 0;
        }

        .boton:hover {
            background: #1d4ed8;
        }

        .salir {
            background: #dc2626;
        }

        .salir:hover {
            background: #b91c1c;
        }

        .tabla-contenedor {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background: #2563eb;
            color: white;
        }

        tr:nth-child(even) {
            background: #f9fafb;
        }
    </style>
</head>

<body>

<header>
    <h1>Mi agenda personal de contactos</h1>
</header>

<div class="contenedor">

    <div class="tarjeta">
        <h2>
            Bienvenido,
            <?= escapar($nombre_usuario) ?>
        </h2>

        <p>
            <strong>Correo:</strong>
            <?= escapar($correo_usuario) ?>
        </p>

        <a href="agregar_contacto.php" class="boton">
            + Agregar contacto
        </a>

        <a href="logout.php" class="boton salir">
            Cerrar sesión
        </a>
    </div>

    <div class="tarjeta">

        <h2>Mis contactos</h2>

        <?php if (count($contactos) === 0): ?>

            <p>
                Todavía no tienes contactos registrados.
            </p>

        <?php else: ?>

            <div class="tabla-contenedor">
                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Teléfono</th>
                            <th>Correo</th>
                            <th>Ciudad</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php foreach ($contactos as $contacto): ?>
                        <tr>
                            <td>
                                <?= escapar($contacto["nombre"]) ?>
                            </td>

                            <td>
                                <?= escapar($contacto["telefono"]) ?>
                            </td>

                            <td>
                                <?= escapar($contacto["correo"]) ?>
                            </td>

                            <td>
                                <?= escapar($contacto["ciudad"]) ?>
                            </td>

                           <td>
    <a href="editar_contacto.php?id=<?= (int)$contacto["id"] ?>">
        Editar
    </a>

    <form
        action="eliminar_contacto.php"
        method="POST"
        style="display:inline;"
        onsubmit="return confirm('¿Estás seguro de eliminar este contacto?');"
    >

        <input
            type="hidden"
            name="id"
            value="<?= (int)$contacto["id"] ?>"
        >

        <input
            type="hidden"
            name="csrf_token"
            value="<?= escapar($_SESSION["csrf_token"]) ?>"
        >

        <button
            type="submit"
            style="
                background:#dc2626;
                color:white;
                border:none;
                padding:8px 12px;
                border-radius:5px;
                cursor:pointer;
                margin-left:8px;
            "
        >
            Eliminar
        </button>

    </form>
</td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        <?php endif; ?>

    </div>

</div>

</body>
</html>
