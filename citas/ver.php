<?php
include '../db/conexion.php';
$id = $_GET['id'];
$cita = $conn->query("SELECT citas.*, mascotas.nombre AS mascota, duenos.nombre AS dueno FROM citas JOIN mascotas ON citas.mascota_id = mascotas.id JOIN duenos ON mascotas.dueno_id = duenos.id WHERE citas.id=$id")->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Cita</title>
    <link rel="stylesheet" href="../css/mostrar.css">
</head>
<body>
<nav>
    <img src="../imagenes/logo.png" alt="logo" class="logo" id="logo">
    <h1>Gestión Veterinaria</h1>
</nav>
<h1 id="texto_principal">Detalles de la Cita</h1>
<div class="detalles">
    <p><strong>Mascota:</strong> <?= $cita['mascota'] ?></p>
    <p><strong>Dueño:</strong> <?= $cita['dueno'] ?></p>
    <p><strong>Fecha:</strong> <?= $cita['fecha'] ?></p>
    <p><strong>Hora:</strong> <?= $cita['hora'] ?></p>
</div>
<div class="volver">
    <a href="index.php" class="boton-volver">Volver a la lista de citas</a>
</div>
</body>
</html>
