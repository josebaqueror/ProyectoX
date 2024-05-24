<?php
session_start();

// Verificar si se ha enviado un índice para eliminar un producto del carrito
if(isset($_POST['indice'])) {
    $indice = $_POST['indice'];
    
    // Verificar si el índice es válido y existe en el carrito
    if(isset($_SESSION['carrito'][$indice])) {
        // Eliminar el producto del carrito usando el índice
        unset($_SESSION['carrito'][$indice]);
    }
}

// Redirigir de vuelta a la página del carrito
header("Location: index.php");
exit();
?>