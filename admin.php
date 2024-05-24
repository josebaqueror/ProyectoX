<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Tecnología</title>
    <link rel="icon" type="image/icon" href="images/favicon.ico">
    <link rel="stylesheet" href="styleIndex.css">
</head>
<body>
    <section class="header-top" style="background-color:#fff">
    <div class="top-1"> T&eacute;lefono: <a href="tel:3112586589" class="head-link">3112586589</a></div>
        <div class="top-2">
            <ul>
                <li><a href="https://web.whatsapp.com/" class="social"><img src="images/whatsapp.png"></a></li>
                <li><a href="https://facebook.com/" class="social"><img src="images/facebook.png"></a></li>
                <li><a href="https://instagram.com/" class="social"><img src="images/instagram.png"></a></li>
                <button id="abrir-carrito"><img src="images/shopping-cart2.png" class="cart-img"></button>
                <a href="login.html" class="inicioSesion"><img src="images/usuario.png" height="30px">Login</a>
            </ul>
        </div>
        <div class="top-3">Email: <a href="mailto:contacto@tienda.com" class="head-link">contacto@tienda.com</a></div>
    </section>
    <header>
    <div class="logo">
            <a href="index.php"><img src="images/Logo_helpscol.webp" class="logo"/></a>
        </div>
        <div class="menu">
        <!--tabla de productos-->
        <nav>
          <ul>            
            <li><a href="index.php">Productos</a></li>
            <li><a href="contactenos.html">Contáctenos</a></li>
          </ul>
        </nav>
        </div>
    </header>

  <link rel="stylesheet" href="styleAdmin.css">
</head>  
<main style="height: 75vh">
    <h1 style="color: #000; text-align:center">Bienvenido Administrador</h1>
    <div class="container" style="padding-top: 25px">
    <a href="editar_productos.php" class="button">Editar Producto</a>
    <a href="Crear_producto.html" class="button">Agregar Productos</a>
    <a href="ventas_realizadas.php" class="button">Ventas Realizadas</a>
    <a href="listar_productos.php" class="button">Ver Productos</a>
  </div>   
</main>
<footer>
  <p>&copy; 2024 Tienda en Línea. Todos los derechos reservados.</p>
</footer>
</body> 
</html>
