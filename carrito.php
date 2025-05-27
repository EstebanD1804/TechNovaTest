<?php
session_start();
include 'conexion.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Obtener productos del carrito desde la BD
$usuario_id = $_SESSION['user_id'];
$query = "SELECT p.*, c.cantidad 
          FROM carrito c
          JOIN productos p ON c.producto_id = p.id
          WHERE c.usuario_id = $usuario_id";
$carrito_items = $conn->query($query);
$total = 0;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Carrito - TechNova</title>
    <link rel="stylesheet" href="style.css" />
    <script src="script.js" defer></script>
</head>

<body>
    <header class="topbar">
        <img src="logo.jpg" alt="Logo TechNova" class="logo" />
        <nav class="nav-links">
            <a href="index.php">Inicio Rápido</a>
            <a href="#">Nuestras Ofertas</a>
            <a href="#">Soporte Técnico</a>
            <a href="#">Contáctanos</a>
        </nav>
        <div class="user-actions">
            <?php if (isset($_SESSION['user_id'])): ?>
                <span>¡Hola, <?php echo $_SESSION['user_name']; ?>!</span>
                <a href="mi_cuenta.php" class="btn">Mi Cuenta</a>
                <a href="logout.php" class="btn dark">Cerrar Sesión</a>
            <?php else: ?>
                <a href="login.php" class="btn">Entrar</a>
                <a href="registro.php" class="btn dark">Regístrate</a>
            <?php endif; ?>
            <a href="carrito.php" class="cart-icon">🛒</a>
        </div>
    </header>

    <main class="content">
        <h1>Tu Carrito de Compras</h1>

        <?php if ($carrito_items->num_rows > 0): ?>
            <section class="cart-items">
                <table>
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($item = $carrito_items->fetch_assoc()):
                            $subtotal = $item['precio'] * $item['cantidad'];
                            $total += $subtotal;
                        ?>
                            <tr>
                                <td>
                                    <img src="imagenes/<?php echo $item['imagen']; ?>" width="50">
                                    <?php echo $item['nombre']; ?>
                                </td>
                                <td>$<?php echo number_format($item['precio'], 2); ?></td>
                                <td>
                                    <form action="actualizar_carrito.php" method="POST">
                                        <input type="hidden" name="producto_id" value="<?php echo $item['id']; ?>">
                                        <input type="number" name="cantidad" value="<?php echo $item['cantidad']; ?>" min="1">
                                        <button type="submit">Actualizar</button>
                                    </form>
                                </td>
                                <td>$<?php echo number_format($subtotal, 2); ?></td>
                                <td>
                                    <a href="eliminar_carrito.php?id=<?php echo $item['id']; ?>" class="btn-eliminar">Eliminar</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>

                <div class="cart-total">
                    <h3>Total: $<?php echo number_format($total, 2); ?></h3>
                    <a href="checkout.php" class="btn-comprar">Finalizar Compra</a>
                </div>
            </section>
        <?php else: ?>
            <p>Tu carrito está vacío. <a href="productos.php">¡Explora nuestros productos!</a></p>
        <?php endif; ?>
        <br />
        <br />


        <section class="cart-review">
            <div class="container">
                <h2>Resumen de tu compra: conoce el total y los detalles aquí.</h2>
                <br /><br />
                <div class="cart-features">
                    <div class="feature">
                        <h3>Productos Destacados en Oferta</h3>
                        <p>Aquí puedes revisar el subtotal y el total de tu compra.</p>
                        <button class="btn light">Finalizar &gt;</button>
                    </div>
                    <div class="feature">
                        <h3>Aprovecha nuestras ofertas limitadas</h3>
                        <p>
                            Asegúrate de que todo esté correcto antes de completar tu
                            compra.
                        </p>
                        <button class="btn light">Agregar &gt;</button>
                    </div>
                    <div class="feature">
                        <h3>Tecnología avanzada para todos los gustos</h3>
                        <p>
                            Selecciona tu método de pago preferido y confirma tu dirección
                            de envío.
                        </p>
                        <button class="btn light">Confirmar &gt;</button>
                    </div>
                </div>
            </div>
        </section>

        <section class="info-section">
            <div class="info-grid">
                <div>
                    <img src="imagenes/email.png" alt="Correo" class="info-icon" />
                    <h3>Correo</h3>
                    <p>Contáctanos para cualquier consulta o información adicional.</p>
                    <a href="mailto:info@technova.com">info@technova.com</a>
                </div>
                <div>
                    <img src="imagenes/phone.png" alt="Teléfono" class="info-icon" />
                    <h3>Teléfono</h3>
                    <p>Estamos aquí para ayudarte con tus preguntas.</p>
                    <a href="tel:+15551234567">+1 (555) 123-4567</a>
                </div>
                <div>
                    <img src="imagenes/location.png" alt="Oficina" class="info-icon" />
                    <h3>Oficina</h3>
                    <p>Visítanos en nuestra sede.</p>
                    <a href="https://goo.gl/maps/ejemplo" target="_blank">456 Calle Ejemplo, Ciudad, PA 12345</a>
                </div>
            </div>
        </section>

        <br />
        <br />
        <br />
        <section class="subscribe-footer-section">
            <div class="subscribe-logo">
                <img src="imagenes/logo.jpg" alt="Logo TechNova" />
            </div>
            <div class="subscribe-form-container">
                <p>
                    Suscríbete a nuestro boletín para estar al tanto de novedades y
                    lanzamientos.
                </p>
                <form action="suscripcion.php" method="POST" class="subscribe-form">
                    <input
                        type="email"
                        name="email"
                        placeholder="Ingresa tu correo"
                        required />
                    <button type="submit" class="btn dark">Suscribirse</button>
                </form>
                <small>Al suscribirte, aceptas nuestra
                    <a href="privacy.html">Política de Privacidad</a> y consientes
                    recibir actualizaciones.</small>
            </div>
            <div class="footer-nav">
                <div>
                    <h4>COMPANY</h4>
                    <ul>
                        <li><a href="howitworks.html">How It Works</a></li>
                        <li><a href="pricing.html">Pricing</a></li>
                        <li><a href="docs.html">Docs</a></li>
                    </ul>
                </div>
                <div>
                    <h4>ABOUT</h4>
                    <ul>
                        <li><a href="terms.html">Terms & Conditions</a></li>
                        <li><a href="privacy.html">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="social-links">
                    <a href="https://twitter.com/tuempresa" target="_blank">🐦</a>
                    <a href="https://linkedin.com/company/tuempresa" target="_blank">🔗</a>
                    <a href="https://facebook.com/tuempresa" target="_blank">📘</a>
                </div>
            </div>
        </section>

    </main>

    <footer class="footer">
        © 2025 TechNova | Todos los derechos reservados
    </footer>
</body>

</html>