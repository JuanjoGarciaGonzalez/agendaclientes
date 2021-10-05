<?php ob_start() ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autenticación</title>
    <link rel="stylesheet" href="CSS/estilos_login_registrar.css">
    <!-- links -->
    <?php include("LIBRERIAS/links.php") ?>
    <!-- bootstrap -->
    <?php include("LIBRERIAS/bootstrap.php") ?> 
</head>
<body  class="inicio-sesion">
<?php
    require_once("conexion.php");
    include("modelo_user.php");
    $user = new User();

    $user_name = htmlentities(addslashes($_POST["user_name"]));
    $user_pass = htmlentities(addslashes($_POST["user_pass"]));

    $user -> setUser($user_name);
    $user -> setPass($user_pass);

    $resultado = $user -> autenticar_user($user -> getUser(), $user -> getPass());
    if($resultado) {
        $class = "correcto";
        $mensaje = "¡Usuario correcto, bienvenido/a " . $_SESSION['user'] . "!";
        ?>
            <div style="margin: 0 auto; text-align: center">
                <h2>Iniciando la sesión para <?php echo $_SESSION['user'] ?></h2>
                <i class="fas fa-hourglass-end fa-5x"></i>
            </div>
        <?php
        header("Refresh:3;URL=home.php");
    }else {
        $class = "fallo";
        $mensaje = "¡Usuario incorrecto!";
        header("Refresh:3;URL=index.php");
    }
    ?>
        <div class="<?php echo $class ?>">
            <?php echo $mensaje ?>
        </div>

        <div class="pie">
            Juanjo García González - 2021
        </div>
    <?php
    ob_end_flush();
?>
</body>
</html>
