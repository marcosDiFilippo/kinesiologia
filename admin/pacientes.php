<?php
    session_start();
    if ($_SESSION == NULL) {
        header("Location: ../paginas/index.php");
    }
    include_once("../componentes-admin/header.php");
    include_once("../componentes/config/config.php");
    include_once("./abml/lectura.php");
?>
<main id="main-pacientes">
    <section id="section-alta-pacientes">
        <article class="container" id="article-alta-pacientes"> 
            <form class="container-fluid" id="form-alta" action="./abml/alta-paciente.php" method="post">
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
                <div class="row">
                    <div class="col-6 text-start">
                        <label for="nombre">Nombre:</label>
                        <input class="col-11 input-paciente" type="text" name="nombre" id="nombre" placeholder="Ingresa el nombre">
                        <label for="fecha-nacimiento">Fecha Nacimiento</label>
                        <input class="col-11 input-paciente" type="date" name="fecha-nacimiento" id="fecha-nacimiento">
                        <label class="ms-2" for="email">Email:</label>
                        <input class="col-11 input-paciente" type="email" name="email" id="email" placeholder="Ingrese el email" autocomplete="additional-name">
                    </div>
                    <div class="col-6">
                        <label for="apellido">Apellido:</label>
                        <input class="col-12 input-paciente" type="text" name="apellido" id="apellido" placeholder="Ingresa el apellido">
                        <label for="dni">Dni:</label>
                        <input class="col-12 input-paciente" type="number" name="dni" id="dni" placeholder="Ingrese el dni">
                        <label for="telefono">Telefono:</label>
                        <input class="col-12 input-paciente" type="number" name="telefono" id="telefono" placeholder="Ingrese el telefono">
                    </div>
                </div>
                <div>
                    <button class="submit-paciente" type="submit" value="Cargar Paciente">Cargar Paciente</button>
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
                                <a class='links-pacientes eliminar-paciente' href='./abml/baja.php?idU=$usuario[id_personas]'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='icon icon-tabler icons-tabler-outline icon-tabler-trash'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M4 7l16 0' /><path d='M10 11l0 6' /><path d='M14 11l0 6' /><path d='M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12' /><path d='M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3' /></svg>
                                <span>
                                    Dar de baja
                                </span>
                                </a>
                                <a class='links-pacientes modificar-paciente'   href='./abml/modificacion-paciente.php?idU=$idUsuario'>
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
<?php
    include_once("../componentes-admin/footer.php");
?>