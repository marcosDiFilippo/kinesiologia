<?php
    $servidor = "localhost";
    $usuario = "root";
    $clave = "";
    $base_datos = "kinesiologia";
    $puerto = 3306;

    $conexion = mysqli_connect($servidor,$usuario,$clave,$base_datos, $puerto);  
?>