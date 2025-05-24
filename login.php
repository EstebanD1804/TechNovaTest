<?php
session_start();
include 'conexion.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    if (!$email || !$password) {
        $error = "Ambos campos son obligatorios.";
    } else {
        $stmt = $conn->prepare(
            "SELECT id, nombre, password, rol FROM usuarios WHERE correo = ?"
        );
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($id, $nombre, $hash, $rolDB);
        if ($stmt->fetch() && password_verify($password, $hash)) {
            // Credenciales correctas
            $_SESSION['user_id']   = $id;
            $_SESSION['user_name'] = $nombre;
            $_SESSION['user_role'] = $rolDB;
            header("Location: index.html");
            exit;
        } else {
            $error = "Correo o contraseña incorrectos.";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Login - TechNova</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <section class="contact-section">
        <h2>Iniciar Sesión</h2>

        <?php if ($error): ?>
            <p style="color:red;"><?= $error ?></p>
        <?php elseif (isset($_GET['registro']) && $_GET['registro'] === 'ok'): ?>
            <p style="color:green;">Registro exitoso, por favor inicia sesión.</p>
        <?php endif; ?>

        <form action="login.php" method="POST" class="contact-form">
            <label for="email">Correo</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" class="btn dark">Entrar</button>
        </form>
        <p>¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a></p>
    </section>
</body>

</html>