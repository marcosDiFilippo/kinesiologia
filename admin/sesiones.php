<?php
    include_once("../componentes-admin/header.php");
    include_once("../componentes/config/config.php");
    include_once("./abml/lectura.php");
?>
    <main>
        <section>
            <article>
                <form action="./abml/alta-sesion.php" enctype="multipart/form-data" method="post">
                    <p>
                        Elija el usuario con el que quiere realizar la sesion
                    </p>
                    <?php
                        $lecturaUsuarios .= " WHERE `fk_rol`=3";

                        $usuarios = mysqli_query($conexion,$lecturaUsuarios);
                        echo "<select name='id-usuario' id='selectUsuarios'>";
                        while ($usuario = mysqli_fetch_array($usuarios)) {
                                echo "<option value='$usuario[id_personas]'>$usuario[nombre] $usuario[apellido] - $usuario[email]</option>";
                            }
                        echo "</select>";
                    ?>
                    <div class="row"> 
                        <div class="col-6 d-flex flex-column">
                            <label for="fecha">Fecha Consulta</label>
                            <input type="date" name="fecha" id="fecha" placeholder="Ingrese fecha de la consulta">
                        </div>
                        <div class="col-6 d-flex flex-column"">
                            <label for="hora">Horario</label>
                            <input type="time" name="hora" id="hora" placeholder="Ingrese horario de la consulta">
                        </div>
                    </div>
                    <hr>
                    <div>
                        <div>
                            <div class="row d-flex align-items-center">
                                <label class="col-2" for="monto">Pago</label>
                                <input class="col-4" type="number" name="monto" id="monto" placeholder="Ingrese el monto de la sesion">
                            </div>
                            <?php
                                $metodosPago = mysqli_query($conexion,$lecturaMetodosPago);
                                
                                while($metodoPago = mysqli_fetch_array($metodosPago)) {
                                    echo "<input type='checkbox' name='metodos-pago[]' id='$metodoPago[nombre]' value='$metodoPago[id_metodos_pago]'>";
                                    echo "<label class='label-checkbox col-2' for='$metodoPago[nombre]'>$metodoPago[nombre]</label>";
                                }
                            ?>
                        </div>
                    </div>
                    <hr>
                    <div>
                        <div class="col-6 >
                            <label for="estado">Estado</label>
                            <select name="estado" id="estado">
                                <?php
                                    $estados = mysqli_query($conexion,$lecturaEstados);
                                    
                                    while($estado = mysqli_fetch_array($estados)) {
                                        echo "<option value='$estado[id_estado]'>$estado[nombre]</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div>
                        <p class="motivo-consulta">Motivo Consulta</p>
                        <div class="row">
                        <?php
                            $tratamientos = mysqli_query($conexion,$lecturaTratamientos);
                            
                            while($tratamiento = mysqli_fetch_array($tratamientos)) {
                                echo "<div class='div-checkbox col-2'>";
                                echo "<input type='checkbox' name='tratamientos[]' id='$tratamiento[nombre]' value='$tratamiento[id_tratamientos]'>";
                                echo "<label class='label-checkbox' for='$tratamiento[nombre]'>$tratamiento[nombre]</label>";
                                echo "</div>";
                            }
                        ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <textarea class="col-12" name="detalles" id="detalles" rows="10" placeholder="Ingrese los detalles sobre la consulta (Opcional)"></textarea>
                    </div>
                    <div>
                        <label for="imagen">Ingrese la imagen relacionada a la sesion</label>
                        <input type="file" name="imagen" id="imagen" required>
                    </div>
                </form>
            </article>
        </section>
        <section>
            <article>
                <table>
                    <thead>
                        <th>
                            Imagen
                        </th>
                        <th>
                            Paciente
                        </th>
                        <th>
                            Fecha
                        </th>
                        <th>
                            Horario
                        </th>
                        <th>
                            Monto
                        </th>
                        <th>
                            Estado
                        </th>
                    </thead>
                    <tbody>
                        <?php
                            $sesiones = mysqli_query($conexion,$lecturaSesiones);
                            
                            while($sesion = mysqli_fetch_array($sesiones)) {
                                $lecturaUsuarios = "SELECT * FROM `personas`";
                                echo "<tr>";
                                $lecturaUsuarios .= "WHERE `id_personas`='$sesion[fk_personas]'";
                                $usuarios = mysqli_query($conexion,$lecturaUsuarios);
                                if ($usuario = mysqli_fetch_array($usuarios)) {
                                    echo "<td>$usuario[nombre] $usuario[apellido]</td>";
                                }
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </article>
        </section>
    </main>
<script src="../js-admin/script.js"></script>
<?php
    include_once("../componentes-admin/footer.php");
?>