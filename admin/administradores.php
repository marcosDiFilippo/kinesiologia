<?php
    include_once("../componentes/config/config.php");
    include_once("./abml/lectura.php");
    include_once("../componentes-admin/header.php");

?> 
<main>
    <section>
        <article class="article-table">
            <table>
                <thead>
                    <th>
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
                    $admins = mysqli_query($conexion, $lecturaAdmins);
                    while ($admin = mysqli_fetch_array($admins)) {
                            $personas = mysqli_query($conexion, $lecturaUsuarios . " WHERE `id_personas`='$admin[fk_personas]'");
                            
                        while ($persona = mysqli_fetch_array($personas)) {
                                echo "<tr>";
                                echo "<td>$persona[nombre] $persona[apellido]</td>
                                <td>$persona[email]</td>
                                <td>$persona[telefono]</td>
                                <td>$persona[dni]</td>
                                <td>$persona[fecha_nacimiento]</td>";
                                echo "</tr>";
                            }
                        }
                    ?>
                </tbody>
            </table>
        </article>
    </section>
</main>
</body>
</html>