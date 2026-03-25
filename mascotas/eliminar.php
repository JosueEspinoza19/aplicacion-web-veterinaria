<?php
include '../db/conexion.php';
$id = $_GET['id'];
$conn->query("DELETE FROM mascotas WHERE id=$id");
header("Location: index.php");
exit;
