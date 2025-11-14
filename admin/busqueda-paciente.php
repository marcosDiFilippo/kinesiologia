<?php 
    include_once("../componentes/config/config.php");
    include_once("./abml/lectura.php");
    
    $dniBuscado = 0;
    $idUsuario = -1;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["dni-buscado"])) {
            $dniBuscado = htmlspecialchars($_POST["dni-buscado"]);
            
            if (empty($dniBuscado)) {
                header("Location: sesiones.php?camposVacios=ok");
                exit();
            }
            if (!is_numeric($dniBuscado)) {
                header("Locatio: sesiones.php?camposNoNumericos=ok");
                exit();
            }
            if ($dniBuscado < 0) {
                header("Location: sesiones.php?camposNegativos=ok");
                exit();
            }
            $lecturaUsuarios .= " WHERE `dni`='$dniBuscado'";
            
            $resultadoUsuario = mysqli_query($conexion, $lecturaUsuarios);
            
            if ($usuario = mysqli_fetch_array($resultadoUsuario)) {
                $idUsuario = $usuario["id_personas"];
                header("Location: sesiones.php?idU=$idUsuario");
                exit();
            }
            header("Location: sesiones.php?noEncontrado=ok");
            exit();
        }
    }
?>