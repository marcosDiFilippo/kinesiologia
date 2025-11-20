<?php
    if ($_SESSION["fk_rol"] != 1) {
        header("Location: index.php");
    }
    $seccion = "Administradores";

    include_once("../componentes/config/config.php");
    include_once("./abml/lectura.php");
    include_once("../componentes-admin/header.php");
?> 
<main>
    <section>
        <article class="article-table">
            <table>
                <thead>
                    <th class="columna-nombre">
                        Nombre Completo
                    </th>
                    <th>
                        Email
                    </th>
                    <th>
                        Telefono
                    </th>
                    <th>
                        Dni
                    </th>
                    <th>
                        Fecha Nacimiento
                    </th>
                </thead>
                <tbody>
                    <?php
                    $lecturaUsuarios .= " WHERE `fk_rol`!=3";
                    $admins = mysqli_query($conexion, $lecturaUsuarios);
                        while ($admin = mysqli_fetch_array($admins)) {
                                echo "<tr>";
                                echo "<td class='columna-nombre'>$admin[nombre] $admin[apellido]</td>
                                <td>$admin[email]</td>
                                <td>$admin[telefono]</td>
                                <td>$admin[dni]</td>
                                <td>$admin[fecha_nacimiento]</td>";
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
</body>
</html>