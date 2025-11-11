<?php
    session_start();
    if ($_SESSION == NULL) {
        header("Location: ../../index.php");
    }
    include_once("../../componentes/config/config.php");
    include_once("lectura.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificacion Sesion</title>

    <link rel="stylesheet" href="../../css-admin/sesiones.css">
    <?php
        include_once("../../librerias/bootstrap-css.php");

        $idSesion;
        if (isset($_GET["idS"])) {
            $idSesion = $_GET["idS"];
        }
    ?>
</head>
<body>
    <main>
        <section>
            <article>
                <a class="volver-atras" href="../informacion-sesion.php?id=<?php echo $idSesion?>">Volver Atras</a>
            </article>
            <article>
                <form class="container-fluid form-modificacion" action="procesar-modificacion.php" method="post" enctype="multipart/form-data">
                    <div>
                        <input type="hidden" name="id_sesion" value="<?php echo $idSesion?>">
                    </div>
                    <div class="row">  
                        <div class="col-6 d-flex flex-column">
                            <label for="fecha">Fecha Consulta</label>
                            <input type="date" name="fecha" id="fecha" placeholder="Ingrese fecha de la consulta">
                        </div>
                        <div class="col-6 d-flex flex-column">
                            <label for="hora">Horario</label>
                            <input type="time" name="hora" id="hora" placeholder="Ingrese horario de la consulta">
                        </div>
                    </div>
                    <hr>
                    <div>
                        <div>
                            <div class="row d-flex align-items-center">
                                <label class="col-2" for="monto">Pago</label>
                                <input class="col-4" type="number" name="monto" id="monto" placeholder="Ingrese el monto de la sesion">
                            </div>
                            <?php
                                $metodosPago = mysqli_query($conexion,$lecturaMetodosPago);
                                
                                while($metodoPago = mysqli_fetch_array($metodosPago)) {
                                    echo "<input type='checkbox' name='metodos-pago[]' id='$metodoPago[nombre]' value='$metodoPago[id_metodos_pago]'>";
                                    echo "<label class='label-checkbox col-2' for='$metodoPago[nombre]'>$metodoPago[nombre]</label>";
                                }
                            ?>
                        </div>
                    </div>
                    <hr>
                    <div>
                        <div class="col-6 >
                            <label for="estado">Estado</label>
                            <select name="estado" id="estado">
                                <?php
                                    $estados = mysqli_query($conexion,$lecturaEstados);
                                    
                                    while($estado = mysqli_fetch_array($estados)) {
                                        echo "<option value='$estado[id_estado]'>$estado[nombre]</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div>
                        <p class="motivo-consulta">Motivo Consulta</p>
                        <div class="row">
                        <?php
                            $tratamientos = mysqli_query($conexion,$lecturaTratamientos);
                            
                            while($tratamiento = mysqli_fetch_array($tratamientos)) {
                                echo "<div class='div-checkbox col-2'>";
                                echo "<input type='checkbox' name='tratamientos[]' id='$tratamiento[nombre]' value='$tratamiento[id_tratamientos]'>";
                                echo "<label class='label-checkbox' for='$tratamiento[nombre]'>$tratamiento[nombre]</label>";
                                echo "</div>";
                            }
                        ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <textarea class="col-12" name="detalles" id="detalles" rows="10" placeholder="Ingrese los detalles sobre la consulta (Opcional)"></textarea>
                    </div>
                    <div>
                        <label for="imagen">Ingrese la imagen relacionada a la sesion</label>
                        <input type="file" name="imagen" id="imagen" required>
                    </div>
                    <input type="submit" value="Modificar Sesion">
                </form>
            </article>
        </section>
    </main>
    <?php
        include_once("../../librerias/bootstrap-js.php");
    ?>
</body>
</html>