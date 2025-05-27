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
    <?php
    // Determinar si el usuario está logueado
    $isLoggedIn = isset($_SESSION['user_id']);
    ?>
    <header class="topbar">
      <img src="imagenes/logo.jpg" alt="Logo TechNova" class="logo" />
      <nav class="nav-links">
        <a href="#">Inicio Rápido</a>
        <a href="#">Nuestras Ofertas</a>
        <a href="#">Soporte Técnico</a>
        <a href="#">Contáctanos</a>
      </nav>

      <div class="user-actions">
        <?php if ($isLoggedIn): ?>
        <button class="btn" onclick="window.location.href='mi_cuenta.php'">Mi Cuenta</button>
        <button class="btn dark" onclick="window.location.href='logout.php'">Cerrar Sesión</button>
        <?php else: ?>
        <button class="btn" onclick="window.location.href='login.php'">Login</button>
        <button class="btn dark" onclick="window.location.href='registro.php'">Regístrate</button>
        <?php endif; ?>
        <a href="carrito.php" class="cart-icon">🛒</a>
      </div>
    </header>

    <main class="mi-cuenta-container">
        <h1 class="mi-cuenta-titulo">Mi Cuenta</h1>
        
        <div class="mi-cuenta-info">
            <h2>Bienvenido, <?php echo htmlspecialchars($_SESSION['user_name']); ?></h2>
            <p><strong>Rol:</strong> <?php echo htmlspecialchars($_SESSION['user_role']); ?></p>
            <p><strong>Correo:</strong> <?php echo htmlspecialchars($_SESSION['user_email'] ?? 'No registrado'); ?></p>
        </div>

        <a href="logout.php" class="mi-cuenta-boton">Cerrar Sesión</a>
    </main>

   <footer class="footer">
      © 2025 TechNova | Todos los derechos reservados
    </footer>
</body>
</html>