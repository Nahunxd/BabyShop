<?php
$user = "babyshop";
$pass = "babyshop1234";
$host = "mysql.webcindario.com";

$mysqli = new mysqli($host, $user, $pass, "babyshop");
if ($mysqli->connect_errno) {
    echo "Lo sentimos, este sitio web esta experimentando problemas";
    exit;
}

$user = $_POST["user"];
$clave = $_POST["pass"];
$email = $_POST["email"];
$rol = 2;

$llave = "m3m0c0d3";

function encrypt($string, $key)
{
    $result = '';
    for ($i = 0; $i < strlen($string); $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key)) - 1, 1);
        $char = chr(ord($char) + ord($keychar));
        $result .= $char;
    }
    return base64_encode($result);
}

function decrypt($string, $key)
{
    $result = '';
    $string = base64_decode($string);
    for ($i = 0; $i < strlen($string); $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key)) - 1, 1);
        $char = chr(ord($char) - ord($keychar));
        $result .= $char;
    }
    return $result;
}


$Euser = encrypt($user, $llave);
$Eclave = encrypt($clave, $llave);
$Eemail = encrypt($email, $llave);

$consultaSQL = "SELECT * FROM usuarios WHERE usuario='$Euser' or email='$Eemail'";


$resultado = mysqli_query($mysqli, $consultaSQL);
if (mysqli_num_rows($resultado) > 0) {
    echo '<script type="text/javascript">
    alert("Ya existe un usuario registrado");
    window.location.href="registro.html";
    </script>';
} else {
    $consultaSQL = "INSERT INTO usuarios (email,usuario,contrasena,rol) VALUES ('$Eemail','$Euser','$Eclave','$rol')";

    if (mysqli_query($mysqli, $consultaSQL)) {
        echo '<script type="text/javascript">
    alert("Usuario creado exitosamente");
    window.location.href="index.html";
    </script>';
    } else {
        echo "<p>Error en el servidor</p>";
    }
}
