<?php
// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "proyectox");

if ($conexion === false) {
    die("ERROR: No se pudo conectar. " . mysqli_connect_error());
}

// Recuperar datos del formulario de inicio de sesión
$username = $_POST['username'];
$password = $_POST['password'];

// Consulta para verificar el usuario y contraseña en la base de datos
$sql = "SELECT * FROM usuario WHERE usuario='$username' AND contraseña='$password'";
$resultado = mysqli_query($conexion, $sql);

// Verificar si la consulta devuelve algún resultado
if (mysqli_num_rows($resultado) == 1) {
    // Inicio de sesión exitoso
    echo "¡Inicio de sesión exitoso!";
    header("Location: index.html");
    exit; 
} else {
    // Nombre de usuario o contraseña incorrectos
    echo "Nombre de usuario o contraseña incorrectos.";
}

// Cerrar conexión
mysqli_close($conexion);
?>


