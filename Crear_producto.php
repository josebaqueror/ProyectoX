<?php
// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "proyectox");

if ($conexion === false) {
    die("ERROR: No se pudo conectar. " . mysqli_connect_error());
}

// Recuperar datos del formulario crear producto
$newnombre_producto = $_POST [ 'nombre_producto'];
$newprecio = $_POST ['precio'];
$newreferencia = $_POST ['referencia'];
$newcantidad = $_POST ['cantidad'];



    // Procesamos la imagen
    $nombreimagen = $_FILES['imagen']['name'];
    $rutaimagen = 'images/' . $nombreimagen;
    $tempimagen = $_FILES['imagen']['tmp_name'];

   // Verificamos si hay errores en la subida del archivo
   if ($_FILES["imagen"]["error"] !== UPLOAD_ERR_OK) {
    echo "Hubo un error al subir la imagen.";
    exit;
}

// Movemos la imagen a la carpeta images
if (!move_uploaded_file($tempimagen, $rutaimagen)) {
    echo "Hubo un error al mover la imagen al directorio destino.";
    exit;
}     

 
// Consulta para verificar si el producto ya existe
$consulta = "SELECT * FROM producto WHERE referencia='$newreferencia'";
$resultado = mysqli_query($conexion, $consulta);

if (mysqli_num_rows($resultado) > 0) {
    // El Producto ya existe
    echo "Error: El producto  '$newreferencia' ya existe .";
} else {
    
    // codigo para insertar nuevo Producto en la base de datos
    $sql = "INSERT INTO producto (id_producto, nombre_producto, precio, referencia, cantidad_producto, imagen)
            VALUES ('NULL', '$newnombre_producto', '$newprecio','$newreferencia', '$newcantidad', 'images/$nombreimagen')";



    if (mysqli_query($conexion, $sql)) {
        // creacion  exitosa
        echo "¡Creacion exitosa para el producto $newreferencia!";
        header("Location: Crear_producto.html");
    exit; 
    } else {
        // Error en la creacion
        echo "Error al crear el producto: " . mysqli_error($conexion);
    }
}




// Cerrar conexión
mysqli_close($conexion);
?>