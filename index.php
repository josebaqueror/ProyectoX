<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tienda</title>
  <link rel="icon" type="image/png" href="images/logo.webp">
  <link rel="stylesheet" href="style.css">

</head>
<body>

    <section class="header-top">
    <div class="top-3">
    <div>Email: <a href="mailto:contacto@tienda.com" class="head-link">contacto@tienda.com</a></div>
    <div>Teléfono: <a href="tel:3112586589" class="head-link">3112586589</a></div>
    </div>
        
        <div class="top-2">
            <ul>
                <li><a href="https://web.whatsapp.com/" class="social"><img src="images/whatsapp.png"></a></li>
                <li><a href="https://facebook.com/" class="social"><img src="images/facebook.png"></a></li>
                <li><a href="https://instagram.com/" class="social"><img src="images/instagram.png"></a></li>
                <li><button id="abrir-carrito"><img src="images/shopping-cart.png" class="cart-img"></button></li>
            </ul>
        </div>
        
    </section>
    <header>
        <div class="logo">
            <img src="images/logo.webp" width="190" height="100"/></>
        </div>
        <div class="menu">
        <nav>
          <ul>            
            <li><a href="index.php">Productos</a></li>
            <li><a href="contactenos.html">Contáctenos</a></li>
            <li><a href="login.html">Inicio de sesión</a></li>
          </ul>
        </nav>
        </div>
      </header>
        <main>
        <h1 class="title-page">Tecnología<span>.</span></h1>
        <section class="productos">
          <?php
    // Aquí se realizaría la conexión a tu base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "proyectox";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $database);

    

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consulta para obtener la lista de productos
    $sql = "SELECT nombre_producto, precio, imagen FROM producto";
    $result = $conn->query($sql);
    


    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<article class="producto">';
            echo '<img src="' . $row["imagen"] . '" alt="' . htmlspecialchars($row["nombre_producto"]) . '" class="img-producto">';
            echo '<h2>' . htmlspecialchars($row["nombre_producto"]) . '</h2>';
            echo '<p>$ <span>' . number_format($row["precio"], 0, ',', '.') . '</span></p>';
            echo '<button id="comprar-btn">Agregar al carrito</button>';
            echo '</article>';
        }
    } else {
        echo "No hay productos disponibles.";
    }

    // Cerrar la conexión
    $conn->close();
    ?>
        </section>
        
    <div id="carrito-popup" class="carrito-popup">
        <div class="carrito-contenido">
            <h2>Carrito de Compras</h2>
            <ul id="lista-carrito">
                <!-- Productos seleccionados se agregarán aquí dinámicamente -->
            </ul>
            <div id="subtotal"></div>
            <div id="total"></div>
            <button id="cerrar-carrito">Cerrar Carrito</button>
            <button id="realizar-compra-btn">Realizar Compra</button>
        </div>
    </div>
       
      </main>
      
      <footer>
        <p>&copy; 2024 Tienda en Línea. Todos los derechos reservados.</p>
      </footer>
      <script src="script.js"></script>

      <script>
        document.addEventListener('DOMContentLoaded', () => { const abrirCarrito = document.getElementById('abrir-carrito');
          const cerrarCarrito = document.getElementById('cerrar-carrito');
          const carritoPopup = document.getElementById('carrito-popup');
    
          abrirCarrito.addEventListener('click', () => {
            carritoPopup.style.display = 'flex';
          });
    
          cerrarCarrito.addEventListener('click', () => {
            carritoPopup.style.display = 'none';
          });
    
          const productos = document.querySelectorAll('.producto');
    
          productos.forEach(producto => {
            const comprarBtn = producto.querySelector('.comprar-btn');
            const nombreProducto = producto.querySelector('h2').innerText;
            const precioProducto = producto.querySelector('span').innerText;
    
            comprarBtn.addEventListener('click', () => {
              const listaCarrito = document.getElementById('lista-carrito');
              const nuevoItem = document.createElement('li');
              nuevoItem.innerHTML = `${nombreProducto} - $${precioProducto}`;
              listaCarrito.appendChild(nuevoItem);
            });
          });
        });
      </script>
</body>
</html>
