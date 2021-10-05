<?php
    ob_start();
    session_start();

    require_once "modelo_contacto.php";
    require_once "conexion.php";

    $id = intVal($_GET["id"]);

    $contacto = new Contacto();

    $consulta = $contacto -> buscarPorId($id);
    if($consulta){
        //Decodificamos los datos JSON devueltos
        $array = json_decode($consulta);
    }else {
        echo "No hay registro para mostrar";
    }

    foreach ($array as $fila) {
        $nombre = $fila->nombre;
        $apellido = $fila->apellido;
        $ciudad = $fila->ciudad;
        $descripcion = $fila->descripcion;
    }

    $contacto -> setNombre($nombre);
    $contacto -> setApellido($apellido);
    $contacto -> setCiudad($ciudad);
    $contacto -> setDescripcion($descripcion);
    
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Contacto</title>
    <!-- estilos propios -->
    <link rel="stylesheet" href="CSS/estilos_home.css">
    <link rel="stylesheet" href="CSS/estilos_crud.css">
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

    <div class="atras">
        <a href="home.php" class="btn btn-dark"><i class="fas fa-long-arrow-alt-left"></i>Volver</a>
    </div>
   
    <div class="formulario">
        
        <h2>Actualizar Contacto</h2>
        
        <form action="#" method="POST">
            <input type="text" name="nombre" id="nombre" value="<?php echo $contacto -> getNombre(); ?>" required>
            <br><br>
            <input type="text" name="apellido" id="apellido" value="<?php echo $contacto -> getApellido(); ?>" required>
            <br><br>
            <input type="text" name="ciudad" id="ciudad" value="<?php echo $contacto -> getCiudad(); ?>" required>
            <br><br>
            <textarea name="descripcion" id="descripcion" rows="5" required style="width: 70%;"><?php echo $contacto -> getDescripcion(); ?></textarea>
            <div class="guardar">
                <input type="submit" value="Guardar" class="btn btn-dark">
            </div>
        </form>
    </div>

    <?php
        if(isset($_POST) && !empty($_POST)) {
            $nuevo_nombre = $_POST["nombre"];
            $nuevo_apellido = $_POST["apellido"];
            $nueva_ciudad = $_POST["ciudad"];
            $nueva_descripcion = $_POST["descripcion"];

            require_once "modelo_contacto.php";

            $contacto = new Contacto();

            $contacto -> setId($id);
            $contacto -> setNombre($nuevo_nombre);
            $contacto -> setApellido($nuevo_apellido);
            $contacto -> setCiudad($nueva_ciudad);
            $contacto -> setDescripcion($nueva_descripcion);

            $registro = $contacto -> actualizar($contacto -> getId(), $contacto -> getNombre(), $contacto -> getApellido(), $contacto -> getCiudad(), $contacto -> getDescripcion());

            if($registro) {
                $class = "insertado";
                $mensaje = "Contacto actualizado";
                header("Refresh:3;URL=home.php");
            }else {
                $class = "no-insertado";
                $mensaje = "Error al actualizar el contacto";
                header("Refresh:3;URL=home.php");
            }

            ?>
                <div class="<?php echo $class; ?>">
                    <?php echo $mensaje; ?>
                </div>
            <?php

        }
        
    
        ob_end_flush();
    ?>
</body>
</html>