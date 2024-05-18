<?php
// Verificar si se reciben datos por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos enviados por el cliente
    $data = json_decode(file_get_contents("php://input"), true);

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

    // Iniciar una transacción
    $conn->begin_transaction();

    try {
        // Insertar la compra en la tabla compras
        $fecha = $data["fecha"];
        $usuarioId = $data["usuario_id"];
        $total = $data["total"];
        $stmtCompra = $conn->prepare("INSERT INTO compras (usuario_id, fecha, total) VALUES (?, ?, ?)");
        $stmtCompra->bind_param("isd", $usuarioId, $fecha, $total);
        $stmtCompra->execute();
        $compraId = $stmtCompra->insert_id; // Obtener el ID de la compra recién insertada

        // Insertar los detalles de la compra en la tabla detalles_compras
        foreach ($data["carrito"] as $producto) {
            $productoId = $producto["id"];         
            $cantidad = $producto["cantidad"];
            $precioUnitario = $producto["precio"];
            $stmtDetalles = $conn->prepare("INSERT INTO detalles_compras (compra_id, producto_id, cantidad, precio) VALUES (?, ?, ?, ?)");
            $stmtDetalles->bind_param("iiid", $compraId, $productoId, $cantidad, $precioUnitario);
            $stmtDetalles->execute();

            $stmtActualizar = $conn->prepare("UPDATE producto SET cantidad_producto = cantidad_producto - ? WHERE referencia = ?");
            $stmtActualizar->bind_param("ii", $cantidad, $productoId);
            $stmtActualizar->execute();
        }

        // Confirmar la transacción
        $conn->commit();

        // Devolver una respuesta JSON de éxito
        $response = array(
            "success" => true,
            "message" => "Compra realizada con éxito",
            "compra_id" => $compraId
        );
    } catch (Exception $e) {
        // Si ocurre algún error, hacer rollback y devolver una respuesta JSON de error
        $conn->rollback();
        $response = array(
            "success" => false,
            "message" => "Error al procesar la compra: " . $e->getMessage()
        );
    }

    // Cerrar la conexión
    $conn->close();

    // Devolver la respuesta como JSON
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Si no se recibe una solicitud POST, devolver un error
    $response = array(
        "success" => false,
        "message" => "Error: Se esperaba una solicitud POST"
    );
    // Devolver la respuesta como JSON
    header('Content-Type: application/json');
    http_response_code(400); // Código de respuesta HTTP 400: Bad Request
    echo json_encode($response);
}
?>
