<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Productos</title>
    <link rel="icon" type="image/icon" href="images/favicon.ico">
    <link rel="stylesheet" href="styleAdmin.css">
</head>
<body>
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
            echo "<img src='" . $row["imagen"] . "' alt='" . $row["nombre_producto"] . "'  style='width: 100px; margin-right: 20px;'>";
            echo "<p><strong>&nbsp;Nombre:</strong> " . $row["nombre_producto"] . "</p>";
            echo "<p><strong>&nbsp;Precio:</strong> $" . $row["precio"] . "</p>";
            echo "<p><strong>&nbsp;Referencia:</strong> " . $row["referencia"] . "</p>";
            echo "<p><strong>&nbsp;Cantidad:</strong> " . $row["cantidad_producto"] . "</p>";
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
</body>
</html>
