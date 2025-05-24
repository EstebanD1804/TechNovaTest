<?php
session_start();
include 'conexion.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars($_POST["nombre"]);
    $correo = htmlspecialchars($_POST["correo"]);
    $mensaje = htmlspecialchars($_POST["mensaje"]);

    // Aquí puedes cambiar tu correo real:
    $para = "19progcadlo@gmail.com";
    $asunto = "Nuevo mensaje de contacto de $nombre";
    $cuerpo = "Nombre: $nombre\nCorreo: $correo\nMensaje:\n$mensaje";

    // Enviar correo (si InfinityFree lo permite)
    $enviado = mail($para, $asunto, $cuerpo);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Contacto</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <section class="contact-section">
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && $enviado): ?>
            <h2>¡Gracias por tu mensaje, <?= $nombre ?>!</h2>
            <p>Hemos recibido tu mensaje correctamente y te responderemos pronto.</p>
            <a href="index.html" class="btn">Volver al inicio</a>
        <?php elseif ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
            <h2>Ocurrió un error al enviar el mensaje</h2>
            <p>Por favor, intenta más tarde o verifica los datos ingresados.</p>
            <a href="index.html" class="btn">Volver</a>
        <?php else: ?>
            <h2>Contáctanos</h2>
            <p>Estamos aquí para ayudarte con tus necesidades de hardware.</p>

            <form action="contacto.php" method="POST" class="contact-form">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" required>

                <label for="correo">Correo</label>
                <input type="email" id="correo" name="correo" required>

                <label for="mensaje">Mensaje</label>
                <textarea id="mensaje" name="mensaje" rows="5" required></textarea>

                <div class="terms">
                    <input type="checkbox" id="terminos" required>
                    <label for="terminos">Acepto los Términos</label>
                </div>

                <button type="submit" class="btn dark">Enviar</button>
            </form>
        <?php endif; ?>
    </section>
</body>

</html>