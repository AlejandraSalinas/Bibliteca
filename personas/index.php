<?php
  include_once('../conexion.php');

  $query = "SELECT p.id, CONCAT(IFNULL(primer_nombre,''),' ',IFNULL(segundo_nombre,''),' ',IFNULL(primer_apellido,''),' ',IFNULL(segundo_apellido,'')) AS nombre_completo, email,  r.nombre AS rol, biografia, p.estado FROM personas AS p JOIN roles AS r ON r.id = p.id_rol WHERE p.estado = 1";
  $personas = mysqli_query($con, $query) or die(mysqli_error($con));
  
  
  $query = "SELECT id, nombre FROM roles WHERE estado = 1";
  $roles = mysqli_query($con, $query) or die(mysqli_error($con));
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bonit.css">
    <title>Biblioteca</title>
</head>
<body>
    <div class="a1">
        <a href="../index.php">Inicio</a>
    </div>
    <div class="titulo1">
        <h3>Ingrese los datos.</h3>
    </div>
    <form action="guardar.php" method="post" autocomplete="off">
        <label for="primer_nombre">Primer Nombre</label>
        <input type="text" id="primer_nombre" name="primer_nombre" required>
        <br><br>
        <label for="segundo_nombre">Segundo Nombre</label>
        <input type="text" id="segundo_nombre" name="segundo_nombre">
        <br><br>
        <label for="primer_apellido">Primer Apellido</label>
        <input type="text" id="primer_apellido" name="primer_apellido" required>
        <br><br>
        <label for="segundo_apellido">Segundo Spellido</label>
        <input type="text" id="segundo_apellido" name="segundo_apellido">
        <br><br>
    
        <label for="email">Correo Electrónico</label>
        <input type="email" name="email" id="email" required>
        <br><br>
        <label for="rol">Rol</label>
        <select id="id_rol" name="id_rol" required>
            <option selectd>Seleccione una Opción</option>
            <?php foreach($roles as $rol) : ?>
                <option value="<?=$rol['id'] ?>"><?= $rol['nombre'] ?></option>
            <?php endforeach ?>    
        </select>
        <br><br>
        <label for="biografia">Biografia</label>
        <textarea placeholder="Ingrese su biog" name="biografia" id="biografia"></textarea>
        <br><br>      
        <input type="submit" value="Guardar">
    </form>
    <h3>Personas</h3>
    <table id="customers">
        <thead>
            <tr>
                <td>Num</td>
                <td>Nombre</td>
                <td>Email</td>
                <td>Rol</td>
                <td>Biografía</td>
                <td>Estado</td>
                <td colspan="3">Opciones</td>  
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($personas) > 0){
                $pos = 1;
                while($persona = mysqli_fetch_assoc($personas)){

            ?>
                    <tr>
                        <td><?php echo $pos; ?></td>
                        <td><?php echo $persona['nombre_completo']; ?></td>
                        <td><?php echo $persona['email'];?></td>
                        <td><?php echo $persona['rol']; ?></td>
                        <td><?php echo $persona['biografia']; ?></td>
                        <td><?php echo $persona['estado'] ? 'ACTIVO' : 'INACTIVO'; ?></td>
                        <td><a class="a2" href="ver.php?id=<?php echo $persona['id']; ?>"> Ver </td>
                        <td><a class="a2" href="editar.php?id=<?php echo $persona['id']; ?>">Editar</a></td>
                        <td><a class="a2" href="eliminar.php?id=<?php echo $persona['id']; ?>" value="">Eliminar</a></td>
                    </tr>
                <?php $pos++;    
                }
            } else{ ?>
                <tr>
                    <td colspan="6">No hay Datos</td>
                </tr>  
            <?php } ?>
        </tbody>
    </table>   
</body>
</html>