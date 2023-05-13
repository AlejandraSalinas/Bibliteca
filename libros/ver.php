<?php
    include_once('../conexion.php');

    $id = $_GET['id'];

    $query = "SELECT * FROM libros WHERE id = $id";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    $libro = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bon.css">
    <title>Biblioteca :: Ver</title>
</head>
<body>
    <h1>Información del Libro</h1>
    <img src="../images/<?= $id ?>.webp" alt="...">
    <h5><?= $libro['titulo'] ?></h5>
    <p class="p1">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a class="a2" href="../index.php">Regresar</a>
</body>
</html>