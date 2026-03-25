<?php
include '../db/conexion.php';
$resultado = $conn->query("SELECT mascotas.*, duenos.nombre AS dueno FROM mascotas JOIN duenos ON mascotas.dueno_id = duenos.id");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mascotas</title>
    <link rel="stylesheet" href="../css/gestion.css">
</head>
<body>
<nav>
    <img src="../imagenes/logo.png" alt="logo" class="logo" id="logo">
    <h1>Gestión Veterinaria</h1>
</nav>
<h2 id="texto_principal">Lista de Mascotas</h2>
<a href="agregar.php" id="agregar"><img src="../imagenes/agregar-mascota.png" alt="agregar" id="icono_agregar"></a>
<table>
<tr><th>ID</th><th>Nombre</th><th>Dueño</th><th>Especie</th><th>Acciones</th></tr>
<?php while($row = $resultado->fetch_assoc()): ?>
<tr>
<td><?= $row['id'] ?></td>
<td><?= $row['nombre'] ?></td>
<td><?= $row['dueno'] ?></td>
<td><?= $row['especie'] ?></td>
<td>
<a href="ver.php?id=<?= $row['id'] ?>"><img src="../imagenes/vista.png" alt="ver" class="boton-accion"></a> |
<a href="editar.php?id=<?= $row['id'] ?>"><img src="../imagenes/editar.png" alt="editar" class="boton-accion"></a> |
<a href="eliminar.php?id=<?= $row['id'] ?>"><img src="../imagenes/eliminar.png" alt="eliminar" class="boton-accion"></a>
</td>
</tr>
<?php endwhile; ?>
</table>
<div class="volver">
    <a href="../index.php" class="boton-volver">Volver al menú principal</a>
</div>
</body>
</html>
