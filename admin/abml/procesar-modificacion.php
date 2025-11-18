<?php
    session_start();
    if ($_SESSION == NULL) {
        header("Location: ../../index.php");
        exit();
    }
    include_once("../../componentes/config/config.php");
    include_once("lectura.php");
    include_once("../validaciones.php");

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

            $emailAnterior;
            $telefonoAnterior;
            $dniAnterior;
            $lectura = $lecturaUsuarios . " WHERE `id_personas`='$idPaciente'";
            $usuarios = mysqli_query($conexion, $lectura);

            if ($usuario = mysqli_fetch_array($usuarios)) {
                $emailAnterior = $usuario["email"];
                $telefonoAnterior = $usuario["telefono"];
                $dniAnterior = $usuario["dni"];
            }

            $nombre = htmlspecialchars($_POST["nombre"]);

            $apellido = htmlspecialchars($_POST["apellido"]);

            $dniAux = htmlspecialchars($_POST["dni"]);

            $fechaNacimiento = htmlspecialchars($_POST["fecha-nacimiento"]);

            $email = htmlspecialchars($_POST["email"]);

            $telefonoAux = htmlspecialchars($_POST["telefono"]);

            $campos = [$nombre, $apellido, $dniAux, $fechaNacimiento, $email, $telefonoAux];
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

            if ($emailAnterior !== $email) {
                $valorEmail = validarEmail($email, $conexion, $lecturaUsuarios);
                if ($valorEmail == -1) {
                    header("Location: ../pacientes.php?sinArroba=ok");
                    exit();
                }  
                if ($valorEmail == -2) {
                    header("Location: ../pacientes.php?emailYaRegistrado=ok");
                    exit();
                }
            }

            if ($dniAnterior !== $dniAux) {
                $valorDni = validarDni($dniAux, $conexion, $lecturaUsuarios);
                if ($valorDni == true) {
                    header("Location: ../pacientes.php?dniYaRegistrado=ok");
                    exit();
                }
            }

            if ($telefonoAnterior !== $telefonoAux) {
                $valorTelefono = validarTelefono($telefonoAux, $conexion, $lecturaUsuarios);
    
                if ($valorTelefono == true) {
                    header("Location: ../pacientes.php?telYaRegistrado=ok");
                    exit();
                }
            }
            $dni = (int) $dniAux;
            $telefono = (int) $telefonoAux;

            $consultaMod = "UPDATE `personas` SET `nombre`='$nombre',`apellido`='$apellido',`dni`='$dni',`fecha_nacimiento`='$fechaNacimiento',`telefono`='$telefono',`email`='$email' WHERE `id_personas`='$idPaciente'";
            
            $modificacionUsuario = mysqli_query($conexion, $consultaMod);
            
            header("Location: ../pacientes.php?mod=ok");
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

            $monto = (double) htmlspecialchars($_POST["monto"]);

            $estado = (int) htmlspecialchars($_POST["estado"]);

            $tratamientoss = array_map(function ($tratamiento) {
                return $tratamiento;
            }, $_POST["tratamientos"]);

            $detalles = htmlspecialchars($_POST["detalles"]);

            $imagen = $_FILES["imagen"];

            $metodosPagoString = "";

            $tratamientosString = "";

            foreach ($metodoPago as $metodo) {
                $metodosPagoString .= $metodo;
            }
            foreach ($tratamientoss as $trata) {
                $tratamientosString .= $trata;
            }

            $campos = [$fecha, $hora, $metodosPagoString, $monto, $estado, $tratamientosString, $imagen];

            if (validarCamposVacios($campos) == true) {
                header("Location: modificacion-sesion.php?camposVacios=ok&idS=$idSesion");
                exit();
            }

            $camposNumericos = [$metodosPagoString, $tratamientosString, $monto];
            if (validarLetrasCampo($camposNumericos) == true) {
                header("Location: modificacion-sesion.php?campoNoNumericos=ok&idS=$idSesion");
                exit();
            }

            $posiblesCamposNegativos = array_map(function ($numero) {
                return (float) $numero;
            }, $camposNumericos);

            if (validarCampoNegativo($posiblesCamposNegativos) == true) {
                header("Location: modificacion-sesion.php?camposNegativos=ok&idS=$idSesion");
                exit();
            }

            $fk_horario_aux = validarHorarios(
                $lecturaHorarios,
                $fecha, 
                $hora, 
                $conexion
            );

            $fk_horario;
            if ($fk_horario_aux != -1) {
                $fk_horario = $fk_horario_aux;
            }
            else {
                mysqli_query($conexion,"INSERT INTO `fechas_horas`(`fecha`, `hora`) VALUES ('$fecha','$hora')");

                $lecturaHorarios .= " WHERE `fecha`='$fecha' and `hora`='$hora'";
                
                $resultadoHorario = mysqli_query($conexion,$lecturaHorarios);
                
                if ($horario = mysqli_fetch_array($resultadoHorario)) {
                    $fk_horario = $horario["id_fechas_horas"];
                }
            }
            
            mysqli_query($conexion,"DELETE FROM `pago_sesiones` WHERE `fk_sesiones`='$idSesion'");

            foreach ($metodoPago as $metodo) {
                mysqli_query($conexion,"INSERT INTO `pago_sesiones`(`fk_metodos_pago`, `fk_sesiones`) VALUES ('$metodo','$idSesion')");
            }

            mysqli_query($conexion,"DELETE FROM `sesiones_tratamientos` WHERE `fk_sesiones`='$idSesion'");

            foreach ($tratamientoss as $tratamiento) { 
                mysqli_query($conexion, "INSERT INTO `sesiones_tratamientos`(`fk_sesiones`, `fk_tratamientos`) VALUES ('$idSesion','$tratamiento')");
            }
            
            $temp = $imagen["tmp_name"];
            $nombreImagen = time() . ".webp";

            move_uploaded_file($temp, "../../imagenes-subidas/$nombreImagen");

            mysqli_query($conexion, "UPDATE `sesiones` SET `detalles`='$detalles',`imagen`='$nombreImagen', `fk_fechas_horas`='$fk_horario',`fk_estado_sesion`='$estado',`monto`='$monto' WHERE `id_sesiones`='$idSesion'");

            header("Location: ../informacion-sesion.php?modS=ok&id=$idSesion");

            mysqli_query($conexion,"UPDATE `sesiones` SET `detalles`='$detalles',`imagen`='$nombreImagen', `fk_fechas_horas`='$fk_horario',`fk_estado_sesion`='$estado',`monto`='$monto' WHERE `id_sesiones`='$idSesion'");
        }
        else {
            $idSesion = $_POST["id_sesion"];
            header("Location: modificacion-sesion.php?camposVacios=ok&idS=$idSesion");
            exit();
        }
    }
?>