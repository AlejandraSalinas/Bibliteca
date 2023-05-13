<?php
    include_once("../conexion.php");
    
    $id = $_GET['id'];
    // $consulta = "SELECT * FROM libros WHERE $id = id";

    $query = "SELECT id, CONCAT(IFNULL(primer_nombre,''),' ',IFNULL(segundo_nombre,''),' ',IFNULL(primer_apellido,''),' ',IFNULL(segundo_apellido,'')) AS autor FROM personas WHERE id_rol = 1 AND estado = 1";
    $autores = mysqli_query($con, $query) or die(mysqli_error($con));

    $query  = "SELECT * FROM libros WHERE id = $id";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    $libro  = mysqli_fetch_assoc($result);

    

    //llenar select del campo de libros
    $query = "SELECT id_autor FROM libros";
    $totalibros = mysqli_query($con, $query) or die(mysqli_error($con));
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bon.css">
    <title>Bibioteca</title>
</head>
<body>
    <div class="titulo1">
        <h2>Ingrese los datos actualizados del libro.</h2>
    </div>    
    <form action="guardar.php" method="post" autocomplete="off">
        <input type="hidden" name="id" value="<?= $libro['id']; ?>">
        
        <label for="titulo">Título</label>
        <input type="text" id="titulo" name="titulo" value="<?= $libro['titulo']; ?>" required>
        <br><br>
    
        <label for="autor">Autor</label>
        <select id="id_autor" name="id_autor" aria-label="selector de autores" required>
            <?php foreach ($autores as $autor) : ?>
                <option value="<?= $autor['id'] ?>" <?= $autor['id'] == $libro['id_autor'] ? 'selected' : '' ?>><?= $autor['autor'] ?></option>";
            <?php endforeach ?>
        </select>
        <br><br>
        
        <label for="disponible">¿Se Encuentra Disponible?</label>
        <select id="disponible" name="disponible" aria-label="Selector de estado del libro" required>
            <option value="1" <?= $libro['disponible'] == 1 ? 'selected' : ''; ?>>Si</option>
            <option value="0" <?= $libro['disponible'] == 0 ? 'selected' : ''; ?>>No</option>
        </select>
        <br><br><br>
    
        <input type="submit" value="Guardar">
        <a class="a2" href="../index.php">Regresar</a>
    </form>
</body>
</html>