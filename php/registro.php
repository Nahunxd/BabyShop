<?php
// Se utiliza para llamar al archivo que contiene la conexión a la base de datos
require 'conexion.php';

// Validamos que el formulario y el botón de registro hayan sido presionados
if (isset($_POST['btnRegistrarse'])) {

    // Obtener los valores enviados por el formulario
    $usuario = $_POST['Username'];
    $contrasena = $_POST['contrasena'];
    $correo = $_POST['correo'];

    // Verificar que no haya valores vacíos (opcional)
    if (empty($usuario) || empty($contrasena) || empty($correo)) {
        die("Por favor, completa todos los campos.");
    }

    // Insertamos los datos en la base de datos
    $sql = "INSERT INTO usuariosempleados (idUsuarioEmpleado, usuario, contraseña, correo) 
            VALUES (null, '$usuario', '$contrasena', '$correo')";
    $resultado = mysqli_query($conexion, $sql);

    // Verificar si la consulta se ejecutó correctamente
    if ($resultado) {
        // Redirigimos a proyecto.html
        header("Location: ../proyecto.html");
        exit(); // Importante: detiene la ejecución posterior del script
    } else {
        // Mostrar error si la inserción falla
        echo "¡No se puede insertar la información!" . "<br>";
        echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
    }
}
?>
