<?php
session_start();
include 'conexion.php';

// Obtener productos de la base de datos
$query = "SELECT * FROM productos";
$productos = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos - TechNova</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Estilos específicos para productos.php */
        .productos-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .productos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .producto-card {
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .producto-card:hover {
            transform: translateY(-5px);
        }

        .producto-imagen {
            width: 100%;
            height: 200px;
            object-fit: contain;
            background: #f5f5f5;
            padding: 20px;
        }

        .producto-info {
            padding: 20px;
        }

        .producto-nombre {
            font-size: 1.1rem;
            margin-bottom: 10px;
            color: #333;
        }

        .producto-precio {
            font-weight: bold;
            color: #2c3e50;
            font-size: 1.2rem;
            margin-bottom: 15px;
        }

        .producto-acciones {
            display: flex;
            justify-content: space-between;
        }

        .btn-carrito {
            background: #3498db;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-carrito:hover {
            background: #2980b9;
        }

        .btn-detalles {
            background: #f1c40f;
            color: #333;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-detalles:hover {
            background: #f39c12;
        }

        .titulo-seccion {
            text-align: center;
            margin-bottom: 30px;
            color: #2c3e50;
        }
    </style>
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

    <div class="productos-container">
        <h1 class="titulo-seccion">Nuestros Productos</h1>
        
        <div class="productos-grid">
            <?php while($producto = $productos->fetch_assoc()): ?>
                <div class="producto-card">
                    <img src="imagenes/productos/<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>" class="producto-imagen">
                    <div class="producto-info">
                        <h3 class="producto-nombre"><?php echo $producto['nombre']; ?></h3>
                        <p class="producto-precio">$<?php echo number_format($producto['precio'], 2); ?></p>
                        <div class="producto-acciones">
                            <form action="agregar_carrito.php" method="POST">
                                <input type="hidden" name="producto_id" value="<?php echo $producto['id']; ?>">
                                <button type="submit" class="btn-carrito">Añadir al carrito</button>
                            </form>
                            <a href="detalles_producto.php?id=<?php echo $producto['id']; ?>" class="btn-detalles">Ver detalles</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <footer class="footer">
      © 2025 TechNova | Todos los derechos reservados
    </footer>
</body>
</html>