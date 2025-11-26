<?php
    include_once("../admin/abml/lectura.php");
    include_once("../componentes/config/config.php");
    function mostrarPerfil ($conexion, $lecturaSesiones) {
        $resultadoCount = mysqli_query($conexion, "SELECT COUNT(*),id_sesiones FROM `sesiones` WHERE `fk_personas`='$_SESSION[id_personas]'");

        $resultadoSelect = mysqli_query($conexion, "SELECT * FROM `sesiones` WHERE `fk_personas`='$_SESSION[id_personas]'");
        
        $cantidadTratamientos = 0;
        
        $montoGastado = 0;

        while ($sesion = mysqli_fetch_array($resultadoSelect)) {
            $resultadoTratamientos = mysqli_query($conexion, "SELECT COUNT(*) FROM `sesiones_tratamientos` WHERE `fk_sesiones`='$sesion[id_sesiones]'");
            if ($t = mysqli_fetch_array($resultadoTratamientos)) {
                $cantidadTratamientos += $t["COUNT(*)"];
            }

            $montoGastado += $sesion["monto"];
        }

        $cantidadSesiones = 0;

        if ($sesiones = mysqli_fetch_array($resultadoCount)) {
            $cantidadSesiones = $sesiones["COUNT(*)"];
        }
        echo " 
                <div class='profile-card'>
                <div class='profile-image'>
                    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='icon icon-tabler icons-tabler-outline icon-tabler-user-circle'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0' /><path d='M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0' /><path d='M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855' /></svg>
                </div>
                <div class='profile-info'>
                    <p class='profile-name'>$_SESSION[nombre] $_SESSION[apellido]</p>
                    <div class='profile-title'>Dni: $_SESSION[dni]</div>
                    <div class='profile-title'>Email: $_SESSION[email]</div>
                    <div class='profile-title'>Telefono: $_SESSION[telefono]</div>
                    <div class='profile-title'>Fecha de nacimiento: $_SESSION[fecha_nacimiento]</div>
                </div>
                <div class='stats'>
                    <div class='stat-item'>
                    <div class='stat-value'>$cantidadSesiones</div>
                    <div class='stat-label'>Cantidad de <br>sesiones</div>
                    </div>
                    <div class='stat-item'>
                    <div class='stat-value'>$ $montoGastado</div> 
                    <div class='stat-label'>Dinero <br>gastado</div>
                    </div>
                    <div class='stat-item'>
                    <div class='stat-value'>$cantidadTratamientos</div>
                    <div class='stat-label'>Cantidad de <br>tratamientos hechos</div>
                    </div>
                </div>
            </div>
        ";
    }
    function ingresarContraseniaActual ()  {
        echo "<form class='form-contrasenia-actual' action='modificacion-contrasenia.php' method='post'>
                <div class='group'>
                    <input name='contrasenia-actual' required='' type='password' class='input'>
                    <span class='highlight'></span>
                    <span class='bar'></span>
                    <label>Contrasenia actual</label>
                </div>
                <input type='submit' value='Continuar'>
            </form>";
    }
    function modificarContrasenia () {
        echo "
        <form class='form-contrasenia' action='modificacion-contrasenia.php' method='post'>
            <div>
                <div class='group'>
                    <input name='contrasenia-nueva' required='' type='password' class='input'>
                    <span class='highlight'></span>
                    <span class='bar'></span>
                    <label>Contrasenia nueva</label>
                </div>
                <div class='group'>
                    <input name='contrasenia-nueva-conf' required='' type='password' class='input'>
                    <span class='highlight'></span>
                    <span class='bar'></span>
                    <label>Confirmar contrasenia</label>
                </div>
            </div>
            <input type='submit' value='Cambiar contrasenia'>
        </form>";
    }

    session_start();
    if ($_SESSION == NULL) {
        header("Location: ../index.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuracion</title>

    <link rel="stylesheet" href="../configuracion-css/configuracion.css">
    <?php
        if (isset($_GET["contrasenia"]) == "mod") {
            echo "<link rel='stylesheet' href='../configuracion-css/modificacion-contrasenia.css'>";
        }
        if (isset($_GET["perfil"])) {
            echo "<link rel='stylesheet' href='../configuracion-css/perfil.css'>";
        }
    ?>
</head>
<body>
    <main>
        <section>
            <article>
                <div class="card">
                    <ul class="list">
                        <li class="element">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-key"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16.555 3.843l3.602 3.602a2.877 2.877 0 0 1 0 4.069l-2.643 2.643a2.877 2.877 0 0 1 -4.069 0l-.301 -.301l-6.558 6.558a2 2 0 0 1 -1.239 .578l-.175 .008h-1.172a1 1 0 0 1 -.993 -.883l-.007 -.117v-1.172a2 2 0 0 1 .467 -1.284l.119 -.13l.414 -.414h2v-2h2v-2l2.144 -2.144l-.301 -.301a2.877 2.877 0 0 1 0 -4.069l2.643 -2.643a2.877 2.877 0 0 1 4.069 0z" /><path d="M15 9h.01" /></svg>
                            <a href="configuracion.php?perfil=ok" class="label">Ver Perfil</a>
                        </li>
                    </ul>
                    <div class="separator"></div>
                    <ul class="list">
                        <li class="element">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-key"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16.555 3.843l3.602 3.602a2.877 2.877 0 0 1 0 4.069l-2.643 2.643a2.877 2.877 0 0 1 -4.069 0l-.301 -.301l-6.558 6.558a2 2 0 0 1 -1.239 .578l-.175 .008h-1.172a1 1 0 0 1 -.993 -.883l-.007 -.117v-1.172a2 2 0 0 1 .467 -1.284l.119 -.13l.414 -.414h2v-2h2v-2l2.144 -2.144l-.301 -.301a2.877 2.877 0 0 1 0 -4.069l2.643 -2.643a2.877 2.877 0 0 1 4.069 0z" /><path d="M15 9h.01" /></svg>
                            <a href="configuracion.php?contrasenia=mod" class="label">Cambiar contrasenia</a>
                        </li>
                        <li class="element">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-mail"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" /><path d="M3 7l9 6l9 -6" /></svg>
                            <a href="configuracion.php?email=mod" class="label">Cambiar email</a>
                        </li>
                    </ul>
                <div class="separator"></div>
                <ul class="list">
                    <li class="element delete">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-logout"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" /><path d="M9 12h12l-3 -3" /><path d="M18 15l3 -3" /></svg>
                        <a href="../log/cerrarSesion.php" class="label">Cerrar Sesion</a>
                    </li>
                    </ul>
                    <div class="separator"></div>
                </div>
            </article>
        </section>
        <section class="seccion-elegida">
            <article>
                <?php
                    if (isset($_GET["perfil"])) {
                        mostrarPerfil($conexion, $lecturaSesiones);
                    }
                    if (isset($_GET["contrasenia"]) == "mod") {
                        if (isset($_GET["contraInvalida"])) {
                            echo "<div class='alert alert-danger' role='alert'>
                                La contrasenia ingresada no es valida
                            </div>";
                        }
                        if (isset($_GET["contraseniaM"])) {
                            echo "<div class='alert alert-success' role='alert'>
                                Contrasenia cambiada correctamente ✅
                            </div>";
                        }

                        ingresarContraseniaActual();
                    }
                    if (isset($_GET["contraIgual"])) {
                        echo "<link rel='stylesheet' href='../configuracion-css/modificacion-contrasenia.css'>";

                        if (isset($_GET["contraseniaC"])) {
                            echo "<div class='alert alert-danger' role='alert'>
                                Las contrasenias no coinciden
                            </div>";
                        }
                        modificarContrasenia();
                    }
                ?>
            </article>
        </section>
    </main>
</body>
</html>