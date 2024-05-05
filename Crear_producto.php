<?php
// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "proyecox");

if ($conexion === false) {
    die("ERROR: No se pudo conectar. " . mysqli_connect_error());
}

// Recuperar datos del formulario crear producto
$newnombre_producto = $_POS[ 'nombre_producto'];
$newprecio = $_POST ['precio'];
$newreferencia = $_POST ['referencia'];
$newcantidad = $_POS ['cantidad'];
$newimagen = $_POS ['imagen']

    // Procesamos la imagen
    $nombreImagen = $_FILES["imagen"]["name"];
    $rutaImagen = "images/" . $nombreImagen;
    $tempImagen = $_FILES["imagen"]["tmp_name"];
    
    // Movemos la imagen a la carpeta images
    move_uploaded_file($tempImagen, $rutaImagen);

// Consulta para verificar si el prodecyo ya existe
$consulta = "SELECT * FROM producto WHERE referencia='$newreferencia'";
$resultado = mysqli_query($conexion, $consulta);

if (mysqli_num_rows($resultado) > 0) {
    // El Producto ya existe
    echo "Error: El producto  '$newreferencia' ya existe .";
} else {
    
    // codigo para insertar nuevo Producto en la base de datos
    $sql = "INSERT INTO producto (id_producto, nombre_producto, precio, referencia, cantidad_producto, imagen)
            VALUES ('NULL', '$newnombre_producto', '$newprecio','$newreferencia', '$newcantidad', '$newimagen')";



    if (mysqli_query($conexion, $sql)) {
        // Registro exitoso
        echo "¡Creacion exitosa para el producto $newreferencia!";
        header("Location: Crear_producto.html");
    exit; 
    } else {
        // Error en el registro
        echo "Error al registrar usuario: " . mysqli_error($conexion);
    }
}

// Cerrar conexión
mysqli_close($conexion);
?>