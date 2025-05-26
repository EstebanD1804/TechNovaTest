<?php
$host     = 'localhost';
$user     = 'root';
$password = '';           // Por defecto XAMPP no pone contraseña a 'root'
$dbname   = 'technova_db';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

