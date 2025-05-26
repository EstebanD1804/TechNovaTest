<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Cuenta - TechNova</title>
    <link rel="stylesheet" href="style.css"> <!-- Asegúrate de enlazar tu CSS -->
</head>
<body>
    <?php include 'header.php'; ?> <!-- Si tienes un header común -->

    <main class="mi-cuenta-container">
        <h1 class="mi-cuenta-titulo">Mi Cuenta</h1>
        
        <div class="mi-cuenta-info">
            <h2>Bienvenido, <?php echo htmlspecialchars($_SESSION['user_name']); ?></h2>
            <p><strong>Rol:</strong> <?php echo htmlspecialchars($_SESSION['user_role']); ?></p>
            <p><strong>Correo:</strong> <?php echo htmlspecialchars($_SESSION['user_email'] ?? 'No registrado'); ?></p>
        </div>

        <a href="logout.php" class="mi-cuenta-boton">Cerrar Sesión</a>
    </main>

    <?php include 'footer.php'; ?> <!-- Si tienes un footer común -->
</body>
</html>