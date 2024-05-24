<?php
session_start();

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "proyectox";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Recuperar datos del formulario
$username = $_POST['username'];
$password = $_POST['password'];

// Consulta para verificar el usuario
$sql = "SELECT * FROM usuario WHERE usuario='$username' AND contrasena='$password'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    // Usuario autenticado correctamente
    $row = $result->fetch_assoc();
    $_SESSION['usuario'] = $username;
    $_SESSION['role'] = $row['role'];

    // Redirigir según el rol del usuario
    if ($_SESSION['role'] == 'cliente') {
        header("Location: index.php");
    } elseif ($_SESSION['role'] == 'administrador') {
        header("Location: admin.php");
    }
} else {
    // Usuario no encontrado o credenciales incorrectas
    echo "Usuario o contraseña incorrectos";
}

$conn->close();
?>
