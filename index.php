<?php
session_start();
include 'conexion.php';

// Verifica el parámetro GET primero
if (isset($_GET['logout']) && $_GET['logout'] === 'success') {
    echo '<div class="logout-message" style="
        color: white;
        padding: 10px;
        margin: 20px auto;
        text-align: center;
        background:rgb(41, 73, 219);
        border: 1px rgb(78, 36, 162);
        border-radius: 5px;
        max-width: 500px;
    ">Sesión cerrada correctamente</div>';
}

// Lógica de sesión
$isLoggedIn = isset($_SESSION['user_id']);
$userName = $isLoggedIn ? $_SESSION['user_name'] : 'Invitado';
?>


<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TechNova</title>
    <link rel="stylesheet" href="style.css" />
    <script src="script.js" defer></script>
  </head>
  <body>
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
        <a href="carrito.html" class="cart-icon">🛒</a>
      </div>
    </header>

    <section class="categories">
      <select onchange="location = this.value;">
        <option value="#" selected disabled>Prooductos</option>
        <option value="productos.html">Productos TechNova</option>
      </select>

      <select onchange="location = this.value;">
        <option value="#" selected disabled>Ofertas</option>
        <option value="ofertas.html">Ofertas Limitadas</option>
      </select>

      <select onchange="location = this.value;">
        <option value="#" selected disabled>Accesorios</option>
        <option value="accesorios.html">Accesorios</option>
      </select>
    </section>

    <main class="content">
     <h1>Bienvenido a TechNova, <?php echo $userName; ?></h1>
      <p>
        Explora nuestra amplia gama de hardware y encuentra lo que necesitas al
        mejor precio.
      </p>

      <section class="highlight">
        <div class="text">
          <h2>Descubre el hardware que necesitas hoy</h2>
          <p>
            En TechNova, ofrecemos una amplia gama de hardware de alta calidad a
            precios competitivos. Encuentra todo lo que necesitas para llevar tu
            experiencia tecnológica al siguiente nivel.
          </p>
          <button class="btn" onclick="window.location.href='ofertas.html'">Ver Productos</button>
          <button class="btn light" onclick="window.location.href='ofertas.html'">Explorar</button>
        </div>
        <div class="image">
          <img src="imagenes/hardware.avif" alt="Hardware de TechNova" />
        </div>
      </section>

      <section class="featured-section">
        <h2>Explora nuestras categorías de productos destacados</h2>
        <p>
          Descubre lo último en tecnología con nuestras categorías
          seleccionadas. Cada producto está diseñado para ofrecerte la mejor
          experiencia.
        </p>

        <div class="carousel-row" id="carousel-row">
          <div class="carousel-item">
            <img src="imagenes/monitor1.png" alt="Monitor ASUS" />
            <h3>Categorías que te encantarán explorar</h3>
            <p>
              Desde laptops hasta periféricos, tenemos todo lo que necesitas.
            </p>
          </div>
          <div class="carousel-item">
            <img src="imagenes/imagen1.png" alt="Audífonos Gaming" />
            <h3>Elige tu categoría favorita y comienza</h3>
            <p>Navega por nuestras opciones y encuentra lo mejor.</p>
          </div>
          <div class="carousel-item">
            <img src="imagenes/imagen2.jpg" alt="Teclado mecánico" />
            <h3>Tecnología avanzada para todos los gustos</h3>
            <p>Cada categoría está diseñada para satisfacer tus necesidades.</p>
          </div>
        </div>

        <div class="carousel-buttons">
          <button class="btn" onclick="window.location.href='ofertas.html'">Ver</button>
          <button class="btn light" onclick="window.location.href='ofertas.html'">Ver &gt;</button>Explorar &gt;</button>
        </div>
      </section>
      <section class="offers-section">
        <h2>Descubre nuestras mejores ofertas del mes</h2>
        <p>
          Aprovecha descuentos increíbles en productos seleccionados. ¡No te
          pierdas la oportunidad de equiparte con lo mejor!
        </p>

        <div class="offers-grid">
          <div>
            <h3>Productos<br />Destacados en Oferta</h3>
            <p>Encuentra tecnología de calidad a precios inigualables.</p>
          </div>
          <div>
            <h3>Aprovecha nuestras<br />ofertas limitadas</h3>
            <p>Las mejores marcas a tu alcance.</p>
          </div>
          <div>
            <h3>Tecnología avanzada<br />para todos los gustos</h3>
            <p>Compra ahora y ahorra en grande.</p>
          </div>
        </div>

        <div class="offers-buttons">
          <button class="btn" onclick="window.location.href='ofertas.html'">Comprar</button>
          <button class="btn light" onclick="window.location.href='ofertas.html'">Ver &gt;</button>
        </div>
      </section>
      <section class="contact-section">
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
    </section>
    <br>
    <br>
    <br>
    <section class="info-section">
      <div class="info-grid">
          <div>
              <img src="imagenes/email.png" alt="Correo" class="info-icon">
              <h3>Correo</h3>
              <p>Contáctanos para cualquier consulta o información adicional.</p>
              <a href="mailto:info@technova.com">info@technova.com</a>
          </div>
          <div>
              <img src="imagenes/phone.png" alt="Teléfono" class="info-icon">
              <h3>Teléfono</h3>
              <p>Estamos aquí para ayudarte con tus preguntas.</p>
              <a href="tel:+15551234567">+1 (555) 123-4567</a>
          </div>
          <div>
              <img src="imagenes/location.png" alt="Oficina" class="info-icon">
              <h3>Oficina</h3>
              <p>Visítanos en nuestra sede.</p>
              <a href="https://goo.gl/maps/ejemplo" target="_blank">456 Calle Ejemplo, Ciudad, PA 12345</a>
          </div>
      </div>
  </section>
  <br>
  <br>
  <br>
  <section class="subscribe-footer-section">
    <div class="subscribe-logo">
      <img src="logo.jpg" alt="Logo TechNova">
    </div>
    <div class="subscribe-form-container">
      <p>Suscríbete a nuestro boletín para estar al tanto de novedades y lanzamientos.</p>
      <form action="suscripcion.php" method="POST" class="subscribe-form">
        <input type="email" name="email" placeholder="Ingresa tu correo" required>
        <button type="submit" class="btn dark">Suscribirse</button>
      </form>
      <small>Al suscribirte, aceptas nuestra <a href="privacy.html">Política de Privacidad</a> y consientes recibir actualizaciones.</small>
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
    <script>
        setTimeout(() => {
        const msg = document.querySelector('.logout-message');
        if (msg) msg.remove();
            }, 2000);
    </script>
  </body>
</html>
