<?php
    include_once("../componentes/header.php");
?>
<main>
    <?php
        $id_tratamiento;
        if (isset($_GET["id"])) {
            $id_tratamiento = $_GET["id"];
        }
        if (empty($_GET["id"])) {
            header("Location: index.php");
        }
    ?>
</main>
<?php
    include_once("../componentes/footer.php");
?>