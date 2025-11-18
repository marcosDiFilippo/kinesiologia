<?php
    session_start();
    if ($_SESSION == NULL) {
        header("Location: ../../index.php");
        exit();
    }
    include_once("../../componentes/config/config.php");

    $tratamiento = "";
    $selectTratamiento = "SELECT * FROM `tratamientos`";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["tratamiento"])) {
            $tratamiento = htmlspecialchars($_POST["tratamiento"]);
            
            if (empty($tratamiento)) {
                header("Location: ../tratamientos.php?camposVacios=ok");
                exit();
            }

            $resultadoTratamiento = mysqli_query($conexion, $selectTratamiento .= " WHERE `nombre`='$tratamiento'");
            
            if ($trata = mysqli_fetch_array($resultadoTratamiento)) {
                header("Location: ../tratamientos.php?camposExistentes=ok");
                exit();
            }

            mysqli_query($conexion,"INSERT INTO `tratamientos`(`nombre`) VALUES ('$tratamiento')");
            header("Location: ../tratamientos.php?alta=ok");
            exit();
        }
    }
?>