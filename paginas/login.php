<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Sesion</title>

    <link rel="stylesheet" href="../css-log/log.css">

    <?php
        include_once("../librerias/bootstrap-css.php");
    ?>  
</head>
<body>
    <main class="mt-5">
        <?php
            if (isset($_GET["ambos"])) {
                echo "<div class='alert alert-danger' role='alert'>
                        Ambos campos son obligatorios 
                    </div>";
            }
            if (isset($_GET["arroba"])) {
                echo "<div class='alert alert-danger' role='alert'>
                        El email debe contener @
                    </div>";
            }
            if (isset($_GET["contrasenia"])) {
                echo "<div class='alert alert-danger' role='alert'>
                        La contrasenia ingresada es incorrecta 
                    </div>";
            }
            if (isset($_GET["email"])) {
                echo "<div class='alert alert-danger' role='alert'>
                        El email ingresado no existe
                    </div>";
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
        </form>
    </main>
</body>
</html>