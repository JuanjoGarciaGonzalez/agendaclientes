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
    <title>Cerrar Sesión</title>
    <!-- estilos propios -->
    <link rel="stylesheet" href="CSS/estilos_home.css">
    <!-- links -->
    <?php include("LIBRERIAS/links.php") ?>
    <!-- bootstrap -->
    <?php include("LIBRERIAS/bootstrap.php") ?>
    <style>
        .pie {
            position: fixed;
            top: 0;
            text-align: left;
            width: 100%;
            color: white;
            font-family: 'Merriweather Sans', sans-serif;
            font-size: 1rem;
            font-style: italic;
            padding: 1rem;
        }
    </style>
</head>

<body>

    <div class="correcto">
        Cerrando sesión<i class="fas fa-hourglass-end"></i>
    </div>

    <div class="cerrar-sesion">
        <div style="margin: 0 auto; text-align: center">
            <h2>Cerrando la sesión para <?php echo $_SESSION["user"]; ?></h2>
            <i class="fas fa-hourglass-end fa-5x"></i>
        </div>
    </div>

    <div class="pie">
        Juanjo García González - 2021
    </div>


    <?php
    session_unset(); //borramos todas las variables de la sesión
    session_destroy(); //destruimos la sesión
    header("Refresh:3;URL=index.php");
    ob_end_flush();
    ?>
</body>

</html>