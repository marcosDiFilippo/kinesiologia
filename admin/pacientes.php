<?php
    include_once("../componentes-admin/header.php");
    include_once("../componentes/config/config.php");
    include_once("./abml/lectura.php");
?>
<main id="main-pacientes">
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
    <section id="section-alta-pacientes">
        <article class="container" id="article-alta-pacientes"> 
            <form class="container-fluid" id="form-alta" action="./abml/alta-paciente.php" method="post">
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
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $idUsuario;

                        $lecturaUsuarios .= "WHERE `fk_rol`=3";
                        
                        $usuarios = mysqli_query($conexion,$lecturaUsuarios);
                        
                        while($usuario = mysqli_fetch_array($usuarios)) {
                            $idUsuario = $usuario["id_personas"];
                            
                            echo "<tr>";
                            echo "<td>$usuario[nombre] $usuario[apellido]</td>
                            <td>$usuario[dni]</td>
                            <td>$usuario[fecha_nacimiento]</td>
                            <td>$usuario[telefono]</td>
                            <td>$usuario[email]</td>
                            <td class='td-links'>
                                $botonCompletado
                                <a class='links-pacientes eliminar-paciente' href='./abml/baja.php?id=$usuario[id_personas]'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='icon icon-tabler icons-tabler-outline icon-tabler-trash'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M4 7l16 0' /><path d='M10 11l0 6' /><path d='M14 11l0 6' /><path d='M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12' /><path d='M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3' /></svg>
                                <span>
                                    Dar de baja
                                </span>
                                </a>
                                <a class='links-pacientes modificar-paciente'   href='./abml/modificacion.php?id=$idUsuario'>
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