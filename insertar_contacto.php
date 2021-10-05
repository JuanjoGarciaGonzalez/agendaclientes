<?php
    ob_start();
    session_start();

    require_once "modelo_contacto.php";
    require_once "conexion.php";
    
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Contacto</title>
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
        
        <h2>Nuevo Contacto</h2>
        
        <form action="#" method="POST">
            <input type="text" name="nombre" id="nombre" placeholder="Nombre" required>
            <br><br>
            <input type="text" name="apellido" id="apellido" placeholder="Apellido" required>
            <br><br>
            <input type="text" name="ciudad" id="ciudad" placeholder="Ciudad" required>
            <br><br>
            <textarea name="descripcion" id="descripcion" rows="5" placeholder="Descripción" required style="width: 70%;"></textarea>
            <div class="guardar">
                <input type="submit" value="Guardar" class="btn btn-dark">
            </div>
        </form>
    </div>


    

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    <?php
        if(isset($_POST) && !empty($_POST)) {
            $nombre = $_POST["nombre"];
            $apellido = $_POST["apellido"];
            $ciudad = $_POST["ciudad"];
            $descripcion = $_POST["descripcion"];

            $contacto = new Contacto();

            $contacto -> setNombre($nombre);
            $contacto -> setApellido($apellido);
            $contacto -> setCiudad($ciudad);
            $contacto -> setDescripcion($descripcion);

            $registro = $contacto -> guardar($contacto -> getNombre(), $contacto -> getApellido(), $contacto -> getCiudad(), $contacto -> getDescripcion());

            if($registro) {
                $class = "insertado";
                $mensaje = "Contacto guardado";
                header("Refresh:3;URL=home.php");
            }else {
                $class = "no-insertado";
                $mensaje = "Error al guardar el contacto";
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