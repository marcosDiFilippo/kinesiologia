<?php
    session_start();
    include_once("../componentes/config/config.php");  
    include_once("../admin/abml/lectura.php");

    function validarCampos($conexion, $email, $contrasenia, $lecturaUsuarios) {
        if (empty($email)) {
            header("Location: ../paginas/login.php?ambos=a");
            return;
        }
        if (!str_contains($email,"@")) {
            header("Location: ../paginas/login.php?arroba=no");
            return;
        }
        $redireccion = "";

        $lecturaUsuarios .= " WHERE `email`='$email'";

        $resultadoUsuario = mysqli_query($conexion, $lecturaUsuarios);

        if ($usuario = mysqli_fetch_array($resultadoUsuario)) {
            if ($usuario["fk_rol"] != 3) {
                $redireccion = "Location: ../admin/index.php";
            }
            else {
                $redireccion = "Location: ../index.php";
            }
            if ($usuario["contrasenia"] == NULL and empty($contrasenia)) {
                header($redireccion);
                $_SESSION = $usuario;
                return;
            }
            if (md5($contrasenia) == $usuario["contrasenia"]) {
                header($redireccion);
                $_SESSION = $usuario;
                return;
            }
            header("Location: ../paginas/login.php?usuarioNoEncontrado=ok");
            return;
        }
        header("Location: ../paginas/login.php?usuarioNoEncontrado=ok");
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["email"]) and isset($_POST["contrasenia"])) {
            $email = htmlspecialchars($_POST["email"]);
            $contrasenia = htmlspecialchars($_POST["contrasenia"]);
            validarCampos($conexion,$email, $contrasenia, $lecturaUsuarios);
        }
    }
?>