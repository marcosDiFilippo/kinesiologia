<?php
    include_once("../../componentes/config/config.php");
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
            echo "todo set";

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
        }
        //modificacion de sesion
        if (
            isset($_POST["fecha"]) &&
            isset($_POST["hora"]) &&
            isset($_POST["metodos-pago"]) &&
            isset($_POST["monto"]) &&
            isset($_POST["estado"]) &&
            isset($_POST["tratamientos"]) &&
            isset($_FILES["imagen"])
        ) {
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
        }
    }
?>