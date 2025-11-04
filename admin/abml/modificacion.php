<?php
    include_once("../../componentes-admin/header.php");
    include_once("../../componentes/config/config.php");
    include_once("lectura.php");
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
    }   
    /*
    $nombre;
    $apellido; 
    $dni; 
    $fechaNacimiento; 
    $email; 
    $telefono; 
    */
    $fecha; 
    $hora; 
    $metodoPago; 
    $monto; 
    $estado; 
    $tratamientoss; 
    $detalles; 
    $imagen;
    $fk_persona;

    $lecturaSesiones .= " WHERE `id_sesiones`='$id'";

    $sesiones = mysqli_query($conexion, $lecturaSesiones);

    if ($sesion = mysqli_fetch_array($sesiones)) {
        $fk_persona = $sesion["fk_personas"];
    }
    /*
    $lecturaUsuarios .= " WHERE `id_personas`='$fk_persona'";
    $usuarios = mysqli_query($conexion, $lecturaUsuarios);
    
    if ($usuario = mysqli_fetch_array($usuarios)) {
        $nombre = $usuario["nombre"];
        $apellido = $usuario["apellido"];
        $dni = $usuario["dni"];
        $fechaNacimiento = $usuario["fecha_nacimiento"];
        $email = $usuario["email"];
        $telefono = $usuario["telefono"];
    }
    */
?>
<main>
    <section>
        <article class="container" id="article-alta-pacientes"> 
            <form class="container-fluid" id="form-modificacion" action="procesar-modificacion.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <input type="hidden" name="id_paciente" value="<?php echo $id?>">
                </div>
                <div class="row">
                    <input class="col-6" type="text" name="nombre" id="nombre" placeholder="Ingresa el nombre">
                    <input class="col-6" type="text" name="apellido" id="apellido" placeholder="Ingresa el apellido">
                </div>
                <div>
                    <label for="fecha-nacimiento">Fecha Nacimiento</label>
                    <div class="row"> 
                        <input class="col-6" type="date" name="fecha-nacimiento" id="fecha-nacimiento">
                        <input class="col-6" type="number" name="dni" id="dni" placeholder="Ingrese el dni">
                    </div>
                </div>
                <div class="row">
                    <input class="col-6" type="email" name="email" id="email" placeholder="Ingrese el email" autocomplete="additional-name">
                    <input class="col-6" type="number" name="telefono" id="telefono" placeholder="Ingrese el telefono">
                </div>
                <div>
                    <button id="submit-modificar" class="btn btn-primary col-6" type="submit" value="Modificar Paciente">Modificar Paciente</button>
                </div>
            </form>
                <?php
                    /*
                    
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
        </article>
    </section>
</main>
<script src="../../librerias/bootstrap-js"></script>
<?php
    */
    include_once("../../componentes-admin/footer.php");
?>