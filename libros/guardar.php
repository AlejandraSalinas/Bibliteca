<?php
    include_once("../conexion.php");
    $titulo     = $_POST['titulo'];
    $id_autor   = $_POST['id_autor'];
    $disponible = $_POST['disponible'];

    if (!isset($_POST['id'])){
        $query = "INSERT INTO libros(titulo, id_autor, disponible) VALUES('$titulo', '$id_autor', '$disponible')";
    } else {
        $query = "UPDATE libros SET titulo = '$titulo', id_autor = '$id_autor', disponible = {$disponible} WHERE id = {$_POST['id']}";
    }

    $result = mysqli_query($con, $query) or die(mysqli_error($con));

    if ($result) {
        $carpeta = "../img";
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $ext = "webp";
        $tmp_name = $_FILES['image']['tmp_name'];
        $id = $con->insert_id;
        
        $name = $id.".".$ext ;
        
        move_uploaded_file($tmp_name, "$carpeta/$name");
    }
    
    header("Location: ../index.php");

?>