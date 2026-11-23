
<?php
session_start();

if (isset($_SESSION['usuario_id'])) {
    header("Location: panel.php");
    exit();
} else {
    header("Location: login.php");
    exit();
}
?>
