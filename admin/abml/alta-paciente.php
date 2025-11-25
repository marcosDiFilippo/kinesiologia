<?php
    session_start();
    if ($_SESSION == NULL) {
        header("Location: ../../index.php");
        exit(); 
    }
    if ($_SESSION["fk_rol"] == 3) {
        header("Location: ../../index.php");
        exit();
    }
    include_once("../../componentes/config/config.php");
    include_once("lectura.php");
    include_once("../validaciones.php");
    function realizarAltaPaciente ($nombre, $apellido, $dni, $fechaNacimiento, $email, $telefono, $conexion, $contrasenia) {
        mysqli_query($conexion,"INSERT INTO `personas`(`nombre`, `apellido`, `dni`, `fecha_nacimiento`, `telefono`, `email`, `fk_rol`, `contrasenia`) VALUES ('$nombre','$apellido','$dni','$fechaNacimiento','$telefono','$email',3,'$contrasenia')");

        mysqli_query($conexion,"INSERT INTO `historial_acciones`(`fecha`,`hora`,`descripcion`) VALUES (CURDATE(),CURTIME(),'Se agregado a $nombre  $apellido a la lista de pacientes')");

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

            $dniAux = htmlspecialchars($_POST["dni"]);

            $fechaNacimiento = htmlspecialchars($_POST["fecha-nacimiento"]);

            $email = htmlspecialchars($_POST["email"]);

            $telefonoAux = htmlspecialchars($_POST["telefono"]);

            $contrasenia = htmlspecialchars($_POST["contrasenia"]);

            $campos = [$nombre, $apellido, $dniAux, $fechaNacimiento, $email, $telefonoAux, $contrasenia];
            if (validarCamposVacios($campos) == true) {
                header("Location: ../pacientes.php?camposVacios=ok");
                exit();
            }

            $camposNumericos = [$dniAux, $telefonoAux];
            if (validarLetrasCampo($camposNumericos) == true) {
                header("Location: ../pacientes.php?camposNoNumericos=ok");
                exit();
            }

            if (validarCampoNegativo($camposNumericos) == true) {
                header("Location: ../pacientes.php?camposNegativos=ok");
                exit();
            }

            $valorEmail = validarEmail($email, $conexion, $lecturaUsuarios);
            if ($valorEmail == -1) {
                header("Location: ../pacientes.php?sinArroba=ok");
                exit();
            }  
            if ($valorEmail == -2) {
                header("Location: ../pacientes.php?emailYaRegistrado=ok");
                exit();
            }

            $valorDni = validarDni($dniAux, $conexion, $lecturaUsuarios);
            if ($valorDni == true) {
                header("Location: ../pacientes.php?dniYaRegistrado=ok");
                exit();
            }

            $valorTelefono = validarTelefono($telefonoAux, $conexion, $lecturaUsuarios);

            if ($valorTelefono == true) {
                header("Location: ../pacientes.php?telYaRegistrado=ok");
                exit();
            }
            $dni = (int) $dniAux;
            $telefono = (int) $telefonoAux;

            realizarAltaPaciente($nombre, $apellido,  $dni, $fechaNacimiento, $email, $telefono, $conexion, $contrasenia);
        }
    }
?>