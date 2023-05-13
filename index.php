<?php
   include_once('conexion.php');
   $query = "SELECT id, CONCAT(IFNULL(primer_nombre,''),' ',IFNULL(segundo_nombre,''),' ',IFNULL(primer_apellido,''),' ',IFNULL(segundo_apellido,'')) AS autor FROM personas WHERE estado = 1";
   $autores = mysqli_query($con, $query) or die(mysqli_error($con));
   
   $query = "SELECT l.id AS id, l.titulo, CONCAT(IFNULL(primer_nombre,''),' ',IFNULL(segundo_nombre,''),' ',IFNULL(primer_apellido,''),' ',IFNULL(segundo_apellido,'')) AS autor, l.disponible 
   FROM libros AS l
   JOIN personas AS p ON l.id_autor = p.id  WHERE l.estado = 1";

   $libros = mysqli_query($con, $query) or die(mysqli_error($con));
   
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bonito.css">
    <title>Biblioteca</title>
</head>
<body> 
    <div class="a1">
        <a href="./personas/index.php">PERSONAS</a>
    </div>
    <hr>
    <div class="titulo1">
     <h2>Ingrese Los Datos Del Libro..</h2>
    </div> 
    <form action="libros/guardar.php" method="post" autocomplete="off" enctype="multipart/form-data">
        
        <label for="titulo">Título del Libro</label><br>
        <input type="text" id="titulo" name="titulo" required><br><br>
        
        <label for="autor">Autor</label><br>
        <select id="id_autor" name="id_autor" aria-label="selector de autores" required>
        <option selected>Seleccione una Opcion...</option>
            <?php foreach ($autores as $autor) : ?>
                <option value="<?= $autor['id'] ?>"><?= $autor['autor']  ?></option>";
            <?php endforeach ?>
        </select><br><br>
            
        <label for="disponible">Disponible</label><br>
        <select id="disponible" name="disponible" aria-label="Selector de estado del libro"         required>
            <option selected>Seleccione una Opcion...</option>
            <option value="1">Disponible</option>
            <option value="0">No Disponible</option>
            
        </select>
        <br><br>
        <input class="boton" type="submit" value="Guardar">         
    
    </form>
    <h2>Libros Disponibles</h2>
    <table id="customers">
        <thead>
            <tr>
                <th>Num</th>
                <th>Libro</th>
                <th>Autor</th>
                <th>Disponibilidad</th>
                <th colspan="3">Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($libros) > 0) {
                $pos   = 1;
               
                while ($libro = mysqli_fetch_assoc($libros)) {
            ?>
                    <tr>
                        <td><?php echo $pos; ?></td>
                        <td><?php echo $libro['titulo']; ?></td>
                        <td><?php echo $libro['autor']; ?></td>
                        <td><?php echo $libro['disponible'] ? 'Si' : 'No'; ?></td>
                        <td><a class="a2" href="libros/ver.php?id=<?php echo $libro['id']; ?>">Ver</a></td>
                        <td><a class="a2" href="libros/editar.php?id=<?php echo $libro['id']; ?>" value="">Editar</a></td>
                        <td><a class="a2" href="libros/eliminar.php?id=<?php echo $libro['id']; ?>" value="">Eliminar</a></td>
                    </tr>
                <?php $pos++;
                }
            } else { ?>
                <tr>
                    <td colspan="6">No hay datos</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>