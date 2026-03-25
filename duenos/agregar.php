<?php
include '../db/conexion.php';

$errores = [
    'nombre' => '',
    'telefono' => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $telefono = trim($_POST['telefono']);

    // Validación del nombre (mínimo 3 letras y solo letras)
    if (strlen($nombre) < 3 || !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $nombre)) {
        $errores['nombre'] = "El nombre debe tener al menos 3 letras y solo contener letras.";
    }

    // Validación del teléfono (formato 646-123-4567)
    if (!preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $telefono)) {
        $errores['telefono'] = "El teléfono debe tener el formato 646-123-4567.";
    }

    // Si no hay errores, insertar en la base de datos
    if (empty($errores['nombre']) && empty($errores['telefono'])) {
        $conn->query("INSERT INTO duenos (nombre, telefono) VALUES ('$nombre', '$telefono')");
        header("Location: index.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Dueño</title>
    <link rel="stylesheet" href="../css/agregar.css">
</head>
<body>
<nav>
    <img src="../imagenes/logo.png" alt="logo" class="logo" id="logo">
    <h1>Gestión Veterinaria</h1>
</nav>

<h1 id="texto_principal">Agregar Dueño</h1>

<form method="post">
    <label>
        Nombre:
        <input type="text" name="nombre" value="<?= htmlspecialchars($_POST['nombre'] ?? '') ?>">
        <?php if ($errores['nombre']): ?>
            <small style="color:red; display:block; margin-top: 2px;"><?= htmlspecialchars($errores['nombre']) ?></small>
        <?php endif; ?>
    </label><br>

    <label>
        Teléfono:
        <input type="text" name="telefono" value="<?= htmlspecialchars($_POST['telefono'] ?? '') ?>">
        <?php if ($errores['telefono']): ?>
            <small style="color:red; display:block; margin-top: 2px;"><?= htmlspecialchars($errores['telefono']) ?></small>
        <?php endif; ?>
    </label><br>

    <button type="submit">Guardar</button>
</form>
<div class="volver">
    <a href="index.php" class="boton-volver">Volver a la lista de dueños</a>
</div>
</body>
</html>
