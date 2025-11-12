<?php
    include_once("../componentes/config/config.php");
    include_once("../componentes-admin/header.php");
    include_once("./abml/lectura.php");
?>
<main>
    <section> 
        <article class="article-table">
            <table>
                <thead>
                    <th id="th-num-tratamiento">
                        Numero Tratamiento
                    </th>
                    <th>
                        Tratamiento
                    </th>
                </thead>
                <tbody>
                    <?php
                        $tratamientos = mysqli_query($conexion, $lecturaTratamientos);

                        while ($tratamiento = mysqli_fetch_array($tratamientos)) {
                            echo "<tr>";
                            echo "<td class='num-tratamiento'>$tratamiento[id_tratamientos]</td>";
                            echo "<td>$tratamiento[nombre]</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </article>
    </section>
</main>
<?php 
    include_once("../librerias/bootstrap-js.php");
?>