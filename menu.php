<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
?>

<h2>Bienvenido al sistema El Algarrobo</h2>

<p>Usuario: <?php echo $_SESSION['usuario']; ?></p>
<p>Rol: <?php echo $_SESSION['rol']; ?></p>

<ul>

<?php
if ($_SESSION['rol'] == 'admin') {
    echo "<li><a href='clientes.php'>Clientes</a></li>";
    echo "<li><a href='muebles.php'>Muebles</a></li>";
    echo "<li><a href='pedidos.php'>Pedidos</a></li>";
}

if ($_SESSION['rol'] == 'recepcionista') {
    echo "<li><a href='clientes.php'>Clientes</a></li>";
    echo "<li><a href='pedidos.php'>Pedidos</a></li>";
}
?>

</ul>

<a href="logout.php">Cerrar sesión</a>

<hr>

<p><strong>Desarrollado por:</strong> Florencia Micaela Soloaga</p>
<p><strong>DNI:</strong> 40398797</p>
<p><strong>Email:</strong> mica.soloaga@gmail.com</p>

