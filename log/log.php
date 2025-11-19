<?php
    session_start();
    include_once("../componentes/config/config.php");  
    include_once("../admin/abml/lectura.php");

    function validarCampos($conexion, $email, $contrasenia, $lecturaUsuarios) {
        if (empty($email) or empty($contrasenia)) {
            header("Location: ../paginas/login.php?ambos=a");
            return;
        }
        if (!str_contains($email,"@")) {
            header("Location: ../paginas/login.php?arroba=no");
            return;
        }
        $lecturaUsuarios .= " WHERE `email`='$email' and `contrasenia`=MD5('$contrasenia')";

        $resultadoUsuario = mysqli_query($conexion, $lecturaUsuarios);
        
        if ($usuario = mysqli_fetch_array($resultadoUsuario)) {
            $_SESSION = $usuario;
            if ($usuario["fk_rol"] != 3) {
                header("Location: ../admin/index.php");
                return;
            }
            header("Location: ../paginas/index.php");
            return;
        }
        header("Location: ../paginas/login.php?usuarioNoEncontrado=ok");
        return;
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["email"]) and isset($_POST["contrasenia"])) {
            $email = htmlspecialchars($_POST["email"]);
            $contrasenia = htmlspecialchars($_POST["contrasenia"]);
            validarCampos($conexion,$email, $contrasenia, $lecturaUsuarios);
        }
    }
?>