<!DOCTYPE html>
<html>
<head>
    <title>Login - El Algarrobo</title>
</head>
<body>

<h2>Ingreso al sistema</h2>

<form method="post" action="validar_login.php">
    Usuario:<br>
    <input type="text" name="usuario" required><br><br>

    Contraseña:<br>
    <input type="password" name="contrasena" required><br><br>

    ¿Cuánto es 3 + 4? (captcha)<br>
    <input type="text" name="captcha" required><br><br>

    <input type="submit" value="Ingresar">
</form>

</body>
</html>
