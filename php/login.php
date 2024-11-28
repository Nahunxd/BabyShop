<?php
// Se utiliza para llamar al archivo que contiene la conexión a la base de datos
require 'conexion.php';

// Validamos que el formulario y el botón login hayan sido presionados
if (isset($_POST['btnIniciarSesion'])) {

    // Obtener los valores enviados por el formulario
    $usuario = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    // Ejecutamos la consulta a la base de datos utilizando la función mysqli_query
    $sql = "SELECT usuario,contraseña FROM usuariosempleados WHERE usuario = '$usuario' AND contraseña = '$contrasena'";
    $resultado = mysqli_query($conexion, $sql);

    // Verificamos si la consulta devolvió algún resultado
    if (mysqli_num_rows($resultado) > 0) {
        // Iniciamos sesión para el usuario
        session_start();
        $_SESSION['usuario'] = $usuario;

        // Redirigimos al usuario a proyecto.html
        header("Location: ../proyecto.html");
        exit(); // Importante para evitar que se ejecute más código después de la redirección
    } else {
        echo "Usuario o contraseña incorrectos";
    }
}
?>

