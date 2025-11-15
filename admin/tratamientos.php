<?php
    include_once("../componentes/config/config.php");
    include_once("../componentes-admin/header.php");
    include_once("./abml/lectura.php");
?>
<main>
    <section> 
        <?php 
            if (isset($_GET["alta"])) {
                echo "<div class='alert alert-success' role='alert'>
                        Tratamiento cargado existosamente ✅
                    </div>";
            }
            if (isset($_GET["camposVacios"])) {
                echo "<div class='alert alert-danger' role='alert'>
                        No se ha ingresado nada
                    </div>";
            }
            if (isset($_GET["camposExistentes"])) {
                echo "<div class='alert alert-danger' role='alert'>
                        El tratamiento ingresado ya existe
                    </div>";
            }
            $nombreTratamiento = "";
            if (isset($_GET["baja"])) {
                $nombreTratamiento = $_GET["baja"];
                echo "<div class='alert alert-danger' role='alert'>
                        Se ha dado de baja al tratamiento $nombreTratamiento
                    </div>";
            }
        ?>
        <article>
            <form action="./abml/alta-tratamientos.php" method="post">
                <input type="text" name="tratamiento" placeholder="Ingrese el nombre del tratamiento">
                <input type="submit" value="Cargar Tratamiento">
            </form>
        </article>
        <article class="article-table">
            <table>
                <thead>
                    <th id="th-num-tratamiento">
                        Numero Tratamiento
                    </th>
                    <th>
                        Tratamiento
                    </th>
                    <th>
                        Acciones
                    </th>
                </thead>
                <tbody>
                    <?php
                        $tratamientos = mysqli_query($conexion, $lecturaTratamientos);

                        while ($tratamiento = mysqli_fetch_array($tratamientos)) {
                            echo "<tr>";
                            echo "<td class='num-tratamiento'>$tratamiento[id_tratamientos]</td>";
                            echo "<td>$tratamiento[nombre]</td>";
                            echo "<td><a class='btn btn-danger' href='./abml/baja.php?idT=$tratamiento[id_tratamientos]'>Eliminar</a></td>";
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