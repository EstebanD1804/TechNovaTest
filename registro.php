<?php
session_start();
include 'conexion.php';

$nombre = $email = $rol = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre   = trim($_POST['nombre']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm  = $_POST['confirm_password'];
    $rol      = $_POST['rol'];

    // 1. Validaciones básicas
    if (!$nombre || !$email || !$password || !$confirm) {
        $errors[] = "Todos los campos son obligatorios.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Correo no válido.";
    } elseif ($password !== $confirm) {
        $errors[] = "Las contraseñas no coinciden.";
    }

    // 2. Verificar que no exista el correo
    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT id FROM usuarios WHERE correo = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $errors[] = "Ese correo ya está registrado.";
        }
        $stmt->close();
    }

    // 3. Insertar nuevo usuario
    if (empty($errors)) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare(
            "INSERT INTO usuarios (nombre, correo, password, rol) VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param("ssss", $nombre, $email, $hash, $rol);
        if ($stmt->execute()) {
            header("Location: login.php?registro=ok");
            exit;
        } else {
            $errors[] = "Error al registrar. Intenta de nuevo.";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro - TechNova</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <section class="contact-section">
        <h2>Registro de Usuario</h2>

        <?php if ($errors): ?>
            <div class="error-messages">
                <?php foreach ($errors as $e): ?>
                    <p style="color:red;"><?= $e ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form action="registro.php" method="POST" class="contact-form">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" value="<?= htmlentities($nombre) ?>" required>

            <label for="email">Correo</label>
            <input type="email" id="email" name="email" value="<?= htmlentities($email) ?>" required>

            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm_password">Confirmar Contraseña</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <label for="rol">Rol</label>
            <select id="rol" name="rol" required>
                <option value="cliente" <?= $rol === 'cliente' ? 'selected' : '' ?>>Cliente</option>
                <option value="administrador" <?= $rol === 'administrador' ? 'selected' : '' ?>>Administrador</option>
            </select>

            <button type="submit" class="btn dark">Registrarme</button>
        </form>
        <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a></p>
    </section>
</body>

</html>