<?php
    ob_start();
    session_start(); //reanudamos la sesión
    $id = intval($_GET["id"]);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Contacto</title>
    <!-- estilos propios -->
    <link rel="stylesheet" href="CSS/estilos_crud.css">
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

    <div class="atras">
        <a href="home.php" class="btn btn-dark"><i class="fas fa-long-arrow-alt-left"></i>Volver</a>
    </div>

    <div style="margin: 0 auto; text-align: center">
        <h2>¿Seguro que quires eliminar el contacto con el id <?php echo $id; ?>?</h2>
        <div class="opciones-eliminar">
            <form action="" method="POST">
                <button type="submit" class="btn btn-success" name="borrar" value="si">Si</button>
                <button type="submit" class="btn btn-danger" name="noborrar" value="no">No</button>

                <!-- para utilizar de nuevo el id recibido anteriormente, debemos de pasarlo de nuevo a través del formulario con un campo de tipo oculto -->
                <input type="hidden" name="id" value="<?php echo $id;?>">
            </form>
        </div>
    </div>

    <?php
        if(isset($_POST["borrar"])) {
            require_once("conexion.php");
            require_once("modelo_contacto.php");

            $contacto = new Contacto();

            $id = $_POST["id"];

            $contacto -> setId($id);
            $eliminar = $contacto -> borrar($contacto -> getId());

            if($eliminar) {
                $mensaje = "Contacto eliminado correctamente";
                $class = "insertado";
            }else {
                $mensaje = "Error eliminando el contacto";
                $class = "no-insertado";
            }
            header("Refresh:3; URL=home.php");
            ?>
            <div class="<?php echo $class;?>">
                <?php echo $mensaje;?>
            </div>
            <?php
        }else if(isset($_POST["noborrar"])) {
            header("Location:home.php");
        }

        ob_end_flush();
    ?>
</body>
</html>