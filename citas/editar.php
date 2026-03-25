<?php
include '../db/conexion.php';
$id = $_GET['id'];
$cita = $conn->query("SELECT * FROM citas WHERE id=$id")->fetch_assoc();
$mascotas = $conn->query("SELECT mascotas.*, duenos.nombre AS dueno FROM mascotas JOIN duenos ON mascotas.dueno_id = duenos.id");

$errores = ['fecha' => '', 'hora' => ''];
$fecha = '';
$hora = '';
$mascota_id = $cita['mascota_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mascota_id = $_POST['mascota_id'] ?? '';
    $fecha = $_POST['fecha'] ?? '';
    $hora = $_POST['hora'] ?? '';

    // Validar fecha mm/dd/yyyy
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

    // Validar hora (HH:MM)
    if (!preg_match('/^\d{2}:\d{2}$/', $hora)) {
        $errores['hora'] = "Ingresa una hora válida.";
    }

    if (empty($errores['fecha']) && empty($errores['hora'])) {
        $conn->query("UPDATE citas SET mascota_id=$mascota_id, fecha='$fecha_db', hora='$hora' WHERE id=$id");
        header("Location: index.php");
        exit;
    }
} else {
    // Si no es POST, precargar los valores del registro, pero fecha en mm/dd/yyyy para mostrar en input texto
    $fecha = date('m/d/Y', strtotime($cita['fecha']));
    $hora = $cita['hora'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Cita</title>
    <link rel="stylesheet" href="../css/agregar.css">
</head>
<body>
<nav>
    <img src="../imagenes/logo.png" alt="logo" class="logo" id="logo">
    <h1>Gestión Veterinaria</h1>
</nav>
<h1 id="texto_principal">Editar Cita</h1>
<form method="post">
    <label>
        Mascota:
        <select name="mascota_id">
            <?php 
            $mascotas->data_seek(0);
            while($m = $mascotas->fetch_assoc()): ?>
                <option value="<?= $m['id'] ?>" <?= ($m['id'] == $mascota_id) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($m['nombre']) ?> (Dueño: <?= htmlspecialchars($m['dueno']) ?>)
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
        <input type="text" name="hora" value="<?= htmlspecialchars($hora) ?>" placeholder="HH:MM">
        <?php if ($errores['hora']): ?>
            <small style="color:red; display:block; margin-top:2px;"><?= htmlspecialchars($errores['hora']) ?></small>
        <?php endif; ?>
    </label><br>

    <button type="submit">Actualizar</button>
</form>
<div class="volver">
    <a href="index.php" class="boton-volver">Volver a la lista de citas</a>
</div>
</body>
</html>
