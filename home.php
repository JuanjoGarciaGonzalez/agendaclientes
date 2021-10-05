<?php
    ob_start();
    session_start();

    require_once "modelo_contacto.php";
    require_once "conexion.php";
    $contacto = new Contacto();
    //Consulta guarda el resultado en formato JSON
    $consulta = $contacto -> mostrarTodos();
    if($consulta){
        //Decodificamos los datos JSON devueltos
        $array = json_decode($consulta);
    }else {
        echo "No hay registro para mostrar";
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- estilos propios -->
    <link rel="stylesheet" href="CSS/estilos_home.css">
    <!-- links -->
    <?php include("LIBRERIAS/links.php") ?>
    <!-- bootstrap -->
    <?php include("LIBRERIAS/bootstrap.php") ?>
</head>
<body>
    <!-- navbar -->
    <?php include("LIBRERIAS/navbar.php") ?>

    <div class="correcto">
        ¡Bienvenido/a <?php echo $_SESSION['user']; ?>!
    </div>

    <h2>Listado Contactos</h2>

    <div class="tabla">
        <table>
            <tr>
                <th>ID</th>
                <th>NOMBRE</th>
                <th>APELLIDO</th>
                <th>CIUDAD</th>
                <th>DESCRIPCIÓN</th>
                <th></th>
                <th></th>
            </tr>
            <?php
            
                foreach($array as $fila){
                    $id = $fila->id;
                    $nombre = $fila->nombre;
                    $apellido = $fila->apellido;
                    $ciudad = $fila->ciudad;
                    $descripcion = $fila->descripcion;

                    ?>
                        <tr>
                            <td><?php echo $id ?></td>
                            <td><?php echo $nombre ?></td>
                            <td><?php echo $apellido ?></td>
                            <td><?php echo $ciudad ?></td>
                            <td><?php echo $descripcion ?></td>
                            <td><a href="actualizar_contacto.php?id=<?php echo $id; ?>" title="Actualizar" data-toggle="tooltip"><i class="fas fa-user-edit"></i></a></td>
                            <td><a href="borrar_contacto.php?id=<?php echo $id; ?>" title="Eliminar" data-toggle="tooltip"><i class="fas fa-user-times"></i></a></td>
                        </tr>
                    <?php
                }
            ?>
        </table>

        
    </div>

    <div class="boton-insertar">
        <a href="insertar_contacto.php" class="bg-dark">Nuevo Contacto <i class="fas fa-plus-circle"></i></a>
    </div>

    

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    <?php ob_end_flush() ?>
</body>
</html>