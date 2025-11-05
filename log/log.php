<?php
    session_start();
    include_once("../componentes/config/config.php");  
    include_once("../admin/abml/lectura.php");

    function validarCampos($conexion, $email, $contrasenia, $lecturaUsuarios, $lecturaAdmins) {
        if (empty($email) or empty($contrasenia)) {
            header("Location: ../paginas/login.php?ambos=a");
            return;
        }
        if (!str_contains($email,"@")) {
            header("Location: ../paginas/login.php?arroba=no");
            return;
        }

        $lecturaAdmins .= " WHERE `contrasenia`=MD5('$contrasenia')";
        
        $admins = mysqli_query($conexion,$lecturaAdmins);
        
        if ($admin = mysqli_fetch_array($admins)) {
            $idAdmin = $admin["id_admins"];

            $lecturaUsuarios .= " WHERE `id_personas`='$idAdmin'";
    
            $usuarios = mysqli_query($conexion, $lecturaUsuarios);

            if ($usuario = mysqli_fetch_array($usuarios)) {
                if ($usuario["email"] === $email) {
                    $_SESSION = $usuario;
                    header("Location: ../admin/index.php");
                }
                else {
                    header("Location: ../paginas/login.php?email=no");
                }
            }
        }
        else {
            header("Location: ../paginas/login.php?contrasenia=no");
        }
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["email"]) and isset($_POST["contrasenia"])) {
            $email = htmlspecialchars($_POST["email"]);
            $contrasenia = htmlspecialchars($_POST["contrasenia"]);
            validarCampos($conexion,$email, $contrasenia, $lecturaUsuarios, $lecturaAdmins);
        }
    }
?>