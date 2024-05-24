<?php
// Iniciar o reanudar la sesión
session_start();

// Verificar si existe un carrito en la sesión, si no, crear uno
if(!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}

// Función para agregar un producto al carrito
function agregarAlCarrito($id, $producto, $precio) {
    $item = array('id' => $id, 'producto' => $producto, 'precio' => $precio);
    array_push($_SESSION['carrito'], $item);
}

// Función para calcular el subtotal del carrito
function calcularSubtotal() {
    $subtotal = 0;
    foreach ($_SESSION['carrito'] as $item) {
        $subtotal += $item['precio'];
    }
    return $subtotal;
}

// Función para calcular el total del carrito
function calcularTotal() {
    $total = calcularSubtotal();
    // Se agrega el IVA DEL 19%
    $total += $total * 0.19;
    return $total;
}

// Manejar la acción de agregar al carrito si se envía desde el formulario
if(isset($_POST['agregar'])) {
    $id = $_POST['id'];
    $producto = $_POST['producto'];
    $precio = $_POST['precio'];
    agregarAlCarrito($id, $producto, $precio);
}

// Configuración de la conexión a la base de datos
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

// Consultar los productos desde MySQL
$productos = array();
$sql = "SELECT * FROM producto";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $productos[] = $row;
    }
}

// Cerrar la conexión
$conn->close();
?>

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
    <section class="header-top">
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
    <main>
        <!-- Tu código HTML para la sección de productos -->
        <section class="productos">
            <?php foreach ($productos as $producto): ?>
                <article class="producto">
                    <img src="<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre_producto']; ?>" class="img-produucto"/>
                    <h2><?php echo $producto['nombre_producto']; ?></h2>
                    <p><strong>Referencia: </strong><?php echo $producto['referencia']; ?></p>
                    <p><strong>Stock: </strong><?php echo $producto['cantidad_producto']; ?></p>
                    <p><strong>Precio: $</strong><?php echo $producto['precio']; ?></p>
                    <form method="post">
                        <input type="hidden" name="id" value="<?php echo $producto['referencia']; ?>">
                        <input type="hidden" name="producto" value="<?php echo $producto['nombre_producto']; ?>">
                        <input type="hidden" name="precio" value="<?php echo $producto['precio']; ?>">
                        <button type="submit" name="agregar" id="comprar-btn">Agregar al carrito</button>
                    </form>
                </article>
            <?php endforeach; ?>
        </section>

        <!-- Pop-up del carrito de compras -->
        <div id="carrito-popup" class="carrito-popup">
    <div class="carrito-contenido">
        <h2>Carrito de Compras</h2>
        <ul id="lista-carrito">
            <?php
            // Mostrar los productos en el carrito
            foreach ($_SESSION['carrito'] as $key => $item) {
                echo "<li>{$item['producto']} - $ {$item['precio']} ";
                echo "<form method='post' action='eliminar_producto.php'>";
                echo "<input type='hidden' name='indice' value='$key'>";
                echo "<button type='submit'>Eliminar</button>";
                echo "</form>";
                echo "</li>";
            }
            ?>
        </ul>
        <div class="carrito-total">
            <p>Subtotal: $ <?php echo calcularSubtotal(); ?></p>
            <p>Total (incluye impuestos): $ <?php echo calcularTotal(); ?></p>
        </div>
        <div class="carrito-botones">
            <button id="cerrar-carrito">Cerrar Carrito</button>
            <form action="realizar_compra.php" method="post">
                <button type="submit" id="realizar-compra-btn">Realizar Compra</button>
            </form>
        </div>
    </div>
</div>
    </main>      
      <footer>
        <p>&copy; 2024 Tienda en Línea. Todos los derechos reservados.</p>
      </footer>
      <script src="script.js"></script>
</body>
</html>
