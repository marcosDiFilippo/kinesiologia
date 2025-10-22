<?php
    include_once("../componentes/config/config.php");
    include_once("../admin/abml/lectura.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <section>
        <article>
            <form action="./abml/alta.php" method="post">
                <div>
                    <input type="text" name="nombre" id="nombre">
                    <input type="text" name="apellido" id="apellido">
                </div>
                <div>
                    <input type="date" name="fecha-nacimiento" id="fecha-nacimiento">
                    <input type="number" name="dni" id="dni">
                </div>
                <div>
                    <input type="email" name="email" id="email">
                    <input type="number" name="telefono" id="telefono">
                </div>
                <div>   
                    <label for="Fecha Consulta">Fecha Consulta</label>
                    <input type="date" name="fecha" id="fecha">
                    <input type="time" name="hora" id="hora">
                </div>
                <div>
                    <label for="pago">Pago</label>
                    <input type="number" name="monto" id="monto">
                    <?php
                        $metodosPago = mysqli_query($conexion,$lecturaMetodosPago);
                    
                        while($metodoPago = mysqli_fetch_array($metodosPago)) {
                            echo "<input type='checkbox' name='metodos-pago[]' id='$metodoPago[nombre]' value='$metodoPago[nombre]'>";
                            echo "<label for='$metodoPago[nombre]'>$metodoPago[nombre]</label>";
                        }
                    ?>
                </div>
                    <label for="estado">Estado</label>
                    <select name="estado" id="estado">
                        <?php
                            $estados = mysqli_query($conexion,$lecturaEstados);

                            while($estado = mysqli_fetch_array($estados)) {
                                echo "<option value='$estado[nombre]'>$estado[nombre]</option>";
                            }
                        ?>
                    </select>
                <div>
                    <label for="tratamiento">Motivo Consulta</label>
                    <?php
                        $tratamientos = mysqli_query($conexion,$lecturaTratamientos);

                        while($tratamiento = mysqli_fetch_array($tratamientos)) {
                            echo "<input type='checkbox' name='tratamientos[]' id='$tratamiento[nombre]' value='$tratamiento[nombre]'>";
                            echo "<label for='$tratamiento[nombre]'>$tratamiento[nombre]</label>";
                        }
                    ?>
                </div>

                <input type="submit" value="Cargar Paciente">
            </form>
        </article>
    </section>
</body>
</html>