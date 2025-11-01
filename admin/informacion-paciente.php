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
                            echo "<h3>Email: $persona[email]</h3>";
                            echo "<h3>Dni: $persona[dni]</h3>";
                            echo "<h3>Fecha Nacimiento: $persona[fecha_nacimiento]</h3>";
                            echo "<h3>Telefono: $persona[telefono]</h3>";
                        }
                        echo "<hr>";
                        echo "<h2>Detalles de la sesion</h2>";
                        echo "<h3>$sesion[detalles]</h3>";
                        
                        $idSesion = $sesion["id_sesiones"];

                        $lecturaSesionesTratamientos .= " WHERE `fk_sesiones`='$idSesion'";
                        $resultadoSesionTratamiento = mysqli_query($conexion, $lecturaSesionesTratamiento);
                        
                        while ($sesionTratamiento = mysqli_fetch_array($resultadoSesionTratamiento)) {

                            $fk_tratamiento = $sesionTratamiento["fk_tratamientos"];
                            $lecturaTratamientos .= " WHERE `id_tratamientos`='$fk_tratamiento'";

                            $resultadoTratamientos = mysqli_query($conexion, $lecturaTratamientos);
                            
                            while ($tratamiento = mysqli_fetch_array($resultadoTratamientos)) {
                                echo "<h3>$tratamiento[nombre]</h3>";
                            }
                        }
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
    include_once("../../componentes-admin/footer.php");
?>