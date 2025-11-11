<?php
    ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


    include_once("../../componentes/config/config.php");
    include_once("lectura.php");
    function validarCamposVacios ($campo1, $campo2, $campo3, $campo4, $campo5, $campo6) : bool  {
        if (empty($campo1) or empty($campo2) or empty($campo3) or empty($campo4) or empty($campo5) or empty($campo6)) {
            return true;
        }
        return false;
    }
    if (isset($_GET["idC"])) {
        $idSesionC = $_GET["idC"];
        $consultaEstado = "UPDATE `sesiones` SET `fk_estado_sesion`=3 WHERE `id_sesiones`=$idSesionC";
        mysqli_query($conexion, $consultaEstado);
        header("Location: ../sesiones.php");
        exit();
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //modificacion usuario
        if (isset($_POST["nombre"]) and isset($_POST["apellido"]) and isset($_POST["dni"]) and isset($_POST["fecha-nacimiento"]) and isset($_POST["email"]) and isset($_POST["telefono"]) and isset($_POST["id_paciente"])) {

            $idPaciente = $_POST["id_paciente"];
            $nombre = htmlspecialchars($_POST["nombre"]);
            $apellido = htmlspecialchars($_POST["apellido"]);
            $dni = htmlspecialchars($_POST["dni"]);
            $fechaNacimiento = htmlspecialchars($_POST["fecha-nacimiento"]);
            $email = htmlspecialchars($_POST["email"]);
            $telefono = htmlspecialchars($_POST["telefono"]);

            if (validarCamposVacios(
                $nombre, 
                $apellido, 
                $dni, 
                $fechaNacimiento, 
                $email, 
                $telefono
            ) == true) { 
                header("Location: modificacion-paciente.php?mod=no");
                exit();
            }

            $consultaMod = "UPDATE `personas` SET `nombre`='$nombre',`apellido`='$apellido',`dni`='$dni',`fecha_nacimiento`='$fechaNacimiento',`telefono`='$telefono',`email`='$email' WHERE `id_personas`='$idPaciente'";
            
            $modificacionUsuario = mysqli_query($conexion, $consultaMod);
            
            header("Location: ../pacientes.php");
            exit();
        }

        //modificacion de sesion
        if (
            isset($_POST["id_sesion"]) &&
            isset($_POST["fecha"]) &&
            isset($_POST["hora"]) &&
            isset($_POST["metodos-pago"]) &&
            isset($_POST["monto"]) &&
            isset($_POST["estado"]) &&
            isset($_POST["tratamientos"]) &&
            isset($_FILES["imagen"])
        ) {
            $idSesion = $_POST["id_sesion"];

            $fecha = htmlspecialchars($_POST["fecha"]);

            $hora = htmlspecialchars($_POST["hora"]);

            $metodoPago = array_map(function ($metodo) {
                return (int) $metodo;
            }, $_POST["metodos-pago"]);

            $monto = htmlspecialchars($_POST["monto"]);

            $estado = htmlspecialchars($_POST["estado"]);

            $tratamientoss = array_map(function ($tratamiento) {
                return (int) $tratamiento;
            }, $_POST["tratamientos"]);

            $detalles = htmlspecialchars($_POST["detalles"]);

            $imagen = $_FILES["imagen"];

            if (validarCamposVacios(
                $fecha,
                $hora,
                $metodoPago,
                $monto,
                $tratamientoss,
                $imagen
            ) == true) { 
                header("Location: modificacion-sesion.php?mod=no");
                exit();
            }

            $lecturaHorarios .= " WHERE `fecha`='$fecha' and `hora`='$hora'";
            $resultadoHorarios = mysqli_query($conexion, $lecturaHorarios);

            $fk_fechas_horas = -1;
            if ($horario = mysqli_fetch_array($resultadoHorarios)) {
                $fk_fechas_horas = $horario["id_fechas_horas"];
            }

            $fk_horario;
            if ($fk_fechas_horas != -1) {
                $fk_horario = $fk_fechas_horas;
            }
            else {
                mysqli_query($conexion,"INSERT INTO `fechas_horas`(`fecha`, `hora`) VALUES ('$fecha','$hora')");
                
                $resultadoHorario = mysqli_query($conexion,$lecturaHorarios);
                
                if ($horario = mysqli_fetch_array($resultadoHorario)) {
                    $fk_horario = $horario["id_fechas_horas"];
                }
            }
            
            mysqli_query($conexion,"DELETE FROM `pago_sesiones` WHERE `fk_sesiones`='$idSesion'");

            foreach ($metodo as $metodoPago) {
                mysqli_query($conexion,"INSERT INTO `pago_sesiones`(`fk_metodos_pago`, `fk_sesiones`) VALUES ('$metodo','$idSesion')");
            }

            mysqli_query($conexion,"DELETE FROM `sesiones_tratamientos` WHERE `fk_sesiones`='$idSesion'");

            foreach ($tratamientoss as $tratamiento) { 
                mysqli_query($conexion, "INSERT INTO `sesiones_tratamientos`(`fk_sesiones`, `fk_tratamientos`) VALUES ('$idSesion','$tratamiento')");
            }
            
            $temp = $imagen["tmp_name"];
            $nombreImagen = time() . ".jpg";

            move_uploaded_file($temp, "../../imagenes-subidas/$nombreImagen");

            mysqli_query($conexion, "UPDATE `sesiones` SET `detalles`='$detalles',`imagen`='$nombreImagen', `fk_fechas_horas`='$fk_horario',`fk_estado_sesion`='$estado',`monto`='$monto' WHERE `id_sesiones`='$idSesion'");

            header("Location: ../sesiones.php?modS=ok");
        }
    }
?>