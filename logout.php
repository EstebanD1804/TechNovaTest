<?php
session_start();
include 'conexion.php';

// Destruye la sesión completamente
session_unset();    // Elimina todas las variables de sesión
session_destroy();  // Destruye la sesión

// Redirige con parámetro GET
header("Location: index.php?logout=success");
exit;
?>