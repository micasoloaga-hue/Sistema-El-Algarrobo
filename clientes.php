<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

if ($_SESSION['rol'] != 'admin' && $_SESSION['rol'] != 'recepcionista') {
    echo "No tenés permiso.";
    exit();
}

include("conexion.php");
?>

<h2>Gestión de Clientes</h2>

<form method="post">
    Nombre:<br>
    <input type="text" name="nombre" required><br><br>

    Apellido:<br>
    <input type="text" name="apellido" required><br><br>

    Teléfono:<br>
    <input type="text" name="telefono"><br><br>

    Email:<br>
    <input type="email" name="email"><br><br>

    <input type="submit" name="guardar" value="Guardar cliente">
</form>

<hr>

<?php
if (isset($_POST['guardar'])) {

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];

    $insertar = "INSERT INTO clientes (nombre, apellido, telefono, email)
                 VALUES ('$nombre', '$apellido', '$telefono', '$email')";

    mysqli_query($conexion, $insertar);
    echo "<p>Cliente guardado correctamente</p>";
}
?>

<h3>Buscar Cliente</h3>
<form method="get">
    <input type="text" name="buscar">
    <input type="submit" value="Buscar">
</form>

<hr>

<?php
$where = "";

if (isset($_GET['buscar']) && $_GET['buscar'] != "") {
    $buscar = $_GET['buscar'];
    $where = "WHERE nombre LIKE '%$buscar%' OR apellido LIKE '%$buscar%'";
}

$consulta = "SELECT * FROM clientes $where";
$resultado = mysqli_query($conexion, $consulta);

echo "<table border='1'>
<tr>
<th>ID</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Teléfono</th>
<th>Email</th>
</tr>";

while ($fila = mysqli_fetch_assoc($resultado)) {
    echo "<tr>
    <td>".$fila['id_cliente']."</td>
    <td>".$fila['nombre']."</td>
    <td>".$fila['apellido']."</td>
    <td>".$fila['telefono']."</td>
    <td>".$fila['email']."</td>
    </tr>";
}

echo "</table>";
?>

<br>
<a href="menu.php">Volver</a>

