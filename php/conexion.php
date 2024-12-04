<?php
// Definimos las credenciales de la base de datos
$servidor = "localhost"; // servidor de la base de datos
$usuario = "root"; // usuario de la base de datos
$contraseña = ""; // contraseña de la base de datos
$base_de_datos = "babyshop"; // nombre de la base de datos

// Creamos la conexión a la base de datos utilizando la función mysqli_conexionect
$conexion = mysqli_connect($servidor, $usuario, $contraseña, $base_de_datos);

// Verificamos si la conexión fue exitosa
if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error()); // Si la conexión falla, se muestra un mensaje de error y se termina la ejecución del script
}

// Cerramos la conexión a la base de datos utilizando la función mysqli_close
//mysqli_close($conexion);
?>