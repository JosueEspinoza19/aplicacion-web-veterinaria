<?php
include '../db/conexion.php';

$duenos = $conn->query("SELECT * FROM duenos");

$errores = ['nombre' => '', 'especie' => ''];

$nombre = '';
$especie = '';
$dueno_id = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $especie = trim($_POST['especie']);
    $dueno_id = $_POST['dueno_id'];

    // Validar nombre: mínimo 3 letras y solo letras
    if (strlen($nombre) < 3 || !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $nombre)) {
        $errores['nombre'] = "El nombre debe tener al menos 3 letras y solo contener letras.";
    }

    // Validar especie: mínimo 3 letras y solo letras
    if (strlen($especie) < 3 || !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $especie)) {
        $errores['especie'] = "La especie debe tener al menos 3 letras y solo contener letras.";
    }

    // Si no hay errores insertar y redirigir
    if (empty($errores['nombre']) && empty($errores['especie'])) {
        $conn->query("INSERT INTO mascotas (nombre, especie, dueno_id) VALUES ('$nombre', '$especie', $dueno_id)");
        header("Location: index.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Mascota</title>
    <link rel="stylesheet" href="../css/agregar.css">
</head>
<body>
<nav>
    <img src="../imagenes/logo.png" alt="logo" class="logo" id="logo">
    <h1>Gestión Veterinaria</h1>
</nav>
<h1 id="texto_principal">Agregar Mascota</h1>
<form method="post">
    <label>
        Nombre:
        <input type="text" name="nombre" value="<?= htmlspecialchars($nombre) ?>">
        <?php if ($errores['nombre']): ?>
            <small style="color:red; display:block; margin-top:2px;"><?= htmlspecialchars($errores['nombre']) ?></small>
        <?php endif; ?>
    </label><br>

    <label>
        Especie:
        <input type="text" name="especie" value="<?= htmlspecialchars($especie) ?>">
        <?php if ($errores['especie']): ?>
            <small style="color:red; display:block; margin-top:2px;"><?= htmlspecialchars($errores['especie']) ?></small>
        <?php endif; ?>
    </label><br>

    <label>
        Dueño:
        <select name="dueno_id">
            <option value="">-- Seleccione un dueño --</option>
            <?php 
            $duenos->data_seek(0);
            while($d = $duenos->fetch_assoc()): ?>
                <option value="<?= $d['id'] ?>" <?= ($d['id'] == $dueno_id) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($d['nombre']) ?>
                </option>
            <?php endwhile; ?>
        </select>
    </label><br>

    <button type="submit">Guardar</button>
</form>
<div class="volver">
    <a href="index.php" class="boton-volver">Volver a la lista de mascotas</a>
</div>
</body>
</html>
