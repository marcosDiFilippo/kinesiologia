<?php
    $seccion = "Historial";
    include_once("../componentes-admin/header.php");
?>
<main>
    <section>
        <article>
            <table>
                <thead>
                    <th class="ps-3">
                        Fecha
                    </th>
                    <th>
                        Hora
                    </th>
                    <th>
                        Descripcion
                    </th>
                </thead>
                <tbody>
                    <?php
                        $resultadoHistorial = mysqli_query($conexion, $lecturaHistorialAcciones);
                        
                        while ($accion = mysqli_fetch_array($resultadoHistorial)) {
                            echo "<tr>";
                                echo "<td class='ps-3'>$accion[fecha]</td>";
                                echo "<td>$accion[hora]</td>";
                                echo "<td>$accion[descripcion]</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </article>
    </section>
</main>
<?php
    include_once("../componentes-admin/footer.php");
?>