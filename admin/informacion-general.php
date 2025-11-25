<?php
    $seccion = "General";

    include_once("../componentes-admin/header.php");

    $resultadoPromedio = mysqli_query($conexion, "SELECT AVG(monto) FROM `sesiones`");

    $cantidadCompletadas = mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM `sesiones` WHERE `fk_estado_sesion`=1"));

    $cantidadProceso = mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM `sesiones` WHERE `fk_estado_sesion`=2"));

    $cantidadPendientes = mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM `sesiones` WHERE `fk_estado_sesion`=3"));

    $cantidadSesiones = mysqli_num_rows(mysqli_query($conexion,$lecturaSesiones));

    $promedioGeneral = 0;
    if ($ses = mysqli_fetch_array($resultadoPromedio) and $ses["AVG(monto)"] > 0) {
        $promedioGeneral = $ses["AVG(monto)"];
    }
?>
<main>
    <section>
        <h1 class="text-center">Estadisticas Generales</h1>
        <article class="article-stats">
            <h2>Cantidad de sesiones hechas: 
                <span>
                    <?php echo $cantidadSesiones?>
                </span>
            </h2>
            <h2>
                Precio promedio de sesiones: 
                <span>
                    $ <?php echo $promedioGeneral ?>
                </span>
            </h2>
            <h2>
                Cantidad de sesiones completadas: 
                <span>
                    <?php echo $cantidadCompletadas ?>
                </span>
            </h2>
            <h2>
                Cantidad de sesiones en proceso: 
                <span>
                    <?php echo $cantidadProceso ?>
                </span>
            </h2>
            <h2>
                Cantidad de sesiones pendientes: 
                <span>
                    <?php echo $cantidadPendientes ?>
                </span>
            </h2>
        </article>
    </section>
</main>
<?php
    include_once("../componentes-admin/footer.php");
?>