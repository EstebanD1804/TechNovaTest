<?php
if ($_SERVER['HTTP_HOST'] == 'localhost') {
    // Configuración para XAMPP (local)
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $dbname = 'technova_db';
} else {
    // Configuración para InfinityFree (producción)
    $host     = 'sql310.infinityfree.com'; // MySQL Host Name
    $user     = 'if0_39085829';           // MySQL User Name
    $password = 'VeZwIwl0Umivh';   // Usa la contraseña de tu vPanel (la misma que usas para entrar a InfinityFree)
    $dbname   = 'if0_39085829_technova_db'; // MySQL DB Name
}

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
