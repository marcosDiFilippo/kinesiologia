<?php
    session_start();
    if ($_SESSION == NULL) {
        header("Location: ../index.php");
        exit();
    }
    include_once("../componentes/config/config.php");
    include_once("../admin/abml/lectura.php");
    function validarContrasenia ($contraseniaActual, $lecturaUsuarios, $conexion) : bool {
        $resultado = mysqli_query($conexion, $lecturaUsuarios .= " WHERE `contrasenia`=MD5('$contraseniaActual')");
        
        if ($usuario = mysqli_fetch_array($resultado)) {
            return true;
        }

        return false;
    }

    $contraseniaActual = "";
    $contraseniaNueva = "";
    $contraseniaConfirmada = "";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["contrasenia-actual"])) {
            $contraseniaActual = htmlspecialchars($_POST["contrasenia-actual"]);
            
            $esIgual = validarContrasenia($contraseniaActual, $lecturaUsuarios, $conexion);
            if ($esIgual == true) {
                header("Location: configuracion.php?contraIgual=ok");
                exit();
            }
            header("Location: configuracion.php?contrasenia=mod&contraInvalida=ok");
            exit();
        }
        if (isset($_POST["contrasenia-nueva"]) and isset($_POST["contrasenia-nueva-conf"])) {
            $contraseniaNueva = htmlspecialchars($_POST["contrasenia-nueva"]);
            $contraseniaConfirmada = htmlspecialchars($_POST["contrasenia-nueva-conf"]);
        
            if ($contraseniaNueva !== $contraseniaConfirmada) {
                header("Location: configuracion.php?contraIgual=ok&contraseniaC=no");
                exit();
            }
            mysqli_query($conexion, "UPDATE `personas` SET `contrasenia`=MD5('$contraseniaNueva') WHERE `id_personas`='$_SESSION[id_personas]'");
            header("Location: configuracion.php?contrasenia=mod&contraseniaM=ok");
            exit();
        }
    }
?>