<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

if ($_SESSION['rol'] != 'admin') {
    echo "No tenés permiso.";
    exit();
}

include("conexion.php");
?>

<h2>Catálogo de Muebles</h2>

<form method="post">
    Nombre:<br>
    <input type="text" name="nombre" required><br><br>

    Descripción:<br>
    <textarea name="descripcion"></textarea><br><br>

    Precio base:<br>
    <input type="number" name="precio" required><br><br>

    <input type="submit" name="guardar" value="Guardar mueble">
</form>

<hr>

<?php
if (isset($_POST['guardar'])) {

    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];

    $insertar = "INSERT INTO muebles (nombre, descripcion, precio_base)
                 VALUES ('$nombre', '$descripcion', '$precio')";

    mysqli_query($conexion, $insertar);
    echo "<p>Mueble guardado correctamente</p>";
}

$consulta = "SELECT * FROM muebles";
$resultado = mysqli_query($conexion, $consulta);

echo "<table border='1'>
<tr>
<th>ID</th>
<th>Nombre</th>
<th>Descripción</th>
<th>Precio</th>
</tr>";

while ($fila = mysqli_fetch_assoc($resultado)) {
    echo "<tr>
    <td>".$fila['id_mueble']."</td>
    <td>".$fila['nombre']."</td>
    <td>".$fila['descripcion']."</td>
    <td>".$fila['precio_base']."</td>
    </tr>";
}

echo "</table>";
?>

<br>
<a href="menu.php">Volver</a>

