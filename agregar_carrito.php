<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['producto_id'])) {
    $usuario_id = $_SESSION['user_id'];
    $producto_id = $_POST['producto_id'];

    // Verificar si el producto ya está en el carrito
    $check_query = "SELECT * FROM carrito WHERE usuario_id = ? AND producto_id = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("ii", $usuario_id, $producto_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Actualizar cantidad
        $update_query = "UPDATE carrito SET cantidad = cantidad + 1 WHERE usuario_id = ? AND producto_id = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("ii", $usuario_id, $producto_id);
        $stmt->execute();
    } else {
        // Insertar nuevo
        $insert_query = "INSERT INTO carrito (usuario_id, producto_id) VALUES (?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("ii", $usuario_id, $producto_id);
        $stmt->execute();
    }
}

header("Location: productos.php");
exit;
