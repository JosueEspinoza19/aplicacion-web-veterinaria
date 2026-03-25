<?php
include '../db/conexion.php';
$id = $_GET['id'];
$dueno = $conn->query("SELECT * FROM duenos WHERE id=$id")->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Dueño</title>
    <link rel="stylesheet" href="../css/mostrar.css">
</head>
<body>
<nav>
    <img src="../imagenes/logo.png" alt="logo" class="logo" id="logo">
    <h1>Gestión Veterinaria</h1>
</nav>
<h1 id="texto_principal">Detalles del Dueño</h1>
<div class="detalles">
    <p><strong>Nombre:</strong> <?= $dueno['nombre'] ?></p>
    <p><strong>Teléfono:</strong> <?= $dueno['telefono'] ?></p>
</div>
<div class="volver">
    <a href="index.php" class="boton-volver">Volver a la lista de dueños</a>
</div>
</body>
</html>
