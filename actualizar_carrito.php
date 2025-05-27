<?php
session_start();
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    $usuario_id = $_SESSION['user_id'];
    $producto_id = $_POST['producto_id'];
    $cantidad = $_POST['cantidad'];

    $stmt = $conn->prepare("UPDATE carrito SET cantidad = ? WHERE usuario_id = ? AND producto_id = ?");
    $stmt->bind_param("iii", $cantidad, $usuario_id, $producto_id);
    $stmt->execute();
}

header("Location: carrito.php");
exit;
?>