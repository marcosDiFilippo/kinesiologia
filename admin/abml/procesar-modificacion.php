<?php
    include_once("../../componentes/config/config.php");

    if (isset($_GET["idC"])) {
        $idSesionC = $_GET["idC"];
        $consultaEstado = "UPDATE `sesiones` SET `fk_estado_sesion`=3 WHERE `id_sesiones`=$idSesionC";
        mysqli_query($conexion, $consultaEstado);
        header("Location: ../sesiones.php");
        exit();
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
    }
?>