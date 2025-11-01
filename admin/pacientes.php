<?php
    include_once("../componentes-admin/header.php");
    include_once("../componentes/config/config.php");
    include_once("./abml/lectura.php");
?>
<main id="main-pacientes">
    <section>
        <article id="article-buttons">
            <button class="d-flex align-items-center" id="button-alta">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                Agregar Paciente
            </button>
            <button id="cerrar">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-x"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12" /><path d="M6 6l12 12" /></svg>
            </button>
        </article>
    </section>
    <section id="section-alta-pacientes">
        <article class="container" id="article-alta-pacientes"> 
            <?php
                if (isset($_GET["alta"])) {
                    echo "<div class='alert alert-success' role='alert'>
                            Paciente cargado $_GET[alta]  
                        </div>";
                }
                if (isset($_GET["baja"])) {
                    echo "<div class='alert alert-danger' role='alert'>
                            Se dio de baja al paciente $_GET[baja]  
                        </div>";
                }
            ?>
            <form class="container-fluid" id="form-alta" action="./abml/alta.php" method="post" enctype="multipart/form-data">
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
                <div>
                    <button id="submit-alta" class="btn btn-primary col-6" type="submit" value="Cargar Paciente">Cargar Paciente</button>
                </div>
            </form>
        </article>
    </section>
    <section>
        <article class="article-talbe">
            <table>
                <thead>
                    <tr>
                        <th>
                            Nombre Completo
                        </th>
                        <th>
                            Dni
                        </th>
                        <th>
                            Fecha Nacimiento
                        </th>
                        <th>
                            Telefono
                        </th>
                        <th>
                            Email
                        </th>
                        <th>
                            Detalles
                        </th>
                        <th>
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $lecturaUsuarios .= "WHERE `fk_rol`=3";
                        
                        $usuarios = mysqli_query($conexion,$lecturaUsuarios);
                        
                        while($usuario = mysqli_fetch_array($usuarios)) {
                            echo "<tr>";
                            echo "<td>$usuario[nombre] $usuario[apellido]</td>
                            <td>$usuario[dni]</td>
                            <td>$usuario[fecha_nacimiento]</td>
                            <td>$usuario[telefono]</td>
                            <td>$usuario[email]</td>
                            <td><a class='links-detalles' href='informacion-paciente.php?id=$usuario[id_personas]'>Ver detalles</a></td>
                            <td class='td-links'>
                                <a class='links-pacientes eliminar-paciente' href='./abml/baja.php?id=$usuario[id_personas]'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='icon icon-tabler icons-tabler-outline icon-tabler-trash'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M4 7l16 0' /><path d='M10 11l0 6' /><path d='M14 11l0 6' /><path d='M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12' /><path d='M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3' /></svg>
                                <span>
                                    Dar de baja
                                </span>
                                </a>
                                <a class='links-pacientes modificar-paciente'   href='./abml/modificacion.php'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='icon icon-tabler icons-tabler-outline icon-tabler-pencil'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4' /><path d='M13.5 6.5l4 4' /></svg>
                                <span>
                                    Editar
                                </span>
                                </a>
                            </td>
                            ";
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