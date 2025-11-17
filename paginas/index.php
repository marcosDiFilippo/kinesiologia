<?php
    include_once("../componentes/header.php");
?>
<main id="main-index">
    <section class="section-index">
        <article class="article-bienvenida">
            <h1>Bienvenido a Balance Kinesiología</h1>
            <p>
                Somos un centro dedicado a la rehabilitación integral y al cuidado del movimiento.  
            </p>
            <p>
                Utilizamos evaluaciones funcionales para armar planes de tratamiento individualizados y acompañamos al paciente en cada etapa de su recuperación para mejorar la capacidad funcional y la calidad de vida.
            </p>
            <p>
                Ofrecemos tratamientos personalizados de kinesiología, terapia manual, recuperación postparto, reeducación postural y programas de kinesiología deportiva.
            </p>
            <p>
                Trabajamos con personas que buscan aliviar dolores musculares o articulares, recuperar movilidad después de lesiones, mejorar su postura o preparar el cuerpo para volver al deporte de manera segura. Nuestro equipo se enfoca en acompañar todo el proceso de recuperación, combinando técnicas actualizadas con ejercicios terapéuticos que ayudan a fortalecer, estabilizar y prevenir futuras molestias.
            </p>
            <p>
                También brindamos asesoramiento sobre hábitos saludables, ergonomía y estrategias para mantener una buena funcionalidad en la vida diaria. Nuestro objetivo es que cada paciente logre un equilibrio físico duradero y una mejor calidad de vida.
            </p>
            <p>
                <strong>Servicios que brindamos: </strong> <?php 
                    $indice = 0;

                    $resultadoTratamientos = mysqli_query($conexion, $lecturaTratamientos);
                    while($tratamiento = mysqli_fetch_array($resultadoTratamientos)) {
                        $indice++;
                        if ($indice == mysqli_num_rows($resultadoTratamientos)) {
                            echo "$tratamiento[nombre].";
                        }
                        else {
                            echo "$tratamiento[nombre], ";
                        }
                    }
                ?>
            </p>
        </article>
        <article>
            <img class="imagen-index" src="../imagenes/imagen-index.webp" alt="">
        </article>
    </section>
</main>
<?php
    include_once("../librerias/bootstrap-js.php");
?>
</body>
</html>