<?php
    include_once("../componentes-admin/header.php");
    include_once("../componentes/config/config.php");
    include_once("./abml/lectura.php");
?>
    <main>
        <section id="section-form">
            <article id="article-form">
                <?php 
                    if (isset($_GET["alta"])) {
                        echo "<div class='alert alert-success' role='alert'>
                                Sesion cargada existosamente ✅
                            </div>";
                    }
                    if (isset($_GET["camposVacios"])) {
                        echo "<div class='alert alert-danger' role='alert'>
                                Todos los campos son obligatorios
                            </div>";
                    }
                    if (isset($_GET["camposNoNumericos"])) {
                        echo "<div class='alert alert-danger' role='alert'>
                                Has ingresado letras en campos numericos, por favor vuelva ingresar 
                            </div>";
                    }
                    if (isset($_GET["camposNegativos"])) {
                        echo "<div class='alert alert-danger' role='alert'>
                                El monto no puede ser negativo, por favor vuelva ingresar   
                            </div>";
                    }
                    if (isset($_GET["noEncontrado"])) {
                        echo "<div class='alert alert-danger' role='alert'>
                                El usuario no ha sido encontrado 
                            </div>";
                    }
                    if (isset($_GET["usuarioNoIngresado"])) {
                        echo "<div class='alert alert-danger' role='alert'>
                                No se ha ingresado ningun usuario 
                            </div>";
                    }
                    if (isset($_GET["bajaS"])) {
                        echo "<div class='alert alert-danger' role='alert'>
                                Se ha dado de baja la sesion
                            </div>";
                    }
                    $idBuscado = -1;
                    if (isset($_GET["idU"])) {
                        $idBuscado = htmlspecialchars($_GET["idU"]);
                        $lecturaUsuarios .= " WHERE `id_personas`='$idBuscado'";

                        if ($usuario = mysqli_fetch_array(mysqli_query($conexion,$lecturaUsuarios))) {
                            echo "<div><a class='cancelar-usuario' href='$_SERVER[PHP_SELF]'>Cancelar Usuario</a></div>";
                            echo "<div>";
                            echo "<p><span class='datos-paciente'>Paciente:</span> $usuario[nombre]  $usuario[apellido]</p>";
                            echo "<p><span class='datos-paciente'>Dni:</span> $usuario[dni]</p>";
                            echo "<p><span class='datos-paciente'>Telefono:</span> $usuario[telefono]</p>";
                            echo "<p><span class='datos-paciente'>Email:</span> $usuario[email]</p>";
                            echo "<p><span class='datos-paciente'>Fecha Nacimiento:</span> $usuario[fecha_nacimiento]</p>";
                            echo "</div>";
                        }
                    }
                    else {
                        echo "<div class='div-busqueda'>";
                            echo "<form action='busqueda-paciente.php' method='post'>
                                    <input type='number' name='dni-buscado' placeholder='Ingrese el dni del paciente'>
                                    <input type='submit' value='Buscar Paciente'>
                                </form>";
                        echo "</div>";
                    }
                ?>
                <form class="container-fluid" action="./abml/alta-sesion.php" enctype="multipart/form-data" method="post">
                    <?php 
                        $idPaciente = 0;
                        if (isset($_GET["idP"])) {
                            $idPaciente = $_GET["idP"];
                        }
                    ?>
                    <div>
                        <input type="hidden" name="id-usuario" value="<?php echo $idBuscado?>">
                    </div>
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
                <table id="tabla-sesion">
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

                                echo "<td><p>$ $sesion[monto]</p></td>";
                                $estadoActual;
                                if ($estado = mysqli_fetch_array($estados)) {
                                    echo "<td>";
                                    echo "<p>$estado[nombre]</p>";
                                    $estadoActual = $estado["nombre"];
                                    
                                    echo "</td>";
                                }
                                $lecturaSesionesTratamientos .= " WHERE `fk_sesiones`='$sesion[id_sesiones]'";
                                $sesionesTratamientos = mysqli_query($conexion,$lecturaSesionesTratamientos);
                                
                                $verDetalles = "<a href='informacion-sesion.php?id=$sesion[id_sesiones]'>Ver Detalles</a>";

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
        </section>
    </main>
<?php
    include_once("../componentes-admin/footer.php");
?>