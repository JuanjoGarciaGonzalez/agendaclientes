<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <!-- estilos propios -->
    <link rel="stylesheet" href="CSS/estilos_login_registrar.css">
    <!-- links -->
    <?php include("LIBRERIAS/links.php") ?>

</head>

<body>
    <div class="registro">
        <h2>Iniciar Sesión</h2>
        <form action="autenticar.php" method="POST">
            <div class="user_name">
                <i class="fas fa-user"></i><input type="text" name="user_name" required maxlength="20" placeholder="Nombre de usuario">
            </div>

            <div class="user_pass">
                <i class="fas fa-key"></i><input type="password" name="user_pass" required placeholder="Contraseña">
            </div>

            <div class="send">
                <input type="submit" value="Entrar">
                <div class="enlace"><span>¿No tienes cuenta?</span><a href="registrar.php">Regístrate</a></div>
            </div>
        </form>
    </div>

    <div class="pie">
        Juanjo García González - 2021
    </div>
</body>

</html>