<?php
    ob_start();
    session_start(); //reanudamos la sesión
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producción</title>
    <!-- estilos propios -->
    <link rel="stylesheet" href="CSS/estilos_home.css">
    <link rel="stylesheet" href="CSS/estilos_crud.css">
    <!-- links -->
    <?php include("LIBRERIAS/links.php") ?>
    <!-- bootstrap -->
    <?php include("LIBRERIAS/bootstrap.php") ?>
</head>
<body class="almacen">
    <!-- navbar -->
    <?php include("LIBRERIAS/navbar.php") ?>

    <div class="correcto">
        ¡Bienvenido/a <?php echo $_SESSION['user']; ?>!
    </div>

    <div class="atras">
        <a href="home.php" class="btn btn-dark"><i class="fas fa-long-arrow-alt-left"></i>Volver</a>
    </div>

    <div style="margin: 0 auto; text-align: center">
        <h2>Producción</h2>
    </div>


    <?php
        ob_end_flush();
    ?>
</body>
</html>