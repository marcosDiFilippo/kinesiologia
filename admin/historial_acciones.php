<?php
    include_once("../componentes-admin/header.php");
?>
<main>
    <section>
        <article>
            <table>
                <thead>
                    <th>
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
                        while ($accion = mysqli_fetch_array(mysqli_query($conexion, $lecturaHistorialAcciones))) {
                            echo "<tr>";
                                echo "<td>$accion[fecha]</td>";
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