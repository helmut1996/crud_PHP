<?php
$id = $_GET['id'];
$color = $_GET['color'];
$descripcion =$_GET['descripcion'];

include_once 'conexion.php';

$query_editar= 'UPDATE colores SET color=?, descripcion=? WHERE id=?';
$setencia_editar= $pdo->prepare($query_editar);
$setencia_editar->execute(array($color, $descripcion, $id));
header('location:index.php');