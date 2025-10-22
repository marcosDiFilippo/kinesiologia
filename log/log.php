<?php
    session_start();
    include_once("../componentes/config/config.php");  
    include_once("../admin/abml/lectura.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["email"]) and isset($_POST["contrasenia"])) {
            $email = htmlspecialchars($_POST["email"]);
            $contrasenia = htmlspecialchars($_POST["contrasenia"]);
            validarCampos($conexion,$email, $contrasenia, $lecturaUsuarios);
        }
    }
    function validarCampos($conexion, $email, $contrasenia, $lecturaUsuarios) {
        if (empty($email) or empty($contrasenia)) {
            header("Location: ../paginas/login.php?ambos=a");
            return;
        }
        if (!str_contains($email,"@")) {
            header("Location: ../paginas/login.php?no=no");
            return;
        }

        $lecturaUsuarios .= " WHERE `email`='$email' and `contrasenia`=MD5('$contrasenia')";

        echo $lecturaUsuarios;
        
        $resultado = mysqli_query($conexion, $lecturaUsuarios);

        if ($fila = mysqli_fetch_array($resultado)) {
            $_SESSION = $fila;

            header("Location: ../admin/index.php");
        }
        else {
            header("Location: ../paginas/login.php?log=no");
        }
    }
?>