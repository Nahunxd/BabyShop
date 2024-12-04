<?php
$user = "babyshop";
$pass = "babyshop1234";
$host = "mysql.webcindario.com";


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

$mysqli = new mysqli($host, $user, $pass, "babyshop");
if($mysqli->connect_errno){
    echo "Lo sentimos, este sitio web esta experimentando problemas";
    exit;
}

$user = $_POST["user"];
$clave = $_POST["pass"];

$Euser = encrypt($user, $llave);
$Eclave = encrypt($clave, $llave);

$consultaSQL = "SELECT * FROM usuarios WHERE usuario='$Euser' and contrasena='$Eclave'";

$resultado = mysqli_query($mysqli,$consultaSQL);

if (mysqli_num_rows($resultado) > 0) {
    // Iniciamos sesi?n para el usuario
    session_start();
    $_SESSION['usuario'] = $user;

    // Redirigimos al usuario a proyecto.html
    echo'<script type="text/javascript">
    
    window.location.href="proyecto.html";
    </script>';
    exit(); // Importante para evitar que se ejecute m?s c?digo despu?s de la redirecci?n
} else {
    echo'<script type="text/javascript">
    alert("Usuario o contraseña incorrectos");
    window.location.href="index.html";
    </script>';
}

?>