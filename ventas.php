<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Ventas</title>
    <style>
        table{
            text-align: center;
            width: 80vw;
            align-content: center;
        }
        h1{
            color: #007bff;
            text-align: center;
        }

    h1 span{
        color: #ff0040;
    }
        th{
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            font-weight: 600;
            min-width: 250px;
        }
        td{
            padding: 10px 20px;
            text-align: center;
            background-color: #ffffff;
            color: #007bff;
            border: 1px solid #007bff;
            font-weight: 600;
            min-width: 250px;
        }
    </style>
</head>
<body>
    <h1>Ventas Realizadas<span>.</span></h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio</th>
        </tr>

        <?php

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

// Consultar las ventas
$sql = "SELECT * FROM ventas";
$result = $conn->query($sql);

// Cerrar la conexión
$conn->close();

        // Mostrar los datos de las ventas
        $num_rows=0;
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id_producto"] . "</td>";
                echo "<td>" . $row["nombre_producto"] . "</td>";
                echo "<td>" . $row["cantidad_producto"] . "</td>";
                echo "<td>" . $row["precio"] . "</td>";
                // Agrega más columnas según tu esquema de base de datos
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No se encontraron ventas.</td></tr>";
        }
        ?>
    </table>
</body>
</html>
