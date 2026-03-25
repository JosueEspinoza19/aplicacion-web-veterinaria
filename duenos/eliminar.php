<?php
include '../db/conexion.php';
$id = $_GET['id'];
$conn->query("DELETE FROM duenos WHERE id=$id");
header("Location: index.php");
exit;
?>
