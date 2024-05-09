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
    echo "<body style='background-color: #1a2227; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0;'><img src='images/warning.png' style='width: 120px;'/><br><br><p style='color: #fff; text-align: center;'>Error: El usuario '$newUsername' ya está registrado.<br><br><br> <a href='registro.html' style='margin-top: 120px; text-align: center; background-color: #0056b3; color:#fff; padding: 10px 7px; text-decoration: none; border-radius: 7px;'> Volver a intentarlo</a></p>";
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
