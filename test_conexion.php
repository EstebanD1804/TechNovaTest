<?php
include 'conexion.php'; 
$query = "SELECT * FROM usuarios";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "✅ Conexión exitosa. Usuarios registrados: " . $result->num_rows;
} else {
    echo "⚠️ La tabla 'usuarios' está vacía, pero la conexión funciona.";
}
$conn->close();
?>