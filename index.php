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
    
    <div class="logo">
            <img src="images/logo.webp" width="190" height="100"/></>
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
       
        <div class="menu">
        <nav>
          <ul>            
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
    $sql = "SELECT id_producto, nombre_producto, precio, imagen, referencia FROM producto";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<article class="producto" data-referencia="' . $row["referencia"] . '" data-nombre="' . htmlspecialchars($row["nombre_producto"]) . '" data-precio="' . $row["precio"] . '">';
            echo '<img src="' . $row["imagen"] . '" alt="' . htmlspecialchars($row["nombre_producto"]) . '" class="img-producto">';
            echo '<h2>' . htmlspecialchars($row["nombre_producto"]) . '</h2>';
            echo '<p>$ <span>' . number_format($row["precio"], 0, ',', '.') . '</span></p>';
            echo '<button class="comprar-btn">Agregar al carrito</button>';
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
      <div class="resumen-carrito">
        <p id="subtotal">Subtotal: $0</p>
        <p id="total">Total: $0</p>
      </div>
      <div class="botones-carrito">
        <button id="cerrar-carrito" class="btn">Cerrar Carrito</button>
        <button id="realizar-compra-btn" class="btn btn-compra">Realizar Compra</button>
      </div>
    </div>
  </div>
  <script src="script.js"></script>
  </main>
  
      
      <footer>
        <p>&copy; 2024 Tienda en Línea. Todos los derechos reservados.</p>
        <div class="top-3">
    <div>Email: <a href="mailto:contacto@tienda.com" class="head-link">contacto@tienda.com</a></div>
    <div>Teléfono: <a href="tel:3112586589" class="head-link">3112586589</a></div>
    </div>
      </footer>

      <script>
        document.addEventListener('DOMContentLoaded', () => {
    const abrirCarrito = document.getElementById('abrir-carrito');
    const cerrarCarrito = document.getElementById('cerrar-carrito');
    const carritoPopup = document.getElementById('carrito-popup');
    const listaCarrito = document.getElementById('lista-carrito');
    const subtotalElem = document.getElementById('subtotal');
    const totalElem = document.getElementById('total');
    const realizarCompraBtn = document.getElementById('realizar-compra-btn');

    let carrito = [];

    abrirCarrito.addEventListener('click', () => {
        carritoPopup.style.display = 'flex';
        actualizarCarrito();
    });

    cerrarCarrito.addEventListener('click', () => {
        carritoPopup.style.display = 'none';
    });

    const productos = document.querySelectorAll('.producto');

    productos.forEach(producto => {
        const comprarBtn = producto.querySelector('.comprar-btn');
        const idProducto = producto.getAttribute('data-referencia');
        const nombreProducto = producto.getAttribute('data-nombre');
        const precioProducto = parseFloat(producto.getAttribute('data-precio'));

        comprarBtn.addEventListener('click', () => {
            agregarAlCarrito(idProducto, nombreProducto, precioProducto);
        });
    });

    function agregarAlCarrito(id, nombre, precio) {
        const productoExistente = carrito.find(producto => producto.id === id);
        if (productoExistente) {
            productoExistente.cantidad += 1;
        } else {
            carrito.push({ id, nombre, precio, cantidad: 1 });
        }
        actualizarCarrito();
    }

    function quitarDelCarrito(id) {
        carrito = carrito.filter(producto => producto.id !== id);
        actualizarCarrito();
    }

    function actualizarCarrito() {
        listaCarrito.innerHTML = '';
        let subtotal = 0;

        carrito.forEach(producto => {
            const nuevoItem = document.createElement('li');
            nuevoItem.innerHTML = `
                ${producto.nombre} - $${producto.precio.toFixed(2)} x ${producto.cantidad}
                <button onclick="quitarDelCarrito('${producto.id}')">Quitar</button>`;
            listaCarrito.appendChild(nuevoItem);
            subtotal += producto.precio * producto.cantidad;
        });

        subtotalElem.innerHTML = `Subtotal: $${subtotal.toFixed(2)}`;
        totalElem.innerHTML = `Total: $${subtotal.toFixed(2)}`;
    }
  /*  <button id="realizar-compra-btn" class="btn btn-compra">RealizarCompra</button>*/
    realizarCompraBtn.addEventListener('click', () => {
        realizarCompra();
    });

    function realizarCompra() {
        const usuarioId = 1; // Obtén el ID del usuario de la sesión actual
        const fecha = new Date().toISOString().slice(0, 19).replace('T', ' ');
        const total = carrito.reduce((acc, producto) => acc + producto.precio * producto.cantidad, 0);

        fetch('realizar_compra.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ usuario_id: usuarioId, fecha, total, carrito }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Compra realizada con éxito');
                carrito = [];
                actualizarCarrito();
                carritoPopup.style.display = 'none';
            } else {
                alert('Hubo un problema al realizar la compra');
            }
        });
    }

    window.quitarDelCarrito = quitarDelCarrito;
});

      </script>
</body>
</html>
