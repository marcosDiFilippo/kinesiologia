<?php
    session_start();
    if ($_SESSION == NULL) {
        header("Location: ../paginas/index.php");
    }
    include_once("../componentes-admin/header.php");
    include_once("../componentes/config/config.php");
    include_once("./abml/lectura.php");
?>
    <main>
        <section id="section-form">
            <article id="article-form">
                <form class="container-fluid" action="./abml/alta-sesion.php" enctype="multipart/form-data" method="post">
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
                            <input type="time" name="hora" placeholder="Ingrese horario de la consulta">
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
                                echo "<label class='label-checkbox m-0' for='$tratamiento[nombre]'>$tratamiento[nombre]</label>";
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
                    <input type="submit" value="Cargar sesion">
                </form>
            </article>
        </section>
        <section>
            <article>
                <table>
                    <thead>
                        <th class="text-center">
                            Paciente
                        </th>
                        <th class="columna-fecha">
                            Fecha
                        </th>
                        <th>
                            Hora
                        </th>
                        <th>
                            Monto
                        </th>
                        <th>
                            Estado
                        </th>
                        <th>
                            Detalles
                        </th>
                    </thead>
                    <tbody>
                        <?php
                            $sesiones = mysqli_query($conexion,$lecturaSesiones);
                            
                            while($sesion = mysqli_fetch_array($sesiones)) {
                                $lecturaUsuarios = "SELECT * FROM `personas`";
                                $lecturaHorarios = "SELECT * FROM `fechas_horas`";
                                $lecturaEstados = "SELECT * FROM `estados_sesiones`";
                                $lecturaSesionesTratamientos = "SELECT * FROM `sesiones_tratamientos`";

                                echo "<tr>";
                                $lecturaUsuarios .= "WHERE `id_personas`='$sesion[fk_personas]'";
                                $usuarios = mysqli_query($conexion,$lecturaUsuarios);

                                if ($usuario = mysqli_fetch_array($usuarios)) {
                                    echo "<td class='columna-usuario'><p>$usuario[nombre] $usuario[apellido]</p></td>";
                                }
                                $lecturaHorarios .= "WHERE `id_fechas_horas`='$sesion[fk_fechas_horas]'";
                                $horarios = mysqli_query($conexion,$lecturaHorarios);

                                if ($horario = mysqli_fetch_array($horarios)) {
                                    echo "<td class='columna-fecha'><p>$horario[fecha]</p></td>";
                                    echo "<td><p>$horario[hora]</p></td>";
                                }
                                $lecturaEstados .= " WHERE `id_estado`='$sesion[fk_estado_sesion]'";
                                $estados = mysqli_query($conexion,$lecturaEstados);

                                echo "<td><p>$sesion[monto]</p></td>";
                                $estadoActual;
                                if ($estado = mysqli_fetch_array($estados)) {
                                    echo "<td>";
                                    echo "<p>$estado[nombre]</p>";
                                    $estadoActual = $estado["nombre"];
                                    
                                    echo "</td>";
                                }
                                $lecturaSesionesTratamientos .= " WHERE `fk_sesiones`='$sesion[id_sesiones]'";
                                $sesionesTratamientos = mysqli_query($conexion,$lecturaSesionesTratamientos);
                                /*
                                echo "<td class='columna-tratamientos'>";
                                while ($sesionTratamiento = mysqli_fetch_array($sesionesTratamientos)) {
                                    $lecturaTratamientos = "SELECT * FROM `tratamientos`";
                                    $lecturaTratamientos .= " WHERE `id_tratamientos`='$sesionTratamiento[fk_tratamientos]'";
                                    $tratamientos = mysqli_query($conexion,$lecturaTratamientos);
                                    if ($tratamiento = mysqli_fetch_array($tratamientos)) {
                                        echo "<p>$tratamiento[nombre]</p>";
                                    }
                                }
                                */
                                $verDetalles = $sesion["detalles"];
                                if (empty($verDetalles) || $verDetalles == null) {
                                    $verDetalles = "Ninguno";
                                }
                                else {
                                    $verDetalles = "<a href='informacion-sesion.php?id=$sesion[id_sesiones]'>Ver Detalles</a>";
                                }
                                if ($estadoActual != "completada") {
                                    $marcarCompletada = "<a class='marcar-completada' href='./abml/procesar-modificacion.php?idC=$sesion[id_sesiones]'>
                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='icon icon-tabler icons-tabler-outline icon-tabler-check'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M5 12l5 5l10 -10' /></svg>
                                    <span>Marcar como completada</span>
                                    </a>";
                                }
                                else {
                                    $marcarCompletada = "<svg xmlns='http://www.w3.org/2000/svg' width='30' height='35' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='icon icon-tabler icons-tabler-outline icon-tabler-checks'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M7 12l5 5l10 -10' /><path d='M2 12l5 5m5 -5l5 -5' /></svg><span class='completada'>Completada</span>";
                                }
                                echo "</td>";
                                echo "<td class='td-detalles'>
                                        $verDetalles
                                        $marcarCompletada
                                        </td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
            </article>
        </section><p>
    </main>
<script src="../js-admin/script.js"></script>
<?php
    include_once("../componentes-admin/footer.php");
?>