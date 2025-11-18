<?php
    session_start();
    if ($_SESSION == NULL) {
        header("Location: ../index.php");
        exit();
    }
    function validarCamposVacios (array $array) : bool {
        foreach ($array as $element) {
            if (empty($element)) {
                return true;
            }
        }
        return false;
    }
    function validarLetrasCampo (array $array) : bool {
        foreach ($array as $element) {
            if (!is_numeric($element)) {
                return true;
            }
        }
        return false;
    }
    function validarCampoNegativo (array $array) : bool {
        foreach ($array as $element) {
            if ($element < 0) {
                return true;
            }
        }
        return false;
    }
    function validarEmail ($email, $conexion, $lecturaUsuarios) : int {
        if (!str_contains($email,"@")) {
            return -1;
        }

        $lectura = $lecturaUsuarios . " WHERE `email`='$email'";
        $usuarios = mysqli_query($conexion, $lectura);
        if ($usuario = mysqli_fetch_array($usuarios)) {
            return -2;
        }

        return 1;
    }
    function validarDni ($dni, $conexion, $lecturaUsuarios) : bool {
        $lectura = $lecturaUsuarios . " WHERE `dni`='$dni'";
        $usuarios = mysqli_query($conexion, $lectura);
        
        if ($usuario = mysqli_fetch_array($usuarios)) {
            return true;
        }
        return false;
    }
    function validarTelefono ($telefono, $conexion, $lecturaUsuarios) : bool {
        $lectura = $lecturaUsuarios . " WHERE `telefono`='$telefono'";
        $usuarios = mysqli_query($conexion, $lectura);
        
        if ($usuario = mysqli_fetch_array($usuarios)) {
            return true;
        }
        return false;
    }
    function validarHorarios ($lecturaHorarios, $fecha, $hora, $conexion) : int {
        $lecturaHorarios .= " WHERE `fecha`='$fecha' and `hora`='$hora'";
        $resultadoHorarios = mysqli_query($conexion, $lecturaHorarios);

        if ($horario = mysqli_fetch_array($resultadoHorarios)) {
            $fk_fechas_horas = $horario["id_fechas_horas"];
            return $fk_fechas_horas;
        }
        return -1;
    }
    header("Location: index.php");
?>