<?php
    include_once("../../componentes/config/config.php");

    $lecturaUsuarios = "SELECT * FROM `personas`";
    $lecturaMetodosPago = "SELECT * FROM `metodos_pago`";
    $lecturaEstados = "SELECT * FROM `estados_sesiones`";
    $lecturaTratamientos = "SELECT * FROM `tratamientos`";
?>