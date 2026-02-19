<?php
session_start();
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    $captcha = $_POST['captcha'];

    if ($captcha != 7) {
        echo "Captcha incorrecto.";
        echo "<br><a href='login.php'>Volver</a>";
        exit();
    }

    $consulta = "SELECT * FROM usuarios 
                 WHERE usuario='$usuario' 
                 AND contrasena='$contrasena'";

    $resultado = mysqli_query($conexion, $consulta);

    if (mysqli_num_rows($resultado) == 1) {

        $fila = mysqli_fetch_assoc($resultado);

        $_SESSION['usuario'] = $fila['usuario'];
        $_SESSION['rol'] = $fila['rol'];

        header("Location: menu.php");
        exit();

    } else {
        echo "Usuario o contraseña incorrectos.";
        echo "<br><a href='login.php'>Volver</a>";
        exit();
    }
}
?>
