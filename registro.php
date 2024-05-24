<?php
// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "proyectox");

if ($conexion === false) {
    die("ERROR: No se pudo conectar. " . mysqli_connect_error());
}

// Recuperar datos del formulario de registro
$newName = $_POST['new-name'];
$newUsername = $_POST['new-username'];
$newPassword = $_POST['new-password'];

// Consulta para verificar si el usuario ya existe
$consulta = "SELECT * FROM usuario WHERE usuario='$newUsername'";
$resultado = mysqli_query($conexion, $consulta);

if (mysqli_num_rows($resultado) > 0) {
    // El usuario ya existe
    echo "Error: El usuario '$newUsername' ya está registrado.";
} else {
    // El usuario no existe, proceder con el registro
    // Consulta para insertar nuevo usuario en la base de datos
    $sql = "INSERT INTO usuario (nombre, usuario, contrasena) VALUES ('$newName', '$newUsername', '$newPassword')";

    if (mysqli_query($conexion, $sql)) {
        // Registro exitoso
        echo "¡Registro exitoso para el usuario $newUsername!";
        header("Location: login.html");
    exit; 
    } else {
        // Error en el registro
        echo "Error al registrar usuario: " . mysqli_error($conexion);
    }
}

// Cerrar conexión
mysqli_close($conexion);
?>


