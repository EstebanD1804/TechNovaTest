<?php
session_start();
include 'conexion.php';

if (isset($_GET['id']) && isset($_SESSION['user_id'])) {
    $usuario_id = $_SESSION['user_id'];
    $producto_id = $_GET['id'];

    $conn->query("DELETE FROM carrito WHERE usuario_id = $usuario_id AND producto_id = $producto_id");
}

header("Location: carrito.php");
exit;
?>