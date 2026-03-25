<?php
include '../db/conexion.php';
$mascotas = $conn->query("SELECT mascotas.*, duenos.nombre AS dueno FROM mascotas JOIN duenos ON mascotas.dueno_id = duenos.id");

$errores = ['fecha' => '', 'hora' => ''];
$fecha = '';
$hora = '';
$fecha_db = ''; // Inicializa para evitar error si no pasa la validación

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mascota_id = $_POST['mascota_id'] ?? '';
    $fecha = $_POST['fecha'] ?? '';
    $hora = $_POST['hora'] ?? '';

    // Validar fecha con formato mm/dd/yyyy
    if (!preg_match('/^(0[1-9]|1[0-2])\/(0[1-9]|[12]\d|3[01])\/\d{4}$/', $fecha)) {
        $errores['fecha'] = "Ingresa una fecha válida en formato mm/dd/yyyy.";
    } else {
        list($mes, $dia, $anio) = explode('/', $fecha);
        if (!checkdate((int)$mes, (int)$dia, (int)$anio)) {
            $errores['fecha'] = "Fecha no válida.";
        } else {
            $fecha_db = "$anio-$mes-$dia"; // formato yyyy-mm-dd para BD
        }
    }

    // Validar hora 
    if (!preg_match("/^(?:[01]\d|2[0-3]):[0-5]\d:[0-5]\d$/", $hora)) {
        $errores['hora'] = "La hora debe tener el formato HH:MM:SS (00:00:00 a 23:59:59).";
    }

    // Si no hay errores, insertar
    if (empty($errores['fecha']) && empty($errores['hora'])) {
        $stmt = $conn->prepare("INSERT INTO citas (mascota_id, fecha, hora) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $mascota_id, $fecha_db, $hora);
        $stmt->execute();
        $stmt->close();
        header("Location: index.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Cita</title>
    <link rel="stylesheet" href="../css/agregar.css">
</head>
<body>
<nav>
    <img src="../imagenes/logo.png" alt="logo" class="logo" id="logo">
    <h1>Gestión Veterinaria</h1>
</nav>
<h1 id="texto_principal">Agregar Cita</h1>
<form method="post">
    <label>
        Mascota:
        <select name="mascota_id">
            <option value="">-- Selecciona una mascota --</option>
            <?php while($m = $mascotas->fetch_assoc()): ?>
                <option value="<?= $m['id'] ?>" <?= isset($mascota_id) && $mascota_id == $m['id'] ? 'selected' : '' ?>>
                    <?= $m['nombre'] ?> (Dueño: <?= $m['dueno'] ?>)
                </option>
            <?php endwhile; ?>
        </select>
    </label><br>

    <label>
        Fecha:
        <input type="text" name="fecha" value="<?= htmlspecialchars($fecha) ?>" placeholder="mm/dd/yyyy">
        <?php if ($errores['fecha']): ?>
            <small style="color:red; display:block; margin-top:2px;"><?= htmlspecialchars($errores['fecha']) ?></small>
        <?php endif; ?>
    </label><br>

    <label>
        Hora:
        <input type="text" name="hora" value="<?= htmlspecialchars($hora) ?>" placeholder="HH:MM:SS">
        <?php if ($errores['hora']): ?>
            <small style="color:red; display:block; margin-top:2px;"><?= htmlspecialchars($errores['hora']) ?></small>
        <?php endif; ?>
    </label><br>

    <button type="submit">Guardar</button>
</form>
<div class="volver">
    <a href="index.php" class="boton-volver">Volver a la lista de citas</a>
</div>
</body>
</html>
