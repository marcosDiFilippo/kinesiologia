<?php
    session_start();
    include_once("../componentes/config/config.php");
    include_once("../admin/abml/lectura.php");
    include_once("../admin/validaciones.php");

    $nombre = "";
    $apellido = "";
    $email = "";
    $dniAux = "";
    $contrasenia = "";
    $contraseniaConfirmada = "";
    $fechaNacimiento;
    $telefonoAux;
    $telefono = 0;
    $dni = 0;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["nombre"]) 
            and isset($_POST["apellido"]) 
            and isset($_POST["email"]) 
            and isset($_POST["contrasenia"]) 
            and isset($_POST["contrasenia-confirmada"])
            and isset($_POST["fecha-nac"])
            and isset($_POST["telefono"])
            and isset($_POST["dni"])) {

            $nombre = htmlspecialchars($_POST["nombre"]);
            $apellido = htmlspecialchars($_POST["apellido"]);
            $email = htmlspecialchars($_POST["email"]);
            $contrasenia = htmlspecialchars($_POST["contrasenia"]);
            $contraseniaConfirmada = htmlspecialchars($_POST["contrasenia-confirmada"]);
            $fechaNacimiento = htmlspecialchars($_POST["fecha-nac"]);
            $telefonoAux = htmlspecialchars($_POST["telefono"]);
            $dniAux = htmlspecialchars($_POST["dni"]);

            $campos = [$nombre, $apellido, $email, $contrasenia, $contraseniaConfirmada, $telefonoAux, $fechaNacimiento];
            $hayCamposVacios = validarCamposVacios($campos);
            if ($hayCamposVacios == true) {
                header("Location: ../paginas/register.php?camposVacios=ok");
                exit(); 
            }

            $camposNumericos = [$telefonoAux, $dniAux];
            
            $hayCamposLetras = validarLetrasCampo($camposNumericos);

            if ($hayCamposLetras == true) {
                header("Location: ../paginas/register.php?camposNoNumericos=ok");
                exit();
            }

            $hayCamposNegativos = validarCampoNegativo($camposNumericos);
            if ($hayCamposNegativos == true) {
                header("Location: ../paginas/register.php?camposNegativos=ok");
                exit();
            }

            $emailValido = validarEmail($email, $conexion, $lecturaUsuarios);
            if ($emailValido == -1) {
                header("Location: ../paginas/register.php?emailInvalido=ok");
                exit(); 
            }
            if ($emailValido == -2) {
                header("Location: ../paginas/register.php?emailYaExiste=ok");
                exit(); 
            }

            $existeTelefono = validarTelefono($telefonoAux, $conexion, $lecturaUsuarios);
            if ($existeTelefono == true) {
                header("Location: ../paginas/register.php?telefonoYaExiste=ok");
                exit();
            }

            $telefono = (int) $telefonoAux;

            $existeDni = validarDni($dniAux, $conexion, $lecturaUsuarios);
            if ($existeDni == true) {
                header("Location: ../paginas/register.php?dniYaExiste=ok");
                exit();
            }

            $dni = (int) $dniAux;

            mysqli_query($conexion,"INSERT INTO `personas`(`nombre`, `apellido`, `dni`, `fecha_nacimiento`, `telefono`, `email`, `fk_rol`, `contrasenia`) VALUES ('$nombre','$apellido','$dni','$fechaNacimiento','$telefono','$email',3,MD5('$contrasenia'))");
            header("Location: ../paginas/login.php?registro=ok");
            exit();
        }
        else {
            header("Location: ../paginas/register.php?camposVacios=ok");
            exit(); 
        }
    }
?>