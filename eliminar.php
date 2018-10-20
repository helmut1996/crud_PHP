<?php
 include_once 'conexion.php';

$id=$_GET['id'];


$query_eliminar='DELETE FROM colores WHERE id=?';
$sentecia_eliminar = $pdo->prepare($query_eliminar);
$sentecia_eliminar->execute(array($id));
header('location:index.php');