<?php
include_once('../conexion.php');
$id = $_GET['id'];

$query = "SELECT p.id, CONCAT(IFNULL(primer_nombre,''),' ',IFNULL(segundo_nombre,''),' ',IFNULL(primer_apellido,''),' ',IFNULL(segundo_apellido,'')) AS nombre_completo, r.nombre AS rol, p.estado FROM personas AS p JOIN roles AS r ON r.id = p.id_rol WHERE p.estado = 1";
$personas = mysqli_query($con, $query) or die(mysqli_error($con));

$query = "SELECT id, nombre FROM roles WHERE estado = 1";
$roles = mysqli_query($con, $query) or die(mysqli_error($con));

$query  = "SELECT * FROM personas WHERE id = $id";
$result = mysqli_query($con, $query) or die(mysqli_error($con));
$libro  = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bonit.css">
    <title>Biblioteca - Editar Libro</title>
</head>
<body>
    <div class="titulo1">
        <h3>Editar datos...</h3>
    </div>    
    <form action="guardar.php" method="post" autocomplete="off">
        <input type="hidden" name="id" value="<?= $libro['id']; ?>">
    
        <label for="primer_nombre">Primer nombre</label>
        <input type="text" id="primer_nombre" name="primer_nombre" value="<?= $libro['primer_nombre']; ?>" required>
        <br><br>

        <label for="segundo_nombre">Segundo nombre</label>
        <input type="text" id="segundo_nombre" name="segundo_nombre" value="<?= $libro['segundo_nombre']; ?>">
        <br><br>

        <label for="primer_apellido">Primer apellido</label>
        <input type="text" id="primer_apellido" name="primer_apellido" value="<?= $libro['primer_apellido']; ?>" required>
        <br><br>

        <label for="segundo_apellido">segundo apellido</label>
        <input type="text" id="segundo_apellido" name="segundo_apellido" value="<?= $libro['segundo_apellido']; ?>">
        <br><br>

        <label for="email">Correo electronico</label>
        <input type="mail" name="email" id="email" value="<?= $libro['email']; ?>" required>
        <br><br>

        <label for="rol" class="form-label">Rol</label>
        <select id="id_rol" name="id_rol" required>
            <option selected>Seleccione una Opcion...</option>
            <?php foreach ($roles as $rol) : ?>
                <option value="<?= $rol['id'] ?>"><?= $rol['nombre']  ?></option>";
            <?php endforeach ?>
        </select>
        <br><br>

        <label for="biografia">Biografia</label>
        <textarea placeholder="Ingrese su biog" id="biografia"></textarea>
        
        <br><br><br><br>
        <input  type="submit" value="Guardar">
        <a class="a21" href="../index.php">Regresar</a>
    </form>
</body>

</html>