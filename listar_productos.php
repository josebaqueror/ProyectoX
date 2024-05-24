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
    <h1 style="text-align: center; color: #0056b3;">Listar Productos</h1>
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
    $sql = "SELECT * FROM producto";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div class='producto' style='display: flex; align-items: center; margin: auto; padding-bottom: 20px; width: 50vw'>";
            echo "<img src='" . $row["imagen"] . "' alt='" . $row["nombre_producto"] . "'  style='width: 100px!important; height: auto; margin-right: 20px;'>";
            echo "<p style='color:#000'><strong>&nbsp;Nombre:</strong> " . $row["nombre_producto"] . "</p>";
            echo "<p style='color:#000'><strong>&nbsp;Precio:</strong> $" . $row["precio"] . "</p>";
            echo "<p style='color:#000'><strong>&nbsp;Referencia:</strong> " . $row["referencia"] . "</p>";
            echo "<p style='color:#000'><strong>&nbsp;Cantidad:</strong> " . $row["cantidad_producto"] . "</p>";
            echo "</div>";
        }
    } else {
        echo "No se encontraron productos.";
    }

    // Cerrar la conexión
    $conn->close();
    ?>
    <br><br><br>
<center><a href="admin.php" style="margin-top: 120px; text-align: center; background-color: #0056b3; color:#fff; padding: 10px 7px; text-decoration: none; border-radius: 7px;">Regresar</a></center>
<br><br><br>
<footer>
        <p>&copy; 2024 Tienda en Línea. Todos los derechos reservados.</p>
      </footer>
    
</body>
</html>
