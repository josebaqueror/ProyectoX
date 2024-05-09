<?php
session_start();

// Verificar si el carrito está vacío
if(empty($_SESSION['carrito'])) {
    // Redirigir de vuelta a la página de productos si el carrito está vacío
    header("Location: productos.php");
    exit();
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

// Obtener el ID de usuario (suponiendo que tienes un sistema de autenticación de usuarios)
$usuario_id = 1; // Supongamos que el ID del usuario actual es 1

// Calcular el total de la compra
$total = calcularTotal();

// Obtener la fecha actual
$fecha = date("Y-m-d H:i:s");

// Insertar la compra en la base de datos
$sql = "INSERT INTO compras (usuario_id, fecha, total) VALUES ('$usuario_id', '$fecha', '$total')";

if ($conn->query($sql) === TRUE) {
    // Guardar los detalles de los productos comprados en otra tabla (suponiendo que tienes una tabla llamada detalles_compras)
    $compra_id = $conn->insert_id; // Obtener el ID de la compra recién insertada
    foreach ($_SESSION['carrito'] as $item) {
        $producto_id = $item['id'];
        $cantidad = 1; // Supongamos que siempre se compra una cantidad de 1 por cada producto
        $precio = $item['precio'];
        $sql_detalle = "INSERT INTO detalles_compras (compra_id, producto_id, cantidad, precio) VALUES ('$compra_id', '$producto_id', '$cantidad', '$precio')";
        $conn->query($sql_detalle);
    }
    
    // Una vez que se han guardado todos los detalles de la compra, limpiar el carrito de compras
    unset($_SESSION['carrito']);
    
    // Redirigir a la página de confirmación de compra
    header("Location: confirmacion_compra.php");
    exit();
} else {
    echo "Error al guardar la compra: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
