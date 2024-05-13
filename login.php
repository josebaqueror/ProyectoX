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
        header("Location: index.html");
    } elseif ($_SESSION['role'] == 'administrador') {
        header("Location: admin.php");
    }
} else {
    // Usuario no encontrado o credenciales incorrectas
    echo "<body style='background-color: #1a2227; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0;'><img src='images/warning.png' style='width: 120px;'/><br><br><p style='color: #fff; text-align: center;'>Usuario o contraseña incorrectos<br><br><br> <a href='login.html' style='margin-top: 120px; text-align: center; background-color: #0056b3; color:#fff; padding: 10px 7px; text-decoration: none; border-radius: 7px;'> Volver a intentarlo</a></p>";
}

$conn->close();
?>



