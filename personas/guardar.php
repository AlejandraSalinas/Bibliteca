<?php
require_once('../conexion.php');

$primer_nombre      = $_POST['primer_nombre'];
$segundo_nombre     = $_POST['segundo_nombre'];
$primer_apellido    = $_POST['primer_apellido'];
$segundo_apellido   = $_POST['segundo_apellido'];
$email              = $_POST['email'];
$id_rol             = $_POST['id_rol'];
$biografia          = $_POST['biografia'];

if (!isset($_POST['id'])) {
    $query = "INSERT INTO personas(primer_nombre, segundo_nombre, primer_apellido, segundo_apellido,  email, id_rol, biografia) VALUES('$primer_nombre', '$segundo_nombre', '$primer_apellido', '$segundo_apellido',  '$email', $id_rol, '$biografia')";
} else {
    $query = "UPDATE personas SET primer_nombre = '$primer_nombre', segundo_nombre = '$segundo_nombre', primer_apellido = '$primer_apellido', segundo_apellido = '$segundo_apellido',  email = '$email', id_rol = '$id_rol', biografia = '$biografia' WHERE id = {$_POST['id']}";
}

$result = mysqli_query($con, $query) or die(mysqli_error($con));

header("Location: ./index.php");
?>

