<?php
    include_once("../../componentes/config/config.php");
    function realizarAltaPaciente ($nombre, $apellido, $dni, $fechaNacimiento, $email, $telefono, $conexion) {
        mysqli_query($conexion,"INSERT INTO `personas`(`nombre`, `apellido`, `dni`, `fecha_nacimiento`, `telefono`, `email`, `fk_rol`) VALUES ('$nombre','$apellido','$dni','$fechaNacimiento','$telefono','$email',3)");

        $mensaje = "$nombre " . " $apellido";
        header("Location: ../pacientes.php?alta=$mensaje");
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (
            isset($_POST["nombre"]) &&
            isset($_POST["apellido"]) &&
            isset($_POST["dni"]) &&
            isset($_POST["fecha-nacimiento"]) &&
            isset($_POST["email"]) &&
            isset($_POST["telefono"])
        ) {
            $nombre = htmlspecialchars($_POST["nombre"]);

            $apellido = htmlspecialchars($_POST["apellido"]);

            $dni = htmlspecialchars($_POST["dni"]);

            $fechaNacimiento = htmlspecialchars($_POST["fecha-nacimiento"]);

            $email = htmlspecialchars($_POST["email"]);

            $telefono = htmlspecialchars($_POST["telefono"]);

            realizarAltaPaciente($nombre, $apellido, $dni, $fechaNacimiento, $email, $telefono, $conexion);
        }
    }
?>