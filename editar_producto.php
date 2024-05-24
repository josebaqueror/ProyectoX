<?php
// Verificar si se ha enviado el ID del producto a editar
if(isset($_GET['id'])) {
    $producto_id = $_GET['id'];

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

    // Consulta para obtener la información del producto seleccionado
    $sql = "SELECT * FROM producto WHERE id_producto = $producto_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nombre = $row["nombre_producto"];
        $referencia = $row["referencia"];
        $precio = $row["precio"];
        $cantidad = $row["cantidad_producto"];
        $imagen =$row["imagen"];
    } else {
        echo "No se encontró el producto.";
        exit();
    }
} else {
    echo "ID de producto no especificado.";
    exit();
}

// Verificar si se ha enviado el formulario de edición
if(isset($_POST['submit'])) {
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

    // Recuperar los datos del formulario
    $nombre = $_POST['nombre'];
    $referencia = $_POST['referencia'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    

    // Actualizar la información del producto en la base de datos
    $sql = "UPDATE producto SET nombre_producto='$nombre', referencia='$referencia', precio='$precio', cantidad_producto='$cantidad', imagen='$imagen' WHERE id_producto=$producto_id";

    if ($conn->query($sql) === TRUE) {
        echo "Producto actualizado correctamente.";
    } else {
        echo "Error al actualizar el producto: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link rel="icon" type="image/icon" href="images/favicon.ico">
    <link rel="stylesheet" href="styleAdmin.css">


</head>
<body>
    <h1 style="text-align: center; color: #0056b3;">Editar Producto</h1>
    <form action="" method="post" style="margin:auto; background-color:aliceblue; width: 420px; text-align:center; padding: 40px 10px; border: 1px solid #0056b3; border-radius: 20px">
        <label for="nombre" style="color: #000; text-align: left!important; ">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>"><br>
        <label for="referencia" style="color: #000; text-align: left!important; ">Referencia:</label><br>
        <input type="text" id="referencia" name="referencia" value="<?php echo $referencia; ?>"><br>
        <label for="precio" style="color: #000; text-align: left!important; ">Precio:</label><br>
        <input type="number" id="precio" name="precio" value="<?php echo $precio; ?>"><br>
        <label for="cantidad" style="color: #000; text-align: left!important; ">Cantidad:</label><br>
        <input type="number" id="cantidad" name="cantidad" value="<?php echo $cantidad; ?>"><br><br>
        <input type="submit" name="submit" value="Guardar Cambios" style="text-align: center; background-color: #0056b3; color:#fff; padding: 10px 7px; text-decoration: none; border-radius: 7px;">
    </form>
</body>
</html>
