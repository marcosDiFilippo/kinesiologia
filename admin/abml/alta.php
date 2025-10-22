<?php
    include_once("../../componentes/config/config.php");
    include_once("./lectura.php");
    function validarSubida ($nombre, $apellido, $dni, $fechaNacimiento, $email, $telefono, $fecha, $hora, $metodoPago, $monto, $estado, $tratamientoss, $conexion, $lecturaUsuarios) {
        if (
            empty($nombre) or
            empty($apellido) or
            empty($dni) or
            empty($fechaNacimiento) or
            empty($email) or
            empty($telefono) or
            empty($fecha) or
            empty($hora) or
            empty($monto) or
            empty($estado) or
            empty($metodoPago) or
            empty($tratamientoss)
        ) {
            header("Location: ../pacientes.php?campos=vacios");
            return;
        }
        if  (!str_contains($email,"@")) {
            header("Location: ../pacientes.php?email=no");
            return;
        }
        $lecturaUsuarios .= " WHERE `email`='$email' or `dni`='$dni'";
        $usuarios = mysqli_query($conexion, $lecturaUsuarios);

        if ($usuario = mysqli_fetch_array($usuarios)) {
            header("Location: ../pacientes.php?campos=existentes");
            return;
        }
        else {
            realizarAlta($nombre, $apellido, $dni, $fechaNacimiento, $email, $telefono, $fecha, $hora, $metodoPago, $monto, $estado, $conexion);
        }
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (
            isset($_POST["nombre"]) &&
            isset($_POST["apellido"]) &&
            isset($_POST["dni"]) &&
            isset($_POST["fecha-nacimiento"]) &&
            isset($_POST["email"]) &&
            isset($_POST["telefono"]) &&
            isset($_POST["fecha"]) &&
            isset($_POST["hora"]) &&
            isset($_POST["metodos-pago"]) &&
            isset($_POST["monto"]) &&
            isset($_POST["estado"]) &&
            isset($_POST["tratamientos"])
        ) {
            $nombre = htmlspecialchars($_POST["nombre"]);

            $apellido = htmlspecialchars($_POST["apellido"]);

            $dni = htmlspecialchars($_POST["dni"]);

            $fechaNacimiento = htmlspecialchars($_POST["fecha-nacimiento"]);

            $email = htmlspecialchars($_POST["email"]);

            $telefono = htmlspecialchars($_POST["telefono"]);

            $fecha = htmlspecialchars($_POST["fecha"]);

            $hora = htmlspecialchars($_POST["hora"]);

            $metodoPago = array_map(function ($metodo) {
                return htmlspecialchars($metodo);
            }, $_POST["metodos-pago"]);

            $monto = htmlspecialchars($_POST["monto"]);

            $estado = htmlspecialchars($_POST["estado"]);

            $tratamientoss = array_map(function ($tratamiento) {
                return htmlspecialchars($tratamiento);
            }, $_POST["tratamientos"]);

            validarSubida($nombre, $apellido, $dni, $fechaNacimiento, $email, $telefono, $fecha, $hora, $metodoPago, $monto, $estado, $tratamientoss, $conexion, $lecturaUsuarios);
        }
    }
    function realizarAlta ($nombre, $apellido, $dni, $fechaNacimiento, $email, $telefono, $fecha, $hora, $metodoPago, $monto, $estado, $conexion) {
        mysqli_query($conexion,"INSERT INTO `personas`(`nombre`, `apellido`, `dni`, `fecha_nacimiento`, `telefono`, `email`) VALUES ('$nombre','$apellido','$dni','$fechaNacimiento','$telefono','$email')");

        mysqli_query($conexion,"");
    }
?>