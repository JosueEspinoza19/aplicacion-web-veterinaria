<?php
include '../db/conexion.php';
$id = $_GET['id'];
$mascota = $conn->query("SELECT mascotas.*, duenos.nombre AS dueno FROM mascotas JOIN duenos ON mascotas.dueno_id = duenos.id WHERE mascotas.id=$id")->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Mascota</title>
    <link rel="stylesheet" href="../css/mostrar.css">
</head>
<body>
<nav>
    <img src="../imagenes/logo.png" alt="logo" class="logo" id="logo">
    <h1>Gestión Veterinaria</h1>
</nav>
<h1 id="texto_principal">Detalles de la Mascota</h1>
<div class="detalles">
    <p><strong>Nombre:</strong> <?= $mascota['nombre'] ?></p>
    <p><strong>Especie:</strong> <?= $mascota['especie'] ?></p>
    <p><strong>Dueño:</strong> <?= $mascota['dueno'] ?></p>
</div>
<div class="volver">
    <a href="index.php" class="boton-volver">Volver a la lista de mascotas</a>
</div>
</body>
</html>
