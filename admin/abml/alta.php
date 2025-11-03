<?php
    include_once("../../componentes/config/config.php");
    include_once("./lectura.php");
    function validarSubida ($nombre, $apellido, $dni, $fechaNacimiento, $email, $telefono, $fecha, $hora, $metodoPago, $monto, $estado, $tratamientoss, $conexion, $lecturaUsuarios, $detalles, $lecturaHorarios, $imagen) : bool {
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
            return false;
        }
        if  (!str_contains($email,"@")) {
            header("Location: ../pacientes.php?email=no");
            return false;
        }
        $lecturaUsuarios .= " WHERE `email`='$email' or `dni`='$dni'";
        $usuarios = mysqli_query($conexion, $lecturaUsuarios);

        if ($usuario = mysqli_fetch_array($usuarios)) {
            header("Location: ../pacientes.php?campos=existentes");
            return false;
        }
        return true;
    }
    function realizarAltaPaciente ($nombre, $apellido, $dni, $fechaNacimiento, $email, $telefono, $conexion) {
        mysqli_query($conexion,"INSERT INTO `personas`(`nombre`, `apellido`, `dni`, `fecha_nacimiento`, `telefono`, `email`, `fk_rol`) VALUES ('$nombre','$apellido','$dni','$fechaNacimiento','$telefono','$email',3)");

        $resultadoUsuario = mysqli_query($conexion,"SELECT * FROM  `personas` WHERE `email`='$email'");

        $fk_persona = 0;
        if ($usuario = mysqli_fetch_array($resultadoUsuario)) {
            $fk_persona = $usuario["id_personas"];
        }
        
        return $fk_persona;
    }
    function validarAltaHorarios ($lecturaHorarios, $fecha, $hora, $conexion) : int {
        $lecturaHorarios .= " WHERE `fecha`='$fecha' and `hora`='$hora'";
        $resultadoHorarios = mysqli_query($conexion, $lecturaHorarios);

        if ($horario = mysqli_fetch_array($resultadoHorarios)) {
            $fk_fechas_horas = $horario["id_fechas_horas"];
            return $fk_fechas_horas;
        }
        return -1;
    }
    function realizarAltaPago ($metodoPago, $fk_sesion, $conexion) {
        for ($i=0; $i < count($metodoPago); $i++) { 
            mysqli_query($conexion, "INSERT INTO `pago_sesiones`(`fk_metodos_pago`, `fk_sesiones`) VALUES ('$metodoPago[$i]','$fk_sesion')");
        }
    }   
    function realizarAltaSesion ($detalles, $imagen, $fk_persona, $fk_horario, $fk_estado, $monto, $conexion, $lecturaSesiones) : int {

        var_dump($imagen);

        $temp = $imagen["tmp_name"];
        $nombreImagen = time() . ".jpg";

        move_uploaded_file($temp, "../../imagenes-subidas/$nombreImagen");

        mysqli_query($conexion,"INSERT INTO `sesiones`(`detalles`, `imagen`, `fk_personas`, `fk_fechas_horas`, `fk_estado_sesion`, `monto`) VALUES ('$detalles','$nombreImagen','$fk_persona','$fk_horario','$fk_estado','$monto')");

        $lecturaSesiones .= " WHERE `imagen`='$nombreImagen'";
        $resultadoSelect = mysqli_query($conexion, $lecturaSesiones);

        $fk_sesion = 0;
        if ($sesion = mysqli_fetch_array($resultadoSelect)) {
            $fk_sesion = $sesion["id_sesiones"];
        }

        return $fk_sesion;
    }
    function realizarAltaTratamientos ($fk_sesion, $tratamientoss, $conexion) {
        for ($i=0; $i < count($tratamientoss); $i++) { 
            mysqli_query($conexion,"INSERT INTO `sesiones_tratamientos`(`fk_sesiones`, `fk_tratamientos`) VALUES ('$fk_sesion','$tratamientoss[$i]')");
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
            isset($_POST["tratamientos"]) &&
            isset($_FILES["imagen"])
        ) {
            $flag;

            $nombre = htmlspecialchars($_POST["nombre"]);

            $apellido = htmlspecialchars($_POST["apellido"]);

            $dni = htmlspecialchars($_POST["dni"]);

            $fechaNacimiento = htmlspecialchars($_POST["fecha-nacimiento"]);

            $email = htmlspecialchars($_POST["email"]);

            $telefono = htmlspecialchars($_POST["telefono"]);

            $fecha = htmlspecialchars($_POST["fecha"]);

            $hora = htmlspecialchars($_POST["hora"]);

            $metodoPago = array_map(function ($metodo) {
                return $metodo;
            }, $_POST["metodos-pago"]);

            $monto = htmlspecialchars($_POST["monto"]);

            $estado = htmlspecialchars($_POST["estado"]);

            $tratamientoss = array_map(function ($tratamiento) {
                return $tratamiento;
            }, $_POST["tratamientos"]);

            $detalles = htmlspecialchars($_POST["detalles"]);

            $imagen = $_FILES["imagen"];

            $flag = validarSubida($nombre,
            $apellido, 
            $dni, 
            $fechaNacimiento, 
            $email, 
            $telefono, 
            $fecha, 
            $hora, 
            $metodoPago, 
            $monto, 
            $estado, 
            $tratamientoss, 
            $conexion, 
            $lecturaUsuarios, 
            $detalles, 
            $lecturaHorarios,
            $imagen);

            if ($flag == true) {
                $fk_persona = realizarAltaPaciente(
                    $nombre, 
                    $apellido, 
                    $dni, 
                    $fechaNacimiento, 
                    $email, 
                    $telefono, 
                    $conexion
                );

                $fk_horario_aux = validarAltaHorarios(
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

                $fk_sesion = realizarAltaSesion($detalles, $imagen, $fk_persona, $fk_horario, $estado, $monto, $conexion, $lecturaSesiones);
                
                realizarAltaPago($metodoPago, $fk_sesion, $conexion);

                realizarAltaTratamientos($fk_sesion, $tratamientoss, $conexion);

                $mensaje = $nombre . " " . $apellido;
                header("Location: ../pacientes.php?alta=$mensaje");
            }
        }
    }
?>