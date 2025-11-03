<?php
    include_once("../componentes-admin/header.php");
    include_once("../componentes/config/config.php");
    include_once("./abml/lectura.php");
    function verificarId ($id) : bool {
        if (empty($id) || !is_numeric($id)) {
            return false;
        }
        return true;
    }
?>
<main>
    <section>
        <article>
            <?php
                $id;
                if (isset($_GET["id"])) {
                    $id = $_GET["id"];
                    if (verificarId($id) == false) {
                        header("Location: pacientes.php?info=no");
                        exit();
                    }
                    $lecturaUsuarios .= " WHERE `id_personas`='$id'";
                    $lecturaSesiones .= " WHERE `fk_personas`='$id'";

                    $resultadoSesion = mysqli_query($conexion, $lecturaSesiones);
                    $resultadoUsuario = mysqli_query($conexion, $lecturaUsuarios);

                    if ($sesion = mysqli_fetch_array($resultadoSesion)) {
                        if ($persona = mysqli_fetch_array($resultadoUsuario)) {
                            echo "<h1>Paciente: $persona[nombre] $persona[apellido]</h1>";
                            echo "<h2>Detalles del paciente</h3>";
                            echo "<ul>";
                                echo "<li>Email: $persona[email]</li>";
                                echo "<li>Dni: $persona[dni]</li>";
                                echo "<li>Fecha Nacimiento: $persona[fecha_nacimiento]</li>";
                                echo "<li>Telefono: $persona[telefono]</li>";
                            echo "</ul>";
                        }
                        echo "<hr>";
                        echo "<div>";
                            echo "<h2>Sesion</h2>";
                                echo "<ul>";
                                    echo "<li>Detalles: $sesion[detalles]</li>";
                                echo "</ul>";
                        
                        $idSesion = $sesion["id_sesiones"];

                        $lecturaSesionesTratamientos .= " WHERE `fk_sesiones`='$idSesion'";
                        
                        $resultadoSesionTratamiento = mysqli_query($conexion, $lecturaSesionesTratamientos);
                        
                        echo "<h3>Tratamientos</h3>";
                        echo "<ul>";
                        while ($sesionTratamiento = mysqli_fetch_array($resultadoSesionTratamiento)) {

                            $fk_tratamiento = $sesionTratamiento["fk_tratamientos"];
                            $lecturaTratamientos .= " WHERE `id_tratamientos`=$fk_tratamiento";
                            
                            $resultadoTratamientos = mysqli_query($conexion, $lecturaTratamientos);

                            $lecturaTratamientos = "SELECT * FROM `tratamientos`";
                            
                            while ($tratamiento = mysqli_fetch_array($resultadoTratamientos)) {
                                echo "<li>$tratamiento[nombre]</li>";
                            }
                        }
                        echo "</ul>";
                        $lecturaEstados . " WHERE `id_estado`='fk_estado_sesion'";
                        $resultadoEstado = mysqli_query($conexion, $lecturaEstados);

                        if ($estado = mysqli_fetch_array($resultadoEstado)) {
                            echo "<h3>Estado: $estado[nombre]</h3>";
                        }
                        echo "</div>";
                        echo "<img src='../imagenes-subidas/$sesion[imagen]' alt=''>";
                    }
                }
                else {
                    header("Location: pacientes.php");
                }
            ?>
        </article>
    </section>
</main>
<?php
    include_once("../componentes-admin/footer.php");
?>