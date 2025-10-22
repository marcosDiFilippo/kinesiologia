<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="../css-log/log.css">
</head>
<body>
    <main>
        <?php
            if (isset($_GET["ambos"])) {
                echo "-Ambos campos son obligatorios";
            }
            if (isset($_GET["arroba"])) {
                echo "-El email debe contener @";
            }
            if (isset($_GET["contrasenia"])) {
                echo "-La contrasenia ingresada es incorrecta";
            }
            if (isset($_GET["email"])) {
                echo "-El email ingresado no existe";
            }
        ?>
        <form action="../log/log.php" class="form" method="post">
            <p class="form-title">Iniciar Sesion</p>
            <div class="input-container">
                <input type="email" name="email" placeholder="Ingresar Email">
                <span>
                </span>
            </div>
            <div class="input-container">
                <input type="password" name="contrasenia" placeholder="Ingresar contrasenia">
            </div>
            <button type="submit" class="submit">
                Iniciar Sesion
            </button>

            <p class="signup-link">
            No tienes una cuenta?
            <a href="./registro.php">Registrarse</a>
            </p>
        </form>
    </main>
</body>
</html>