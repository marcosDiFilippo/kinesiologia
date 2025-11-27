<?php
    $seccion = "Login";
    include_once("../componentes/header.php");
?>
    <main id="main-login">
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
            if (isset($_GET["usuarioNoEncontrado"])) {
                echo "<div class='alert alert-danger' role='alert'>
                        Ocurrio un problema al iniciar de sesion
                        <br>
                        Por favor, vuelva ingresar
                    </div>";
            }
            if (isset($_GET["registro"])) {
                echo "<div class='alert alert-success' role='alert'>
                        Te has registrado exitosamente ✅, ya puedes iniciar sesion
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
            <p>No te has registrado todavia?<a href="register.php">Registrarse</a></p>
        </form>
    </main>
<?php
    include_once("../componentes/footer.php");
?>