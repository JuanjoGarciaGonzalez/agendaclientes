<?php ob_start() ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <!-- estilos propios -->
    <link rel="stylesheet" href="CSS/estilos_login_registrar.css">
    <!-- links -->
    <?php include("LIBRERIAS/links.php") ?>

</head>

<body>
    <div class="registro">
        <h2>Registrarse</h2>
        <form action="#" method="POST">
            <div class="user_name">
            <i class="fas fa-user"></i><input type="text" name="user_name" required maxlength="20" placeholder="Nombre de usuario">
            </div>

            <div class="user_pass">
                <i class="fas fa-key"></i><input type="password" name="user_pass" required placeholder="Contraseña">
            </div>

            <div class="user_pass2">
                <i class="fas fa-key"></i><input type="password" name="user_pass2" required placeholder="Repite la contraseña">
            </div>

            <div class="send">
                <input type="submit" value="Guardar">
                <a href="index.php">Iniciar Sesión</a>
            </div>
        </form>
    </div>

    <div class="pie">
        Juanjo García González - 2021
    </div>



    <?php
        require_once("conexion.php");
        include("modelo_user.php");
        $usuario = new User();

        if(isset($_POST) && !empty($_POST)) {
            $nombre = $_POST["user_name"];
            $contra = $_POST["user_pass"];
            $contra2 = $_POST["user_pass2"];

            if($contra == $contra2) {
                $contra_cifrada = password_hash($contra, PASSWORD_DEFAULT, array("cost"=>15));

                $usuario -> setUser($nombre);
                $usuario -> setPass($contra_cifrada);

                $registro = $usuario -> insertar_user($usuario -> getUser(), $usuario -> getPass());
                if($registro) {
                    $class = "correcto";
                    $mensaje = "¡Te has registrado correctamente!";
                }else {
                    $class = "fallo";
                    $mensaje = "¡Error en el registro!";
                }
                header("Refresh: 3; URL=index.php");
                ?>
                    <div class="<?php echo $class ?>">
                        <?php echo $mensaje ?>
                    </div>
                <?php

            }
        }
    ob_end_flush();
    ?>
</body>

</html>