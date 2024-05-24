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
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="icon" type="image/icon" href="images/favicon.ico">
    <link rel="stylesheet" href="styleAdmin.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Productos</title>
</head>
<body>
    <h2 style="text-align: center; color: #0056b3;">Editar Productos</h2>
    <table style="margin: auto;text-align: center; border: 1px solid #0056b3; border-right: 1px solid #0056b3">
        <tr style="background-color: #0056b3; color:#ffffff; border: 1px solid #0056b3;">
            <th>ID</th>
            <th>Nombre</th>
            <th>Referencia</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Imagen</th>
            <th>Acción</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td style='border: 1px solid #0056b3;'>" . $row["id_producto"] . "</td>";
                echo "<td style='border: 1px solid #0056b3;'>" . $row["nombre_producto"] . "</td>";
                echo "<td style='border: 1px solid #0056b3;'>" . $row["referencia"] . "</td>";
                echo "<td style='border: 1px solid #0056b3;'>$" . $row["precio"] . "</td>";
                echo "<td style='border: 1px solid #0056b3;'>$" . $row["cantidad_producto"] . "</td>";
                echo "<td style='border: 1px solid #0056b3;'>$" . $row["imagen"] . "</td>";
                echo "<td style='border: 1px solid #0056b3;'><a href='editar_producto.php?id=" . $row["id_producto"] . "'>Editar</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No se encontraron productos.</td></tr>";
        }
        ?>
    </table>
    <br><br><br>
<center><a href="admin.php" style="margin-top: 120px; text-align: center; background-color: #0056b3; color:#fff; padding: 10px 7px; text-decoration: none; border-radius: 7px;">Regresar</a></center>
</body>
</html>

<?php
// Cerrar la conexión
$conn->close();
?>
