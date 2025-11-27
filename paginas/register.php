<?php
    $seccion = "Registro";
    include_once("../componentes/header.php");
?>
<main>
    <section>
        <form class="form" action="../log/reg.php" method="post">
            <?php
                if (isset($_GET['camposVacios'])) {
                    echo '<div class="alert alert-danger mt-4">Hay campos vacíos. Completá todos los datos</div>';
                }

                if (isset($_GET['camposNoNumericos'])) {
                    echo '<div class="alert alert-danger mt-4">El DNI o el teléfono contienen letras. Solo se permiten números</div>';
                }

                if (isset($_GET['camposNegativos'])) {
                    echo '<div class="alert alert-danger mt-4">Los valores numéricos no pueden ser negativos</div>';
                }

                if (isset($_GET['emailInvalido'])) {
                    echo '<div class="alert alert-danger mt-4">El email no contiene @</div>';
                }

                if (isset($_GET['emailYaExiste'])) {
                    echo '<div class="alert alert-danger mt-4">El email ya está registrado</div>';
                }

                if (isset($_GET['telefonoYaExiste'])) {
                    echo '<div class="alert alert-danger mt-4">El teléfono ya está en uso</div>';
                }

                if (isset($_GET['dniYaExiste'])) {
                    echo '<div class="alert alert-danger mt-4">El DNI ya está registrado</div>';
                }
            ?>
            <p class="title">Registrarse </p>
            <div class="flex">
                <label>
                    <input class="input" type="text" placeholder="" name="nombre" required="">
                    <span>Ingrese su nombre</span>
                </label>

                <label>
                    <input class="input" type="text" placeholder="" name="apellido" required="">
                    <span>Ingrese su apellido</span>
                </label>
            </div>
            <label>
                <input class="input" type="number" placeholder="" name="dni" required="">
                <span>Ingrese su dni</span>
            </label>
            <label class="label-date">
                <input class="input" type="date" placeholder="" name="fecha-nac" required="">
                <span>Ingrese su fecha nacimiento</span>
            </label>

            <label>
                <input class="input" type="number" placeholder="" name="telefono" required="">
                <span>Ingrese su telefono</span>
            </label>
            <label>
                <input class="input" type="email" placeholder="" name="email" required="">
                <span>Ingrese su email</span>
            </label> 
                
            <label>
                <input class="input" type="password" placeholder="" name="contrasenia" required="">
                <span>Ingrese su contrasenia</span>
            </label>
            <label>
                <input class="input" type="password" placeholder="" name="contrasenia-confirmada" required="">
                <span>Confirmar contrasenia</span>
            </label>
            <button class="submit">Registrarse</button>
            <p class="signin">Ya tienes una cuenta?<a href="login.php">Iniciar sesion</a></p>
        </form>
    </section>
</main>
<?php
    include_once("../componentes/footer.php");
?>