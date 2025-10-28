<?php
    include_once("../componentes-admin/header.php");
    include_once("../componentes/config/config.php");
    include_once("./abml/lectura.php");
?>
<main>
    <section id="section-alta-pacientes">
        <article>
            <form id="form-alta" action="./abml/alta.php" method="post" enctype="multipart/form-data">
                <div>
                    <input type="text" name="nombre" id="nombre" placeholder="Ingresa el nombre">
                    <input type="text" name="apellido" id="apellido" placeholder="Ingresa el apellido">
                </div>
                <div>
                    <label for="fecha-nacimiento">Fecha Nacimiento</label>
                    <div>
                        <input type="date" name="fecha-nacimiento" id="fecha-nacimiento">
                        <input type="number" name="dni" id="dni" placeholder="Ingrese el dni">
                    </div>
                </div>
                <div>
                    <input type="email" name="email" id="email" placeholder="Ingrese el email" autocomplete="additional-name">
                    <input type="number" name="telefono" id="telefono" placeholder="Ingrese el telefono">
                </div>
                <div>   
                    <label for="fecha">Fecha Consulta</label>
                    <div>
                        <input type="date" name="fecha" id="fecha" placeholder="Ingrese fecha de la consulta">
                        <input type="time" name="hora" id="hora" placeholder="Ingrese horario de la consulta">
                    </div>
                </div>
                <div>
                    <label for="monto">Pago</label>
                    <input type="number" name="monto" id="monto" placeholder="Ingrese el monto de la sesion">
                    <div class="checkbox-metodos-pago">
                        <?php
                        $metodosPago = mysqli_query($conexion,$lecturaMetodosPago);
                        
                        while($metodoPago = mysqli_fetch_array($metodosPago)) {
                            echo "<input type='checkbox' name='metodos-pago[]' id='$metodoPago[nombre]' value='$metodoPago[id_metodos_pago]'>";
                            echo "<label class='label-checkbox' for='$metodoPago[nombre]'>$metodoPago[nombre]</label>";
                        }
                        ?>
                    </div>
                </div>
                <label for="estado">Estado</label>
                <select name="estado" id="estado">
                    <?php
                        $estados = mysqli_query($conexion,$lecturaEstados);
                        
                        while($estado = mysqli_fetch_array($estados)) {
                            echo "<option value='$estado[id_estado]'>$estado[nombre]</option>";
                        }
                    ?>
                    </select>
                    <div>
                        <p class="motivo-consulta">Motivo Consulta</p>
                        <div class="div-consulta">
                        <?php
                            $tratamientos = mysqli_query($conexion,$lecturaTratamientos);
                            
                            while($tratamiento = mysqli_fetch_array($tratamientos)) {
                                echo "<div class='div-checkbox'>";
                                echo "<input type='checkbox' name='tratamientos[]' id='$tratamiento[nombre]' value='$tratamiento[id_tratamientos]'>";
                                echo "<label class='label-checkbox' for='$tratamiento[nombre]'>$tratamiento[nombre]</label>";
                                echo "</div>";
                            }
                        ?>
                    </div>
                </div>
                <div>
                    <textarea name="detalles" id="detalles" rows="10" placeholder="Ingrese los detalles sobre la consulta (Opcional)"></textarea>
                </div>
                <div>
                    <label for="imagen">Ingrese la imagen relacionada a la sesion</label>
                    <input type="file" name="imagen" id="imagen" required>
                </div>
                <div>
                    <button id="submit-alta" class="btn btn-primary" type="submit" value="Cargar Paciente">Cargar Paciente</button>
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
                        <thead>
                            Email
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
                            ";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </article>
    </section>
</body>
</main>
</html>