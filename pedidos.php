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

<h2>Gestión de Pedidos</h2>

<form method="post">
    Cliente:<br>
    <select name="cliente">
        <?php
        $clientes = mysqli_query($conexion, "SELECT * FROM clientes");
        while ($c = mysqli_fetch_assoc($clientes)) {
            echo "<option value='".$c['id_cliente']."'>".$c['nombre']." ".$c['apellido']."</option>";
        }
        ?>
    </select><br><br>

    Mueble:<br>
    <select name="mueble">
        <?php
        $muebles = mysqli_query($conexion, "SELECT * FROM muebles");
        while ($m = mysqli_fetch_assoc($muebles)) {
            echo "<option value='".$m['id_mueble']."'>".$m['nombre']."</option>";
        }
        ?>
    </select><br><br>

    Cantidad:<br>
    <input type="number" name="cantidad" required><br><br>

    Fecha pedido:<br>
    <input type="date" name="fecha_pedido" required><br><br>

    Fecha estimada:<br>
    <input type="date" name="fecha_estimada" required><br><br>

    Seña:<br>
    <input type="number" name="sena"><br><br>

    <input type="submit" name="guardar" value="Guardar pedido">
</form>

<hr>

<?php
if (isset($_POST['guardar'])) {

    $cliente = $_POST['cliente'];
    $mueble = $_POST['mueble'];
    $cantidad = $_POST['cantidad'];
    $fecha_pedido = $_POST['fecha_pedido'];
    $fecha_estimada = $_POST['fecha_estimada'];
    $sena = $_POST['sena'];

    $insertar = "INSERT INTO pedidos
    (id_cliente, id_mueble, cantidad, fecha_pedido, fecha_estimada, sena, estado)
    VALUES
    ('$cliente', '$mueble', '$cantidad', '$fecha_pedido', '$fecha_estimada', '$sena', 'Pendiente')";

    mysqli_query($conexion, $insertar);
    echo "<p>Pedido registrado correctamente</p>";
}

if (isset($_POST['actualizar'])) {
    $id = $_POST['id_pedido'];
    $nuevo_estado = $_POST['nuevo_estado'];

    mysqli_query($conexion, "UPDATE pedidos SET estado='$nuevo_estado' WHERE id_pedido='$id'");
}
?>

<h3>Listado de Pedidos</h3>

<?php
$consulta = "SELECT p.*, c.nombre AS nombre_cliente, m.nombre AS nombre_mueble
FROM pedidos p
JOIN clientes c ON p.id_cliente = c.id_cliente
JOIN muebles m ON p.id_mueble = m.id_mueble";

$resultado = mysqli_query($conexion, $consulta);

echo "<table border='1'>
<tr>
<th>ID</th>
<th>Cliente</th>
<th>Mueble</th>
<th>Cantidad</th>
<th>Estado</th>
<th>Acción</th>
</tr>";

while ($fila = mysqli_fetch_assoc($resultado)) {

    echo "<tr>
    <td>".$fila['id_pedido']."</td>
    <td>".$fila['nombre_cliente']."</td>
    <td>".$fila['nombre_mueble']."</td>
    <td>".$fila['cantidad']."</td>
    <td>".$fila['estado']."</td>
    <td>
        <form method='post'>
            <input type='hidden' name='id_pedido' value='".$fila['id_pedido']."'>
            <select name='nuevo_estado'>
                <option>Pendiente</option>
                <option>En fabricación</option>
                <option>Listo para retirar</option>
                <option>Retirado</option>
            </select>
            <input type='submit' name='actualizar' value='Actualizar'>
        </form>
    </td>
    </tr>";
}

echo "</table>";
?>

<br>
<a href="menu.php">Volver</a>

